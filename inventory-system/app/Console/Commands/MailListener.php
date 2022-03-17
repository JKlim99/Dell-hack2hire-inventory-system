<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Webklex\PHPIMAP\Client;
use Webklex\PHPIMAP\Exceptions\ConnectionFailedException;
use Webklex\PHPIMAP\Exceptions\FolderFetchingException;
use Webklex\PHPIMAP\Folder;
use Webklex\PHPIMAP\Message;
use Spatie\PdfToText\Pdf;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Maatwebsite\Excel\Facades\Excel;

use App\Imports\FileImport;

use App\Models\Tenant;
use App\Models\MailList as MailListModel;
use App\Models\File as FileModel;
use App\Models\InvalidInventoryUpdate as InvalidInventoryUpdateModel;

use App\Http\Controllers\FileValidation;

class MailListener extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:listen {tenant}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch new messages by utilising imap idle';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \Webklex\PHPIMAP\Exceptions\EventNotFoundException
     * @throws \Webklex\PHPIMAP\Exceptions\InvalidMessageDateException
     * @throws \Webklex\PHPIMAP\Exceptions\MessageContentFetchingException
     * @throws \Webklex\PHPIMAP\Exceptions\MessageHeaderFetchingException
     * @throws \Webklex\PHPIMAP\Exceptions\RuntimeException
     */
    public function handle()
    {
        if(!$this->argument('tenant')){ //if tenant argument not specify end the command
            return 0;
        }
        Tenant::all()->runForEach(function () {
            if(tenant('id') == $this->argument('tenant')){ //if the tenant id matched, run the mail listener
                /** @var Client $client */
                $client = \Client::account("default");
                try {
                    $client->connect();
                } catch (ConnectionFailedException $e) {
                    Log::error($e->getMessage());
                    return 1;
                }

                /** @var Folder $folder */
                try {
                    $folder = $client->getFolder("INBOX");
                } catch (ConnectionFailedException $e) {
                    Log::error($e->getMessage());
                    return 1;
                } catch (FolderFetchingException $e) {
                    Log::error($e->getMessage());
                    return 1;
                }

                try {
                    $folder->idle(function ($message) {
                        $mailSubject = $message->getSubject();
                        $mailBody = $message->getTextBody();
                        $header = $message->getHeader();
                        $sender = $header->get("from")->get("values")[0]->mail ?? null;
                        $this->info('========== New mail received ==========');
                        $this->info('Subject: '.$mailSubject);
                        if($message->hasAttachments()){ // check if it has attachments within the mail
                            $this->info('Validating email subject...');
                            if(strpos(strtolower($mailSubject), "inventory update") === false){ // check if the email has the keyword of 'inventory update'
                                $this->info('Invalid email subject, ignoring the email.');
                                return 0; //ignore this email
                            }
                            $this->info('Valid email subject.');

                            $this->info('Storing email in database...');
                            $mail = MailListModel::create([
                                'subject'   => $mailSubject,
                                'body'      => $mailBody,
                                'sender'    => $sender,
                                'status'    => 'new'
                            ]);

                            $this->info('Extracting attachments...');
                            $mail->update(['status' => 'extracting attachments']);
                            $attachments = $message->getAttachments();
                            $attachmentsCount = count($attachments);
                            $this->info($attachmentsCount.' attachment(s) found.');
                            $count = 1;

                            $fileIds = [];
                            foreach($attachments as $attachment){
                                $this->info('Validating file type... '.$count.'/'.$attachmentsCount);
                                $mail->update(['status' => 'validating file type '.$count.'/'.$attachmentsCount]);
                                $fileExtension = $attachment->getExtension();
                                if(in_array($fileExtension, ['pdf','png','jpeg','jpg','xlsx','csv'])){
                                    $this->info('Valid file type.');
                                    $this->info('Storing attachment... '.$count.'/'.$attachmentsCount);
                                    $mail->update(['status' => 'storing attachments '.$count.'/'.$attachmentsCount]);
                                    $status = $attachment->save($path = storage_path().'/', $filename = null);
                                    if($status){ // if storing status success
                                        $fileName = $attachment->getName();
                                        $this->info('Attachment is successfully stored. "'.$fileName.'"');
                                        $file = FileModel::create([
                                            'mail_id' => $mail->id,
                                            'file_name' => $fileName
                                        ]);
                                        $fileIds[] = $file->id;

                                        $this->info('Decoding attachments... '.$count.'/'.$attachmentsCount);
                                        $mail->update(['status' => 'decoding attachments '.$count.'/'.$attachmentsCount]);
                                        if(in_array($fileExtension, ['png','jpeg','jpg'])){ // if its image filetype
                                            $mail->update(['status' => 'validating image file '.$count.'/'.$attachmentsCount]);
                                            $ocr = new TesseractOCR(storage_path().'/'. $fileName);
                                            $output = $ocr->run();
                                            $rows = explode("\n", $output);
                                            $this->info('Decoded attachments.');
                                            $this->info('Validating data... '.$count.'/'.$attachmentsCount);
                                            foreach($rows as $row){
                                                if($row == ''){
                                                    continue;
                                                }
                                                $row = explode(" ", $row);
                                                if($row[0] == 'ProductName'){
                                                    continue;
                                                }
                                                $productName    = $row[0];
                                                $unitPrice      = $row[1];
                                                $totalPrice     = $row[2];
                                                $quantity       = $row[3];
                                                $type           = $row[4];
                                                FileValidation::fileValidate($productName, $unitPrice, $totalPrice, $quantity, $type, $file->id);
                                            }
                                        }
                                        elseif(in_array($fileExtension,['pdf'])){ // if its pdf file type
                                            $mail->update(['status' => 'validating pdf file '.$count.'/'.$attachmentsCount]);
                                            $path = "D:/Git/mingw64/bin/pdftotext";
                                            $output = Pdf::getText(storage_path().'/'.$fileName, $path);
                                            $rows = explode("\r\n\r\n", $output);
                                            $arrays = [
                                                [],[],[],[],[]
                                            ];
                                            $this->info('Decoded attachments.');
                                            $this->info('Validating data... '.$count.'/'.$attachmentsCount);
                                            foreach($rows as $row){
                                                $row = explode(" ", $row);
                                                $index = 0;
                                                foreach($row as $value){
                                                    $arrays[$index][] = $value;
                                                    $index++;
                                                }
                                            }
                                            foreach($arrays as $row){
                                                if(count($row)<1){
                                                    continue;
                                                }
                                                if($row[0] == 'ProductName'){
                                                    continue;
                                                }
                                                $productName    = $row[0];
                                                $unitPrice      = $row[1];
                                                $totalPrice     = $row[2];
                                                $quantity       = $row[3];
                                                $type           = $row[4];
                                                FileValidation::fileValidate($productName, $unitPrice, $totalPrice, $quantity, $type, $file->id);
                                            }
                                        }
                                        elseif(in_array($fileExtension,['xlsx','csv'])){ // if its excel filetype
                                            $mail->update(['status' => 'validating excel file & updating to database '.$count.'/'.$attachmentsCount]);
                                            $this->info('Decoded attachments.');
                                            $this->info('Validating data... '.$count.'/'.$attachmentsCount);
                                            Excel::import(new FileImport($file->id), storage_path().'/'. $fileName);
                                        }
                                        $this->info('Validated data.');
                                    }
                                }
                                $count++;
                            }
                            if(count($fileIds)>0){
                                $this->info('Sending exception email...');
                            }
                            foreach($fileIds as $fileId){
                                $invalid_inventory = InvalidInventoryUpdateModel::where('file_id', $fileId)->get();
                                if($invalid_inventory->count() > 0){
                                    $file = FileModel::where('id',$fileId)->first();
                                    $to_email = $sender;
                                    $data = array('filename'=>$file->file_name, 'exceptions'=>$invalid_inventory);
                                        
                                    Mail::send('emails.mail', $data, function($message) use ($to_email, $mailSubject) {
                                        $message->to($to_email)
                                                ->subject('Email attachment exception: '.$mailSubject);
                                    });
                                }
                            }
                            if(count($fileIds)>0){
                                $this->info('Sent exception email.');
                            }
                            if(strpos($mail->status, 'validating') !== false){
                                $mail->update(['status' => 'done']);
                            }
                            $this->info(''); // new line
                        }
                    }, $auto_reconnect = true);
                } catch (ConnectionFailedException $e) {
                    Log::error($e->getMessage());
                    return 1;
                } catch (\Exception $e) {
                    Log::error($e->getMessage());
                }
            }
        });
        return 0;
    }
}

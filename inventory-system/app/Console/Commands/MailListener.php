<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Webklex\PHPIMAP\Client;
use Webklex\PHPIMAP\Exceptions\ConnectionFailedException;
use Webklex\PHPIMAP\Exceptions\FolderFetchingException;
use Webklex\PHPIMAP\Folder;
use Webklex\PHPIMAP\Message;
use App\Models\Tenant;
use App\Models\MailList as MailListModel;
use App\Models\File as FileModel;

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
                        $this->info('New mail received: '.$mailSubject);
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
                            foreach($attachments as $attachment){
                                $this->info('Validating file type...');
                                $mail->update(['status' => 'validating file type']);
                                if(in_array($attachment->getExtension(), ['pdf','png','jpeg','jpg','xlsx','csv'])){
                                    $this->info('Valid file type.');
                                    $this->info('Storing attachment...');
                                    $mail->update(['status' => 'storing attachments']);
                                    $status = $attachment->save($path = storage_path().'/', $filename = null);
                                    if($status){ // if storing status success
                                        $fileName = $attachment->getName();
                                        $this->info('Attachment is successfully stored. "'.$fileName.'"');
                                        $file = FileModel::create([
                                            'mail_id' => $mail->id,
                                            'file_name' => $fileName
                                        ]);
                                        //TODO: file data validation
                                    }
                                }
                            }
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

<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Http\Controllers\FileValidation;

class FileImport implements ToModel, WithStartRow
{
    protected $file_id;
    public function __construct($file_id){
        $this->file_id = $file_id;
    }

    public function startRow(): int
    {
        return 2;
    }
    
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        try{
            $productName    = $row[0];
            $unitPrice      = $row[1];
            $totalPrice     = $row[2];
            $quantity       = $row[3];
            $type           = $row[4];

            FileValidation::fileValidate($productName, $unitPrice, $totalPrice, $quantity, $type, $this->file_id);
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
        }

    }

    public function batchSize(): int 
    {
        return 100;
    }
}

<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class ReportExport implements FromCollection, WithHeadings
{
    protected $dateStart;
    protected $dateEnd;

    public function __construct($dateStart = null, $dateEnd = null)
    {
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $dateStart = $this->dateStart;
        $dateEnd = $this->dateEnd;
        if($dateStart && $dateEnd){
            $records = DB::table('inventory')
                        ->join('product', 'inventory.product_id', 'product.id')
                        ->select('product.name as product_name', 'product.price as unit_price', DB::raw('sum(case when inventory.type = "stock_in" then inventory.quantity else 0 end) as stock_in'), DB::raw('sum(case when inventory.type = "stock_out" then inventory.quantity else 0 end) as stock_out'), DB::raw('sum(inventory.quantity) as stock_count'), DB::raw('(case when sum(inventory.quantity) < 50 then "low stock" else "sufficient stock" end) as stock_status'))
                        ->where('inventory.created_at','>=',$dateStart)
                        ->where('inventory.created_at','<=',$dateEnd)
                        ->groupBy('product.name','product.price')
                        ->get();
        }
        elseif($dateStart && !$dateEnd){
            $records = DB::table('inventory')
                        ->join('product', 'inventory.product_id', 'product.id')
                        ->select('product.name as product_name', 'product.price as unit_price', DB::raw('sum(case when inventory.type = "stock_in" then inventory.quantity else 0 end) as stock_in'), DB::raw('sum(case when inventory.type = "stock_out" then inventory.quantity else 0 end) as stock_out'), DB::raw('sum(inventory.quantity) as stock_count'), DB::raw('(case when sum(inventory.quantity) < 50 then "low stock" else "sufficient stock" end) as stock_status'))
                        ->where('inventory.created_at','>=',$dateStart)
                        ->groupBy('product.name','product.price')
                        ->get();
        }
        elseif(!$dateStart && $dateEnd){
            $records = DB::table('inventory')
                        ->join('product', 'inventory.product_id', 'product.id')
                        ->select('product.name as product_name', 'product.price as unit_price', DB::raw('sum(case when inventory.type = "stock_in" then inventory.quantity else 0 end) as stock_in'), DB::raw('sum(case when inventory.type = "stock_out" then inventory.quantity else 0 end) as stock_out'), DB::raw('sum(inventory.quantity) as stock_count'), DB::raw('(case when sum(inventory.quantity) < 50 then "low stock" else "sufficient stock" end) as stock_status'))
                        ->where('inventory.created_at','<=',$dateEnd)
                        ->groupBy('product.name','product.price')
                        ->get();
        }
        else{
            $records = DB::table('inventory')
                        ->join('product', 'inventory.product_id', 'product.id')
                        ->select('product.name as product_name', 'product.price as unit_price', DB::raw('sum(case when inventory.type = "stock_in" then inventory.quantity else 0 end) as stock_in'), DB::raw('sum(case when inventory.type = "stock_out" then inventory.quantity else 0 end) as stock_out'), DB::raw('sum(inventory.quantity) as stock_count'), DB::raw('(case when sum(inventory.quantity) < 50 then "low stock" else "sufficient stock" end) as stock_status'))
                        ->groupBy('product.name','product.price')
                        ->get();
        }
        return $records;
    }

    public function headings(): array
    {
        return [
            'Product name',
            'Unit price',
            'Stock in',
            'Stock out',
            'Stock count',
            'Stock status'
        ];
    }
}

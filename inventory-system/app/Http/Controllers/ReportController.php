<?php

namespace App\Http\Controllers;

use App\Models\ReportProperties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Inventory;

use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;

use DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $report = ReportProperties::all();


        return View::make('report.list')->with(['report' => $report]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View::make('report.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'column_name' => 'required'
        ]);
        $show = ReportProperties::create($validatedData);

        return redirect('/report/list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $report = ReportProperties::find($id);

        // show the view and pass the shark to it
        return View::make('sharks.show')
            ->with('shark', $report);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $report = ReportProperties::find($id);

        // show the edit form and pass the shark
        return View::make('sharks.edit')
            ->with('shark', $report);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
            'product_name' => 'required',
            'unit_price' => 'required',
            'total_price' => 'required',
            'quantity' => 'required',
            'type' => 'required',
        ]);
        ReportProperties::whereId($id)->update($validatedData);

        return redirect('/games')->with('success', 'Game Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report = ReportProperties::findOrFail($id);
        $report->delete();

        return redirect('/report/list');
    }

    public function list(Request $request){
        $dateStart = $request->input('dateStart',null);
        $dateEnd = $request->input('dateEnd',null);
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

        return View::make('invreport.list')
            ->with(['records'=>$records, 'dateStart'=>$dateStart, 'dateEnd'=>$dateEnd]);
    }

    public function export(Request $request){
        $dateStart = $request->input('dateStart',null);
        $dateEnd = $request->input('dateEnd',null);
        return Excel::download(new ReportExport($dateStart,$dateEnd), 'report.xlsx');
    }
}

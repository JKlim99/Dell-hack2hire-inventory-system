<?php

namespace App\Http\Controllers;

use App\Models\ReportProperties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

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
}

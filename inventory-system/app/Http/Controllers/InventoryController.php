<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

use App\Models\Product;
use DB;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $inventory = Inventory::with('product')->get();

        return view('stock.list', compact('inventory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createForm()
    {
        $products = Product::all();
        return View::make('stock.create')->with(['products'=>$products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
            'unit_price' => 'required',
            'total_price' => 'required',
            'quantity' => 'required',
            'type' => 'required',
        ]);
        $product_id = $request->input('product_id');
        $product = Product::find($product_id);
        $validatedData['product_name'] = $product->name;
        $show = Inventory::create($validatedData);

        return redirect('/inventory/list')->with('success', 'Inventory record is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateForm($id)
    {
        //
        $inventory = Inventory::find($id);

        // show the view and pass the shark to it
        return View::make('stock.edit')
            ->with(['inventory'=>$inventory]);
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
            'product_name' => 'required',
            'unit_price' => 'required',
            'total_price' => 'required',
            'quantity' => 'required',
            'type' => 'required',
        ]);
        Inventory::whereId($id)->update($validatedData);

        return redirect('/inventory/update/'.$id)->with('success', 'Inventory is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();

        return redirect('/inventory/list')->with('success', 'Inventory record is successfully deleted');
    }

    public function dashboard(){
        $top10StockIn = DB::table('inventory')
                            ->join('product', 'inventory.product_id', 'product.id')
                            ->select('product.name as name', DB::raw('sum(inventory.quantity) as stock'))
                            ->where('inventory.type','stock_in')
                            ->groupBy('product.name')
                            ->orderBy('stock','desc')
                            ->limit(10)
                            ->get();

        $top10StockOut = DB::table('inventory')
                            ->join('product', 'inventory.product_id', 'product.id')
                            ->select('product.name as name', DB::raw('sum(inventory.quantity) as stock'))
                            ->where('inventory.type','stock_out')
                            ->groupBy('product.name')
                            ->orderBy('stock','asc')
                            ->limit(10)
                            ->get();
        
        $top10Stock = DB::table('inventory')
                            ->join('product', 'inventory.product_id', 'product.id')
                            ->select('product.name as name', DB::raw('sum(inventory.quantity) as stock'))
                            ->groupBy('product.name')
                            ->limit(10)
                            ->get();
        
        return View::make('dashboard')
            ->with(['top10StockIn'=>$top10StockIn, 'top10StockOut'=>$top10StockOut, 'top10Stock'=>$top10Stock]);        
    }
}

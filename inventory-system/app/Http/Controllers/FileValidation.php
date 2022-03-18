<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product as ProductModel;
use App\Models\Inventory as InventoryModel;
use App\Models\InvalidInventoryUpdate as InvalidInventoryUpdateModel;
use Illuminate\Support\Facades\Log;
use DB;

class FileValidation extends Controller
{
    public static function fileValidate($productName = '', $unitPrice = '', $totalPrice = '', $quantity = '', $type = '', $file_id = '')
    {
        try{
            if(is_numeric($productName)){
                $inventory = InvalidInventoryUpdateModel::create([
                    'product_id' => null,
                    'product_name' => $productName,
                    'unit_price' => $unitPrice,
                    'total_price' => $totalPrice,
                    'quantity' => $quantity,
                    'type' => $type,
                    'reason' => 'Invalid product name, expected text value but numeric value given.',
                    'file_id' => $file_id
                ]);
                return;
            }
            if(!is_numeric($unitPrice)){
                $inventory = InvalidInventoryUpdateModel::create([
                    'product_id' => null,
                    'product_name' => $productName,
                    'unit_price' => $unitPrice,
                    'total_price' => $totalPrice,
                    'quantity' => $quantity,
                    'type' => $type,
                    'reason' => 'Invalid unit price, expected numeric but non-numeric given.',
                    'file_id' => $file_id
                ]);
                return;
            }
            if(!is_numeric($totalPrice)){
                $inventory = InvalidInventoryUpdateModel::create([
                    'product_id' => null,
                    'product_name' => $productName,
                    'unit_price' => $unitPrice,
                    'total_price' => $totalPrice,
                    'quantity' => $quantity,
                    'type' => $type,
                    'reason' => 'Invalid total price, expected numeric but non-numeric given.',
                    'file_id' => $file_id
                ]);
                return;
            }
            if(!is_numeric($unitPrice)){
                $inventory = InvalidInventoryUpdateModel::create([
                    'product_id' => null,
                    'product_name' => $productName,
                    'unit_price' => $unitPrice,
                    'total_price' => $totalPrice,
                    'quantity' => $quantity,
                    'type' => $type,
                    'reason' => 'Invalid quantity, expected numeric but non-numeric given.',
                    'file_id' => $file_id
                ]);
                return;
            }
            if(($unitPrice * $quantity) != $totalPrice){
                $inventory = InvalidInventoryUpdateModel::create([
                    'product_id' => null,
                    'product_name' => $productName,
                    'unit_price' => $unitPrice,
                    'total_price' => $totalPrice,
                    'quantity' => $quantity,
                    'type' => $type,
                    'reason' => 'Invalid total price, unit price and quantity count do not match with total price given.',
                    'file_id' => $file_id
                ]);
                return;
            }

            $product = ProductModel::where('name', $productName)->first();
            if(!$product){
                $product = ProductModel::create([
                    'name' => $productName,
                    'description' => '',
                    'price' => $unitPrice
                ]);
            }
            if(in_array(strtolower($type), ['stock_in','stockin','stock in','in'])){
                $type = 'stock_in';
            }
            elseif(in_array(strtolower($type), ['stock_out','stockout','stock out','out']) && $quantity > 0){ // if stock out, store quantity as negative value
                $type = 'stock_out';
                $quantity = $quantity * -1;
            }
            else{ // invalid type
                $inventory = InvalidInventoryUpdateModel::create([
                    'product_id' => $product->id,
                    'product_name' => $productName,
                    'unit_price' => $unitPrice,
                    'total_price' => $totalPrice,
                    'quantity' => $quantity,
                    'type' => $type,
                    'reason' => 'Invalid type',
                    'file_id' => $file_id
                ]);
                return;
            }
            if($type == 'stock_in' && $quantity < 0){
                $quantity = $quantity * -1;
            }

            $inventoryStock = DB::table('inventory')
                                ->select(DB::raw('SUM(quantity) as quantity'))
                                ->where('product_id', $product->id)
                                ->groupBy('product_id')
                                ->first();

            if($type == 'stock_out' && $inventoryStock->quantity < ($quantity * -1)){
                $inventory = InvalidInventoryUpdateModel::create([
                    'product_id' => $product->id,
                    'product_name' => $productName,
                    'unit_price' => $unitPrice,
                    'total_price' => $totalPrice,
                    'quantity' => $quantity,
                    'type' => $type,
                    'reason' => 'Stock insufficient, unable to stock out for this product',
                    'file_id' => $file_id
                ]);
                return;
            }

            $inventory = InventoryModel::create([
                'product_id' => $product->id,
                'product_name' => $productName,
                'unit_price' => $unitPrice,
                'total_price' => $totalPrice,
                'quantity' => $quantity,
                'type' => $type,
                'file_id' => $file_id
            ]);
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
        }
    }
}

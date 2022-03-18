<!DOCTYPE html>
<html lang="en">


@include('public')
<body>
    <div class="SectionB">

        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Stock Edit</h1>
            </div>

            <div class="card-body">
                <form action="/inventory/update/{{$inventory->id}}" method="post">
                    @csrf
                    <label for="product-id">Product Id #{{$inventory->id}}</label><br />
                    <label for="product-name">Product Name</label>
                    <input type="text" id="product-name" name="product_name" class="form-control" value="{{$inventory->product_name}}">
                    <label for="current-stock-quantity">Quantity</label>
                    <input type="number" id="current-stock-quantity" name="quantity" class="form-control" value="{{$inventory->quantity}}">
                    <label for="unit-price">Unit Price</label>
                    <input type="number" id="unit-price" name="unit_price" class="form-control" value="{{$inventory->unit_price}}">
                    <label for="total-price">Total Price</label>
                    <input type="number" id="total-price" name="total_price" class="form-control" value="{{$inventory->total_price}}">
                    <label for="type">Type</label>
                    <select name="type" id="type" class="form-control">
                        <option value="stock_in" @if($inventory->type == 'stock_in')selected @endif>Stock in</option>
                        <option value="stock_out" @if($inventory->type == 'stock_out')selected @endif>Stock out</option>
                    </select>
                    <br>
                    <a href="/inventory/list" class="btn btn-secondary">Back to list</a>
                    <input type="submit" class="btn btn-primary" value="Update">
                </form>
            </div>
        </div>

    </div>
</body>
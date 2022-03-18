<!DOCTYPE html>
<html lang="en">

@include('public')
<body>

    <div class="SectionB">

        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Stock Create</h1>
            </div>

            <div class="card-body">
                <form action="/inventory/create" method="post">
                    @csrf
                    <label for="type">Product</label>
                    <select name="product_id" id="product_id" class="form-control">
                        @foreach($products as $product)
                        <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>
                    <label for="product-name">Product Name</label>
                    <input type="text" id="product-name" name="product_name" class="form-control">
                    <label for="current-stock-quantity">Quantity</label>
                    <input type="number" id="current-stock-quantity" name="quantity" class="form-control">
                    <label for="unit-price">Unit Price</label>
                    <input type="number" id="unit-price" name="unit_price" class="form-control">
                    <label for="total-price">Total Price</label>
                    <input type="number" id="total-price" name="total_price" class="form-control">
                    <label for="type">Type</label>
                    <select name="type" id="type" class="form-control">
                        <option value="stock_in">Stock in</option>
                        <option value="stock_out">Stock out</option>
                    </select>
                    <br>
                    <a href="/inventory/list" class="btn btn-secondary">Back to list</a>
                    <input type="submit" class="btn btn-primary" value="Create">
                </form>
            </div>
        </div>
    </div>
</body>

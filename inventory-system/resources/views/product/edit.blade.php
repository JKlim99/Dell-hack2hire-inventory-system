<!DOCTYPE html>
<html lang="en">


@include('public')

<body>
    <div class="SectionB">

        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Product Edit</h1>
            </div>

            <div class="card-body">
                <form action="/product/update/{{$product->id}}" method="post">
                    @csrf
                    <label for="product-name">Product Name</label>
                    <input type="text" id="product-name" name="name" class="form-control" value="{{$product->name}}">
                    <label for="description">Description</label>
                    <input type="text" id="description" name="description" class="form-control" value="{{$product->description}}">
                    <label for="unit-price">Price</label>
                    <input type="number" id="price" name="price" class="form-control" value="{{$product->price}}">
                    <br/>
                    <a href="/product/list" class="btn btn-secondary">Back to list</a>
                    <input type="submit" class="btn btn-primary" value="Update">
                </form>
            </div>
        </div>
    </div>

</body>

</html>
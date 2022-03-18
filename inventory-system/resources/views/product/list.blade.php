<!DOCTYPE html>
<html lang="en">

@include('public')
<body>

    <div class="SectionB">

        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Product View</h1>
                <a href="/product/create" class="btn btn-primary">Create</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="list-table">
                        <thead class="text-primary">
                            <tr>
                                <th>
                                    Product Name
                                </th>
                                <th>
                                    Price
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>
                                    {{$product->name}}
                                </td>
                                <td>
                                    {{$product->price}}
                                </td>
                                <td>
                                    <a href="/product/update/{{$product->id}}" class="btn btn-primary">Edit</a>
                                    <a href="/product/delete/{{$product->id}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#list-table').DataTable();
        });
    </script>
</body>

</html>
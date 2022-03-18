<!DOCTYPE html>
<html lang="en">


@include('public')
<body>
    <div class="SectionB">

        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Inventory Records</h1>
                <a href="/inventory/create" class="btn btn-primary">Create</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="list-table">
                        <thead class=" text-primary">
                            <tr>
                                <th>
                                    Product Id
                                </th>
                                <th>
                                    Product Name
                                </th>
                                <th>
                                    Quantity
                                </th>
                                <th>
                                    Unit Price
                                </th>
                                <th>
                                    Total Price
                                </th>
                                <th>
                                    Type
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inventory as $item)
                            <tr>
                                <td>
                                    {{$item->id}}
                                </td>
                                <td>
                                    {{$item->product_name}}
                                </td>
                                <td>
                                    {{$item->quantity}}
                                </td>
                                <td>
                                    {{$item->unit_price}}
                                </td>
                                <td>
                                    {{$item->total_price}}
                                </td>
                                <td>
                                    {{ucfirst(str_replace('_',' ',$item->type))}}
                                </td>
                                <td>
                                    <a href="/inventory/update/{{$item->id}}" class="btn btn-primary">Edit</a>
                                    <a href="/inventory/delete/{{$item->id}}" class="btn btn-danger">Delete</a>
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
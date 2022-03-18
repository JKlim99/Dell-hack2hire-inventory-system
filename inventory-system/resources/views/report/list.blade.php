<!DOCTYPE html>
<html lang="en">

@include('public')
<body>

    <div class="SectionB">

        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Report Properties</h1>
            </div>

            <div class="card-body">
                <div class="btn-group mb-4">
                    <form action="/report/create" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="input-group">
                        <select class="form-control mr-4" name="column_name" id="column_name">
                            <option value="Product name">Product name</option>
                            <option value="Unit price">Unit price</option>
                            <option value="Stock count">Stock count</option>
                            <option value="Stock status">Stock status</option>
                            <option value="Stock in">Stock in</option>
                            <option value="Stock out">Stock out</option>
                          </select>
                          <input type="submit" class="btn btn-primary" value="Add">
                        </div>
                        </div>
                    </form>
                    
                  </div>
                <div class="table-responsive">
                    <table class="table" id="list-table">
                        
                        <thead class="text-primary">
                            <tr>
                                <th>
                                    Properties
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($report as $item)
                            <tr>
                                <td>
                                    {{$item->column_name}}
                                </td>
                                <td>
                                    <a href="/report/delete/{{$item->id}}" class="btn btn-danger">Delete</a>
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
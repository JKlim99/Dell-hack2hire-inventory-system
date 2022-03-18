<!DOCTYPE html>
<html lang="en">

@include('public')
<body>

    <div class="SectionB">

        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Inventory Report</h1>
                <form action="/invreport/list">
                    <input type="date" name="dateStart" id="dateStart" value="{{$dateStart}}" onchange="onChangeStartDate()"/>
                    <input type="date" name="dateEnd" id="dateEnd" value="{{$dateEnd}}" onchange="onChangeEndDate()"/>
                    <input type="submit" value="Filter" class="btn btn-primary"/>
                    <a href="/invreport/list" class="btn btn-secondary">clear</a>
                </form>
                <form action="/invreport/export">
                    <input type="hidden" name="dateStart" id="dateStartHidden" value="{{$dateStart}}"/>
                    <input type="hidden" name="dateEnd" id="dateEndHidden" value="{{$dateEnd}}"/>
                    <input type="submit" value="Export" class="btn btn-success"/>
                </form>
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
                                    Unit Price
                                </th>
                                <th>
                                    Stock In
                                </th>
                                <th>
                                    Stock Out
                                </th>
                                <th>
                                    Stock Count
                                </th>
                                <th>
                                    Stock Status
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($records as $record)
                            <tr>
                                <td>
                                    {{$record->product_name}}
                                </td>
                                <td>
                                    {{$record->unit_price}}
                                </td>
                                <td>
                                    {{$record->stock_in}}
                                </td>
                                <td>
                                    {{$record->stock_out}}
                                </td>
                                <td>
                                    {{$record->stock_count}}
                                </td>
                                <td>
                                    {{$record->stock_status}}
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
        function onChangeStartDate() {
            var x = document.getElementById("dateStart").value;
            document.getElementById("dateStartHidden").value = x;
        }
        function onChangeEndDate() {
            var x = document.getElementById("dateEnd").value;
            document.getElementById("dateEndHidden").value = x;
        }
    </script>
</body>

</html>
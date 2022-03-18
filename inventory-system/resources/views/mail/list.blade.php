<!DOCTYPE html>
<html lang="en">

@include('public')
<body>
    <div class="SectionB">

        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Mail List View</h1>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="list-table">
                        <thead class="text-primary">
                            <tr>
                                <th>
                                    Subject
                                </th>
                                <th>
                                    Sender
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Created On
                                </th>
                                <th>
                                    Last Updated
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mailList as $mail)
                            <tr>
                                <td>
                                    {{$mail->subject}}
                                </td>
                                <td>
                                    {{$mail->sender}}
                                </td>
                                <td>
                                    {{$mail->status}}
                                </td>
                                <td>
                                    {{$mail->created_at}}
                                </td>
                                <td>
                                    {{$mail->updated_at}}
                                </td>
                                <td>
                                    <a href="/mail/list/{{$mail->id}}" class="btn btn-primary">View details</a>
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
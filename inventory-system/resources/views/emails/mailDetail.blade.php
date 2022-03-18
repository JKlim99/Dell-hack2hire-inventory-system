<!DOCTYPE html>
<html lang="en">
@include('public')

<style>
    .headerB {
        width: 100%;
        top: 0;
        padding: 20px;
    }

    .headerB .location {
        text-align: left;
    }

    .container {
        position: absolute;
        text-align: center;
        margin-top: 0.5ch;
        right: 0.5ch;
        border-radius: 0.5ch;
        min-width: 84%;
        max-width: 84%;
        max-height: 99%;
        min-height: 99%;
        background: #f0f8ff;
    }

    .table_container {
        background: #ffee9a;
        padding: 4ch;
        border-radius: 1ch;
    }

    table {
        width: 100%;
        text-align: left;

    }

    .right {
        width: 85%;
    }

    .blank_row {
        height: 30px;
    }
</style>

<body>
    <div class="SectionB">

        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Email details</h1>
            </div>

            <div class="card-body">
                <label for="product-name">Subject</label>
                <input type="text" class="form-control" value="{{$mail->subject}}" disabled>
                <label for="product-name">Sender</label>
                <input type="text" class="form-control" value="{{$mail->sender}}" disabled>
                <label for="product-name">Body</label>
                <textarea class="form-control" rows="10" disabled>{{$mail->body}}</textarea>
                <label for="product-name">Status</label>
                <input type="text" class="form-control" value="{{$mail->status}}" disabled>
                <br/>
                <label for="product-name">Attachments</label>
                <ul>
                    @foreach($attachments as $attachment)
                    <li>
                        <a href="{{'/mail/download/'.$attachment->file_name}}" target="_blank">{{$attachment->file_name}}</a>
                    </li>
                    @endforeach
                </ul>
                <br/>
                <a href="/mail/list" class="btn btn-secondary">Back to list</a>
            </div>
        </div>
    </div>

</body>

</html>
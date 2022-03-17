<p>
    Hi, we have found your attachment(s) from previous email has some issue on the data, please check on them below:
</p>
<p>
    File reference: {{$filename}}
</p>
<table>
    <tr>
        <td>
            Product name
        </td>
        <td>
            Unit price
        </td>
        <td>
            Total price
        </td>
        <td>
            Quantity
        </td>
        <td>
            Type
        </td>
        <td>
            Reason
        </td>
    </tr>
    @foreach($exceptions as $exception)
        <tr>
            <td>
                {{$exception->product_name}}
            </td>
            <td>
                {{$exception->unit_price}}
            </td>
            <td>
                {{$exception->total_price}}
            </td>
            <td>
                {{$exception->quantity}}
            </td>
            <td>
                {{$exception->type}}
            </td>
            <td>
                {{$exception->reason}}
            </td>
        </tr>
    @endforeach
</table>
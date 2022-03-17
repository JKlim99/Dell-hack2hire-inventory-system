<style>
    .uper {
      margin-top: 40px;
    }
  </style>
  <div class="uper">
    @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}  
      </div><br />
    @endif
    <table class="table table-striped">
      <thead>
          <tr>
            <td>ID</td>
            <td>Game Name</td>
            <td>Game Price</td>
            <td colspan="2">Action</td>
          </tr>
      </thead>
      <tbody>
          @foreach($inventory as $item)
          <tr>
              <td>{{$item->product_id}}</td>
              <td>{{$item->product_name}}</td>
              <td>{{$item->price}}</td>
              <td>
                    <button class="btn btn-danger" type="submit">Delete</button>
                  </form>
              </td>
          </tr>
          @endforeach
      </tbody>
    </table>
  <div>
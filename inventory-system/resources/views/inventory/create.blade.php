<div class="card uper">
    <div class="card-header">
      Add Games Data
    </div>
    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div><br />
      @endif
        <form method="post" action="/inventory/store">
            <div class="form-group">
                @csrf
                <label for="country_name">Game Name:</label>
                <input type="text" class="form-control" name="product_id"/>
            </div>
            <div class="form-group">
                <label for="cases">Price :</label>
                <input type="text" class="form-control" name="product_name"/>
            </div>
            <div class="form-group">
                <label for="cases">Price :</label>
                <input type="text" class="form-control" name="unit_price"/>
            </div>
            <div class="form-group">
                <label for="cases">Price :</label>
                <input type="text" class="form-control" name="total_price"/>
            </div>
            <div class="form-group">
                <label for="cases">Price :</label>
                <input type="text" class="form-control" name="quantity"/>
            </div>
            <div class="form-group">
                <label for="cases">Price :</label>
                <input type="text" class="form-control" name="type"/>
            </div>
            <button type="submit" class="btn btn-primary">Add Game</button>
        </form>
    </div>
  </div>
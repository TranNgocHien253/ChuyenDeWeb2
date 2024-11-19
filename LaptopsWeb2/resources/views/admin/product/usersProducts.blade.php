<!doctype html>
<html lang="en">
  <head>
    <title>Product List</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container my-4">
      <h1 class="text-center mb-4">Danh sách Sản phẩm</h1>

      <!-- Search Bar -->
      <form method="GET" action="{{ route('product.seach') }}" class="mb-4">
        <div class="input-group">
          <input type="text" class="form-control" name="search" placeholder="Tìm kiếm sản phẩm..." value="{{ request()->get('search') }}">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
          </div>
        </div>
      </form>

      <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-4">
          <div class="card" style="background-color: cadetblue; border-color: darkblue;">
            <img class="card-img-top" src="data:image;base64,{{ $product->image }}" alt="image">
            <div class="card-body">
              <h4 class="card-title">{{ $product->name }}</h4>
              <p class="card-text">{{ $product->description }}</p>
              <p class="card-text"><strong>Giá: {{ number_format($product->unit_price) }} VND</strong></p>
              <a href="#" class="btn btn-primary">Xem Chi Tiết</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <!-- Pagination -->
      <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </body>
</html>

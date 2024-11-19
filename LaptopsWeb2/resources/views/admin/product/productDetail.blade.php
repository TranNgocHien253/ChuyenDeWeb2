<!doctype html>
<html lang="en">
  <head>
    <title>Chi Tiết Sản Phẩm</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container my-4">
      <h1 class="text-center mb-4">Chi Tiết Sản Phẩm</h1>
      <div class="card">
        <img class="card-img-top" src="data:image;base64,{{ $product->image }}" alt="{{ $product->name }}">
        <div class="card-body">
          <h4 class="card-title">{{ $product->name }}</h4>
          <p class="card-text"><strong>Mô Tả:</strong> {{ $product->description }}</p>
          <p class="card-text"><strong>Giá:</strong> {{ number_format($product->unit_price) }} VND</p>
          <a href="{{ url()->previous() }}" class="btn btn-secondary">Quay Lại</a>
          
        </div>
      </div>
    </div>
  
    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </body>
</html>

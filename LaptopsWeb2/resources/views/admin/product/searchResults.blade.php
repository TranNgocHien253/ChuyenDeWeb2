{{-- <!doctype html>
<html lang="en">
  <head>
    <title>Kết Quả Tìm Kiếm</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container my-4">
      <h1 class="text-center mb-4">Kết Quả Tìm Kiếm</h1>

      @if($products->isEmpty())
        <p class="text-center">Không tìm thấy sản phẩm nào khớp với từ khóa: <strong>{{ $keyword }}</strong>.</p>
      @else
        <div class="row">
          @foreach($products as $product)
          <div class="col-md-4 mb-4">
            <div class="card" style="background-color: cadetblue; border-color: darkblue;">
              <img class="card-img-top" src="data:image;base64,{{ $product->image }}" alt="image">
              <div class="card-body">
                <h4 class="card-title">{{ $product->name }}</h4>
                <p class="card-text">{{ $product->description }}</p>
                <p class="card-text"><strong>Giá: 200,000 VND</strong></p>
                <a href="{{ route('product.detail', $product->id) }}" class="btn btn-primary">Xem Chi Tiết</a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </body>
</html> --}}

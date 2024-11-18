<!doctype html>
<html lang="en">
  <head>
    <title>Product List</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container my-4">
      <h1 class="text-center mb-4">Danh sách Sản phẩm</h1>
      <div class="row">
        
        <!-- Card Sản phẩm 1 -->
        @foreach($products as $key => $product)
        <div class="col-md-4 mb-4">
          <div class="card" style="background-color: cadetblue; border-color: darkblue;">
            <img class="card-img-top" src="data:image;base64,{{ $product->image }}" alt="image">
            <div class="card-body">
              <h4 class="card-title">{{ $product->name }}</h4>
              <p class="card-text">{{$product->description}}</p>
              <p class="card-text"><strong>Giá: 200,000 VND</strong></p>
              <a href="#" class="btn btn-primary">Xem Chi Tiết</a>
            </div>
          </div>
        </div>
      @endforeach
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

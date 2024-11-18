<!-- resources/views/products/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        .product-card {
            border: 1px solid #e3e3e3;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            margin: 10px;
        }
        .product-image {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .product-name {
            font-size: 1.2em;
            font-weight: bold;
            margin: 10px 0;
        }
        .product-price {
            color: red;
            font-size: 1.2em;
            font-weight: bold;
        }
        .product-sales {
            color: #666;
        }
        .category-bar {
            display: flex;
            overflow-x: auto;
            gap: 10px;
            padding: 10px 0;
        }
        .category-bar button {
            background: #eee;
            border: none;
            border-radius: 20px;
            padding: 5px 15px;
        }
        .category-bar .active {
            background: #6f42c1;
            color: white;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Thanh tìm kiếm và đăng nhập -->
    <div class="d-flex justify-content-between align-items-center py-3">
        <form class="d-flex" action="{{ route('products.index') }}" method="GET">
            <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </form>
        <a href="#" class="btn btn-primary">Login</a>
    </div>

    <!-- Danh mục sản phẩm -->
    <div class="category-bar">
        <button class="active">All</button>
        <button>Sport</button>
        <button>Clothes</button>
        <button>Anime & Comic</button>
        <button>Video game</button>
        <button>Family</button>
        <button>Food</button>
    </div>

    <!-- Danh sách sản phẩm -->
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 col-lg-3">
                <div class="product-card">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="product-image">
                    <div class="product-name">{{ $product->name }}</div>
                    <div class="product-price">${{ number_format($product->price, 2) }}</div>
                    <div class="product-sales">{{ number_format($product->sales) }} Sales</div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>

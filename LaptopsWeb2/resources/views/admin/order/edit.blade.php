@extends('app')

@section('title', 'Sửa Đơn Hàng')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Đơn Hàng</title>
    <link rel="stylesheet" href="{{ asset('css/orders2.css') }}">
    <style>
        /* Form styling */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .order-form {
            width: 100%;
            border: 1px solid #003366;
            border-radius: 10px;
            padding: 20px;
            background-color: white;
        }

        .form-title {
            text-align: center;
            margin-bottom: 20px;
            color: black;
            font-size: 1.5em;
            font-weight: bold;
        }

        .info-header {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 15px;
            color: #003366;
        }

        .form-group-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .form-group {
            width: 48%;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-group input[readonly] {
            background-color: #e9ecef;
        }

        .form-actions {
            text-align: right;
            margin-top: 20px;
        }

        .form-actions button {
            padding: 10px 20px;
            margin: 0 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
        }

        .cancel-btn {
            background-color: red;
        }

        .submit-btn {
            background-color: #0b08ab;
        }

        .error-message {
            color: red;
            font-size: 0.8em;
        }
    </style>
</head>

<body>
    <div class="container">
        <form action="{{ route('admin.order.update', $order->id) }}" method="POST" onsubmit="return validateForm()">
            @csrf
            @method('PUT')
            <div class="order-form">
                <div class="info-header">Thông Tin Chung:</div>

                <div class="form-group-row">
                    <div class="form-group">
                        <label for="category">Danh Mục:</label>
                        <select id="category" name="category_id">
                            <option value="">Chọn danh mục</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" data-products="{{ json_encode($category->products) }}" {{ $order->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name_type }}
                                </option>
                            @endforeach
                        </select>
                        <div id="category-error" class="error-message" style="display: none;">Vui lòng chọn danh mục!</div>
                    </div>

                    <div class="form-group">
                        <label for="product">Tên sản phẩm:</label>
                        <select id="product" name="product_id">
                            <option value="">Chọn sản phẩm</option>
                            @foreach($order->category->products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->unit_price }}" {{ $order->product_id == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                        <div id="product-error" class="error-message" style="display: none;">Vui lòng chọn sản phẩm!</div>
                    </div>
                </div>

                <div class="form-group-row">
                    <div class="form-group">
                        <label for="recipient">Người nhận:</label>
                        <input type="text" id="recipient" name="name" value="{{ $order->name }}" required>
                        <div id="recipient-error" class="error-message" style="display: none;">Tên người nhận không được để trống và phải có độ dài từ 1 đến 255 ký tự!</div>
                    </div>
                    <div class="form-group">
                        <label for="price">Giá Tiền:</label>
                        <input type="number" id="price" name="price" value="{{ $order->product->unit_price }}" readonly>
                    </div>
                </div>

                <div class="form-group-row">
                    <div class="form-group">
                        <label for="phone">Số điện thoại:</label>
                        <input type="text" id="phone" name="phone" value="{{ $order->phone }}" required>
                        <div id="phone-error" class="error-message" style="display: none;">Số điện thoại không hợp lệ phải theo định dạng(+84|0 xxxxxxxxx)!</div>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Số Lượng:</label>
                        <input type="number" id="quantity" name="quantity" value="{{ $order->quantity }}" required>
                        <div id="quantity-error" class="error-message" style="display: none;">Số lượng không được âm!</div>
                    </div>
                </div>

                <div class="form-group-row">
                    <div class="form-group">
                        <label for="address">Địa chỉ:</label>
                        <input type="text" id="address" name="address" value="{{ $order->address }}" required>
                        <div id="address-error" class="error-message" style="display: none;">Địa chỉ không được để trống và phải có độ dài từ 1 đến 255 ký tự!</div>
                    </div>
                    <div class="form-group">
                        <label for="total">Tổng Tiền:</label>
                        <input type="text" id="total" name="total" value="{{ $order->total }}" readonly>
                    </div>
                </div>

                <div class="form-group-row">
                    <div class="form-group">
                        <label for="date">Ngày Sửa:</label>
                        <input type="text" id="date" name="updated_at" value="{{ now()->format('d/m/Y') }}" readonly>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.order.index') }}" class="cancel-btn">Hủy</a>
                    <button type="submit" class="submit-btn" id="submit-btn" disabled>Sửa</button>
                </div>
            </div>
        </form>
    </div>

    <script src="{{ asset('js/orders_edit.js') }}"></script>
</body>

</html>
@endsection
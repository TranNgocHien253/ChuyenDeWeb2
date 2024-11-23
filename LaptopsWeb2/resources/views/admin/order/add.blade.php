@extends('app')

@section('title', 'Thêm Đơn Hàng')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Đơn Hàng</title>
    <link rel="stylesheet" href="{{ asset('css/orders2.css') }}">
    <style>
        /* Styles for the alert */
        .alert {
            position: fixed;
            bottom: -100px;
            right: 20px;
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 4px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transition: all 0.5s ease-out, opacity 0.5s ease-out;
            z-index: 1000;
        }

        .alert-show {
            bottom: 20px;
            opacity: 1;
        }

        .alert-hide {
            bottom: -100px;
            opacity: 0;
        }

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

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<body>
    <div class="container">
        <form action="{{ route('admin.order.store') }}" method="POST" onsubmit="return validateForm()">
            @csrf
            <div class="order-form">
                <div class="form-title">Thêm Đơn Hàng</div>
                <div class="info-header">Thông Tin Chung:</div>

                <!-- Form Group Row 1 -->
                <div class="form-group-row">
                    <div class="form-group">
                        <label for="category">Danh Mục:</label>
                        <select id="category" name="category_id">
                            <option value="">Chọn danh mục</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" data-products="{{ json_encode($category->products) }}">
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
                        </select>
                        <div id="product-error" class="error-message" style="display: none;">Vui lòng chọn sản phẩm!</div>
                    </div>
                </div>

                <!-- Form Group Row 2 -->
                <div class="form-group-row">
                    <div class="form-group">
                        <label for="recipient">Người nhận:</label>
                        <input type="text" id="recipient" name="name" required>
                        <div id="recipient-error" class="error-message" style="display: none;">Tên người nhận không được để
                            trống và phải có độ dài từ 1 đến 255 ký tự!</div>
                    </div>
                    <div class="form-group">
                        <label for="price">Giá Tiền:</label>
                        <input type="number" id="price" name="price" readonly>
                    </div>
                </div>

                <!-- Form Group Row 3 -->
                <div class="form-group-row">
                    <div class="form-group">
                        <label for="phone">Số điện thoại:</label>
                        <input type="text" id="phone" name="phone" required>
                        <div id="phone-error" class="error-message" style="display: none;">Số điện thoại không hợp lệ phải
                            theo định dạng(+84|0 xxxxxxxxx)!</div>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Số Lượng:</label>
                        <input type="number" id="quantity" name="quantity" required>
                        <div id="quantity-error" class="error-message" style="display: none;">Số lượng lớn hơn 0!</div>
                    </div>
                </div>

                <!-- Form Group Row 4 -->
                <div class="form-group-row">
                    <div class="form-group">
                        <label for="address">Địa chỉ:</label>
                        <input type="text" id="address" name="address" required>
                        <div id="address-error" class="error-message" style="display: none;">Địa chỉ không được để trống và
                            phải có độ dài từ 1 đến 255 ký tự!</div>
                    </div>
                    <div class="form-group">
                        <label for="total">Tổng Tiền:</label>
                        <input type="text" id="total" name="total" readonly>
                    </div>
                </div>

                <!-- Form Group Row 5 -->
                <div class="form-group-row">
                    <div class="form-group">
                        <label for="date">Ngày Tạo:</label>
                        <input type="text" id="date" name="created_at" readonly>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.order.index') }}" class="cancel-btn">Hủy</a>
                    <button type="submit" class="submit-btn">Thêm</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        // Đặt ngày hiện tại làm ngày tạo
document.getElementById('date').value = new Date().toLocaleDateString('vi-VN');

// Cập nhật danh sách sản phẩm theo danh mục được chọn
document.getElementById('category').addEventListener('change', function () {
    var productSelect = document.getElementById('product');
    productSelect.innerHTML = '<option value="">Chọn sản phẩm</option>'; // Xóa các tùy chọn hiện có

    // Lấy danh sách sản phẩm từ danh mục được chọn
    var products = JSON.parse(this.selectedOptions[0].getAttribute('data-products') || '[]');

    products.forEach(function (product) {
        var option = document.createElement('option');
        option.value = product.id;
        option.textContent = product.name;
        option.setAttribute('data-price', product.price); // Lưu giá sản phẩm dưới dạng thuộc tính
        productSelect.appendChild(option);
    });
});

// Hiển thị giá khi chọn sản phẩm
document.getElementById('product').addEventListener('change', function () {
    var selectedOption = this.selectedOptions[0];
    var priceInput = document.getElementById('price');

    if (selectedOption) {
        var price = selectedOption.getAttribute('data-price'); // Lấy giá sản phẩm
        priceInput.value = price; // Hiển thị giá trong ô nhập
        calculateTotal(); // Tính lại tổng tiền
    } else {
        priceInput.value = ''; // Xóa giá nếu không chọn sản phẩm
    }
});

// Kiểm tra số lượng và tính tổng tiền
document.getElementById('quantity').addEventListener('input', function () {
    var quantity = parseInt(this.value);
    var errorMessage = document.getElementById('quantity-error');

    if (quantity <= 0 || isNaN(quantity)) {
        errorMessage.style.display = 'block'; // Hiển thị thông báo lỗi
    } else {
        errorMessage.style.display = 'none'; // Ẩn thông báo lỗi
        calculateTotal(); // Tính tổng tiền
    }
});

// Xóa khoảng trắng khi nhập số điện thoại
document.getElementById('phone').addEventListener('input', function () {
    this.value = this.value.replace(/\s/g, '');
});

// Ngăn chặn nhập chuỗi chỉ có khoảng trắng ở trường "Họ tên"
document.getElementById('recipient').addEventListener('input', function () {
    var recipient = this.value.trim();
    var errorMessage = document.getElementById('recipient-error');

    if (recipient.length === 0) {
        errorMessage.style.display = 'block'; // Hiển thị lỗi
    } else {
        errorMessage.style.display = 'none'; // Ẩn lỗi
    }
});

// Ngăn chặn nhập chuỗi chỉ có khoảng trắng ở trường "Địa chỉ"
document.getElementById('address').addEventListener('input', function () {
    var address = this.value.trim();
    var errorMessage = document.getElementById('address-error');

    if (address.length === 0) {
        errorMessage.style.display = 'block'; // Hiển thị lỗi
    } else {
        errorMessage.style.display = 'none'; // Ẩn lỗi
    }
});

// Tính tổng tiền
function calculateTotal() {
    var price = parseFloat(document.getElementById('price').value) || 0;
    var quantity = parseInt(document.getElementById('quantity').value) || 0;
    var total = price * quantity;
    document.getElementById('total').value = total; // Hiển thị tổng tiền
}

// Kiểm tra toàn bộ form
function validateForm() {
    var recipient = document.getElementById('recipient').value.trim();
    var address = document.getElementById('address').value.trim();
    var category = document.getElementById('category').value;
    var product = document.getElementById('product').value;
    var phone = document.getElementById('phone').value;
    var quantity = parseInt(document.getElementById('quantity').value);
    var isValid = true;

    // Reset thông báo lỗi
    document.getElementById('recipient-error').style.display = 'none';
    document.getElementById('address-error').style.display = 'none';
    document.getElementById('category-error').style.display = 'none';
    document.getElementById('product-error').style.display = 'none';
    document.getElementById('phone-error').style.display = 'none';
    document.getElementById('quantity-error').style.display = 'none';

    // Kiểm tra "Họ tên"
    if (recipient.length === 0) {
        document.getElementById('recipient-error').style.display = 'block';
        isValid = false;
    }

    // Kiểm tra "Địa chỉ"
    if (address.length === 0) {
        document.getElementById('address-error').style.display = 'block';
        isValid = false;
    }

    // Kiểm tra danh mục
    if (!category) {
        document.getElementById('category-error').style.display = 'block';
        isValid = false;
    }

    // Kiểm tra sản phẩm
    if (!product) {
        document.getElementById('product-error').style.display = 'block';
        isValid = false;
    }

    // Kiểm tra số điện thoại
    var phoneRegex = /^(0|\+84)([0-9]{9})$/;
    if (!phoneRegex.test(phone)) {
        document.getElementById('phone-error').style.display = 'block';
        isValid = false;
    }

    // Kiểm tra số lượng
    if (quantity <= 0 || isNaN(quantity)) {
        document.getElementById('quantity-error').style.display = 'block';
        isValid = false;
    }

    return isValid; // Chặn gửi form nếu không hợp lệ
}

// Gắn sự kiện validateForm vào submit form
document.getElementById('order-form').addEventListener('submit', function (e) {
    if (!validateForm()) {
        e.preventDefault(); // Ngăn chặn form gửi nếu không hợp lệ
    }
});

    </script>
        
    </body>
    </html>
@endsection
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Đơn Hàng</title>
    <link rel="stylesheet" href="{{ asset('css/orders2.css') }}">
</head>

<body>
    <form action="{{ route('admin.order.store') }}" method="POST" onsubmit="return validateForm()">
        @csrf
        <div class="order-form">
            <div class="info-header">Thông Tin Chung:</div>

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

            <!-- Second row -->
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

            <!-- Third row -->
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

            <!-- Fourth row -->
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

            <!-- Fifth row -->
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
    <script src="{{asset('js/orders2_add.js')}}"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Đơn Hàng</title>
    <link rel="stylesheet" href="{{ asset('css/orders2.css') }}">
    <style>
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
    </style>
</head>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

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
    <script src="{{asset('js/orders_add.js')}}"></script>
    <script>
        // Load product options based on selected category
        document.getElementById('category').addEventListener('change', function () {
            var productSelect = document.getElementById('product');
            var priceInput = document.getElementById('price');
            productSelect.innerHTML = '<option value="">Chọn sản phẩm</option>'; // Clear existing options
            priceInput.value = ''; // Clear price when category changes

            // Get the selected category's products data
            var products = JSON.parse(this.selectedOptions[0].getAttribute('data-products') || '[]');

            // Populate the product dropdown
            products.forEach(function (product) {
                var option = document.createElement('option');
                option.value = product.id;
                option.textContent = product.name;
                option.setAttribute('data-price', product.unit_price); // Store product price as a data attribute
                productSelect.appendChild(option);
            });
        });

        document.getElementById('product').addEventListener('change', function () {
            var selectedOption = this.selectedOptions[0];
            var priceInput = document.getElementById('price');

            if (selectedOption) {
                var price = selectedOption.getAttribute('data-price'); // Get product price
                priceInput.value = price; // Set price in the input field
                calculateTotal(); // Recalculate total when product changes
            } else {
                priceInput.value = ''; // Clear price if no product is selected
            }
        });

        document.getElementById('quantity').addEventListener('input', function () {
            var quantity = parseInt(this.value);
            var errorMessage = document.getElementById('quantity-error');

            if (quantity < 0 || quantity === 0) {
                errorMessage.style.display = 'block'; // Show error message
            } else {
                errorMessage.style.display = 'none'; // Hide error message
                calculateTotal(); // Calculate total when quantity is valid
            }
        });

        document.getElementById('phone').addEventListener('input', function () {
            // Remove spaces from the input value
            this.value = this.value.replace(/\s/g, '');
        });

        function calculateTotal() {
            var price = parseFloat(document.getElementById('price').value) || 0;
            var quantity = parseInt(document.getElementById('quantity').value) || 0;
            var total = price * quantity;
            document.getElementById('total').value = total; // Set total in the input field
        }

        function validateForm() {
            var recipient = document.getElementById('recipient').value;
            var address = document.getElementById('address').value;
            var category = document.getElementById('category').value;
            var product = document.getElementById('product').value;
            var phone = document.getElementById('phone').value;
            var quantity = parseInt(document.getElementById('quantity').value);
            var isValid = true;

            // Reset error messages
            document.getElementById('recipient-error').style.display = 'none';
            document.getElementById('address-error').style.display = 'none';
            document.getElementById('category-error').style.display = 'none';
            document.getElementById('product-error').style.display = 'none';
            document.getElementById('phone-error').style.display = 'none';
            document.getElementById('quantity-error').style.display = 'none'; // Reset quantity error

            // Validate recipient
            if (recipient.length < 1 || recipient.length > 255) {
                document.getElementById('recipient-error').style.display = 'block';
                isValid = false;
            }

            // Validate address
            if (address.length < 1 || address.length > 255) {
                document.getElementById('address-error').style.display = 'block';
                isValid = false;
            }

            // Validate category
            if (!category) {
                document.getElementById('category-error').style.display = 'block';
                isValid = false;
            }

            // Validate product
            if (!product) {
                document.getElementById('product-error').style.display = 'block';
                isValid = false;
            }

            // Validate phone number
            var phoneRegex = /^(0|\+84)([0-9]{9})$/;
            if (!phoneRegex.test(phone)) {
                document.getElementById('phone-error').style.display = 'block';
                isValid = false;
            }

            // Validate quantity
            if (quantity <= 0) {
                document.getElementById('quantity-error').style.display = 'block'; // Show error message
                isValid = false; // Prevent form submission
            }

            return isValid; // Prevent form submission if validation fails
        }
        document.addEventListener('DOMContentLoaded', function () {
            const alert = document.querySelector('.alert');

            if (alert) {
                // Hiển thị thông báo
                setTimeout(function () {
                    alert.classList.add('alert-show');
                }, 100); // Đợi 100ms để thêm hiệu ứng xuất hiện

                // Ẩn thông báo sau 1.5 giây
                setTimeout(function () {
                    alert.classList.remove('alert-show');
                    alert.classList.add('alert-hide');
                }, 1500); // Hiển thị trong 1.5 giây

                // Sau 2 giây (kể từ khi bắt đầu ẩn), xóa thông báo khỏi DOM
                setTimeout(function () {
                    alert.remove();
                }, 2000); // Chờ thêm 500ms để hoàn thành quá trình ẩn
            }
        });
    </script>
</body>

</html>
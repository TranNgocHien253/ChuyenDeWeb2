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

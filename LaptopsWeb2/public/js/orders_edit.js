// Đặt ngày hiện tại làm ngày cập nhật
document.getElementById('date').value = new Date().toLocaleDateString('vi-VN');

// Lấy giá trị ban đầu để so sánh
const initialValues = {
    category: document.getElementById('category').value,
    product: document.getElementById('product').value,
    recipient: document.getElementById('recipient').value,
    phone: document.getElementById('phone').value,
    quantity: document.getElementById('quantity').value,
    address: document.getElementById('address').value
};

// Cập nhật sự kiện thay đổi danh mục
document.getElementById('category').addEventListener('change', function () {
    var productSelect = document.getElementById('product');
    productSelect.innerHTML = '<option value="">Chọn sản phẩm</option>'; // Xóa các tùy chọn hiện có

    // Lấy sản phẩm của danh mục được chọn
    var products = JSON.parse(this.selectedOptions[0].getAttribute('data-products') || '[]');

    products.forEach(function (product) {
        var option = document.createElement('option');
        option.value = product.id;
        option.textContent = product.name;
        option.setAttribute('data-price', product.unit_price); // Lưu đơn giá dưới dạng thuộc tính dữ liệu
        productSelect.appendChild(option);
    });
    checkForChanges(); // Kiểm tra thay đổi sau khi chọn danh mục
});

// Cập nhật sự kiện thay đổi sản phẩm
document.getElementById('product').addEventListener('change', function () {
    var selectedOption = this.selectedOptions[0];
    var priceInput = document.getElementById('price');

    if (selectedOption) {
        var price = selectedOption.getAttribute('data-price'); // Lấy giá sản phẩm từ thuộc tính dữ liệu
        priceInput.value = price; // Đặt giá vào ô nhập
        calculateTotal(); // Tính lại tổng khi thay đổi sản phẩm
    } else {
        priceInput.value = ''; // Xóa giá nếu không có sản phẩm được chọn
    }
    checkForChanges(); // Kiểm tra thay đổi
});

// Sự kiện nhập số lượng
document.getElementById('quantity').addEventListener('input', function () {
    var quantity = parseInt(this.value);
    var errorMessage = document.getElementById('quantity-error');

    if (quantity < 0 || quantity === 0) {
        errorMessage.style.display = 'block'; // Hiển thị thông báo lỗi
    } else {
        errorMessage.style.display = 'none'; // Ẩn thông báo lỗi
        calculateTotal(); // Tính tổng khi số lượng hợp lệ
    }
    checkForChanges(); // Kiểm tra thay đổi
});

// Sự kiện nhập số điện thoại
document.getElementById('phone').addEventListener('input', function () {
    this.value = this.value.replace(/\s/g, ''); // Xóa khoảng trắng
    checkForChanges(); // Kiểm tra thay đổi
});

// Sự kiện nhập cho tên người nhận và địa chỉ
document.getElementById('recipient').addEventListener('input', checkForChanges);
document.getElementById('address').addEventListener('input', checkForChanges);

// Hàm tính tổng
function calculateTotal() {
    var price = parseFloat(document.getElementById('price').value) || 0;
    var quantity = parseInt(document.getElementById('quantity').value) || 0;
    var total = price * quantity;
    document.getElementById('total').value = total; // Đặt tổng vào ô nhập
}

// Hàm kiểm tra thay đổi
function checkForChanges() {
    const currentValues = {
        category: document.getElementById('category').value,
        product: document.getElementById('product').value,
        recipient: document.getElementById('recipient').value,
        phone: document.getElementById('phone').value,
        quantity: document.getElementById('quantity').value,
        address: document.getElementById('address').value
    };

    // Kiểm tra nếu có bất kỳ giá trị nào đã thay đổi
    const hasChanged = Object.keys(initialValues).some(key => initialValues[key] !== currentValues[key]);
    const submitBtn = document.getElementById('submit-btn');

    if (hasChanged) {
        submitBtn.disabled = false; // Bật nút gửi
    } else {
        submitBtn.disabled = true; // Tắt nút gửi
    }
}

// Hàm kiểm tra tính hợp lệ của form
function validateForm() {
    var isValid = true;

    // Lấy giá trị từ các ô nhập
    var recipient = document.getElementById('recipient').value;
    var address = document.getElementById('address').value;
    var category = document.getElementById('category').value;
    var product = document.getElementById('product').value;
    var phone = document.getElementById('phone').value;
    var quantity = parseInt(document.getElementById('quantity').value, 10);

    // Kiểm tra tính hợp lệ của tên người nhận
    if (!recipient || recipient.length < 1 || recipient.length > 255) {
        document.getElementById('recipient-error').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('recipient-error').style.display = 'none';
    }

    // Kiểm tra tính hợp lệ của địa chỉ
    if (!address || address.length < 1 || address.length > 255) {
        document.getElementById('address-error').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('address-error').style.display = 'none';
    }

    // Kiểm tra tính hợp lệ của danh mục
    if (!category) {
        document.getElementById('category-error').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('category-error').style.display = 'none';
    }

    // Kiểm tra tính hợp lệ của sản phẩm
    if (!product) {
        document.getElementById('product-error').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('product-error').style.display = 'none';
    }

    // Kiểm tra định dạng của số điện thoại
    var phonePattern = /^(0|\+84)\d{9}$/;
    if (!phonePattern.test(phone)) {
        document.getElementById('phone-error').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('phone-error').style.display = 'none';
    }

    // Kiểm tra tính hợp lệ của số lượng
    if (quantity <= 0) {
        document.getElementById('quantity-error').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('quantity-error').style.display = 'none';
    }

    return isValid; // Chỉ gửi form nếu hợp lệ
}

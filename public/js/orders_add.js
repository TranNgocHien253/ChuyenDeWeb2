// Set the current date as the creation date
document.getElementById('date').value = new Date().toLocaleDateString('vi-VN');

document.getElementById('category').addEventListener('change', function () {
    var productSelect = document.getElementById('product');
    productSelect.innerHTML = '<option value="">Chọn sản phẩm</option>'; // Clear existing options

    // Get selected category's products
    var products = JSON.parse(this.selectedOptions[0].getAttribute('data-products') || '[]');

    products.forEach(function (product) {
        var option = document.createElement('option');
        option.value = product.id;
        option.textContent = product.name;
        option.setAttribute('data-price', product.price); // Store product price as a data attribute
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
// Set the current date as the update date
document.getElementById('date').value = new Date().toLocaleDateString('vi-VN');

// Get the initial values for comparison
const initialValues = {
    category: document.getElementById('category').value,
    product: document.getElementById('product').value,
    recipient: document.getElementById('recipient').value,
    phone: document.getElementById('phone').value,
    quantity: document.getElementById('quantity').value,
    address: document.getElementById('address').value
};

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
    checkForChanges(); // Check for changes after category selection
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
    checkForChanges(); // Check for changes
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
    checkForChanges(); // Check for changes
});

document.getElementById('phone').addEventListener('input', function () {
    // Remove spaces from the input value
    this.value = this.value.replace(/\s/g, '');
    checkForChanges(); // Check for changes
});

document.getElementById('recipient').addEventListener('input', checkForChanges);
document.getElementById('address').addEventListener('input', checkForChanges);

function calculateTotal() {
    var price = parseFloat(document.getElementById('price').value) || 0;
    var quantity = parseInt(document.getElementById('quantity').value) || 0;
    var total = price * quantity;
    document.getElementById('total').value = total; // Set total in the input field
}

function checkForChanges() {
    const currentValues = {
        category: document.getElementById('category').value,
        product: document.getElementById('product').value,
        recipient: document.getElementById('recipient').value,
        phone: document.getElementById('phone').value,
        quantity: document.getElementById('quantity').value,
        address: document.getElementById('address').value
    };

    // Check if any value has changed
    const hasChanged = Object.keys(initialValues).some(key => initialValues[key] !== currentValues[key]);
    const submitBtn = document.getElementById('submit-btn');

    if (hasChanged) {
        submitBtn.disabled = false; // Enable submit button
    } else {
        submitBtn.disabled = true; // Disable submit button
    }
}

function validateForm() {
    // Validate the form fields here
    var isValid = true;

    // Get values from input fields
    var recipient = document.getElementById('recipient').value;
    var address = document.getElementById('address').value;
    var category = document.getElementById('category').value;
    var product = document.getElementById('product').value;
    var phone = document.getElementById('phone').value;
    var quantity = parseInt(document.getElementById('quantity').value, 10);

    if (!recipient || recipient.length < 1 || recipient.length > 255) {
        document.getElementById('recipient-error').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('recipient-error').style.display = 'none';
    }

    if (!address || address.length < 1 || address.length > 255) {
        document.getElementById('address-error').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('address-error').style.display = 'none';
    }

    if (!category) {
        document.getElementById('category-error').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('category-error').style.display = 'none';
    }

    if (!product) {
        document.getElementById('product-error').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('product-error').style.display = 'none';
    }

    // Validate phone format (+84|0 xxxxxxxxx)
    var phonePattern = /^(0|\+84)\d{9}$/;
    if (!phonePattern.test(phone)) {
        document.getElementById('phone-error').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('phone-error').style.display = 'none';
    }

    // Validate quantity
    if (quantity <= 0) {
        document.getElementById('quantity-error').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('quantity-error').style.display = 'none';
    }

    return isValid; // Only submit form if valid
}
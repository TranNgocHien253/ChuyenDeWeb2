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

// Update category change event
document.getElementById('category').addEventListener('change', function () {
    var productSelect = document.getElementById('product');
    productSelect.innerHTML = '<option value="">Chọn sản phẩm</option>'; // Clear existing options

    // Get selected category's products
    var products = JSON.parse(this.selectedOptions[0].getAttribute('data-products') || '[]');

    products.forEach(function (product) {
        var option = document.createElement('option');
        option.value = product.id;
        option.textContent = product.name;
        option.setAttribute('data-price', product.unit_price); // Store unit price as a data attribute
        productSelect.appendChild(option);
    });
    checkForChanges(); // Check for changes after category selection
});

// Update product change event
document.getElementById('product').addEventListener('change', function () {
    var selectedOption = this.selectedOptions[0];
    var priceInput = document.getElementById('price');

    if (selectedOption) {
        var price = selectedOption.getAttribute('data-price'); // Get product price from data attribute
        priceInput.value = price; // Set price in the input field
        calculateTotal(); // Recalculate total when product changes
    } else {
        priceInput.value = ''; // Clear price if no product is selected
    }
    checkForChanges(); // Check for changes
});

// Quantity input event
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

// Phone input event
document.getElementById('phone').addEventListener('input', function () {
    this.value = this.value.replace(/\s/g, ''); // Remove spaces
    checkForChanges(); // Check for changes
});

// Input events for recipient and address
document.getElementById('recipient').addEventListener('input', checkForChanges);
document.getElementById('address').addEventListener('input', checkForChanges);

// Function to calculate total
function calculateTotal() {
    var price = parseFloat(document.getElementById('price').value) || 0;
    var quantity = parseInt(document.getElementById('quantity').value) || 0;
    var total = price * quantity;
    document.getElementById('total').value = total; // Set total in the input field
}

// Function to check for changes
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

// Function to validate the form
function validateForm() {
    var isValid = true;

    // Get values from input fields
    var recipient = document.getElementById('recipient').value;
    var address = document.getElementById('address').value;
    var category = document.getElementById('category').value;
    var product = document.getElementById('product').value;
    var phone = document.getElementById('phone').value;
    var quantity = parseInt(document.getElementById('quantity').value, 10);

    // Recipient validation
    if (!recipient || recipient.length < 1 || recipient.length > 255) {
        document.getElementById('recipient-error').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('recipient-error').style.display = 'none';
    }

    // Address validation
    if (!address || address.length < 1 || address.length > 255) {
        document.getElementById('address-error').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('address-error').style.display = 'none';
    }

    // Category validation
    if (!category) {
        document.getElementById('category-error').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('category-error').style.display = 'none';
    }

    // Product validation
    if (!product) {
        document.getElementById('product-error').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('product-error').style.display = 'none';
    }

    // Phone format validation
    var phonePattern = /^(0|\+84)\d{9}$/;
    if (!phonePattern.test(phone)) {
        document.getElementById('phone-error').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('phone-error').style.display = 'none';
    }

    // Quantity validation
    if (quantity <= 0) {
        document.getElementById('quantity-error').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('quantity-error').style.display = 'none';
    }

    return isValid; // Only submit form if valid
}

document.addEventListener('DOMContentLoaded', function() {
    const nameTypeInput = document.getElementById('name_type');
    const imageInput = document.getElementById('image');
    const submitBtn = document.getElementById('submit-btn');
    const nameTypeError = document.getElementById('name_type-error');
    const originalName = "{{ old('name_type', $typeProduct->name_type) }}";

    function checkFormChanges() {
        const currentName = nameTypeInput.value;
        const isChanged = currentName !== originalName || imageInput.files.length > 0;

        // Enable or disable the submit button based on changes
        submitBtn.disabled = !isChanged;
        
        // Show error if the name exceeds 255 characters
        if (currentName.length > 255) {
            nameTypeError.style.display = 'block';
            submitBtn.disabled = true; // Disable submit if name is too long
        } else {
            nameTypeError.style.display = 'none';
        }
    }

    nameTypeInput.addEventListener('input', checkFormChanges);
    imageInput.addEventListener('change', checkFormChanges);

    // Initialize button state
    checkFormChanges();
});

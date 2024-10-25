document.addEventListener('DOMContentLoaded', function() {
    const nameTypeInput = document.getElementById('name_type');
    const imageInput = document.getElementById('image');
    const submitBtn = document.getElementById('submit-btn');
    const originalName = "{{ old('name_type', $typeProduct->name_type) }}";

    function checkFormChanges() {
        const currentName = nameTypeInput.value;
        const isChanged = currentName !== originalName || imageInput.files.length > 0;

        submitBtn.disabled = !isChanged;
    }

    nameTypeInput.addEventListener('input', checkFormChanges);
    imageInput.addEventListener('change', checkFormChanges);

    // Initialize button state
    checkFormChanges();
});
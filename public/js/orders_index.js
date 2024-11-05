document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete');
    const popup = document.getElementById('deletePopup');
    let deleteForm = null;

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            deleteForm = this.closest('.delete-form');
            popup.style.display = 'block'; // Show popup
        });
    });

    document.getElementById('cancelDelete').addEventListener('click', function () {
        popup.style.display = 'none'; // Hide popup
    });

    document.getElementById('confirmDelete').addEventListener('click', function () {
        if (deleteForm) {
            deleteForm.submit(); // Submit the delete form
        }
    });
    // Handle change event for pagination select
    document.getElementById('perPage').addEventListener('change', function () {
        const selectedValue = this.value;
        // Redirect to the same page with the selected per page value
        window.location.href = `?perPage=${selectedValue}`;
    });
});
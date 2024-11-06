document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete');
    const popup = document.getElementById('deletePopup');
    let deleteForm = null;

    // Xử lý sự kiện khi nhấn nút xóa
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            deleteForm = this.closest('.delete-form');
            popup.style.display = 'block'; // Hiển thị popup
        });
    });

    // Hủy bỏ hành động xóa khi nhấn nút hủy
    document.getElementById('cancelDelete').addEventListener('click', function () {
        popup.style.display = 'none'; // Ẩn popup
    });

    // Xác nhận hành động xóa khi nhấn nút xác nhận
    document.getElementById('confirmDelete').addEventListener('click', function () {
        if (deleteForm) {
            deleteForm.submit(); // Gửi form xóa
        }
    });

    // Xử lý sự kiện thay đổi cho mục chọn phân trang
    document.getElementById('perPage').addEventListener('change', function () {
        const selectedValue = this.value;
        // Điều hướng đến cùng trang với giá trị số lượng trên mỗi trang đã chọn
        window.location.href = `?perPage=${selectedValue}`;
    });
});

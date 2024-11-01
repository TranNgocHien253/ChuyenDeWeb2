document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete');
    const popup = document.getElementById('deletePopup');
    let deleteForm = null;

    // Thêm sự kiện click cho các nút xóa
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            deleteForm = this.closest('.delete-form');
            popup.style.display = 'block'; // Hiển thị popup
        });
    });

    // Hủy bỏ hành động xóa
    document.getElementById('cancelDelete').addEventListener('click', function () {
        popup.style.display = 'none'; // Ẩn popup
    });

    // Xác nhận xóa
    document.getElementById('confirmDelete').addEventListener('click', function () {
        if (deleteForm) {
            deleteForm.submit(); // Gửi biểu mẫu xóa
        }
    });

    // Xử lý sự kiện thay đổi cho select phân trang
    document.getElementById('perPage').addEventListener('change', function () {
        const selectedValue = this.value;
        let url = new URL(window.location.href);
        
        // Thay đổi giá trị perPage trong URL mà không tải lại trang
        url.searchParams.set('perPage', selectedValue);
        
        // Điều hướng đến URL mới với các tham số đã thay đổi
        window.location.href = url;
    });
});

// Hàm xác nhận xóa loại sản phẩm
function confirmDelete(button) {
    const popup = document.getElementById('deletePopup');
    popup.classList.add('active'); // Thêm lớp active để hiển thị popup
    
    document.getElementById('confirmDelete').onclick = function() {
        button.parentElement.submit(); // Xác nhận xóa
    };

    document.getElementById('cancelDelete').onclick = function() {
        popup.classList.remove('active'); // Hủy bỏ popup
    };
}
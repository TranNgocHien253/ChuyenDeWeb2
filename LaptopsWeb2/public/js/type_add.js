function validateForm() {
    // Reset previous error messages
    document.getElementById('name_type-error').style.display = 'none';
    document.getElementById('image-error').style.display = 'none';

    // Get input values
    var nameType = document.getElementById('name_type').value.trim();
    var imageInput = document.getElementById('image');
    var imageFile = imageInput.files[0];

    // Check if name type is empty
    if (nameType === "") {
        document.getElementById('name_type-error').innerText = "Tên loại sản phẩm không được để trống!";
        document.getElementById('name_type-error').style.display = 'block';
        return false; // Prevent form submission
    }

    // Check if name type exceeds 255 characters
    if (nameType.length > 255) {
        document.getElementById('name_type-error').innerText = "Tên loại sản phẩm không được vượt quá 255 ký tự!";
        document.getElementById('name_type-error').style.display = 'block';
        return false; // Prevent form submission
    }

    // Check if an image file is selected
    if (!imageFile) {
        document.getElementById('image-error').innerText = "Vui lòng chọn hình ảnh hợp lệ!";
        document.getElementById('image-error').style.display = 'block';
        return false; // Prevent form submission
    }

    // Check if the image file is of type jpg or png
    var fileExtension = imageFile.name.split('.').pop().toLowerCase();
    if (fileExtension !== 'jpg' && fileExtension !== 'png') {
        document.getElementById('image-error').innerText = "Chỉ chấp nhận định dạng jpg hoặc png!";
        document.getElementById('image-error').style.display = 'block';
        return false; // Prevent form submission
    }

    return true; // Allow form submission
}

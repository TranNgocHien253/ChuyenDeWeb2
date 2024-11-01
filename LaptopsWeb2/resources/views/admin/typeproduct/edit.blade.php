<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Danh Mục Sản Phẩm</title>
    <link rel="stylesheet" href="{{ asset('css/type2.css') }}">
    <style>
        /* Style for the disabled button */
        .submit-btn:disabled {
            background-color: #ccc; /* Gray background */
            cursor: not-allowed; /* Change cursor to not-allowed */
        }

        .error-message {
            color: red; /* Red color for error messages */
            display: none; /* Hidden by default */
        }
    </style>
</head>

<body>
    <form action="{{ route('admin.typeproduct.update', $typeProduct->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="order-form">
            <div class="info-header">Thông Tin Danh Mục:</div>

            <div class="form-group-row">
                <div class="form-group">
                    <label for="name_type">Tên Danh Mục:</label>
                    <input type="text" id="name_type" name="name_type" 
                           value="{{ old('name_type', $typeProduct->name_type) }}" required>
                    <div id="name_type-error" class="error-message">Tên danh mục không được để trống!</div>
                </div>

                <div class="form-group">
                    <label for="image">Hình Ảnh:</label>
                    <input type="file" id="image" name="image" accept="image/png, image/jpeg">
                    <div id="image-error" class="error-message">Chỉ chấp nhận tệp hình ảnh PNG hoặc JPG!</div>
                    <img src="{{ asset($typeProduct->image) }}" alt="Hình Ảnh Danh Mục"
                         style="width: 100px; height: auto; display: {{ $typeProduct->image ? 'block' : 'none' }};">
                </div>
            </div>

            <div class="form-group-row">
                <div class="form-group">
                    <label for="updated_at">Ngày Cập Nhật:</label>
                    <input type="text" id="updated_at" name="updated_at"
                           value="{{ $typeProduct->updated_at->format('d/m/Y') }}" readonly>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.typeproduct.index') }}" class="cancel-btn">Hủy</a>
                <button type="submit" class="submit-btn" id="submit-btn" disabled>Sửa</button> <!-- Initially disabled -->
            </div>
        </div>
    </form>
    <script src="{{asset('js/type_edit.js')}}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nameTypeInput = document.getElementById('name_type');
            const imageInput = document.getElementById('image');
            const submitBtn = document.getElementById('submit-btn');
            const originalName = "{{ old('name_type', $typeProduct->name_type) }}";
            const imageError = document.getElementById('image-error');

            function checkFormChanges() {
                const currentName = nameTypeInput.value;
                const isChanged = currentName !== originalName || imageInput.files.length > 0;

                submitBtn.disabled = !isChanged; // Enable or disable submit button based on changes
                imageError.style.display = 'none'; // Hide image error message
            }

            nameTypeInput.addEventListener('input', checkFormChanges); // Listen for input changes
            imageInput.addEventListener('change', function() {
                const file = imageInput.files[0];
                const isValidImage = file && (file.type === 'image/jpeg' || file.type === 'image/png');

                if (!isValidImage) {
                    imageError.style.display = 'block'; // Show error message if file is invalid
                    imageInput.value = ''; // Clear the input
                    submitBtn.disabled = true; // Disable submit button
                } else {
                    imageError.style.display = 'none'; // Hide error message if file is valid
                    checkFormChanges(); // Check for changes to possibly enable the button
                }
            });

            // Initialize button state
            checkFormChanges(); // Check on page load
        });
    </script>
</body>

</html>

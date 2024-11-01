<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Loại Sản Phẩm</title>
    <link rel="stylesheet" href="{{ asset('css/type2.css') }}">
</head>

<body>
    <form action="{{ route('admin.typeproduct.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        @csrf
        <div class="order-form">
            <div class="info-header">Thông Tin Loại Sản Phẩm:</div>

            <div class="form-group-row">
                <div class="form-group">
                    <label for="name_type">Tên Loại Sản Phẩm:</label>
                    <input type="text" id="name_type" name="name_type" required>
                    <div id="name_type-error" class="error-message" style="display: none;">Tên loại sản phẩm không được để trống!</div>
                </div>

                <div class="form-group">
                    <label for="image">Hình Ảnh:</label>
                    <input type="file" id="image" name="image" accept="image/*">
                    <div id="image-error" class="error-message" style="display: none;">Vui lòng chọn hình ảnh hợp lệ!</div>
                </div>
            </div>

            <div class="form-group-row">
                <div class="form-group">
                    <label for="created_at">Ngày Tạo:</label>
                    <input type="text" id="created_at" name="created_at" value="{{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}" readonly>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.typeproduct.index') }}" class="cancel-btn">Hủy</a>
                <button type="submit" class="submit-btn">Thêm</button>
            </div>
        </div>
    </form>
    <script src="{{asset('js/type_add.js')}}"></script>
</body>

</html>

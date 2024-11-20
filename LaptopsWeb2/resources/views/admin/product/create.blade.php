@extends('app')

@section('title', 'Thêm Sản Phẩm Mới')

@section('content')
<style>
    .product-create-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    .product-create-container h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .submit-btn {
        width: 100%;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
    }
</style>
<div class="product-create-container">
    <h1>Thêm Sản Phẩm Mới</h1>

    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="id_type">Loại sản phẩm:</label>
            <select id="id_type" name="id_type" required>
                <option value="1">Loại 1</option>
                <option value="2">Loại 2</option>
                <!-- Các lựa chọn khác -->
            </select>
        </div>
        <div class="form-group">
            <label for="image">Hình ảnh:</label>
            <input type="file" id="image" name="image"  required>
        </div>
        <div class="form-group">
            <label for="name">Tên sản phẩm:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea id="description" name="description"></textarea>
        </div>

        <div class="form-group">
            <label for="unit_price">Giá Tiền:</label>
            <input type="number" id="unit_price" name="unit_price" required>
        </div>
        {{-- <div class="form-group">
            <label for="promotion_price">Tiền:</label>
            <input type="number" id="promotion_price" name="promotion_price" required>
        </div> --}}
        <div class="form-group">
            <label for="new">Hàng Mới:</label>
            <select name="new" class="border rounded px-3 py-2 w-full">
                <option value="1">Mới</option>
                <option value="0">Cũ</option>
            </select>
        </div>

        <button type="submit" class="submit-btn">Lưu Sản Phẩm</button>
    </form>

</div>
@endsection
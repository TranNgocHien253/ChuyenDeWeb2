@extends('app')

@section('title', 'Edit Product')

@section('content')
<div class="product-management-container">
    <h1>Chỉnh Sửa Sản Phẩm</h1>

    <form action="{{ route('admin.product.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label for="name">Tên:</label>
        <input type="text" id="name" name="name" value="{{ $product->name }}" required>

        <label for="description">Mô Tả:</label>
        <textarea id="description" name="description" required>{{ $product->description }}</textarea>

        <label for="unit_price">Giá Tiền:</label>
        <input type="number" id="unit_price" name="unit_price" value="{{ $product->unit_price }}" required>

        <label for="new">Tình Trạng:</label>
        <input type="text" id="new" name="new" value="{{ $product->new }}" required>

        <button type="submit">Cập Nhật</button>
    </form>
</div>
@endsection

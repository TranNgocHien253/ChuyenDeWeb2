@extends('app')

@section('title', 'Edit Product')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Chỉnh Sửa Sản Phẩm</h1>

    <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="image">
                Hình Ảnh:
            </label>
            <input type="file" name="image" id="image" class="border rounded px-3 py-2 w-full">
            @if($product->image)
                <div class="mt-2">
                    <img src="data:image/jpeg;base64,{{ $product->image }}" 
                         alt="{{ $product->name }}" 
                         class="max-w-xs">
                </div>
            @endif
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="name">
                Tên:
            </label>
            <input type="text" 
                   name="name" 
                   id="name"
                   value="{{ old('name', $product->name) }}"
                   class="border rounded px-3 py-2 w-full">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="description">
                Mô Tả:
            </label>
            <textarea name="description" 
                      id="description"
                      rows="4"
                      class="border rounded px-3 py-2 w-full">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="unit_price">
                Giá Tiền:
            </label>
            <input type="number" 
                   name="unit_price" 
                   id="unit_price"
                   value="{{ old('unit_price', $product->unit_price) }}"
                   class="border rounded px-3 py-2 w-full">
            @error('unit_price')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">
                Tình Trạng:
            </label>
            <select name="new" class="border rounded px-3 py-2 w-full">
                <option value="1" {{ old('new', $product->new) == 1 ? 'selected' : '' }}>Mới</option>
                <option value="0" {{ old('new', $product->new) == 0 ? 'selected' : '' }}>Cũ</option>
            </select>
            @error('new')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center">
            <button type="submit" 
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Cập Nhật
            </button>
            <a href="{{ route('admin.product.index') }}" 
               class="ml-4 text-gray-600 hover:text-gray-800">
                Quay lại
            </a>
        </div>
    </form>
</div>
@endsection
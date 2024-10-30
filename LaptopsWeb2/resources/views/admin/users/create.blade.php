@extends('app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white border border-gray-300 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-center mb-6">Thêm Người Dùng Mới</h2>

    @if ($errors->any())
    <div class="mb-4">
        <ul class="list-disc list-inside text-red-600">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="full_name" class="block text-gray-700 font-semibold mb-2">Full Name</label>
            <input type="text" name="full_name" id="full_name" class="border border-gray-300 rounded w-full py-2 px-3 focus:outline-none focus:border-blue-500" required value="{{ old('full_name') }}">
        </div>


        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 focus:border-indigo-500" placeholder="Nhập email">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Mật Khẩu</label>
            <input type="password" id="password" name="password" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 focus:border-indigo-500" placeholder="Nhập mật khẩu">
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Xác Nhận Mật Khẩu</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 focus:border-indigo-500" placeholder="Xác nhận mật khẩu">
        </div>

        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700">Số Điện Thoại</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 focus:border-indigo-500" placeholder="Nhập số điện thoại">
        </div>

        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700">Địa Chỉ</label>
            <input type="text" id="address" name="address" value="{{ old('address') }}" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 focus:border-indigo-500" placeholder="Nhập địa chỉ">
        </div>

        <div class="mb-4">
            <label for="gender" class="block text-sm font-medium text-gray-700">Giới Tính</label>
            <select id="gender" name="gender" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 focus:border-indigo-500">
                <option value="">Chọn giới tính</option>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Nam</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Nữ</option>
                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Khác</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="imageAvatar" class="block text-sm font-medium text-gray-700">Hình Ảnh Đại Diện</label>
            <input type="file" id="imageAvatar" name="imageAvatar" class="mt-1 block w-full text-sm text-gray-500 border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 focus:border-indigo-500" accept="image/*">
        </div>

        <div>
            <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">Thêm Người Dùng</button>
        </div>
    </form>
</div>
@endsection
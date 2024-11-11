@extends('app')

@section('content')
<div class="w-full p-6 bg-white border border-gray-300 rounded-lg shadow-md">
    @if (session('success'))
    <div class="bg-green-500 text-white p-4 rounded mb-3">
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="mb-3">
        <ul class="list-disc list-inside text-red-600">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data" require>
        @csrf

        <div class="mb-3">
            <label for="full_name" class="block text-gray-700 font-semibold mb-2">Full Name</label>
            <input type="text" name="full_name" id="full_name" class="border border-gray-300 rounded w-full py-2 px-3 focus:outline-none focus:border-blue-500" required value="{{ old('full_name') }}">
        </div>

        <div class="flex gap-3 mb-3">
            <div class="w-1/3">
                <label for="gender" class="block text-sm font-medium text-gray-700">Giới Tính</label>
                <select id="gender" name="gender" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 focus:border-indigo-500">
                    <option value="">Chọn giới tính</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Nam</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Nữ</option>
                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Khác</option>
                </select>
            </div>
            <div class="w-2/3">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 focus:border-indigo-500" placeholder="Nhập email">
            </div>
        </div>

        <div class="mb-3">
            <label for="password" class="block text-sm font-medium text-gray-700">Mật Khẩu</label>
            <input type="password" id="password" name="password" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 focus:border-indigo-500" placeholder="Nhập mật khẩu">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Xác Nhận Mật Khẩu</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 focus:border-indigo-500" placeholder="Xác nhận mật khẩu">
        </div>

        <div class="mb-3">
            <label for="address" class="block text-sm font-medium text-gray-700">Địa Chỉ</label>
            <input type="text" id="address" name="address" value="{{ old('address') }}" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 focus:border-indigo-500" placeholder="Nhập địa chỉ">
        </div>
        <div class="mb-3">
            <label for="phone" class="block text-sm font-medium text-gray-700">Số Điện Thoại</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 focus:border-indigo-500" placeholder="Nhập số điện thoại">
        </div>


        <div class="flex flex-col gap-3">
            <button type="submit" class="py-2 px-4 bg-green-200 text-black border-2 border-gray-400 font-semibold rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-black focus:ring-opacity-50">
                ADD
            </button>
            <a href="{{ route('admin.user.index') }}" class=" text-center py-2 px-4 bg-red-200 text-black border-2 border-gray-400 font-semibold rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                Cancel
            </a>
        </div>

    </form>
</div>
@endsection
@extends('app')

@section('title', 'Admin Slides')

@section('content')
<div class="container mx-auto mt-5 p-6 max-w-3xl">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Edit User</h1>

    @if (session('success'))
    <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="full_name" class="block text-gray-700">Họ và tên</label>
            <input type="text" name="full_name" id="full_name" value="{{ old('full_name', $user->full_name) }}" class="w-full mt-2 p-2 border rounded">
            @error('full_name')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full mt-2 p-2 border rounded">
            @error('email')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700">Mật khẩu (để trống nếu không muốn đổi)</label>
            <input type="password" name="password" id="password" class="w-full mt-2 p-2 border rounded">
            @error('password')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="gender" class="block text-gray-700">Giới tính</label>
            <input type="text" name="gender" id="gender" value="{{ old('gender', $user->gender) }}" class="w-full mt-2 p-2 border rounded">
            @error('gender')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="address" class="block text-gray-700">Địa chỉ</label>
            <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}" class="w-full mt-2 p-2 border rounded">
            @error('address')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="phone" class="block text-gray-700">Số điện thoại</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="w-full mt-2 p-2 border rounded">
            @error('phone')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col gap-3">
            <button type="submit" class="py-2 px-4 bg-green-200 text-black border-2 border-gray-400 font-semibold rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-black focus:ring-opacity-50">
                SAVE
            </button>
            <a href="{{ route('admin.user.index') }}" class=" text-center py-2 px-4 bg-red-200 text-black border-2 border-gray-400 font-semibold rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                Cancel
            </a>
        </div>
    </form>

    <!-- các trường để sửa thông tin-->
    </form>
</div>
@endsection
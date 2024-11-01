@extends('app')

@section('title', 'Admin Slides')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-5">Create Slide</h1>

    <!-- Nút quay lại -->


    <!-- Thông báo thành công -->
    @if (session('success'))
    <div class="bg-green-500 text-white p-4 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <!-- Thông báo lỗi -->
    @if ($errors->any())
    <div class="bg-red-500 text-white p-4 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Form tạo slide -->
    <form class="flex flex-col gap-5" action="{{ route('admin.slides.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-semibold mb-2">Image</label>
            <input type="file" name="image" id="image" class="border border-gray-300 rounded w-full py-2 px-3 focus:outline-none focus:border-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="link" class="block text-gray-700 font-semibold mb-2">Link</label>
            <input type="text" name="link" id="link" class="border border-gray-300 rounded w-full  h-48 py-2 px-3  focus:outline-none focus:border-blue-500" required value="{{ old('link') }}">
        </div>


        <!-- Nút thêm slide -->
        <div class="flex h-11 gap-5 justify-around">
            <button type="submit" class="bg-green-200 text-black border border-black py-2 px-4 w-1/2 rounded hover:bg-green-600 transition">ADD</button>
            <a href="{{ route('admin.slides.index') }}" class="flex justify-center items-center bg-red-200 text-black border border-black py-2 px-4 rounded h-full w-1/2 hover:bg-red-600 transition">Cancel</a>
            </ class="flex ">
    </form>
</div>
@endsection
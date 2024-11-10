@extends('app')

@section('title', 'Admin Slides')

@section('content')
<div class="container mx-auto mt-5 p-6 max-w-3xl">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Edit Slide</h1>

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

    <form action="{{ route('admin.slides.update', $slide->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label for="image" class="block text-lg font-medium text-gray-700 mb-2">Image</label>
            <div class="mb-4">
                <img src="{{ asset($slide->image) }}" alt="Current Slide Image" class="h-52  w-auto rounded-lg shadow" id="current-image">
            </div>
            <input type="file" name="image" id="image" class=" w-full py-2 px-4 text-gray-700 focus:ring-2 focus:ring-blue-400 focus:outline-none" accept="image/*" onchange="previewImage(event)">
        </div>
        <div class="mb-6">
            <label for="link" class="block text-lg font-medium text-gray-700 mb-2">Link</label>
            <input type="text" name="link" id="link" class="border border-gray-300 rounded-lg w-full py-2 px-4 text-gray-700 focus:ring-2 focus:ring-blue-400 focus:outline-none" required value="{{ old('link', $slide->link) }}">
        </div>

        <div class="flex h-11 gap-5 justify-between items-center">
            <button type="submit" class="bg-green-200 text-black w-1/2 border border-black h-full rounded focus:outline-none">Update Slide</button>
            <a href="{{ route('admin.slides.index') }}" class="flex justify-center items-center bg-red-200 text-black border border-black rounded h-full w-1/2 hover:bg-red-600 transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            const image = document.getElementById('current-image');
            image.src = e.target.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
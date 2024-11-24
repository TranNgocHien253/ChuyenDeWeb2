@extends('app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center">Liên Hệ Với Chúng Tôi</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md my-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contact.send') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-lg">Tên</label>
                <input type="text" id="name" name="name" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-lg">Email</label>
                <input type="email" id="email" name="email" class="w-full p-3 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="message" class="block text-lg">Nội dung</label>
                <textarea id="message" name="message" class="w-full p-3 border border-gray-300 rounded-md" rows="4" required></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white p-3 rounded-md hover:bg-blue-600 transition-all">Gửi Liên Hệ</button>
        </form>
    </div>
@endsection

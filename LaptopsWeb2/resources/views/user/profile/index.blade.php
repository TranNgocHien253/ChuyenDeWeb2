@extends('app') <!-- Đây là layout chung của bạn, nếu có -->

@section('content')
<div class="container mx-auto mt-10">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="flex items-center space-x-4">
            @if($user->imageAvatar)
            <img src="{{ Storage::url($user->imageAvatar) }}" alt="Avatar" class="w-32 h-32 rounded-full">
            @else
            <div class="w-32 h-32 bg-gray-300 rounded-full flex items-center justify-center">
                <span class="text-xl text-white">No Image</span>
            </div>
            @endif
            <div>
                <h2 class="text-2xl font-bold">{{ $user->full_name }}</h2>
                <p class="text-gray-500">{{ $user->email }}</p>
            </div>
        </div>

        <div class="mt-6">
            <h3 class="text-lg font-semibold">Thông tin chi tiết</h3>
            <ul class="list-none space-y-2 mt-4">
                <li><strong>Giới tính:</strong> {{ $user->gender ?? 'N/A' }}</li>
                <li><strong>Địa chỉ:</strong> {{ $user->address ?? 'N/A' }}</li>
                <li><strong>Số điện thoại:</strong> {{ $user->phone ?? 'N/A' }}</li>
            </ul>
        </div>
    </div>
</div>
@endsection
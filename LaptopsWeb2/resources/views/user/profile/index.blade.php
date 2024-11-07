@extends('app')

@section('content')
<div class="container mx-auto mt-5">
    <h1 class="text-2xl font-bold">Thông tin cá nhân</h1>
    <div class="mt-4">
        <p><strong>Họ tên:</strong> {{ $user->full_name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Số điện thoại:</strong> {{ $user->phone }}</p>
        <p><strong>Địa chỉ:</strong> {{ $user->address }}</p>
        <p><strong>Giới tính:</strong> {{ $user->gender }}</p>
        <p><strong>Avatar:</strong></p>
        @if($user->imageAvatar)
        <img src="{{ asset('images/' . $user->imageAvatar) }}" alt="Avatar" class="w-32 h-32">
        @else
        <p>Chưa có ảnh đại diện</p>
        @endif
    </div>
</div>

@endsection
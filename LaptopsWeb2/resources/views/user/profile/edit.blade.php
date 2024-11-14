@extends('app')

@section('title', 'Update Profile')

@section('content')
@if ($errors->any())
<div class="bg-red-500 text-white p-4 rounded-lg mb-6">
    <ul class="list-disc list-inside">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ route('user.profile.update', $user->id) }}" method="POST" enctype="multipart/form-data" require>
    @csrf
    @method('PUT')
    <div class="font-std mb-10 w-full rounded-2xl bg-white p-10 font-normal leading-relaxed text-gray-900 shadow-xl transition-all duration-300 animate-fade-in">
        <div class="flex flex-col">
            <div class="flex flex-col md:flex-row justify-between mb-5 items-start">
                <h2 class="mb-5 text-4xl font-bold text-blue-900">Update Profile</h2>
                <div class="relative">
                    <!-- Hiển thị ảnh hiện tại -->
                    <img src="{{ asset('storage/' . $user->imageAvatar) }}" alt="Profile Picture"
                        class="rounded-full w-32 h-32 border-4 border-indigo-800 mb-4 object-cover" id="avatarImagePreview">

                    <!-- Input file để chọn ảnh mới -->
                    <input type="file" name="imageAvatar" id="upload_profile" hidden onchange="previewImage(event)">

                    <!-- Nút để mở input file -->
                    <label for="upload_profile" class="absolute bottom-2 right-2 bg-white p-2 rounded-full cursor-pointer">
                        <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z"></path>
                        </svg>
                    </label>
                </div>
            </div>
        </div>

        <div class="flex w-full justify-end">
            <button type="button" onclick="togglePasswordForm()" class="bg-indigo-800 text-white px-4 py-2 rounded-lg hover:bg-blue-900 transition-colors duration-300 ring ring-gray-300 hover:ring-indigo-300">
                Change Password
            </button>
        </div>

        <div id="passwordForm" class="hidden mt-4 border-2 border-gray-500 p-4 rounded-lg">
            <div class="mb-4">
                <label for="current_password" class="block text-gray-700">Current Password</label>
                <input type="password" name="current_password" id="current_password" class="w-full mt-2 p-2 border rounded">
                @error('current_password')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">New Password</label>
                <input type="password" name="password" id="password" class="w-full mt-2 p-2 border rounded">
                @error('password')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full mt-2 p-2 border rounded">
                @error('password_confirmation')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <form class="space-y-4">
            <div class="py-2">
                <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" id="full_name" name="full_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('full_name', $user->full_name) }}">
                @error('full_name')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="py-2">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('email', $user->email) }}">
                @error('email')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="py-2">
                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                <select id="gender" name="gender" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="" disabled {{ old('gender', $user->gender) ? '' : 'selected' }}>Select Gender</option>
                    <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('gender')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="py-2">
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" id="address" name="address" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('address', $user->address) }}">
            </div>

            <div class="py-2">
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" id="phone" name="phone" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('phone', $user->phone) }}">
            </div>

            <div class="mt-4 flex justify-end">
                <button type="submit" class="bg-indigo-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition-colors duration-300 ring ring-gray-300 hover:ring-indigo-300">Update Profile</button>
            </div>
        </form>
    </div>
    </div>
</form>
<script>
    function togglePasswordForm() {
        const passwordForm = document.getElementById('passwordForm');
        passwordForm.classList.toggle('hidden');
    }

    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Cập nhật ảnh hiển thị lên giao diện
                document.getElementById('avatarImagePreview').src = e.target.result;
            };
            reader.readAsDataURL(file); // Đọc file ảnh và hiển thị
        }
    }
</script>
@endsection
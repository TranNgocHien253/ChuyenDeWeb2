@extends('app')

@section('title', 'Admin Slides')

@section('content')
<div class="container w-full px-6">
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


    <form action="{{ route('admin.user.update', ['encryptedId' => Crypt::encrypt($user->id)]) }}" method="POST" enctype="multipart/form-data" class="bg-white px-6 pb-5 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <div class="flex w-full justify-end">
            <button type="button" onclick="togglePasswordForm()" class="py-2 px-4 bg-blue-500 text-white rounded mt-4">
                Đổi mật khẩu
            </button>
        </div>

        <div id="passwordForm" class="hidden mt-4 border-2 border-gray-500 p-2 rounded-lg">

            <div class="mb-4">
                <label for="current_password" class="block text-gray-700">Mật khẩu hiện tại</label>
                <input type="password" name="current_password" id="current_password" class="w-full mt-2 p-2 border rounded">
                @error('current_password')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Mật khẩu mới</label>
                <input type="password" name="password" id="password" class="w-full mt-2 p-2 border rounded">
                @error('password')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700">Xác nhận mật khẩu mới</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full mt-2 p-2 border rounded">
                @error('password_confirmation')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

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
            <label for="gender" class="block text-gray-700">Giới tính</label>
            <!-- <input type="text" name="gender" id="gender" value="{{ old('gender', $user->gender) }}" class="w-full mt-2 p-2 border rounded"> -->
            <select id="gender" name="gender" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 focus:border-indigo-500">
                <option value="{{ old('gender', $user->gender) }}">{{ old('gender', $user->gender) }}</option>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Nam</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Nữ</option>
                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Khác</option>
            </select>
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
            <a href="{{ route('admin.user.index') }}" class=" text-center py-2 px-4 bg-red-200 text-black border-2 border-gray-400 font-semibold rounded-md hover:bg-red-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                Cancel
            </a>
        </div>
    </form>

</div>
<script>
    function togglePasswordForm() {
        const passwordForm = document.getElementById('passwordForm');
        passwordForm.classList.toggle('hidden');
    }
</script>
<style>
    /* Animation khi mở form mật khẩu */
    @keyframes slideIn {
        from {
            transform: translateY(-10px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* Áp dụng hiệu ứng cho form mật khẩu khi hiển thị */
    #passwordForm {
        animation: slideIn 0.5s ease-out;
    }

    /* Hiệu ứng mượt khi input được focus */
    input:focus,
    select:focus,
    textarea:focus {
        border-color: #4CAF50;
        box-shadow: 0 0 10px rgba(76, 175, 80, 0.5);
        transition: all 0.3s ease;
    }

    /* Hiệu ứng khi hover vào nút */
    button:hover,
    a:hover {
        transform: translateY(-2px);
        transition: transform 0.2s ease-in-out;
    }

    /* Fade-in cho form */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    form {
        animation: fadeIn 1s ease-out;
    }
</style>
@endsection
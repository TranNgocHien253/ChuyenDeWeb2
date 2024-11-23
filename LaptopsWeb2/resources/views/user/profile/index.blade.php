@extends('app')

@section('content')
<div class="flex top-3 justify-center">
    @if(session('error'))
    <div class="fixed w-2/3 z-50 bg-red-100 text-red-700 p-4 rounded my-2 fade-in">
        {{ session('error') }}
    </div>
    @endif
</div>
<div class="bg-white mx-auto rounded-xl shadow-2xl max-w-4xl w-full p-8 transition-all duration-300 animate-fade-in">
    <div class="flex flex-col md:flex-row">

        <div class="md:w-1/3 text-center mb-8 md:mb-0">

            @if($user->imageAvatar)
            <img src="{{ asset('storage/' . $user->imageAvatar) }}" alt="Profile Picture" class="rounded-full w-48 h-48 mx-auto mb-4 border-4 border-indigo-800 object-cover transition-transform duration-300 hover:scale-105">
            @else
            <img src="{{ asset('logo/user.png') }}" alt="Profile Picture" class="rounded-full w-48 h-48 mx-auto mb-4 border-4 border-indigo-800 dark:border-blue-900 transition-transform duration-300 hover:scale-105">
            @endif
            <h1 class="text-2xl font-bold text-indigo-800  mb-2">{{ $user->full_name }}</h1>
            <p class="text-gray-600">{{ $user->email }}</p>
            <form action="{{ route('user.profile.edit', ['encryptedId' => Crypt::encrypt($user->id)]) }}">
                <button class="mt-4 bg-indigo-800 text-white px-4 py-2 rounded-lg hover:bg-blue-900 ring ring-transparent hover:ring-blue-300 transition-all duration-300">Edit Profile</button>
            </form>
            <button
                id="deleteAccountBtn"
                class="mt-4 bg-red-900 text-white px-4 py-2 rounded-lg hover:bg-red-700 ring ring-transparent hover:ring-red-300 transition-all duration-300">
                Delete Account
            </button>
        </div>
        <div class="md:w-2/3 md:pl-8">

            <h2 class="text-xl font-semibold text-indigo-800 mb-4">Giới tính:</h2>
            <div class="flex flex-wrap gap-2 mb-6">
                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm">{{ $user->gender }}</span>
            </div>
            <h2 class="text-xl font-semibold text-indigo-800 mb-4">Contact Information</h2>
            <ul class="space-y-2 text-gray-700">
                <li class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-800" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                    {{ $user->email }}
                </li>
                <li class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-800" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                    </svg>
                    {{ $user->phone }}
                </li>
                <li class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-800" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                    {{ $user->address }}
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Modal xác nhận -->
<div id="modal" class="animate-fade-in hidden fixed inset-0 z-50 bg-gray-600 bg-opacity-50 flex justify-center items-center shadow-lg shadow-pink-200">
    <div class="max-w-md mx-auto mt-10 p-6 bg-white border border-gray-300 rounded-lg shadow-md">
        <h2 class="text-xl font-bold text-center mb-4">Xóa tài khoản</h2>
        <p class="text-center mb-6">Bạn có chắc chắn muốn xóa tài khoản này không?</p>

        <div class="flex justify-between">
            <!-- Nút Chấp nhận -->
            <form id="deleteForm" action="{{ route('user.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-800 text-white px-4 py-2 rounded-lg hover:bg-red-900 transition-colors duration-300 ring ring-gray-300 hover:ring-red-300">
                    Chắn chắn
                </button>
            </form>

            <!-- Nút Hủy -->
            <button id="cancelBtn" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                Hủy
            </button>
        </div>
    </div>
</div>
<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fadeIn 0.5s ease-out forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in {
        opacity: 0;
        animation: fadeIn 0.5s ease-out;
        animation-delay: .6s;
        animation-fill-mode: forwards;
    }

    .fade-hide {
        animation: fadeIn 0.5s ease-out;
    }
</style>

<script>
    // Toggle dark mode based on system preference
    if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
        document.documentElement.classList.add('dark');
    }

    // Add hover effect to skill tags
    const skillTags = document.querySelectorAll('.bg-indigo-100');
    skillTags.forEach(tag => {
        tag.addEventListener('mouseover', () => {
            tag.classList.remove('bg-indigo-100', 'text-indigo-800');
            tag.classList.add('bg-blue-900', 'text-white');
        });
        tag.addEventListener('mouseout', () => {
            tag.classList.remove('bg-blue-900', 'text-white');
            tag.classList.add('bg-indigo-100', 'text-indigo-800');
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        // Lấy các phần tử cần thiết
        const deleteAccountBtn = document.getElementById('deleteAccountBtn');
        const modal = document.getElementById('modal');
        const cancelBtn = document.getElementById('cancelBtn');

        // Hiển thị modal khi nhấn nút Delete Account
        deleteAccountBtn.addEventListener('click', function() {
            modal.classList.remove('hidden'); // Hiện modal
        });

        // Đóng modal khi nhấn nút Hủy
        cancelBtn.addEventListener('click', function() {
            modal.classList.add('hidden'); // Ẩn modal
        });

    });
</script>
@endsection
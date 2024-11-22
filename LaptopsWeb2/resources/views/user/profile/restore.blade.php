<head>
    @vite('resources/css/app.css')
</head>

<body>
    <!-- Video background -->
    <video autoplay muted loop class="fixed top-0 left-0 w-full h-full object-cover z-0">
        <source src="{{ asset('video/Introducing the new MacBook Air  Apple.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Content on top of the video -->
    <div class="relative z-10 w-full h-full flex flex-col justify-center items-center bg-black bg-opacity-50">
        <div class="bg-gray-900 bg-opacity-50 p-5 rounded-lg w-1/3">
            <form method="POST" action="{{ route('user.restore', ['id' => $user->id]) }}">
                @csrf
                <h1 class="text-4xl mb-3 text-center text-white">TÀI KHOẢN NÀY ĐÃ XÓA TRƯỚC ĐÓ!<br><a class="text-xl">Bạn có muốn khôi phục lại tài khoản này không?</a></h1>

                @if (session('error'))
                <p style="color: red;">{{ session('error') }}</p>
                @endif
                <div class="flex justify-center">
                    <button type="submit" class="border-2 border-black w-full rounded-md p-3 text-white bg-slate-500 bg-opacity-10 hover:bg-slate-600 transition-all">Yes, Khôi phục</button>
                </div>
                <div class="mt-4 text-center">
                    <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">Không, quay lại trang đăng nhập</a>
                </div>
            </form>
        </div>
    </div>
</body>
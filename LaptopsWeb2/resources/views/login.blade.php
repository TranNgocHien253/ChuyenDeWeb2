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
        <h1 class="text-4xl mb-3 text-white">LOGIN</h1>
        <div class="bg-gray-900 bg-opacity-50 p-5 rounded-lg w-1/3">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-200">Your email</label>
                    <input type="email" id="email" name="email" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@flowbite.com" />
                </div>
                <div class="mb-5">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-200">Your password</label>
                    <input type="password" id="password" name="password" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                </div>
                <div class="flex items-start mb-5">
                    <div class="flex items-center h-5">
                        <input id="remember" type="checkbox" name="remember" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" />
                    </div>
                    <label for="remember" class="ms-2 text-sm font-medium text-gray-200">Remember me</label>
                </div>
                @if (session('error'))
                <p style="color: red;">{{ session('error') }}</p>
                @endif
                <div class="flex justify-center">
                    <button type="submit" class="border-2 border-black w-full rounded-md p-3 text-white bg-slate-500 bg-opacity-10 hover:bg-slate-600 transition-all">Login</button>
                </div>
                <div class="mt-4 text-center">
                    <p class="text-gray-600">Đăng ký tài khoản? <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700">Đăng ký ngay</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
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
                <div class="flex justify-center mb-4"> <!-- Thêm margin-bottom cho khoảng cách giữa 2 nút -->
                    <button type="submit" class="border-2 border-black w-full rounded-md p-3 text-white bg-slate-500 bg-opacity-10 hover:bg-slate-600 transition-all">Login</button>
                </div>
                
                <!-- Google Login Button -->
                <div class="flex justify-center">
                    <a href="{{ url('auth/google') }}" class="w-full flex justify-center items-center bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                            <path d="M8 8.25c-.446 0-.872-.083-1.257-.233-.395-.164-.731-.396-.994-.682l-2.2 1.46v-2.85h2.6c.262 0 .52-.073.738-.204-.462.518-.646 1.212-.42 1.866.096-.054.204-.094.317-.13-.285-.545-.751-.94-1.292-1.144.69-.276 1.22-.8 1.435-1.457.001-.003-.517-.417-.68-.39-.82-.391-1.441-.93-2.11-1.462-.33-.271-.717-.351-1.106-.206-.16-.204-.47-.397-.708-.559-.57-.328-.957-.806-.872-1.346-.532-.235-.996-.547-1.38-.954-.61-.456-.997-.998-.974-1.65-.333.474-.65 1.01-.45 1.55-.577-.049-.739-.281-.762-.818-.267-.267-.334-.57-.092-.812.07-.027.15-.05.232-.072.497.456.81.81 1.396.622-.531 1.337-.506-.049-.258-.329-.207-.051-.503-.152.324-.396" />
                        </svg>
                        <span class="ml-2">Đăng nhập bằng Google</span>
                    </a>
                </div>
                
                

              
                <div class="mt-4 text-center">
                    <p class="text-gray-600">Đăng ký tài khoản? <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700">Đăng ký ngay</a></p>
                    <a href="{{ route('password.request') }}" class="text-blue-500 hover:text-blue-700">Quên mật khẩu?</a>

                </div>
            </form>
        </div>
    </div>
</body>
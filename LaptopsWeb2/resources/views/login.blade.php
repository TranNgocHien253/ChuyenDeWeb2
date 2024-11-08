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
                    <button type="submit" class="group group-hover:before:duration-500 group-hover:after:duration-500 after:duration-500 hover:border-gray-400 hover:before:[box-shadow:_20px_20px_20px_30px_#a21caf] duration-500 before:duration-500 hover:duration-500 underline underline-offset-2 hover:after:-right-8 hover:before:right-12 hover:before:-bottom-8 hover:before:blur hover:underline hover:underline-offset-4  origin-left hover:decoration-2 hover:text-white relative bg-neutral-800 h-16 w-64 border text-left p-3 text-gray-50 text-base font-bold rounded-lg  overflow-hidden  before:absolute before:w-12 before:h-12 before:content[''] before:right-1 before:top-1 before:z-10 before:bg-white before:rounded-full before:blur-lg  after:absolute after:z-10 after:w-20 after:h-20 after:content['']  after:bg-gray-400 after:right-8 after:top-3 after:rounded-full after:blur-lg">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
<header class="h-15">
    <nav class="bg-white border-gray-200">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-2xl p-4">
            <a href="/" class="flex items-center">
                <img src="{{ asset('logo/logoJWEB.jpg') }}" alt="Logo" class="h-10 w-auto object-contain">
            </a>
            <form class="flex items-center max-w-sm w-full" action="{{ route('search') }}" method="GET">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <input type="text" name="search" id="simple-search"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg shadow-md focus:ring-2 focus:ring-purple-600 focus:border-transparent block w-full pl-3 p-2.5"
                        placeholder="Search..." required />
                    <button type="submit" class="absolute inset-y-0 right-0 flex items-center px-3">
                        <svg class="w-4 h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>
            </form>
            <!-- User Actions -->
            <div class="flex items-center space-x-6 rtl:space-x-reverse">
                @guest
                <!-- Buttons for Guests -->
                <a href="{{ route('login') }}" class="text-sm text-white bg-purple-600 hover:bg-purple-400 rounded-md px-4 py-2 transition duration-200">
                    Login
                </a>
                <a href="{{ route('register') }}" class="text-sm text-purple-700 border border-purple-600 bg-white hover:bg-purple-100 rounded-md px-4 py-2 transition duration-200">
                    Register
                </a>
                @else
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-purple-700 border border-purple-600 bg-white hover:bg-purple-100 rounded-md px-4 py-2 transition duration-200">
                        Logout
                    </button>
                </form>
                @endguest
                <button class="flex items-center justify-center rounded-full bg-transparent cursor-pointer" id="toggleBtn">
                    <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg" class="rounded-full w-9 h-9 fill-black animation-fadeout">
                        <path d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128ZM128,72a12,12,0,1,0-12-12A12,12,0,0,0,128,72Zm0,112a12,12,0,1,0,12,12A12,12,0,0,0,128,184Z"></path>
                    </svg>
                </button>

            </div>

        </div>
    </nav>
    <div id="slideDiv" class="fixed right-[-100px] top-24 z-50 transition-all duration-500 ease-in-out transform">
        <div class="flex flex-col justify-center items-center relative transition-all duration-[450ms] ease-in-out w-16">
            <article
                class="border border-solid border-gray-700 w-full ease-in-out duration-500 left-0 rounded-2xl inline-block shadow-lg shadow-black/15 bg-white">
                <a href="#" class="block w-full h-16 p-4 ease-in-out duration-300 border-solid border-black/10 group flex flex-row gap-3 items-center justify-center text-black rounded-xl hover:bg-gray-100">
                    <svg class="text-2xl fill-current transition-transform group-hover:scale-125 group-hover:text-blue-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M4 13h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1zm-1 7a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v4zm10 0a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-7a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v7zm1-10h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1z"></path>
                    </svg>
                </a>

                <a href="{{ route('profile') }}" class="block w-full h-16 p-4 ease-in-out duration-300 border-solid border-black/10 group flex flex-row gap-3 items-center justify-center text-black rounded-xl hover:bg-gray-100">
                    <svg class="text-2xl fill-current transition-transform group-hover:scale-125 group-hover:text-blue-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M12 2a5 5 0 1 0 5 5 5 5 0 0 0-5-5zm0 8a3 3 0 1 1 3-3 3 3 0 0 1-3 3zm9 11v-1a7 7 0 0 0-7-7h-4a7 7 0 0 0-7 7v1h2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1z"></path>
                    </svg>
                </a>

                <a href="#" class="block w-full h-16 p-4 ease-in-out duration-300 border-solid border-black/10 group flex flex-row gap-3 items-center justify-center text-black rounded-xl hover:bg-gray-100">
                    <svg class="text-2xl fill-current transition-transform group-hover:scale-125 group-hover:text-blue-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M5 18v3.766l1.515-.909L11.277 18H16c1.103 0 2-.897 2-2V8c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v8c0 1.103.897 2 2 2h1zM4 8h12v8h-5.277L7 18.234V16H4V8z"></path>
                        <path d="M20 2H8c-1.103 0-2 .897-2 2h12c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2z"></path>
                    </svg>
                </a>

                <a href="#" class="block w-full h-16 p-4 ease-in-out duration-300 border-solid border-black/10 group flex flex-row gap-3 items-center justify-center text-black rounded-xl hover:bg-gray-100">
                    <svg class="text-2xl fill-current transition-transform group-hover:scale-125 group-hover:text-blue-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M11 7h2v7h-2zm0 8h2v2h-2z"></path>
                    </svg>
                </a>

                <a href="#" class="block w-full h-16 p-4 ease-in-out duration-300 border-solid border-black/10 group flex flex-row gap-3 items-center justify-center text-black rounded-xl hover:bg-gray-100">
                    <svg class="text-2xl fill-current transition-transform group-hover:scale-125 group-hover:text-blue-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M12 16c2.206 0 4-1.794 4-4s-1.794-4-4-4-4 1.794-4 4 1.794 4 4 4zm0-6c1.084 0 2 .916 2 2s-.916 2-2 2-2-.916-2-2 .916-2 2-2z"></path>
                        <path d="m2.845 16.136 1 1.73c.531.917 1.809 1.261 2.73.73l.529-.306A8.1 8.1 0 0 0 9 19.402V20c0 1.103.897 2 2 2h2c1.103 0 2-.897 2-2v-.598a8.132 8.132 0 0 0 1.896-1.111l.529.306c.923.53 2.198.188 2.731-.731l.999-1.729a2.001 2.001 0 0 0-.731-2.732l-.505-.292a7.718 7.718 0 0 0 0-2.224l.505-.292a2.002 2.002 0 0 0 .731-2.732l-.999-1.729c-.531-.92-1.808-1.265-2.731-.732l-.529.306A8.1 8.1 0 0 0 15 4.598V4c0-1.103-.897-2-2-2h-2c-1.103 0-2 .897-2 2v.598a8.132 8.132 0 0 0-1.896 1.111l-.529-.306c-.924-.531-2.2-.187-2.731.732l-.999 1.729a2.001 2.001 0 0 0 .731 2.732l.505.292a7.683 7.683 0 0 0 0 2.223l-.505.292a2.003 2.003 0 0 0-.731 2.733z"></path>
                    </svg>
                </a>

            </article>
        </div>

    </div>
</header>

<style>
    .transition-all {
        transition: all 0.2s ease;
    }
</style>
<script>
    document.getElementById('toggleBtn').addEventListener('click', function(event) {
        event.stopPropagation();
        var slideDiv = document.getElementById('slideDiv');
        if (slideDiv.classList.contains('right-[-100px]')) {
            slideDiv.classList.remove('right-[-100px]');
            slideDiv.classList.add('right-1');
        } else {
            slideDiv.classList.remove('right-1');
            slideDiv.classList.add('right-[-100px]');
        }
    });

    document.addEventListener('click', function(event) {
        var slideDiv = document.getElementById('slideDiv');
        var toggleBtn = document.getElementById('toggleBtn');
        if (!slideDiv.contains(event.target) && event.target !== toggleBtn) {
            slideDiv.classList.remove('right-1');
            slideDiv.classList.add('right-[-100px]');
        }
    });
</script>
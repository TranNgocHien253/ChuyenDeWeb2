<header>
    <nav class="bg-white border-b border-purple-200">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
            <a href="#" class="flex items-center">
                <img src="{{ asset('logo/logoJWEB.jpg') }}" alt="Logo" class="h-10 w-auto object-contain">
            </a>
            <form class="flex items-center max-w-sm w-full">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <input type="text" id="simple-search"
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
            <div class="flex items-center space-x-6 rtl:space-x-reverse">
                @if (auth()->check())
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-sm text-purple-700 border border-purple-600 bg-white hover:bg-red-600 hover:text-white rounded-md px-4 py-2 transition duration-200">
                        Logout
                    </button>
                </form>
                @else
                <a href="{{ route('login') }}">
                    <button class="text-sm text-white bg-purple-600 hover:bg-purple-400 rounded-md px-4 py-2 transition duration-200">
                        Login
                    </button>
                </a>
                <button class="text-sm text-purple-700 border border-purple-600 bg-white hover:bg-purple-100 rounded-md px-4 py-2 transition duration-200">
                    Register
                </button>
                @endif
                <button class="flex items-center justify-center rounded-full bg-transparent cursor-pointer">
                    <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg" class="rounded-full w-9 h-9 fill-black animation-fadeout">
                        <path d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128ZM128,72a12,12,0,1,0-12-12A12,12,0,0,0,128,72Zm0,112a12,12,0,1,0,12,12A12,12,0,0,0,128,184Z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>
</header>
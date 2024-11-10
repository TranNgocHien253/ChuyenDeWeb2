<div x-cloak :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-w opacity-50 lg:hidden"></div>

<div x-cloak :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-64 h-screen overflow-y-auto transition duration-300 transform lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <span class="mx-2 text-2xl font-semibold text-purple-600">Dashboard</span>
        </div>
    </div>

    <nav class="mt-10">
        <a class="flex items-center px-6 py-2 mt-4 {{ request()->routeIs('admin.slides.index') ? 'text-purple-600 bg-white bg-opacity-25' : 'text-gray-500 hover:bg-gray-100 hover:bg-opacity-25 hover:text-gray-100' }}" href="{{ route('admin.slides.index') }}">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
            </svg>
            <span class="mx-3">Slide</span>
        </a>

        <a class="flex items-center px-6 py-2 mt-4 {{ request()->routeIs('admin.user.index') ? 'text-purple-600 bg-white bg-opacity-25' : 'text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100' }}" href="{{ route('admin.user.index') }}">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
            </svg>
            <span class="mx-3">User</span>
        </a>

        <a class="flex items-center px-6 py-2 mt-4 {{ request()->routeIs('admin.order.index') ? 'text-purple-600 bg-white bg-opacity-25' : 'text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100' }}" href="/tables">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            <span class="mx-3">Order</span>
        </a>

        <a class="flex items-center px-6 py-2 mt-4 {{ request()->routeIs('admin.typeproduct.index') ? 'text-purple-600 bg-white bg-opacity-25' : 'text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100' }}" href="/forms">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            <span class="mx-3">Typeproduct</span>
        </a>
    </nav>
    <div class="flex items-center p-2 w-full justify-center my-3">
        @guest
        <!-- Buttons for Guests -->
        <a href="{{ route('login') }}" class="text-sm text-white bg-purple-600 hover:bg-purple-400 rounded-md px-4 py-2 transition duration-200 w-full">
            Login
        </a>
        @else
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm w-52 text-purple-700 border border-purple-600 bg-white hover:bg-purple-100 rounded-md px-4 py-2 transition duration-200">
                Logout
            </button>
        </form>
        @endguest
    </div>
</div>
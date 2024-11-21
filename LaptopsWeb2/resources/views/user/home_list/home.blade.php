@extends('app')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<!--product-->

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

<div x-data="{ cartOpen: false , isOpen: false }" class="bg-white">
    <header>
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center justify-between">
                <div class="hidden w-full text-gray-600 md:flex md:items-center">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M16.2721 10.2721C16.2721 12.4813 14.4813 14.2721 12.2721 14.2721C10.063 14.2721 8.27214 12.4813 8.27214 10.2721C8.27214 8.06298 10.063 6.27212 12.2721 6.27212C14.4813 6.27212 16.2721 8.06298 16.2721 10.2721ZM14.2721 10.2721C14.2721 11.3767 13.3767 12.2721 12.2721 12.2721C11.1676 12.2721 10.2721 11.3767 10.2721 10.2721C10.2721 9.16755 11.1676 8.27212 12.2721 8.27212C13.3767 8.27212 14.2721 9.16755 14.2721 10.2721Z"
                            fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.79417 16.5183C2.19424 13.0909 2.05438 7.39409 5.48178 3.79417C8.90918 0.194243 14.6059 0.054383 18.2059 3.48178C21.8058 6.90918 21.9457 12.6059 18.5183 16.2059L12.3124 22.7241L5.79417 16.5183ZM17.0698 14.8268L12.243 19.8965L7.17324 15.0698C4.3733 12.404 4.26452 7.97318 6.93028 5.17324C9.59603 2.3733 14.0268 2.26452 16.8268 4.93028C19.6267 7.59603 19.7355 12.0268 17.0698 14.8268Z"
                            fill="currentColor" />
                    </svg>
                    <span class="mx-1 text-sm">NY</span>
                </div>
                <div class="w-full text-gray-700 md:text-center text-xl font-semibold">
                    <nav :class="isOpen ? '' : 'hidden'" class="sm:flex sm:justify-center sm:items-center">
                        <div class="flex flex-col sm:flex-row">
                            <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0"
                                href="{{ route('user.home') }}">Home</a>
                            <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">Shop</a>
                            <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">Categories</a>
                            <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">Contact</a>
                            <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">About</a>
                        </div>
                    </nav>
                </div>
                <div class="flex items-center justify-end w-full">
                    <button @click="cartOpen = !cartOpen" class="text-gray-600 focus:outline-none mx-4 sm:mx-0">
                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </button>

                    <div class="flex sm:hidden">
                        <button @click="isOpen = !isOpen" type="button"
                            class="text-gray-600 hover:text-gray-500 focus:outline-none focus:text-gray-500"
                            aria-label="toggle menu">
                            <svg viewBox="0 0 24 24" class="h-6 w-6 fill-current">
                                <path fill-rule="evenodd"
                                    d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>


        </div>
    </header>
    <div :class="cartOpen ? 'translate-x-0 ease-out' : 'translate-x-full ease-in'"
        class="fixed right-0 top-0 max-w-xs w-full h-full px-6 py-4 z-50 transition duration-300 transform overflow-y-auto bg-white border-l-2 border-gray-300">
        <div class="flex items-center justify-between">
            <h3 class="text-2xl font-medium text-gray-700">Your cart</h3>
            <button @click="cartOpen = !cartOpen" class="text-gray-600 focus:outline-none">
                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <hr class="my-3">
        <div class="flex justify-between mt-6">
            <div class="flex">
                <img class="h-20 w-20 object-cover rounded"
                    src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1189&q=80"
                    alt="">
                <div class="mx-3">
                    <h3 class="text-sm text-gray-600">Mac Book Pro</h3>
                    <div class="flex items-center mt-2">
                        <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </button>
                        <span class="text-gray-700 mx-2">2</span>
                        <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <span class="text-gray-600">20$</span>
        </div>
        <div class="flex justify-between mt-6">
            <div class="flex">
                <img class="h-20 w-20 object-cover rounded"
                    src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1189&q=80"
                    alt="">
                <div class="mx-3">
                    <h3 class="text-sm text-gray-600">Mac Book Pro</h3>
                    <div class="flex items-center mt-2">
                        <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </button>
                        <span class="text-gray-700 mx-2">2</span>
                        <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <span class="text-gray-600">20$</span>
        </div>
        <div class="flex justify-between mt-6">
            <div class="flex">
                <img class="h-20 w-20 object-cover rounded"
                    src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1189&q=80"
                    alt="">
                <div class="mx-3">
                    <h3 class="text-sm text-gray-600">Mac Book Pro</h3>
                    <div class="flex items-center mt-2">
                        <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </button>
                        <span class="text-gray-700 mx-2">2</span>
                        <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <span class="text-gray-600">20$</span>
        </div>
        <div class="mt-8">
            <form class="flex items-center justify-center">
                <input class="form-input w-48" type="text" placeholder="Add promocode">
                <button
                    class="ml-3 flex items-center px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                    <span>Apply</span>
                </button>
            </form>
        </div>
        <a href="{{ route('cart.list') }}"
            class="flex items-center justify-center mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
            <span>Chechout</span>
            <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                viewBox="0 0 24 24" stroke="currentColor">
                <path d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
            </svg>
        </a>
    </div>
    @if ($slides->isNotEmpty())
        <!--slides======================================================================================-->
        <div class="mx-1 mt-10 sm:mx-20">
            <div class="relative w-full overflow-hidden">
                <!-- Slide Wrapper -->
                <div class="flex transition-transform duration-500 ease-out" id="slideContainer">
                    @foreach ($slides as $slide)
                        <div class="w-full flex-shrink-0">
                            <a href="{{ asset($slide->link)}}">
                                <img src="{{ asset($slide->image)}}" class="w-full h-80 object-cover">
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Previous and Next Buttons -->
                <button id="prevSlide"
                    class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white p-2">
                    ‹
                </button>
                <button id="nextSlide"
                    class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white p-2">
                    ›
                </button>
            </div>
            <div class="flex justify-center mt-4">
                @foreach ($slides as $index => $slide)
                    <button
                        class="dot h-2 w-2 mx-1 rounded-full bg-gray-400 opacity-50 transition-opacity duration-300 {{ $index === 0 ? 'opacity-100' : '' }}"
                        data-index="{{ $index }}"></button>
                @endforeach
            </div>
        </div>
        <!--endslides==================================================================================-->
    @endif

    <main class="my-8">
        <div class="container mx-auto px-6">
            <!-- Categories Section -->
            <div class="mt-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-semibold text-gray-800">
                        <span class="border-b-4 border-blue-500 pb-1">Danh mục</span> sản phẩm
                    </h3>
                </div>

                <div class="grid gap-4 grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6">
                    @foreach ($typeProducts as $type)
                        <div
                            class="group relative rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                            <!-- Card Background với Gradient -->
                            <div class="h-40 w-full bg-cover bg-center relative"
                                style="background-image: url('{{ asset($type->image) }}')">
                                <!-- Gradient Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>

                                <!-- Icon Category -->
                                <div
                                    class="absolute top-3 right-3 bg-white/90 p-2 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>

                                <!-- Category Name -->
                                <div class="absolute bottom-0 left-0 right-0 p-3">
                                    <h3 class="text-sm font-medium text-white">{{ $type->name_type }}</h3>
                                    <p class="text-xs text-gray-300 mt-1">{{ $type->products_count ?? 0 }} sản phẩm</p>
                                </div>
                            </div>

                            <!-- Hover Overlay với Animation -->
                            <div onclick="loadProducts({{ $type->id }}, '{{ $type->name_type }}', {{ $type->products_count ?? 0 }})"
                                class="absolute inset-0 flex items-center justify-center bg-blue-500/0 hover:bg-blue-500/20 transition-colors duration-300 cursor-pointer">
                                <span class="sr-only">Xem danh mục {{ $type->name_type }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Category Features (Optional) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
                    <div class="flex items-center space-x-4 bg-gray-50 p-4 rounded-lg">
                        <div class="p-3 bg-blue-100 rounded-full">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Cập nhật thường xuyên</h4>
                            <p class="text-sm text-gray-600">Sản phẩm mới mỗi ngày</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4 bg-gray-50 p-4 rounded-lg">
                        <div class="p-3 bg-green-100 rounded-full">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Đảm bảo chất lượng</h4>
                            <p class="text-sm text-gray-600">Sản phẩm chính hãng</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4 bg-gray-50 p-4 rounded-lg">
                        <div class="p-3 bg-purple-100 rounded-full">
                            <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Giao hàng nhanh</h4>
                            <p class="text-sm text-gray-600">Vận chuyển trong 24h</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Products Container - Đây là container mới để hiển thị sản phẩm theo danh mục -->
        <div id="products-container" class="container mx-auto px-6 mt-16">
            @if(isset($currentType))
                <h3 class="text-gray-600 text-2xl font-medium">{{ $currentType->name_type }}</h3>
            @else
                <h3 class="text-gray-600 text-2xl font-medium">Tất cả sản phẩm</h3>
            @endif
        
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                @foreach ($products as $product)
                    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden border border-gray-300">
                        <!-- Product Image -->
                        <div class="relative">
                            <img src="data:image;base64,{{ $product->image }}" alt="image"
                                class="h-56 w-full object-cover" />
                            <!-- Favorite Button -->
                            <button
                                class="absolute top-2 right-2 text-gray-600 hover:text-red-500 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M20.84 4.61a5.5 5.5 0 01.02 7.77L12 20.39l-8.86-8.01a5.5 5.5 0 017.78-7.78l1.1 1.1 1.1-1.1a5.5 5.5 0 017.77.01z" />
                                </svg>
                            </button>
                        </div>
        
                        <!-- Product Details -->
                        <div class="px-5 py-3">
                            <h3 class="text-gray-700 uppercase font-bold">{{ $product->name }}</h3>
                            <p class="text-gray-500 text-sm mt-2">{{ $product->description }}</p>
                            <div class="flex items-center mt-2">
                                <!-- Rating -->
                                <div class="flex text-yellow-500">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="{{ $i <= $product->rating ? 'currentColor' : 'none' }}"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l2.158 6.63a1 1 0 00.95.69h6.905c.969 0 1.371 1.24.588 1.81l-5.634 4.1a1 1 0 00-.364 1.118l2.157 6.63c.3.921-.755 1.688-1.54 1.118l-5.634-4.1a1 1 0 00-1.175 0l-5.634 4.1c-.784.57-1.839-.197-1.539-1.118l2.157-6.63a1 1 0 00-.364-1.118L2.322 11.057c-.783-.57-.38-1.81.589-1.81h6.905a1 1 0 00.95-.69l2.157-6.63z" />
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-gray-600 ml-2">({{ $product->reviews_count }} đánh giá)</span>
                            </div>
                            <span class="text-gray-500 mt-2 block">${{ $product->unit_price }}</span>
                            <!-- Buttons -->
                            <div class="flex items-center justify-between mt-4">
                                <a href="/product/{{ $product->id }}" class="text-blue-600 underline">
                                    Xem chi tiết
                                </a>
                                <form action="/cart/add" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit"
                                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                        Thêm vào giỏ hàng
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
</div>
</main>

<main class="my-8">
    <div class="container mx-auto px-6">
        <div class="flex flex-col lg:flex-row items-start">
            <!-- Product Image -->
            <div class="w-full lg:w-1/2">
                <img src="data:image;base64,{{ $product->image }}" alt="image"
                    class="rounded-md shadow-lg w-full object-cover">
            </div>
            
            <!-- Product Details -->
            <div class="w-full lg:w-1/2 lg:pl-10 mt-6 lg:mt-0">
                <!-- Product Name -->
                <h1 class="text-3xl font-bold text-gray-700 uppercase">{{ $product->name }}</h1>
                
                <!-- Price -->
                <div class="flex items-center mt-4">
                    <span class="text-2xl text-blue-600 font-semibold">${{ $product->unit_price }}</span>
                    @if($product->promotion_price)
                        <span class="line-through ml-4 text-gray-400">${{ $product->promotion_price }}</span>
                    @endif
                </div>
                
                <!-- Description -->
                <p class="text-gray-600 mt-4">{{ $product->description }}</p>
                
                <!-- Ratings -->
                <div class="flex items-center mt-4">
                    <div class="flex text-yellow-500">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="{{ $i <= $product->rating ? 'currentColor' : 'none' }}"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l2.158 6.63a1 1 0 00.95.69h6.905c.969 0 1.371 1.24.588 1.81l-5.634 4.1a1 1 0 00-.364 1.118l2.157 6.63c.3.921-.755 1.688-1.54 1.118l-5.634-4.1a1 1 0 00-1.175 0l-5.634 4.1c-.784.57-1.839-.197-1.539-1.118l2.157-6.63a1 1 0 00-.364-1.118L2.322 11.057c-.783-.57-.38-1.81.589-1.81h6.905a1 1 0 00.95-.69l2.157-6.63z" />
                            </svg>
                        @endfor
                    </div>
                    <span class="ml-2 text-gray-600">({{ $product->reviews_count }} đánh giá)</span>
                </div>
                
              
            </div>
        </div>
    </div>
</main>     



<footer class="bg-gray-200">
    <div class="container mx-auto px-6 py-3 flex justify-between items-center">
        <a href="#" class="text-xl font-bold text-gray-500 hover:text-gray-400">Brand</a>
        <p class="py-2 text-gray-500 sm:py-0">All rights reserved</p>
    </div>
</footer>
</div>


<!-- Kết nối với tệp JavaScript -->
<script src="{{ asset('js/slider.js') }}">

    document.querySelector('#addToCartButton').addEventListener('click', function () {
        const productId = 1; // ID sản phẩm
        const quantity = 2;  // Số lượng

        fetch('/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ product_id: productId, quantity: quantity })
        }).then(response => response.json())
            .then(data => {
                if (data.message) alert(data.message);
                else alert(data.error);
            }).catch(error => console.error('Lỗi:', error));
    });

</script>
@endsection
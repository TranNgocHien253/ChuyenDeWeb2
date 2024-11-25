@extends('app')

@section('content')
<div class="container mx-auto px-6 mt-16">
    <div class="flex flex-wrap">
        <!-- Product Image -->
        <div class="w-full lg:w-1/2">
            <img src="data:image;base64,{{ $product->image }}" alt="{{ $product->name }}"
                class="rounded-md shadow-lg object-cover w-full h-96">
        </div>

        <!-- Product Details -->
        <div class="w-full lg:w-1/2 lg:pl-8">
            <h1 class="text-gray-800 text-3xl font-bold">{{ $product->name }}</h1>
            <p class="text-gray-600 mt-4">{{ $product->description }}</p>

            <!-- Price -->
            <div class="mt-4">
                <span class="text-gray-700 font-bold text-lg">Giá:</span>
                <span class="text-blue-600 font-bold text-2xl">${{ $product->unit_price }}</span>
            </div>

            <!-- Rating -->
            <div class="flex items-center mt-4">
                <div class="flex text-yellow-500">
                    @for ($i = 1; $i <= 5; $i++)
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="{{ $i <= $product->rating ? 'currentColor' : 'none' }}" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l2.158 6.63a1 1 0 00.95.69h6.905c.969 0 1.371 1.24.588 1.81l-5.634 4.1a1 1 0 00-.364 1.118l2.157 6.63c.3.921-.755 1.688-1.54 1.118l-5.634-4.1a1 1 0 00-1.175 0l-5.634 4.1c-.784.57-1.839-.197-1.539-1.118l2.157-6.63a1 1 0 00-.364-1.118L2.322 11.057c-.783-.57-.38-1.81.589-1.81h6.905a1 1 0 00.95-.69l2.157-6.63z" />
                        </svg>
                    @endfor
                </div>
                <span class="text-gray-600 ml-2">({{ $product->reviews_count }} đánh giá)</span>
            </div>

            <!-- Add to Cart -->
            <form action="/cart/add" method="POST" class="mt-6">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                    Thêm vào giỏ hàng
                </button>
            </form>
        </div>
    </div>

    <!-- Reviews -->
    <div class="mt-12">
        <h2 class="text-gray-800 text-2xl font-bold">Đánh giá sản phẩm</h2>
        <div class="mt-4">
            @forelse ($product->reviews as $review)
                <div class="border-b border-gray-300 pb-4 mb-4">
                    <h3 class="text-gray-700 font-bold">{{ $review->user->name }}</h3>
                    <p class="text-gray-600 text-sm">{{ $review->content }}</p>
                </div>
            @empty
                <p class="text-gray-600">Chưa có đánh giá nào.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

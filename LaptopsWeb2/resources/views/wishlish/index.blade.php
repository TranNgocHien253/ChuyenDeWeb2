@extends('app')

@section('content')
<div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
    @foreach ($products as $product)
    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden border border-gray-300">
        <div class="relative">
            <img src="{{ asset('storage/' . $product->image) }}" alt="image" class="h-56 w-full object-cover" />
        </div>

        <div class="px-5 py-3">
            <h3 class="text-gray-700 uppercase font-bold">{{ $product->name }}</h3>
            <p class="text-gray-500 text-sm mt-2">{{ $product->description }}</p>
            <span class="text-gray-500 mt-2 block">${{ $product->unit_price }}</span>
            <div class="flex items-center justify-between mt-4">
                <form action="{{ route('wishlist.remove', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-500">Xóa khỏi Wishlist</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
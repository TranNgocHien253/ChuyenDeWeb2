@extends('layouts.app') <!-- Hoặc layout bạn đang sử dụng -->

@section('content')
<div class="w-full mx-auto mt-10">
    <div class="relative w-full overflow-hidden">
        <!-- Slide Wrapper -->
        <div class="flex transition-transform duration-500 ease-out" id="slideContainer">
            <!-- Individual Slide 1 -->
            <div class="w-full flex-shrink-0">
                <img src="{{ asset('images/slide1.jpg') }}" class="w-full h-64 object-cover">
            </div>
            <!-- Individual Slide 2 -->
            <div class="w-full flex-shrink-0">
                <img src="{{ asset('images/slide2.jpg') }}" class="w-full h-64 object-cover">
            </div>
            <!-- Individual Slide 3 -->
            <div class="w-full flex-shrink-0">
                <img src="{{ asset('images/slide3.jpg') }}" class="w-full h-64 object-cover">
            </div>
        </div>

        <!-- Previous and Next Buttons -->
        <button id="prevSlide" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white p-2">
            ‹
        </button>
        <button id="nextSlide" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white p-2">
            ›
        </button>
    </div>
</div>
@endsection
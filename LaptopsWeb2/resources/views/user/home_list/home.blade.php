@extends('app')

@section('content')
@if ($slides->isNotEmpty())
<!--slides======================================================================================-->
<div class="w-full mx-auto mt-10">
    <div class="relative w-full overflow-hidden">
        <!-- Slide Wrapper -->
        <div class="flex transition-transform duration-500 ease-out" id="slideContainer">
            @foreach ($slides as $slide)
            <div class="w-full flex-shrink-0">
                <img src="{{ asset($slide->image)}}" class="w-full h-80 object-cover">
            </div>
            @endforeach
        </div>
        

        
        <!-- Previous and Next Buttons -->
        <button id="prevSlide" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white p-2">
            ‹
        </button>
        <button id="nextSlide" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white p-2">
            ›
        </button>
    </div>
    <div class="flex justify-center mt-4">
        @foreach ($slides as $index => $slide)
        <button class="dot h-2 w-2 mx-1 rounded-full bg-gray-400 opacity-50 transition-opacity duration-300 {{ $index === 0 ? 'opacity-100' : '' }}" data-index="{{ $index }}"></button>
        @endforeach
    </div>
</div>




<!--endslides==================================================================================-->



@endif

<!-- Kết nối với tệp JavaScript -->
<script src="{{ asset('js/slider.js') }}"></script>
@endsection
<!-- @extends('app')

@section('title', 'Danh sách Slides')

@section('content')
<div class="container mx-auto">

    @if ($slides->isNotEmpty())
    <div class="relative">
        <a id="slideLink" href="{{ $slides[0]->link }}">
            <img id="slideImage" src="{{ asset($slides[0]->image) }}" alt="image" class="rounded-md w-full h-[50vh] object-cover transition duration-300">
        </a>

        <button id="prevButton" class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-white p-2 rounded-full shadow hover:bg-gray-100">
            &lt;
        </button>
        <button id="nextButton" class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-white p-2 rounded-full shadow hover:bg-gray-100">
            &gt;
        </button>

        <ul id="dots" class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
            @foreach ($slides as $index => $slide)
            <li class="dot w-3 h-3 rounded-full bg-gray-700 cursor-pointer" data-index="{{ $index }}"></li>
            @endforeach
        </ul>

    </div>
    @else
    <div class="flex items-center justify-center h-[50vh] bg-gray-300">
        <p class="text-gray-500 text-lg">Không có ảnh nào để hiển thị.</p>
    </div>
    @endif

</div>

<script>
    const slides = @json($slides);
    let currentSlideIndex = 0;

    const slideImage = document.getElementById('slideImage');
    const slideLink = document.getElementById('slideLink');
    const dots = document.querySelectorAll('.dot');

    function updateSlide() {
        if (slides.length > 0) {
            slideImage.src = slides[currentSlideIndex].image;
            slideLink.href = slides[currentSlideIndex].link;


            dots.forEach((dot, index) => {
                dot.style.opacity = index === currentSlideIndex ? '1' : '0.5';
            });
        }
    }

    if (slides.length > 0) {
        document.getElementById('prevButton').addEventListener('click', () => {
            currentSlideIndex = (currentSlideIndex > 0) ? currentSlideIndex - 1 : slides.length - 1;
            updateSlide();
        });

        document.getElementById('nextButton').addEventListener('click', () => {
            currentSlideIndex = (currentSlideIndex < slides.length - 1) ? currentSlideIndex + 1 : 0;
            updateSlide();
        });


        dots.forEach(dot => {
            dot.addEventListener('click', () => {
                currentSlideIndex = parseInt(dot.getAttribute('data-index'));
                updateSlide();
            });
        });


        setInterval(() => {
            currentSlideIndex = (currentSlideIndex < slides.length - 1) ? currentSlideIndex + 1 : 0;
            updateSlide();
        }, 2000);
    }
</script>

@endsection -->
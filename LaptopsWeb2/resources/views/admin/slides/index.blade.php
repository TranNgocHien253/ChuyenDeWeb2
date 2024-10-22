@extends('app')

@section('title', 'Admin Slides')

@section('content')

<div class="container mx-auto">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
        <form action="{{ route('admin.slides.index') }}" method="GET" class="flex items-center ">
            <input type="hidden" name="page" value="{{ request('page', 1) }}">
            <select name="order" class="p-2 border rounded-lg" onchange="this.form.submit()">
                <option value="desc" {{ request('order') === 'desc' ? 'selected' : '' }}>Giảm dần</option>
                <option value="asc" {{ request('order') === 'asc' ? 'selected' : '' }}>Tăng dần</option>
            </select>
        </form>
        <form action="{{ route('admin.slides.create')}}" class="">
            <button class="bg-purple-600 text-white py-2 px-4 rounded hover:bg-blue-600">+ Thêm User</button>
        </form>
    </div>
    @if(session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif
    <!-- Table Section -->
    <div class="bg-white  overflow-hidden">
        <!-- First Row -->
        <div class="flex gap-4 items-center justify-between font-bold p-4">
            <div class="w-1/12 text-center">STT</div>
            <div class="w-3/12">
                Ảnh
            </div>
            <div class="w-6/12 break-words">
                Link
            </div>
            <div class="w-2/12 flex justify-around">
                Thao tác
            </div>
        </div>
        @foreach($slides as $slide)
        <div class="flex gap-4 items-center justify-between border rounded-2xl p-4 mt-4 hover:bg-slate-100 relative group">
            <div class="w-1/12 text-center">{{ $slides->currentPage() * $slides->perPage() - $slides->perPage() + $loop->iteration }}</div>
            <div class="w-3/12">
                <img src="{{ asset($slide->image) }}" alt="image" class="rounded-md h-24 w-auto">
            </div>
            <div class="w-6/12 break-words">
                <a href="{{ $slide->link }}" class="text-blue-500 hover:underline">{{ $slide->link }}</a>
            </div>
            <div class="w-2/12 flex justify-evenly items-center border-l-2 border-gray-300">
                <form action="{{ route('admin.slides.edit', $slide->id) }}" method="GET">
                    <button type="submit" class="px-2 py-1 rounded hover:bg-yellow-100 text-sm">
                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.9888 4.28491L19.6405 2.93089C18.4045 1.6897 16.4944 1.6897 15.2584 2.93089L13.0112 5.30042L18.7416 11.055L21.1011 8.68547C21.6629 8.1213 22 7.33145 22 6.54161C22 5.75176 21.5506 4.84908 20.9888 4.28491Z" fill="#030D45" />
                            <path d="M16.2697 10.9422L11.7753 6.42877L2.89888 15.3427C2.33708 15.9069 2 16.6968 2 17.5994V21.0973C2 21.5487 2.33708 22 2.89888 22H6.49438C7.2809 22 8.06742 21.6615 8.74157 21.0973L17.618 12.1834L16.2697 10.9422Z" fill="#030D45" />
                        </svg>
                    </button>
                </form>
                <form action="{{ route('admin.slides.destroy', $slide->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-white px-2 py-1 rounded hover:bg-red-100 text-sm" onclick="confirmDelete(event);">
                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4V4zm2 2h6V4H9v2zM6.074 8l.857 12H17.07l.857-12H6.074zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1z" fill="#0D0D0D" />
                        </svg>
                    </button>
                </form>
            </div>
            <p class="absolute bottom-full left-0 bg-purple-500 text-white text-xs p-2 rounded opacity-0 transition-opacity duration-300 group-hover:opacity-100" style="transform: translateY(-0.5rem);">
                Ngày chỉnh sửa: {{ $slide->updated_at->format('d/m/Y H:i') }}
            </p>
        </div>
        @endforeach


        <nav aria-label="Page navigation example" class="flex justify-end p-4">
            <ul class="flex items-center h-8 text-sm">
                @if ($slides->onFirstPage())
                <li>
                    <span class="flex gap-1 items-center justify-center px-3 h-8 leading-tight text-gray-500"></span>
                </li>
                @else
                <li>
                    <a href="{{ $slides->previousPageUrl() }}" class="flex gap-1 items-center justify-center px-3 h-8 leading-tight text-gray-500 hover:text-gray-700"><svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                        </svg>Pre</a>
                </li>
                @endif

                @for ($i = 1; $i <= $slides->lastPage(); $i++)
                    <li>
                        @if ($i == $slides->currentPage())
                        <span class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-blue-600 bg-blue-50 rounded-full hover:text-blue-700">{{ $i }}</span>
                        @else
                        <a href="{{ $slides->url($i) }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white rounded-full hover:bg-gray-100 hover:text-gray-700">{{ $i }}</a>
                        @endif
                    </li>
                    @endfor

                    @if ($slides->hasMorePages())
                    <li>
                        <a href="{{ $slides->nextPageUrl() }}" class="flex gap-1 items-center justify-center px-3 h-8 leading-tight text-gray-500 hover:text-gray-700">Next
                            <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                        </a>
                    </li>
                    @else
                    <li>
                        <span class="flex gap-1 items-center justify-center px-3 h-8 leading-tight text-gray-500">

                        </span>
                    </li>
                    @endif
            </ul>
        </nav>

    </div>
</div>



@endsection
<script>
    function confirmDelete(event) {
        // Hiển thị hộp thoại xác nhận
        if (!confirm('Are you sure you want to delete this slide?')) {
            event.preventDefault(); // Nếu người dùng nhấn "Cancel", ngăn không cho form được gửi
        }
    }
</script>
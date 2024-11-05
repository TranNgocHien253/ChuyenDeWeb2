@extends('app')

@section('title', 'Admin Users')

@section('content')

<div class="container mx-auto">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6 bg-blue-50 p-4 rounded-md shadow">
        <form action="{{ route('admin.user.index') }}" method="GET" class="flex items-center">
            <input type="hidden" name="page" value="{{ request('page', 1) }}">
            <select name="order" class="p-2 border rounded-lg shadow-sm" onchange="this.form.submit()">
                <option value="desc" {{ request('order') === 'desc' ? 'selected' : '' }}>Giảm dần</option>
                <option value="asc" {{ request('order') === 'asc' ? 'selected' : '' }}>Tăng dần</option>
            </select>
        </form>
        <form action="{{ route('admin.user.create') }}">
            <button class="bg-purple-600 text-white py-2 px-4 rounded hover:bg-purple-700 transition duration-150 ease-in-out">+ Thêm User</button>
        </form>
    </div>

    @if(session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <!-- Table Section -->
    <div class="overflow-hidden">
        <div class="flex gap-3 items-center font-bold py-4 bg-blue-200 text-gray-700 rounded-md">
            <div class="w-1/12 text-center">STT</div>
            <div class="w-3/12 text-left px-2">Họ tên</div>
            <div class="w-3/12 text-left px-2">Email</div>
            <div class="w-2/12 text-left px-2">SĐT</div>
            <div class="w-2/12 text-left px-2">Địa chỉ</div>
            <div class="w-2/12 text-left px-2">Giới tính</div>
            <div class="w-2/12 flex justify-evenly">Thao tác</div>
        </div>

        @foreach($profiles as $user)
        <div class="flex items-center border-b py-2 my-3 rounded-lg bg-white hover:bg-slate-100 transition duration-200 ease-in-out">
            <div class="w-1/12 text-center">{{ $profiles->currentPage() * $profiles->perPage() - $profiles->perPage() + $loop->iteration }}</div>
            <div class="w-3/12 text-left px-2">{{ $user->full_name }}</div>
            <div class="w-3/12 text-left px-2">{{ $user->email }}</div>
            <div class="w-2/12 text-left px-2">{{ $user->phone }}</div>
            <div class="w-2/12 text-left px-2">{{ $user->address }}</div>
            <div class="w-2/12 text-left px-2">{{ $user->gender }}</div>
            <div class="w-2/12 flex justify-evenly items-center border-l-2 border-gray-300">
                <form action="{{ route('admin.user.edit', $user->id) }}" method="GET">
                    <button type="submit" class="px-2 py-1 rounded hover:bg-yellow-100 text-sm transition duration-150 ease-in-out">
                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.9888 4.28491L19.6405 2.93089C18.4045 1.6897 16.4944 1.6897 15.2584 2.93089L13.0112 5.30042L18.7416 11.055L21.1011 8.68547C21.6629 8.1213 22 7.33145 22 6.54161C22 5.75176 21.5506 4.84908 20.9888 4.28491Z" fill="#030D45" />
                            <path d="M16.2697 10.9422L11.7753 6.42877L2.89888 15.3427C2.33708 15.9069 2 16.6968 2 17.5994V21.0973C2 21.5487 2.33708 22 2.89888 22H6.49438C7.2809 22 8.06742 21.6615 8.74157 21.0973L17.618 12.1834L16.2697 10.9422Z" fill="#030D45" />
                        </svg>
                    </button>
                </form>
                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-white px-2 py-1 rounded hover:bg-red-600 transition duration-150 ease-in-out text-sm" onclick="confirmDelete(event);">
                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4V4zm2 2h6V4H9v2zM6.074 8l.857 12H17.07l.857-12H6.074zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1z" fill="#0D0D0D" />
                        </svg>
                    </button>
                </form>
            </div>
            <p class="absolute bottom-full left-0 bg-purple-500 text-white text-xs p-2 rounded opacity-0 transition-opacity duration-300 group-hover:opacity-100" style="transform: translateY(-0.5rem);">
                Ngày chỉnh sửa: {{ $user->updated_at->format('d/m/Y H:i') }}
            </p>
        </div>
        @endforeach

        <!-- Pagination -->
        <nav aria-label="Page navigation example" class="flex justify-end p-4">
            <ul class="flex items-center h-8 text-sm">
                @if ($profiles->onFirstPage())
                <li><span class="flex gap-1 items-center justify-center px-3 h-8 leading-tight text-gray-500"></span></li>
                @else
                <li><a href="{{ $profiles->previousPageUrl() }}" class="flex gap-1 items-center justify-center px-3 h-8 leading-tight text-gray-500 hover:text-gray-700">Pre</a></li>
                @endif

                @for ($i = 1; $i <= $profiles->lastPage(); $i++)
                    <li>
                        @if ($i == $profiles->currentPage())
                        <span class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-blue-600 bg-blue-50 rounded-full hover:text-blue-700">{{ $i }}</span>
                        @else
                        <a href="{{ $profiles->url($i) }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white rounded-full hover:bg-gray-100 hover:text-gray-700">{{ $i }}</a>
                        @endif
                    </li>
                    @endfor

                    @if ($profiles->hasMorePages())
                    <li><a href="{{ $profiles->nextPageUrl() }}" class="flex gap-1 items-center justify-center px-3 h-8 leading-tight text-gray-500 hover:text-gray-700">Next</a></li>
                    @else
                    <li><span class="flex gap-1 items-center justify-center px-3 h-8 leading-tight text-gray-500"></span></li>
                    @endif
            </ul>
        </nav>
    </div>
</div>

<script>
    function confirmDelete(event) {
        if (!confirm('Are you sure you want to delete this user?')) {
            event.preventDefault();
        }
    }
</script>

@endsection
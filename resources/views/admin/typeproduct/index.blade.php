@extends('app')

@section('title', 'Admin Type Product')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Type Product List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('css/type1.css') }}">
</head>

<body>
    <h3>Quản Lý Loại Sản Phẩm</h3>
    <div class="top-controls">
        <div class="sort-controls">
            <button class="sort-button">Sắp xếp</button>
            <select id="perPage">
                <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
            </select>
        </div>
        <a href="{{ route('admin.typeproduct.create') }}" class="add-order-btn">Thêm Loại Sản Phẩm</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Mã Loại</th>
                <th>Tên Loại</th>
                <th>Hình Ảnh</th>
                <th>Thời Gian</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($types as $type)
                <tr>
                    <td>{{ $type->id }}</td>
                    <td>{{ $type->name_type }}</td>
                    <td><img src="{{ asset($type->image) }}" alt="{{ $type->name_type }}"
                            style="width: 100px; height: 100px;"></td>
                    <td>{{ $type->created_at ? $type->created_at->format('d/m/Y') : 'N/A' }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.typeproduct.edit', $type->id) }}" class="edit fas fa-edit"
                            title="Chỉnh sửa"></a>
                        <form action="{{ route('admin.typeproduct.destroy', $type->id) }}" method="POST" class="delete-form"
                            data-id="{{ $type->id }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="delete fas fa-trash" title="Xóa"></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $types->links('vendor.pagination.bootstrap-4') }}
    <script>
        @if(Session::has('success'))
            toastr.success('{{ Session::get('success') }}');
        @endif

        @if(Session::has('error'))
            toastr.error('{{ Session::get('error') }}');
        @endif
    </script>


    <!-- Confirmation Popup -->
    <div id="deletePopup" class="popup">
        <div class="popup-header">Thông báo</div>
        <div class="popup-message">Bạn có chắc là muốn xóa loại sản phẩm này?</div>
        <div class="popup-actions">
            <button class="confirm" id="confirmDelete">OK</button>
            <button class="cancel" id="cancelDelete">Cancel</button>
        </div>
    </div>
<<<<<<< HEAD
=======
</div>

    {{ $types->links('vendor.pagination.bootstrap-4') }}
>>>>>>> 7915b9161c2ef8dbb797f8be558fb059d7550af0

    @endsection
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('js/type_index.js') }}"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",  // You can change the position here
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>

</body>

</html>
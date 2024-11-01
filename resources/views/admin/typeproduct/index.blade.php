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
            <td><img src="{{ asset($type->image) }}" alt="{{ $type->name_type }}" style="width: 100px; height: 100px;"></td>
            <td>{{ $type->created_at ? $type->created_at->format('d/m/Y') : 'N/A' }}</td>
            <td class="actions">
                <a href="{{ route('admin.typeproduct.edit', $type->id) }}" class="edit fas fa-edit" title="Chỉnh sửa"></a>
                <form action="{{ route('admin.typeproduct.destroy', $type->id) }}" method="POST" class="delete-form" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="delete fas fa-trash" title="Xóa" onclick="confirmDelete(this)"></button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
</table>
<div id="deletePopup" style="display:none;" class="popup">
    <div class="popup-content">
        <p>Bạn có chắc chắn muốn xóa loại sản phẩm này?</p>
        <div class="popup-actions">
            <button id="cancelDelete" class="cancel">Hủy</button>
            <button id="confirmDelete" class="confirm">Xóa</button>
        </div>
    </div>
</div>


    {{ $types->links('vendor.pagination.bootstrap-4') }}

    @endsection
    <script src="{{ asset('js/type_index.js') }}"></script>

</body>

</html>
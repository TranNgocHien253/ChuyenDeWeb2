@extends('app')

@section('title', 'Admin product')

@section('content')
<style>
    .add-btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        margin-bottom: 20px;
    }
    .product-management-container {
        padding: 20px;
    }
    .product-management-container h1 {
        text-align: center;
        font-size: 24px;
        margin-bottom: 20px;
    }
    .product-table {
        width: 100%;
        border-collapse: collapse;
    }
    .product-table th, .product-table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: center;
    }
    .product-table th {
        background-color: #6a1b9a;
        color: white;
    }
    .edit-btn, .delete-btn {
        color: #fff;
        padding: 8px;
        border-radius: 4px;
        font-size: 16px;
    }
    .edit-btn {
        background-color: #1e88e5;
        margin-right: 5px;
    }
    .delete-btn {
        background-color: #e53935;
    }
    .edit-btn i, .delete-btn i {
        font-size: 14px;
    }
</style>

<div class="product-management-container">
    <h1>Quản Lý Sản Phẩm</h1>
    <a href="{{ route('admin.product.create') }}" class="add-btn">Thêm Sản Phẩm</a>
    
    <table class="product-table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên</th>
                <th>Mô tả</th>
                <th>Giá Tiền</th>
                <th>Hàng</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <!-- Vòng lặp hiển thị sản phẩm -->
            @foreach($products as $key => $product)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $product->name}}</td>
                <td>{{ $product->description }}</td>
                <td>{{$product->unit_price }} VND</td>
                <td>{{ $product->new }}</td>
                <td class="actions">
                    <a href="{{ route('admin.product.edit', $product->id) }}" class="edit fas fa-edit"
                        title="Chỉnh sửa"></a>
                    <form action="{{ route('admin.product.destroy',$product->id) }}" method="POST" class="delete-form"
                        data-id="{{ $product->id }}" style="display:inline;">
                        @csrf
                        
                        <button type="button" class="delete fas fa-trash" title="Xóa" onclick="confirmDelete()"></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function confirmDelete(button) {
        if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?")) {
            // Tìm form chứa nút 'delete' và submit form
            button.closest('form').submit();
        }
    }
</script>

{{-- <div class="product-management-container">
    <table class="product-table">
        <tbody>
            <!-- Giả sử bạn đang trong vòng lặp hiển thị sản phẩm -->
            @foreach($products as $key => $product)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->unit_price }} VND</td>
                <td>{{ $product->new }}</td>
                <td class="actions">
                    <a href="{{ route('admin.product.edit', $product->id) }}" class="edit-btn">Chỉnh sửa</a>
                    
                    <!-- Form xóa sản phẩm -->
                    <form action="" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="delete delete-btn" onclick="confirmDelete(this)">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div> --}}


@endsection
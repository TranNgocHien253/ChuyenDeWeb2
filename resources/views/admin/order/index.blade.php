@extends('app')

@section('title', 'Admin Order')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/orders1.css')}}">
</head>

<body>
    <h3>Quản Lý Đơn Hàng</h3>
    <div class="top-controls">
        <div class="sort-controls">
            <button class="sort-button">Sắp xếp</button>
            <select id="perPage">
                <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
            </select>
        </div>
        <a href="{{ route('admin.order.create') }}" class="add-order-btn">Thêm Đơn Hàng</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Mã ĐH</th>
                <th>Người nhận</th>
                <th>Tổng Tiền</th>
                <th>Thời gian</th>
                <th>Trạng Thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $key => $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ number_format($order->total, 3, '.', '.') }}</td>
                    <td>{{ $order->updated_at ? $order->updated_at->format('d/m/Y') : $order->created_at->format('d/m/Y') }}
                    </td>
                    <td>
                        <span class="status {{ $order->status }}">
                            {{ $order->status === 'approved' ? 'Đã Duyệt' : ($order->status === 'rejected' ? 'Thất bại' : 'Chờ duyệt') }}
                        </span>
                    </td>
                    <td class="actions">
                        <a href="{{ route('admin.order.edit', $order->id) }}" class="edit fas fa-edit"
                            title="Chỉnh sửa"></a>
                        <form action="{{ route('admin.order.destroy', $order->id) }}" method="POST" class="delete-form"
                            data-id="{{ $order->id }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="delete fas fa-trash" title="Xóa"></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $orders->links('vendor.pagination.bootstrap-4') }}


    <!-- Confirmation Popup -->
    <div id="deletePopup" class="popup">
        <div class="popup-header">Thông báo</div>
        <div class="popup-message">Bạn có chắc là muốn xóa đơn hàng này?</div>
        <div class="popup-actions">
            <button class="confirm" id="confirmDelete">OK</button>
            <button class="cancel" id="cancelDelete">Cancel</button>
        </div>
    </div>
    @endsection
    <script src="{{asset('js/orders_index.js')}}"></script>
</body>

</html>
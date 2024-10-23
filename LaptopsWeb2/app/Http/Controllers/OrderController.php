<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\TypeProduct;
use App\Models\Product;

class OrderController extends Controller
{
    // Hiển thị danh sách đơn hàng
    public function index(Request $request)
    {
        // Get the number of items per page from the request or set a default
    $perPage = $request->input('perPage', 10);

    // Retrieve the orders with pagination
    $orders = Order::paginate($perPage);

    return view('admin.order.index', compact('orders'));
    }

    // Hiển thị form thêm đơn hàng
    public function create()
    {
        $categories = TypeProduct::all(); // Lấy tất cả danh mục
        $products = Product::all(); // Lấy tất cả sản phẩm
        return view('admin.order.add', compact('categories', 'products'));
    }

    // Lưu đơn hàng mới vào database
    public function store(Request $request)
    {
        // Thêm 'status' với giá trị mặc định là 'Đã duyệt'
        $data = $request->all();
        $data['status'] = 'Approved';
        $order = Order::create($request->all());
        return redirect()->route('admin.order.index')->with('success', 'Đơn hàng đã được thêm thành công.');
    }

    // Hiển thị form chỉnh sửa đơn hàng
    public function edit($id)
    {
        $order = Order::find($id);
        $categories = TypeProduct::all(); // Lấy tất cả danh mục
        $products = Product::all(); // Lấy tất cả sản phẩm
        return view('admin.order.edit', compact('order', 'categories', 'products'));
    }

    // Cập nhật đơn hàng
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->update($request->all());
        return redirect()->route('admin.order.index')->with('success', 'Đơn hàng đã được cập nhật thành công.');
    }

    // Xóa đơn hàng
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->route('admin.order.index')->with('success', 'Đơn hàng đã được xóa.');
    }
}

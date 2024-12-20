<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\TypeProduct;
use App\Models\Product;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    // Mã hóa ID
    private function encodeId($id)
    {
        return Str::random(10) . base64_encode($id);
    }

    // Giải mã ID
    private function decodeId($encodedId)
    {
        $decoded = base64_decode(substr($encodedId, 10));
        return is_numeric($decoded) ? $decoded : null;
    }

    // Hiển thị danh sách đơn hàng
    public function index(Request $request)
    {
        // Lấy số lượng mục mỗi trang từ yêu cầu hoặc thiết lập mặc định
        $perPage = $request->input('perPage', 10);

        // Lấy danh sách đơn hàng với phân trang
        $orders = Order::paginate($perPage);

        // Mã hóa ID cho mỗi đơn hàng
        $encodedIds = $orders->map(function($order) {
            return $this->encodeId($order->id);
        });

        return view('admin.order.index', compact('orders', 'encodedIds'));
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
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $data = $request->all();
        $data['status'] = 'Approved'; // Đặt trạng thái mặc định
        Order::create($data);

        return redirect()->route('admin.order.index')->with('success', 'Đơn hàng đã được thêm thành công!');
    }

    // Hiển thị form chỉnh sửa đơn hàng
    public function edit($encodedId, Request $request)
    {
        $id = $this->decodeId($encodedId);
        if (!$id) {
            return redirect()->route('admin.order.index')->with('error', 'URL không hợp lệ.');
        }

        $order = Order::find($id);
        if (!$order) {
            return redirect()->route('admin.order.index')->with('error', 'Đơn hàng không tồn tại.');
        }

        $categories = TypeProduct::all();
        $products = Product::all();

        return view('admin.order.edit', compact('order', 'categories', 'products', 'encodedId'));
    }

    // Cập nhật đơn hàng
    public function update(Request $request, $encodedId)
    {
        $id = $this->decodeId($encodedId);
        if (!$id) {
            return redirect()->route('admin.order.index')->with('error', 'URL không hợp lệ.');
        }

        $order = Order::find($id);
        if (!$order) {
            return redirect()->route('admin.order.index')->with('error', 'Đơn hàng không tồn tại.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $order->update($request->all());

        return redirect()->route('admin.order.index')->with('success', 'Đơn hàng đã được cập nhật thành công.');
    }

    // Xóa đơn hàng
    public function destroy($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return redirect()->route('admin.order.index')->with('error', 'Đơn hàng không tồn tại hoặc đã bị xóa.');
        }

        $order->delete();

        return redirect()->route('admin.order.index')->with('success', 'Đơn hàng đã được xóa thành công.');
    }
}
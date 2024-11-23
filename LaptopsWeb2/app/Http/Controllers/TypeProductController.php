<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeProduct;

class TypeProductController extends Controller
{
    // Hiển thị danh sách loại sản phẩm
    public function index(Request $request)
    {
        // Lấy số lượng mục mỗi trang từ yêu cầu hoặc thiết lập mặc định
        $perPage = $request->input('perPage', 10);

        // Lấy danh sách loại sản phẩm với phân trang
        $types = TypeProduct::paginate($perPage);

        return view('admin.typeproduct.index', compact('types'));
    }

    // Hiển thị form thêm loại sản phẩm
    public function create()
    {
        return view('admin.typeproduct.add'); // Hiển thị form thêm loại sản phẩm
    }

    // Lưu loại sản phẩm mới vào database
    public function store(Request $request)
    {
        // Thêm validation cho hình ảnh
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Xử lý hình ảnh
        if ($request->hasFile('image')) {
            // Lưu hình ảnh vào thư mục public/images
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            // Lưu thông tin vào cơ sở dữ liệu
            $data = $request->all();
            $data['image'] = 'images/' . $imageName; // Lưu đường dẫn hình ảnh
            $data['status'] = 'Approved';
            TypeProduct::create($data);

            return redirect()->route('admin.typeproduct.index')->with('success', 'Danh mục đã được thêm thành công.');
        }

        return redirect()->back()->with('error', 'Vui lòng chọn hình ảnh.');
    }

    // Hiển thị form chỉnh sửa loại sản phẩm
    public function edit($id)
    {
        // Kiểm tra ID có hợp lệ hay không (chỉ cho phép số)
        if (!preg_match('/^\d+$/', $id)) {
            return redirect()->route('admin.typeproduct.index')->with('error', 'URL không hợp lệ để tìm danh mục.');
        }

        // Kiểm tra nếu ID không tồn tại
        $typeProduct = TypeProduct::find($id);
        if (!$typeProduct) {
            return redirect()->route('admin.typeproduct.index')->with('error', 'Danh mục này không thể tìm thấy.');
        }

        $typeProduct = TypeProduct::findOrFail($id); // Tìm loại sản phẩm theo ID
        return view('admin.typeproduct.edit', compact('typeProduct')); // Truyền biến $typeProduct vào view
    }

    public function update(Request $request, $id)
    {
        // Tìm loại sản phẩm
        $typeProduct = TypeProduct::find($id);
        if (!$typeProduct) {
            // Nếu không tìm thấy, chuyển hướng với thông báo lỗi
            return redirect()->route('admin.typeproduct.index')->with('error', 'Loại sản phẩm không tồn tại.');
        }

        // Validate dữ liệu từ request
        $data = $request->validate([
            'name_type' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Xử lý ảnh nếu được tải lên
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($typeProduct->image) {
                $oldImagePath = public_path($typeProduct->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            // Lưu ảnh mới
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/type_products'), $imageName);
            $data['image'] = 'images/type_products/' . $imageName;
        }

        // Cập nhật thông tin loại sản phẩm
        $typeProduct->update($data);

        // Trả về trang danh sách với thông báo thành công
        return redirect()->route('admin.typeproduct.index')->with('success', 'Loại sản phẩm đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        // Tìm loại sản phẩm
        $typeProduct = TypeProduct::find($id);
        if (!$typeProduct) {
            return redirect()->route('admin.typeproduct.index')->with('error', 'Danh mục này không thể tìm thấy hoặc đã bị xóa.');
        }

        // Lấy tất cả sản phẩm thuộc loại sản phẩm
        $products = $typeProduct->products; // Lấy các sản phẩm liên quan

        // Kiểm tra xem có sản phẩm không
        if ($products->isNotEmpty()) {
            foreach ($products as $product) {
                // Tìm tất cả đơn hàng liên quan đến sản phẩm
                $orders = $product->orders; // Tìm các đơn hàng liên quan đến sản phẩm

                // Kiểm tra xem $orders có phải là một collection không
                if ($orders && $orders->isNotEmpty()) {
                    foreach ($orders as $order) {
                        $order->delete(); // Xóa đơn hàng
                    }
                }

                // Xóa hình ảnh của sản phẩm nếu có
                if ($product->image) {
                    $oldProductImagePath = public_path($product->image);
                    if (file_exists($oldProductImagePath)) {
                        unlink($oldProductImagePath); // Xóa tệp hình ảnh
                    }
                }

                // Xóa sản phẩm
                $product->delete();
            }
        }

        // Xóa hình ảnh của loại sản phẩm nếu có
        if ($typeProduct->image) {
            $oldImagePath = public_path($typeProduct->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); // Xóa tệp hình ảnh
            }
        }

        // Cuối cùng, xóa loại sản phẩm
        $typeProduct->delete();

        return redirect()->route('admin.typeproduct.index')->with('success', 'Loại sản phẩm và các sản phẩm liên quan đã được xóa thành công.');
    }
}

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
        $typeProduct = TypeProduct::findOrFail($id); // Tìm loại sản phẩm theo ID
        return view('admin.typeproduct.edit', compact('typeProduct')); // Truyền biến $typeProduct vào view
    }

    // Cập nhật loại sản phẩm
    public function update(Request $request, $id)
    {
        $type = TypeProduct::findOrFail($id);

        // Validate the request
        $data = $request->validate([
            'name_type' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($type->image) {
                $oldImagePath = public_path($type->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            // Store the new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/type_products'), $imageName);
            $data['image'] = 'images/type_products/' . $imageName; // Update image path
        } else {
            // If no new image is uploaded, retain the old image path
            $data['image'] = $type->image;
        }

        // Update the type product with the validated data
        $type->update($data);

        return redirect()->route('admin.typeproduct.index')->with('success', 'Loại sản phẩm đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        $type = TypeProduct::findOrFail($id); // Tìm loại sản phẩm theo ID

        // Kiểm tra xem có sản phẩm liên quan không
        if ($type->products()->count() > 0) {
            // Nếu có sản phẩm liên quan, trả về thông báo xác nhận
            return response()->json([
                'message' => 'Loại sản phẩm này có sản phẩm liên quan. Vui lòng xóa sản phẩm trước.',
                'confirm' => true
            ]);
        }

        // Kiểm tra xem có đơn hàng liên quan không
        if ($type->orders()->count() > 0) {
            // Nếu có đơn hàng liên quan, trả về thông báo xác nhận
            return response()->json([
                'message' => 'Loại sản phẩm này có đơn hàng liên quan. Vui lòng xóa đơn hàng trước.',
                'confirm' => true
            ]);
        }

        // Xóa hình ảnh nếu có
        if ($type->image) {
            \Storage::disk('public')->delete($type->image);
        }

        // Xóa loại sản phẩm
        $type->delete();

        return response()->json([
            'message' => 'Loại sản phẩm đã được xóa thành công!',
            'confirm' => false
        ]);
    }

}

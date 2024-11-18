<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request) {
        $order = $request->input('order', 'desc');
        $products = Product::orderBy('unit_price', $order)->get(); 
        return view("admin.product.manageProduct", compact('products', 'order'));
    }
    
    
    // public function create() {
    //     return view('admin.product.create');
    // }
    public function create()
{
    return view('admin.product.create'); // Trả về trang form tạo sản phẩm
}

public function store(Request $request)
{
    // Validate dữ liệu
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'unit_price' => 'required|numeric',
        'new' => 'required|boolean',
        'id_type' => 'required|integer',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $imageName = base64_encode(file_get_contents($request->file('image')->path()));

    // Tạo sản phẩm mới
    $product = new Product();
    $product->name = $request->input('name');
    $product->description = $request->input('description');
    $product->unit_price = $request->input('unit_price');
    $product->new = $request->input('new');
    $product->id_type = $request->input('id_type');
    $product->image = $imageName; // Lưu đường dẫn ảnh
    $product->save();

    return redirect()->route('admin.product.index')->with('success', 'Sản phẩm đã được thêm!');
}





    // public function store(Request $request) {
    //     // Validate dữ liệu
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'unit_price' => 'required|numeric',
    //         'new' => 'required|boolean',
    //     ]);
    
    //     // Tạo sản phẩm mới
    //     products::create([
    //         'name' => $request->name,
    //         'description' => $request->description,
    //         'unit_price' => $request->unit_price,
    //         'new' => $request->new,
    //     ]);
    
    //     // Quay lại trang quản lý sản phẩm
    //     return redirect()->route('admin.product.index')->with('success', 'Sản phẩm đã được thêm!');
    // }
    public function edit($id)
    {
        // Tìm sản phẩm theo ID
        $product = Product::findOrFail($id);
    
        // Trả về view chỉnh sửa với thông tin sản phẩm
        return view('admin.product.edit', compact('product'));
    }
    public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $product->update([
        'name' => $request->name,
        'description' => $request->description,
        'unit_price' => $request->unit_price,
        'new' => $request->new,
    ]);

    return redirect()->route('admin.product.index')->with('success', 'Sản phẩm đã được cập nhật thành công!');
}
public function destroy($id)
{
    // Tìm và xóa sản phẩm theo ID
    $product = Product::findOrFail($id);
    $product->delete();

    // Chuyển hướng về trang quản lý sản phẩm với thông báo thành công
    return redirect()->route('admin.product.index')->with('success', 'Sản phẩm đã được xóa thành công!');
}



    
    
    

}





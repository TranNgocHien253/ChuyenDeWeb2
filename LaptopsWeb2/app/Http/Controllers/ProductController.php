<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view("admin.product.manageProduct", compact('products'));
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
    // Tạo đối tượng Product mới và gán các giá trị từ form
    $product = new Product();
    $product->name = $request->input('name');
    $product->description = $request->input('description');
    $product->unit_price = $request->input('unit_price');
    $product->promotion_price = $request->input('promotion_price');
    $product->new = $request->input('new');
    $product->id_type = $request->input('id_type'); // Gán giá trị id_type từ request
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
    $product = Product::where('id', $id)->firstOrFail();
    $product->delete();

    // Chuyển hướng về trang quản lý sản phẩm với thông báo thành công
    return redirect()->route('admin.product.index')->with('success', 'Sản phẩm đã được xóa thành công!');
}



    
    
    

}





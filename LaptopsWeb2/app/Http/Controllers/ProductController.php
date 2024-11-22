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
        'unit_price' => 'required|numeric|min:0',
        'new' => 'required|boolean',
        'id_type' => 'required|integer',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
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

public function show($id)
{
    $product = Product::with('reviews')->findOrFail($id); // Lấy sản phẩm cùng các đánh giá
    return view('admin.product.detail', compact('product'));
}

// app/Http/Controllers/ProductController.php

// public function search(Request $request)
// {
//     $keyword = $request->input('keyword');
//     $products = Product::where('name', 'like', '%' . $keyword . '%')
//                         ->orWhere('description', 'like', '%' . $keyword . '%')
//                         ->paginate(10);

//     return view('product.index', compact('products'));
// }






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
    $request->validate([
        'name' => 'required|max:255',
        'description' => 'required',
        'unit_price' => 'required|numeric|min:0',
        'new' => 'required|boolean',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120' 
    ]);

    $product = Product::findOrFail($id);
    
    $data = $request->only(['name', 'description', 'unit_price', 'new']);
    
    if ($request->hasFile('image')) {
        $imageName = base64_encode(file_get_contents($request->file('image')->path()));
        $data['image'] = $imageName;
    }

    $product->update($data);

    return redirect()
        ->route('admin.product.index')
        ->with('success', 'Sản phẩm đã được cập nhật thành công!');
}
public function destroy($id)
{
    // Tìm và xóa sản phẩm theo ID
    $product = Product::findOrFail($id);
    $product->delete();

    // Chuyển hướng về trang quản lý sản phẩm với thông báo thành công
    return redirect()->route('admin.product.index')->with('success', 'Sản phẩm đã được xóa thành công!');
}




    
public function userProduct()
{
     
    
}
   
    

}





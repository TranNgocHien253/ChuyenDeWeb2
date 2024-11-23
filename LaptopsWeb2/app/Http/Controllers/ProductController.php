<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\TypeProduct; // Import model TypeProduct

class ProductController extends Controller
{
    public function index(Request $request) {
        $order = $request->input('order', 'desc');
        $products = Product::orderBy('unit_price', $order)->get(); 
        return view("admin.product.manageProduct", compact('products', 'order'));
    }

    // Giữ lại một phương thức create duy nhất
    public function create()
    {
        // Lấy tất cả các loại sản phẩm từ bảng type_products
        $typeProducts = TypeProduct::all(); 

        // Trả về view cùng với dữ liệu loại sản phẩm
        return view('admin.product.create', compact('typeProducts'));
    }

    public function store(Request $request)
{
    // Validate data
    $request->validate([
        'name' => 'required|string|max:255',
        'description' =>  'required|max:200',
        'unit_price' => 'required|numeric|min:1',
        'new' => 'required|boolean',
        'id_type' => 'required|integer',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        'quantity' => 'required|integer|min:0', // Validate quantity
    ]);

    // Handle image upload
    $imageName = base64_encode(file_get_contents($request->file('image')->path()));

    // Create a new product
    $product = new Product();
    $product->name = $request->input('name');
    $product->description = $request->input('description');
    $product->unit_price = $request->input('unit_price');
    $product->new = $request->input('new');
    $product->id_type = $request->input('id_type');
    $product->image = $imageName;
    $product->quantity = $request->input('quantity'); // Store the quantity
    $product->save();

    return redirect()->route('admin.product.index')->with('success', 'Sản phẩm đã được thêm!');
}


    public function show($id)
    {
        $product = Product::with('reviews')->findOrFail($id); // Lấy sản phẩm cùng các đánh giá
        return view('admin.product.detail', compact('product'));
    }

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
            'description' => 'required|max:200',
            'unit_price' => 'required|numeric|min:1',
            'new' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'quantity' => 'required|integer|min:0', // Validate quantity
        ]);
    
        $product = Product::findOrFail($id);
    
        $data = $request->only(['name', 'description', 'unit_price', 'new', 'quantity']); // Add 'quantity' here
    
        if ($request->hasFile('image')) {
            $imageName = base64_encode(file_get_contents($request->file('image')->path()));
            $data['image'] = $imageName;
        }
    
        $product->update($data);  // Update the product with the new data
    
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
}

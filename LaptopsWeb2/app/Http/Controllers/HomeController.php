<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use App\Models\Product;
use App\Models\TypeProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        $slides = Slide::orderBy('updated_at', 'desc')->take(25)->get();
        if (Auth::check() && Auth::user()->role == 1) {
            // Trả về view trang chủ cho admin
            return view('user.home_list.homeadmin', compact('slides'));
        }
        $products = Product::all();
        $typeProducts = TypeProduct::withCount('products')->get(); // Thêm withCount
        return view('user.home_list.home', compact('slides', 'products', 'typeProducts'));
    }

    // public function userProduct(Request $request){
    //     $order = $request->input('order', 'desc');
    //     $products = Product::orderBy('unit_price', $order)->get(); 
    //     return view("admin.product.usersProducts", compact('products', 'order'));

    // }
    public function userProduct(Request $request)
    {
        $order = $request->input('order', 'desc');
        $products = Product::orderBy('unit_price', $order)->paginate(10); // Lấy 10 sản phẩm mỗi trang
        return view("admin.product.usersProducts", compact('products', 'order'));
    }
    public function productDetail($id)
    {
        $product = Product::findOrFail($id); // Tìm sản phẩm theo ID, lỗi nếu không tìm thấy
        return view('admin.product.productDetail', compact('product')); // Trả về view với thông tin sản phẩm
    }
    public function seachProduct(Request $request)
{
    $query = Product::query();

    // Check if there's a search term and filter products by name or description
    if ($request->has('search') && $request->search != '') {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        });
    }

    // Get slides for the homepage
    $slides = Slide::orderBy('updated_at', 'desc')->take(25)->get();

    // Get product types
    $typeProducts = TypeProduct::orderBy('name_type', 'asc')->take(25)->get();

    // Paginate products
    $products = $query->paginate(9);

    return view('user.home_list.home', compact('products', 'slides', 'typeProducts'));
}

    

    public function getProductsByType($id)
    {
        try {
            // Thêm tham số page và limit
            $page = request()->get('page', 1);
            $limit = 4;
            $offset = ($page - 1) * $limit;

            $products = Product::where('id_type', $id)
                ->skip($offset)
                ->take($limit + 1) // Lấy thêm 1 sản phẩm để kiểm tra có còn sản phẩm không
                ->get();

            $hasMore = $products->count() > $limit;

            if ($hasMore) {
                $products = $products->take($limit);
            }

            return response()->json([
                'status' => 'success',
                'products' => $products,
                'hasMore' => $hasMore,
                'nextPage' => $hasMore ? $page + 1 : null
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không thể tải sản phẩm'
            ]);
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\TypeProduct;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('search');
    
        if (!$query) {
            return back()->with('message', 'Vui lòng nhập từ khóa tìm kiếm.');
        }
    
        // Tìm kiếm trong bảng users theo `full_name` và `email`
        $profiles = User::where('full_name', 'LIKE', '%' . $query . '%')
            ->orWhere('email', 'LIKE', '%' . $query . '%')
            ->paginate(10);
    
        if ($profiles->isNotEmpty()) {
            return view('admin.user.index', compact('profiles'));
        }
    
        // Tìm kiếm trong bảng products theo `name` và `description`
        $products = Product::where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('description', 'LIKE', '%' . $query . '%')
            ->get();
    
        if ($products->isNotEmpty()) {
            return view('admin.product.manageProduct', compact('products'));
        }
    
        // Tìm kiếm trong bảng type_products theo `name_type`
        $types = TypeProduct::where('name_type', 'LIKE', '%' . $query . '%')->paginate(10);
    
        if ($types->isNotEmpty()) {
            return view('admin.typeproduct.index', compact('types'));
        }
    
        // Tìm kiếm trong bảng orders theo `name`
        $orders = Order::where('name', 'LIKE', '%' . $query . '%')->paginate(10);
    
        if ($orders->isNotEmpty()) {
            return view('admin.order.index', compact('orders'));
        }
    
        // Nếu không có kết quả nào từ tất cả các bảng
        return back()->with('message', 'Không tìm thấy kết quả nào.');
    }
    
}

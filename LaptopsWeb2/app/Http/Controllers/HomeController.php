<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use App\Models\Product;
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
        return view('user.home_list.home', compact('slides'));
    }

    public function userProduct(Request $request){
        $order = $request->input('order', 'desc');
        $products = Product::orderBy('unit_price', $order)->get(); 
        return view("admin.product.usersProducts", compact('products', 'order'));
      
    }
}

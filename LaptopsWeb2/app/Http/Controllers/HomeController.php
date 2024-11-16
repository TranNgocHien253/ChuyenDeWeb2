<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
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
        return view('user.home_list.home', compact('slides','products'));
    }



public function getPoduct()
{
   
}
}

<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $slides = Slide::orderBy('updated_at', 'desc')->take(25)->get();

        // // Kiểm tra xem slides có dữ liệu không
        // if ($slides->isEmpty()) {
        //     // Nếu không có slides, bạn có thể trả về một thông báo hoặc xử lý khác
        //     return view('user.home_list.home')->with('message', 'No slides available.');
        // }

        return view('user.home_list.home', compact('slides'));
    }
}

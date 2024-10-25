<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        // Validate the form data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('user.home');
        }

        // Nếu xác thực thất bại, redirect về với lỗi
        return redirect()->back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng.',
        ])->withInput($request->only('email'));
    }


    public function index()
    {
        return view('header.dashbroad'); // Đường dẫn đến giao diện dashboard
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login'); // Chuyển hướng về trang đăng nhập
    }
}

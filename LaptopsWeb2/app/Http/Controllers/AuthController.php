<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Phương thức hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('login');
    }

    // Phương thức xử lý đăng nhập
    public function login(Request $request)
    {
        // Xác thực thông tin đăng nhập
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công, chuyển hướng tới trang chủ
            return redirect()->intended('/');
        }

        // Đăng nhập thất bại, quay lại form đăng nhập với thông báo lỗi
        return back()->with('error', 'Email hoặc mật khẩu không chính xác.');
    }

    // Phương thức đăng xuất
    public function logout()
    {
        // Đảm bảo rằng chúng ta xóa sạch session khi logout
        Auth::logout();
        session()->flush();

        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); // Tạo view `auth.register` để hiển thị form đăng ký.
    }

    public function register(Request $request)
    {
        // Validate dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

          // Kiểm tra định dạng email và các lỗi khác
          if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Kiểm tra email có tồn tại trong hệ thống không
        $existingUser = User::where('email', $request->input('email'))->first();
        if ($existingUser) {
            // Nếu email tồn tại và tài khoản đã kích hoạt
            if ($existingUser->is_activated) {
                return redirect()->back()->withErrors(['email' => 'Tài khoản đã được kích hoạt.'])->withInput();
            }
            return redirect()->back()->withErrors(['email' => 'Email đã tồn tại trong hệ thống.'])->withInput();
        }

        // Tạo người dùng mới
        $user = User::create([
            'full_name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'is_activated' => false, // Giả sử tài khoản chưa kích hoạt ngay sau khi tạo
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công! Vui lòng kiểm tra email để kích hoạt tài khoản.');
    }
}

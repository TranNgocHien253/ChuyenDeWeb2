<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        $user = User::withTrashed()->where('email', $credentials['email'])->first();

        if ($user && $user->trashed()) {
            // Kiểm tra nếu tài khoản còn trong thời gian khôi phục
            $deletionTime = $user->deleted_at;
            $currentTime = now();
            $restoreLimit = $deletionTime->addSeconds(30); // Thời gian cho phép khôi phục là 30 ngày

            if ($currentTime <= $restoreLimit) {
                return view('user.profile.restore', ['user' => $user]);
            } else {
                // Nếu quá thời gian khôi phục, xóa tài khoản khỏi DB
                $user->forceDelete();
                return back();
            }
        }
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        } else {
            return back()->withErrors([
                'email' => 'Thông tin đăng nhập không hợp lệ.',
            ]);
        }


        return back()->with('error', 'Email hoặc mật khẩu không chính xác.');
    }

    public function logout()
    {

        Auth::logout();
        session()->flush();

        return redirect('/');
    }
}

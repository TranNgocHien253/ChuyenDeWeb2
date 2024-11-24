<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

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

    // Hiển thị form quên mật khẩu
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // Xử lý gửi link reset mật khẩu
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    // Hiển thị form đặt lại mật khẩu
    public function showResetPasswordForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    // Xử lý đặt lại mật khẩu
    // Xử lý đặt lại mật khẩu
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Password reset successfully.')
            : back()->withErrors(['email' => trans($status)]);
    }
}

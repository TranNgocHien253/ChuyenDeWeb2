<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;


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

     // Redirect to Google login // Redirect to Google login
    // Redirect Google login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->setHttpClient(new Client(['verify' => false])) // Tắt SSL Verification
                ->user();
    
            // Kiểm tra nếu Google trả về email
            if (!$googleUser->getEmail()) {
                return redirect('login')->with('error', 'Không thể đăng nhập. Tài khoản Google không có email.');
            }
    
            // Kiểm tra xem người dùng đã tồn tại trong database chưa
            $user = User::where('email', $googleUser->getEmail())->first();
    
            if (!$user) {
                // Tạo mới người dùng nếu chưa tồn tại
                $user = User::create([
                    'full_name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt('random_password'), // Tạo mật khẩu ngẫu nhiên
                    'imageAvatar' => $googleUser->getAvatar(),
                    'gender' => 'Not specified', // Cập nhật theo yêu cầu của bạn
                    'address' => 'Unknown',
                    'phone' => 'Unknown',
                    'role' => 0, // Vai trò mặc định
                ]);
            } else {
                // Nếu người dùng đã tồn tại, có thể cập nhật một số thông tin (như ảnh đại diện)
                $user->update([
                    'imageAvatar' => $googleUser->getAvatar(),
                ]);
            }
    
            // Đăng nhập người dùng ngay sau khi tạo hoặc tìm thấy
            Auth::login($user);
    
            // Chuyển hướng tới trang chủ
            return redirect()->intended('/');
        } catch (\Exception $e) {
            Log::error('Google Login Error: ' . $e->getMessage());
            return redirect('login')->with('error', 'Đăng nhập thất bại, vui lòng thử lại.');
        }
    }
    

    
    
}

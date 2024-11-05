<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Kiểm tra người dùng có đăng nhập không
        $user = Auth::user();
        if (!$user) {
            return redirect('login');
        }

        // Chuyển giá trị vai trò thành số để so sánh
        $roleValue = $role === 'admin' ? 1 : 0;

        // Kiểm tra vai trò của người dùng
        if ($user->role !== $roleValue) {
            return redirect('/')->with('error', 'Bạn không có quyền truy cập vào trang này');
        }

        return $next($request);
    }
}

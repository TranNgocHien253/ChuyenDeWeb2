<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    // Hiển thị danh sách người dùng
    public function index()
    {
        $order = request('order', 'desc'); // Mặc định là 'desc'
        $profiles = User::orderBy('updated_at', $order)->paginate(10)->appends(['order' => $order]);

        return view('admin.users.index', compact('profiles'));
    }

    // Hiển thị form tạo người dùng
    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // Validate data
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'gender' => 'nullable|string|in:male,female,other',
            'imageAvatar' => 'nullable|image|max:2048',
        ]);

        // Create user
        $user = User::create([
            'full_name' => $request->full_name, // Đảm bảo trường này có giá trị
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
        ]);

        // Lưu ảnh nếu có
        if ($request->hasFile('imageAvatar')) {
            $path = $request->file('imageAvatar')->store('users/images', 'public');
            $user->imageAvatar = $path;
            $user->save();
        }

        return redirect()->route('admin.user.index')->with('success', 'User created successfully');
    }




    // Hiển thị form chỉnh sửa người dùng
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Xử lý việc cập nhật thông tin người dùng
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Xác thực dữ liệu nhập vào
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:10',
        ]);

        $user->full_name = $request->full_name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->gender = $request->gender;

        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'User updated successfully');
    }

    // Xử lý việc xóa người dùng
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'User deleted successfully');
    }
}

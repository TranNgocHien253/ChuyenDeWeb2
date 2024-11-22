<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Hiển thị danh sách người dùng
    public function index()
    {
        $order = request('order', 'desc'); // Mặc định là 'desc'
        $profiles = User::orderBy('updated_at', $order)->paginate(5)->appends(['order' => $order]);

        return view('admin.user.index', compact('profiles'));
    }

    public function showProfile()
    {
        $user = auth()->user();
        return view('user.profile.index', compact('user'));
    }



    // Hiển thị form tạo người dùng
    public function create()
    {
        return view('admin.user.create');
    }
    // Xử lý việc tạo thông tin người dùng
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:3',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'
            ],
            'imageAvatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Allow image files
            'gender' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:15',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $imagePath = null;
        if ($request->hasFile('imageAvatar')) {
            $imagePath = $request->file('imageAvatar')->store('avatars', 'public');
        }

        User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'imageAvatar' => $imagePath,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
        return redirect()->route('admin.user.create')
            ->with('success', 'User created successfully');
    }




    public function edit($id)
    {
        $user = User::findOrFail($id);
        if (Auth::check() && Auth::user()->role !== 1) {
            // Trả về view trang chủ cho admin
            return view('user.profile.edit', compact('user'));
        }
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Tìm người dùng, bao gồm cả người dùng đã bị xóa mềm
        $user = User::withTrashed()->find($id);

        if (!$user) {
            // Nếu người dùng không tồn tại, chuyển hướng về trang danh sách với thông báo
            return redirect()->route('admin.user.index')
                ->with('error', 'Người dùng không tồn tại.');
        }

        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
        }

        // Kiểm tra mật khẩu mới không trùng với mật khẩu cũ
        if ($request->password && Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->withErrors(['password' => 'Mật khẩu mới không được trùng với mật khẩu cũ.'])
                ->withInput();
        }

        // Thực hiện cập nhật dữ liệu
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => [
                'nullable',
                'string',
                'min:6',
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/'
            ],
            'imageAvatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gender' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:15',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Nếu có file ảnh mới
        if ($request->hasFile('imageAvatar')) {
            if ($user->imageAvatar) {
                // Xóa ảnh cũ nếu có
                Storage::disk('public')->delete($user->imageAvatar);
            }
            $imagePath = $request->file('imageAvatar')->store('avatars', 'public');
            $user->imageAvatar = $imagePath;
        }

        // Cập nhật các thông tin khác
        $user->full_name = $request->full_name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->save();

        if (Auth::user()->role === 1) {
            // Nếu là admin, chuyển về trang admin.user.index
            return redirect()->route('admin.user.index')
                ->with('success', "Cập nhật thông tin người dùng {$user->full_name} thành công.");
        } else {
            // Nếu là user, chuyển về trang user.profile.edit
            return redirect()->route('profile')
                ->with('success', "Cập nhật thông tin của bạn thành công.");
        }
    }


    public function destroyfe($id)
    {
        // Tìm người dùng, bao gồm cả người dùng đã bị xóa mềm
        $user = User::withTrashed()->find($id);

        if (!$user) {
            // Nếu không tìm thấy người dùng, báo lỗi và chuyển hướng
            return redirect()->route('admin.user.index')
                ->with('error', 'Người dùng không tồn tại.');
        }

        // Xóa vĩnh viễn người dùng (bất kể trạng thái xóa mềm)
        $user->forceDelete();

        return redirect()->route('admin.user.index')
            ->with('success', "Xóa người dùng {$user->full_name} thành công");
    }


    // Xử lý việc xóa người dùng nhưng còn lưu
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        if (Auth::check() && Auth::id() === $user->id) {
            // Đăng xuất người dùng ngay sau khi xóa tài khoản
            Auth::logout();

            // Hủy session và làm mới token CSRF
            session()->invalidate();
            session()->regenerateToken();

            // Chuyển hướng về trang login với thông báo
            return redirect('/login')->with('success', 'Tài khoản của bạn đã bị xóa. Phiên của bạn đã hết.');
        }

        return redirect()->route('profile')->with('success', "Xóa người dùng {$user->full_name} thành công");
    }
    public function showRecoveryForm()
    {
        return view('user.profile.restoreaccount'); // Trả về view chứa form khôi phục tài khoản
    }
    public function restoreUser($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        if ($user->trashed()) {
            $user->restore(); // Khôi phục người dùng
            return redirect()->route('login')->with('message', 'Khôi phục tài khoản thành công. Vui lòng đăng nhập.');
        }
        return redirect()->route('login')->with('message', 'Người dùng không cần khôi phục.');
    }
}

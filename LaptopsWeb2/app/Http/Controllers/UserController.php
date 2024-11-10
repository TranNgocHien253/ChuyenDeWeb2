<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
            'password' => 'required|string|min:3',
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
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

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
            // return response()->json($validator->errors(), 422);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('imageAvatar')) {
            if ($user->imageAvatar) {
                Storage::disk('public')->delete($user->imageAvatar);
            }

            $imagePath = $request->file('imageAvatar')->store('avatars', 'public');
            $user->imageAvatar = $imagePath;
        }

        $user->full_name = $request->full_name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'Cập nhật người dùng thành công');
    }

    // Xử lý việc xóa người dùng
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'User deleted successfully');
    }
}

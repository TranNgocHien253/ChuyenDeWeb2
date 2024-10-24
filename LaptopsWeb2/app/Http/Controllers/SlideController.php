<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    // Hiển thị slide
    public function index()
    {
        // $slides = Slide::all();

        $order = request('order', 'desc'); //Mặc định Là 'desc'

        $slides = Slide::orderBy('updated_at', $order)->paginate(3)->appends(['order' => $order]);

        return view('admin.slides.index', compact('slides'));
    }

    // Thêm slide
    public function create()
    {
        return view('admin.slides.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Slide::create([
            'link' => $request->link,
            'image' => 'images/' . $imageName,
        ]);

        return redirect()->route('admin.slides.create')->with('success', 'Slide added successfully!');
    }

    // Sửa slide
    public function edit($id)
    {
        $slide = Slide::findOrFail($id);
        return view('admin.slides.edit', compact('slide'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'link' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $slide = Slide::findOrFail($id);
        $slide->link = $request->link;
        if ($request->hasFile('image')) {
            if (file_exists(public_path($slide->image))) {
                unlink(public_path($slide->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $slide->image = 'images/' . $imageName;
        }

        $slide->save();
        return redirect()->route('admin.slides.index')->with('success', "Slide với ID: {$slide->id} đã được sửa thành công!");
    }

    // Xóa slide
    public function destroy($id)
    {
        // Kiểm tra quyền của người dùng
        // if (Auth::user()->cannot('delete', Slide::class)) {
        //     abort(403); // Nếu không có quyền, trả về lỗi 403
        // }

        $slide = Slide::findOrFail($id);
        if (file_exists(public_path($slide->image))) {
            unlink(public_path($slide->image));
        }
        $slide->delete();

        return redirect()->route('admin.slides.index')->with('success', "Slide {$slide->id} deleted successfully!");
    }
}

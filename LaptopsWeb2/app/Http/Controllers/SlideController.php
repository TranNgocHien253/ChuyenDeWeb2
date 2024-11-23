<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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
        $id = Crypt::decryptString($id);
        $slide = Slide::findOrFail($id);
        return view('admin.slides.edit', compact('slide'));
    }

    public function update(Request $request, $encryptedId)
    {
        $id = Crypt::decryptString($encryptedId);
        $request->validate([
            'link' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Tìm slide
        $slide = Slide::find($id);

        // Nếu không tìm thấy slide, trả về thông báo lỗi
        if (!$slide) {
            return redirect()->route('admin.slides.index')
                ->withErrors(['error' => 'Slide không tồn tại hoặc đã bị xóa.']);
        }

        // Cập nhật thông tin slide
        $slide->link = $request->link;

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($slide->image && file_exists(public_path($slide->image))) {
                unlink(public_path($slide->image));
            }

            // Lưu ảnh mới
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $slide->image = 'images/' . $imageName;
        }

        $slide->save();
        $encryptedId = Crypt::encryptString($slide->id);
        $shortEncryptedId = substr($encryptedId, 0, 20) . '...';
        return redirect()->route('admin.slides.index')
            ->with('success', "Slide với ID: {$shortEncryptedId} đã được sửa thành công!");
    }



    // Xóa slide
    public function destroy($id)
    {
        // Tìm slide theo ID
        $slide = Slide::find($id);

        if (!$slide) {
            // Nếu không tìm thấy slide, trả về thông báo lỗi
            return redirect()->route('admin.slides.index')
                ->with('error', 'Slide không tồn tại.');
        }

        // Kiểm tra nếu file ảnh tồn tại và xóa nó
        if ($slide->image && file_exists(public_path($slide->image))) {
            unlink(public_path($slide->image));
        }

        // Xóa slide
        $slide->delete();

        return redirect()->route('admin.slides.index')
            ->with('success', "Slide {$slide->link} xóa thành công!");
    }
}

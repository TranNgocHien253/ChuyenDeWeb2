<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Phương thức để hiển thị form Contact
    public function show()
    {
        return view('contact');
    }

    // Phương thức để gửi email
    public function send(Request $request)
    {
        // Xác thực dữ liệu nhập vào
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Gửi email
        Mail::to('tranngocyen12122003@gmail.com')->send(new ContactMail($validated));

        // Thông báo thành công và chuyển hướng
        return redirect()->route('contact')->with('success', 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm.');
    }
}

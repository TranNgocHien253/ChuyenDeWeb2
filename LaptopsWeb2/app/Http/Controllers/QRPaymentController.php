<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRPaymentController extends Controller
{
    public function generateQR()
    {
        // Thông tin thanh toán
        $bankCode = "VCB"; // Mã ngân hàng (VD: Vietcombank)
        $accountNo = "123456789"; // Số tài khoản
        $accountName = "Nguyen Van A"; // Tên tài khoản
        $amount = 500000; // Số tiền (VND)
        $description = "Thanh toan don hang"; // Nội dung

        // Chuỗi dữ liệu QR
        $qrData = json_encode([
            "bankCode" => $bankCode,
            "accountNo" => $accountNo,
            "accountName" => $accountName,
            "amount" => $amount,
            "description" => $description,
        ]);

        // Tạo QR Code
        $qrCode = QrCode::size(200)->generate($qrData);

        return view('payment.qr-simple', compact('qrCode'));
    }
}

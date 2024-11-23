<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    
    public function getBankAccount()
{
    // Truy vấn dữ liệu từ bảng bank_accounts
    $bankAccount = BankAccount::first(); 
    return response()->json($bankAccount);
}
}

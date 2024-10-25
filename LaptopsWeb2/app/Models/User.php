<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Các thuộc tính có thể gán bằng cách sử dụng mảng $fillable
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'imageAvatar',
        'gender',
        'address',
        'phone',
    ];

    // Các thuộc tính bị ẩn khi model được chuyển thành mảng hoặc JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Các thuộc tính sẽ được tự động chuyển đổi kiểu
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
    
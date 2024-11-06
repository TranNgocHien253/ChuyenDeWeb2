<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'id_type', 'description', 'unit_price', 'promotion_price', 'image', 'new', 'quantity'];

    public function typeProduct()
    {
        return $this->belongsTo(TypeProduct::class, 'id_type'); // Use id_type as the foreign key
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'product_id'); // Khóa ngoại phải là 'product_id'
    }
}

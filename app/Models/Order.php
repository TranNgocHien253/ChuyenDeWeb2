<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'product_id',
        'name',
        'phone',
        'quantity',
        'address',
        'total',
        'price',
        'status',
        'create_at',
        'update_at',
    ];
    // Mối quan hệ đến loại sản phẩm (Category)
    public function category()
    {
        return $this->belongsTo(TypeProduct::class, 'category_id');
    }

    // Mối quan hệ đến sản phẩm (Product)
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

<?php   

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'unit_price', 'new', 'id_type', 'image', 'quantity'];


    // Mối quan hệ với TypeProduct
    public function typeProduct()
    {
        return $this->belongsTo(TypeProduct::class, 'id_type'); // Use id_type as the foreign key
    }

    // Mối quan hệ với Order
    public function orders()
    {
        return $this->hasMany(Order::class, 'product_id'); // Khóa ngoại phải là 'product_id'
    }

    // Mối quan hệ với Review
    public function reviews()
    {
        return $this->hasMany(Review::class); // Product has many reviews
    }
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'product_id', 'description', 'rating'];

    // Mối quan hệ với Product
    public function product()
    {
        return $this->belongsTo(Product::class); // Review belongs to Product
    }
}

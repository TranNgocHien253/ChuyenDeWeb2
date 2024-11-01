<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeProduct extends Model
{
    use HasFactory;

    protected $fillable = ['name_type', 'image', 'created_at', 'updated_at'];

    public function products()
    {
        return $this->hasMany(Product::class, 'id_type'); // Make sure to reference id_type here
    }
}

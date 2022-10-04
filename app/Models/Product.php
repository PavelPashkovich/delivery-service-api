<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'vendor_code',
    ];

    public function orders() {
        return $this->belongsToMany(Order::class, 'order_products', 'product_id', 'order_id');
    }
}

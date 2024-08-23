<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;

    protected $fillable = ['cantidad'];

    // Relación con el modelo Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'id_orden');
    }

    // Relación con el modelo Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_producto');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

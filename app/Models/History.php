<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = ['cantidad'];

    //Relación con el modelo User
    public function user()
    {
        return $this->hasMany(User::class, 'user_id');
    }

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
}

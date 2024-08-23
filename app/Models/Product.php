<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'imagen',' descripcion', 'cantidad', 'precio', 'estado'];

    public function user()
    {
        return $this->hasMany(User::class, 'user_id');
    }

    // public function order()
    // {
    //     return $this->belongsToMany(Product::class, 'productospedidos', 'id_orden', 'id_producto'); //Aquí, belongsToMany recibe cuatro parámetros opcionales:
    //                                                                                                 // El modelo relacionado: En este caso, Product::class.
    //                                                                                                 // El nombre de la tabla intermedia: En tu caso, productospedidos.
    //                                                                                                 // La clave foránea de Order en la tabla intermedia: id_orden.
    //                                                                                                 // La clave foránea de Product en la tabla intermedia: id_producto.
    // }
    public function order()
    {
        return $this->belongsToMany(Order::class, 'productsorders', 'id_producto', 'id_orden')
                    ->withPivot('cantidad', 'user_id') // Incluye el campo 'cantidad' desde la tabla intermedia
                    ->withTimestamps();
    }

    public function productorder()
    {
        return $this->hasMany(ProductOrder::class, 'id_producto');
    }

}

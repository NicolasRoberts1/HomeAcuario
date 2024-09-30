<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    //No se aún si quiero que las ordenes se puedan modificar o solo se mueda cambiar el estado...
    protected $fillable = ['fecha', 'cliente', 'direccion', 'pago', 'total', 'pre_entrega', 'observacion', 'estado'];

    // Definir la relación con el modelo Product
    // public function product()
    // {
    //     return $this->belongsToMany(Product::class, 'productospedidos', 'id_orden', 'id_producto'); //Aquí, belongsToMany recibe cuatro parámetros opcionales:
    //                                                                                                 // El modelo relacionado: En este caso, Product::class.
    //                                                                                                 // El nombre de la tabla intermedia: En tu caso, productospedidos.
    //                                                                                                 // La clave foránea de Order en la tabla intermedia: id_orden.
    //                                                                                                 // La clave foránea de Product en la tabla intermedia: id_producto.
    // }
    public function product()
    {
        return $this->belongsToMany(Product::class, 'productsorders', 'id_orden', 'id_producto')
                    ->withPivot('cantidad', 'user_id') // Incluye el campo 'cantidad' desde la tabla intermedia
                    ->withTimestamps();
    }

    public function productorder()
    {
        return $this->hasMany(ProductOrder::class, 'id_orden');
    }

    // Definir la relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function history(){
        return $this->belongsTo(History::class, 'id_orden');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "cart";
    protected $fillable = [
        'product_id', 'quantity', 'price','customer_id'
    ];

    public $timestamps = false;

    public function infoProduct(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}

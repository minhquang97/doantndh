<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "product";
    protected $fillable = [
        'code', 'name', 'product_type_id', 'image', 'cost_price', 'cost_sale', ' title','description', 'unit', 'status'
    ];

    public $timestamps = false;

    public function hasType(){
        return $this->hasOne(ProductType::class, 'id', 'product_type_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "product_type";
    protected $fillable = [
        'name', 'description'
    ];

    public $timestamps = false;

}

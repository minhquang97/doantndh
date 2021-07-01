<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = "coupon";
    protected $fillable = [
        'coupon_code', 'value', 'expire','customer_id','status',
    ];

    public $timestamps = false;

    public function customer()
    {
        return $this->beLongsTo(Customer::class);
    }

    public function hasCustomer($customer_id)
    {
        return $this->customer()->where('id', $customer_id)->first();
    }
}

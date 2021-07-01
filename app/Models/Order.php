<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends Model
{
    protected $table = "order";
    protected $fillable = [
        'customer_id', 'address', 'coupon_id','order_detail', 'order_date','status',
    ];

    public $timestamps = false;

    public function hasCustomer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function coupon()
    {
        return $this->beLongsTo(Coupon::class);
    }

    public function hasCoupon($coupon_id)
    {
        return $this->coupon()->where('id', $coupon_id)->first();
    }
}

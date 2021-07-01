<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guard = "customer";
    protected $table = "customer";
    protected $fillable = [
        'id','name', 'email', 'phone', 'address', 'date_of_birth', ' gender','deleted'
    ];

    public $timestamps = false;
    protected $hidden = [
    'password', 'remember_token',
];

}

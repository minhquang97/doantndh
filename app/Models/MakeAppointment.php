<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MakeAppointment extends Model
{
    protected $table = "make_appointment";
    protected $fillable = [
        'first_name', 'last_name', 'email','phone','subject', 'description', 'status', 'created_date','closed_date','creator_id' ,
    ];

    public $timestamps = false;

    public function creator()
    {
        return $this->hasOne(User::class, 'id', 'creator_id');
    }
}

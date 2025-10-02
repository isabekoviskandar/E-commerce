<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = 
    [
        'session_id',
        'first_name',
        'last_name',
        'address',
        'phone',
        'total',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}

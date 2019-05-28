<?php

namespace App\Models;

class Order extends BaseModel
{
    protected $fillable = [
        'user_id', 'amount', 'coupon', 'status', 'shipping_address', 'notes'
    ];
}
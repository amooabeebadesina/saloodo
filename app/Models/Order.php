<?php

namespace App\Models;

class Order extends BaseModel
{
    protected $fillable = [
        'user_id', 'amount', 'coupon', 'status', 'shipping_address', 'notes'
    ];

    protected $hidden = [
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
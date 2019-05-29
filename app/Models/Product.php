<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;

class Product extends BaseModel
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'price', 'discount', 'description'
    ];

    public function bundles()
    {
        return $this->belongsToMany(Product::class, 'bundle_product', 'product_id', 'bundle_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'bundle_product', 'bundle_id', 'product_id');
    }

}
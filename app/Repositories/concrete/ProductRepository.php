<?php

namespace App\Repositories\concrete;

use App\Models\Product;
use App\Repositories\contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    protected $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    public function create($data)
    {
        return $this->product->create($data);
    }

    public function getAll()
    {
        return $this->product->paginate(20);
    }
}
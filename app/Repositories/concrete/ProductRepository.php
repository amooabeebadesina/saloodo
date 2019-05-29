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
        return $this->product->with('products')->paginate(20);
    }

    public function update($id, $data)
    {
        return $this->product->where('id', $id)->update($data);
    }

    public function createBundle($data)
    {
        $bundle = $this->product->create($data);
        $bundle->products()->attach($data['products']);
        return $bundle;
    }
}
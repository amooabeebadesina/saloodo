<?php


namespace App\Repositories\concrete;

use App\Models\Order;
use App\Repositories\contracts\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{

    protected $order;

    public function __construct()
    {
        $this->order = new Order();
    }

    public function create($data)
    {
        $order = $this->order->create($data);
        $order->products()->attach($data['products']);
        return $order;
    }
}
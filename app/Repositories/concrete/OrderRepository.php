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
        foreach ($data['products'] as $product) {
            $order->products()->attach($product['id'], ['quantity' => $product['quantity']]);
        }
        return $order;
    }

    public function getAllOrders()
    {
       return $this->order->with('products', 'user')->paginate(20);
    }

    public function getCustomerOrders($customerId)
    {
        return $this->order->where('user_id', $customerId)->with('products', 'user')->paginate(20);
    }
}
<?php


namespace App\Repositories\contracts;


interface OrderRepositoryInterface
{

    public function create($data);

    public function getAllOrders();

    public function getCustomerOrders($customerId);

}
<?php


namespace App\Utils;


class OrderUtil
{

    public static function calculateAmount($products)
    {
        $amount = 0;
        foreach ($products as $product) {
            $discount = ($product['discount']/100) * $product['price'];
            $amount += ($product['price'] - $discount) * $product['quantity'];
        }
        return $amount;
    }
}
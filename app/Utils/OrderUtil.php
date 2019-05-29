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

    public static function stripProductIds($products)
    {
        $ids = [];
        foreach ($products as $product) {
            array_push($ids,  $product['id']);
        }
        return $ids;
    }
}
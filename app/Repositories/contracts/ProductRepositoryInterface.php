<?php


namespace App\Repositories\contracts;


interface ProductRepositoryInterface
{

    public function create($data);

    public function getAll();

    public function update($id, $data);
}
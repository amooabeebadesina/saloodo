<?php


namespace App\Repositories\contracts;


interface UserRepositoryInterface
{
    public function authenticate($data);

}
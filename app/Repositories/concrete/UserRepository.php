<?php


namespace App\Repositories\concrete;

use App\Models\User;
use App\repositories\contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{

    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function authenticate($data)
    {
        $user = $this->user->where('email', $data['email'])->first();
        if (!$user) {
            return null;
        } else if (!Hash::check($data['password'], $user->password)) {
            return null;
        }
        return $user;
    }
}
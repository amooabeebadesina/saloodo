<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->email = 'admin@saloodo.com';
        $user->password = Hash::make('demo123');
        $user->role = 'admin';
        $user->first_name = 'John';
        $user->last_name = 'Doe';
        $user->save();

        $user = new User();
        $user->email = 'customer@saloodo.com';
        $user->password = Hash::make('demo123');
        $user->role = 'customer';
        $user->first_name = 'Customer';
        $user->last_name = 'Rose';
        $user->save();
    }
}

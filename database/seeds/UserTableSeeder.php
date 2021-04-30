<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        $users = array(
            [
                'name' => 'freddy herrera',
                'email' => 'jhon@hotmail.com',
                'password' => Hash::make('12345678')
            ],
            [
                'name' => 'garrido',
                'email' => 'luis@gmail.com',
                'password' => Hash::make('123456789')
            ]
        );
        foreach ($users as $user) {
            User::updateOrCreate($user);
        }
    }
}

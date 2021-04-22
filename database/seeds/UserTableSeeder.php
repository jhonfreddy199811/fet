<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        $users = array(
            [
                'name' => 'David Mosquera',
                'email' => 'davidmosquerahi@gmail.com',
                'password' => \Hash::make('12345678')
            ]
            );
            foreach($users as $user){
                User::updateOrCreate($user);
            }
    }
}

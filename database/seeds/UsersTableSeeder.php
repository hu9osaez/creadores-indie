<?php

use CreadoresIndie\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Hugo',
            'username' => 'hu9osaez',
            'email' => 'hu9osaez@gmail.com',
            'password' => 'hola12345.'
        ]);
    }
}

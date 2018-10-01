<?php

use CreadoresIndie\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name = 'admin';
        $admin->display_name = 'User Administrator';
        $admin->description  = 'User is allowed to manage and edit all the features.';
        $admin->save();
    }
}

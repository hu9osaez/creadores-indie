<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriesTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(RolesTableSeeder::class);

        if (app()->environment() !== 'production') {
            $this->call(UsersTableSeeder::class);
            $this->call(DiscussionsTableSeeder::class);
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class DiscussionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CreadoresIndie\Models\Discussion::class, 5)->create()->each(function ($d) {

        });
    }
}

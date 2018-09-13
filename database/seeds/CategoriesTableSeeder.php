<?php

use CreadoresIndie\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Presentaciones',
                'order' => 1,
                'color' => '#3498DB'
            ],
            [
                'name' => 'General',
                'order' => 2,
            ],
            [
                'name' => 'Recursos',
                'order' => 3,
                'color' => '#1ABC9C'
            ],
            [
                'name' => 'Retroalimentación',
                'order' => 4,
                'color' => '#F39C12'
            ],
        ];

        foreach($categories as $category) {
            Category::create($category);
        }
    }
}

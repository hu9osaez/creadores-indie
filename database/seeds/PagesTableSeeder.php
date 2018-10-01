<?php

use CreadoresIndie\Models\Page;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function run()
    {
        $privacyContent = File::get(database_path('data') . '/privacy.md');

        Page::create([
            'title' => 'Política de privacidad',
            'content' => $privacyContent,
            'slug' => 'privacy'
        ]);
    }
}

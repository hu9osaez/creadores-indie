<?php

use CreadoresIndie\Models\Category;
use CreadoresIndie\Models\Discussion;
use CreadoresIndie\Models\User;
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
        $categories = Category::all();
        $user = User::whereEmail('hu9osaez@gmail.com')->first();

        factory(Discussion::class, 50)
            ->make()
            ->each(function (Discussion $discussion) use ($categories, $user) {
                $category = $categories->random();

                $discussion->category()->associate($category);
                $discussion->user()->associate($user);
                $discussion->save();
            });
    }
}
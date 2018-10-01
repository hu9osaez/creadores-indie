<?php

use CreadoresIndie\Models\Category;
use CreadoresIndie\Models\Discussion;
use CreadoresIndie\Models\Reply;
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

                factory(Reply::class, rand(1, 10))
                    ->make()
                    ->each(function (Reply $reply) use ($discussion, $user) {
                        $reply->discussion()->associate($discussion);
                        $reply->user()->associate($user);
                        $reply->save();
                    });
            });
    }
}

<?php namespace CreadoresIndie\Http\Controllers\Front;

use CreadoresIndie\Http\Controllers\Controller;
use CreadoresIndie\Models\Category;
use CreadoresIndie\Models\Discussion;
use CreadoresIndie\Models\User;
use Sitemap;

class SitemapsController extends Controller
{
    public function index()
    {
        Sitemap::addSitemap(route('front::sitemap.categories'));
        Sitemap::addSitemap(route('front::sitemap.discussions'));
        Sitemap::addSitemap(route('front::sitemap.users'));

        return Sitemap::index();
    }

    public function categories()
    {
        $categories = Category::latest()->get();

        foreach ($categories as $category) {
            Sitemap::addTag(
                $category->url,
                $category->updated_at,
                'monthly',
                '0.4'
            );
        }

        return Sitemap::render();
    }

    public function discussions()
    {
        $discussions = Discussion::with('category')->latest()->get();

        foreach ($discussions as $discussion) {
            $tag = Sitemap::addTag(
                $discussion->url(),
                $discussion->updated_at,
                'daily',
                '0.8'
            );

            if($discussion->has_social_preview) {
                $tag->addImage($discussion->social_preview_url, $discussion->title);
            }
        }

        return Sitemap::render();
    }

    public function users()
    {
        $users = User::latest()->get();

        foreach ($users as $user) {
            Sitemap::addTag(
                $user->url,
                $user->updated_at,
                'weekly',
                '0.6'
            );
        }

        return Sitemap::render();
    }

}

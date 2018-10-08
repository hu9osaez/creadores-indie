<?php namespace CreadoresIndie\Http\Controllers\Front;

use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use CreadoresIndie\Events\DiscussionWasCreated;
use CreadoresIndie\Http\Controllers\Controller;
use CreadoresIndie\Http\Requests\PublishDiscussionRequest;
use CreadoresIndie\Models\Category;
use CreadoresIndie\Models\Discussion;
use Purifier;

class DiscussionController extends Controller
{
    use SEOToolsTrait;

    public function show($category, $slug)
    {
        $discussion = Discussion::with(['category', 'user', 'replies.user'])
            ->whereHas('category', function ($query) use ($category) {
                $query->where('slug', '=', $category);
            })
            ->whereSlug($slug)
            ->firstOrFail();

        $category = $discussion->category;
        $user = $discussion->user;
        $replies = $discussion->replies->sortByDesc('created_at');

        /**
         * SEO
         */
        $this->seo()->metatags()->addMeta('article:section', $category->name, 'property');
        $this->seo()->metatags()->addMeta('article:published_time', $discussion->created_at->toW3cString(), 'property');
        $this->seo()->metatags()->setCanonical($discussion->url);
        $this->seo()->opengraph()->setUrl($discussion->url);
        $this->seo()->opengraph()->setTitle($discussion->title);
        $this->seo()->opengraph()->setDescription($discussion->excerpt);
        $this->seo()->opengraph()->setType('article');
        $this->seo()->twitter()->setType('summary_large_image');
        $this->seo()->twitter()->setTitle($discussion->title);
        $this->seo()->twitter()->setDescription($discussion->excerpt);

        if($discussion->has_social_preview) {
            $this->seo()->opengraph()->addImage($discussion->social_preview_url);
            \SEO::twitter()->setImage($discussion->social_preview_url);
        }

        return view('front.discussion.show', compact('category', 'discussion', 'user', 'replies'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get()->pluck('name', 'slug');
        $selectedCategory = request()->query('c');

        return view('front.discussion.create', compact('categories', 'selectedCategory'));
    }

    public function store(PublishDiscussionRequest $request)
    {
        $category = Category::whereSlug($request->category)->firstOrFail();

        /** @var \CreadoresIndie\Models\User $user */
        $user = auth()->user();

        $newDiscussion = new Discussion();
        $newDiscussion->title = $request->title;
        $newDiscussion->body = Purifier::clean($request->body);

        $newDiscussion->category()->associate($category);
        $newDiscussion->user()->associate($user);

        if ($newDiscussion->save()) {
            event(new DiscussionWasCreated($newDiscussion));

            $user->upvote($newDiscussion);
            $user->increment('discussions_count');
            $newDiscussion->increment('upvotes_count');

            return redirect()
                ->route('front::discussion.show', [$category->slug, $newDiscussion->slug])
                ->with([
                    'message' => 'El tema fue publicado correctamente.',
                    'message_type' => 'is-success'
                ]);
        } else {
            return redirect()->back()->with([
                'message' => 'Ocurrío un problema al publicar el tema, intenta nuevamente.',
                'message_type' => 'is-danger'
            ]);
        }
    }
}

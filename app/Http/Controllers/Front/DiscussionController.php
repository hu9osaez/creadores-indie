<?php namespace CreadoresIndie\Http\Controllers\Front;

use CreadoresIndie\Events\DiscussionWasCreated;
use CreadoresIndie\Http\Controllers\Controller;
use CreadoresIndie\Http\Requests\PublishDiscussionRequest;
use CreadoresIndie\Models\Category;
use CreadoresIndie\Models\Discussion;
use Purifier;

class DiscussionController extends Controller
{
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

            $user->increment('discussions_count');

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

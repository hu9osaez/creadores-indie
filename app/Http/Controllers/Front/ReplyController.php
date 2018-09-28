<?php namespace CreadoresIndie\Http\Controllers\Front;

use CreadoresIndie\Http\Controllers\Controller;
use CreadoresIndie\Http\Requests\PublishReplyRequest;
use CreadoresIndie\Models\Discussion;
use CreadoresIndie\Models\Reply;

class ReplyController extends Controller
{
    public function store($category, $slug, PublishReplyRequest $request)
    {
        /** @var \CreadoresIndie\Models\User $user */
        $user = auth()->user();
        $discussion = Discussion::with('category')
            ->whereHas('category', function ($query) use ($category) {
                $query->where('slug', '=', $category);
            })
            ->whereSlug($slug)
            ->firstOrFail();

        $category = $discussion->category;

        $newReply = new Reply();
        $newReply->body = $request->body;
        $newReply->discussion()->associate($discussion);
        $newReply->user()->associate($user);

        if ($newReply->save()) {
            $discussion->increment('replies_count');

            //event(new ReplyCreated($newReply));

            return redirect()->route('front::discussion.show', [$category->slug, $discussion->slug]);
        } else {
            return redirect()->back()->with([
                'message' => 'Ocurrío un problema al publicar el comentario, intenta nuevamente.',
                'message_type' => 'is-danger'
            ]);
        }
    }
}

<?php namespace CreadoresIndie\Http\Controllers\Front;

use CreadoresIndie\Events\ReplyWasCreated;
use CreadoresIndie\Http\Controllers\Controller;
use CreadoresIndie\Http\Requests\PublishReplyRequest;
use CreadoresIndie\Models\Discussion;
use CreadoresIndie\Models\Reply;
use Purifier;

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
        $newReply->body = Purifier::clean($request->body);
        $newReply->discussion()->associate($discussion);
        $newReply->user()->associate($user);

        if ($newReply->save()) {
            $discussion->increment('replies_count');
            $discussion->last_reply_at = now();
            $discussion->save();

            event(new ReplyWasCreated($newReply));

            return redirect()
                ->route('front::discussion.show', [$category->slug, $discussion->slug])
                ->with([
                    'message' => 'Comentario agregado correctamente.',
                    'message_type' => 'is-success',
                    'is-reply' => true
                ]);
        } else {
            return redirect()->back()->with([
                'message' => 'Ocurrío un problema al publicar el comentario, intenta nuevamente.',
                'message_type' => 'is-danger',
                'is-reply' => true
            ]);
        }
    }
}

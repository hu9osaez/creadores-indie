<?php namespace CreadoresIndie\Http\Controllers\Front;

use CreadoresIndie\Http\Controllers\Controller;
use CreadoresIndie\Models\Discussion;

class UpvoteController extends Controller
{
    public function toggleUpvoteDiscussion($encodedId)
    {
        $decodedId = $this->optimus->decode($encodedId);

        $discussion = Discussion::find($decodedId);

        if (is_null($discussion)) {
            return response()->json([
                'success' => false,
                'code' => '@discussion/not_found'
            ]);
        }

        /** @var \CreadoresIndie\Models\User $user */
        $user = auth()->user();

        if ($discussion->isUpvotedBy($user)) {
            $user->cancelVote($discussion);
            $discussion->decrement('upvotes_count');

            $response = [
                'success' => true,
                'code' => '@discussion/upvote_removed',
                'upvotes_count' => $discussion->upvotes_count
            ];
        } else {
            $user->upvote($discussion);
            $discussion->increment('upvotes_count');

            $response = [
                'success' => true,
                'code' => '@discussion/upvote_added',
                'upvotes_count' => $discussion->upvotes_count
            ];
        }

        return response()->json($response);
    }
}

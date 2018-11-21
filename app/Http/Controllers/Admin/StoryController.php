<?php namespace CreadoresIndie\Http\Controllers\Admin;

use CreadoresIndie\Http\Requests\Admin\CreateStoryRequest;
use CreadoresIndie\Models\Story;
use CreadoresIndie\Http\Controllers\Controller;
use CreadoresIndie\Models\User;

class StoryController extends Controller
{
    public function index()
    {
        $stories = Story::with('user')->latest()->paginate();

        return view('admin.stories.index', compact('stories'));
    }

    public function create()
    {
        $users = User::orderBy('name')
            ->get(['name', 'username'])
            ->pluck('name', 'username');

        return view('admin.stories.create', compact('users'));
    }

    public function store(CreateStoryRequest $request)
    {
        $user = User::whereUsername($request->user)->firstOrFail();

        $story = new Story();
        $story->title = $request->title;
        $story->content = $request->body;
        $story->start_date = carbonize($request->start_date);
        $story->mrr = $request->mrr;
        $story->user()->associate($user);

        if($story->save()) {
            return redirect()->route('radar::stories.index')->with([
                'message' => 'Historia registrada correctamente.',
                'message_type' => 'is-success'
            ]);
        }
        else {
            return redirect()->back()->with([
                'message' => 'La historia no fue registrada, intenta nuevamente.',
                'message_type' => 'is-danger'
            ]);
        }
    }
}

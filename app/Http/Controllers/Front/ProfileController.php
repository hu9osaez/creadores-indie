<?php namespace CreadoresIndie\Http\Controllers\Front;

use CreadoresIndie\Http\Controllers\Controller;
use CreadoresIndie\Models\User;

class ProfileController extends Controller
{
    public function show($username)
    {
        $user = User::with('discussions')->whereUsername($username)->firstOrFail();
        $discussions = $user->discussions()->with('category', 'user')->paginate();

        return view('front.profile.show', compact('user', 'discussions'));
    }
}

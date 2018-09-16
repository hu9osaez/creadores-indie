<?php namespace CreadoresIndie\Http\Controllers\Front;

use CreadoresIndie\Models\User;
use CreadoresIndie\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show($username)
    {
        $user = User::whereUsername($username)->firstOrFail();

        dd($user);
    }
}

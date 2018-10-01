<?php namespace CreadoresIndie\Http\Controllers\Front;

use CreadoresIndie\Http\Controllers\Controller;
use CreadoresIndie\Models\User;

class UserController extends Controller
{
    public function show($username)
    {
        $user = User::whereUsername($username)->firstOrFail();

        dd($user);
    }
}

<?php namespace CreadoresIndie\Http\Controllers\Front;

use CreadoresIndie\Http\Controllers\Controller;
use CreadoresIndie\Models\Discussion;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discussions = Discussion::with(['category', 'user'])
            ->latest()
            ->paginate();

        return view('front.home', compact('discussions'));
    }
}

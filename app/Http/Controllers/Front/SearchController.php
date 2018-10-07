<?php namespace CreadoresIndie\Http\Controllers\Front;

use CreadoresIndie\Models\Discussion;
use Illuminate\Http\Request;
use CreadoresIndie\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $discussions = Discussion::search($request->query('q'))
            ->with(['category', 'user'])
            ->latest()
            ->paginate();

        $isSearch = true;

        return view('front.home', compact('discussions', 'isSearch'));
    }
}

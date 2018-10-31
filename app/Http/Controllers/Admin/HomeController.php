<?php namespace CreadoresIndie\Http\Controllers\Admin;

use CreadoresIndie\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }
}

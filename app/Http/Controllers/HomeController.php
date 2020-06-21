<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Post;
use App\Form;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'pages' => Page::orderBy('created_at', 'desc')->take(5)->get(),
            'posts' => Post::orderBy('created_at', 'desc')->take(5)->get(),
            'forms' => Form::orderBy('created_at', 'desc')->take(5)->get()
        ];
        return view('home')->with($data);
    }
}

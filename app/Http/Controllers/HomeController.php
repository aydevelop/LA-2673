<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::orderBy('id','desk')->take(10)->get();
        $postsOther = Post::orderBy('id','ask')->take(12)->get();
        $populars = Post::orderBy('views','ask')->take(10)->get();
        $users = User::all();

        return view('home', compact('posts','postsOther','populars','users'));
    }
}

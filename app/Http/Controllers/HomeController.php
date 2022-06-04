<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function  __invoke()
    {
        //OBTENER A QUIENES SEGUIMOS
        $ids = auth()->user()->followings->pluck('id')->toArray();
        // dd(auth()->user()->followings->pluck('id')->toArray());
        $posts = Post::whereIn('id', $ids)->latest()->paginate(10);
        // dd($posts);

        return view('home', compact('posts'));
    }
}

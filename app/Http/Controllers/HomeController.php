<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        if (auth()->user() == null) {
            return redirect()->route('login');
        }
        $ids = auth()->user()->followings->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->paginate(20);

        return view('home', ['posts' => $posts]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $latestPosts = Post::latest()->take(5)->get();
        return view('home', compact('latestPosts'));
    }
}

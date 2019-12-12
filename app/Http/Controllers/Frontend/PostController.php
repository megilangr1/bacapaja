<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function show($name)
    {
        try {
            $name = str_replace('-', ' ', $name);
            if (Auth::user()) {
                $post = Post::where('title', '=', $name)->firstOrFail();
            } else {
                $post = Post::where('title', '=', $name)->where('publish', '=', '1')->firstOrFail();
            }
						// dd($post);
						$categories = Category::orderBy('name', 'ASC')->get();			
            return view('frontend.post.show', compact('post', 'categories'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }
}

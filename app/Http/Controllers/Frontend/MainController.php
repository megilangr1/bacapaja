<?php

namespace App\Http\Controllers\FrontEnd;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class MainController extends Controller
{
    public function index()
    {
			$post = Post::orderBy('published_at', 'DESC')->where('publish', '=', '1')->with('category')->paginate(5);
			$categories = Category::orderBy('name', 'ASC')->get();
			return view('frontend.main', compact('post', 'categories'));			
		}
		
		public function kategori($name)
		{
			try {
				$category = str_replace('-', ' ', $name);
				$kategori = Category::where('name', '=', $category)->firstOrFail();
				$categories = Category::orderBy('name', 'ASC')->get();
				session()->flash('kategori', $category);
				$post = Post::orderBy('published_at', 'DESC')->where('publish', '=', '1')->where('category_id', '=', $kategori->id)->paginate(5);
				return view('frontend.main', compact('post', 'categories'));		
			} catch (\Exception $e) {
				return abort(404);
			}	
		}

		public function colorGenerator()
		{
			return view('frontend.other.color');
		}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;
use App\Comment;
use App\Page;
use App\Category;

class AdminController extends Controller
{

	 public function __construct() {
        $this->middleware('auth');
    }
    public function getIndex(){

    $posts = Post::count();
    $comments = Comment::count();
    $pages = Page::count();
    $categories = Category::count();

   //$allposts= Post::orderBy('id', 'desc');
   $rposts = Post::orderBy('id', 'desc')->take(5)->get();
   $rcomments = Comment::orderBy('id', 'desc')->take(5)->get();
   $rpages = Page::orderBy('id', 'desc')->take(5)->get();

    return view('admin.index')->withPosts($posts )->withComments($comments)->withPages($pages)->withCategories($categories)->withRposts($rposts)->withRcomments($rcomments)->withRpages($rpages);
}

}
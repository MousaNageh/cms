<?php

namespace App\Http\Controllers;

use App\Category;
use App\posts;
use App\tags;
use Illuminate\Http\Request;

class WellcomeController extends Controller
{
    public function index(){

        return view("welcome")
        ->with("categories",Category::all())
        ->with("tags",tags::all())
        ->with("posts",posts::searched()->simplePaginate(2)) ;//seached() is a method we made in made to make scope for search
    }
    public function showpost(posts $posts) {
        return view("posts.front")->with("post",$posts) ;
    }
    public function categoryposts(Category $category){
        return view("welcome")
        ->with("categories",Category::all())
        ->with("tags",tags::all())
        ->with("posts",$category->posts()->published()->simplePaginate(2))  ;
    }
    public function tagposts(tags $tags){
        return view("welcome")
        ->with("categories",Category::all())
        ->with("tags",tags::all())
        ->with("posts",$tags->posts()->published()->simplePaginate(2))  ;
    }
}
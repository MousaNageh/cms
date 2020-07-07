<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\postsRequests\createPostRequest;
use App\Http\Requests\postsRequests\updtePostRequest;
use App\posts;
use App\tags;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware("VerfyCategoryCount")->only(["create","store"]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("posts.index")->with("posts",posts::all()) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("posts.create")->with("categories",Category::all())->with("tags",tags::all()) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createPostRequest $request)
    {

        $image = $request->image->store("posts") ;
        $content = filter_var($request->content,FILTER_SANITIZE_STRING);
        $description = filter_var($request->description,FILTER_SANITIZE_STRING);
        $post=posts::create([
            "title"=>$request->title ,
            "description"=>$description ,
            "content"=>$content,
            "image"=> $image ,
            "published_at"=>$request->published_at,
            "category_id"=>$request->category ,
            "user_id"=>auth()->user()->id
        ]) ;
        if($request->tags){
            $post->tags()->attach($request->tags) ;
        }
        session()->flash("success","post created successfully. ") ;
        return redirect(route("posts.index")) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show(posts $post)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit(posts $post)
    {

        return view("posts.create")->with("post",$post)->with("categories",Category::all())->with("tags",tags::all()) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(updtePostRequest $request, posts $post)
    {
        $data = $request->only(["title","description","contnent","published_at"]) ;
        $data["content"]= filter_var($request->content,FILTER_SANITIZE_STRING);
        $data["description"] = filter_var($request->description,FILTER_SANITIZE_STRING);
        if($request->hasFile("image")){
            $image = $request->image->store("posts") ;
            $post->deleteImage() ;
            $data["image"]= $image ;
        }
        if($request->tags){
            $post->tags()->sync($request->tags) ; 
        }
        $post->update($data) ;
        session()->flash("success","post updated successfully. ") ;
        return redirect(route("posts.index")) ;



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //becuase of softdeleting we can not use route model binding
        $posts =posts::withTrashed()->where("id",$id)->firstOrFail() ;
        if($posts->trashed())
        {
            $posts->deleteImage() ;//custom method to delete the image from server
            $posts->forceDelete();//delete iamge form database
            session()->flash("success","post deleted successfully. ") ;
        }
        else
        {
            $posts->delete() ;
            session()->flash("success","post trashed successfully. ") ;
            if($posts->tags->count()>0){
                session()->flash("depends","category has posts , can't delete !!");
                return redirect(route("posts.index")) ;
            }
        }
        return redirect(route("posts.index")) ;


    }
    /*
    *display a list of all posts that deleted from application
    *but still in database
    * @return \Illuminate\Http\Response
    */
    public function trashed(){

        return view("posts.index")->withposts(posts::onlyTrashed()->get());
    }
    /*
    *this function is restoring data to use
    */
    public function restore($id){
        //becuase of softdeleting we can not use route model binding
        $posts =posts::onlyTrashed()->where("id",$id)->firstOrFail() ;
        $posts->restore() ;
        session()->flash("success","post restored successfully. ") ;
        return redirect()->back() ;
    }
    public function showcategoryposts(Category $category){

        return view("posts.index")->with("posts",$category->posts) ;
    }
    
}

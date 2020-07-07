<?php

namespace App\Http\Controllers;

use App\tags;
use App\Http\Requests\tagsRequests\CreatetagsRequest;
use App\Http\Requests\tagsRequests\UpdatetagsRequest;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request; 


class tagsController extends Controller
{
    public function __construct()
    {
        $this->middleware(["VerfyCategoryCount","verifyPostsExists"])->only(["create","store"]);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("tags.index")->with("tags",tags::all()) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tags.create") ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatetagsRequest $request)
    {
            tags::create([
                "name"=>$request->name
            ]);
            session()->flash("success","tags created successfully . ");

        return redirect(route("tags.index")) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(tags $tag)
    {
        return view("tags.create")->with("tag",$tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatetagsRequest $request, tags $tag)
    {
        $tag->update([
            "name"=>$request->name
        ]);
        session()->flash("success","tag updated successfully . ");
        return redirect(route("tags.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(tags $tag)
    {
        
        
        if($tag->posts->count()>0){
            session()->flash("depends","tag has posts , can't delete !!");
            return redirect(route("tags.index")) ;
        }
        $tag->delete() ;
        session()->flash("success","tags deleted  successfully . ");
        return redirect(route("tags.index")) ;
    }
    public function showposts(tags $tags){
        return view("posts.index")->with("posts",$tags->posts) ; 
    }
}

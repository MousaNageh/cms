<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\categoriesRequests\CreateCategoryRequest;
use App\Http\Requests\categoriesRequests\UpdateCategoryRequest;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("category.index")->with("categories",Category::all()) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("category.create") ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
            Category::create([
                "name"=>$request->name
            ]);
            session()->flash("success","category created successfully . ");

        return redirect(route("category.index")) ;
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
    public function edit(Category $category)
    {
        return view("category.create")->with("category",$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update([
            "name"=>$request->name
        ]);
        session()->flash("success","category updated successfully . ");
        return redirect(route("category.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->posts->count()>0){
            session()->flash("depends","category has posts , can't delete !!");
            return redirect(route("category.index")) ;
        }
        $category->delete() ;
        session()->flash("success","category deleted  successfully . ");
        return redirect(route("category.index")) ;
    }
}

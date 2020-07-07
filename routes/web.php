<?php

use App\Http\Controllers\WellcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',"WellcomeController@index")->name('wellcome') ;
Route::get('/show-post/{posts}',[WellcomeController::class ,"showpost"])->name("showpost") ;
Route::get("/categories-posts/{category}",[WellcomeController::class ,"categoryposts"])->name("show.category.posts") ;
Route::get("/tags-posts/{tags}",[WellcomeController::class ,"tagposts"])->name("show.tag.posts") ;
Auth::routes();

Route::middleware(["auth"])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home') ;
    Route::resource('/category', 'categoryController') ;
    Route::resource('/posts', 'postsController');
    Route::resource('/tags', 'tagsController');
    Route::get("/trashed-posts","postsController@trashed")->name("posts.trashed") ;
    Route::put("/restore-post/{posts}","postsController@restore")->name("posts.restore") ;
    Route::put("/category-posts/{category}","postsController@showcategoryposts")->name("posts.category-posts");
    Route::get("/tag-posts/{tags}","tagsController@showposts")->name("tags.showposts");
    Route::get("/show-users","usersController@index")->name("users.show") ;
    Route::get('login/facebook', 'Auth\LoginController@redirectToProvider')->name("login.facebook");
    Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');
});
Route::middleware(["admin"])->group(function(){
    Route::post("/make-admin/{user}","usersController@makeAdmin")->name("users.makeadmin") ;
    Route::post("/trmove-admin/{user}","usersController@removeAdmin")->name("users.removeadmin") ;
}) ; 

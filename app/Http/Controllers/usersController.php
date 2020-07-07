<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class usersController extends Controller
{
    public function index(){
        return view("users.index")->with("users",User::all()) ;
    }
    public function makeAdmin(User $user){
        $user->update([
            "role"=>"admin"
        ]); 
        session()->flash("success",$user->name." becouse admin now !!") ; 
        return redirect(route("users.show")) ; 
    } 
    public function removeAdmin(User $user) {
        $user->update([
            "role"=>"writer"
        ]); 
        session()->flash("success",$user->name." becouse user  now !!") ; 
        return redirect(route("users.show")) ; 
    }
}

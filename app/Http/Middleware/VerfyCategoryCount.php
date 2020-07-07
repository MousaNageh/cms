<?php

namespace App\Http\Middleware;

use App\Category;
use Closure;

class VerfyCategoryCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Category::all()->count()==0){
            session()->flash("needed","no categories created you need to create category") ;
            return redirect(route("category.create")) ;
        }
        return $next($request);
    }
}

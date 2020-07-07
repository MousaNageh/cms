<?php

namespace App\Http\Middleware;

use App\posts;
use Closure;

class verifyPostsExists
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
        if(posts::all()->count()==0){
            session()->flash("needed","no posts created you need to create post") ;
            return redirect(route("posts.create")) ;
        }
        return $next($request);
    }
}

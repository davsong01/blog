<?php

namespace App\Http\Middleware;

use Closure;
use App\Category;

class VerifyCategoriesCount
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
        //check if category is not empty, remember to register the middleware in kernel.php
        if(Category::all()->count() == 0 ){
            session()->flash('success', 'You must create a category first');
            
            return redirect(route('categories.create'));
        }

        return $next($request);
    }
}

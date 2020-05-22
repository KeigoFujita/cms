<?php

namespace App\Http\Middleware;

use App\Tag;
use Closure;

class VerifyTagsCount
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

        if (Tag::all()->count() == 0) {
            session()->flash('error', 'Cannot create post without Tag');
            return redirect(route('posts.index'));
        }
        return $next($request);
    }
}
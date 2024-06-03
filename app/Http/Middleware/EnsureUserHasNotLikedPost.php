<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class EnsureUserHasNotLikedPost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $postId = $request->route('id');
        $post = Post::findOrFail($postId);

        if ($post->likes()->where('user_id', Auth::id())->exists()) {
            return redirect()->route('posts.index')->with('error', 'Anda sudah menyukai postingan ini.');
        }

        return $next($request);
    }
}

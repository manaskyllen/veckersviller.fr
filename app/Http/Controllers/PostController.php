<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::query()
            ->with('images')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->paginate(9);

        return view('pages.news.index', [
            'posts' => $posts,
        ]);
    }

    public function show(Post $post): View
    {
        $post->load('images');

        abort_if(
            $post->published_at->isFuture(),
            404
        );

        return view('pages.news.show', [
            'post' => $post,
        ]);
    }
}

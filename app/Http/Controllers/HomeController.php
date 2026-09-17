<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\WeatherService;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(WeatherService $weatherService): View
    {
        $posts = Post::query()
            ->where('published_at', '<=', now())
            ->with('images')
            ->latest('published_at')
            ->take(3)
            ->get();

        $weather = $weatherService->getWeather();

        return view('pages.home', compact('posts', 'weather'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use App\Models\Author;

class SitemapController extends Controller
{
    public function index()
    {
        $news = News::with('category')
            ->orderByDesc('news_id')
            ->get();

        $categories = Category::all();
        $authors    = Author::all();

        return response()->view('sitemap', compact('news', 'categories', 'authors'))
            ->header('Content-Type', 'application/xml');
    }
}

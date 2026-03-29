<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function show($slug)
    {
        // Support DB slug column OR derived slug from category_name
        $category = Category::where('slug', $slug)->first()
            ?? Category::get()->first(fn($c) => Str::slug($c->category_name) === $slug);

        abort_if(!$category, 404);

        // Featured top articles (shown in the history-block style layout)
        $featured = News::with(['category', 'author'])
            ->where('category_id', $category->category_id)
            ->orderBy('published_at', 'desc')
            ->orderBy('news_id', 'desc')
            ->take(5)
            ->get();

        $featuredIds = $featured->pluck('news_id');

        // Remaining articles paginated (shown in ms-section style)
        $articles = News::with(['category', 'author'])
            ->where('category_id', $category->category_id)
            ->whereNotIn('news_id', $featuredIds)
            ->orderBy('published_at', 'desc')
            ->orderBy('news_id', 'desc')
            ->paginate(10);

        return view('category', compact('category', 'featured', 'articles'));
    }
}

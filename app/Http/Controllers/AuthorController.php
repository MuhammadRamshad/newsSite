<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\News;

class AuthorController extends Controller
{
    public function show($slug)
    {
        $author = Author::where('slug', $slug)->firstOrFail();

        $articles = News::with('category')
            ->where('author_id', $author->author_id)
            ->orderByDesc('news_id')
            ->paginate(10);

        return view('author', compact('author', 'articles'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use App\Models\Author;

class HomeController extends Controller
{
    public function index()
    {
        $usedIds = collect();

        /* ─── FEATURE AREA (top 3-column section) ─── */
        // Hero center
        $featureMain = News::with(['category', 'author'])
            ->latest('news_id')
            ->first();

        if ($featureMain) $usedIds->push($featureMain->news_id);

        // Left top card
        $featureLeft = News::with(['category', 'author'])
            ->whereNotIn('news_id', $usedIds)
            ->latest('news_id')
            ->first();

        if ($featureLeft) $usedIds->push($featureLeft->news_id);

        // Left list items (2 text-only links)
        $featureLeftList = News::with(['category', 'author'])
            ->whereNotIn('news_id', $usedIds)
            ->latest('news_id')
            ->take(2)
            ->get();

        $usedIds = $usedIds->merge($featureLeftList->pluck('news_id'));

        /* ─── LATEST FEATURED GRID (6 cards) ─── */
        $latestFeatured = News::with(['category', 'author'])
            ->whereNotIn('news_id', $usedIds)
            ->latest('news_id')
            ->take(6)
            ->get();

        $usedIds = $usedIds->merge($latestFeatured->pluck('news_id'));

        /* ─── SIDEBAR CATEGORIES (left sidebar of lf-section) ─── */
        $sidebarCategories = Category::withCount('news')
            ->orderBy('category_name')
            ->take(4)
            ->get();

        /* ─── PHOTO OF THE DAY (5 images) ─── */
        $photoOfDay = News::with('category')
            ->whereNotIn('news_id', $usedIds)
            ->latest('news_id')
            ->take(5)
            ->get();

        $usedIds = $usedIds->merge($photoOfDay->pluck('news_id'));

        /* ─── HISTORY SECTION (first category alphabetically or named) ─── */
        $historyCategory = Category::orderBy('category_name')->first();
        $historyCategoryName = $historyCategory ? $historyCategory->category_name : 'Latest';

        $historySectionNews = News::with(['category', 'author'])
            ->when($historyCategory, fn($q) => $q->where('category_id', $historyCategory->category_id))
            ->whereNotIn('news_id', $usedIds)
            ->latest('news_id')
            ->take(6)
            ->get();

        $usedIds = $usedIds->merge($historySectionNews->pluck('news_id'));

        /* ─── ART COLLECTION (second category) ─── */
        $artCategory = Category::orderBy('category_name')->skip(1)->first();
        $artCategoryName = $artCategory ? $artCategory->category_name : 'Collection';

        $artSectionNews = News::with(['category', 'author'])
            ->when($artCategory, fn($q) => $q->where('category_id', $artCategory->category_id))
            ->whereNotIn('news_id', $usedIds)
            ->latest('news_id')
            ->take(6)
            ->get();

        $usedIds = $usedIds->merge($artSectionNews->pluck('news_id'));

        /* ─── DISCOVERIES (third category) ─── */
        $discoveriesCategory = Category::orderBy('category_name')->skip(2)->first();
        $discoveriesCategoryName = $discoveriesCategory ? $discoveriesCategory->category_name : 'Discoveries';

        $discoveriesNews = News::with(['category', 'author'])
            ->when($discoveriesCategory, fn($q) => $q->where('category_id', $discoveriesCategory->category_id))
            ->whereNotIn('news_id', $usedIds)
            ->latest('news_id')
            ->take(5)
            ->get();

        $usedIds = $usedIds->merge($discoveriesNews->pluck('news_id'));

        /* ─── TRAVEL / 4-CARD SECTION (fourth category) ─── */
        $travelCategory = Category::orderBy('category_name')->skip(3)->first();
        $travelCategoryName = $travelCategory ? $travelCategory->category_name : 'Stories';

        $travelNews = News::with(['category', 'author'])
            ->when($travelCategory, fn($q) => $q->where('category_id', $travelCategory->category_id))
            ->whereNotIn('news_id', $usedIds)
            ->latest('news_id')
            ->take(4)
            ->get();

        $usedIds = $usedIds->merge($travelNews->pluck('news_id'));

        /* ─── MORE STORIES (alternating rows) ─── */
        $moreStories = News::with(['category', 'author'])
            ->whereNotIn('news_id', $usedIds)
            ->latest('news_id')
            ->take(6)
            ->get();

        return view('index', compact(
            'featureMain',
            'featureLeft',
            'featureLeftList',
            'latestFeatured',
            'sidebarCategories',
            'photoOfDay',
            'historyCategory',
            'historyCategoryName',
            'historySectionNews',
            'artCategory',
            'artCategoryName',
            'artSectionNews',
            'discoveriesCategory',
            'discoveriesCategoryName',
            'discoveriesNews',
            'travelCategory',
            'travelCategoryName',
            'travelNews',
            'moreStories'
        ));
    }

    public function show($category, $slug)
    {
        $newsDetail = News::with(['category', 'author'])
            ->where('encode_title', $slug)
            ->whereHas('category', fn($q) => $q->where('slug', $category))
            ->firstOrFail();

        $recommended = News::with(['category', 'author'])
            ->where('news_id', '!=', $newsDetail->news_id)
            ->where('category_id', $newsDetail->category_id)
            ->latest('news_id')
            ->take(4)
            ->get();

        return view('newsDetail', compact('newsDetail', 'recommended'));
    }

    public function search(Request $request)
    {
        $query = trim($request->q);

        $results = News::with(['category', 'author'])
            ->where(function ($q) use ($query) {
                $q->where('news_title', 'LIKE', "%{$query}%")
                  ->orWhere('news_content', 'LIKE', "%{$query}%")
                  ->orWhere('news_content_short', 'LIKE', "%{$query}%");
            })
            ->orderByDesc('news_id')
            ->paginate(10)
            ->appends(['q' => $query]);

        return view('search', compact('results', 'query'));
    }
}

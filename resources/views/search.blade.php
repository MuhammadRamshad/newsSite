@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')
@section('title', $query ? 'Search: ' . $query . ' — Illuminated Magazine' : 'Search — Illuminated Magazine')
@section('description', $query ? 'Search results for "' . $query . '" on Illuminated Magazine.' : 'Search all articles and stories on Illuminated Magazine.')
@section('robots', 'noindex,follow')
@section('canonical', route('search') . ($query ? '?q=' . urlencode($query) : ''))

@section('content')

<section class="cat-head-section">
    <div class="cat-head-container">
        <div class="cat-breadcrumb">
            <a href="{{ route('index') }}">Illuminated Magazine</a>
            <span>&gt;</span>
            <span class="cat-current">Search</span>
        </div>
        <h1 class="cat-title">
            @if($query)
                Results for: <em>{{ $query }}</em>
            @else
                Search
            @endif
        </h1>
    </div>
</section>

<!-- Search form -->
<div style="max-width:600px;margin:20px auto;padding:0 20px;">
    <form action="{{ route('search') }}" method="GET" style="display:flex;gap:10px;">
        <input type="text" name="q" value="{{ $query }}" placeholder="Search articles..."
               style="flex:1;padding:12px 16px;border:1px solid #ccc;font-size:1rem;">
        <button type="submit" class="btn-subscribe">Search</button>
    </form>
</div>

<section class="ms-section">
    <div class="ms-wrapper">
        <div class="ms-content">

            @if($query)
                <div class="ms-head">
                    <h2 class="ms-title">
                        {{ $results->total() }} result{{ $results->total() != 1 ? 's' : '' }} found
                    </h2>
                </div>

                @forelse($results as $index => $item)
                <div class="ms-row {{ $index % 2 != 0 ? 'reverse' : '' }}">
                    @if($index % 2 == 0)
                    <div class="ms-image">
                        <a href="{{ route('news.show', [$item->category->slug, $item->encode_title]) }}" title="{{ $item->news_title }}">
                            <img src="{{ asset('assets/images/uploads/' . $item->photo) }}" alt="{{ $item->news_title }}">
                        </a>
                    </div>
                    <div class="ms-text">
                        <span class="ms-cat">{{ strtoupper($item->category->category_name) }}</span>
                        <h3><a href="{{ route('news.show', [$item->category->slug, $item->encode_title]) }}" title="{{ $item->news_title }}">{{ $item->news_title }}</a></h3>
                        <p>{{ Str::limit(strip_tags($item->news_content_short), 130) }}</p>
                        <p class="ms-date">{{ \Carbon\Carbon::parse($item->published_at ?? $item->news_date)->format('F j, Y') }}</p>
                    </div>
                    @else
                    <div class="ms-text">
                        <span class="ms-cat">{{ strtoupper($item->category->category_name) }}</span>
                        <h3><a href="{{ route('news.show', [$item->category->slug, $item->encode_title]) }}" title="{{ $item->news_title }}">{{ $item->news_title }}</a></h3>
                        <p>{{ Str::limit(strip_tags($item->news_content_short), 130) }}</p>
                        <p class="ms-date">{{ \Carbon\Carbon::parse($item->published_at ?? $item->news_date)->format('F j, Y') }}</p>
                    </div>
                    <div class="ms-image">
                        <a href="{{ route('news.show', [$item->category->slug, $item->encode_title]) }}" title="{{ $item->news_title }}">
                            <img src="{{ asset('assets/images/uploads/' . $item->photo) }}" alt="{{ $item->news_title }}">
                        </a>
                    </div>
                    @endif
                </div>
                @if(!$loop->last)<div class="ms-divider"></div>@endif
                @empty
                <p style="padding:30px 0;">No articles found matching your search.</p>
                @endforelse
            @else
                <p style="padding:30px 0;">Enter a search term above to find articles.</p>
            @endif

        </div>

        <!-- Sidebar -->
        <div class="ms-sidebar">
            <h3 class="ms-follow-title">Tap In! Follow Us Now for Fresh Daily Content</h3>
            <div class="ms-social-grid">
                <div class="ms-social"><img src="{{ asset('assets/image/insta.webp') }}" alt=""><span>Facebook</span></div>
                <div class="ms-social"><img src="{{ asset('assets/image/insta.webp') }}" alt=""><span>X</span></div>
                <div class="ms-social"><img src="{{ asset('assets/image/insta.webp') }}" alt=""><span>YouTube</span></div>
                <div class="ms-social"><img src="{{ asset('assets/image/insta.webp') }}" alt=""><span>Patreon</span></div>
                <div class="ms-social"><img src="{{ asset('assets/image/insta.webp') }}" alt=""><span>RSS Feed</span></div>
            </div>
        </div>
    </div>
</section>

@if($query && $results->hasPages())
<div class="pagination-wrapper" style="padding:20px 40px;">
    {{ $results->appends(['q' => $query])->links() }}
</div>
@endif

@endsection

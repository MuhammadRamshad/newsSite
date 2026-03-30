@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')
@section('title', $category->category_name . ' — Illuminated Magazine')
@section('description', 'Explore the latest ' . $category->category_name . ' articles, stories and discoveries on Illuminated Magazine.')
@section('keywords', $category->category_name . ', illuminated magazine, art, discoveries, culture')
@section('canonical', route('category.show', $category->slug))
@section('og_image', $category->category_banner ? asset('assets/images/categories/' . $category->category_banner) : asset('assets/images/foxiz.webp'))

@section('schema')
@php
$categorySchema = [
    "@context" => "https://schema.org",
    "@type"    => "CollectionPage",
    "name"     => $category->category_name . ' — Illuminated Magazine',
    "description" => 'Explore the latest ' . $category->category_name . ' articles on Illuminated Magazine.',
    "url"      => route('category.show', $category->slug),
    "publisher" => [
        "@type" => "Organization",
        "name"  => config('app.name', 'Illuminated Magazine'),
    ],
];
$breadcrumbSchema = [
    "@context" => "https://schema.org",
    "@type"    => "BreadcrumbList",
    "itemListElement" => [
        ["@type" => "ListItem", "position" => 1, "name" => "Home", "item" => url('/')],
        ["@type" => "ListItem", "position" => 2, "name" => $category->category_name],
    ]
];
@endphp
<script type="application/ld+json">{!! json_encode($categorySchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
<script type="application/ld+json">{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endsection

@section('content')

<!-- Category Header -->
<section class="cat-head-section">
    <div class="cat-head-container">
        <div class="cat-breadcrumb">
            <a href="{{ route('index') }}">Illuminated Magazine</a>
            <span>&gt;</span>
            <span class="cat-current">{{ $category->category_name }}</span>
        </div>
        <h1 class="cat-title">{{ $category->category_name }}</h1>
    </div>
</section>


<!-- Featured top 2 posts — history-block style -->
@if($featured->count())
<section class="history-block">
    <div class="history-wrap">

        <div class="history-top">
            @if($featured->get(0))
            @php $f0 = $featured->get(0); @endphp
            <div class="hs-large">
                <a href="{{ route('news.show', [$f0->category->slug, $f0->encode_title]) }}" title="{{ $f0->news_title }}">
                    <img src="{{ asset('assets/images/uploads/' . $f0->photo) }}" alt="{{ $f0->news_title }}">
                </a>
                <div class="hs-overlay">
                    <span class="hs-tag">{{ strtoupper($f0->category->category_name) }}</span>
                    <h3><a href="{{ route('news.show', [$f0->category->slug, $f0->encode_title]) }}" title="{{ $f0->news_title }}">{{ $f0->news_title }}</a></h3>
                    <p class="hs-date">{{ \Carbon\Carbon::parse($f0->published_at ?? $f0->news_date)->format('F j, Y') }}</p>
                </div>
            </div>
            @endif

            @if($featured->get(1))
            @php $f1 = $featured->get(1); @endphp
            <div class="hs-right">
                <a href="{{ route('news.show', [$f1->category->slug, $f1->encode_title]) }}" title="{{ $f1->news_title }}">
                    <img src="{{ asset('assets/images/uploads/' . $f1->photo) }}" alt="{{ $f1->news_title }}">
                </a>
                <span class="hs-tag">{{ strtoupper($f1->category->category_name) }}</span>
                <h4><a href="{{ route('news.show', [$f1->category->slug, $f1->encode_title]) }}" title="{{ $f1->news_title }}">{{ $f1->news_title }}</a></h4>
                <p class="hs-date">{{ \Carbon\Carbon::parse($f1->published_at ?? $f1->news_date)->format('F j, Y') }}</p>
            </div>
            @endif
        </div>

        @if($featured->count() > 2)
        <div class="history-bottom">
            @foreach($featured->slice(2, 3) as $item)
            <div class="hs-small">
                <a href="{{ route('news.show', [$item->category->slug, $item->encode_title]) }}" title="{{ $item->news_title }}">
                    <img src="{{ asset('assets/images/uploads/' . $item->photo) }}" alt="{{ $item->news_title }}">
                </a>
                <span class="hs-tag">{{ strtoupper($item->category->category_name) }}</span>
                <h5><a href="{{ route('news.show', [$item->category->slug, $item->encode_title]) }}" title="{{ $item->news_title }}">{{ $item->news_title }}</a></h5>
            </div>
            @endforeach
            <div class="hs-ad">
                <p class="hs-ad-text">- Advertisement -</p>
                <img src="{{ asset('assets/image/img1.webp') }}" alt="Ad">
            </div>
        </div>
        @endif

    </div>
</section>
@endif


<!-- Remaining articles — ms-section style -->
<section class="ms-section">
    <div class="ms-wrapper">
        <div class="ms-content">
            @forelse($articles as $index => $item)
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
                    <p>{{ Str::limit(strip_tags($item->news_content_short), 120) }}</p>
                    <p class="ms-date">{{ \Carbon\Carbon::parse($item->published_at ?? $item->news_date)->format('F j, Y') }}</p>
                </div>
                @else
                <div class="ms-text">
                    <span class="ms-cat">{{ strtoupper($item->category->category_name) }}</span>
                    <h3><a href="{{ route('news.show', [$item->category->slug, $item->encode_title]) }}" title="{{ $item->news_title }}">{{ $item->news_title }}</a></h3>
                    <p>{{ Str::limit(strip_tags($item->news_content_short), 120) }}</p>
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
            <p style="padding:30px 0;">No articles found in this category.</p>
            @endforelse
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
            <div class="ms-adbox">
                <p class="ms-ad-text">- Advertisement -</p>
                <img src="{{ asset('assets/image/img2.webp') }}" alt="Ad">
            </div>
        </div>
    </div>
</section>

<!-- Pagination -->
<div class="pagination-wrapper" style="padding:20px 40px;">
    {{ $articles->links() }}
</div>

@endsection

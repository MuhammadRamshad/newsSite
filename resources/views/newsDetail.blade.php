@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('title', $newsDetail->news_title . ' — Illuminated Magazine')
@section('description', Str::limit(strip_tags($newsDetail->news_content_short), 155))
@section('keywords', optional($newsDetail->category)->category_name . ', illuminated magazine, art, discoveries')
@section('og_image', asset('assets/images/uploads/' . $newsDetail->photo))
@section('canonical', route('news.show', [$newsDetail->category->slug, $newsDetail->encode_title]))
@section('article_author', optional($newsDetail->author)->name ?? 'Editorial Desk')
@section('article_section', optional($newsDetail->category)->category_name)
@section('published_time', \Carbon\Carbon::parse($newsDetail->news_date ?? $newsDetail->updated_at)->toIso8601String())
@section('modified_time', \Carbon\Carbon::parse($newsDetail->updated_at ?? $newsDetail->news_date)->toIso8601String())
@section('twitter_creator', '@illuminatedmag')

@section('schema')
@php
$articleSchema = [
    "@context"        => "https://schema.org",
    "@type"           => "NewsArticle",
    "mainEntityOfPage" => [
        "@type" => "WebPage",
        "@id"   => route('news.show', [$newsDetail->category->slug, $newsDetail->encode_title]),
    ],
    "headline"        => $newsDetail->news_title,
    "description"     => Str::limit(strip_tags($newsDetail->news_content_short), 160),
    "image"           => [
        "@type"  => "ImageObject",
        "url"    => asset('assets/images/uploads/' . $newsDetail->photo),
        "width"  => 1200,
        "height" => 630,
    ],
    "datePublished"   => \Carbon\Carbon::parse($newsDetail->news_date ?? $newsDetail->updated_at)->toIso8601String(),
    "dateModified"    => \Carbon\Carbon::parse($newsDetail->updated_at ?? $newsDetail->news_date)->toIso8601String(),
    "author"          => [
        "@type" => "Person",
        "name"  => optional($newsDetail->author)->name ?? 'Editorial Desk',
        "url"   => $newsDetail->author ? route('author.show', $newsDetail->author->slug) : url('/'),
    ],
    "publisher" => [
        "@type" => "Organization",
        "name"  => config('app.name', 'Illuminated Magazine'),
        "logo"  => [
            "@type" => "ImageObject",
            "url"   => asset('assets/images/logo.webp'),
        ],
    ],
    "articleSection" => optional($newsDetail->category)->category_name,
    "wordCount"      => str_word_count(strip_tags($newsDetail->news_content ?? '')),
    "url"            => route('news.show', [$newsDetail->category->slug, $newsDetail->encode_title]),
];

$breadcrumbSchema = [
    "@context" => "https://schema.org",
    "@type"    => "BreadcrumbList",
    "itemListElement" => [
        ["@type" => "ListItem", "position" => 1, "name" => "Home", "item" => url('/')],
        ["@type" => "ListItem", "position" => 2, "name" => optional($newsDetail->category)->category_name, "item" => route('category.show', optional($newsDetail->category)->slug ?? '#')],
        ["@type" => "ListItem", "position" => 3, "name" => $newsDetail->news_title],
    ]
];
@endphp
<script type="application/ld+json">{!! json_encode($articleSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
<script type="application/ld+json">{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endsection

@section('content')

<!-- ============================
     HERO / POST HEADER
     ============================ -->
<section class="post-hero-section">

    <div class="post-hero-image">
        <img src="{{ asset('assets/images/uploads/' . $newsDetail->photo) }}" alt="{{ $newsDetail->news_title }}">
    </div>

    <div class="post-hero-container">

        <div class="post-hero-breadcrumb">
            <a href="{{ route('index') }}">Illuminated Magazine</a>
            &gt;
            <a href="{{ route('category.show', $newsDetail->category->slug) }}">{{ $newsDetail->category->category_name }}</a>
            &gt;
            {{ Str::limit($newsDetail->news_title, 60) }}
        </div>

        <div class="post-hero-category">{{ strtoupper($newsDetail->category->category_name) }}</div>

        <h1 class="post-hero-title">{{ $newsDetail->news_title }}</h1>

        <p class="post-hero-excerpt">
            {{ Str::limit(strip_tags($newsDetail->news_content_short), 200) }}
        </p>

        <div class="post-hero-meta">
            <div class="post-hero-author">
                @if($newsDetail->author)
                    <img src="{{ $newsDetail->author->image ? asset('assets/images/authors/' . $newsDetail->author->image) : asset('assets/image/author.webp') }}" alt="{{ $newsDetail->author->name }}">
                    <div>
                        <div class="post-hero-author-name">
                            By <strong>
                                <a href="{{ route('author.show', $newsDetail->author->slug) }}" title="{{ $newsDetail->author->name }}">
                                    {{ $newsDetail->author->name }}
                                </a>
                            </strong>
                            @if($newsDetail->author->designation)
                                — {{ $newsDetail->author->designation }}
                            @endif
                        </div>
                        <div class="post-hero-date">
                            Last updated: {{ \Carbon\Carbon::parse($newsDetail->updated_at ?? $newsDetail->news_date)->format('F j, Y g:i a') }}
                            &bull;
                            {{ ceil(str_word_count(strip_tags($newsDetail->news_content)) / 200) }} Min Read
                        </div>
                    </div>
                @else
                    <img src="{{ asset('assets/image/author.webp') }}" alt="Editorial Desk">
                    <div>
                        <div class="post-hero-author-name">By <strong>Editorial Desk</strong></div>
                        <div class="post-hero-date">
                            {{ \Carbon\Carbon::parse($newsDetail->news_date)->format('F j, Y') }}
                        </div>
                    </div>
                @endif
            </div>

            <div class="post-hero-share">
                <span>Share</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank">
                    <img src="{{ asset('assets/image/insta.webp') }}" alt="Facebook">
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($newsDetail->news_title) }}" target="_blank">
                    <img src="{{ asset('assets/image/insta.webp') }}" alt="Twitter">
                </a>
                <a href="https://wa.me/?text={{ urlencode($newsDetail->news_title . ' ' . url()->current()) }}" target="_blank">
                    <img src="{{ asset('assets/image/insta.webp') }}" alt="WhatsApp">
                </a>
            </div>
        </div>

        <div class="post-hero-divider"></div>
    </div>
</section>


<!-- ============================
     ARTICLE BODY
     ============================ -->
<section class="detail-block">
    <div class="detail-wrapper">

        <!-- Share Column (sticky sidebar) -->
        <div class="detail-share">
            <span class="detail-share-title">SHARE</span>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank">
                <img src="{{ asset('assets/image/insta.webp') }}" alt="Facebook">
            </a>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($newsDetail->news_title) }}" target="_blank">
                <img src="{{ asset('assets/image/insta.webp') }}" alt="Twitter">
            </a>
            <a href="https://wa.me/?text={{ urlencode($newsDetail->news_title . ' ' . url()->current()) }}" target="_blank">
                <img src="{{ asset('assets/image/insta.webp') }}" alt="WhatsApp">
            </a>
        </div>

        <!-- Main Content -->
        <div class="detail-content">
            <p class="detail-drop">
                {{ Str::limit(strip_tags($newsDetail->news_content_short), 300) }}
            </p>

            <div class="article-block">
                {!! $newsDetail->news_content !!}
            </div>
        </div>

    </div>
</section>


<!-- ============================
     ARTICLE FOOTER — Share + Author Box
     ============================ -->
<section class="article-footer-section">
    <div class="article-footer-container">

        <div class="article-share-row">
            <div class="article-share-left">
                <span class="article-share-icon">↗</span>
                <h3>Share This Article</h3>
            </div>
            <div class="article-share-right">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="share-btn">
                    <img src="{{ asset('assets/image/insta.webp') }}" alt="Facebook">
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}" target="_blank" class="share-btn-icon">
                    <img src="{{ asset('assets/image/insta.webp') }}" alt="Twitter">
                </a>
                <a href="https://wa.me/?text={{ urlencode(url()->current()) }}" target="_blank" class="share-btn-icon">
                    <img src="{{ asset('assets/image/insta.webp') }}" alt="WhatsApp">
                </a>
            </div>
        </div>

        @if($newsDetail->author)
        <div class="article-author-box">
            <div class="article-author-left">
                <img src="{{ $newsDetail->author->image ? asset('assets/images/authors/' . $newsDetail->author->image) : asset('assets/image/author.webp') }}"
                     class="article-author-img" alt="{{ $newsDetail->author->name }}">
                <div>
                    <div class="article-author-name">
                        By <strong>
                            <a href="{{ route('author.show', $newsDetail->author->slug) }}" title="{{ $newsDetail->author->name }}">
                                {{ $newsDetail->author->name }}
                            </a>
                        </strong>
                        <span class="author-verified">✔</span>
                    </div>
                    <div class="article-author-role">{{ $newsDetail->author->designation ?? 'Staff Writer' }}</div>
                    @if($newsDetail->author->bio)
                    <p style="margin-top:8px;font-size:0.9rem;color:#555;">{{ Str::limit($newsDetail->author->bio, 200) }}</p>
                    @endif
                </div>
            </div>
            <div class="article-author-follow">
                <a href="{{ route('author.show', $newsDetail->author->slug) }}" class="btn-subscribe" style="text-decoration:none;">View All Posts</a>
            </div>
        </div>
        @endif

    </div>
</section>


<!-- ============================
     RELATED ARTICLES
     ============================ -->
@if($recommended->count())
<section class="category-section">
    <div class="section-header">
        <h2>You May Also Like</h2>
    </div>
    <div class="category-grid">
        @foreach($recommended as $item)
        <article class="post-card">
            <a href="{{ route('news.show', [$item->category->slug, $item->encode_title]) }}" title="{{ $item->news_title }}">
                <img src="{{ asset('assets/images/uploads/' . $item->photo) }}" alt="{{ $item->news_title }}">
            </a>
            <div class="post-content">
                <span class="post-tag">{{ strtoupper($item->category->category_name) }}</span>
                <h3><a href="{{ route('news.show', [$item->category->slug, $item->encode_title]) }}" title="{{ $item->news_title }}">{{ $item->news_title }}</a></h3>
                <p class="post-date">{{ \Carbon\Carbon::parse($item->published_at ?? $item->news_date)->format('F j, Y') }}</p>
            </div>
        </article>
        @endforeach
    </div>
</section>
@endif

@endsection

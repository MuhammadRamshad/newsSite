@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')
@section('title', $author->name . ' — Illuminated Magazine')
@section('description', $author->bio ? Str::limit($author->bio, 155) : 'Articles by ' . $author->name . ' on Illuminated Magazine.')
@section('keywords', $author->name . ', illuminated magazine, author, journalist')
@section('canonical', route('author.show', $author->slug))
@section('og_image', $author->image ? asset('assets/images/authors/' . $author->image) : asset('assets/images/foxiz.webp'))

@section('schema')
@php
$authorSchema = [
    "@context"    => "https://schema.org",
    "@type"       => "ProfilePage",
    "mainEntity"  => [
        "@type"       => "Person",
        "name"        => $author->name,
        "url"         => route('author.show', $author->slug),
        "jobTitle"    => $author->designation ?? 'Journalist',
        "description" => $author->bio ?? '',
        "image"       => [
            "@type" => "ImageObject",
            "url"   => $author->image ? asset('assets/images/authors/' . $author->image) : asset('assets/images/foxiz.webp'),
        ],
        "worksFor" => [
            "@type" => "Organization",
            "name"  => config('app.name', 'Illuminated Magazine'),
        ],
    ],
];
$breadcrumbSchema = [
    "@context" => "https://schema.org",
    "@type"    => "BreadcrumbList",
    "itemListElement" => [
        ["@type" => "ListItem", "position" => 1, "name" => "Home", "item" => url('/')],
        ["@type" => "ListItem", "position" => 2, "name" => $author->name],
    ]
];
@endphp
<script type="application/ld+json">{!! json_encode($authorSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
<script type="application/ld+json">{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endsection

@section('content')

<!-- Author Header -->
<section class="author-head-wrap">
    <div class="author-head-inner">

        <div class="author-breadcrumb">
            <a href="{{ route('index') }}">Illuminated Magazine</a>
            <span>&gt;</span>
            <span>Articles by: {{ $author->name }}</span>
        </div>

        <div class="author-profile">
            <div class="author-avatar">
                <img src="{{ $author->image ? asset('assets/images/authors/' . $author->image) : asset('assets/image/author.webp') }}" alt="{{ $author->name }}">
            </div>
            <div class="author-details">
                <h1 class="author-name">
                    {{ $author->name }}
                    <span class="author-verified">✔</span>
                </h1>
                @if($author->bio)
                <p class="author-bio">{{ $author->bio }}</p>
                @endif
                <div class="author-meta">
                    <span class="author-role">{{ $author->designation ?? 'Staff Writer' }}</span>
                    <span class="author-divider">/</span>
                    <span class="author-follow">Follow:</span>
                    <div class="author-socials">
                        @if($author->social)
                            @foreach((array)$author->social as $platform => $link)
                                <a href="{{ $link }}" target="_blank" rel="noopener">
                                    <img src="{{ asset('assets/image/insta.webp') }}" alt="{{ $platform }}">
                                </a>
                            @endforeach
                        @else
                            <img src="{{ asset('assets/image/insta.webp') }}" alt="">
                            <img src="{{ asset('assets/image/insta.webp') }}" alt="">
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<!-- Articles listing -->
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
            <p style="padding:30px 0;">No articles found for this author.</p>
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

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

        {{-- FIX 1: Added title attribute to breadcrumb <a> tag --}}
        <div class="author-breadcrumb">
            <a href="{{ route('index') }}" title="Illuminated Magazine Home">Illuminated Magazine</a>
            <span>&gt;</span>
            <span>Articles by: {{ $author->name }}</span>
        </div>

        <div class="author-profile">
            <div class="author-avatar">
                <img src="{{ $author->image ? asset('assets/images/authors/' . $author->image) : asset('assets/image/author.webp') }}" alt="{{ $author->name }}">
            </div>
            <div class="author-details">
                {{-- H1 is correct here — page title --}}
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
                                {{-- FIX 2: Added title attribute to social <a> tags --}}
                                <a href="{{ $link }}" target="_blank" rel="noopener" title="Follow {{ $author->name }} on {{ ucfirst($platform) }}">
                                    <img src="{{ asset('assets/image/insta.webp') }}" alt="{{ ucfirst($platform) }}">
                                </a>
                            @endforeach
                        @else
                            <img src="{{ asset('assets/image/insta.webp') }}" alt="Instagram">
                            <img src="{{ asset('assets/image/insta.webp') }}" alt="Social Media">
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
                    {{-- FIX 3: Changed <h3> to <h2> for correct heading order (H1 → H2) --}}
                    <h2><a href="{{ route('news.show', [$item->category->slug, $item->encode_title]) }}" title="{{ $item->news_title }}">{{ $item->news_title }}</a></h2>
                    <p>{{ Str::limit(strip_tags($item->news_content_short), 130) }}</p>
                    <p class="ms-date">{{ \Carbon\Carbon::parse($item->published_at ?? $item->news_date)->format('F j, Y') }}</p>
                </div>
                @else
                <div class="ms-text">
                    <span class="ms-cat">{{ strtoupper($item->category->category_name) }}</span>
                    {{-- FIX 3: Changed <h3> to <h2> for correct heading order (H1 → H2) --}}
                    <h2><a href="{{ route('news.show', [$item->category->slug, $item->encode_title]) }}" title="{{ $item->news_title }}">{{ $item->news_title }}</a></h2>
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
            {{-- FIX 4: Changed <h3> to <h2> for correct heading order (H1 → H2) --}}
            <h2 class="ms-follow-title">Tap In! Follow Us Now for Fresh Daily Content</h2>
            <div class="ms-social-grid">
                {{-- FIX 5: Added title attributes to sidebar social icon links --}}
                <div class="ms-social">
                    <a href="#" title="Follow us on Facebook">
                        <img src="{{ asset('assets/image/insta.webp') }}" alt="Facebook">
                    </a>
                    <span>Facebook</span>
                </div>
                <div class="ms-social">
                    <a href="#" title="Follow us on X (Twitter)">
                        <img src="{{ asset('assets/image/insta.webp') }}" alt="X">
                    </a>
                    <span>X</span>
                </div>
                <div class="ms-social">
                    <a href="#" title="Subscribe on YouTube">
                        <img src="{{ asset('assets/image/insta.webp') }}" alt="YouTube">
                    </a>
                    <span>YouTube</span>
                </div>
                <div class="ms-social">
                    <a href="#" title="Support us on Patreon">
                        <img src="{{ asset('assets/image/insta.webp') }}" alt="Patreon">
                    </a>
                    <span>Patreon</span>
                </div>
                <div class="ms-social">
                    <a href="#" title="Subscribe to RSS Feed">
                        <img src="{{ asset('assets/image/insta.webp') }}" alt="RSS Feed">
                    </a>
                    <span>RSS Feed</span>
                </div>
            </div>
            <div class="ms-adbox">
                <p class="ms-ad-text">- Advertisement -</p>
                <img src="{{ asset('assets/image/img2.webp') }}" alt="Advertisement">
            </div>
        </div>
    </div>
</section>

<!-- Pagination -->
<div class="pagination-wrapper" style="padding:20px 40px;">
    {{ $articles->links() }}
</div>

@endsection
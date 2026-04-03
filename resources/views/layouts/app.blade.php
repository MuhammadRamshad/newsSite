<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

{{-- ===== PRIMARY SEO ===== --}}
<title>@yield('title', 'Illuminated Magazine — Art, History, Science & Discoveries')</title>
<meta name="description" content="@yield('description', 'Illuminated Magazine covers art, history, science, discoveries and cultural stories updated daily.')">
<meta name="keywords" content="@yield('keywords', 'art, history, science, discoveries, travel, mysteries, culture, illuminated magazine')">
<meta name="robots" content="@yield('robots', 'index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1')">
<link rel="canonical" href="@yield('canonical', url()->current())">

{{-- ===== AUTHOR / PUBLISHER ===== --}}
@if(View::hasSection('article_author'))
<meta name="author" content="@yield('article_author')">
@endif

{{-- ===== OPEN GRAPH ===== --}}
{{-- FIX 1: Replaced inline @if inside attribute with safe ternary {{ }} --}}
<meta property="og:type" content="{{ View::hasSection('published_time') ? 'article' : 'website' }}">
<meta property="og:site_name" content="{{ config('app.name', 'Illuminated Magazine') }}">
<meta property="og:locale" content="en_US">
<meta property="og:url" content="@yield('canonical', url()->current())">
<meta property="og:title" content="@yield('title', config('app.name'))">
<meta property="og:description" content="@yield('description', 'Illuminated Magazine covers art, history, science and cultural discoveries.')">
<meta property="og:image" content="@yield('og_image', asset('assets/images/foxiz.webp'))">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="@yield('title', config('app.name'))">
@if(View::hasSection('published_time'))
<meta property="article:published_time" content="@yield('published_time')">
<meta property="article:modified_time" content="@yield('modified_time', now()->toIso8601String())">
<meta property="article:section" content="@yield('article_section', '')">
@endif

{{-- ===== TWITTER CARD ===== --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@@illuminatedmag">
<meta name="twitter:creator" content="@yield('twitter_creator', '@@illuminatedmag')">
<meta name="twitter:title" content="@yield('title', config('app.name'))">
<meta name="twitter:description" content="@yield('description')">
<meta name="twitter:image" content="@yield('og_image', asset('assets/images/foxiz.webp'))">
<meta name="twitter:image:alt" content="@yield('title', config('app.name'))">

{{-- ===== SCHEMA / JSON-LD ===== --}}
@yield('schema')

{{-- ===== WEBSITE SCHEMA (always present) ===== --}}
@php
$siteSchema = [
    "@context" => "https://schema.org",
    "@type"    => "WebSite",
    "name"     => config('app.name', 'Illuminated Magazine'),
    "url"      => url('/'),
    "description" => "Illuminated Magazine covers art, history, science, discoveries and cultural stories.",
    "potentialAction" => [
        "@type"       => "SearchAction",
        "target"      => ["@type" => "EntryPoint", "urlTemplate" => url('/search') . '?q={search_term_string}'],
        "query-input" => "required name=search_term_string"
    ]
];
$orgSchema = [
    "@context" => "https://schema.org",
    "@type"    => "Organization",
    "name"     => config('app.name', 'Illuminated Magazine'),
    "url"      => url('/'),
    "logo"     => [
        "@type" => "ImageObject",
        "url"   => asset('assets/images/logo.webp'),
    ],
    "sameAs"   => []
];
@endphp
<script type="application/ld+json">{!! json_encode($siteSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
<script type="application/ld+json">{!! json_encode($orgSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>

{{-- ===== FIX 2: FAVICON — proper full set of favicon tags ===== --}}
<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon-16x16.png') }}">
<meta name="theme-color" content="#ffffff">

{{-- ===== PERFORMANCE ===== --}}
<link rel="dns-prefetch" href="//fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>

{{-- ===== STYLES ===== --}}
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
@include('partials.top-bar')
@include('partials.logo-bar')
@include('partials.navbar')
<main id="main-content" role="main">
    @yield('content')
</main>
@include('partials.footer')
<script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>

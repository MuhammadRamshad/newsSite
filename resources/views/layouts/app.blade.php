<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Illuminated — Art & Discoveries')</title>
<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
<meta name="description" content="@yield('description', 'Illuminated Magazine covers art, history, science and cultural discoveries.')">
<meta name="keywords" content="@yield('keywords', 'art, history, science, discoveries, travel, mysteries')">
<meta name="robots" content="@yield('robots', 'index,follow,max-image-preview:large')">
<link rel="canonical" href="@yield('canonical', url()->current())">
<link rel="stylesheet" href="{{ asset('assets/css/illuminated.css') }}">
<meta property="og:type" content="@hasSection('published_time') article @else website @endif">
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:url" content="@yield('canonical', url()->current())">
<meta property="og:title" content="@yield('title', config('app.name'))">
<meta property="og:description" content="@yield('description')">
<meta property="og:image" content="@yield('image', asset('assets/image/img.webp'))">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="@yield('title')">
<meta name="twitter:description" content="@yield('description')">
<meta name="twitter:image" content="@yield('image', asset('assets/image/img.webp'))">
@yield('schema')
@php
$siteSchema = [
    "@context" => "https://schema.org",
    "@type" => "WebSite",
    "name" => config('app.name'),
    "url" => url('/'),
    "potentialAction" => [
        "@type" => "SearchAction",
        "target" => url('/search') . '?q={search_term_string}',
        "query-input" => "required name=search_term_string"
    ]
];
@endphp
<script type="application/ld+json">
{!! json_encode($siteSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
</script>
</head>
<body>
@include('partials.top-bar')
@include('partials.logo-bar')
@include('partials.navbar')
<main>
    @yield('content')
</main>
@include('partials.footer')
<script src="{{ asset('assets/js/illuminated.js') }}"></script>
</body>
</html>

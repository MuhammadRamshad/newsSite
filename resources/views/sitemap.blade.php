<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <url>
        <loc>{{ route('about') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>

    <url>
        <loc>{{ route('privacyPolicy') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.3</priority>
    </url>

    @foreach($categories as $category)
    <url>
        <loc>{{ route('category.show', $category->slug) }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    @foreach($authors as $author)
    <url>
        <loc>{{ route('author.show', $author->slug) }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach

    @foreach($news as $item)
    @if($item->category)
    <url>
        <loc>{{ route('news.show', [$item->category->slug, $item->encode_title]) }}</loc>
        <lastmod>{{ \Carbon\Carbon::parse($item->updated_at ?? $item->news_date)->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    @endif
    @endforeach

</urlset>

@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')
@section('title', 'Illuminated Magazine — Art, History, Science & Discoveries')
@section('description', 'Illuminated Magazine covers art, history, science, discoveries and cultural stories updated daily.')
@section('keywords', 'illuminated magazine, art, discoveries, history, science, culture, travel, stories')
@section('canonical', url('/'))
@section('og_image', asset('assets/images/foxiz.webp'))

@section('content')

<h1 class="visually-hidden">Illuminated Magazine — Art, History, Science &amp; Discoveries</h1>

<!-- ============================
     1st SECTION — FEATURE AREA
     ============================ -->
<section class="feature-area">
    <div class="feature-wrap">

        <!-- Left Column -->
        <div class="fa-left">

            @if($featureLeft)
            <div class="fa-card">
                <a href="{{ route('news.show', [$featureLeft->category->slug, $featureLeft->encode_title]) }}" title="{{ $featureLeft->news_title }}">
                    <img src="{{ asset('assets/images/uploads/' . $featureLeft->photo) }}" alt="{{ $featureLeft->news_title }}">
                </a>
                <span class="fa-tag">{{ strtoupper($featureLeft->category->category_name) }}</span>
                <h2 class="fa-card-title">
                    <a href="{{ route('news.show', [$featureLeft->category->slug, $featureLeft->encode_title]) }}" title="{{ $featureLeft->news_title }}">
                        {{ $featureLeft->news_title }}
                    </a>
                </h2>
                <p class="fa-date">{{ \Carbon\Carbon::parse($featureLeft->published_at ?? $featureLeft->news_date)->format('F j, Y') }}</p>
            </div>
            @endif

            @foreach($featureLeftList as $item)
            <div class="fa-divider"></div>
            <div class="fa-list">
                <h3 class="fa-list-title">
                    <a href="{{ route('news.show', [$item->category->slug, $item->encode_title]) }}" title="{{ $item->news_title }}">
                        {{ $item->news_title }}
                    </a>
                </h3>
                <p class="fa-date">{{ \Carbon\Carbon::parse($item->published_at ?? $item->news_date)->format('F j, Y') }}</p>
            </div>
            @endforeach

        </div>

        <!-- Center Column — Hero -->
        <div class="fa-center">
            @if($featureMain)
            <div class="fa-main">
                <a href="{{ route('news.show', [$featureMain->category->slug, $featureMain->encode_title]) }}" title="{{ $featureMain->news_title }}">
                    <img src="{{ asset('assets/images/uploads/' . $featureMain->photo) }}" alt="{{ $featureMain->news_title }}">
                </a>
                <div class="fa-main-text">
                    <span class="fa-tag">{{ strtoupper($featureMain->category->category_name) }}</span>
                    <h2>
                        <a href="{{ route('news.show', [$featureMain->category->slug, $featureMain->encode_title]) }}" title="{{ $featureMain->news_title }}">
                            {{ $featureMain->news_title }}
                        </a>
                    </h2>
                    <p>{{ Str::limit(strip_tags($featureMain->news_content_short), 150) }}</p>
                </div>
            </div>
            @endif
        </div>

        <!-- Right Column — Ad + Follow -->
        <div class="fa-right">
            <div class="fa-ad">
                <p class="fa-ad-title">- Advertisement -</p>
                <img src="{{ asset('assets/image/img.webp') }}" alt="Advertisement">
            </div>
            <div class="fa-divider"></div>
            <div class="fa-follow">
                <h3>Tap In! Follow Us Now for Fresh Daily Content</h3>
                <div class="fa-icons">
                    <a href="#" title="Follow us on Instagram"><img src="{{ asset('assets/image/insta.webp') }}" alt="Instagram"></a>
                    <a href="#" title="Follow us on Facebook"><img src="{{ asset('assets/image/insta.webp') }}" alt="Facebook"></a>
                    <a href="#" title="Follow us on Twitter"><img src="{{ asset('assets/image/insta.webp') }}" alt="Twitter"></a>
                    <a href="#" title="Follow us on YouTube"><img src="{{ asset('assets/image/insta.webp') }}" alt="YouTube"></a>
                    <a href="#" title="Subscribe to our RSS Feed"><img src="{{ asset('assets/image/insta.webp') }}" alt="RSS"></a>
                    <a href="#" title="Support us on Patreon"><img src="{{ asset('assets/image/insta.webp') }}" alt="Patreon"></a>
                </div>
            </div>
        </div>

    </div>
</section>


<!-- ============================
     2nd SECTION — LATEST FEATURED
     ============================ -->
<section class="lf-section">
    <div class="lf-wrapper">

        <!-- Left Sidebar -->
        <div class="lf-sidebar">
            <h3 class="lf-side-title">Your Trusted Source for Accurate and Timely Updates!</h3>

            @foreach($sidebarCategories as $cat)
            <div class="lf-side-item">
                <a href="{{ route('category.show', $cat->slug) }}" title="{{ $cat->category_name }}">
                    <img src="{{ $cat->category_banner ? asset('assets/images/categories/' . $cat->category_banner) : asset('assets/image/img.webp') }}" alt="{{ $cat->category_name }}">
                </a>
                <span>{{ strtoupper($cat->category_name) }}</span>
                <p><a href="{{ route('category.show', $cat->slug) }}" title="Discover more {{ $cat->category_name }} stories">Discover More →</a></p>
            </div>
            @endforeach
        </div>

        <!-- Right Content -->
        <div class="lf-content">
            <div class="lf-head">
                <h2 class="lf-title">Latest Featured</h2>
            </div>

            <div class="lf-grid">
                @foreach($latestFeatured as $item)
                <div class="lf-card">
                    <a href="{{ route('news.show', [$item->category->slug, $item->encode_title]) }}" title="{{ $item->news_title }}">
                        <img src="{{ asset('assets/images/uploads/' . $item->photo) }}" alt="{{ $item->news_title }}">
                    </a>
                    <div class="lf-body">
                        <span class="lf-cat">{{ strtoupper($item->category->category_name) }}</span>
                        <h3>
                            <a href="{{ route('news.show', [$item->category->slug, $item->encode_title]) }}" title="{{ $item->news_title }}">
                                {{ $item->news_title }}
                            </a>
                        </h3>
                        <p class="lf-date">{{ \Carbon\Carbon::parse($item->published_at ?? $item->news_date)->format('F j, Y') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>


<!-- ============================
     3rd SECTION — AD BANNER
     ============================ -->
<section class="ad-banner-section">
    <div class="ad-banner-wrap">
        <a href="#" title="Advertisement"><img src="{{ asset('assets/image/ad.webp') }}" alt="Advertisement"></a>
    </div>
</section>


<!-- ============================
     4th SECTION — PHOTO OF THE DAY
     ============================ -->
@if($photoOfDay->count())
<section class="pd-section">
    <div class="pd-container">
        <div class="pd-header">
            <h2>Photo of The Day</h2>
        </div>
        <div class="pd-grid">
            <!-- Column 1 -->
            <div class="pd-col">
                @if($photoOfDay->get(0))
                <a href="{{ route('news.show', [$photoOfDay->get(0)->category->slug, $photoOfDay->get(0)->encode_title]) }}" title="{{ $photoOfDay->get(0)->news_title }}">
                    <img src="{{ asset('assets/images/uploads/' . $photoOfDay->get(0)->photo) }}" class="pd-img-tall-full" alt="{{ $photoOfDay->get(0)->news_title }}">
                </a>
                @endif
            </div>
            <!-- Column 2 -->
            <div class="pd-col">
                @if($photoOfDay->get(1))
                <a href="{{ route('news.show', [$photoOfDay->get(1)->category->slug, $photoOfDay->get(1)->encode_title]) }}" title="{{ $photoOfDay->get(1)->news_title }}">
                    <img src="{{ asset('assets/images/uploads/' . $photoOfDay->get(1)->photo) }}" class="pd-img-large" alt="{{ $photoOfDay->get(1)->news_title }}">
                </a>
                @endif
                @if($photoOfDay->get(2))
                <a href="{{ route('news.show', [$photoOfDay->get(2)->category->slug, $photoOfDay->get(2)->encode_title]) }}" title="{{ $photoOfDay->get(2)->news_title }}">
                    <img src="{{ asset('assets/images/uploads/' . $photoOfDay->get(2)->photo) }}" class="pd-img-medium" alt="{{ $photoOfDay->get(2)->news_title }}">
                </a>
                @endif
            </div>
            <!-- Column 3 -->
            <div class="pd-col">
                @if($photoOfDay->get(3))
                <a href="{{ route('news.show', [$photoOfDay->get(3)->category->slug, $photoOfDay->get(3)->encode_title]) }}" title="{{ $photoOfDay->get(3)->news_title }}">
                    <img src="{{ asset('assets/images/uploads/' . $photoOfDay->get(3)->photo) }}" class="pd-img-small" alt="{{ $photoOfDay->get(3)->news_title }}">
                </a>
                @endif
                @if($photoOfDay->get(4))
                <a href="{{ route('news.show', [$photoOfDay->get(4)->category->slug, $photoOfDay->get(4)->encode_title]) }}" title="{{ $photoOfDay->get(4)->news_title }}">
                    <img src="{{ asset('assets/images/uploads/' . $photoOfDay->get(4)->photo) }}" class="pd-img-tall" alt="{{ $photoOfDay->get(4)->news_title }}">
                </a>
                @endif
            </div>
        </div>
    </div>
</section>
@endif


<!-- ============================
     5th SECTION — HISTORY (primary category)
     ============================ -->
@if($historySectionNews->count())
<section class="history-block">
    <div class="history-wrap">
        <div class="history-head">
            <h2 class="history-title">{{ $historyCategoryName }}</h2>
            
        </div>

        <div class="history-top">
            @if($historySectionNews->get(0))
            @php $h0 = $historySectionNews->get(0); @endphp
            <div class="hs-large">
                <a href="{{ route('news.show', [$h0->category->slug, $h0->encode_title]) }}" title="{{ $h0->news_title }}">
                    <img src="{{ asset('assets/images/uploads/' . $h0->photo) }}" alt="{{ $h0->news_title }}">
                </a>
                <div class="hs-overlay">
                    <span class="hs-tag">{{ strtoupper($h0->category->category_name) }}</span>
                    <h3><a href="{{ route('news.show', [$h0->category->slug, $h0->encode_title]) }}" title="{{ $h0->news_title }}">{{ $h0->news_title }}</a></h3>
                    <p class="hs-date">{{ \Carbon\Carbon::parse($h0->published_at ?? $h0->news_date)->format('F j, Y') }}</p>
                </div>
            </div>
            @endif

            @if($historySectionNews->get(1))
            @php $h1 = $historySectionNews->get(1); @endphp
            <div class="hs-right">
                <a href="{{ route('news.show', [$h1->category->slug, $h1->encode_title]) }}" title="{{ $h1->news_title }}">
                    <img src="{{ asset('assets/images/uploads/' . $h1->photo) }}" alt="{{ $h1->news_title }}">
                </a>
                <span class="hs-tag">{{ strtoupper($h1->category->category_name) }}</span>
                <h4><a href="{{ route('news.show', [$h1->category->slug, $h1->encode_title]) }}" title="{{ $h1->news_title }}">{{ $h1->news_title }}</a></h4>
                <p class="hs-date">{{ \Carbon\Carbon::parse($h1->published_at ?? $h1->news_date)->format('F j, Y') }}</p>
            </div>
            @endif
        </div>

        <div class="history-bottom">
            @foreach($historySectionNews->slice(2, 3) as $item)
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
    </div>
</section>
@endif


<!-- ============================
     6th SECTION — ART COLLECTION (second category)
     ============================ -->
@if($artSectionNews->count())
<section class="ac-section">
    <div class="ac-container">
        <div class="ac-header">
            <h2>{{ $artCategoryName }}</h2>
           
        </div>
        <div class="ac-grid">

            <!-- Column 1 -->
            <div class="ac-column">
                @if($artSectionNews->get(0))
                @php $a0 = $artSectionNews->get(0); @endphp
                <div class="ac-card">
                    <a href="{{ route('news.show', [$a0->category->slug, $a0->encode_title]) }}" title="{{ $a0->news_title }}">
                        <img src="{{ asset('assets/images/uploads/' . $a0->photo) }}" class="ac-img-tall" alt="{{ $a0->news_title }}">
                    </a>
                    <div class="ac-text">
                        <h3><a href="{{ route('news.show', [$a0->category->slug, $a0->encode_title]) }}" title="{{ $a0->news_title }}">{{ $a0->news_title }}</a></h3>
                        <p>{{ Str::limit(strip_tags($a0->news_content_short), 90) }}</p>
                    </div>
                </div>
                @endif
                @if($artSectionNews->get(1))
                @php $a1 = $artSectionNews->get(1); @endphp
                <div class="ac-card">
                    <a href="{{ route('news.show', [$a1->category->slug, $a1->encode_title]) }}" title="{{ $a1->news_title }}">
                        <img src="{{ asset('assets/images/uploads/' . $a1->photo) }}" class="ac-img-short" alt="{{ $a1->news_title }}">
                    </a>
                    <div class="ac-text">
                        <h3><a href="{{ route('news.show', [$a1->category->slug, $a1->encode_title]) }}" title="{{ $a1->news_title }}">{{ $a1->news_title }}</a></h3>
                        <p>{{ Str::limit(strip_tags($a1->news_content_short), 80) }}</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Column 2 -->
            <div class="ac-column">
                @if($artSectionNews->get(2))
                @php $a2 = $artSectionNews->get(2); @endphp
                <div class="ac-card">
                    <a href="{{ route('news.show', [$a2->category->slug, $a2->encode_title]) }}" title="{{ $a2->news_title }}">
                        <img src="{{ asset('assets/images/uploads/' . $a2->photo) }}" class="ac-img-short" alt="{{ $a2->news_title }}">
                    </a>
                    <div class="ac-text">
                        <h3><a href="{{ route('news.show', [$a2->category->slug, $a2->encode_title]) }}" title="{{ $a2->news_title }}">{{ $a2->news_title }}</a></h3>
                        <p>{{ Str::limit(strip_tags($a2->news_content_short), 80) }}</p>
                    </div>
                </div>
                @endif
                @if($artSectionNews->get(3))
                @php $a3 = $artSectionNews->get(3); @endphp
                <div class="ac-card">
                    <a href="{{ route('news.show', [$a3->category->slug, $a3->encode_title]) }}" title="{{ $a3->news_title }}">
                        <img src="{{ asset('assets/images/uploads/' . $a3->photo) }}" class="ac-img-tall" alt="{{ $a3->news_title }}">
                    </a>
                    <div class="ac-text">
                        <h3><a href="{{ route('news.show', [$a3->category->slug, $a3->encode_title]) }}" title="{{ $a3->news_title }}">{{ $a3->news_title }}</a></h3>
                        <p>{{ Str::limit(strip_tags($a3->news_content_short), 90) }}</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Column 3 — image only -->
            <div class="ac-column">
                @if($artSectionNews->get(4))
                @php $a4 = $artSectionNews->get(4); @endphp
                <div class="ac-card ac-image-only">
                    <a href="{{ route('news.show', [$a4->category->slug, $a4->encode_title]) }}" title="{{ $a4->news_title }}">
                        <img src="{{ asset('assets/images/uploads/' . $a4->photo) }}" class="ac-img-large" alt="{{ $a4->news_title }}">
                    </a>
                </div>
                @endif
                @if($artSectionNews->get(5))
                @php $a5 = $artSectionNews->get(5); @endphp
                <div class="ac-card ac-image-only">
                    <a href="{{ route('news.show', [$a5->category->slug, $a5->encode_title]) }}" title="{{ $a5->news_title }}">
                        <img src="{{ asset('assets/images/uploads/' . $a5->photo) }}" class="ac-img-medium" alt="{{ $a5->news_title }}">
                    </a>
                </div>
                @endif
            </div>

        </div>
    </div>
</section>
@endif


<!-- ============================
     7th SECTION — DISCOVERIES
     ============================ -->
@if($discoveriesNews->count())
<section class="discover-block">
    <div class="discover-inner">
        <div class="discover-head">
            <h2 class="discover-title">{{ $discoveriesCategoryName }}</h2>
           
        </div>
        <div class="discover-grid">

            @if($discoveriesNews->get(0))
            @php $d0 = $discoveriesNews->get(0); @endphp
            <div class="dc-left">
                <a href="{{ route('news.show', [$d0->category->slug, $d0->encode_title]) }}" title="{{ $d0->news_title }}">
                    <img src="{{ asset('assets/images/uploads/' . $d0->photo) }}" alt="{{ $d0->news_title }}">
                </a>
                <span class="dc-label">{{ strtoupper($d0->category->category_name) }}</span>
                <h3 class="dc-big-title">
                    <a href="{{ route('news.show', [$d0->category->slug, $d0->encode_title]) }}" title="{{ $d0->news_title }}">{{ $d0->news_title }}</a>
                </h3>
                <p class="dc-date">{{ \Carbon\Carbon::parse($d0->published_at ?? $d0->news_date)->format('F j, Y') }}</p>
            </div>
            @endif

            @if($discoveriesNews->get(1))
            @php $d1 = $discoveriesNews->get(1); @endphp
            <div class="dc-middle">
                <a href="{{ route('news.show', [$d1->category->slug, $d1->encode_title]) }}" title="{{ $d1->news_title }}">
                    <img src="{{ asset('assets/images/uploads/' . $d1->photo) }}" alt="{{ $d1->news_title }}">
                </a>
                <div class="dc-overlay">
                    <span class="dc-label">{{ strtoupper($d1->category->category_name) }}</span>
                    <h3><a href="{{ route('news.show', [$d1->category->slug, $d1->encode_title]) }}" title="{{ $d1->news_title }}">{{ $d1->news_title }}</a></h3>
                    <p class="dc-date">{{ \Carbon\Carbon::parse($d1->published_at ?? $d1->news_date)->format('F j, Y') }}</p>
                </div>
            </div>
            @endif

            <div class="dc-right">
                <div class="dc-adbox">
                    <p class="dc-ad-text">- Advertisement -</p>
                    <img src="{{ asset('assets/image/img2.webp') }}" alt="Ad">
                </div>
                @foreach($discoveriesNews->slice(2) as $item)
                <div class="dc-list">
                    <h4><a href="{{ route('news.show', [$item->category->slug, $item->encode_title]) }}" title="{{ $item->news_title }}">{{ $item->news_title }}</a></h4>
                    <p class="dc-date">{{ \Carbon\Carbon::parse($item->published_at ?? $item->news_date)->format('F j, Y') }}</p>
                </div>
                @if(!$loop->last)<div class="dc-line"></div>@endif
                @endforeach
            </div>

        </div>
    </div>
</section>
@endif


<!-- ============================
     8th SECTION — TRAVEL CATEGORY CARDS
     ============================ -->
@if($travelNews->count())
<section class="category-section">
    <div class="section-header">
        <h2>{{ $travelCategoryName }}</h2>
      
    </div>
    <div class="category-grid">
        @foreach($travelNews as $item)
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


<!-- ============================
     9th SECTION — AD BANNER
     ============================ -->
<section class="ad-banner-section">
    <div class="ad-banner-wrap">
        <img src="{{ asset('assets/image/ad.webp') }}" alt="Advertisement">
    </div>
</section>


<!-- ============================
     10th SECTION — MORE STORIES + SIDEBAR
     ============================ -->
<section class="ms-section">
    <div class="ms-wrapper">

        <!-- Left: More Stories -->
        <div class="ms-content">
            <div class="ms-head">
                <h2 class="ms-title">More Stories</h2>
            </div>

            @foreach($moreStories as $index => $item)
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
                    <p class="ms-date">{{ \Carbon\Carbon::parse($item->published_at ?? $item->news_date)->format('F j, Y') }}</p>
                </div>
                @else
                <div class="ms-text">
                    <span class="ms-cat">{{ strtoupper($item->category->category_name) }}</span>
                    <h3><a href="{{ route('news.show', [$item->category->slug, $item->encode_title]) }}" title="{{ $item->news_title }}">{{ $item->news_title }}</a></h3>
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
            @endforeach
        </div>

        <!-- Right: Sidebar -->
        <div class="ms-sidebar">
            <h3 class="ms-follow-title">Tap In! Follow Us Now for Fresh Daily Content</h3>
            <div class="ms-social-grid">
                <div class="ms-social"><img src="{{ asset('assets/image/insta.webp') }}" alt=""><span>Facebook</span></div>
                <div class="ms-social"><img src="{{ asset('assets/image/insta.webp') }}" alt=""><span>X</span></div>
                <div class="ms-social"><img src="{{ asset('assets/image/insta.webp') }}" alt=""><span>YouTube</span></div>
                <div class="ms-social"><img src="{{ asset('assets/image/insta.webp') }}" alt=""><span>PayPal</span></div>
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

@endsection

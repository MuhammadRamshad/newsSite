@extends('layouts.app')
@section('title', 'Personalized News Feed — ' . config('app.name', 'Illuminated Magazine'))
@section('description', 'Your personalized feed of curated stories and recommended articles from Illuminated Magazine.')
@section('robots', 'noindex,follow')
@section('canonical', route('myfeed'))
@section('content')
    @php
        use Illuminate\Support\Str;
    @endphp

    <!-- ================= JUST FOR YOU HEADER ================= -->
    <section class="recommend-section myfeed-section">

        <div class="recommend-header">
            <div>
                <h2>Just for You</h2>
                <p style="color:#666;font-size:14px">
                    The Latest News on Your Interests
                </p>
            </div>
        </div>


        <!-- ================= TOP 2 FEATURED ARTICLES ================= -->
        <div class="health-grid">

            {{-- LEFT FEATURED --}}
            @if($featuredLeft)
                <article class="health-featured">
                    <div class="health-featured-image">

                        <span class="card-tag">
                            {{ strtoupper(optional($featuredLeft->category)->category_name) }}
                        </span>

                        <a href="{{ route('news.show', [$featuredLeft->category->slug, $featuredLeft->encode_title]) }}" title="{{ $featuredLeft->news_title }}">
                            <img src="{{ asset('assets/images/uploads/' . $featuredLeft->photo) }}"
                                alt="{{ $featuredLeft->news_title }}">
                        </a>

                        <div class="health-overlay">

                            <h3>
                               <a href="{{ route('news.show', [$featuredLeft->category->slug, $featuredLeft->encode_title]) }}" title="{{ $featuredLeft->news_title }}">
                                    {{ $featuredLeft->news_title }}
                                </a>
                            </h3>

                            <p class="font">
                                {{ Str::limit($featuredLeft->news_content_short, 150) }}
                            </p>

                            <div class="article-meta">

                                <span class="article-author">
                                    @if($featuredLeft->author)
                                        <a href="{{ route('author.show', $featuredLeft->author->slug) }}" title="{{ $featuredLeft->author->name }}">
                                            {{ $featuredLeft->author->name }}
                                        </a>
                                    @else
                                        Editorial Desk
                                    @endif
                                </span>

                                <button class="bookmark-btn" data-id="{{ $featuredLeft->news_id }}">
                                    <svg class="bookmark-icon" viewBox="0 0 24 24" fill="none" stroke-width="2">
                                        <path d="M6 3h12v18l-6-4-6 4z" stroke="#ffffff" />
                                    </svg>
                                </button>

                            </div>

                        </div>
                    </div>
                </article>
            @endif



            {{-- RIGHT FEATURED --}}
            @if($featuredRight)
                <article class="health-featured">
                    <div class="health-featured-image">

                        <span class="card-tag">
                            {{ strtoupper(optional($featuredRight->category)->category_name) }}
                        </span>

                       <a href="{{ route('news.show', [$featuredRight->category->slug, $featuredRight->encode_title]) }}" title="{{ $featuredRight->news_title }}">
                            <img src="{{ asset('assets/images/uploads/' . $featuredRight->photo) }}"
                                alt="{{ $featuredRight->news_title }}">
                        </a>

                        <div class="health-overlay">

                            <h3>
                                <a href="{{ route('news.show', [$featuredRight->category->slug, $featuredRight->encode_title]) }}" title="{{ $featuredRight->news_title }}">
                                    {{ $featuredRight->news_title }}
                                </a>
                            </h3>

                            <p class="font">
                                {{ Str::limit($featuredRight->news_content_short, 150) }}
                            </p>

                            <div class="article-meta">

                                <span class="article-author">
                                    @if($featuredRight->author)
                                        <a href="{{ route('author.show', $featuredRight->author->slug) }}" title="{{ $featuredRight->author->name }}">
                                            {{ $featuredRight->author->name }}
                                        </a>
                                    @else
                                        Editorial Desk
                                    @endif
                                </span>

                                <button class="bookmark-btn" data-id="{{ $featuredRight->news_id }}">
                                    <svg class="bookmark-icon" viewBox="0 0 24 24" fill="none" stroke-width="2">
                                        <path d="M6 3h12v18l-6-4-6 4z" stroke="#ffffff" />
                                    </svg>
                                </button>

                            </div>

                        </div>
                    </div>
                </article>
            @endif

        </div>
<br>


        <!-- ================= FIRST 4 ARTICLE CARDS ================= -->
        <div class="four-column-container my-feed-section">

            @foreach($rowOne as $item)
                <article class="recommend-card my-feed-section">

                    <div class="card-image">
                        <a href="{{ route('news.show', [$item->category->slug, $item->encode_title]) }}" title="{{ $item->news_title }}">
                            <img src="{{ asset('assets/images/uploads/' . $item->photo) }}"
                                alt="{{ $item->news_title }}">
                        </a>

                        <span class="card-tag">
                            {{ strtoupper(optional($item->category)->category_name) }}
                        </span>
                    </div>

                    <h3>
                        <a href="{{ route('news.show', [$item->category->slug, $item->encode_title]) }}" title="{{ $item->news_title }}">
                            {{ $item->news_title }}
                        </a>
                    </h3>

                    <p class="card-desc">
                        {{ Str::limit($item->news_content_short, 110) }}
                    </p>

                    <div class="article-meta">

                        <span class="article-author">
                            @if($item->author)
                                <a href="{{ route('author.show', $item->author->slug) }}" title="{{ $item->author->name }}">
                                    {{ $item->author->name }}
                                </a>
                            @else
                                Editorial Desk
                            @endif
                        </span>

                        <button class="bookmark-btn" data-id="{{ $item->news_id }}">
                            <svg class="bookmark-icon" viewBox="0 0 24 24" fill="none" stroke-width="2">
                                <path d="M6 3h12v18l-6-4-6 4z" stroke="currentColor" />
                            </svg>
                        </button>

                    </div>

                </article>
            @endforeach

        </div>


        <!-- ================= NEWSLETTER SUBSCRIBE ================= -->
        <section class="subscription-box" id="subscribe-section">

            <div class="subscription-container">

                <div class="subscription-image">
                    <img src="{{ asset('assets/images/logo.webp') }}" alt="logo">
                </div>

                <div class="subscription-title">
                    <h2>Unlock the Pulse of the Present</h2>
                    <p>Subscribe Now for Real-Time Updates on the Latest Stories!</p>
                </div>

                <form class="subscription-form" method="POST" action="#">
                    @csrf

                    <input type="email" name="email" placeholder="Your email address" required>

                    <button class="sign-up-btn">Sign Up Now</button>

                    <div class="terms-conditions">
                        <input type="checkbox" required>
                        <label>I have read and agree to the terms & conditions</label>
                    </div>
                </form>

            </div>

        </section>



        <!-- ================= SECOND 4 ARTICLE CARDS ================= -->
        <div class="four-column-container">

            @foreach($rowTwo as $item)
                <article class="recommend-card">

                    <div class="card-image">
                        <a href="{{ route('news.show', [$item->category->slug, $item->encode_title]) }}" title="{{ $item->news_title }}">
                            <img src="{{ asset('assets/images/uploads/' . $item->photo) }}"
                                alt="{{ $item->news_title }}">
                        </a>

                        <span class="card-tag">
                            {{ strtoupper(optional($item->category)->category_name) }}
                        </span>
                    </div>

                    <h3>
                        <a href="{{ route('news.show', [$item->category->slug, $item->encode_title]) }}" title="{{ $item->news_title }}">
                            {{ $item->news_title }}
                        </a>
                    </h3>

                    <p class="card-desc">
                        {{ Str::limit($item->news_content_short, 110) }}
                    </p>

                    <div class="article-meta">

                        <span class="article-author">
                            @if($item->author)
                                <a href="{{ route('author.show', $item->author->slug) }}"  title="{{ $item->author->name }}">
                                    {{ $item->author->name }}
                                </a>
                            @else
                                Editorial Desk
                            @endif
                        </span>

                        <button class="bookmark-btn" data-id="{{ $item->news_id }}">
                            <svg class="bookmark-icon" viewBox="0 0 24 24" fill="none" stroke-width="2">
                                <path d="M6 3h12v18l-6-4-6 4z" stroke="currentColor" />
                            </svg>
                        </button>

                    </div>

                </article>
            @endforeach

        </div>

    </section>
    <hr class="custom-line">
@endsection

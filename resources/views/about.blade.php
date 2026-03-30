@extends('layouts.app')
@section('title', 'About — Illuminated Magazine')
@section('description', 'Learn about Illuminated Magazine — your trusted source for art, history, science and cultural discoveries.')
@section('keywords', 'about illuminated magazine, art journalism, cultural discoveries, history reporting')
@section('canonical', route('about'))

@section('content')

<section class="about-white-section">
    <div class="about-white-container">

        <h1 class="about-white-title">About</h1>
        <h2 class="about-white-subtitle">Illuminated</h2>

        <p class="about-white-text">
            We do fair and accurate reporting in our newsroom, which lets us do high-quality journalism covering
            art, history, science, and cultural discoveries from across the globe. We report on topics in a way
            that is accurate, responsible, and in the public interest.
        </p>

        <p class="about-white-text">
            Our reporters and editors come from a variety of backgrounds and want to help readers understand the
            extraordinary stories hidden within history and culture. Every article goes through fact-checking,
            source verification, and ethical reporting steps.
        </p>

        <div class="about-white-image">
            <img src="{{ asset('assets/image/img1.webp') }}" alt="Illuminated Magazine">
        </div>

        <p class="about-white-text">We believe that great journalism should:</p>

        <ul class="about-white-list">
            <li>Give the public clear and relevant information</li>
            <li>Preserve and celebrate human history and culture</li>
            <li>Bring attention to underreported topics and communities</li>
            <li>Encourage critical debate and civic participation</li>
            <li>Inspire curiosity about the world around us</li>
        </ul>

        <p class="about-white-text">
            As an independent digital magazine, we value honesty and openness. We want to earn your trust
            by giving you breaking discoveries, investigative features, and thoughtful commentary on art and culture.
        </p>

        <p class="about-white-text">
            We appreciate that you read and support our work.
        </p>

    </div>
</section>

@endsection

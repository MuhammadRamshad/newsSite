<div class="logo-bar">

    <div class="mobile-menu">
        <a href="#" id="menu-toggle">
            <img src="{{ asset('assets/image/menu.webp') }}" alt="Menu">
            <span>SECTION</span>
        </a>
        <ul class="menu-dropdown" id="menu-list">
            <li><a href="{{ route('index') }}">Home</a></li>
            @foreach($navCategories as $cat)
                <li><a href="{{ route('category.show', $cat->slug) }}">{{ $cat->category_name }}</a></li>
            @endforeach
        </ul>
    </div>

    <a href="{{ route('index') }}" class="logo">
        illuminated
        <span>Art &amp; Discoveries</span>
    </a>

    <div class="search-area">
        <a href="{{ route('search') }}" class="search-link">
            <img src="{{ asset('assets/image/search.webp') }}" alt="Search">
            <span>Search</span>
        </a>
        <a href="#" class="theme-link">
            <img src="{{ asset('assets/image/clock.webp') }}" alt="Theme">
        </a>
    </div>

</div>

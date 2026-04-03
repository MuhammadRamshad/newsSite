<nav class="nav-wrapper">
    <div class="nav-box">
        <ul class="nav-menu">
            <li class="{{ request()->routeIs('index') ? 'active' : '' }}">
                <a href="{{ route('index') }}" title="Illuminated Magazine Home">HOME</a>
            </li>
            @foreach($navCategories as $cat)
                <li class="{{ request()->routeIs('category.show') && request()->route('slug') == $cat->slug ? 'active' : '' }}">
                    <a href="{{ route('category.show', $cat->slug) }}" title="{{ $cat->category_name }} articles">{{ strtoupper($cat->category_name) }}</a>
                </li>
            @endforeach
            @if($otherCategories->count())
                <li class="has-dropdown">
                    <a href="#" title="More categories">MORE ▾</a>
                    <ul class="dropdown">
                        @foreach($otherCategories as $cat)
                            <li><a href="{{ route('category.show', $cat->slug) }}" title="{{ $cat->category_name }}">{{ $cat->category_name }}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</nav>

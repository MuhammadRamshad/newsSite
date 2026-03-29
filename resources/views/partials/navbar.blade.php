<nav class="nav-wrapper">
    <div class="nav-box">
        <ul class="nav-menu">
            <li class="{{ request()->routeIs('index') ? 'active' : '' }}">
                <a href="{{ route('index') }}">HOME</a>
            </li>
            @foreach($navCategories as $cat)
                <li class="{{ request()->routeIs('category.show') && request()->route('slug') == $cat->slug ? 'active' : '' }}">
                    <a href="{{ route('category.show', $cat->slug) }}">{{ strtoupper($cat->category_name) }}</a>
                </li>
            @endforeach
            @if($otherCategories->count())
                <li class="has-dropdown">
                    <a href="#">MORE ▾</a>
                    <ul class="dropdown">
                        @foreach($otherCategories as $cat)
                            <li><a href="{{ route('category.show', $cat->slug) }}">{{ $cat->category_name }}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</nav>

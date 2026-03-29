<footer class="footer">
    <div class="footer-inner">
        <div class="footer-left">
            <h2 class="footer-logo">illuminated</h2>
            <p>
                <strong>About Magazine:</strong> Illuminated covers the latest in art, science and cultural discourse.
                From ancient discoveries to critical conversations, we explore where creativity meets thought.
                Insightful, bold, and always curious.
            </p>
        </div>
        <div class="footer-center">
            <div class="quick-title"><span class="quick-box">Quick Links</span></div>
            <ul class="footer-links">
                @foreach($circleCategories as $cat)
                    <li><a href="{{ route('category.show', $cat->slug) }}">{{ $cat->category_name }}</a></li>
                @endforeach
                <li><a href="{{ route('about') }}">About</a></li>
                <li><a href="{{ route('privacyPolicy') }}">Privacy Policy</a></li>
            </ul>
            <div class="footer-social">
                <a href="#"><img src="{{ asset('assets/image/footer-instagram.webp') }}" alt="Instagram"></a>
                <a href="#"><img src="{{ asset('assets/image/footer-instagram.webp') }}" alt="Facebook"></a>
                <a href="#"><img src="{{ asset('assets/image/footer-instagram.webp') }}" alt="Twitter"></a>
                <a href="#"><img src="{{ asset('assets/image/footer-instagram.webp') }}" alt="YouTube"></a>
                <a href="#"><img src="{{ asset('assets/image/footer-instagram.webp') }}" alt="RSS"></a>
            </div>
        </div>
        <div class="footer-right">
            <div class="copyright-icon">©</div>
            <p>© {{ config('app.name') }}.<br>All Rights Reserved.</p>
        </div>
    </div>
</footer>

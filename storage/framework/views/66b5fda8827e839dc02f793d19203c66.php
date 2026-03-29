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
                <?php $__currentLoopData = $circleCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="<?php echo e(route('category.show', $cat->slug)); ?>"><?php echo e($cat->category_name); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <li><a href="<?php echo e(route('about')); ?>">About</a></li>
                <li><a href="<?php echo e(route('privacyPolicy')); ?>">Privacy Policy</a></li>
            </ul>
            <div class="footer-social">
                <a href="#"><img src="<?php echo e(asset('assets/image/footer-instagram.webp')); ?>" alt="Instagram"></a>
                <a href="#"><img src="<?php echo e(asset('assets/image/footer-instagram.webp')); ?>" alt="Facebook"></a>
                <a href="#"><img src="<?php echo e(asset('assets/image/footer-instagram.webp')); ?>" alt="Twitter"></a>
                <a href="#"><img src="<?php echo e(asset('assets/image/footer-instagram.webp')); ?>" alt="YouTube"></a>
                <a href="#"><img src="<?php echo e(asset('assets/image/footer-instagram.webp')); ?>" alt="RSS"></a>
            </div>
        </div>
        <div class="footer-right">
            <div class="copyright-icon">©</div>
            <p>© <?php echo e(config('app.name')); ?>.<br>All Rights Reserved.</p>
        </div>
    </div>
</footer>
<?php /**PATH C:\Users\Muhammad Ramshad\Downloads\illuminated_news\resources\views/partials/footer.blade.php ENDPATH**/ ?>
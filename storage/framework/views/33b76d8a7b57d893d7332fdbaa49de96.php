<div class="logo-bar">

    <div class="mobile-menu">
        <a href="#" id="menu-toggle">
            <img src="<?php echo e(asset('assets/image/menu.webp')); ?>" alt="Menu">
            <span>SECTION</span>
        </a>
        <ul class="menu-dropdown" id="menu-list">
            <li><a href="<?php echo e(route('index')); ?>">Home</a></li>
            <?php $__currentLoopData = $navCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a href="<?php echo e(route('category.show', $cat->slug)); ?>"><?php echo e($cat->category_name); ?></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>

    <a href="<?php echo e(route('index')); ?>" class="logo">
        illuminated
        <span>Art &amp; Discoveries</span>
    </a>

    <div class="search-area">
        <a href="<?php echo e(route('search')); ?>" class="search-link">
            <img src="<?php echo e(asset('assets/image/search.webp')); ?>" alt="Search">
            <span>Search</span>
        </a>
        <a href="#" class="theme-link">
            <img src="<?php echo e(asset('assets/image/clock.webp')); ?>" alt="Theme">
        </a>
    </div>

</div>
<?php /**PATH C:\Users\Muhammad Ramshad\Downloads\illuminated_news\resources\views/partials/logo-bar.blade.php ENDPATH**/ ?>
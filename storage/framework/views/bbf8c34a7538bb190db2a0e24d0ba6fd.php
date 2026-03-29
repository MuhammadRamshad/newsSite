<nav class="nav-wrapper">
    <div class="nav-box">
        <ul class="nav-menu">
            <li class="<?php echo e(request()->routeIs('index') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('index')); ?>">HOME</a>
            </li>
            <?php $__currentLoopData = $navCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="<?php echo e(request()->routeIs('category.show') && request()->route('slug') == $cat->slug ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('category.show', $cat->slug)); ?>"><?php echo e(strtoupper($cat->category_name)); ?></a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if($otherCategories->count()): ?>
                <li class="has-dropdown">
                    <a href="#">MORE ▾</a>
                    <ul class="dropdown">
                        <?php $__currentLoopData = $otherCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(route('category.show', $cat->slug)); ?>"><?php echo e($cat->category_name); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<?php /**PATH C:\Users\Muhammad Ramshad\Downloads\illuminated_news\resources\views/partials/navbar.blade.php ENDPATH**/ ?>
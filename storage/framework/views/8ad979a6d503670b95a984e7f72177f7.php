<?php use Illuminate\Support\Str; ?>

<?php $__env->startSection('title', $category->category_name . ' — Illuminated Magazine'); ?>
<?php $__env->startSection('description', 'Explore the latest ' . $category->category_name . ' articles, stories and discoveries on Illuminated Magazine.'); ?>

<?php $__env->startSection('schema'); ?>
<?php
$categorySchema = [
    "@context" => "https://schema.org",
    "@type"    => "CollectionPage",
    "name"     => $category->category_name,
    "url"      => route('category.show', $category->slug),
];
?>
<script type="application/ld+json">
<?php echo json_encode($categorySchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT); ?>

</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Category Header -->
<section class="cat-head-section">
    <div class="cat-head-container">
        <div class="cat-breadcrumb">
            <a href="<?php echo e(route('index')); ?>">Illuminated Magazine</a>
            <span>&gt;</span>
            <span class="cat-current"><?php echo e($category->category_name); ?></span>
        </div>
        <h1 class="cat-title"><?php echo e($category->category_name); ?></h1>
    </div>
</section>


<!-- Featured top 2 posts — history-block style -->
<?php if($featured->count()): ?>
<section class="history-block">
    <div class="history-wrap">

        <div class="history-top">
            <?php if($featured->get(0)): ?>
            <?php $f0 = $featured->get(0); ?>
            <div class="hs-large">
                <a href="<?php echo e(route('news.show', [$f0->category->slug, $f0->encode_title])); ?>" title="<?php echo e($f0->news_title); ?>">
                    <img src="<?php echo e(url('https://financial-journal.xyz/newspaper/cms/public/uploads/' . $f0->photo)); ?>" alt="<?php echo e($f0->news_title); ?>">
                </a>
                <div class="hs-overlay">
                    <span class="hs-tag"><?php echo e(strtoupper($f0->category->category_name)); ?></span>
                    <h3><a href="<?php echo e(route('news.show', [$f0->category->slug, $f0->encode_title])); ?>" title="<?php echo e($f0->news_title); ?>"><?php echo e($f0->news_title); ?></a></h3>
                    <p class="hs-date"><?php echo e(\Carbon\Carbon::parse($f0->published_at ?? $f0->news_date)->format('F j, Y')); ?></p>
                </div>
            </div>
            <?php endif; ?>

            <?php if($featured->get(1)): ?>
            <?php $f1 = $featured->get(1); ?>
            <div class="hs-right">
                <a href="<?php echo e(route('news.show', [$f1->category->slug, $f1->encode_title])); ?>" title="<?php echo e($f1->news_title); ?>">
                    <img src="<?php echo e(url('https://financial-journal.xyz/newspaper/cms/public/uploads/' . $f1->photo)); ?>" alt="<?php echo e($f1->news_title); ?>">
                </a>
                <span class="hs-tag"><?php echo e(strtoupper($f1->category->category_name)); ?></span>
                <h4><a href="<?php echo e(route('news.show', [$f1->category->slug, $f1->encode_title])); ?>" title="<?php echo e($f1->news_title); ?>"><?php echo e($f1->news_title); ?></a></h4>
                <p class="hs-date"><?php echo e(\Carbon\Carbon::parse($f1->published_at ?? $f1->news_date)->format('F j, Y')); ?></p>
            </div>
            <?php endif; ?>
        </div>

        <?php if($featured->count() > 2): ?>
        <div class="history-bottom">
            <?php $__currentLoopData = $featured->slice(2, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="hs-small">
                <a href="<?php echo e(route('news.show', [$item->category->slug, $item->encode_title])); ?>" title="<?php echo e($item->news_title); ?>">
                    <img src="<?php echo e(url('https://financial-journal.xyz/newspaper/cms/public/uploads/' . $item->photo)); ?>" alt="<?php echo e($item->news_title); ?>">
                </a>
                <span class="hs-tag"><?php echo e(strtoupper($item->category->category_name)); ?></span>
                <h5><a href="<?php echo e(route('news.show', [$item->category->slug, $item->encode_title])); ?>" title="<?php echo e($item->news_title); ?>"><?php echo e($item->news_title); ?></a></h5>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="hs-ad">
                <p class="hs-ad-text">- Advertisement -</p>
                <img src="<?php echo e(asset('assets/image/img1.webp')); ?>" alt="Ad">
            </div>
        </div>
        <?php endif; ?>

    </div>
</section>
<?php endif; ?>


<!-- Remaining articles — ms-section style -->
<section class="ms-section">
    <div class="ms-wrapper">
        <div class="ms-content">
            <?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="ms-row <?php echo e($index % 2 != 0 ? 'reverse' : ''); ?>">
                <?php if($index % 2 == 0): ?>
                <div class="ms-image">
                    <a href="<?php echo e(route('news.show', [$item->category->slug, $item->encode_title])); ?>" title="<?php echo e($item->news_title); ?>">
                        <img src="<?php echo e(url('https://financial-journal.xyz/newspaper/cms/public/uploads/' . $item->photo)); ?>" alt="<?php echo e($item->news_title); ?>">
                    </a>
                </div>
                <div class="ms-text">
                    <span class="ms-cat"><?php echo e(strtoupper($item->category->category_name)); ?></span>
                    <h3><a href="<?php echo e(route('news.show', [$item->category->slug, $item->encode_title])); ?>" title="<?php echo e($item->news_title); ?>"><?php echo e($item->news_title); ?></a></h3>
                    <p><?php echo e(Str::limit(strip_tags($item->news_content_short), 120)); ?></p>
                    <p class="ms-date"><?php echo e(\Carbon\Carbon::parse($item->published_at ?? $item->news_date)->format('F j, Y')); ?></p>
                </div>
                <?php else: ?>
                <div class="ms-text">
                    <span class="ms-cat"><?php echo e(strtoupper($item->category->category_name)); ?></span>
                    <h3><a href="<?php echo e(route('news.show', [$item->category->slug, $item->encode_title])); ?>" title="<?php echo e($item->news_title); ?>"><?php echo e($item->news_title); ?></a></h3>
                    <p><?php echo e(Str::limit(strip_tags($item->news_content_short), 120)); ?></p>
                    <p class="ms-date"><?php echo e(\Carbon\Carbon::parse($item->published_at ?? $item->news_date)->format('F j, Y')); ?></p>
                </div>
                <div class="ms-image">
                    <a href="<?php echo e(route('news.show', [$item->category->slug, $item->encode_title])); ?>" title="<?php echo e($item->news_title); ?>">
                        <img src="<?php echo e(url('https://financial-journal.xyz/newspaper/cms/public/uploads/' . $item->photo)); ?>" alt="<?php echo e($item->news_title); ?>">
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <?php if(!$loop->last): ?><div class="ms-divider"></div><?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p style="padding:30px 0;">No articles found in this category.</p>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="ms-sidebar">
            <h3 class="ms-follow-title">Tap In! Follow Us Now for Fresh Daily Content</h3>
            <div class="ms-social-grid">
                <div class="ms-social"><img src="<?php echo e(asset('assets/image/insta.webp')); ?>" alt=""><span>Facebook</span></div>
                <div class="ms-social"><img src="<?php echo e(asset('assets/image/insta.webp')); ?>" alt=""><span>X</span></div>
                <div class="ms-social"><img src="<?php echo e(asset('assets/image/insta.webp')); ?>" alt=""><span>YouTube</span></div>
                <div class="ms-social"><img src="<?php echo e(asset('assets/image/insta.webp')); ?>" alt=""><span>Patreon</span></div>
                <div class="ms-social"><img src="<?php echo e(asset('assets/image/insta.webp')); ?>" alt=""><span>RSS Feed</span></div>
            </div>
            <div class="ms-adbox">
                <p class="ms-ad-text">- Advertisement -</p>
                <img src="<?php echo e(asset('assets/image/img2.webp')); ?>" alt="Ad">
            </div>
        </div>
    </div>
</section>

<!-- Pagination -->
<div class="pagination-wrapper" style="padding:20px 40px;">
    <?php echo e($articles->links()); ?>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Muhammad Ramshad\Downloads\illuminated_news\resources\views/category.blade.php ENDPATH**/ ?>
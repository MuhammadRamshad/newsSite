<?php use Illuminate\Support\Str; ?>


<?php $__env->startSection('title', $newsDetail->news_title . ' — Illuminated Magazine'); ?>
<?php $__env->startSection('description', Str::limit(strip_tags($newsDetail->news_content_short), 155)); ?>
<?php $__env->startSection('keywords', optional($newsDetail->category)->category_name . ', illuminated magazine, art, discoveries'); ?>
<?php $__env->startSection('og_image', asset('assets/images/uploads/' . $newsDetail->photo)); ?>
<?php $__env->startSection('canonical', route('news.show', [$newsDetail->category->slug, $newsDetail->encode_title])); ?>
<?php $__env->startSection('article_author', optional($newsDetail->author)->name ?? 'Editorial Desk'); ?>
<?php $__env->startSection('article_section', optional($newsDetail->category)->category_name); ?>
<?php $__env->startSection('published_time', \Carbon\Carbon::parse($newsDetail->news_date ?? $newsDetail->updated_at)->toIso8601String()); ?>
<?php $__env->startSection('modified_time', \Carbon\Carbon::parse($newsDetail->updated_at ?? $newsDetail->news_date)->toIso8601String()); ?>
<?php $__env->startSection('twitter_creator', '@illuminatedmag'); ?>

<?php $__env->startSection('schema'); ?>
<?php
$articleSchema = [
    "@context"        => "https://schema.org",
    "@type"           => "NewsArticle",
    "mainEntityOfPage" => [
        "@type" => "WebPage",
        "@id"   => route('news.show', [$newsDetail->category->slug, $newsDetail->encode_title]),
    ],
    "headline"        => $newsDetail->news_title,
    "description"     => Str::limit(strip_tags($newsDetail->news_content_short), 160),
    "image"           => [
        "@type"  => "ImageObject",
        "url"    => asset('assets/images/uploads/' . $newsDetail->photo),
        "width"  => 1200,
        "height" => 630,
    ],
    "datePublished"   => \Carbon\Carbon::parse($newsDetail->news_date ?? $newsDetail->updated_at)->toIso8601String(),
    "dateModified"    => \Carbon\Carbon::parse($newsDetail->updated_at ?? $newsDetail->news_date)->toIso8601String(),
    "author"          => [
        "@type" => "Person",
        "name"  => optional($newsDetail->author)->name ?? 'Editorial Desk',
        "url"   => $newsDetail->author ? route('author.show', $newsDetail->author->slug) : url('/'),
    ],
    "publisher" => [
        "@type" => "Organization",
        "name"  => config('app.name', 'Illuminated Magazine'),
        "logo"  => [
            "@type" => "ImageObject",
            "url"   => asset('assets/images/logo.webp'),
        ],
    ],
    "articleSection" => optional($newsDetail->category)->category_name,
    "wordCount"      => str_word_count(strip_tags($newsDetail->news_content ?? '')),
    "url"            => route('news.show', [$newsDetail->category->slug, $newsDetail->encode_title]),
];

$breadcrumbSchema = [
    "@context" => "https://schema.org",
    "@type"    => "BreadcrumbList",
    "itemListElement" => [
        ["@type" => "ListItem", "position" => 1, "name" => "Home", "item" => url('/')],
        ["@type" => "ListItem", "position" => 2, "name" => optional($newsDetail->category)->category_name, "item" => route('category.show', optional($newsDetail->category)->slug ?? '#')],
        ["@type" => "ListItem", "position" => 3, "name" => $newsDetail->news_title],
    ]
];
?>
<script type="application/ld+json"><?php echo json_encode($articleSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE); ?></script>
<script type="application/ld+json"><?php echo json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE); ?></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- ============================
     HERO / POST HEADER
     ============================ -->
<section class="post-hero-section">

    <div class="post-hero-image">
        <img src="<?php echo e(asset('assets/images/uploads/' . $newsDetail->photo)); ?>" alt="<?php echo e($newsDetail->news_title); ?>">
    </div>

    <div class="post-hero-container">

        <div class="post-hero-breadcrumb">
            <a href="<?php echo e(route('index')); ?>">Illuminated Magazine</a>
            &gt;
            <a href="<?php echo e(route('category.show', $newsDetail->category->slug)); ?>"><?php echo e($newsDetail->category->category_name); ?></a>
            &gt;
            <?php echo e(Str::limit($newsDetail->news_title, 60)); ?>

        </div>

        <div class="post-hero-category"><?php echo e(strtoupper($newsDetail->category->category_name)); ?></div>

        <h1 class="post-hero-title"><?php echo e($newsDetail->news_title); ?></h1>

        <p class="post-hero-excerpt">
            <?php echo e(Str::limit(strip_tags($newsDetail->news_content_short), 200)); ?>

        </p>

        <div class="post-hero-meta">
            <div class="post-hero-author">
                <?php if($newsDetail->author): ?>
                    <img src="<?php echo e($newsDetail->author->image ? asset('assets/images/authors/' . $newsDetail->author->image) : asset('assets/image/author.webp')); ?>" alt="<?php echo e($newsDetail->author->name); ?>">
                    <div>
                        <div class="post-hero-author-name">
                            By <strong>
                                <a href="<?php echo e(route('author.show', $newsDetail->author->slug)); ?>" title="<?php echo e($newsDetail->author->name); ?>">
                                    <?php echo e($newsDetail->author->name); ?>

                                </a>
                            </strong>
                            <?php if($newsDetail->author->designation): ?>
                                — <?php echo e($newsDetail->author->designation); ?>

                            <?php endif; ?>
                        </div>
                        <div class="post-hero-date">
                            Last updated: <?php echo e(\Carbon\Carbon::parse($newsDetail->updated_at ?? $newsDetail->news_date)->format('F j, Y g:i a')); ?>

                            &bull;
                            <?php echo e(ceil(str_word_count(strip_tags($newsDetail->news_content)) / 200)); ?> Min Read
                        </div>
                    </div>
                <?php else: ?>
                    <img src="<?php echo e(asset('assets/image/author.webp')); ?>" alt="Editorial Desk">
                    <div>
                        <div class="post-hero-author-name">By <strong>Editorial Desk</strong></div>
                        <div class="post-hero-date">
                            <?php echo e(\Carbon\Carbon::parse($newsDetail->news_date)->format('F j, Y')); ?>

                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="post-hero-share">
                <span>Share</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(url()->current())); ?>" target="_blank">
                    <img src="<?php echo e(asset('assets/image/insta.webp')); ?>" alt="Facebook">
                </a>
                <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(url()->current())); ?>&text=<?php echo e(urlencode($newsDetail->news_title)); ?>" target="_blank">
                    <img src="<?php echo e(asset('assets/image/insta.webp')); ?>" alt="Twitter">
                </a>
                <a href="https://wa.me/?text=<?php echo e(urlencode($newsDetail->news_title . ' ' . url()->current())); ?>" target="_blank">
                    <img src="<?php echo e(asset('assets/image/insta.webp')); ?>" alt="WhatsApp">
                </a>
            </div>
        </div>

        <div class="post-hero-divider"></div>
    </div>
</section>


<!-- ============================
     ARTICLE BODY
     ============================ -->
<section class="detail-block">
    <div class="detail-wrapper">

        <!-- Share Column (sticky sidebar) -->
        <div class="detail-share">
            <span class="detail-share-title">SHARE</span>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(url()->current())); ?>" target="_blank">
                <img src="<?php echo e(asset('assets/image/insta.webp')); ?>" alt="Facebook">
            </a>
            <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(url()->current())); ?>&text=<?php echo e(urlencode($newsDetail->news_title)); ?>" target="_blank">
                <img src="<?php echo e(asset('assets/image/insta.webp')); ?>" alt="Twitter">
            </a>
            <a href="https://wa.me/?text=<?php echo e(urlencode($newsDetail->news_title . ' ' . url()->current())); ?>" target="_blank">
                <img src="<?php echo e(asset('assets/image/insta.webp')); ?>" alt="WhatsApp">
            </a>
        </div>

        <!-- Main Content -->
        <div class="detail-content">
            <p class="detail-drop">
                <?php echo e(Str::limit(strip_tags($newsDetail->news_content_short), 300)); ?>

            </p>

            <div class="article-block">
                <?php echo $newsDetail->news_content; ?>

            </div>
        </div>

    </div>
</section>


<!-- ============================
     ARTICLE FOOTER — Share + Author Box
     ============================ -->
<section class="article-footer-section">
    <div class="article-footer-container">

        <div class="article-share-row">
            <div class="article-share-left">
                <span class="article-share-icon">↗</span>
                <h3>Share This Article</h3>
            </div>
            <div class="article-share-right">
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(url()->current())); ?>" target="_blank" class="share-btn">
                    <img src="<?php echo e(asset('assets/image/insta.webp')); ?>" alt="Facebook">
                </a>
                <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(url()->current())); ?>" target="_blank" class="share-btn-icon">
                    <img src="<?php echo e(asset('assets/image/insta.webp')); ?>" alt="Twitter">
                </a>
                <a href="https://wa.me/?text=<?php echo e(urlencode(url()->current())); ?>" target="_blank" class="share-btn-icon">
                    <img src="<?php echo e(asset('assets/image/insta.webp')); ?>" alt="WhatsApp">
                </a>
            </div>
        </div>

        <?php if($newsDetail->author): ?>
        <div class="article-author-box">
            <div class="article-author-left">
                <img src="<?php echo e($newsDetail->author->image ? asset('assets/images/authors/' . $newsDetail->author->image) : asset('assets/image/author.webp')); ?>"
                     class="article-author-img" alt="<?php echo e($newsDetail->author->name); ?>">
                <div>
                    <div class="article-author-name">
                        By <strong>
                            <a href="<?php echo e(route('author.show', $newsDetail->author->slug)); ?>" title="<?php echo e($newsDetail->author->name); ?>">
                                <?php echo e($newsDetail->author->name); ?>

                            </a>
                        </strong>
                        <span class="author-verified">✔</span>
                    </div>
                    <div class="article-author-role"><?php echo e($newsDetail->author->designation ?? 'Staff Writer'); ?></div>
                    <?php if($newsDetail->author->bio): ?>
                    <p style="margin-top:8px;font-size:0.9rem;color:#555;"><?php echo e(Str::limit($newsDetail->author->bio, 200)); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="article-author-follow">
                <a href="<?php echo e(route('author.show', $newsDetail->author->slug)); ?>" class="btn-subscribe" style="text-decoration:none;">View All Posts</a>
            </div>
        </div>
        <?php endif; ?>

    </div>
</section>


<!-- ============================
     RELATED ARTICLES
     ============================ -->
<?php if($recommended->count()): ?>
<section class="category-section">
    <div class="section-header">
        <h2>You May Also Like</h2>
    </div>
    <div class="category-grid">
        <?php $__currentLoopData = $recommended; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <article class="post-card">
            <a href="<?php echo e(route('news.show', [$item->category->slug, $item->encode_title])); ?>" title="<?php echo e($item->news_title); ?>">
                <img src="<?php echo e(asset('assets/images/uploads/' . $item->photo)); ?>" alt="<?php echo e($item->news_title); ?>">
            </a>
            <div class="post-content">
                <span class="post-tag"><?php echo e(strtoupper($item->category->category_name)); ?></span>
                <h3><a href="<?php echo e(route('news.show', [$item->category->slug, $item->encode_title])); ?>" title="<?php echo e($item->news_title); ?>"><?php echo e($item->news_title); ?></a></h3>
                <p class="post-date"><?php echo e(\Carbon\Carbon::parse($item->published_at ?? $item->news_date)->format('F j, Y')); ?></p>
            </div>
        </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Muhammad Ramshad\Downloads\illuminated_news\resources\views/newsDetail.blade.php ENDPATH**/ ?>
<?php use Illuminate\Support\Str; ?>

<?php $__env->startSection('title', 'Illuminated — Art & Discoveries'); ?>
<?php $__env->startSection('description', 'Illuminated Magazine covers art, history, science, discoveries and cultural stories updated daily.'); ?>

<?php $__env->startSection('content'); ?>

<!-- ============================
     1st SECTION — FEATURE AREA
     ============================ -->
<section class="feature-area">
    <div class="feature-wrap">

        <!-- Left Column -->
        <div class="fa-left">

            <?php if($featureLeft): ?>
            <div class="fa-card">
                <a href="<?php echo e(route('news.show', [$featureLeft->category->slug, $featureLeft->encode_title])); ?>" title="<?php echo e($featureLeft->news_title); ?>">
                    <img src="<?php echo e(url('https://financial-journal.xyz/newspaper/cms/public/uploads/' . $featureLeft->photo)); ?>" alt="<?php echo e($featureLeft->news_title); ?>">
                </a>
                <span class="fa-tag"><?php echo e(strtoupper($featureLeft->category->category_name)); ?></span>
                <h4>
                    <a href="<?php echo e(route('news.show', [$featureLeft->category->slug, $featureLeft->encode_title])); ?>" title="<?php echo e($featureLeft->news_title); ?>">
                        <?php echo e($featureLeft->news_title); ?>

                    </a>
                </h4>
                <p class="fa-date"><?php echo e(\Carbon\Carbon::parse($featureLeft->published_at ?? $featureLeft->news_date)->format('F j, Y')); ?></p>
            </div>
            <?php endif; ?>

            <?php $__currentLoopData = $featureLeftList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="fa-divider"></div>
            <div class="fa-list">
                <h5>
                    <a href="<?php echo e(route('news.show', [$item->category->slug, $item->encode_title])); ?>" title="<?php echo e($item->news_title); ?>">
                        <?php echo e($item->news_title); ?>

                    </a>
                </h5>
                <p class="fa-date"><?php echo e(\Carbon\Carbon::parse($item->published_at ?? $item->news_date)->format('F j, Y')); ?></p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

        <!-- Center Column — Hero -->
        <div class="fa-center">
            <?php if($featureMain): ?>
            <div class="fa-main">
                <a href="<?php echo e(route('news.show', [$featureMain->category->slug, $featureMain->encode_title])); ?>" title="<?php echo e($featureMain->news_title); ?>">
                    <img src="<?php echo e(url('https://financial-journal.xyz/newspaper/cms/public/uploads/' . $featureMain->photo)); ?>" alt="<?php echo e($featureMain->news_title); ?>">
                </a>
                <div class="fa-main-text">
                    <span class="fa-tag"><?php echo e(strtoupper($featureMain->category->category_name)); ?></span>
                    <h2>
                        <a href="<?php echo e(route('news.show', [$featureMain->category->slug, $featureMain->encode_title])); ?>" title="<?php echo e($featureMain->news_title); ?>">
                            <?php echo e($featureMain->news_title); ?>

                        </a>
                    </h2>
                    <p><?php echo e(Str::limit(strip_tags($featureMain->news_content_short), 150)); ?></p>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Right Column — Ad + Follow -->
        <div class="fa-right">
            <div class="fa-ad">
                <p class="fa-ad-title">- Advertisement -</p>
                <img src="<?php echo e(asset('assets/image/img.webp')); ?>" alt="Advertisement">
            </div>
            <div class="fa-divider"></div>
            <div class="fa-follow">
                <h4>Tap In! Follow Us Now for Fresh Daily Content</h4>
                <div class="fa-icons">
                    <a href="#"><img src="<?php echo e(asset('assets/image/insta.webp')); ?>" alt="Instagram"></a>
                    <a href="#"><img src="<?php echo e(asset('assets/image/insta.webp')); ?>" alt="Facebook"></a>
                    <a href="#"><img src="<?php echo e(asset('assets/image/insta.webp')); ?>" alt="Twitter"></a>
                    <a href="#"><img src="<?php echo e(asset('assets/image/insta.webp')); ?>" alt="YouTube"></a>
                    <a href="#"><img src="<?php echo e(asset('assets/image/insta.webp')); ?>" alt="RSS"></a>
                    <a href="#"><img src="<?php echo e(asset('assets/image/insta.webp')); ?>" alt="Patreon"></a>
                </div>
            </div>
        </div>

    </div>
</section>


<!-- ============================
     2nd SECTION — LATEST FEATURED
     ============================ -->
<section class="lf-section">
    <div class="lf-wrapper">

        <!-- Left Sidebar -->
        <div class="lf-sidebar">
            <h3 class="lf-side-title">Your Trusted Source for Accurate and Timely Updates!</h3>

            <?php $__currentLoopData = $sidebarCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="lf-side-item">
                <a href="<?php echo e(route('category.show', $cat->slug)); ?>">
                    <img src="<?php echo e($cat->category_banner ? asset('assets/images/categories/' . $cat->category_banner) : asset('assets/image/img.webp')); ?>" alt="<?php echo e($cat->category_name); ?>">
                </a>
                <span><?php echo e(strtoupper($cat->category_name)); ?></span>
                <p><a href="<?php echo e(route('category.show', $cat->slug)); ?>">Discover More →</a></p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- Right Content -->
        <div class="lf-content">
            <div class="lf-head">
                <h2 class="lf-title">Latest Featured</h2>
            </div>

            <div class="lf-grid">
                <?php $__currentLoopData = $latestFeatured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="lf-card">
                    <a href="<?php echo e(route('news.show', [$item->category->slug, $item->encode_title])); ?>" title="<?php echo e($item->news_title); ?>">
                        <img src="<?php echo e(url('https://financial-journal.xyz/newspaper/cms/public/uploads/' . $item->photo)); ?>" alt="<?php echo e($item->news_title); ?>">
                    </a>
                    <div class="lf-body">
                        <span class="lf-cat"><?php echo e(strtoupper($item->category->category_name)); ?></span>
                        <h3>
                            <a href="<?php echo e(route('news.show', [$item->category->slug, $item->encode_title])); ?>" title="<?php echo e($item->news_title); ?>">
                                <?php echo e($item->news_title); ?>

                            </a>
                        </h3>
                        <p class="lf-date"><?php echo e(\Carbon\Carbon::parse($item->published_at ?? $item->news_date)->format('F j, Y')); ?></p>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

    </div>
</section>


<!-- ============================
     3rd SECTION — AD BANNER
     ============================ -->
<section class="ad-banner-section">
    <div class="ad-banner-wrap">
        <a href="#"><img src="<?php echo e(asset('assets/image/ad.webp')); ?>" alt="Advertisement"></a>
    </div>
</section>


<!-- ============================
     4th SECTION — PHOTO OF THE DAY
     ============================ -->
<?php if($photoOfDay->count()): ?>
<section class="pd-section">
    <div class="pd-container">
        <div class="pd-header">
            <h2>Photo of The Day</h2>
        </div>
        <div class="pd-grid">
            <!-- Column 1 -->
            <div class="pd-col">
                <?php if($photoOfDay->get(0)): ?>
                <a href="<?php echo e(route('news.show', [$photoOfDay->get(0)->category->slug, $photoOfDay->get(0)->encode_title])); ?>" title="<?php echo e($photoOfDay->get(0)->news_title); ?>">
                    <img src="<?php echo e(url('https://financial-journal.xyz/newspaper/cms/public/uploads/' . $photoOfDay->get(0)->photo)); ?>" class="pd-img-tall-full" alt="<?php echo e($photoOfDay->get(0)->news_title); ?>">
                </a>
                <?php endif; ?>
            </div>
            <!-- Column 2 -->
            <div class="pd-col">
                <?php if($photoOfDay->get(1)): ?>
                <a href="<?php echo e(route('news.show', [$photoOfDay->get(1)->category->slug, $photoOfDay->get(1)->encode_title])); ?>" title="<?php echo e($photoOfDay->get(1)->news_title); ?>">
                    <img src="<?php echo e(url('https://financial-journal.xyz/newspaper/cms/public/uploads/' . $photoOfDay->get(1)->photo)); ?>" class="pd-img-large" alt="<?php echo e($photoOfDay->get(1)->news_title); ?>">
                </a>
                <?php endif; ?>
                <?php if($photoOfDay->get(2)): ?>
                <a href="<?php echo e(route('news.show', [$photoOfDay->get(2)->category->slug, $photoOfDay->get(2)->encode_title])); ?>" title="<?php echo e($photoOfDay->get(2)->news_title); ?>">
                    <img src="<?php echo e(url('https://financial-journal.xyz/newspaper/cms/public/uploads/' . $photoOfDay->get(2)->photo)); ?>" class="pd-img-medium" alt="<?php echo e($photoOfDay->get(2)->news_title); ?>">
                </a>
                <?php endif; ?>
            </div>
            <!-- Column 3 -->
            <div class="pd-col">
                <?php if($photoOfDay->get(3)): ?>
                <a href="<?php echo e(route('news.show', [$photoOfDay->get(3)->category->slug, $photoOfDay->get(3)->encode_title])); ?>" title="<?php echo e($photoOfDay->get(3)->news_title); ?>">
                    <img src="<?php echo e(url('https://financial-journal.xyz/newspaper/cms/public/uploads/' . $photoOfDay->get(3)->photo)); ?>" class="pd-img-small" alt="<?php echo e($photoOfDay->get(3)->news_title); ?>">
                </a>
                <?php endif; ?>
                <?php if($photoOfDay->get(4)): ?>
                <a href="<?php echo e(route('news.show', [$photoOfDay->get(4)->category->slug, $photoOfDay->get(4)->encode_title])); ?>" title="<?php echo e($photoOfDay->get(4)->news_title); ?>">
                    <img src="<?php echo e(url('https://financial-journal.xyz/newspaper/cms/public/uploads/' . $photoOfDay->get(4)->photo)); ?>" class="pd-img-tall" alt="<?php echo e($photoOfDay->get(4)->news_title); ?>">
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- ============================
     5th SECTION — HISTORY (primary category)
     ============================ -->
<?php if($historySectionNews->count()): ?>
<section class="history-block">
    <div class="history-wrap">
        <div class="history-head">
            <h2 class="history-title"><?php echo e($historyCategoryName); ?></h2>
            <?php if($historyCategory): ?>
            <a href="<?php echo e(route('category.show', $historyCategory->slug)); ?>" class="more-link">More Posts</a>
            <?php endif; ?>
        </div>

        <div class="history-top">
            <?php if($historySectionNews->get(0)): ?>
            <?php $h0 = $historySectionNews->get(0); ?>
            <div class="hs-large">
                <a href="<?php echo e(route('news.show', [$h0->category->slug, $h0->encode_title])); ?>" title="<?php echo e($h0->news_title); ?>">
                    <img src="<?php echo e(url('https://financial-journal.xyz/newspaper/cms/public/uploads/' . $h0->photo)); ?>" alt="<?php echo e($h0->news_title); ?>">
                </a>
                <div class="hs-overlay">
                    <span class="hs-tag"><?php echo e(strtoupper($h0->category->category_name)); ?></span>
                    <h3><a href="<?php echo e(route('news.show', [$h0->category->slug, $h0->encode_title])); ?>" title="<?php echo e($h0->news_title); ?>"><?php echo e($h0->news_title); ?></a></h3>
                    <p class="hs-date"><?php echo e(\Carbon\Carbon::parse($h0->published_at ?? $h0->news_date)->format('F j, Y')); ?></p>
                </div>
            </div>
            <?php endif; ?>

            <?php if($historySectionNews->get(1)): ?>
            <?php $h1 = $historySectionNews->get(1); ?>
            <div class="hs-right">
                <a href="<?php echo e(route('news.show', [$h1->category->slug, $h1->encode_title])); ?>" title="<?php echo e($h1->news_title); ?>">
                    <img src="<?php echo e(url('https://financial-journal.xyz/newspaper/cms/public/uploads/' . $h1->photo)); ?>" alt="<?php echo e($h1->news_title); ?>">
                </a>
                <span class="hs-tag"><?php echo e(strtoupper($h1->category->category_name)); ?></span>
                <h4><a href="<?php echo e(route('news.show', [$h1->category->slug, $h1->encode_title])); ?>" title="<?php echo e($h1->news_title); ?>"><?php echo e($h1->news_title); ?></a></h4>
                <p class="hs-date"><?php echo e(\Carbon\Carbon::parse($h1->published_at ?? $h1->news_date)->format('F j, Y')); ?></p>
            </div>
            <?php endif; ?>
        </div>

        <div class="history-bottom">
            <?php $__currentLoopData = $historySectionNews->slice(2, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
    </div>
</section>
<?php endif; ?>


<!-- ============================
     6th SECTION — ART COLLECTION (second category)
     ============================ -->
<?php if($artSectionNews->count()): ?>
<section class="ac-section">
    <div class="ac-container">
        <div class="ac-header">
            <h2><?php echo e($artCategoryName); ?></h2>
            <?php if($artCategory): ?>
            <a href="<?php echo e(route('category.show', $artCategory->slug)); ?>" class="more-link">More Posts</a>
            <?php endif; ?>
        </div>
        <div class="ac-grid">

            <!-- Column 1 -->
            <div class="ac-column">
                <?php if($artSectionNews->get(0)): ?>
                <?php $a0 = $artSectionNews->get(0); ?>
                <div class="ac-card">
                    <a href="<?php echo e(route('news.show', [$a0->category->slug, $a0->encode_title])); ?>" title="<?php echo e($a0->news_title); ?>">
                        <img src="<?php echo e(url('https://financial-journal.xyz/newspaper/cms/public/uploads/' . $a0->photo)); ?>" class="ac-img-tall" alt="<?php echo e($a0->news_title); ?>">
                    </a>
                    <div class="ac-text">
                        <h3><a href="<?php echo e(route('news.show', [$a0->category->slug, $a0->encode_title])); ?>"><?php echo e($a0->news_title); ?></a></h3>
                        <p><?php echo e(Str::limit(strip_tags($a0->news_content_short), 90)); ?></p>
                    </div>
                </div>
                <?php endif; ?>
                <?php if($artSectionNews->get(1)): ?>
                <?php $a1 = $artSectionNews->get(1); ?>
                <div class="ac-card">
                    <a href="<?php echo e(route('news.show', [$a1->category->slug, $a1->encode_title])); ?>" title="<?php echo e($a1->news_title); ?>">
                        <img src="<?php echo e(url('https://financial-journal.xyz/newspaper/cms/public/uploads/' . $a1->photo)); ?>" class="ac-img-short" alt="<?php echo e($a1->news_title); ?>">
                    </a>
                    <div class="ac-text">
                        <h3><a href="<?php echo e(route('news.show', [$a1->category->slug, $a1->encode_title])); ?>"><?php echo e($a1->news_title); ?></a></h3>
                        <p><?php echo e(Str::limit(strip_tags($a1->news_content_short), 80)); ?></p>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Column 2 -->
            <div class="ac-column">
                <?php if($artSectionNews->get(2)): ?>
                <?php $a2 = $artSectionNews->get(2); ?>
                <div class="ac-card">
                    <a href="<?php echo e(route('news.show', [$a2->category->slug, $a2->encode_title])); ?>" title="<?php echo e($a2->news_title); ?>">
                        <img src="<?php echo e(url('https://financial-journal.xyz/newspaper/cms/public/uploads/' . $a2->photo)); ?>" class="ac-img-short" alt="<?php echo e($a2->news_title); ?>">
                    </a>
                    <div class="ac-text">
                        <h3><a href="<?php echo e(route('news.show', [$a2->category->slug, $a2->encode_title])); ?>"><?php echo e($a2->news_title); ?></a></h3>
                        <p><?php echo e(Str::limit(strip_tags($a2->news_content_short), 80)); ?></p>
                    </div>
                </div>
                <?php endif; ?>
                <?php if($artSectionNews->get(3)): ?>
                <?php $a3 = $artSectionNews->get(3); ?>
                <div class="ac-card">
                    <a href="<?php echo e(route('news.show', [$a3->category->slug, $a3->encode_title])); ?>" title="<?php echo e($a3->news_title); ?>">
                        <img src="<?php echo e(url('https://financial-journal.xyz/newspaper/cms/public/uploads/' . $a3->photo)); ?>" class="ac-img-tall" alt="<?php echo e($a3->news_title); ?>">
                    </a>
                    <div class="ac-text">
                        <h3><a href="<?php echo e(route('news.show', [$a3->category->slug, $a3->encode_title])); ?>"><?php echo e($a3->news_title); ?></a></h3>
                        <p><?php echo e(Str::limit(strip_tags($a3->news_content_short), 90)); ?></p>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Column 3 — image only -->
            <div class="ac-column">
                <?php if($artSectionNews->get(4)): ?>
                <?php $a4 = $artSectionNews->get(4); ?>
                <div class="ac-card ac-image-only">
                    <a href="<?php echo e(route('news.show', [$a4->category->slug, $a4->encode_title])); ?>" title="<?php echo e($a4->news_title); ?>">
                        <img src="<?php echo e(url('https://financial-journal.xyz/newspaper/cms/public/uploads/' . $a4->photo)); ?>" class="ac-img-large" alt="<?php echo e($a4->news_title); ?>">
                    </a>
                </div>
                <?php endif; ?>
                <?php if($artSectionNews->get(5)): ?>
                <?php $a5 = $artSectionNews->get(5); ?>
                <div class="ac-card ac-image-only">
                    <a href="<?php echo e(route('news.show', [$a5->category->slug, $a5->encode_title])); ?>" title="<?php echo e($a5->news_title); ?>">
                        <img src="<?php echo e(url('https://financial-journal.xyz/newspaper/cms/public/uploads/' . $a5->photo)); ?>" class="ac-img-medium" alt="<?php echo e($a5->news_title); ?>">
                    </a>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
<?php endif; ?>


<!-- ============================
     7th SECTION — DISCOVERIES
     ============================ -->
<?php if($discoveriesNews->count()): ?>
<section class="discover-block">
    <div class="discover-inner">
        <div class="discover-head">
            <h2 class="discover-title"><?php echo e($discoveriesCategoryName); ?></h2>
            <?php if($discoveriesCategory): ?>
            <a href="<?php echo e(route('category.show', $discoveriesCategory->slug)); ?>" class="more-link">More Posts</a>
            <?php endif; ?>
        </div>
        <div class="discover-grid">

            <?php if($discoveriesNews->get(0)): ?>
            <?php $d0 = $discoveriesNews->get(0); ?>
            <div class="dc-left">
                <a href="<?php echo e(route('news.show', [$d0->category->slug, $d0->encode_title])); ?>" title="<?php echo e($d0->news_title); ?>">
                    <img src="<?php echo e(url('https://financial-journal.xyz/newspaper/cms/public/uploads/' . $d0->photo)); ?>" alt="<?php echo e($d0->news_title); ?>">
                </a>
                <span class="dc-label"><?php echo e(strtoupper($d0->category->category_name)); ?></span>
                <h3 class="dc-big-title">
                    <a href="<?php echo e(route('news.show', [$d0->category->slug, $d0->encode_title])); ?>" title="<?php echo e($d0->news_title); ?>"><?php echo e($d0->news_title); ?></a>
                </h3>
                <p class="dc-date"><?php echo e(\Carbon\Carbon::parse($d0->published_at ?? $d0->news_date)->format('F j, Y')); ?></p>
            </div>
            <?php endif; ?>

            <?php if($discoveriesNews->get(1)): ?>
            <?php $d1 = $discoveriesNews->get(1); ?>
            <div class="dc-middle">
                <a href="<?php echo e(route('news.show', [$d1->category->slug, $d1->encode_title])); ?>" title="<?php echo e($d1->news_title); ?>">
                    <img src="<?php echo e(url('https://financial-journal.xyz/newspaper/cms/public/uploads/' . $d1->photo)); ?>" alt="<?php echo e($d1->news_title); ?>">
                </a>
                <div class="dc-overlay">
                    <span class="dc-label"><?php echo e(strtoupper($d1->category->category_name)); ?></span>
                    <h3><a href="<?php echo e(route('news.show', [$d1->category->slug, $d1->encode_title])); ?>" title="<?php echo e($d1->news_title); ?>"><?php echo e($d1->news_title); ?></a></h3>
                    <p class="dc-date"><?php echo e(\Carbon\Carbon::parse($d1->published_at ?? $d1->news_date)->format('F j, Y')); ?></p>
                </div>
            </div>
            <?php endif; ?>

            <div class="dc-right">
                <div class="dc-adbox">
                    <p class="dc-ad-text">- Advertisement -</p>
                    <img src="<?php echo e(asset('assets/image/img2.webp')); ?>" alt="Ad">
                </div>
                <?php $__currentLoopData = $discoveriesNews->slice(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="dc-list">
                    <h4><a href="<?php echo e(route('news.show', [$item->category->slug, $item->encode_title])); ?>" title="<?php echo e($item->news_title); ?>"><?php echo e($item->news_title); ?></a></h4>
                    <p class="dc-date"><?php echo e(\Carbon\Carbon::parse($item->published_at ?? $item->news_date)->format('F j, Y')); ?></p>
                </div>
                <?php if(!$loop->last): ?><div class="dc-line"></div><?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

        </div>
    </div>
</section>
<?php endif; ?>


<!-- ============================
     8th SECTION — TRAVEL CATEGORY CARDS
     ============================ -->
<?php if($travelNews->count()): ?>
<section class="category-section">
    <div class="section-header">
        <h2><?php echo e($travelCategoryName); ?></h2>
        <?php if($travelCategory): ?>
        <a href="<?php echo e(route('category.show', $travelCategory->slug)); ?>" class="more-link">More Posts</a>
        <?php endif; ?>
    </div>
    <div class="category-grid">
        <?php $__currentLoopData = $travelNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <article class="post-card">
            <a href="<?php echo e(route('news.show', [$item->category->slug, $item->encode_title])); ?>" title="<?php echo e($item->news_title); ?>">
                <img src="<?php echo e(url('https://financial-journal.xyz/newspaper/cms/public/uploads/' . $item->photo)); ?>" alt="<?php echo e($item->news_title); ?>">
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


<!-- ============================
     9th SECTION — AD BANNER
     ============================ -->
<section class="ad-banner-section">
    <div class="ad-banner-wrap">
        <img src="<?php echo e(asset('assets/image/ad.webp')); ?>" alt="Advertisement">
    </div>
</section>


<!-- ============================
     10th SECTION — MORE STORIES + SIDEBAR
     ============================ -->
<section class="ms-section">
    <div class="ms-wrapper">

        <!-- Left: More Stories -->
        <div class="ms-content">
            <div class="ms-head">
                <h2 class="ms-title">More Stories</h2>
            </div>

            <?php $__currentLoopData = $moreStories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                    <p class="ms-date"><?php echo e(\Carbon\Carbon::parse($item->published_at ?? $item->news_date)->format('F j, Y')); ?></p>
                </div>
                <?php else: ?>
                <div class="ms-text">
                    <span class="ms-cat"><?php echo e(strtoupper($item->category->category_name)); ?></span>
                    <h3><a href="<?php echo e(route('news.show', [$item->category->slug, $item->encode_title])); ?>" title="<?php echo e($item->news_title); ?>"><?php echo e($item->news_title); ?></a></h3>
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
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- Right: Sidebar -->
        <div class="ms-sidebar">
            <h3 class="ms-follow-title">Tap In! Follow Us Now for Fresh Daily Content</h3>
            <div class="ms-social-grid">
                <div class="ms-social"><img src="<?php echo e(asset('assets/image/insta.webp')); ?>" alt=""><span>Facebook</span></div>
                <div class="ms-social"><img src="<?php echo e(asset('assets/image/insta.webp')); ?>" alt=""><span>X</span></div>
                <div class="ms-social"><img src="<?php echo e(asset('assets/image/insta.webp')); ?>" alt=""><span>YouTube</span></div>
                <div class="ms-social"><img src="<?php echo e(asset('assets/image/insta.webp')); ?>" alt=""><span>PayPal</span></div>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Muhammad Ramshad\Downloads\illuminated_news\resources\views/index.blade.php ENDPATH**/ ?>
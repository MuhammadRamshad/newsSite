<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title><?php echo $__env->yieldContent('title', 'Illuminated Magazine — Art, History, Science & Discoveries'); ?></title>
<meta name="description" content="<?php echo $__env->yieldContent('description', 'Illuminated Magazine covers art, history, science, discoveries and cultural stories updated daily.'); ?>">
<meta name="keywords" content="<?php echo $__env->yieldContent('keywords', 'art, history, science, discoveries, travel, mysteries, culture, illuminated magazine'); ?>">
<meta name="robots" content="<?php echo $__env->yieldContent('robots', 'index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1'); ?>">
<link rel="canonical" href="<?php echo $__env->yieldContent('canonical', url()->current()); ?>">


<?php if(View::hasSection('article_author')): ?>
<meta name="author" content="<?php echo $__env->yieldContent('article_author'); ?>">
<?php endif; ?>



<meta property="og:type" content="<?php echo e(View::hasSection('published_time') ? 'article' : 'website'); ?>">
<meta property="og:site_name" content="<?php echo e(config('app.name', 'Illuminated Magazine')); ?>">
<meta property="og:locale" content="en_US">
<meta property="og:url" content="<?php echo $__env->yieldContent('canonical', url()->current()); ?>">
<meta property="og:title" content="<?php echo $__env->yieldContent('title', config('app.name')); ?>">
<meta property="og:description" content="<?php echo $__env->yieldContent('description', 'Illuminated Magazine covers art, history, science and cultural discoveries.'); ?>">
<meta property="og:image" content="<?php echo $__env->yieldContent('og_image', asset('assets/images/foxiz.webp')); ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="<?php echo $__env->yieldContent('title', config('app.name')); ?>">
<?php if(View::hasSection('published_time')): ?>
<meta property="article:published_time" content="<?php echo $__env->yieldContent('published_time'); ?>">
<meta property="article:modified_time" content="<?php echo $__env->yieldContent('modified_time', now()->toIso8601String()); ?>">
<meta property="article:section" content="<?php echo $__env->yieldContent('article_section', ''); ?>">
<?php endif; ?>


<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@illuminatedmag">
<meta name="twitter:creator" content="<?php echo $__env->yieldContent('twitter_creator', '@@illuminatedmag'); ?>">
<meta name="twitter:title" content="<?php echo $__env->yieldContent('title', config('app.name')); ?>">
<meta name="twitter:description" content="<?php echo $__env->yieldContent('description'); ?>">
<meta name="twitter:image" content="<?php echo $__env->yieldContent('og_image', asset('assets/images/foxiz.webp')); ?>">
<meta name="twitter:image:alt" content="<?php echo $__env->yieldContent('title', config('app.name')); ?>">


<?php echo $__env->yieldContent('schema'); ?>


<?php
$siteSchema = [
    "@context" => "https://schema.org",
    "@type"    => "WebSite",
    "name"     => config('app.name', 'Illuminated Magazine'),
    "url"      => url('/'),
    "description" => "Illuminated Magazine covers art, history, science, discoveries and cultural stories.",
    "potentialAction" => [
        "@type"       => "SearchAction",
        "target"      => ["@type" => "EntryPoint", "urlTemplate" => url('/search') . '?q={search_term_string}'],
        "query-input" => "required name=search_term_string"
    ]
];
$orgSchema = [
    "@context" => "https://schema.org",
    "@type"    => "Organization",
    "name"     => config('app.name', 'Illuminated Magazine'),
    "url"      => url('/'),
    "logo"     => [
        "@type" => "ImageObject",
        "url"   => asset('assets/images/logo.webp'),
    ],
    "sameAs"   => []
];
?>
<script type="application/ld+json"><?php echo json_encode($siteSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE); ?></script>
<script type="application/ld+json"><?php echo json_encode($orgSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE); ?></script>


<link rel="icon" href="<?php echo e(asset('favicon.ico')); ?>" type="image/x-icon">
<link rel="shortcut icon" href="<?php echo e(asset('favicon.ico')); ?>" type="image/x-icon">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('assets/images/apple-touch-icon.png')); ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('assets/images/favicon-32x32.png')); ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('assets/images/favicon-16x16.png')); ?>">
<meta name="theme-color" content="#ffffff">


<link rel="dns-prefetch" href="//fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>


<link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
</head>
<body>
<?php echo $__env->make('partials.top-bar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('partials.logo-bar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<main id="main-content" role="main">
    <?php echo $__env->yieldContent('content'); ?>
</main>
<?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<script src="<?php echo e(asset('assets/js/script.js')); ?>"></script>
</body>
</html>
<?php /**PATH /home/myapiusa/public_html/ramshad/new/resources/views/layouts/app.blade.php ENDPATH**/ ?>
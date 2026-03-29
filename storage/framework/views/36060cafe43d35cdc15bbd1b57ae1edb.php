<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $__env->yieldContent('title', 'Illuminated — Art & Discoveries'); ?></title>
<link rel="icon" href="<?php echo e(asset('favicon.ico')); ?>" type="image/x-icon">
<meta name="description" content="<?php echo $__env->yieldContent('description', 'Illuminated Magazine covers art, history, science and cultural discoveries.'); ?>">
<meta name="keywords" content="<?php echo $__env->yieldContent('keywords', 'art, history, science, discoveries, travel, mysteries'); ?>">
<meta name="robots" content="<?php echo $__env->yieldContent('robots', 'index,follow,max-image-preview:large'); ?>">
<link rel="canonical" href="<?php echo $__env->yieldContent('canonical', url()->current()); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/css/illuminated.css')); ?>">
<meta property="og:type" content="<?php if (! empty(trim($__env->yieldContent('published_time')))): ?> article <?php else: ?> website <?php endif; ?>">
<meta property="og:site_name" content="<?php echo e(config('app.name')); ?>">
<meta property="og:url" content="<?php echo $__env->yieldContent('canonical', url()->current()); ?>">
<meta property="og:title" content="<?php echo $__env->yieldContent('title', config('app.name')); ?>">
<meta property="og:description" content="<?php echo $__env->yieldContent('description'); ?>">
<meta property="og:image" content="<?php echo $__env->yieldContent('image', asset('assets/image/img.webp')); ?>">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo $__env->yieldContent('title'); ?>">
<meta name="twitter:description" content="<?php echo $__env->yieldContent('description'); ?>">
<meta name="twitter:image" content="<?php echo $__env->yieldContent('image', asset('assets/image/img.webp')); ?>">
<?php echo $__env->yieldContent('schema'); ?>
<?php
$siteSchema = [
    "@context" => "https://schema.org",
    "@type" => "WebSite",
    "name" => config('app.name'),
    "url" => url('/'),
    "potentialAction" => [
        "@type" => "SearchAction",
        "target" => url('/search') . '?q={search_term_string}',
        "query-input" => "required name=search_term_string"
    ]
];
?>
<script type="application/ld+json">
<?php echo json_encode($siteSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT); ?>

</script>
</head>
<body>
<?php echo $__env->make('partials.top-bar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('partials.logo-bar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<main>
    <?php echo $__env->yieldContent('content'); ?>
</main>
<?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<script src="<?php echo e(asset('assets/js/illuminated.js')); ?>"></script>
</body>
</html>
<?php /**PATH C:\Users\Muhammad Ramshad\Downloads\illuminated_news\resources\views/layouts/app.blade.php ENDPATH**/ ?>
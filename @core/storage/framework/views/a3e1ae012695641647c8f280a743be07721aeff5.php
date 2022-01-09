<!DOCTYPE html>
<html lang="<?php echo e(get_user_lang()); ?>" dir="<?php echo e(get_user_lang_direction()); ?>">

<head>
   <?php if(!empty(get_static_option('site_google_analytics'))): ?>
        <?php echo get_static_option('site_google_analytics'); ?>

    <?php endif; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php echo render_favicon_by_id(get_static_option('site_favicon')); ?>

    <?php echo load_google_fonts(); ?>


   <!-- favicon -->
       <link rel=icon href=favicon.ico sizes="20x20" type="image/png">
       <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/animate.css')); ?>">
       <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/bootstrap.min.css')); ?>">
       <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/magnific-popup.css')); ?>">
       <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/slick.css')); ?>">
       <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/line-awesome.min.css')); ?>">
       <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/font-awesome.min.css')); ?>">
       <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/style.css')); ?>">
       <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/responsive.css')); ?>">
       <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/helpers.css')); ?>">

    
    <?php if(get_static_option('site_frontend_dark_mode') === 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/dark.css')); ?>">
    <?php endif; ?>
       <?php if(!empty(get_static_option('site_rtl_enabled')) || get_user_lang_direction() === 'rtl'): ?>
           <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/rtl.css')); ?>">
       <?php endif; ?>

    <link rel="canonical" href="<?php echo e(request()->url()); ?>" />
    <script src="<?php echo e(asset('assets/common/js/jquery-3.6.0.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/common/js/jquery-migrate-3.3.2.min.js')); ?>"></script>

    
       <?php if(get_static_option('google_adsense_publisher_id')): ?>
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=<?php echo e(get_static_option('google_adsense_publisher_id')); ?>" crossorigin="anonymous"></script>
       <?php endif; ?>


    <?php echo $__env->make('frontend.partials.root-style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('style'); ?>


    <?php if(request()->routeIs('homepage')): ?>
        <title><?php echo e(get_static_option('site_'.$user_select_lang_slug.'_title')); ?> - <?php echo e(get_static_option('site_'.$user_select_lang_slug.'_tag_line')); ?></title>

           <?php echo render_site_meta(); ?>


     <?php elseif( request()->routeIs('frontend.dynamic.page')): ?>
           <?php echo render_site_title($page_post->title); ?>

           <?php echo render_site_meta(); ?>


    <?php else: ?>
        <?php echo $__env->yieldContent('page-meta-data'); ?>
    <?php endif; ?>


</head>

<body class="black-theme">

<?php echo $__env->make('frontend.partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php /**PATH D:\laragon\www\intoday-last\@core\resources\views/frontend/partials/header.blade.php ENDPATH**/ ?>
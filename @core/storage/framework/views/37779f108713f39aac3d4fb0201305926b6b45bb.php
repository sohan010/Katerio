<!DOCTYPE html>
<html lang="<?php echo e(get_default_language()); ?>" dir="<?php echo e(get_user_lang_direction()); ?>">
<head>
<?php if(!empty(get_static_option('site_google_analytics'))): ?>
        <script async
                src="https://www.googletagmanager.com/gtag/js?id=<?php echo e(get_static_option('site_google_analytics')); ?>"></script>
        <script>
            (function($){
                "use strict";
                window.dataLayer = window.dataLayer || [];
                function gtag() {
                    dataLayer.push(arguments);
                }
                gtag('js', new Date());
                gtag('config', "<?php echo e(get_static_option('site_google_analytics')); ?>");
            })(jQuery);

        </script>
    <?php endif; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?php echo e(get_static_option('site_meta_description')); ?>">
    <meta name="tags" content="<?php echo e(get_static_option('site_meta_tags')); ?>">
    <?php echo render_favicon_by_id(filter_static_option_value('site_favicon',$global_static_field_data)); ?>

    <?php echo load_google_fonts(); ?>

    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/fontawesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/dynamic-style.css')); ?>">
    <style>
        :root {
            --main-color-one: <?php echo e(get_static_option('site_main_color')); ?>;
            --secondary-color: <?php echo e(get_static_option('site_secondary')); ?>;
            --heading-color: <?php echo e(get_static_option('site_heading_color')); ?>;
            --paragraph-color: <?php echo e(get_static_option('site_paragraph_color')); ?>;
            <?php $heading_font_family = !empty(get_static_option('heading_font')) ? get_static_option('heading_font_family') :  get_static_option('body_font_family') ?>
             --heading-font: "<?php echo e($heading_font_family); ?>", sans-serif;
            --body-font: "<?php echo e(get_static_option('body_font_family')); ?>", sans-serif;
        }
    </style>
    <style>
        .maintenance-page-content-area {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 0;
            background-size: cover;
            background-position: center;
        }

        .maintenance-page-content-area:after {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: -1;
            content: '';
        }

        .page-content-wrap {
            text-align: center;
        }

        .page-content-wrap .logo-wrap {
            margin-bottom: 30px;
        }

        .page-content-wrap .maintain-title {
            font-size: 45px;
            font-weight: 700;
            color: #fff;
            line-height: 50px;
            margin-bottom: 20px;
        }

        .page-content-wrap p {
            font-size: 16px;
            line-height: 28px;
            color: rgba(255, 255, 255, .7);
            font-weight: 400;
        }

        .page-content-wrap .subscriber-form {
            position: relative;
            z-index: 0;
            max-width: 500px;
            margin: 0 auto;
            margin-top: 40px;
        }

        .page-content-wrap .subscriber-form .submit-btn {
            position: absolute;
            right: 0;
            bottom: 0;
            width: 60px;
            height: 50px;
            text-align: center;
            border: none;
            background-color: var(--main-color-one);
            color: #fff;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .page-content-wrap .subscriber-form .form-group .form-control {
            height: 50px;
            padding: 0 20px;
            padding-right: 80px;
        }
    </style>
    <?php echo $__env->yieldContent('style'); ?>
    <?php if(!empty(get_static_option('site_rtl_enabled')) || get_user_lang_direction() === 'rtl'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/rtl.css')); ?>">
    <?php endif; ?>

</head>
<body>

<div class="maintenance-page-content-area"
        <?php echo render_background_image_markup_by_attachment_id(get_static_option('maintain_page_background_image')); ?>>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="maintenance-page-inner-content">
                    <div class="page-content-wrap">
                        <div class="logo-wrap">
                            <?php echo render_image_markup_by_attachment_id(get_static_option('maintain_page_logo')); ?>

                        </div>
                        <h2 class="maintain-title"><?php echo e(get_static_option('maintain_page_'.$user_select_lang_slug.'_title')); ?></h2>
                        <p><?php echo e(get_static_option('maintain_page_'.$user_select_lang_slug.'_description')); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo e(asset('assets/common/js/jquery-3.6.0.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/common/js/jquery-migrate-3.3.2.min.js')); ?>"></script>
<link rel="stylesheet" href="<?php echo e(asset('assets/frontend/js/dynamic-script.js')); ?>">
<?php echo get_static_option('tawk_api_key'); ?>


</body>

</html>
<?php /**PATH D:\laragon\www\katerio\@core\resources\views/frontend/pages/maintain.blade.php ENDPATH**/ ?>
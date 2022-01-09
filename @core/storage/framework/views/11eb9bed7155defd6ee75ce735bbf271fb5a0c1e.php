<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ozagi - Error 404</title>
    <!-- favicon -->
<?php echo render_favicon_by_id(get_static_option('site_favicon')); ?>

    <!-- bootstrap -->
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

    <style>

        :root {
            --main-color-one: <?php echo e(get_static_option('site_main_color_one')); ?>;
            --secondary-color: <?php echo e(get_static_option('site_main_color_two')); ?>;
            --heading-color: <?php echo e(get_static_option('site_heading_color')); ?>;
            --paragraph-color: <?php echo e(get_static_option('site_paragraph_color')); ?>;
        }

        .extra-css img {
            width: auto;
        }
    </style>

</head>

<body>

<div class="inner-menu-area">
    <div class="container">
        <div class="inner-menu-list">
            <ul>
                <li>
                    <a href="<?php echo e(url('/')); ?>"> <?php echo e(__('Home')); ?> </a>
                </li>
                <li>
                   <?php echo e(__(' Error 404')); ?>

                </li>
            </ul>
        </div>
    </div>
</div>


<section class="error-area padding-top-90 padding-bottom-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="error-contents">
                    <h1 class=""> <?php echo e(get_static_option('error_404_page_'.get_user_lang().'_title')); ?> </h1>
                    <h2 class="error-title"> <?php echo e(get_static_option('error_404_page_'.get_user_lang().'_subtitle')); ?> </h2>
                    <?php echo render_image_markup_by_attachment_id(get_static_option('error_image')); ?>


                    <p class="my-2"><?php echo e(get_static_option('error_404_page_'.get_user_lang().'_paragraph')); ?></p>
                    <div class="btn-wrapper btn-error">
                        <a href="<?php echo e(route('homepage')); ?>" class="btn-loadmore"> <?php echo e(get_static_option('error_404_page_'.get_user_lang().'_button_text')); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


</body>
</html><?php /**PATH D:\laragon\www\in-today\@core\resources\views/frontend/pages/404.blade.php ENDPATH**/ ?>
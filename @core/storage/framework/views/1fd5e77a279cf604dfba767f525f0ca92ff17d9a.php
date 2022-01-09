<?php
    $container = request()->is('/') || request()->is('home-page-one') || request()->is('blog-grid') || request()->routeIs('frontend.blog.single') || request()->is('blog-7')   ?  'container-two' : '';
?>

<header class="header-style-01">
<?php echo $__env->make('frontend.partials.support', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="search-area">

        <nav class="navbar navbar-area navbar-expand-lg navbar-border">
            <div class="container <?php echo e($container); ?> nav-container">
                <div class="responsive-mobile-menu">
                    <div class="logo-wrapper mobile-logo">
                        <a href="<?php echo e(url('/')); ?>" class="logo">
                            <?php if(get_static_option('site_frontend_dark_mode') == 'on'): ?>
                                <?php echo render_image_markup_by_attachment_id(get_static_option('site_white_logo')); ?>

                            <?php else: ?>
                                <?php echo render_image_markup_by_attachment_id(get_static_option('site_logo')); ?>

                            <?php endif; ?>
                        </a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizcoxx_main_menu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
                <?php if( !request()->is('home-page-one') && !request()->routeIs('homepage')): ?>
                    <div class="nav-left-content">
                        <ul>
                            <li>
                                <a href="#0">
                                    <div class="info-bar-item">
                                        <div class="sidebars-item">
                                            <i class="las la-bars"></i>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                  <?php endif; ?>
                    <ul class="navbar-nav">
                        <?php echo render_frontend_menu($primary_menu); ?>

                    </ul>
                </div>

                <div class="nav-right-content">
                    <ul>

                        <li>
                            <a href="#">
                                <div class="info-bar-item">
                                    <div class="search-open">
                                        <i class="las la-search"></i>
                                    </div>
                                    <?php if(request()->routeIs('homepage') || request()->is('home-page-one')): ?>
                                    <div class="sidebars-item">
                                        <i class="las la-bars"></i>
                                    </div>
                                     <?php endif; ?>
                                </div>
                            </a>
                        </li>


                    </ul>
                </div>
            </div>
        </nav>

        <?php echo $__env->make('frontend.partials.left-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="search-bar">
            <form class="menu-search-form" action="<?php echo e(route('frontend.blog.search')); ?>">
                <?php echo csrf_field(); ?>
                <div class="search-close"> <i class="las la-times"></i> </div>
                <input class="item-search" type="text" id="search" name="search" placeholder="Search Here.....">
                <button type="submit"> <?php echo e(__('Search Now')); ?> </button>
                <div class="ajax-preloader-wrap"></div>
            </form>
        </div>

        <a href="<?php echo e(route('frontend.blog.get.search')); ?>" data-url="<?php echo e(route('frontend.blog.get.search')); ?>"
           id="tag_view_all"><i class="las la-external-link-alt"></i> </a>
        <li class="account">
            <div id="show-autocomplete" style="display:none;">
                <ul class="autocomplete-warp"></ul>
            </div>
        </li>
    </div>
</header>













<?php /**PATH D:\laragon\www\intoday-update-final\@core\resources\views/frontend/partials/pages-portion/navbars/navbar-01.blade.php ENDPATH**/ ?>
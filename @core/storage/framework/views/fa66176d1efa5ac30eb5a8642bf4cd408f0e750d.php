<?php
    $dt = \Illuminate\Support\Carbon::now()->format('l, d M Y');;
    $container = request()->is('/') || request()->is('blog-grid') || request()->is('home-page-one') || request()->routeIs('frontend.blog.single')
    || request()->is('blog-7')  ?  'container-two' : '';
?>

<div class="topbar-area">
    <div class="container <?php echo e($container); ?>">
        <div class="row align-items-center">
            <?php if(request()->routeIs('homepage') || request()->is('home-page-one') || request()->is('blog-grid') || request()->routeIs('frontend.blog.single') || request()->is('blog-7')): ?>
                 <?php echo $__env->make('frontend.partials.pages-portion.topbar-content.home-one', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php else: ?>
                  <?php echo $__env->make('frontend.partials.pages-portion.topbar-content.other-pages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php /**PATH D:\laragon\www\katerio\@core\resources\views/frontend/partials/support.blade.php ENDPATH**/ ?>
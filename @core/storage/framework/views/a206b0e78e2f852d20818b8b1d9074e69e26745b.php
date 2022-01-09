<?php echo $__env->make('frontend.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $custom_class = request()->routeIs('frontend.blog.single') ? 'container-two' : '';
?>
<div class="breadcrumb-area
<?php if(request()->routeIs('homepage') || request()->routeIs('frontend.dynamic.page')  &&  empty($page_post->breadcrumb_status)): ?>
    d-none
<?php endif; ?>
"
>
 <div class="inner-menu-area">
    <div class="container <?php echo e($page_post->widget_style ?? ''); ?> <?php echo e($custom_class); ?> ">
        <div class="inner-menu-list">
            <ul>
                <li><a href="<?php echo e(url('/')); ?>"><?php echo e(__('Home')); ?></a></li>
                  <li><?php echo $__env->yieldContent('page-title'); ?></li>
            </ul>
        </div>

    </div>
</div>
</div>


<?php echo $__env->yieldContent('content'); ?>
<?php echo $__env->make('frontend.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php /**PATH /home/bytesed/public_html/laravel/intoday/@core/resources/views/frontend/frontend-page-master.blade.php ENDPATH**/ ?>
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

<div class=" container <?php echo e($page_post->widget_style ?? ''); ?> <?php echo e($custom_class); ?>">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <div class="content">
                          <h3 class="title"><?php echo e($page_post->title ?? ''); ?> <?php echo $__env->yieldContent('custom-page-title'); ?> </h3>







                        <ul class="page-list">
                            <li class="list-item"><a href="<?php echo e(url('/')); ?>"><?php echo e(__('Home')); ?></a></li>
                            <?php if(Route::currentRouteName() === 'frontend.dynamic.page'): ?>
                                <li class="list-item"><a href="#"><?php echo e($page_post->title); ?></a></li>
                            <?php elseif(Route::currentRouteName() === 'frontend.blog.single'): ?>
                                <?php echo e($page_post->title); ?>


                            <?php else: ?>
                                <li class="list-item"><a href="#"><?php echo $__env->yieldContent('page-title'); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php echo $__env->yieldContent('content'); ?>
<?php echo $__env->make('frontend.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php /**PATH D:\laragon\www\katerio\@core\resources\views/frontend/frontend-page-master.blade.php ENDPATH**/ ?>
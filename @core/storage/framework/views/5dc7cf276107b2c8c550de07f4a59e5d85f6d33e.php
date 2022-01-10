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
                        <h3 class="title"><?php echo e($page_post->title ?? __('No Title')); ?></h3>
                        <?php
                              $page_info = request()->url();
                              $str = explode("/",request()->url());
                              $page_info = $str[count($str)-1];
                              $slug = get_page_slug_two($page_info) ?? '';
                        ?>
                        <ul class="page-list">
                            <li class="list-item"><a href="<?php echo e(url('/')); ?>"><?php echo e(__('Home')); ?></a></li>
                            <li class="list-item"><a href="<?php echo e(route('frontend.dynamic.page',$slug->slug)); ?>"><?php echo $__env->yieldContent('page-title'); ?></a></li>
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
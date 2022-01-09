
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Blog Others Settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
   <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.css','data' => []]); ?>
<?php $component->withName('media.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
   <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/colorpicker.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
              <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.msg.success','data' => []]); ?>
<?php $component->withName('msg.success'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
              <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.msg.error','data' => []]); ?>
<?php $component->withName('msg.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__('Blog Others Settings')); ?></h4>
                        <form action="<?php echo e(route('admin.blog.others.settings')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="form-group">
                                <label for="site_loader_animation"><strong><?php echo e(__('Breaking News Show/Hide')); ?></strong></label>
                                <label class="switch yes">
                                    <input type="checkbox" name="blog_breaking_news_show_hide_all"  <?php if(!empty(get_static_option('blog_breaking_news_show_hide_all'))): ?> checked <?php endif; ?> id="blog_breaking_news_show_hide_all">
                                    <span class="slider-enable-disable"></span>
                                </label>
                            </div>

                                <div class="form-group">
                                    <label for="site_main_color_one"><?php echo e(__('Blog Category Video Icon Color')); ?></label>
                                    <input type="text" name="blog_category_video_icon_color" style="background-color: <?php echo e(get_static_option('blog_category_video_icon_color')); ?>; color: #b0b0b0" class="form-control"
                                           value="<?php echo e(get_static_option('blog_category_video_icon_color')); ?>" id="blog_category_video_icon_color">
                                </div>

                                <div class="form-group">
                                    <label for="site_main_color_one"><?php echo e(__('Blog Search Video Icon Color')); ?></label>
                                    <input type="text" name="blog_search_video_icon_color" style="background-color: <?php echo e(get_static_option('blog_search_video_icon_color')); ?>;color: #b0b0b0" class="form-control"
                                           value="<?php echo e(get_static_option('blog_search_video_icon_color')); ?>" id="blog_search_video_icon_color">
                                </div>

                                <div class="form-group">
                                    <label for="site_main_color_one"><?php echo e(__('Blog Tags Video Icon Color')); ?></label>
                                    <input type="text" name="blog_tags_video_icon_color" style="background-color: <?php echo e(get_static_option('blog_tags_video_icon_color')); ?>;color: #b0b0b0" class="form-control"
                                           value="<?php echo e(get_static_option('blog_tags_video_icon_color')); ?>" id="blog_tags_video_icon_color">
                                </div>

                            <div class="form-group">
                                <label for="site_main_color_one"><?php echo e(__('User Created Blog Video Icon Color')); ?></label>
                                <input type="text" name="user_created_blog_video_icon_color" style="background-color: <?php echo e(get_static_option('user_created_blog_video_icon_color')); ?>;color: #b0b0b0" class="form-control"
                                       value="<?php echo e(get_static_option('user_created_blog_video_icon_color')); ?>" id="user_created_blog_video_icon_color">
                            </div>


                            <div class="form-group">
                                <label for="site_main_color_one"><?php echo e(__('Single Page Blog Video Icon Color')); ?></label>
                                <input type="text" name="single_page_blog_video_icon_color" style="background-color: <?php echo e(get_static_option('single_page_blog_video_icon_color')); ?>;color: #b0b0b0" class="form-control"
                                       value="<?php echo e(get_static_option('single_page_blog_video_icon_color')); ?>" id="single_page_blog_video_icon_color">
                            </div>

                            <button id="update" type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.markup','data' => []]); ?>
<?php $component->withName('media.markup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/backend/js/colorpicker.js')); ?>"></script>
    <script>
        (function($){
            "use strict";

            $(document).ready(function(){
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.icon-picker','data' => []]); ?>
<?php $component->withName('icon-picker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.btn.update','data' => []]); ?>
<?php $component->withName('btn.update'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                initColorPicker('#blog_category_video_icon_color');
                initColorPicker('#blog_search_video_icon_color');
                initColorPicker('#blog_tags_video_icon_color');
                initColorPicker('#user_created_blog_video_icon_color');
                initColorPicker('#single_page_blog_video_icon_color');

                function initColorPicker(selector){
                    $(selector).ColorPicker({
                        color: '#852aff',
                        onShow: function (colpkr) {
                            $(colpkr).fadeIn(500);
                            return false;
                        },
                        onHide: function (colpkr) {
                            $(colpkr).fadeOut(500);
                            return false;
                        },
                        onChange: function (hsb, hex, rgb) {
                            $(selector).css('background-color', '#' + hex);
                            $(selector).val('#' + hex);
                        }
                    });
                }
            });
        }(jQuery));
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\in-today\@core\resources\views/backend/pages/blog/blog-others-settings.blade.php ENDPATH**/ ?>
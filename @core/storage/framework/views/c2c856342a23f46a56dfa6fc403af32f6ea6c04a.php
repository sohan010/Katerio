
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/colorpicker.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Color Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
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
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Color Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.general.color.settings')); ?>" method="POST" enctype="multipart/form-data"><?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="site_main_color_one"><?php echo e(__('Site Main Color One')); ?></label>
                                <input type="text" name="site_main_color_one" style="background-color: <?php echo e(get_static_option('site_main_color_one')); ?>;" class="form-control"
                                       value="<?php echo e(get_static_option('site_main_color_one')); ?>" id="site_main_color_one">
                                <small class="form-text text-muted"><?php echo e(__('you can change -site main color- from here, it will replace the website main color')); ?></small>
                            </div>

                            <div class="form-group">
                                <label for="site_main_color_two"><?php echo e(__('Site Main Color Two')); ?></label>
                                <input type="text" name="site_main_color_two" style="background-color: <?php echo e(get_static_option('site_main_color_two')); ?>;" class="form-control"
                                       value="<?php echo e(get_static_option('site_main_color_two')); ?>" id="site_main_color_two">
                                <small class="form-text text-muted"><?php echo e(__('you can change -site base color- from here, it will replace the website base color')); ?></small>
                            </div>

                            <div class="form-group">
                                <label for="site_main_color_two"><?php echo e(__('Site Heading Color')); ?></label>
                                <input type="text" name="site_heading_color" style="background-color: <?php echo e(get_static_option('site_heading_color')); ?>;" class="form-control"
                                       value="<?php echo e(get_static_option('site_heading_color')); ?>" id="site_heading_color">
                                <small class="form-text text-muted"><?php echo e(__('you can change -heading color- from here, it will replace the website base color')); ?></small>
                            </div>

                            <div class="form-group">
                                <label for="site_paragraph_color"><?php echo e(__('Site Paragraph Color')); ?></label>
                                <input type="text" name="site_paragraph_color" style="background-color: <?php echo e(get_static_option('site_paragraph_color')); ?>;" class="form-control"
                                       value="<?php echo e(get_static_option('site_paragraph_color')); ?>" id="site_paragraph_color">
                                <small class="form-text text-muted"><?php echo e(__('you can change -site paragraph color- from here, it will replace the website base color')); ?></small>
                            </div>

                            <div class="form-group">
                                <label for="site_light_color_one"><?php echo e(__('Site Light Color One')); ?></label>
                                <input type="text" name="site_light_color_one" style="background-color: <?php echo e(get_static_option('site_light_color_one')); ?>;" class="form-control"
                                       value="<?php echo e(get_static_option('site_light_color_one')); ?>" id="site_light_color_one">
                                <small class="form-text text-muted"><?php echo e(__('you can change -site light color- from here, it will replace the website base color')); ?></small>
                            </div>

                            <div class="form-group">
                                <label for="site_light_color_two"><?php echo e(__('Site Light Color Two')); ?></label>
                                <input type="text" name="site_light_color_two" style="background-color: <?php echo e(get_static_option('site_light_color_two')); ?>;" class="form-control"
                                       value="<?php echo e(get_static_option('site_light_color_two')); ?>" id="site_light_color_two">
                                <small class="form-text text-muted"><?php echo e(__('you can change - site light color two- from here, it will replace the website base color')); ?></small>
                            </div>

                            <div class="form-group">
                                <label for="site_light_color_two"><?php echo e(__('Site Black Theme')); ?></label>
                                <input type="text" name="site_black_theme" style="background-color: <?php echo e(get_static_option('site_black_theme')); ?>;" class="form-control"
                                       value="<?php echo e(get_static_option('site_black_theme')); ?>" id="site_black_theme">
                                <small class="form-text text-muted"><?php echo e(__('you can change - site black theme- from here, it will replace the website black theme color')); ?></small>
                            </div>

                            <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
                initColorPicker('#site_main_color_one');
                initColorPicker('#site_main_color_two');
                initColorPicker('#site_heading_color');
                initColorPicker('#site_paragraph_color');
                initColorPicker('#site_light_color_one');
                initColorPicker('#site_light_color_two');
                initColorPicker('#site_black_theme');

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

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/bytesed/public_html/laravel/intoday/@core/resources/views/backend/general-settings/color-settings.blade.php ENDPATH**/ ?>



<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Leftbar Settings')); ?>

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
                        <h4 class="header-title mb-4"><?php echo e(__("Leftbar Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.leftbar.settings')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="form-group">
                                <label for="site_loader_animation"><strong><?php echo e(__('Leftbar Show/Hide')); ?></strong></label>
                                <label class="switch yes">
                                    <input type="checkbox" name="leftbar_show_hide"  <?php if(!empty(get_static_option('leftbar_show_hide'))): ?> checked <?php endif; ?> id="leftbar_show_hide">
                                    <span class="slider-enable-disable"></span>
                                </label>
                            </div>

                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.lang-nav','data' => []]); ?>
<?php $component->withName('lang-nav'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="tab-pane fade <?php if($key == 0): ?> show active <?php endif; ?>" id="nav-home-<?php echo e($lang->slug); ?>" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="form-group">
                                            <label for="site_<?php echo e($lang->slug); ?>_title"><?php echo e(__('Leftbar Social Title')); ?></label>
                                            <input type="text" name="leftbar_social_<?php echo e($lang->slug); ?>_title"  class="form-control" value="<?php echo e(get_static_option('leftbar_social_'.$lang->slug.'_title')); ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="site_<?php echo e($lang->slug); ?>_title"><?php echo e(__('Leftbar Category Title')); ?></label>
                                            <input type="text" name="leftbar_category_<?php echo e($lang->slug); ?>_title"  class="form-control" value="<?php echo e(get_static_option('leftbar_category_'.$lang->slug.'_title')); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="site_<?php echo e($lang->slug); ?>_tag_line"><?php echo e(__('Leftbar Tag Title')); ?></label>
                                            <input type="text" name="leftbar_tag_<?php echo e($lang->slug); ?>_title"  class="form-control" value="<?php echo e(get_static_option('leftbar_tag_'.$lang->slug.'_title')); ?>" >
                                        </div>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <div class="form-group">
                                <label ><?php echo e(__('Social Item Show')); ?></label>
                                <input type="number" name="leftbar_social_item_show"  class="form-control" value="<?php echo e(get_static_option('leftbar_social_item_show')); ?>">
                            </div>


                            <div class="form-group">
                                <label ><?php echo e(__('Category Item Show')); ?></label>
                                <input type="number" name="leftbar_category_item_show"  class="form-control" value="<?php echo e(get_static_option('leftbar_category_item_show')); ?>">
                            </div>

                            <div class="form-group">
                                <label ><?php echo e(__('Tag Item Show')); ?></label>
                                <input type="number" name="leftbar_tag_item_show"  class="form-control" value="<?php echo e(get_static_option('leftbar_tag_item_show')); ?>">
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


            });
        }(jQuery));
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/bytesed/public_html/laravel/intoday/@core/resources/views/backend/pages/leftbar-settings.blade.php ENDPATH**/ ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Edit Poll')); ?>

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
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title"><?php echo e(__('Edit Poll')); ?>   </h4>
                            </div>
                            <div class="header-title d-flex">
                                <div class="btn-wrapper-inner">
                                    <a href="<?php echo e(route('admin.polls')); ?>" class="btn btn-primary"><?php echo e(__('All Polls')); ?></a>
                                </div>
                            </div>
                        </div>
                        <form action="<?php echo e(route('admin.poll.update',$poll->id)); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="tab-content margin-top-40">

                                <div class="form-group">
                                    <label for="title"><?php echo e(__('Question')); ?></label>
                                    <input type="text" class="form-control" name="question" value="<?php echo e($poll->question); ?>" id="edit_question">
                                </div>

                                <?php
                                    $options = json_decode($poll->options, true);
                                ?>

                                <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <div class="main">
                                  <div class="form-group">
                                      <label for="title"><?php echo e(__('Option')); ?></label>
                                      <div class="new-single-input">
                                          <input type="text" class="form-control" name="options[]" id="edit_options" value="<?php echo e($name); ?>">
                                          <div class="delete_icon pull-right">
                                              <button title="Click to Delete" class="btn btn-danger btn-sm btn-circle new-btn-plus" id="remove_btn"><?php echo e(__('X')); ?></button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <div class="show_markup">

                                </div>

                                <div class="add_icon pull-right">
                                    <button title="Click to Add New" class="btn btn-success btn-sm btn-circle" id="plus_btn"> <i class="fa fa-plus"></i></button>
                                </div>

                                <div class="form-group mt-5 pt-5">
                                    <label for="title"><?php echo e(__('Status')); ?></label>
                                    <select class="form-control" name="status">
                                        <option value="0" <?php if($poll->status == '0'): ?> selected <?php endif; ?>><?php echo e(__('Inactive')); ?></option>
                                        <option value="1" <?php if($poll->status == '1'): ?> selected <?php endif; ?>><?php echo e(__('Active')); ?></option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary mt-3 submit_btn"><?php echo e(__('Submit ')); ?></button>
                            </div>
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

    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {

                $(document).on('click','#plus_btn',function(e){
                    e.preventDefault();

                    let Markup = ' <div class="main">'+
                        ' <div class="form-group add-data">'+
                        '  <label for="title">'+"<?php echo e(__('Option')); ?>"+'</label>'+
                        ' <div class="new-single-input">'+
                        ' <input type="text" class="form-control" name="options[]" id="edit_options" value="">'+
                        ' <div class="delete_icon pull-right">'+
                        ' <button title="Click to Delete" class="btn btn-danger btn-sm btn-circle new-btn-plus" id="remove_btn">'+"<?php echo e(__('X')); ?>"+'</button>'+
                        '  </div>'+
                        ' </div>'+
                        ' </div>'+
                        ' </div>';

                    $('.show_markup').append(Markup);
                });

                $(document).on('click','#remove_btn',function(e){
                    e.preventDefault();
                    $(this).parent().parent().parent().remove();
                })

            });

        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/bytesed/public_html/laravel/intoday/@core/resources/views/backend/pages/polls/edit.blade.php ENDPATH**/ ?>
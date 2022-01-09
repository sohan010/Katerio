<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('View Vote Result')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.datatable.css','data' => []]); ?>
<?php $component->withName('datatable.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

    <style>
        .vote_progress_content .progress{
            position: relative;
            height: 20px;
        }
        .vote_progress_content .progress .progress-bar{
            padding: 0 7px;
        }
        .progress-percentage{
            position: absolute;
            right: 5px;
            color: #000;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                      <div class="middle-part">
                          <a href="<?php echo e(route('admin.polls')); ?>" class="btn btn-primary mb-3 pull-right"><?php echo e(__('All Polls')); ?></a>
                          <h4 class="text-center"><?php echo e(__('Vote Summary')); ?></h4>
                          <h6 class="text-center mt-2 text-primary"><?php echo e(__('Total Vote : ' .$poll_info->count())); ?></h6>

                      </div>

                        <?php  $a = 0; ?>
                        <?php $__currentLoopData = $vote_cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $avg = $count / $poll_info->count() * 100 ;
                            $colors2 = ['#FEA47F','#BDC581','#EAB543','#55E6C1','#B33771'];
                        ?>
                         <div class="vote_progress_content">
                            <div class="progress mt-4">
                                <div class="progress-bar" role="progressbar" style="width: <?php echo e($avg); ?>  % ; background-color: <?php echo e($colors2[$a]); ?> " aria-valuenow="<?php echo e($avg); ?>"
                                     aria-valuemin="0" aria-valuemax="100"><strong><?php echo e($name); ?> (<?php echo e($count); ?>) <span class="progress-percentage"><?php echo e(ceil($avg ).'%'); ?></span> </strong></div>
                            </div>
                        </div>
                       <?php $a === 5 ? $a = 0 : $a++?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title"><?php echo e(__('Vote Details')); ?>  </h4>
                            </div>

                            <div class="right-content">
                                <a href="<?php echo e(route('admin.polls')); ?>" class="btn btn-primary mb-3"><?php echo e(__('All Polls')); ?></a>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                <th><?php echo e(__('ID')); ?></th>
                                <th><?php echo e(__('Voted On')); ?></th>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Email')); ?></th>
                                <th><?php echo e(__('Date')); ?></th>

                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $poll->poll_infos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($data->id); ?></td>
                                            <td><?php echo e($data->vote_name); ?></td>
                                            <td><?php echo e($data->name); ?></td>
                                            <td><?php echo e($data->email); ?></td>
                                            <td><?php echo e(date('d-m-Y', strtotime($data->created_at))); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
 <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.datatable.js','data' => []]); ?>
<?php $component->withName('datatable.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
    <script type="text/javascript">
        (function(){
            "use strict";
            $(document).ready(function(){
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.bulk-action-js','data' => ['url' => route('admin.poll.bulk.action')]]); ?>
<?php $component->withName('bulk-action-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.poll.bulk.action'))]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
              });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/bytesed/public_html/laravel/intoday/@core/resources/views/backend/pages/polls/result.blade.php ENDPATH**/ ?>
<script src="<?php echo e(asset('assets/backend/js/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/js/summernote-bs4.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/js/jquery.nice-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/js/spectrum.min.js')); ?>"></script>
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.js','data' => []]); ?>
<?php $component->withName('media.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?><?php /**PATH D:\laragon\www\katerio\@core\resources\views/components/pagebuilder/js.blade.php ENDPATH**/ ?>
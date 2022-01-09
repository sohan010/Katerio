$(document).on('click','#custom',function () {
    $(this).addClass("disabled")
    $(this).html('<i class="fas fa-spinner fa-spin mr-1"></i> <?php echo e($title); ?>');
});<?php /**PATH D:\laragon\www\intoday-update-final\@core\resources\views/components/btn/custom.blade.php ENDPATH**/ ?>
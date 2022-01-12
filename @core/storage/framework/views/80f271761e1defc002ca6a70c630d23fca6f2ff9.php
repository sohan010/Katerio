<?php $__env->startSection('section'); ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="user-dashboard-card style-01">
                <div class="icon"><i class="fas fa-money-bill"></i></div>
                <div class="content">
                    <h4 class="title"><?php echo e(__('Total Post')); ?></h4>
                    <span class="number"><?php echo e($total_post); ?></span>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <script>
        $(document).ready(function(){
            $(document).on('click','.mobile-nav-click', function (e){
                e.preventDefault()

                // $('.nav-pills-close').toggleClass('active');
                $('.nav-pills-open').toggleClass('active');
            });
        });
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('frontend.user.dashboard.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\katerio\@core\resources\views/frontend/user/dashboard/user-home.blade.php ENDPATH**/ ?>
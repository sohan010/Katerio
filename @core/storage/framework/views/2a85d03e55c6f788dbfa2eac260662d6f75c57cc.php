
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Blog Analytics ')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">

                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title"><?php echo e(__('Analytics Data : ')); ?> <span class="text-primary"><?php echo e($blog->title); ?></span> </h4>

                            </div>
                            <div class="header-title d-flex">
                                <div class="btn-wrapper-inner">
                                    <a href="<?php echo e(route('admin.blog')); ?>" class="btn btn-info"> <?php echo e(__('Go Back')); ?></a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <div class="chart-wrapper margin-top-40">
                                    <h2 class="chart-title"><?php echo e(__("Views in last 30 Days")); ?> <?php echo e(date('Y')); ?></h2>
                                    <canvas id="view_data"></canvas>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/backend/js/chart.js')); ?>"></script>
<script>

        $.ajax({
            url: '<?php echo e(route('admin.blog.view.data.monthly')); ?>',
            type: 'POST',
            async: false,
            data: {
                _token : "<?php echo e(csrf_token()); ?>"
            },
            success: function (data) {
                console.log(data)
                labels = data.labels;
                let chartdata = data.data;

                new Chart(
                    document.getElementById('view_data'),
                    {
                        type: 'bar',
                        data: {
                            labels:labels,
                            datasets: [{
                                label: '<?php echo e(__('View Raised')); ?>',
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                data: chartdata,
                            }]
                        }
                    }
                );
            }
        });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\katerio\@core\Modules/Blog\Resources/views/backend/blog/view-analytics.blade.php ENDPATH**/ ?>
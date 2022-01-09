<?php if(get_footer_style()): ?>
<?php echo $__env->make('frontend.partials.pages-portion.footers.footer-'.get_footer_style(), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
    <?php echo $__env->make('frontend.partials.pages-portion.footers.footer-03', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<div class="back-to-top">
    <span class="back-top"><i class="las la-angle-up"></i></span>
</div>

<?php if(get_static_option('site_loader_animation')): ?>
    <div class="preloader" id="preloader">
        <div class="preloader-inner">
            <div class="loader">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
<?php endif; ?>




<script src="<?php echo e(asset('assets/common/js/jquery-3.6.0.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/common/js/jquery-migrate-3.3.2.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery.magnific-popup.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/wow.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/slick.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/imagesloaded.pkgd.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/isotope.pkgd.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/main.js')); ?>"></script>



<?php if(!empty(get_static_option('site_google_captcha_v3_site_key')) && (request()->routeIs('homepage.demo')) || request()->routeIs('homepage') ): ?>
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo e(get_static_option('site_google_captcha_v3_site_key')); ?>"></script>
    <script>
        (function() {
            "use strict";
            grecaptcha.ready(function () {
                grecaptcha.execute("<?php echo e(get_static_option('site_google_captcha_v3_site_key')); ?>", {action: 'homepage'}).then(function (token) {
                    if(document.getElementById('gcaptcha_token') != null){
                        document.getElementById('gcaptcha_token').value = token;
                    }
                });
            });

        })(jQuery);
    </script>

<?php endif; ?>
    <?php $twak__api = get_static_option('site_third_party_tracking_code'); ?>
    <?php if(!empty($twak__api)): ?>
        <?php echo $twak__api; ?>

    <?php endif; ?>

<script>
    $('[data-toggle="tooltip"]').tooltip({'placement': 'top','color':'green'});
</script>

<?php echo $__env->yieldContent('scripts'); ?>
    <?php echo $__env->make('frontend.partials.inline-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>
</html>
<?php /**PATH D:\laragon\www\intoday-last\@core\resources\views/frontend/partials/footer.blade.php ENDPATH**/ ?>
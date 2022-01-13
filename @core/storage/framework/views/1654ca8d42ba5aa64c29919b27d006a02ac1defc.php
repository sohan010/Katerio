
<?php echo $__env->make('frontend.partials.pages-portion.footers.footer-'.get_footer_style(), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="scroll-to-top">
    <i class="las la-chevron-up"></i>
</div>

<?php if(get_static_option('site_loader_animation')): ?>
    <div class="preloader-inner">
        <div class="preloader-main-gif">
            <img src="<?php echo e(asset('assets/frontend/img/preloader/fidget-spinner.gif')); ?>" alt="">
        </div>
    </div>
<?php endif; ?>

<?php if(preg_match('/(bytesed)/',url('/'))): ?>
<div class="buy-now-wrap">
    <ul class="buy-list">
        <li><a target="_blank" href="https://bytesed.com/docs-category/intoday-new-magazine-php-laravel-scripts/" data-container="body" data-toggle="popover" data-placement="left" data-content="Documentation"><i class="las la-file-alt"></i></a></li>
        <li><a target="_blank" href="https://codecanyon.net/checkout/from_item/35217402?license=regular&aid=byteseed&aso=xgenius-website&aca=purchase-btn-click"><i class="las la-shopping-cart"></i></a></li>
        <li><a target="_blank" href="https://xgenious51.freshdesk.com/"><i class="las la-headset"></i></a></li>
    </ul>
</div>
<?php endif; ?>

<script src="<?php echo e(asset('assets/frontend/js/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/bootstrap.min-v4.6.0.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/dynamic-script.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/slick.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery.magnific-popup.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/common/js/sweetalert2.js')); ?>"></script>
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

<?php echo $__env->yieldPushContent('scripts'); ?>
    <?php echo $__env->make('frontend.partials.inline-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


</body>
</html>
<?php /**PATH D:\laragon\www\katerio\@core\resources\views/frontend/partials/footer.blade.php ENDPATH**/ ?>

<div class="col-lg-4 col-sm-5">
    <div class="topbar-socials">
        <ul>
            <?php $__currentLoopData = $all_social_icons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li> <a href="<?php echo e($data->url); ?>"><i class="<?php echo e($data->icon); ?>"></i></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>


<div class="col-lg-4 col-sm-2">
    <div class="topbar-logo desktop-logo">
        <a href="<?php echo e(url('/')); ?>" class="logo">
            <?php if(get_static_option('site_frontend_dark_mode') == 'on'): ?>
                <?php echo render_image_markup_by_attachment_id(get_static_option('site_white_logo')); ?>

            <?php else: ?>
                <?php echo render_image_markup_by_attachment_id(get_static_option('site_logo')); ?>

            <?php endif; ?>
        </a>
    </div>
</div>

<div class="col-lg-4 col-sm-5">

    <div class="topbar-right-contents">
        <h6 class="dates"><?php echo e($dt); ?></h6>
    </div>

    <div class="right-contnet">
        <ul class="info-items">


            <?php if(auth()->check()): ?>
                <?php
                    $route = auth()->guest() == 'admin' ? route('admin.home') : route('user.home');
                ?>
                <li><a href="<?php echo e($route); ?>"><?php echo e(__('Dashboard')); ?></a>  <span>/</span>
                    <a href="<?php echo e(route('frontend.user.logout')); ?>">
                        <?php echo e(__('Logout')); ?>

                    </a>


                    <form id="userlogout-form" action="<?php echo e(route('user.logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                        <input type="submit" value="aa" id="userlogout-form" class="d-none">
                    </form>
                </li>
            <?php else: ?>
                <li class="log-btn">
                    <a href="<?php echo e(route('user.login')); ?>"><?php echo e(__('Login')); ?></a>
                    <span>|</span>
                    <a href="<?php echo e(route('user.register')); ?>"><?php echo e(__('Register')); ?></a>
                </li>
            <?php endif; ?>
            <?php if(!empty(get_static_option('language_select_option'))): ?>
                <li>
                    <select id="langchange">
                        <?php $__currentLoopData = $all_language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $lang_name = explode('(',$lang->name);
                                $data = array_shift($lang_name);
                            ?>
                            <option <?php if(get_user_lang() == $lang->slug): ?> selected <?php endif; ?> value="<?php echo e($lang->slug); ?>"><?php echo e($data); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </li>
            <?php endif; ?>

            <li>
                <label class="switch yes">
                    <input id="frontend_darkmode" type="checkbox" data-mode=<?php echo e(get_static_option('site_frontend_dark_mode')); ?> <?php if(get_static_option('site_frontend_dark_mode') == 'on'): ?> checked <?php else: ?> <?php endif; ?>>
                    <span class="slider-color-mode onff"></span>
                </label>
            </li>

        </ul>
    </div>
</div><?php /**PATH D:\laragon\www\katerio\@core\resources\views/frontend/partials/pages-portion/topbar-content/home-one.blade.php ENDPATH**/ ?>
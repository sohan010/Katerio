<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('User Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="login-page-wrapper page-padding">
        <div class="container container-two">
            <div class="row">
                <div class="col-lg-12 mt-4">
                    <div class="user-dashboard-wrapper">
                        <div class="mobile_nav mobile-nav-click">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <ul class="nav nav-pills nav-pills-open mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <div class="user-photo">
                                   <div class="info">
                                       <?php echo render_image_markup_by_attachment_id(Auth::guard('web')->user()->image ?? get_static_option('single_blog_page_comment_avatar_image')); ?>

                                       <p><?php echo e(Auth::guard('web')->user()->name); ?></p>
                                   </div>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?php if(request()->routeIs('user.home')): ?> active <?php endif; ?>" href="<?php echo e(route('user.home')); ?>"><?php echo e(__('Dashboard')); ?></a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link <?php if(request()->routeIs('user.blog') || request()->routeIs('user.blog.new') || request()->routeIs('user.blog.edit')): ?> active <?php endif; ?> " href="<?php echo e(route('user.blog')); ?>"><?php echo e(__('All Posts')); ?></a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link <?php if(request()->routeIs('user.home.edit.profile')): ?> active <?php endif; ?> " href="<?php echo e(route('user.home.edit.profile')); ?>"><?php echo e(__('Edit Profile')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if(request()->routeIs('user.home.change.password')): ?> active <?php endif; ?> " href="<?php echo e(route('user.home.change.password')); ?>"><?php echo e(__('Change Password')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('user.logout')); ?>" onclick="event.preventDefault();
                                    jQuery('#userlogout-form-submit-btn').trigger('click');">
                                    <?php echo e(__('Logout')); ?>

                                </a>
                                <form id="userlogout-form" action="<?php echo e(route('user.logout')); ?>" method="POST"
                                      class="d-none">
                                    <?php echo csrf_field(); ?>
                                    <input type="submit" value="dd" id="userlogout-form-submit-btn" class="d-none">
                                </form>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel">
                                <div class="message-show ml-3">
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
                                <?php echo $__env->yieldContent('section'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\katerio\@core\resources\views/frontend/user/dashboard/user-master.blade.php ENDPATH**/ ?>
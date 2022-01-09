

<?php $__env->startSection('site-title'); ?>
    <?php echo e($user_info->name); ?> : <?php echo e(__('Blogs')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <?php echo e($user_info->name); ?> : <?php echo e(__('Blogs')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-meta-data'); ?>
    <?php echo render_site_meta(); ?>

    <?php echo render_site_title($user_info->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="author-profile-area padding-bottom-50 padding-top-95">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="author-profile">
                        <div class="author-profile-flex">
                            <?php
                                $img = get_attachment_image_by_id($user_info->image);
                            ?>
                            <div class="author-thumbs">
                                <?php echo render_image_markup_by_attachment_id($user_info->image,'','grid') ?? ''; ?>

                            </div>
                            <div class="profile-contents">
                                <div class="author-profile-top">
                                    <h3 class="profile-title">  <?php echo e($user_info->name); ?> </h3>
                                    <div class="profile-span"> <?php echo e($user_info->designation); ?> </div>

                                    <p class="common-para"> <?php echo $user_info->description; ?></p>
                                </div>
                                <div class="author-profile-bottom">
                                    <ul class="common-socials">
                                        <li>
                                            <a class="facebook" href="<?php echo e($user_info->facebook_url); ?>"> <i class="lab la-facebook-f"></i> </a>
                                        </li>
                                        <li>
                                            <a class="twitter" href="<?php echo e($user_info->twitter_url); ?>"> <i class="lab la-twitter"></i> </a>
                                        </li>
                                        <li>
                                            <a class="instagram" href="<?php echo e($user_info->instagram_url); ?>"> <i class="lab la-instagram"></i> </a>
                                        </li>
                                        <li>
                                            <a class="linkedin" href="<?php echo e($user_info->linkedin_url); ?>"> <i class="lab la-linkedin-in"></i> </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="related-post-area padding-top-50 padding-bottom-100">
        <div class="container">
            <div class="section-title-two">
                <h4 class="title"> <?php echo e(__('Author Post')); ?> </h4>
            </div>
            <div class="row">
                <?php if(count($all_blogs) < 1): ?>
                <div class="col-md-6">
                    <div class="alert-area padding-bottom-100">
                        <div class="alert alert-warning">
                            <?php echo __('No post found related to').' '. '<strong> '.$user_info->name.' </strong>'; ?>

                        </div>
                    </div>
                </div>

                <?php else: ?>
                    <?php $__currentLoopData = $all_blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4 col-md-6 wow animated zoomIn" data-wow-delay=".1s">
                            <div class="single-popular-stories margin-top-30">
                                <div class="popular-stories-thumb">
                                    <?php echo render_image_markup_by_attachment_id($data->image, '', 'grid'); ?>

                                </div>

                                <div class="popular-stories-contents">
                                    <h4 class="common-title common-title-two"> <a href="<?php echo e(route('frontend.blog.single',$data->slug)); ?>"> <?php echo e($data->getTranslation('title',$user_select_lang_slug) ?? ''); ?> </a> </h4>
                                    <div class="popular-stories-tag">
                                        <?php $__currentLoopData = $data->category_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="tags"> <strong> <a href="<?php echo e(route('frontend.blog.category',['id'=> $cat->id,'any'=> Str::slug($cat->title)])); ?>"> <?php echo e($cat->getTranslation('title',$user_select_lang_slug) ?? __('Uncategorized')); ?> </a></strong> </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <span class="tags"> <?php echo e(date('d M Y',strtotime($data->created_at))); ?> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="pagination-wrapper center-text " aria-label="Page navigation" data-padding-bottom="0">
                                    <?php echo e($all_blogs->links()); ?>

                                </div>
                            </div>
                        </div>
                 </div>
            <?php endif; ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/bytesed/public_html/laravel/intoday/@core/resources/views/frontend/pages/blog/user-blog.blade.php ENDPATH**/ ?>
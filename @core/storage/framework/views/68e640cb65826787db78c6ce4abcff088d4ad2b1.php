

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Category : ').$category_name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('site-title'); ?>
    <?php echo e($category_name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-meta-data'); ?>
    <?php echo render_site_meta(); ?>

    <?php echo render_site_title($category_name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="blog-two-wrapper padding-top-70 padding-bottom-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <?php if(count($all_blogs) < 1): ?>
                            <div class="col-lg-12">
                                <div class="alert alert-warning alert-block col-md-12 ">
                                    <strong><div class="error-message "><span><?php echo e(__('No Post Available In Category : ').$category_name); ?></span></div></strong>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php $__currentLoopData = $all_blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $video_url =  $data->video_url;
                                    $icon_color = get_static_option('blog_category_video_icon_color');
                                ?>
                            <div class="col-lg-6 col-md-6 wow animated zoomIn" data-wow-delay=".1s">
                                <div class="single-popular-stories margin-top-30">
                                    <div class="popular-stories-thumb video-parent-global">
                                        <?php echo render_image_markup_by_attachment_id($data->image, '', 'grid'); ?>

                                        <?php if(!empty($video_url)): ?>
                                            <div class="popup-videos ">
                                                <a href="<?php echo e($video_url); ?>" class="play-icon videos-play-global videos-play-small" style="color: <?php echo e($icon_color); ?>">
                                                    <i class="las la-play icon"></i>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="popular-stories-contents">
                                        <h4 class="common-title common-title-two">  <a href="<?php echo e(route('frontend.blog.single',$data->slug)); ?>"><?php echo e($data->getTranslation('title',$user_select_lang_slug) ?? ' '); ?></a> </h4>
                                        <div class="popular-stories-tag">
                                            <?php if($data->created_by == 'user'): ?>
                                                <?php $user = $data->user; ?>
                                            <?php else: ?>
                                                <?php $user = $data->admin; ?>
                                            <?php endif; ?>

                                             <span class="tags"> <a <?php if(!empty($user->id)): ?>  href="<?php echo e(route('frontend.user.created.blog', ['user'=> $data->created_by, 'id'=>$user->id])); ?>" <?php endif; ?>><strong> <?php echo e($data->author ?? __('Anonymous')); ?> </strong></a> </span>
                                                <?php $__currentLoopData = $data->category_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                        <span class="tags"> <a href="<?php echo e(route('frontend.blog.category',['id'=> $cat->id,'any'=> Str::slug($cat->title)])); ?>"><?php echo e($cat->getTranslation('title',$user_select_lang_slug) ?? __('Uncategorized')); ?></a></span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                 <span class="tags"> <?php echo e(date('d M Y',strtotime($data->created_at))); ?> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="col-lg-12">
                        <nav class="pagination-wrapper" aria-label="Page navigation">
                            <?php echo e($all_blogs->links()); ?>

                        </nav>
                <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area-wrapper custom-margin-widget style-02">
                        <?php echo render_frontend_sidebar('sidebar_02',['column' => false]); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/sharifur/Desktop/sharifur-backup/localhost/intoday/@core/resources/views/frontend/pages/blog/blog-category.blade.php ENDPATH**/ ?>

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Search For: ')); ?> <?php echo e($search_term); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('site-title'); ?>
     <?php echo e($search_term); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-meta-data'); ?>
    <?php echo render_site_meta(); ?>

    <?php echo render_site_title($search_term); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="blog-two-wrapper padding-top-70 padding-bottom-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <?php if(count($all_blogs) < 1): ?>
                        <div class="alert alert-danger">
                            <?php echo e(__('Nothing found related to').' '.$search_term); ?>

                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <?php $__currentLoopData = $all_blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $video_url =  $data->video_url;
                                $icon_color = get_static_option('blog_search_video_icon_color');
                            ?>
                            <div class="col-lg-6 col-md-12 wow animated zoomIn" data-wow-delay=".1s">
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
                                            <span class="tags"> <a <?php if(!empty($user->id)): ?> href="<?php echo e(route('frontend.user.created.blog', ['user'=> $data->created_by, 'id'=>$user->id])); ?>" <?php endif; ?>><strong> <?php echo e($data->author ?? __('Anonymous')); ?> </strong></a> </span>
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
                    <div class="pagination-wrapper" aria-label="Page navigation ">
                        <?php echo e($all_blogs->links()); ?>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area-wrapper style-02 padding-reverse">
                        <?php echo render_frontend_sidebar('sidebar_05',['column' => false]); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/bytesed/public_html/laravel/intoday/@core/resources/views/frontend/pages/blog/blog-search.blade.php ENDPATH**/ ?>
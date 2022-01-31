
<?php $__env->startSection('page-title'); ?>
    <li class="list-item"><a href="#"><?php echo e(__('Search For')); ?></a></li>
    <li class="list-item"><a href="#"><?php echo e($search_term); ?></a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('site-title'); ?>
     <?php echo e($search_term); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-page-title'); ?>
    <?php echo e($search_term); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-meta-data'); ?>
    <?php echo render_site_meta(); ?>

    <?php echo render_site_title($search_term); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="blog-area-wrapper Political-blog-grid-wrapper" data-padding-top="100" data-padding-bottom="100">
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
                            <div class="col-md-6 col-lg-6 mt-5">
                                <div class="blog-grid-style-03 small-02">
                                    <div class="img-box">
                                        <?php echo render_image_markup_by_attachment_id($data->image, '', 'grid'); ?>

                                    </div>
                                    <div class="content">
                                        <div class="post-meta">
                                            <ul class="post-meta-list style-02">
                                                <?php if($data->created_by == 'user'): ?>
                                                    <?php $user = $data->user; ?>
                                                <?php else: ?>
                                                    <?php $user = $data->admin; ?>
                                                <?php endif; ?>
                                                <li class="post-meta-item">
                                                    <a <?php if(!empty($user->id)): ?>  href="<?php echo e(route('frontend.user.created.blog', ['user'=> $data->created_by, 'id'=>$user->id])); ?>" <?php endif; ?>>
                                                        <span class="text author"> <?php echo e($data->author ?? __('Anonymous')); ?></span>
                                                    </a>
                                                </li>
                                                <li class="post-meta-item date">
                                                    <span class="text"> <?php echo e(date('d M Y',strtotime($data->created_at))); ?> </span>
                                                </li>
                                            </ul>
                                        </div>
                                        <h4 class="title">
                                            <a href="<?php echo e(route('frontend.blog.single',$data->slug)); ?>"><?php echo e(Str::words($data->getTranslation('title',$user_select_lang_slug),6 ?? '')); ?></a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                        <div class="col-lg-12">
                            <div class="pagination " data-padding-top="50">
                                <div class="pagination-wrapper">
                                    <?php echo e($all_blogs->links()); ?>

                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-sm-7 col-md-6 col-lg-4">
                    <div class="widget-area-wrapper">
                        <?php echo render_frontend_sidebar('details_page_sidebar',['column' => false]); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\katerio\@core\Modules/Blog\Resources/views/frontend/blog/blog-search.blade.php ENDPATH**/ ?>
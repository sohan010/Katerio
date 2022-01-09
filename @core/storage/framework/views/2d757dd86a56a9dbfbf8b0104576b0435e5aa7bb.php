
<?php
    $post_img = null;
    $blog_image = get_attachment_image_by_id($blog_post->image,"full",false);
    $post_img = !empty($blog_image) ? $blog_image['img_url'] : '';
?>

<?php $__env->startSection('page-title'); ?>
    <?php echo e($blog_post->getTranslation('title',$user_select_lang_slug)); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-meta-data'); ?>
    <?php echo render_site_title($blog_post->getTranslation('title',$user_select_lang_slug)); ?>

    <?php echo render_page_meta_data($blog_post); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="blog-details-area padding-top-70 padding-bottom-100">
        <div class="container container-two">
            <div class="row">
                <div class="col-xl-8">
                    <div class="blog-details-wrapper">
                        <div class="blog-details-inner">
                            <div class="single-details">
                                <?php if(!empty($blog_post->image_gallery)): ?>
                                    <div class="global-slick-init slick-space-adjust " data-infinite="true" data-slidesToShow="1"
                                         data-slidesToScroll="1" data-speed="500" data-cssEase="linear" data-arrows="false" data-dots="false"
                                         data-prevArrow='<div class="prev-arrow"><i class="las la-arrow-left"></i></div>'
                                         data-nextArrow='<div class="prev-arrow"><i class="las la-arrow-left"></i></div>'
                                         data-autoplaySpeed="2000"
                                         data-responsive='[{"breakpoint": 768,"settings": { "arrows": false,"centerMode": true,"centerPadding": "40px", "slidesToShow": 1}},{"breakpoint": 480, "settings": { "arrows": false, "centerMode": true, "centerPadding": "0px","slidesToShow": 1} }]'
                                    >
                                        <?php
                                            $images = explode("|",$blog_post->image_gallery);
                                            $video_url = $blog_post->video_url;
                                        ?>

                                        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="single-gallery-image single-featured">
                                                <div class="img-box">
                                                    <?php echo render_image_markup_by_attachment_id($img,'','large'); ?>

                                                    <?php if($video_url): ?>
                                                        <a href="<?php echo e($video_url); ?>" class="play-icon magnific-inst mfp-iframe v-02" style="color: <?php echo e(get_static_option('single_page_blog_video_icon_color')); ?>">
                                                            <i class="las la-play icon"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php else: ?>
                                    <div class="details-thumbs bg-custom-image" <?php echo render_background_image_markup_by_attachment_id($blog_post->image, '', 'large'); ?>>
                                        <?php
                                            $video_url = $blog_post->video_url;
                                            $icon_color = get_static_option('single_page_blog_video_icon_color');
                                        ?>
                                        <?php if($video_url): ?>
                                            <div class="popup-videos">
                                                <a href="<?php echo e($video_url); ?>" class="play-icon videos-play-global" style="color: <?php echo e($icon_color); ?>">
                                                    <i class="las la-play icon"></i>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="details-contents">
                                    <?php if($blog_post->created_by == 'user'): ?>
                                        <?php $user = $blog_post->user; ?>
                                    <?php else: ?>
                                        <?php $user = $blog_post->admin; ?>
                                    <?php endif; ?>
                                    <div class="popular-stories-tag">

                                        <span class="tags"><a <?php if(!empty($user->id)): ?> href="<?php echo e(route('frontend.user.created.blog', ['user'=> $blog_post->created_by, 'id'=>$user->id])); ?>"<?php endif; ?>> <strong> <?php echo e($blog_post->author); ?>  </strong></a> </span>
                                        <span class="tags"><?php echo e(date('d M Y',strtotime($blog_post->created_at))); ?> </span>
                                        <?php $__currentLoopData = $blog_post->category_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="tags">
                                                <a href="<?php echo e(route('frontend.blog.category',['id'=> $cat->id,'any'=> Str::slug($cat->title)])); ?>"
                                                   class="item"><?php echo e($cat->getTranslation('title',$user_select_lang_slug) ?? __('Uncategorized')); ?></a>
                                            </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <h2 class="blog-details-title">  <?php echo e($blog_post->title ?? __('No Title Given')); ?> </h2>
                                    <p class="common-para details-para"> <?php echo $blog_post->blog_content; ?> </p>
                                </div>
                            </div>
                        </div>

                        <?php
                            $tags_arr = json_decode($blog_post->tag_id);
                            $all_tags = is_array($tags_arr) ? implode(",", $tags_arr) : "";
                        ?>

                        <div class="details-tag-area padding-top-50 padding-bottom-50">
                         <?php if(!is_null($tags_arr) && count($tags_arr) > 0): ?>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="tags">
                                        <p class="tag-tiitle"> <?php echo e(__('Tags')); ?>: </p>

                                        <ul>
                                            <?php $__currentLoopData = $tags_arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(!empty($i)): ?>
                                                    <li><a href="<?php echo e(route('frontend.blog.tags.page', [ 'any'=> $i ?? 'u'])); ?>"><?php echo e($i); ?></a></li>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="social-share">
                                        <p class="share-tiitle"> <?php echo e(__('Share')); ?>: </p>
                                         <ul>
                                             <?php echo single_post_share(route('frontend.blog.single',['id' => $blog_post->id, 'slug' => Str::slug($blog_post->title,'-')]),$blog_post->title,$blog_post->image); ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                             <?php endif; ?>
                        </div>

                        <div class="details-comment-area padding-bottom-50" id="comment-area">
                            <div class="section-title">
                                <?php if($blogCommentCount > 0): ?>
                                    <h4 class="title">
                                        <?php echo e(sprintf('%s %s ',
                                        $blogCommentCount,
                                           get_static_option( 'blog_single_page_comments_'.get_user_lang().'_text')
                                        )); ?>


                                    </h4>
                                <?php endif; ?>
                            </div>
                            <div class="comments-inner">

                                    <div class="comments-flex-contents" id="comment_content_div">
                                        <?php echo e(csrf_field()); ?>

                                        <div id="comment_data" data-items="5">
                                            <?php echo $__env->make('frontend.partials.pages-portion.comment-show-data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>

                                        <?php if($blogComments->count()): ?>
                                            <?php if($blogComments->count() > 4): ?>
                                                <div class="load_more_div mt-4">
                                                    <button type="button" class="load-more-btn" id="load_more_comment_button"><?php echo e(__('Load More')); ?></button>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>

                            </div>
                        </div>

                        <?php if(!auth()->guard('web')->check()): ?>
                            <?php echo $__env->make('frontend.partials.ajax-user-login-markup',['title' => get_static_option('blog_single_page_login_title_'.$user_select_lang_slug.'_text')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>

                        <div class="details-replay-area padding-bottom-30">
                            <?php if(auth()->guard('web')->check()): ?>
                            <div class="section-title">
                                <h3 class="title"><?php echo get_static_option('blog_single_page_comments_'.get_user_lang().'_title_text'); ?></h3>
                            </div>
                            <div class="replay-inner">
                                <form action="<?php echo e(route('blog.comment.store')); ?>" class="comment-form" id="blog-comment-form">
                                    <?php echo csrf_field(); ?>
                                    <div class="error-message"></div>
                                    <input type="hidden" name="comment_id" />
                                    <input type="hidden" name="blog_id" id="blog_id"
                                           value="<?php echo e($blog_post->id); ?>">
                                    <input type="hidden" name="user_id" id="user_id"
                                           value="<?php echo e(auth()->guard('web')->user()->id); ?>">

                                    <input type="hidden" name="commented_by" id="commented_by"
                                           value="<?php echo e(auth()->guard('web')->user()->name); ?>">

                                    <div class="replay-inner">
                                        <div class="form-group">
                                           <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Comments"
                                             cols="30" rows="10" required=""></textarea>
                                        </div>

                                        <div class="btn-wrapper">
                                            <button id="submitComment" type="submit" class="btn-default"><?php echo get_static_option('blog_single_page_comments_button_'.get_user_lang().'_text'); ?></button>
                                        </div>

                                    </div>

                                </form>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if(count($all_related_blog) > 0): ?>
                        <div class="related-post-area padding-top-50">
                            <div class="section-title">
                                <h4 class="title"> <?php echo e(__('Related Post')); ?> </h4>
                            </div>
                            <div class="row">

                                <?php $__currentLoopData = $all_related_blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-6 col-md-6">
                                    <div class="single-news margin-top-30">
                                        <?php
                                            $video_url = $data->video_url;
                                            $icon_color = get_static_option('single_page_blog_video_icon_color');
                                        ?>

                                        <div class="news-thumb">
                                           <?php echo render_image_markup_by_attachment_id($data->image, '' ,'thumbnail'); ?>

                                            <?php if($video_url): ?>
                                                <div class="popup-videos">
                                                    <a href="<?php echo e($video_url); ?>" class="play-icon videos-play-global videos-play-medium" style="color: <?php echo e($icon_color); ?>">
                                                        <i class="las la-play icon"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <ul class="news-date-tag">
                                                <li class="tag-list"> <?php echo e(date('d M Y', strtotime($data->created_at))); ?> </li>

                                                <?php $__currentLoopData = $data->category_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="tag-list">
                                                <a href="<?php echo e(route('frontend.blog.category',['id'=> $cat->id,'any'=> Str::slug($cat->title)])); ?>"
                                                   class="item"><?php echo e($cat->getTranslation('title',$user_select_lang_slug) ?? __('Uncategorized')); ?></a>
                                            </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                        <div class="news-contents">
                                            <h3 class="common-title"> <a href="<?php echo e(route('frontend.blog.single',$data->slug)); ?>"> <?php echo e($data->title ?? ''); ?> </a> </h3>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                     <?php endif; ?>
                   </div>




                <div class="col-xl-4 col-lg-8 margin-top-30">
                    <div class="widget-area-wrapper">
                        <?php echo render_frontend_sidebar('sidebar_01',['column' => false]); ?>

                    </div>
                </div>

            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        (function($){
            "use strict";

            $(document).ready(function(){
                //Blog Comment Insert
                $(document).on('click', '#submitComment', function (e) {
                    e.preventDefault();
                    var erContainer = $(".error-message");
                    var el = $(this);
                    var form = $('#blog-comment-form');
                    var user_id = $('#user_id').val();
                    var blog_id = $('#blog_id').val();
                    var commented_by = $('#commented_by').val();
                    var comment_content = $('#comment_content').val();
                    let comment_id = $('#blog-comment-form input[name=comment_id]').val();
                    el.text('<?php echo e(__('Submitting')); ?>...');

                    $.ajax({
                        url: form.attr('action'),
                        method: 'POST',
                        data: {
                            _token: "<?php echo e(csrf_token()); ?>",
                            user_id: user_id,
                            blog_id: blog_id,
                            commented_by: commented_by,
                            comment_id: comment_id,
                            comment_content: comment_content,
                        },
                        success: function (data){
                              location.reload();
                            $('#comment_content').val('');
                            // erContainer.html('<div class="alert alert- '+data.msg+'"></div>');
                            
                        },
                        error: function (data) {
                            var errors = data.responseJSON;
                            erContainer.html('<div class="alert alert-danger"></div>');
                            $.each(errors.errors, function (index, value) {
                                erContainer.find('.alert.alert-danger').append('<p>' + value + '</p>');
                            });
                            el.text('<?php echo e(__('Comment')); ?>');
                        },

                    });
                });

                //Blog Replay
                $(document).on('click', '.btn-replay', function (e) {
                    e.preventDefault();
                    var el = $(this).hide();
                    let comment_id = $(this).data('comment_id');
                    let parent_name = $(this).parent().parent().find('.author-title').data('parent_name');

                    $('#blog-comment-form input[name=comment_id]').val(comment_id);
                    $('#comment_content').attr('placeholder','Replaying to '+ parent_name + '..');

                });

                function load_comment_data(id) {
                    var commentData = $('#comment_data');
                    var items = commentData.attr('data-items');
                    $.ajax({
                        url: "<?php echo e(route('frontend.load.blog.comment.data')); ?>",
                        method: "POST",
                        data: {id: id, _token: "<?php echo e(csrf_token()); ?>", items: items},
                        success: function (data) {

                            commentData.attr('data-items',parseInt(items) + 5);

                            $('#comment_data').append(data.markup);
                            $('#load_more_comment_button').text('<?php echo e(__('Load More')); ?>');


                            if (data.blogComments.length === 0) {
                                $('#load_more_comment_button').text('<?php echo e(__('No Comment Found')); ?>');
                            }

                        }
                    })
                }

                $(document).on('click', '#load_more_comment_button', function () {
                    $(this).text('<?php echo e(__('Loading...')); ?>');
                    load_comment_data('<?php echo e($blog_post->id); ?>');

                });

            });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\intoday-last\@core\resources\views/frontend/pages/blog/blog-single.blade.php ENDPATH**/ ?>
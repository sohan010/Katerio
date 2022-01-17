
<?php
    $post_img = null;
    $blog_image = get_attachment_image_by_id($blog_post->image,"full",false);
    $post_img = !empty($blog_image) ? $blog_image['img_url'] : '';
    $colors = ['bg-color-e','bg-color-a','bg-color-b','bg-color-g','bg-color-c'];
    $session_user_given_password_get = \Illuminate\Support\Facades\Session::get('user_given_password');

    //Author image
    $user_image = render_image_markup_by_attachment_id(optional($blog_post->user)->image, 'image');
    $avatar_image = render_image_markup_by_attachment_id(get_static_option('single_blog_page_comment_avatar_image'),'image');
    $created_by_image = $user_image ? $user_image : $avatar_image;

    $created_by = $blog_post->author ?? __('Anonymous');

          if ($blog_post->created_by === 'user') {
                $user_id = $blog_post->user_id;
            } else {
                $user_id = $blog_post->admin_id;
            }

    $created_by_url = !is_null($user_id) ?  route('frontend.user.created.blog', ['user' => $blog_post->created_by, 'id' => $user_id]) : route('frontend.blog.single',$blog_post->slug);
    $date = date('M d, Y',strtotime($blog_post->created_at));
?>

<?php $__env->startSection('page-title'); ?>
    <?php echo e($blog_post->getTranslation('title',$user_select_lang_slug)); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-meta-data'); ?>
    <?php echo render_site_title($blog_post->getTranslation('title',$user_select_lang_slug)); ?>

    <?php echo render_page_meta_data($blog_post); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<!-- blog details area start -->
<div class="blog-details-area-wrapper" data-padding-top="100" data-padding-bottom="100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-details-inner-area">
                    <div class="main-img-box">
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
                                        <div class="tag-box">
                                            <?php echo render_image_markup_by_attachment_id($img,'','large'); ?>

                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                        <?php else: ?>
                          <div class="img-bg" <?php echo render_background_image_markup_by_attachment_id($blog_post->image); ?>></div>
                        <?php endif; ?>

                    </div>

                    <div class="tag-box">
                        <?php $__currentLoopData = $blog_post->category_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <a href="<?php echo e(route('frontend.blog.category',['id'=> $cat->id,'any'=> Str::slug($cat->title)])); ?>"
                            class="category-style-01 v-02 <?php echo e($colors[$key % count($colors)]); ?>"><?php echo e($cat->getTranslation('title',$user_select_lang_slug) ?? __('Uncategorized')); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <h3 class="main-title">
                        <a><?php echo e(Str::words($blog_post->title,10)); ?></a>
                    </h3>

                    <div class="post-meta-main">
                        <div class="post-meta">
                            <ul class="post-meta-list">
                                <li class="post-meta-item">
                                    <a href="<?php echo e($created_by_url); ?>">
                                        <?php echo $created_by_image; ?>

                                        <span class="text"><?php echo e($created_by); ?></span>
                                    </a>
                                </li>
                                <li class="post-meta-item date">
                                    <i class="lar la-clock icon"></i>
                                    <span class="text"><?php echo e($date); ?></span>
                                </li>
                                <li class="post-meta-item">
                                    <a href="#">
                                        <i class="lar la-comments icon"></i>
                                        <span class="text"><?php echo e($blogCommentCount); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <p class="info info-01"><?php echo $blog_post->blog_content ?? ''; ?> </p>

                    <?php
                        $tags_arr = json_decode($blog_post->tag_id);
                        $all_tags = is_array($tags_arr) ? implode(",", $tags_arr) : "";
                    ?>

                    <?php if(!is_null($tags_arr) && count($tags_arr) > 0): ?>
                    <div class="tag-and-social-link">
                        <div class="tag-wrap">
                            <ul>
                                <li class="name"><?php echo e(__('Tags :')); ?></li>
                                <?php $__currentLoopData = $tags_arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($i)): ?>
                                        <li><a class="tag-btn" href="<?php echo e(route('frontend.blog.tags.page', [ 'any'=> $i ?? 'u'])); ?>"><?php echo e($i); ?></a></li>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </ul>
                        </div>
                        <div class="social-link-wrap">
                            <div class="social-icon">
                                <ul class="social-link-list">
                                    <li class="name"><?php echo e(__('share :')); ?></li>
                                    <li class="link-item">

                                        <?php echo single_post_share(route('frontend.blog.single',['id' => $blog_post->id, 'slug' => Str::slug($blog_post->title,'-')]),$blog_post->title,$blog_post->image); ?>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

             <?php if(count($all_related_blog) > 0): ?>
                    <div class="related-post-area" data-padding-top="100">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title-style-03">
                                    <h3 class="title"> <?php echo e(__('Related Post')); ?> </h3>
                                    <div class="appendarow"></div>
                                </div>
                            </div>

                            <?php $__currentLoopData = $all_related_blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-6">
                                <div class="blog-grid-style-03 small-02">
                                    <div class="img-box">
                                        <?php echo render_image_markup_by_attachment_id($data->image); ?>

                                    </div>
                                    <div class="content">
                                        <div class="post-meta">
                                            <ul class="post-meta-list style-02">
                                                <?php

                                                    if ($data->created_by === 'user') {
                                                      $user_id = $data->user_id;
                                                      } else {
                                                          $user_id = $data->admin_id;
                                                      }

                                                    $created_by_url = !is_null($user_id) ?  route('frontend.user.created.blog', ['user' => $data->created_by, 'id' => $user_id]) : route('frontend.blog.single',$data->slug);
                                                ?>
                                                <li class="post-meta-item">
                                                    <a href="<?php echo e($created_by_url); ?>">
                                                        <span class="text author"><?php echo e($data->author ?? ''); ?></span>
                                                    </a>
                                                </li>
                                                <li class="post-meta-item date">
                                                    <span class="text"><?php echo e(date('D m, Y',strtotime($data->created_at))); ?></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <h4 class="title font-size-24 font-weight-600">
                                            <a href="<?php echo e(route('frontend.blog.single',$data->slug)); ?>"><?php echo e(Str::words($data->title,10) ?? ''); ?></a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                 <?php endif; ?>

                    <!-- comment area star -->
                    <div class="comment-area-full-wrapper" data-padding-top="100">
                        <!-- User comment area start -->
                        <div class="user-comment-area" >
                            <div class="comment-section-title section-title-style-03">

                                <?php if($blogCommentCount > 0): ?>
                                    <h3 class="title"><span class="total">
                                        <?php echo e(sprintf('%s %s ',
                                        $blogCommentCount,
                                           get_static_option( 'blog_single_page_comments_'.get_user_lang().'_text')
                                        )); ?>


                                   </span> </h3>
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


                    <?php if(auth()->guard('web')->check()): ?>
                        <div class="comment-form-area" data-padding-top="70">
                            <div class="comment-section-title section-title-style-03">
                                <h3 class="title"><?php echo get_static_option('blog_single_page_comments_'.get_user_lang().'_title_text'); ?></h3>
                            </div>

                            <form action="<?php echo e(route('blog.comment.store')); ?>" class="comment-form" id="blog-comment-form">
                                <?php echo csrf_field(); ?>
                                <div class="error-message"></div>
                                <input type="hidden" name="comment_id"/>
                                <div class="row">
                                    <input type="hidden" name="comment_id"/>
                                    <input type="hidden" name="blog_id" id="blog_id"
                                           value="<?php echo e($blog_post->id); ?>">
                                    <input type="hidden" name="user_id" id="user_id"
                                           value="<?php echo e(auth()->guard('web')->user()->id); ?>">

                                    <input type="hidden" name="commented_by" id="commented_by"
                                           value="<?php echo e(auth()->guard('web')->user()->name); ?>">

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                           <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Comments" cols="30" rows="10" ></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="btn-wrapper">
                                            <button type="submit" class="btn-default transparent-btn" id="submitComment"><?php echo get_static_option('blog_single_page_comments_button_'.get_user_lang().'_text'); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>

            <div class="col-sm-7 col-md-6 col-lg-4">
                <div class="widget-area-wrapper">
                    <?php echo render_frontend_sidebar('sidebar_01',['column' => false]); ?>

                </div>
            </div>
        </div>
    </div>
</div>




<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
                            load_comment_data('<?php echo e($blog_post->id); ?>');
                        },
                        error: function (data) {
                            var errors = data.responseJSON;
                            console.log(errors)
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
                    let parent_name = $(this).parent().parent().find('.title').data('parent_name');

                    $('#blog-comment-form input[name=comment_id]').val(comment_id);
                    $('#comment_content').attr('placeholder','Replying to '+ parent_name + '..');

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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\katerio\@core\Modules/Blog\Resources/views/frontend/blog/blog-single-variant/blog-single-with-right-sidebar.blade.php ENDPATH**/ ?>

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

<div class="blog-details-area-wrapper" data-padding-top="100" data-padding-bottom="100">
    <div class="container">
        <div class="row">

            <div class="col-lg-8">
                <div class="blog-details-inner-area">
                    <?php echo $__env->make('frontend.pages.blog-single-one-portions.image-and-gallery', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('frontend.pages.blog-single-one-portions.title-others', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('frontend.pages.blog-single-one-portions.related-blogs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('frontend.pages.blog-single-one-portions.comment-area', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                            $('#comment_content').val('');
                            // erContainer.html('<div class="alert alert- '+data.msg+'"></div>');
                            load_comment_data('<?php echo e($blog_post->id); ?>');
                            $('#blog-comment-form input[name=comment_id]').val('');
                             location.reload();
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
                    $(this).hide();
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
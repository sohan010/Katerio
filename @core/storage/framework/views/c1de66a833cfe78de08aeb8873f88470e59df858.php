
    <?php $__currentLoopData = $blogComments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="single-comments">
        <div class="comments-flex-contents">
            <div class="comment-author">
                <?php echo render_image_markup_by_attachment_id(optional($data->user)->image ?? get_static_option('single_blog_page_comment_avatar_image')); ?>

            </div>
            <div class="comments-content">
                <div class="flex-replay">
                    <span class="author-title" data-parent_name="<?php echo e(optional($data->user)->name); ?>"> <?php echo e(optional($data->user)->name ?? ''); ?></span>

                    <?php if(auth('web')->check() && auth('web')->id() != $data->user_id): ?>
                    <div class="btn-wrapper">
                        <a href="#0" data-comment_id="<?php echo e($data->id); ?>"  class="btn-replay"> <?php echo e(__('Replay')); ?> </a>
                    </div>
                    <?php endif; ?>
                </div>

                <span class="comment-date"><?php echo e(date('d F Y', strtotime($data->created_at ?? ''))); ?> </span>
                <p class="common-para"><?php echo $data->comment_content ?? ''; ?></p>

            </div>
        </div>
            <?php $__currentLoopData = $data->reply; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $repData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="child-single-comments">
                    <div class="comments-flex-contents">
                        <div class="comment-author">
                            <?php echo render_image_markup_by_attachment_id($repData->user->image ?? get_static_option('single_blog_page_comment_avatar_image')); ?>

                        </div>
                        <div class="comments-content">
                            <div class="flex-replay">
                                <span class="author-title" > <?php echo e($repData->user->name ?? ''); ?></span>
                            </div>

                            <span class="comment-date"><?php echo e(date('d F Y', strtotime($repData->created_at ?? ''))); ?> </span>
                            <p class="common-para"><?php echo $repData->comment_content ?? ''; ?></p>

                        </div>
                    </div>
                </div>
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php /**PATH D:\laragon\www\intoday-last\@core\resources\views/frontend/partials/pages-portion/comment-show-data.blade.php ENDPATH**/ ?>
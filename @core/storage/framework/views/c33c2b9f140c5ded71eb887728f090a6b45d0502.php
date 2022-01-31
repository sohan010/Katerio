<div class="details-one-page-para">
    <p class="info info-01"><?php echo $blog_post->blog_content ?? ''; ?> </p>
</div>

<?php
    $tags_arr = json_decode($blog_post->tag_id);
    $all_tags = is_array($tags_arr) ? implode(",", $tags_arr) : "";
?>

<?php if(!is_null($tags_arr) && count($tags_arr) > 0): ?>
<div class="tag-and-social-link">
    <div class="social-link-wrap">
        <div class="social-icon">
            <ul class="widget-social-link-list">
                <li class="name"><?php echo e(__('Share:')); ?></li>
                <?php echo single_post_share_two(route('frontend.blog.single',['id' => $blog_post->id, 'slug' => Str::slug($blog_post->title,'-')]),$blog_post->title,$blog_post->image); ?>

            </ul>
        </div>
    </div>

    <div class="tag-wrap v-02">
        <ul>
            <li class="name"><?php echo e(__('Tags :')); ?></li>
            <?php $__currentLoopData = $tags_arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($i)): ?>
                    <li><a class="tag-btn" href="<?php echo e(route('frontend.blog.tags.page', [ 'any'=> $i ?? 'u'])); ?>"><?php echo e($i); ?></a></li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </ul>
    </div>

<?php endif; ?><?php /**PATH D:\laragon\www\katerio\@core\resources\views/frontend/pages/blog-single-two-portions/description-others.blade.php ENDPATH**/ ?>

<h3 class="main-title v-02">
    <a><?php echo e(Str::words($blog_post->title,10)); ?></a>
</h3>

<div class="tag-box v-02">
    <?php $__currentLoopData = $blog_post->category_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('frontend.blog.category',['id'=> $cat->id,'any'=> Str::slug($cat->title)])); ?>"
           class="category-style-01 v-02 <?php echo e($colors[$key % count($colors)]); ?>"><?php echo e($cat->getTranslation('title',$user_select_lang_slug) ?? __('Uncategorized')); ?></a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="post-meta-main v-02">
    <div class="post-meta">
        <ul class="post-meta-list">
            <li class="post-meta-item">
                <a href="<?php echo e($created_by_url); ?>">
                    <?php echo $created_by_image; ?>

                    <span class="text"><?php echo e($created_by); ?></span>
                </a>
            </li>
            <li class="post-meta-item date">
                <span class="text"><?php echo e($date); ?></span>
            </li>
            <li class="post-meta-item">
                <a href="#">
                    <span class="text"><?php echo e($blogCommentCount); ?> <?php echo e(__('Comments')); ?></span>
                </a>
            </li>
        </ul>
    </div>
</div><?php /**PATH D:\laragon\www\katerio\@core\resources\views/frontend/pages/blog-single-two-portions/title-part.blade.php ENDPATH**/ ?>
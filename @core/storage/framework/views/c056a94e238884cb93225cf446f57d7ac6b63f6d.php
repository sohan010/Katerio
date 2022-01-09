<?php if(!empty(get_static_option('leftbar_show_hide'))): ?>
<div class="sidebars-wrappers">
    <div class="sidebars-close"> <i class="las la-times"></i> </div>
    <div class="sidebar-inner">
        <div class="sidebar-logo">
            <a href="<?php echo e(url('/')); ?>">
                <?php echo render_image_markup_by_attachment_id(get_static_option('site_logo_two')); ?>

            </a>
        </div>
        <div class="contents-wrapper">
            <h4 class="connets-title"> <?php echo get_static_option('leftbar_social_'.$user_select_lang_slug.'_title'); ?></h4>
            <div class="updated-socials">
                <ul class="common-socials">
                    <?php
                        $classes = ['facebook','twitter','instagram','linkedin','youtube' ];
                        $con = 0;
                    ?>
                    <?php $__currentLoopData = $social_icons_for_leftbar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a class="<?php echo e($classes[$con] ?? ''); ?>" href="<?php echo e($social->details); ?>"> <i class="<?php echo e($social->icon); ?>"></i> </a>
                    </li>

                        <?php $con == 5 ? $con = 0 : $con ++   ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <div class="sidebar-updated-content">
                <div class="section-title">
                    <h4 class="title"> <?php echo get_static_option('leftbar_category_'.$user_select_lang_slug.'_title'); ?> </h4>
                </div>
                <div class="categories-contents-inner">
                    <div class="categories-lists">
                        <?php $__currentLoopData = $category_for_leftbar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $count_blog_item = \App\Blog::whereJsonContains('category_id', (string) $category->id)->count();
                            ?>
                        <div class="single-list">
                             <span class="follow-para"><a href="<?php echo e(route('frontend.blog.category', ['id' => $category->id,'any' => Str::slug($category->title)])); ?>"> <?php echo e($category->title); ?></a> </span>
                            <span class="followers"> <?php echo e($count_blog_item); ?></span>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="tag-new-contents">
                    <div class="section-title">
                        <h4 class="title"> <?php echo get_static_option('leftbar_tag_'.$user_select_lang_slug.'_title'); ?> </h4>
                    </div>
                    <div class="tag-list">
                        <?php $__currentLoopData = $tags_for_leftbar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="list" href="<?php echo e(route('frontend.blog.tags.page', ['any' => $tag->name])); ?>"> <?php echo e($tag->name); ?> </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?><?php /**PATH D:\laragon\www\intoday-update-final\@core\resources\views/frontend/partials/left-bar.blade.php ENDPATH**/ ?>
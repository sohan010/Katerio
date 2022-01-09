<?php
    if(!isset($page_post)){
        return;
    }
?>

<?php if($page_post->layout === 'normal_layout' || $page_post->layout === 'home_page_layout' || $page_post->layout === 'home_page_layout_two'): ?>
<?php echo \App\PageBuilder\PageBuilderSetup::render_frontend_pagebuilder_content_for_dynamic_page('dynamic_page',$page_post->id); ?>

<?php endif; ?>
<?php if($page_post->layout === 'home_page_layout'): ?>
    <div class="parent-area padding-top-70">
        <div class="container <?php echo e($page_post->page_class); ?>">
            <div class="row">
                <div class="col-xl-8">
                    <?php echo \App\PageBuilder\PageBuilderSetup::render_frontend_pagebuilder_content_for_dynamic_page('dynamic_page_with_sidebar',$page_post->id); ?>

                </div>

                <div class="col-xl-4">
                    <div class="single-sidebar-item responsive-margin <?php if(get_static_option('site_frontend_dark_mode') === 'on'): ?>   dark-version  <?php endif; ?>">
                        <?php echo render_frontend_sidebar($page_post->sidebar_layout,['column' => false]); ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
<?php endif; ?>


<?php if($page_post->layout === 'home_page_layout_two'): ?>
    <div class="parent-area parent-container-fluid padding-top-70">
            <div class="container <?php echo e($page_post->page_class); ?>">
                <div class="row">
                    <div class="col-xl-8">
                        <?php echo \App\PageBuilder\PageBuilderSetup::render_frontend_pagebuilder_content_for_dynamic_page('dynamic_page_with_sidebar',$page_post->id); ?>

                    </div>

                    <div class="col-xl-4">
                        <div class="widget-area-wrapper style-<?php echo e($page_post->widget_style); ?>">
                            <?php echo render_frontend_sidebar($page_post->sidebar_layout,['column' => false]); ?>

                        </div>
                    </div>

                </div>
            </div>
        <div class="container-fluid p-0 <?php echo e($page_post->page_class); ?>">
            <div class="col-lg-12">
                <?php echo \App\PageBuilder\PageBuilderSetup::render_frontend_pagebuilder_content_for_dynamic_page('dynamic_page_with_sidebar_two',$page_post->id); ?>

            </div>
        </div>
    </div>
<?php endif; ?>

<?php if($page_post->layout === 'home_page_layout_two'): ?>
    <div class="parent-area ">
        <div class="container <?php echo e($page_post->page_class); ?>">
            <div class="row">
                <div class="col-xl-8">
                    <?php echo \App\PageBuilder\PageBuilderSetup::render_frontend_pagebuilder_content_for_dynamic_page('dynamic_page_with_sidebar_three',$page_post->id); ?>

                </div>

                <div class="col-xl-4">
                    <div class="widget-area-wrapper style-<?php echo e($page_post->widget_style); ?>">
                        <?php echo render_frontend_sidebar($page_post->sidebar_layout_two,['column' => false]); ?>

                    </div>
                </div>

            </div>
        </div>
        <div class="container-fluid p-0 <?php echo e($page_post->page_class); ?>">
            <div class="col-lg-12">
                <?php echo \App\PageBuilder\PageBuilderSetup::render_frontend_pagebuilder_content_for_dynamic_page('dynamic_page_without_sidebar_two',$page_post->id); ?>

            </div>
        </div>
    </div>
<?php endif; ?>



<?php if($page_post->layout === 'sidebar_layout'): ?>
    <div class="blog-list-area-wrapper index-01 padding-top-70 padding-bottom-100">
        <div class="container <?php echo e($page_post->page_class); ?>">
            <div class="row">
                <div class="col-xl-8">
                    <?php echo \App\PageBuilder\PageBuilderSetup::render_frontend_pagebuilder_content_for_dynamic_page('dynamic_page_with_sidebar',$page_post->id); ?>

                </div>
                <div class="col-xl-4 col-lg-8 margin-top-30">
                    <div class="widget-area-wrapper style-02">
                        <?php echo render_frontend_sidebar($page_post->sidebar_layout,['column' => false]); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php /**PATH D:\laragon\www\in-today\@core\resources\views/frontend/partials/pages-portion/dynamic-page-builder-part.blade.php ENDPATH**/ ?>
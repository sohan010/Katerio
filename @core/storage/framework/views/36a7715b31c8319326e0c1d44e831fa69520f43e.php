
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('New Blog Post')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.summernote.css','data' => []]); ?>
<?php $component->withName('summernote.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/bootstrap-tagsinput.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/nice-select.css')); ?>">
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.css','data' => []]); ?>
<?php $component->withName('media.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.blog-inline-css','data' => []]); ?>
<?php $component->withName('blog-inline-css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('section'); ?>
    <div class="dashboard-form-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h3 class="header-title"><?php echo e(__('New Blog Post')); ?>   </h3>
                            </div>
                            <div class="header-title d-flex">
                                <div class="btn-wrapper-inner">
                                    <form action="<?php echo e(route('user.blog')); ?>" method="get"
                                          id="langauge_change_select_get_form">
                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.lang.select','data' => ['name' => 'lang','selected' => $default_lang,'id' => 'langchange']]); ?>
<?php $component->withName('lang.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('lang'),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($default_lang),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('langchange')]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                                    </form>
                                    <a href="<?php echo e(route('user.blog')); ?>"
                                       class="btn btn-primary"><?php echo e(__('All Blog Post')); ?></a>
                                </div>
                            </div>
                        </div>

                        <form action="<?php echo e(route('user.blog.new')); ?>" method="post" enctype="multipart/form-data"
                              id="blog_new_form">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="lang" value="<?php echo e($default_lang); ?>">
                            <div class="form-group">
                                <label for="title"><?php echo e(__('Title')); ?></label>
                                <input type="text" class="form-control" name="title" id="title"
                                       placeholder="<?php echo e(__('Title')); ?>">
                            </div>

                            <div class="form-group permalink_label">
                                <label class="text-dark"><?php echo e(__('Permalink * : ')); ?>

                                    <span id="slug_show" class="display-inline"></span>
                                    <span id="slug_edit" class="display-inline">
                                         <button class="btn btn-warning btn-sm slug_edit_button"> <i class="las la-edit"></i> </button>

                                        <input type="text" name="slug" class="form-control blog_slug mt-2" style="display: none">
                                          <button class="btn btn-info btn-sm slug_update_button mt-2" style="display: none"><?php echo e(__('Update')); ?></button>
                                    </span>
                                </label>
                            </div>

                            <div class="form-group">
                                <label><?php echo e(__('Blog Content')); ?></label>
                                <input type="hidden" name="blog_content">
                                <div class="summernote"></div>
                            </div>

                            <div class="form-group">
                                <label for="title"><?php echo e(__('Excerpt')); ?></label>
                                <textarea name="excerpt" class="form-control max-height-150" cols="20"
                                          rows="5"></textarea>
                            </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="post_type_radio">
                            <h6><?php echo e(__('Post Type')); ?></h6>
                            <div class="form-check form-check-inline d-block">

                                <input class="form-check-input post_type" type="radio" checked
                                       name="inlineRadioOptions"
                                       id="radio_general" value="option1">
                                <i class="ti-settings"></i>
                                <label class="form-check-label" for="inlineRadio1"><?php echo e(__('General')); ?></label>
                            </div>
                            <div class="form-check form-check-inline d-block">

                                <input class="form-check-input post_type" type="radio" name="inlineRadioOptions"
                                       id="radio_video" value="option2">
                                <i class="ti-video-camera"></i>
                                <label class="form-check-label" for="inlineRadio2"><?php echo e(__('Video')); ?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="video_section" style="display: none">
                    <div class="card mb-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="slug"><?php echo e(__('Video Url')); ?></label>
                                        <input type="text" class="form-control" name="video_url">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="featured"><strong><?php echo e(__('Select Categories')); ?></strong></label>
                                    <div class="category-section">
                                        <ul>
                                            <?php $__currentLoopData = $all_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <input type="checkbox" name="category_id[]"
                                                           id="exampleCheck1" value="<?php echo e($category->id); ?>">
                                                    <label class="ml-1">
                                                        <?php echo e(purify_html($category->getTranslation('title',$default_lang))); ?>

                                                    </label>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                </div>


                                <div class="form-group" id="blog_tag_list">
                                    <label for="title" class="mt-3"><?php echo e(__('Blog Tag')); ?></label>
                                    <input type="text" class="form-control tags_filed"
                                           name="tag_id[]">

                                    <div id="show-autocomplete-dashboard" style="display: none;">
                                        <ul class="autocomplete-warp-dashboard" ></ul>
                                    </div>
                                </div>




                                <div class="form-group ">
                                    <label for="image"><?php echo e(__('Blog Image')); ?></label>
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap"></div>
                                        <input type="hidden" name="image">
                                        <button type="button" class="btn btn-info media_upload_form_btn"
                                                data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal"
                                                data-target="#media_upload_modal">
                                            <?php echo e(__('Upload Image')); ?>

                                        </button>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="image"><?php echo e(__('Galley Image')); ?></label>
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap"></div>
                                        <input type="hidden" name="image_gallery">
                                        <button type="button" class="btn btn-info media_upload_form_btn"
                                                data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                data-modaltitle="<?php echo e(__('Upload Image')); ?>"
                                                data-toggle="modal"
                                                data-mulitple="true"
                                                data-target="#media_upload_modal">
                                            <?php echo e(__('Upload Image')); ?>

                                        </button>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body meta">
                                                <h5 class="header-title my-3"><?php echo e(__('Meta Section')); ?></h5>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="nav flex-column nav-pills" id="v-pills-tab"
                                                             role="tablist" aria-orientation="vertical">
                                                            <a class="nav-link active" id="v-pills-home-tab"
                                                               data-toggle="pill" href="#v-pills-home" role="tab"
                                                               aria-controls="v-pills-home"
                                                               aria-selected="true"><?php echo e(__('Blog Meta')); ?></a>
                                                            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill"
                                                               href="#v-pills-profile" role="tab"
                                                               aria-controls="v-pills-profile"
                                                               aria-selected="false"><?php echo e(__('Facebook Meta')); ?></a>
                                                            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill"
                                                               href="#v-pills-messages" role="tab"
                                                               aria-controls="v-pills-messages"
                                                               aria-selected="false"><?php echo e(__('Twitter Meta')); ?></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <div class=" meta tab-content" id="v-pills-tabContent">

                                                            <div class="tab-pane fade show active" id="v-pills-home"
                                                                 role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                                <div class="form-group">
                                                                    <label for="title"><?php echo e(__('Meta Title')); ?></label>
                                                                    <input type="text" class="form-control" name="meta_title"
                                                                           placeholder="<?php echo e(__('Title')); ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="slug"><?php echo e(__('Meta Tags')); ?></label> <br>
                                                                    <input type="text" class="form-control" name="meta_tags"
                                                                           placeholder="Slug" data-role="tagsinput">
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="title"><?php echo e(__('Meta Description')); ?></label>
                                                                        <textarea name="meta_description"
                                                                                  class="form-control max-height-140"
                                                                                  cols="20"
                                                                                  rows="5"></textarea>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                                                 aria-labelledby="v-pills-profile-tab">
                                                                <div class="form-group">
                                                                    <label for="title"><?php echo e(__('Facebook Meta Tag')); ?></label><br>
                                                                    <input type="text" class="form-control" data-role="tagsinput"
                                                                           name="facebook_meta_tags">
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="title"><?php echo e(__('Facebook Meta Description')); ?></label>
                                                                        <textarea name="facebook_meta_description"
                                                                                  class="form-control max-height-140"
                                                                                  cols="20"
                                                                                  rows="4"></textarea>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="image"><?php echo e(__('Facebook Meta Image')); ?></label>
                                                                    <div class="media-upload-btn-wrapper">
                                                                        <div class="img-wrap"></div>
                                                                        <input type="hidden" name="facebook_meta_image">
                                                                        <button type="button"
                                                                                class="btn btn-info media_upload_form_btn"
                                                                                data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                                                data-modaltitle="<?php echo e(__('Upload Image')); ?>"
                                                                                data-toggle="modal"
                                                                                data-target="#media_upload_modal">
                                                                            <?php echo e(__('Upload Image')); ?>

                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                                                 aria-labelledby="v-pills-messages-tab">
                                                                <div class="form-group">
                                                                    <label for="title"><?php echo e(__('Twitter Meta Tag')); ?></label><br>
                                                                    <input type="text" class="form-control" data-role="tagsinput"
                                                                           name="twitter_meta_tags">
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="title"><?php echo e(__('Twitter Meta Description')); ?></label>
                                                                        <textarea name="twitter_meta_description"
                                                                                  class="form-control max-height-140"
                                                                                  cols="20"
                                                                                  rows="4"></textarea>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="image"><?php echo e(__('Twitter Meta Image')); ?></label>
                                                                    <div class="media-upload-btn-wrapper">
                                                                        <div class="img-wrap"></div>
                                                                        <input type="hidden" name="twitter_meta_image">
                                                                        <button type="button"
                                                                                class="btn btn-info media_upload_form_btn"
                                                                                data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                                                data-modaltitle="<?php echo e(__('Upload Image')); ?>"
                                                                                data-toggle="modal"
                                                                                data-target="#media_upload_modal">
                                                                            <?php echo e(__('Upload Image')); ?>

                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="submit_btn mt-5">
                                    <button type="submit"
                                            class="btn btn-success pull-right"><?php echo e(__('Submit New Post ')); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.markup','data' => ['type' => 'web']]); ?>
<?php $component->withName('media.markup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('web')]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/backend/js/bootstrap-tagsinput.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.summernote.js','data' => []]); ?>
<?php $component->withName('summernote.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.js','data' => ['type' => 'web']]); ?>
<?php $component->withName('media.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('web')]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {

                //For Tags
                var blogTagInput = $('#blog_tag_list .tags_filed');
                var oldTag = '';
                blogTagInput.tagsinput();

                $(document).on('keyup','#blog_tag_list .bootstrap-tagsinput input[type="text"]',function (e) {
                    e.preventDefault();

                    var el = $(this);
                    var inputValue = $(this).val();
                    $.ajax({
                        type: 'get',
                        url :  "<?php echo e(route('frontend.get.tags.by.ajax')); ?>",
                        async: false,
                        data: {
                            query: inputValue
                        },

                        success: function (data){
                            oldTag = inputValue;
                            let html = '';
                            var showAutocomplete = '';
                            $('#show-autocomplete-dashboard').html('<ul class="autocomplete-warp-dashboard"></ul>');
                            if(el.val() != '' && data.markup != ''){

                                data.result.map(function (tag, key) {
                                    html += '<li class="tag_option" data-id="'+key+'" data-val="'+tag+'">' + tag + '</li>'
                                })

                                $('#show-autocomplete-dashboard ul').html(html);
                                $('#show-autocomplete-dashboard').show();


                            } else {
                                $('#show-autocomplete-dashboard').hide();
                                oldTag = '';
                            }

                        },
                        error: function (res){

                        }
                    });
                });

                $(document).on('click', '.tag_option', function(e) {
                    e.preventDefault();
                    let id = $(this).data('id');
                    let tag = $(this).data('val');
                    blogTagInput.tagsinput('add', tag);
                    $(this).parent().remove();
                    blogTagInput.tagsinput('remove', oldTag);
                });


                //Permalink Code
                $('.permalink_label').hide();
                $(document).on('keyup', '#title', function (e) {
                    var slug = $(this).val().trim().toLowerCase().split(' ').join('-');
                    var url = `<?php echo e(url('/'.get_blog_slug_by_page_id(get_static_option('blog_page')).'/')); ?>/` + slug;
                    $('.permalink_label').show();
                    var data = $('#slug_show').text(url).css('color', 'blue');
                    $('.blog_slug').val(slug);

                });

                //Slug Edit Code
                $(document).on('click', '.slug_edit_button', function (e) {
                    e.preventDefault();
                    $('.blog_slug').show();
                    $(this).hide();
                    $('.slug_update_button').show();
                });

                //Slug Update Code
                $(document).on('click', '.slug_update_button', function (e) {
                    e.preventDefault();
                    $(this).hide();
                    $('.slug_edit_button').show();
                    var update_input = $('.blog_slug').val();
                    var slug = update_input.trim().toLowerCase().split(' ').join('-');
                    var url = `<?php echo e(url('/blog/')); ?>/` + slug;
                    $('#slug_show').text(url);
                    $('.blog_slug').hide();
                });

                $(document).on('change','#status',function(e){
                    e.preventDefault();
                    if ($(this).val() == 'schedule') {
                        $('.date').show();
                        $('.date').focus();
                    } else {
                        $('.date').hide();
                    }
                });


                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.btn.submit','data' => []]); ?>
<?php $component->withName('btn.submit'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                $(document).on('change', '#langchange', function (e) {
                    $('#langauge_change_select_get_form').trigger('submit');
                });

                var el = $('.post_type_radio');
                $(document).on('change', '.post_type', function () {
                    var val = $(this).val();
                    if (val === 'option2') {
                        $('.video_section').show();
                    } else {
                        $('.video_section').hide();
                    }
                })

            });
        })(jQuery)
    </script>


    <script>
        $(document).ready(function(){
            $(document).on('click','.mobile-nav-click', function (e){
                e.preventDefault()

                // $('.nav-pills-close').toggleClass('active');
                $('.nav-pills-open').toggleClass('active');
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.user.dashboard.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/bytesed/public_html/laravel/intoday/@core/resources/views/frontend/user/dashboard/user-post/new.blade.php ENDPATH**/ ?>
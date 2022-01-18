@extends('frontend.frontend-page-master')
@php
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
@endphp

@section('page-title')
    {{$blog_post->getTranslation('title',$user_select_lang_slug)}}
@endsection

@section('custom-page-title')
    {{__('Blog Details')}}
@endsection

@section('page-meta-data')
    {!! render_site_title($blog_post->getTranslation('title',$user_select_lang_slug)) !!}
    {!!  render_page_meta_data($blog_post) !!}
@endsection


@section('content')
<div class="blog-details-area-wrapper" data-padding-top="100" data-padding-bottom="100">
    <div class="container">
        <div class="row">
            @if($blog_post->visibility == 'public' )
            <div class="col-lg-8">
                <div class="blog-details-inner-area">
                    @include('frontend.pages.blog-single-one-portions.image-and-gallery')
                    @include('frontend.pages.blog-single-one-portions.title-others')
                    @include('frontend.pages.blog-single-one-portions.related-blogs')
                    @include('frontend.pages.blog-single-one-portions.comment-area')
                </div>
            </div>
            @elseif($blog_post->visibility == 'logged_user' )

                 @if(auth()->guard('web')->check())
                    <div class="col-lg-8">
                        <div class="blog-details-inner-area">
                            @include('frontend.pages.blog-single-one-portions.image-and-gallery')
                            @include('frontend.pages.blog-single-one-portions.title-others')
                            @include('frontend.pages.blog-single-one-portions.related-blogs')
                            @include('frontend.pages.blog-single-one-portions.comment-area')
                        </div>
                    </div>

                  @else
                    <div class="col-xl-8">
                        <div class="alert alert-warning">
                            <h3>{{__('Login to see the blog details')}}</h3>
                        </div>
                    </div>
                 @endif

            @elseif($blog_post->visibility == 'password' && $blog_post->password != $session_user_given_password_get )
                <div class="col-xl-8">
                    <x-msg.error/>
                    <x-msg.success/>
                    <form action="{{route('frontend.user.blog.password')}}" method="get">
                        <label for="">{{__('Please Provide Blog Password to see this blog details (If you have no password then contact to the admin..!)')}}</label>
                        <input class="form-control" type="password" name="user_blog_password" style="height: 50px">
                        <input type="hidden" name="original_password" value="{{$blog_post->password}}">
                        <input type="hidden" name="password_form_id" value="{{$blog_post->id}}">

                        <button class="btn btn-primary btn-md mt-3" type="submit">{{__('Submit')}}</button>
                    </form>
                </div>

            @elseif($blog_post->visibility == 'password' && (!is_null($blog_post->password) == $session_user_given_password_get))

                <div class="col-lg-8">
                    <div class="blog-details-inner-area">
                        @include('frontend.pages.blog-single-one-portions.image-and-gallery')
                        @include('frontend.pages.blog-single-one-portions.title-others')
                        @include('frontend.pages.blog-single-one-portions.related-blogs')
                        @include('frontend.pages.blog-single-one-portions.comment-area')
                    </div>
                </div>

            @else
                <div class="col-xl-8">
                    <x-msg.error/>
                    <x-msg.success/>
                    <form action="{{route('frontend.user.blog.password')}}" method="get">
                        <label for="">{{__('Please Provide Blog Password to see this blog details (If you have no password then contact to the admin..!)')}}</label>
                        <input class="form-control" type="password" name="user_blog_password" style="height: 50px">
                        <input type="hidden" name="original_password" value="{{$blog_post->password}}">
                        <input type="hidden" name="password_form_id" value="{{$blog_post->id}}">

                        <button class="btn btn-primary btn-md mt-3" type="submit">{{__('Submit')}}</button>
                    </form>
                </div>
            @endif

            <div class="col-sm-7 col-md-6 col-lg-4">
                <div class="widget-area-wrapper">
                    {!! render_frontend_sidebar('sidebar_01',['column' => false]) !!}
                </div>
            </div>

        </div>
    </div>
</div>




@endsection

@push('scripts')
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
                    el.text('{{__('Submitting')}}...');

                    $.ajax({
                        url: form.attr('action'),
                        method: 'POST',
                        data: {
                            _token: "{{csrf_token()}}",
                            user_id: user_id,
                            blog_id: blog_id,
                            commented_by: commented_by,
                            comment_id: comment_id,
                            comment_content: comment_content,
                        },
                        success: function (data){
                            $('#comment_content').val('');
                            // erContainer.html('<div class="alert alert- '+data.msg+'"></div>');
                            load_comment_data('{{$blog_post->id}}');
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
                            el.text('{{__('Comment')}}');
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
                        url: "{{ route('frontend.load.blog.comment.data') }}",
                        method: "POST",
                        data: {id: id, _token: "{{csrf_token()}}", items: items},
                        success: function (data) {

                            commentData.attr('data-items',parseInt(items) + 5);

                            $('#comment_data').append(data.markup);
                            $('#load_more_comment_button').text('{{__('Load More')}}');


                            if (data.blogComments.length === 0) {
                                $('#load_more_comment_button').text('{{__('No Comment Found')}}');
                            }

                        }
                    })
                }

                $(document).on('click', '#load_more_comment_button', function () {
                    $(this).text('{{__('Loading...')}}');
                    load_comment_data('{{$blog_post->id}}');

                });

            });
        })(jQuery);
    </script>
@endpush

@extends('backend.admin-master')
@section('site-title')
    {{__('Blog Others Settings')}}
@endsection

@section('style')
   <x-media.css/>
   <link rel="stylesheet" href="{{asset('assets/backend/css/colorpicker.css')}}">
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
              <x-msg.success/>
              <x-msg.error/>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Blog Others Settings')}}</h4>
                        <form action="{{route('admin.blog.others.settings')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="site_loader_animation"><strong>{{__('Breaking News Show/Hide')}}</strong></label>
                                <label class="switch yes">
                                    <input type="checkbox" name="blog_breaking_news_show_hide_all"  @if(!empty(get_static_option('blog_breaking_news_show_hide_all'))) checked @endif id="blog_breaking_news_show_hide_all">
                                    <span class="slider-enable-disable"></span>
                                </label>
                            </div>

                            <button id="update" type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-media.markup/>
@endsection

@section('script')
    <script src="{{asset('assets/backend/js/colorpicker.js')}}"></script>
    <script>
        (function($){
            "use strict";

            $(document).ready(function(){
                <x-icon-picker/>
                <x-btn.update/>
                initColorPicker('#blog_category_video_icon_color');
                initColorPicker('#blog_search_video_icon_color');
                initColorPicker('#blog_tags_video_icon_color');
                initColorPicker('#user_created_blog_video_icon_color');
                initColorPicker('#single_page_blog_video_icon_color');

                function initColorPicker(selector){
                    $(selector).ColorPicker({
                        color: '#852aff',
                        onShow: function (colpkr) {
                            $(colpkr).fadeIn(500);
                            return false;
                        },
                        onHide: function (colpkr) {
                            $(colpkr).fadeOut(500);
                            return false;
                        },
                        onChange: function (hsb, hex, rgb) {
                            $(selector).css('background-color', '#' + hex);
                            $(selector).val('#' + hex);
                        }
                    });
                }
            });
        }(jQuery));
    </script>
@endsection
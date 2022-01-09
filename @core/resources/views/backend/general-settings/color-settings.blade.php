@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/colorpicker.css')}}">
@endsection
@section('site-title')
    {{__('Color Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <x-msg.success/>
                  <x-msg.error/>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Color Settings")}}</h4>
                        <form action="{{route('admin.general.color.settings')}}" method="POST" enctype="multipart/form-data">@csrf
                            <div class="form-group">
                                <label for="site_main_color_one">{{__('Site Main Color One')}}</label>
                                <input type="text" name="site_main_color_one" style="background-color: {{get_static_option('site_main_color_one')}};" class="form-control"
                                       value="{{get_static_option('site_main_color_one')}}" id="site_main_color_one">
                                <small class="form-text text-muted">{{__('you can change -site main color- from here, it will replace the website main color')}}</small>
                            </div>

                            <div class="form-group">
                                <label for="site_main_color_two">{{__('Site Main Color Two')}}</label>
                                <input type="text" name="site_main_color_two" style="background-color: {{get_static_option('site_main_color_two')}};" class="form-control"
                                       value="{{get_static_option('site_main_color_two')}}" id="site_main_color_two">
                                <small class="form-text text-muted">{{__('you can change -site base color- from here, it will replace the website base color')}}</small>
                            </div>

                            <div class="form-group">
                                <label for="site_main_color_two">{{__('Site Heading Color')}}</label>
                                <input type="text" name="site_heading_color" style="background-color: {{get_static_option('site_heading_color')}};" class="form-control"
                                       value="{{get_static_option('site_heading_color')}}" id="site_heading_color">
                                <small class="form-text text-muted">{{__('you can change -heading color- from here, it will replace the website base color')}}</small>
                            </div>

                            <div class="form-group">
                                <label for="site_paragraph_color">{{__('Site Paragraph Color')}}</label>
                                <input type="text" name="site_paragraph_color" style="background-color: {{get_static_option('site_paragraph_color')}};" class="form-control"
                                       value="{{get_static_option('site_paragraph_color')}}" id="site_paragraph_color">
                                <small class="form-text text-muted">{{__('you can change -site paragraph color- from here, it will replace the website base color')}}</small>
                            </div>

                            <div class="form-group">
                                <label for="site_light_color_one">{{__('Site Light Color One')}}</label>
                                <input type="text" name="site_light_color_one" style="background-color: {{get_static_option('site_light_color_one')}};" class="form-control"
                                       value="{{get_static_option('site_light_color_one')}}" id="site_light_color_one">
                                <small class="form-text text-muted">{{__('you can change -site light color- from here, it will replace the website base color')}}</small>
                            </div>

                            <div class="form-group">
                                <label for="site_light_color_two">{{__('Site Light Color Two')}}</label>
                                <input type="text" name="site_light_color_two" style="background-color: {{get_static_option('site_light_color_two')}};" class="form-control"
                                       value="{{get_static_option('site_light_color_two')}}" id="site_light_color_two">
                                <small class="form-text text-muted">{{__('you can change - site light color two- from here, it will replace the website base color')}}</small>
                            </div>

                            <div class="form-group">
                                <label for="site_light_color_two">{{__('Site Black Theme')}}</label>
                                <input type="text" name="site_black_theme" style="background-color: {{get_static_option('site_black_theme')}};" class="form-control"
                                       value="{{get_static_option('site_black_theme')}}" id="site_black_theme">
                                <small class="form-text text-muted">{{__('you can change - site black theme- from here, it will replace the website black theme color')}}</small>
                            </div>

                            <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script src="{{asset('assets/backend/js/colorpicker.js')}}"></script>
    <script>
        (function($){
            "use strict";

            $(document).ready(function(){
                <x-icon-picker/>
                <x-btn.update/>
                initColorPicker('#site_main_color_one');
                initColorPicker('#site_main_color_two');
                initColorPicker('#site_heading_color');
                initColorPicker('#site_paragraph_color');
                initColorPicker('#site_light_color_one');
                initColorPicker('#site_light_color_two');
                initColorPicker('#site_black_theme');

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

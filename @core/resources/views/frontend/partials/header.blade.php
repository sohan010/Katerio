<!DOCTYPE html>
<html lang="{{get_user_lang()}}" dir="{{get_user_lang_direction()}}">

<head>
   @if(!empty(get_static_option('site_google_analytics')))
        {!! get_static_option('site_google_analytics') !!}
    @endif
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {!! render_favicon_by_id(get_static_option('site_favicon')) !!}
    {!! load_google_fonts() !!}

       <link rel="stylesheet" href="{{asset('assets/frontend/css/bootstrap.min-v4.6.0.css')}}">
       <link rel="stylesheet" href="{{asset('assets/frontend/css/line-awesome.min-v1.0.3.css')}}">
       <link rel="stylesheet" href="{{asset('assets/frontend/css/slick.min.css')}}">
       <link rel="stylesheet" href="{{asset('assets/frontend/css/magnific-popup.css')}}">
       <link rel="stylesheet" href="{{asset('assets/frontend/css/main-style.css')}}">
       <link rel="stylesheet" href="{{asset('assets/frontend/css/helpers.css')}}">
       <link rel="stylesheet" href="{{asset('assets/frontend/css/responsive.css')}}">
       <link rel="stylesheet" href="{{asset('assets/frontend/css/dynamic-style.css')}}">

    {{-- Dark Mode--}}
    @if(get_static_option('site_frontend_dark_mode') === 'on')
        <link rel="stylesheet" href="{{asset('assets/frontend/css/dark.css')}}">
    @endif
       @if(!empty(get_static_option('site_rtl_enabled')) || get_user_lang_direction() === 'rtl')
           <link rel="stylesheet" href="{{asset('assets/frontend/css/rtl.css')}}">
       @endif

    <link rel="canonical" href="{{request()->url()}}" />
    <script src="{{asset('assets/common/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/common/js/jquery-migrate-3.3.2.min.js')}}"></script>

    {{--Google Add Sense Script--}}
       @if(get_static_option('google_adsense_publisher_id'))
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{get_static_option('google_adsense_publisher_id')}}" crossorigin="anonymous"></script>
       @endif


    @include('frontend.partials.root-style')
    @yield('style')


    @if(request()->routeIs('homepage'))
        <title>{{get_static_option('site_'.$user_select_lang_slug.'_title')}} - {{get_static_option('site_'.$user_select_lang_slug.'_tag_line')}}</title>

           {!! render_site_meta() !!}

     @elseif( request()->routeIs('frontend.dynamic.page'))
           {!! render_site_title($page_post->title) !!}
           {!! render_site_meta() !!}

    @else
        @yield('page-meta-data')
    @endif


</head>

<body class="black-theme">

@include('frontend.partials.navbar')


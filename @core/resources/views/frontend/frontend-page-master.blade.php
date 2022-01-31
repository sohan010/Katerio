@include('frontend.partials.header')

@php
    $custom_class = request()->routeIs('frontend.blog.single') ? 'container-two' : '';
@endphp

<div class="breadcrumb-area
@if(
    (in_array(request()->route()->getName(),['homepage','frontend.dynamic.page'])
    && empty($page_post->breadcrumb_status) )
    &&  request()->path() !== get_page_slug(get_static_option('blog_page'),'blog')
    )
        d-none
@endif
">

<div class=" container {{$page_post->widget_style ?? ''}} {{$custom_class}}">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <div class="content">
                       <h3 class="title">{!! $page_post->title ?? ''!!} @yield('custom-page-title') </h3>
                        <ul class="page-list">
                            <li class="list-item"><a href="{{url('/')}}">{{ __('Home') }}</a></li>
                            @if(Route::currentRouteName() === 'frontend.dynamic.page' &&  request()->path() !== get_page_slug(get_static_option('blog_page'),'blog'))
                                <li class="list-item"><a href="#">{!! $page_post->title !!}</a></li>
                            @else
                                @yield('page-title')
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@yield('content')
@include('frontend.partials.footer')


@include('frontend.partials.header')

@php
    $custom_class = request()->routeIs('frontend.blog.single') ? 'container-two' : '';
@endphp
<div class="breadcrumb-area
@if(request()->routeIs('homepage') || request()->routeIs('frontend.dynamic.page')  &&  empty($page_post->breadcrumb_status))
    d-none
@endif
"
>
 <div class="inner-menu-area">
    <div class="container {{$page_post->widget_style ?? ''}} {{$custom_class}} ">
        <div class="inner-menu-list">
            <ul>
                <li><a href="{{url('/')}}">{{__('Home')}}</a></li>
                  <li>@yield('page-title')</li>
            </ul>
        </div>

    </div>
</div>
</div>


@yield('content')
@include('frontend.partials.footer')


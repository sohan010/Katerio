@php
    $dt = \Illuminate\Support\Carbon::now()->format('l, d M Y');;
    $container = request()->is('/') || request()->is('blog-grid') || request()->is('home-page-one') || request()->routeIs('frontend.blog.single')
    || request()->is('blog-7')  ?  'container-two' : '';
@endphp

<div class="topbar-area">
    <div class="container {{$container}}">
        <div class="row align-items-center">
            @if(request()->routeIs('homepage') || request()->is('home-page-one') || request()->is('blog-grid') || request()->routeIs('frontend.blog.single') || request()->is('blog-7'))
                 @include('frontend.partials.pages-portion.topbar-content.home-one')
            @else
                  @include('frontend.partials.pages-portion.topbar-content.other-pages')
            @endif
        </div>
    </div>
</div>


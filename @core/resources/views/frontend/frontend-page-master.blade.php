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
<div class=" container {{$page_post->widget_style ?? ''}} {{$custom_class}}">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <div class="content">
                        <h3 class="title">{{$page_post->title ?? __('No Title')}}</h3>
                        @php
                              $page_info = request()->url();
                              $str = explode("/",request()->url());
                              $page_info = $str[count($str)-1];
                              $slug = get_page_slug_two($page_info) ?? '';
                        @endphp
                        <ul class="page-list">
                            <li class="list-item"><a href="{{url('/')}}">{{__('Home')}}</a></li>
                            <li class="list-item"><a href="{{route('frontend.dynamic.page',$slug->slug)}}">@yield('page-title')</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@yield('content')
@include('frontend.partials.footer')


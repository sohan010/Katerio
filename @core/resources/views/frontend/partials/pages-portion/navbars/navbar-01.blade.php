@php
    $container = request()->is('/') || request()->is('home-page-one') || request()->is('blog-grid') || request()->routeIs('frontend.blog.single') || request()->is('blog-7')   ?  'container-two' : '';
@endphp

<header class="header-style-01">
@include('frontend.partials.support')
    <div class="search-area">

        <nav class="navbar navbar-area navbar-expand-lg navbar-border">
            <div class="container {{$container}} nav-container">
                <div class="responsive-mobile-menu">
                    <div class="logo-wrapper mobile-logo">
                        <a href="{{url('/')}}" class="logo">
                            @if(get_static_option('site_frontend_dark_mode') == 'on')
                                {!! render_image_markup_by_attachment_id(get_static_option('site_white_logo')) !!}
                            @else
                                {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
                            @endif
                        </a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizcoxx_main_menu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
                @if( !request()->is('home-page-one') && !request()->routeIs('homepage'))
                    <div class="nav-left-content">
                        <ul>
                            <li>
                                <a href="#0">
                                    <div class="info-bar-item">
                                        <div class="sidebars-item">
                                            <i class="las la-bars"></i>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                  @endif
                    <ul class="navbar-nav">
                        {!! render_frontend_menu($primary_menu) !!}
                    </ul>
                </div>

                <div class="nav-right-content">
                    <ul>

                        <li>
                            <a href="#">
                                <div class="info-bar-item">
                                    <div class="search-open">
                                        <i class="las la-search"></i>
                                    </div>
                                    @if(request()->routeIs('homepage') || request()->is('home-page-one'))
                                    <div class="sidebars-item">
                                        <i class="las la-bars"></i>
                                    </div>
                                     @endif
                                </div>
                            </a>
                        </li>


                    </ul>
                </div>
            </div>
        </nav>

        @include('frontend.partials.left-bar')

        <div class="search-bar">
            <form class="menu-search-form" action="{{ route('frontend.blog.search') }}">
                @csrf
                <div class="search-close"> <i class="las la-times"></i> </div>
                <input class="item-search" type="text" id="search" name="search" placeholder="Search Here.....">
                <button type="submit"> {{__('Search Now')}} </button>
                <div class="ajax-preloader-wrap"></div>
            </form>
        </div>

        <a href="{{ route('frontend.blog.get.search') }}" data-url="{{ route('frontend.blog.get.search') }}"
           id="tag_view_all"><i class="las la-external-link-alt"></i> </a>
        <li class="account">
            <div id="show-autocomplete" style="display:none;">
                <ul class="autocomplete-warp"></ul>
            </div>
        </li>
    </div>
</header>














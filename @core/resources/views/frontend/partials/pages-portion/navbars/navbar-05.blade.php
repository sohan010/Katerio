@include('frontend.partials.support')

<div class="supportbar-area-wrapper index-05">
    <div class="container custom-container-01">
        <div class="row">
            <div class="col-lg-2">
                <div class="logo-wrapper">
                    <a href="{{url('/')}}">
                        {!! render_image_markup_by_attachment_id(get_static_option('site_logo_two')) !!}
                    </a>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="content">
                    <div class="support-bar-search-box style-01">
                        <form action="{{ route('frontend.blog.search') }}">
                            <div class="form-group">
                                <input type="text" name="search" id="search" class="form-control" placeholder="Search">
                                <button type="submit" class="search-btn">
                                    <i class="las la-search icon"></i>
                                </button>
                            </div>
                            @include('frontend.partials.pages-portion.navbars.autocomplete-markup')
                        </form>
                    </div>
                    <div class="add-box">
                        <img src="{{asset('assets/frontend/img/ads-banner/supportbar/01.jpg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="nav-main-wrap-for-custom-style-01 index-05">
    <nav class="navbar navbar-area navbar-expand-lg has-topbar nav-style-01 custom-style-01 dark-bg-01">
        <div class="container nav-container custom-container-01">
            <div class="responsive-mobile-menu">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizcoxx_main_menu"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
                <!-- hamburger area start -->
                <div class="hamburger-menu-wrapper left-side">
                    <button class="w3-button w3-teal w3-xlarge" onclick="w3_open()">☰</button>
                </div>
                <!-- hamburger area end -->
                <ul class="navbar-nav">
                    {!! render_frontend_menu($primary_menu) !!}
                </ul>
            </div>
            <div class="nav-right-content">
                @php
                    $date = \Illuminate\Support\Carbon::now()->format('l, d M Y');
                @endphp
                <div class="date-and-time">
                    <span class="day">{{$date}}</span>
                </div>
            </div>
        </div>
    </nav>
</div>

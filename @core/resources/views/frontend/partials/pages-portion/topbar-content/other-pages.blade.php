<div class="col-lg-4 col-sm-5">
    <div class="topbar-right-contents other-page-date">
        <h6 class="dates">{{$dt}}</h6>
    </div>
</div>
<div class="col-lg-4 col-sm-2">
    <div class="topbar-logo desktop-logo">
        @if(request()->routeIs('homepage'))
            <a href="{{url('/')}}">
                @if(get_static_option('site_frontend_dark_mode') == 'on')
                    {!! render_image_markup_by_attachment_id(get_static_option('site_white_logo')) !!}
                @else
                    {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
                @endif
            </a>
        @else
            <a href="{{url('/')}}">
                @if(get_static_option('site_frontend_dark_mode') == 'on')
                    {!! render_image_markup_by_attachment_id(get_static_option('site_white_logo')) !!}
                @else
                    {!! render_image_markup_by_attachment_id(get_static_option('site_logo_two')) !!}
                @endif
            </a>
        @endif
    </div>
</div>
<div class="col-lg-4 col-sm-5">

    <div class="topbar-socials other-page-social">
        <ul>
            @foreach($all_social_icons as $key=> $data)
                <li> <a href="{{$data->url}}"><i class="{{$data->icon}}"></i></a></li>
            @endforeach
        </ul>
    </div>

    <div class="right-contnet">
        <ul class="info-items">


            @if(auth()->check())
                @php
                    $route = auth()->guest() == 'admin' ? route('admin.home') : route('user.home');
                @endphp
                <li><a href="{{$route}}">{{__('Dashboard')}}</a>  <span>/</span>
                    <a href="{{ route('frontend.user.logout') }}">
                        {{ __('Logout') }}
                    </a>

                    <form id="userlogout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                        @csrf
                        <input type="submit" value="aa" id="userlogout-form" class="d-none">
                    </form>
                </li>
            @else
                <li class="log-btn">
                    <a href="{{route('user.login')}}">{{__('Login')}}</a>
                    <span>|</span>
                    <a href="{{route('user.register')}}">{{__('Register')}}</a>
                </li>
            @endif

            @if(!empty(get_static_option('language_select_option')))
                <li>
                    <select id="langchange">
                        @foreach($all_language as $lang)
                            @php
                                $lang_name = explode('(',$lang->name);
                                $data = array_shift($lang_name);
                            @endphp
                            <option @if(get_user_lang() == $lang->slug) selected @endif value="{{$lang->slug}}">{{$data}}</option>
                        @endforeach
                    </select>
                </li>
            @endif

            <li>
                <label class="switch yes">
                    <input id="frontend_darkmode" type="checkbox" data-mode={{ get_static_option('site_frontend_dark_mode') }} @if(get_static_option('site_frontend_dark_mode') == 'on') checked @else @endif>
                    <span class="slider-color-mode onff"></span>
                </label>
            </li>

        </ul>
    </div>
</div>



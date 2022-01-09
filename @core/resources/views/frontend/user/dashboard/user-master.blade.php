@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('User Dashboard')}}
@endsection
@section('content')
    <section class="login-page-wrapper page-padding">
        <div class="container container-two">
            <div class="row">
                <div class="col-lg-12 mt-4">
                    <div class="user-dashboard-wrapper">
                        <div class="mobile_nav mobile-nav-click">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <ul class="nav nav-pills nav-pills-open mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <div class="user-photo">
                                   <div class="info">
                                       {!! render_image_markup_by_attachment_id(Auth::guard('web')->user()->image ?? get_static_option('single_blog_page_comment_avatar_image')) !!}
                                       <p>{{Auth::guard('web')->user()->name}}</p>
                                   </div>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs('user.home')) active @endif" href="{{route('user.home')}}">{{__('Dashboard')}}</a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs('user.blog') || request()->routeIs('user.blog.new') || request()->routeIs('user.blog.edit')) active @endif " href="{{route('user.blog')}}">{{__('All Posts')}}</a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs('user.home.edit.profile')) active @endif " href="{{route('user.home.edit.profile')}}">{{__('Edit Profile')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs('user.home.change.password')) active @endif " href="{{route('user.home.change.password')}}">{{__('Change Password')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.logout') }}" onclick="event.preventDefault();
                                    jQuery('#userlogout-form-submit-btn').trigger('click');">
                                    {{ __('Logout') }}
                                </a>
                                <form id="userlogout-form" action="{{ route('user.logout') }}" method="POST"
                                      class="d-none">
                                    @csrf
                                    <input type="submit" value="dd" id="userlogout-form-submit-btn" class="d-none">
                                </form>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel">
                                <div class="message-show ml-3">
                                  <x-msg.success/>
                                  <x-msg.error/>
                                </div>
                                @yield('section')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')



@endsection
@if(get_footer_style())
@include('frontend.partials.pages-portion.footers.footer-'.get_footer_style())
@else
    @include('frontend.partials.pages-portion.footers.footer-03')
@endif

<div class="back-to-top">
    <span class="back-top"><i class="las la-angle-up"></i></span>
</div>

@if(get_static_option('site_loader_animation'))
    <div class="preloader" id="preloader">
        <div class="preloader-inner">
            <div class="loader">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
@endif

@if(preg_match('/(bytesed)/',url('/')))
<div class="buy-now-wrap">
    <ul class="buy-list">
        <li><a target="_blank" href="https://bytesed.com/docs-category/intoday-new-magazine-php-laravel-scripts/" data-container="body" data-toggle="popover" data-placement="left" data-content="Documentation"><i class="las la-file-alt"></i></a></li>
        <li><a target="_blank" href="https://codecanyon.net/checkout/from_item/35217402?license=regular&aid=byteseed&aso=xgenius-website&aca=purchase-btn-click"><i class="las la-shopping-cart"></i></a></li>
        <li><a target="_blank" href="https://xgenious51.freshdesk.com/"><i class="las la-headset"></i></a></li>
    </ul>
</div>
@endif


<script src="{{asset('assets/common/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/common/js/jquery-migrate-3.3.2.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/jquery.magnific-popup.js')}}"></script>
<script src="{{asset('assets/frontend/js/wow.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/slick.js')}}"></script>
<script src="{{asset('assets/backend/js/sweetalert2.js')}}"></script>
<script src="{{asset('assets/frontend/js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/main.js')}}"></script>



@if(!empty(get_static_option('site_google_captcha_v3_site_key')) && (request()->routeIs('homepage.demo')) || request()->routeIs('homepage') )
    <script src="https://www.google.com/recaptcha/api.js?render={{get_static_option('site_google_captcha_v3_site_key')}}"></script>
    <script>
        (function() {
            "use strict";
            grecaptcha.ready(function () {
                grecaptcha.execute("{{get_static_option('site_google_captcha_v3_site_key')}}", {action: 'homepage'}).then(function (token) {
                    if(document.getElementById('gcaptcha_token') != null){
                        document.getElementById('gcaptcha_token').value = token;
                    }
                });
            });

        })(jQuery);
    </script>

@endif
    @php $twak__api = get_static_option('site_third_party_tracking_code'); @endphp
    @if(!empty($twak__api))
        {!! $twak__api !!}
    @endif

<script>
    $('[data-toggle="tooltip"]').tooltip({'placement': 'top','color':'green'});
</script>

@yield('scripts')
    @include('frontend.partials.inline-scripts')

</body>
</html>

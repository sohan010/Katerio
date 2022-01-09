
<footer class="footer-area">
    <div class="footer-top footer-bg padding-top-100 padding-bottom-70 footer_custom_background_color">
        <div class="container container-two">
            <div class="row">
                {!! render_frontend_sidebar('footer_one',['column' => true]) !!}
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="copyright-area">
            <div class="container custom-container-1515">
                <div class="row justify-content-center">
                    {!! purify_html_raw(get_footer_copyright_text()) !!}
                </div>
            </div>
        </div>
    </div>
</footer>

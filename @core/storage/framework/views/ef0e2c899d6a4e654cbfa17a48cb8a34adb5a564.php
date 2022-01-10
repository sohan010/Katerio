<?php echo $__env->make('frontend.partials.support', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- nav area start -->
<div class="nav-main-wrap-for-custom-style-02-v-02">
    <nav class="navbar navbar-area navbar-expand-lg has-topbar nav-style-01 custom-style-02 v-02 dark-bg-01">
        <div class="container nav-container custom-container-01">
            <div class="responsive-mobile-menu">
                <div class="logo-wrapper">
                    <a href="index.html" class="logo">
                        <img src="assets/img/logo/01.png" alt="logo">
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizcoxx_main_menu"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
                <ul class="navbar-nav">
                    <li class="menu-item-has-children current-menu-item">
                        <a href="#">Home</a>
                        <ul class="sub-menu">
                            <li><a href="index.html">Home 01</a></li>
                            <li><a href="index-02.html">Home 02</a></li>
                            <li><a href="index-03.html">Home 03</a></li>
                            <li><a href="index-04.html">Home 04</a></li>
                            <li><a href="index-05.html">Home 05</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="#">blog</a>
                        <ul class="sub-menu">
                            <li><a href="blog-three-column.html">blog three column</a></li>
                            <li><a href="blog-two-column-right-sidebar.html">blog two column with right sidebar</a>
                            </li>
                            <li><a href="blog-list-right-sidebar.html">blog list with right sidebar</a></li>
                            <li><a href="blog-standard-right-sidebar.html">blog standard right sidebar</a></li>
                            <li><a href="blog-grid-full.html">blog grid full</a></li>
                            <li><a href="blog-details-left-sidebar.html">blog details with left sidebar</a></li>
                            <li><a href="blog-details-right-sidebar.html">blog details with right sidebar</a></li>
                            <li><a href="blog-details-02.html">blog details tow</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="#">pages</a>
                        <ul class="sub-menu">
                            <li><a href="author.html">author</a></li>
                            <li><a href="author-profile.html">author profile</a></li>
                            <li><a href="about-us.html">about us</a></li>
                            <li><a href="faq.html">faq</a></li>
                            <li><a href="search.html">search</a></li>
                            <li><a href="sign-in.html">sign in</a></li>
                            <li><a href="sign-up.html">sign Up</a></li>
                            <li><a href="404.html">error</a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="video.html">video</a>
                    </li>
                    <li><a href="contact-us.html">contact us</a></li>
                </ul>
            </div>
            <div class="nav-right-content v-02">
                <div class="search position-relative">
                    <div class="search-open">
                        <i class="las la-search icon"></i>
                    </div>

                    <div class="search-bar">
                        <form class="menu-search-form" action="#">
                            <div class="search-close"> <i class="las la-times"></i> </div>
                            <input class="item-search" type="text" placeholder="Search Here.....">
                            <button type="submit"> Search</button>
                        </form>
                    </div>
                </div>
                <!-- hamburger area start -->
                <div class="hamburger-menu-wrapper right-side">
                    <button class="w3-button w3-teal w3-xlarge" onclick="w3_open()">☰</button>
                </div>
                <!-- hamburger area end -->
            </div>
        </div>
    </nav>
</div>
<!-- navbar area end -->
<?php /**PATH D:\laragon\www\katerio\@core\resources\views/frontend/partials/pages-portion/navbars/navbar-03.blade.php ENDPATH**/ ?>
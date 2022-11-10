<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ fetch(title_for_layout) }} : {{store_name}}</title>
    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{cdn_root}}images/favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{cdn_root}}images/favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{cdn_root}}images/favicons/favicon-16x16.png" />
    <link rel="manifest" href="{{cdn_root}}images/favicons/site.webmanifest" />
    <meta name="description" content="{{store_name}} ecommerce" />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Homemade+Apple&family=Abril+Fatface&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />


    <link rel="stylesheet" href="{{cdn_root}}vendors/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="{{cdn_root}}vendors/bootstrap-select/bootstrap-select.min.css" />
    <link rel="stylesheet" href="{{cdn_root}}vendors/animate/animate.min.css" />
    <link rel="stylesheet" href="{{cdn_root}}vendors/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="{{cdn_root}}vendors/jarallax/jarallax.css" />
    <link rel="stylesheet" href="{{cdn_root}}vendors/organik-icon/organik-icons.css" />
    <link rel="stylesheet" href="{{cdn_root}}vendors/jquery-magnific-popup/jquery.magnific-popup.css" />
    <link rel="stylesheet" href="{{cdn_root}}vendors/nouislider/nouislider.min.css" />
    <link rel="stylesheet" href="{{cdn_root}}vendors/nouislider/nouislider.pips.css" />
    <link rel="stylesheet" href="{{cdn_root}}vendors/odometer/odometer.min.css" />
    <link rel="stylesheet" href="{{cdn_root}}vendors/swiper/swiper.min.css" />
    <link rel="stylesheet" href="{{cdn_root}}vendors/tiny-slider/tiny-slider.min.css" />

    <!-- template styles -->
    <link rel="stylesheet" href="{{cdn_root}}css/organik.css" />
    <style type="text/css">
        .add_review_rating i,
        .product_detail_review i {
            color: var(--thm-base);
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="preloader">
        <img class="preloader__image" width="55" src="{{cdn_root}}images/loader.png" alt="" />
    </div>
    <!-- /.preloader -->
    <div class="page-wrapper">
        <header class="main-header">
            <div class="topbar">
                <div class="container">
                    <div class="main-logo">
                        <a href="/" class="logo">
                            <img src="{{Shop.logo()}}" width="105" alt="">
                        </a>
                        <div class="mobile-nav__buttons">
                            <a href="#" class="search-toggler"><i class="organik-icon-magnifying-glass"></i></a>
                            <a href="#" class="mini-cart__toggler"><i class="organik-icon-shopping-cart"></i></a>
                        </div><!-- /.mobile__buttons -->

                        <span class="fa fa-bars mobile-nav__toggler"></span>
                    </div><!-- /.main-logo -->

                    <div class="topbar__left">
                        <div class="topbar__social">
                            <a href="#" class="fab fa-twitter"></a>
                            <a href="#" class="fab fa-facebook-square"></a>
                            <a href="#" class="fab fa-instagram"></a>
                        </div><!-- /.topbar__social -->
                        <div class="topbar__info">
                            <i class="organik-icon-email"></i>
                            <p>Email <a href="mailto:info@clcknshop.com">info@clcknshop.com</a></p>
                        </div><!-- /.topbar__info -->
                    </div><!-- /.topbar__left -->
                    <div class="topbar__right">
                        <div class="topbar__info">
                            <i class="organik-icon-calling"></i>
                            <p>Phone <a href="tel:+92-666-888-0000">01734936561</a></p>
                        </div><!-- /.topbar__info -->
                        <div class="topbar__buttons">
                            <a href="#" class="search-toggler"><i class="organik-icon-magnifying-glass"></i></a>
                            <a href="/cart" class=""><i class="organik-icon-shopping-cart"></i></a>
                            <!-- class="mini-cart__toggler" -->
                        </div><!-- /.topbar__buttons -->
                    </div><!-- /.topbar__left -->

                </div><!-- /.container -->
            </div><!-- /.topbar -->
            <nav class="main-menu">
                <div class="container">
                    <div class="main-menu__login">

                    </div><!-- /.main-menu__login -->
                    <ul class="main-menu__list">
                        <li class="dropdown" tpleach="Shop.asset_menu(top-menubar)" set="menu">
                            <a href="{{menu->href}}">{{menu->text}}</a>

                        </li>


                    </ul>
                    <div class="main-menu__language">
                        <a href="/login"><i class="organik-icon-user"></i>Login / Register</a>
                    </div><!-- /.main-menu__language -->
                </div><!-- /.container -->
            </nav>
            <!-- /.main-menu -->
        </header><!-- /.main-header -->
        {{ Flash.render() }}
        {{ content_for_layout }}

        <footer class="site-footer background-black-2">
            <img src="{{cdn_root}}images/shapes/footer-bg-1-1.png" alt="" class="site-footer__shape-1">
            <img src="{{cdn_root}}images/shapes/footer-bg-1-2.png" alt="" class="site-footer__shape-2">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-widget footer-widget__about-widget">
                            <a href="index.html" class="footer-widget__logo">
                                <img src="{{cdn_root}}images/logo-light.png" alt="" width="105" height="43">
                            </a>
                            <p class="thm-text-dark">Atiam rhoncus sit amet adip
                                scing sed ipsum. Lorem ipsum
                                dolor sit amet adipiscing <br>
                                sem neque.</p>
                        </div><!-- /.footer-widget -->
                    </div><!-- /.col-sm-12 col-md-6 -->
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-2">
                        <div class="footer-widget footer-widget__contact-widget">
                            <h3 class="footer-widget__title">Contact</h3><!-- /.footer-widget__title -->
                            <ul class="list-unstyled footer-widget__contact">
                                <li>
                                    <i class="fa fa-phone-square"></i>
                                    <a href="tel:666-888-0000">666 888 0000</a>
                                </li>
                                <li>
                                    <i class="fa fa-envelope"></i>
                                    <a href="mailto:info@company.com">info@company.com</a>
                                </li>
                                <li>
                                    <i class="fa fa-map-marker-alt"></i>
                                    <a href="#">66 top broklyn street.
                                        New York</a>
                                </li>
                            </ul><!-- /.list-unstyled footer-widget__contact -->
                        </div><!-- /.footer-widget -->
                    </div><!-- /.col-sm-12 col-md-6 col-lg-2 -->
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-2">
                        <div class="footer-widget footer-widget__links-widget">
                            <h3 class="footer-widget__title">Links</h3><!-- /.footer-widget__title -->
                            <ul class="list-unstyled footer-widget__links">
                                <li tpleach="Shop.asset_menu(footer-menu)" set="menu">
                                    <a href="{{menu->href}}">{{menu->text}}</a>
                                </li>

                            </ul><!-- /.list-unstyled footer-widget__contact -->
                        </div><!-- /.footer-widget -->
                    </div><!-- /.col-sm-12 col-md-6 col-lg-2 -->

                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-widget">
                            <h3 class="footer-widget__title">Newsletter</h3><!-- /.footer-widget__title -->
                            <form action="#" data-url="YOUR_MAILCHIMP_URL" class="mc-form">
                                <input type="email" name="EMAIL" id="mc-email" placeholder="Email Address">
                                <button type="submit">Subscribe</button>
                            </form>
                            <div class="mc-form__response"></div><!-- /.mc-form__response -->
                        </div><!-- /.footer-widget -->
                    </div><!-- /.col-sm-12 col-md-6 col-lg-2 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
            <div class="bottom-footer">
                <div class="container">
                    <hr>
                    <div class="inner-container text-center">
                        <div class="bottom-footer__social">
                            <a href="#" class="fab fa-twitter"></a>
                            <a href="#" class="fab fa-facebook-square"></a>
                            <a href="#" class="fab fa-instagram"></a>
                        </div><!-- /.bottom-footer__social -->
                        <p class="thm-text-dark">Â© Copyright <span class="dynamic-year"></span> by Company.com</p>
                    </div><!-- /.inner-container -->
                </div><!-- /.container -->
            </div><!-- /.bottom-footer -->
        </footer><!-- /.site-footer -->

    </div><!-- /.page-wrapper -->


    <div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>
        <!-- /.mobile-nav__overlay -->
        <div class="mobile-nav__content">
            <span class="mobile-nav__close mobile-nav__toggler"><i class="organik-icon-close"></i></span>

            <div class="logo-box">
                <a href="index.html" aria-label="logo image"><img src="{{cdn_root}}images/logo-light.png" width="155"
                        alt="" /></a>
            </div>
            <!-- /.logo-box -->
            <div class="mobile-nav__container"></div>
            <!-- /.mobile-nav__container -->

            <ul class="mobile-nav__contact list-unstyled">
                <li>
                    <i class="organik-icon-email"></i>
                    <a href="mailto:needhelp@organik.com">needhelp@organik.com</a>
                </li>
                <li>
                    <i class="organik-icon-calling"></i>
                    <a href="tel:666-888-0000">666 888 0000</a>
                </li>
            </ul><!-- /.mobile-nav__contact -->
            <div class="mobile-nav__top">
                <div class="mobile-nav__language">
                    <img src="{{cdn_root}}images/resources/flag-1-1.jpg" alt="">
                    <label class="sr-only" for="language-select">select language</label>
                    <!-- /#language-select.sr-only -->
                    <select class="selectpicker" id="language-select">
                        <option value="english">English</option>
                        <option value="arabic">Arabic</option>
                    </select>
                </div><!-- /.mobile-nav__language -->
                <div class="main-menu__login">
                    <a href="#"><i class="organik-icon-user"></i>Login / Register</a>
                </div><!-- /.main-menu__login -->
            </div><!-- /.mobile-nav__top -->



        </div>
        <!-- /.mobile-nav__content -->
    </div>
    <!-- /.mobile-nav__wrapper -->

    <div class="mini-cart" id="cart_ajax">

    </div><!-- /.cart-toggler -->

    <div class="search-popup">
        <div class="search-popup__overlay search-toggler"></div>
        <!-- /.search-popup__overlay -->
        <div class="search-popup__content">
            <form action="#">
                <label for="search" class="sr-only">search here</label><!-- /.sr-only -->
                <input type="text" id="search" placeholder="Search Here..." />
                <button type="submit" aria-label="search submit" class="thm-btn">
                    <i class="organik-icon-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <!-- /.search-popup__content -->
    </div>
    <!-- /.search-popup -->

    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>


    <script src="{{cdn_root}}vendors/jquery/jquery-3.5.1.min.js"></script>
    <script src="{{cdn_root}}vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="{{cdn_root}}vendors/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="{{cdn_root}}vendors/jarallax/jarallax.min.js"></script>
    <script src="{{cdn_root}}vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js"></script>
    <script src="{{cdn_root}}vendors/jquery-appear/jquery.appear.min.js"></script>
    <script src="{{cdn_root}}vendors/jquery-circle-progress/jquery.circle-progress.min.js"></script>
    <script src="{{cdn_root}}vendors/jquery-magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="{{cdn_root}}vendors/jquery-validate/jquery.validate.min.js"></script>
    <script src="{{cdn_root}}vendors/nouislider/nouislider.min.js"></script>
    <script src="{{cdn_root}}vendors/odometer/odometer.min.js"></script>
    <script src="{{cdn_root}}vendors/swiper/swiper.min.js"></script>
    <script src="{{cdn_root}}vendors/tiny-slider/tiny-slider.min.js"></script>
    <script src="{{cdn_root}}vendors/wnumb/wNumb.min.js"></script>
    <script src="{{cdn_root}}vendors/wow/wow.js"></script>
    <script src="{{cdn_root}}vendors/isotope/isotope.js"></script>
    <script src="{{cdn_root}}vendors/countdown/countdown.min.js"></script>
    <!-- template js -->
    <script src="{{cdn_root}}js/organik.js"></script>
    {{ Html.script(rating.min) }}
    {{ Html.script(frontend_common) }}

    <script>

        $(document).ready(function (e) {
            // loadCart();

        });

    </script>
</body>

</html>
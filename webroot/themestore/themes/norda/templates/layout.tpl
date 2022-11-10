<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
     <title> {{ fetch(title_for_layout) }} : {{store_name}}</title>
    <meta name="keywords" content="{{store_name}},ecommerce" />
    <meta name="description" content="{{store_name}} ecommerce ">
    <meta name="robots" content="noindex, follow" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{cdn_root}}images/favicon.png">
    <!-- All CSS is here
	============================================ -->
    <link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">
    <link rel="stylesheet" href="{{cdn_root}}css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="{{cdn_root}}css/vendor/signericafat.css">
    <link rel="stylesheet" href="{{cdn_root}}css/vendor/cerebrisans.css">
    <link rel="stylesheet" href="{{cdn_root}}css/vendor/simple-line-icons.css">
    <link rel="stylesheet" href="{{cdn_root}}css/vendor/elegant.css">
    <link rel="stylesheet" href="{{cdn_root}}css/vendor/linear-icon.css">
    <link rel="stylesheet" href="{{cdn_root}}css/plugins/nice-select.css">
    <link rel="stylesheet" href="{{cdn_root}}css/plugins/easyzoom.css">
    <link rel="stylesheet" href="{{cdn_root}}css/plugins/slick.css">
    <link rel="stylesheet" href="{{cdn_root}}css/plugins/animate.css">
    <link rel="stylesheet" href="{{cdn_root}}css/plugins/magnific-popup.css">
    <link rel="stylesheet" href="{{cdn_root}}css/plugins/jquery-ui.css">
    <link rel="stylesheet" href="{{cdn_root}}css/starrr.css">
    {{ Html.css(frontend_common.css)}}
    <link rel="stylesheet" href="{{cdn_root}}css/style.css">
    <base href="/">

    <style>
        #mini-cart-form .ph-item {
            height: 90px !important;
            direction: ltr;
            position: relative;
            display: flex;
            flex-wrap: wrap;
            padding: 20px 15px 15px;
            overflow: hidden;
            background-color: #fff;
            border: none;
            border-radius: 0;
        }


    </style>
</head>

<body>

    <div class="main-wrapper">
        <header class="header-area">
            <div class="header-large-device section-padding-2">

                <div class="header-bottom">
                    <div class="container-fluid">
                        <div class="border-bottom-6">
                            <div class="row align-items-center">
                                <div class="col-xl-2 col-lg-2">
                                    <div class="logo">
                                        <a href=""><img src="{{Shop.logo(images/logo.png)}}" alt="logo"></a>
                                    </div>
                                </div>
                                <div class="col-xl-8 col-lg-8">
                                    <div class="main-menu main-menu-padding-1 main-menu-lh-3 main-menu-hm4 main-menu-center">
                                        <nav>
                                            <ul>

                                                <li tpleach="Shop.asset_menu(navbar-menu)" set="menu"><a href="{{menu->href}}">{{menu->text}} </a>
                                                    <ul class="sub-menu-style" tplcheck="Shop.hasmenuchild($menu)" >
                                                        <li tpleach="menu->children" set="smenu"><a href="{{smenu->href}}">{{smenu->text}}</a></li>

                                                    </ul>

                                                </li>

                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-2">
                                    <div class="header-action header-action-flex header-action-mrg-right">
                                        <div class="same-style-2 header-search-1">
                                            <a class="search-toggle" href="#">
                                                <i class="icon-magnifier s-open"></i>
                                                <i class="icon_close s-close"></i>
                                            </a>
                                            <div class="search-wrap-1">
                                                <form action="collection/all" method="get">
                                                    <input name="q" placeholder="Search products…" type="text">
                                                    <button type="submit" class="button-search"><i class="icon-magnifier"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="same-style-2 same-style-2-font-inc">
                                            <a href="login"><i class="icon-user"></i></a>
                                        </div>

                                        <div class="same-style-2 same-style-2-font-inc header-cart">
                                            <a class="cart-active" href="#">
                                                <i class="icon-basket-loaded"></i><span id="mini-cart-no-items" class="pro-count black"> {{ Shop.cart_count() }} </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-small-device small-device-ptb-1 border-bottom-2">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <div class="mobile-logo">
                                <a href="">
                                    <img alt="" src="{{cdn_root}}images/logo/Clcknshop_demo-5.png">
                                </a>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="header-action header-action-flex">
                                <div class="same-style-2 same-style-2-font-inc">
                                    <a href="login"><i class="icon-user"></i></a>
                                </div>
                                <div class="same-style-2 same-style-2-font-inc header-cart">
                                    <a class="cart-active" href="#">
                                        <i class="icon-basket-loaded"></i><span class="pro-count black">02</span>
                                    </a>
                                </div>
                                <div class="same-style-2 main-menu-icon">
                                    <a class="mobile-header-button-active" href="#"><i class="icon-menu"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- mobile header start -->
        <div class="mobile-header-active mobile-header-wrapper-style">
            <div class="clickalbe-sidebar-wrap">
                <a class="sidebar-close"><i class="icon_close"></i></a>
                <div class="mobile-header-content-area">
                    <div class="header-offer-wrap-3 mobile-header-padding-border-4">
                        <p class="black">Free shipping worldwide for orders over $99 <a href="#">Learn More</a></p>
                    </div>
                    <div class="mobile-search mobile-header-padding-border-1">
                        <form class="search-form" action="#">
                            <input type="text" placeholder="Search here…">
                            <button class="button-search"><i class="icon-magnifier"></i></button>
                        </form>
                    </div>
                    <div class="mobile-menu-wrap mobile-header-padding-border-2">
                        <!-- mobile menu start -->
                        <nav>
                            <ul class="mobile-menu">
                                <li class="menu-item-has-children" tpleach="Shop.asset_menu(navbar-menu)" set="menu">
                                    <a href="{{menu->href}}">{{menu->text}}</a>
                                    <ul class="dropdown" tplcheck="Shop.hasmenuchild($menu)">
                                        <li tpleach="menu->children" set="smenu">
                                            <a href="{{smenu->href}}">{{smenu->text}}</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <!-- mobile menu end -->
                    </div>

                    <div class="mobile-contact-info mobile-header-padding-border-4">
                        <ul>
                            <li><i class="icon-phone "></i> (+612) 2531 5600</li>
                            <li><i class="icon-envelope-open "></i> norda@domain.com</li>
                            <li><i class="icon-home"></i> PO Box 1622 Colins Street West Australia</li>
                        </ul>
                    </div>
                    <div class="mobile-social-icon">
                        <a class="facebook" href="#"><i class="icon-social-facebook"></i></a>
                        <a class="twitter" href="#"><i class="icon-social-twitter"></i></a>
                        <a class="pinterest" href="#"><i class="icon-social-pinterest"></i></a>
                        <a class="instagram" href="#"><i class="icon-social-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- mini cart start -->
        <div class="sidebar-cart-active">
            <div class="sidebar-cart-all">
                <a class="cart-close" href="javascript:void(0)"><i class="icon_close"></i></a>
                <div class="cart-content" id="cart_ajax">
                </div>
            </div>
        </div>



        <div id="flash_message">  {{ Flash.render() }} </div>
        <div id="content" tplvar="content_for_layout">

        </div>

        <div class="subscribe-area pt-115 pb-115">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-5 col-md-5">
                                <div class="section-title">
                                    <h2>keep connected</h2>
                                    <p>Get updates by subscribe our weekly newsletter</p>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7">
                                <div class="subscribe-form">
                                    <form  class="validate subscribe-form-style" novalidate="" target="_blank" name="mc-embedded-subscribe-form" method="post" action="" tplform="newsletter">
                                        <div id="mc_embed_signup_scroll" class="mc-form">
                                            <input class="email" type="email" required="" placeholder="Enter your email address" name="email" value="">
                                            <div class="clear">
                                                <input id="mc-embedded-subscribe" class="button" type="submit" name="subscribe" value="Subscribe">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <footer class="footer-area pb-65">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="contact-info-wrap">
                            <div class="footer-logo">
                                <a href="#"><img src="{{Shop.logo()}}" alt="logo"></a>
                            </div>
                            <div class="single-contact-info">
                                <span>Our Location</span>
                                <p>869 General Village Apt. 645, Moorebury, USA</p>
                            </div>
                            <div class="single-contact-info">
                                <span>24/7 hotline:</span>
                                <p>(+99) 052 128 2399</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="footer-right-wrap">
                            <div class="footer-menu">
                                <nav>
                                    <ul>
                                        <li tpleach="Shop.asset_menu(footer-menu)" set="menu">
                                            <a href="{{ menu->href }}">{{menu->text}}</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="social-style-2 social-style-2-hover-black social-style-2-mrg">
                                <a href="#"><i class="social_twitter"></i></a>
                                <a href="#"><i class="social_facebook"></i></a>
                                <a href="#"><i class="social_googleplus"></i></a>
                                <a href="#"><i class="social_instagram"></i></a>
                                <a href="#"><i class="social_youtube"></i></a>
                            </div>
                            <div class="copyright">
                                <p>Copyright © 2021 Clcknshop | <a href="https://clcknshop.com">Built with <span>Norda</span> by Clcknshop</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>



        <!-- Modal -->

        <!-- Modal end -->
    </div>

    <!-- All JS is here
============================================ -->

    <script src="{{cdn_root}}js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="{{cdn_root}}js/vendor/jquery-3.5.1.min.js"></script>
    <script src="{{cdn_root}}js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="{{cdn_root}}js/vendor/bootstrap.bundle.min.js"></script>
    <script src="{{cdn_root}}js/plugins/slick.js"></script>
    <script src="{{cdn_root}}js/plugins/jquery.syotimer.min.js"></script>
    <script src="{{cdn_root}}js/plugins/jquery.instagramfeed.min.js"></script>
    <script src="{{cdn_root}}js/plugins/jquery.nice-select.min.js"></script>
    <script src="{{cdn_root}}js/plugins/wow.js"></script>
    <script src="{{cdn_root}}js/plugins/jquery-ui-touch-punch.js"></script>
    <script src="{{cdn_root}}js/plugins/jquery-ui.js"></script>
    <script src="{{cdn_root}}js/plugins/magnific-popup.js"></script>
    <script src="{{cdn_root}}js/plugins/sticky-sidebar.js"></script>
    <script src="{{cdn_root}}js/plugins/easyzoom.js"></script>
    <script src="{{cdn_root}}js/starrr.js"></script>
    <script src="{{cdn_root}}js/plugins/scrollup.js"></script>
    <script src="{{cdn_root}}js/main.js"></script>
    <script src="{{cdn_root}}js/plugins/ajax-mail.js"></script>

    {{ Html.script(frontend_common) }}
    <!-- Main JS -->



    <script>
        $(document).ready(function () {
            loadCart();

            if($("#ck-flash").length > 0){
                setTimeout(() => {
                    $("#ck-flash").remove();
                },3000);
            }

            var fill = '<i class="icon_star"></i>';
            var outline = ' <i class="icon_star gray"></i>';

            $(".review, .ck-review").each(function (index){
                var ratingHtml = '';
                var rating = $(this).attr('review');
                for (var i = 1; i <= 5; i++){
                    if (i <= parseInt(rating)) ratingHtml += fill;
                    else ratingHtml += outline;
                }

                $(this).html(ratingHtml);
            });




        })
    </script>

    <tpl tplvar="fetch(scriptbottom)" />
</body>

</html>

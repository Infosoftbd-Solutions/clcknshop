<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="author" content="clcknshop">  
    <meta name="robots" content="all">
    <title> {{ fetch(title_for_layout) }} : {{store_name}}</title>
    <meta name="keywords" content="{{store_name}},ecommerce" />
    <meta name="description" content="{{store_name}} ecommerce ">
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ cdn_root }}css/bootstrap.min.css">
    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ cdn_root }}css/main.css">
    <link rel="stylesheet" href="{{ cdn_root }}css/blue.css">
    <link rel="stylesheet" href="{{ cdn_root }}css/owl.carousel.css">
    <link rel="stylesheet" href="{{ cdn_root }}css/owl.transitions.css">
    <link rel="stylesheet" href="{{ cdn_root }}css/animate.min.css">
    <link rel="stylesheet" href="{{ cdn_root }}css/rateit.css">
    <link rel="stylesheet" href="{{ cdn_root }}css/bootstrap-select.min.css">
    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{ cdn_root }}css/font-awesome.css">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800'
        rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <style>
        #mc-horizontal-menu-collapse ul li:last-child {
            float: right;
        }

        @media screen and (min-width: 992px) {
            #category-menu .col-menu {
                right: -160px !important;
                top: 0px;
            }
        }

        .logo img {
            max-width: 230px !important;
        }
    </style>
</head>

<body class="cnt-home">
    <!-- ============================================== HEADER ============================================== -->
    <header class="header-style-1">
        <!-- ============================================== TOP MENU ============================================== -->
        <div class="top-bar animate-dropdown">
            <div class="container">
                <div class="header-top-inner">
                    <div class="cnt-account">
                        <ul class="list-unstyled">
                            <li tpleach="Shop.asset_menu(top-menubar)" set="topbar">
                                <a href="{{topbar->href}}"><i class="icon fa fa-heart"></i>{{topbar->text}}</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.cnt-account -->

                    <div class="clearfix"></div>
                </div>
                <!-- /.header-top-inner -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.header-top -->
        <!-- ============================================== TOP MENU : END ============================================== -->
        <div class="main-header">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                        <!-- ============================================================= LOGO ============================================================= -->
                        <div class="logo">
                            <a href="">
                                <img src="{{Shop.logo(images/logo.png)}}" alt="">
                            </a>
                        </div>
                        <!-- /.logo -->
                        <!-- ============================================================= LOGO : END ============================================================= -->
                    </div>
                    <!-- /.logo-holder -->
                    <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
                        <!-- /.contact-row -->
                        <!-- ============================================================= SEARCH AREA ============================================================= -->
                        <div class="search-area">
                            <form id="search" action="collection/all" method="get">
                                <div class="control-group">
                                    <input name="q" class="search-field" type="search" placeholder="Search here..." />
                                    <a class="search-button" href="#"
                                        onclick="document.getElementById('search').submit()"></a>
                                </div>
                            </form>
                        </div>
                        <!-- /.search-area -->
                        <!-- ============================================================= SEARCH AREA : END ============================================================= -->
                    </div>
                    <!-- /.top-search-holder -->
                    <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
                        <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
                        <div class="dropdown dropdown-cart" id="cart_ajax">

                        </div>
                        <!-- /.dropdown-cart -->
                        <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->
                    </div>
                    <!-- /.top-cart-row -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.main-header -->
        <!-- ============================================== NAVBAR ============================================== -->
        <div class="header-nav animate-dropdown">
            <div class="container">
                <div class="yamm navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse"
                            class="navbar-toggle collapsed" type="button">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="nav-bg-class">
                        <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                            <div class="nav-outer">
                                <ul class="nav navbar-nav">

                                    <li class="dropdown hidden-sm" tpleach="Shop.asset_menu(navbar-menu)" set="menu">
                                        <a href="{{menu->href}}">{{ menu->text }}</a>
                                    </li>


                                </ul>
                                <!-- /.navbar-nav -->
                                <div class="clearfix"></div>
                            </div>
                            <!-- /.nav-outer -->
                        </div>
                        <!-- /.navbar-collapse -->
                    </div>
                    <!-- /.nav-bg-class -->
                </div>
                <!-- /.navbar-default -->
            </div>
            <!-- /.container-class -->
        </div>
        <!-- /.header-nav -->
        <!-- ============================================== NAVBAR : END ============================================== -->
    </header>
    <!-- ============================================== HEADER : END ============================================== -->


    <!-- ===============Main Content ====================-->
    {{ Flash.render() }}
    {{ content_for_layout }}


    <!-- ============================================================= FOOTER ============================================================= -->
    <footer id="footer" class="footer color-bg">
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="module-heading">
                            <h4 class="module-title">Contact Us</h4>
                        </div>
                        <!-- /.module-heading -->
                        <div class="module-body">
                            <ul class="toggle-footer">
                                <li class="media">
                                    <div class="pull-left">
                                        <span class="icon fa-stack fa-lg">
                                            <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <p>ThemesGround, 789 Main rd, Anytown, CA 12345 USA</p>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="pull-left">
                                        <span class="icon fa-stack fa-lg">
                                            <i class="fa fa-mobile fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <p>+(888) 123-4567<br>+(888) 456-7890</p>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="pull-left">
                                        <span class="icon fa-stack fa-lg">
                                            <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <span><a href="#">flipmart@themesground.com</a></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- /.module-body -->
                    </div>


                    <!-- /.col -->
                    <div class="col-xs-12 col-sm-6 col-md-3" tpleach="Shop.asset_menu(footer-menu)" set="menu">
                        <div class="module-heading">
                            <h4 class="module-title">{{ menu->text }}</h4>
                        </div>
                        <!-- /.module-heading -->
                        <div tplcheck="Shop.hasmenuchild($menu)" class="module-body">
                            <ul class='list-unstyled'>
                                <li tpleach="menu->children" set="sub"><a href="{{sub->href}}"
                                        title="{{sub->text}}">{{sub->text}}</a></li>

                            </ul>
                        </div>
                        <!-- /.module-body -->
                    </div>
                    <!-- /.col -->
                </div>
            </div>
        </div>
        <div class="copyright-bar">
            <div class="container">
                <div class="col-xs-12 col-sm-6 no-padding social">
                    <ul class="link">
                        <li class="fb pull-left"><a target="_blank" rel="nofollow" href="#" title="Facebook"></a></li>
                        <li class="tw pull-left"><a target="_blank" rel="nofollow" href="#" title="Twitter"></a></li>
                        <li class="googleplus pull-left"><a target="_blank" rel="nofollow" href="#"
                                title="GooglePlus"></a></li>
                        <li class="rss pull-left"><a target="_blank" rel="nofollow" href="#" title="RSS"></a></li>
                        <li class="pintrest pull-left"><a target="_blank" rel="nofollow" href="#" title="PInterest"></a>
                        </li>
                        <li class="linkedin pull-left"><a target="_blank" rel="nofollow" href="#" title="Linkedin"></a>
                        </li>
                        <li class="youtube pull-left"><a target="_blank" rel="nofollow" href="#" title="Youtube"></a>
                        </li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-6 no-padding">
                    <div class="clearfix payment-methods">
                        <ul>
                            <li><img src="{{cdn_root}}images/payments/1.png" alt=""></li>
                            <li><img src="{{cdn_root}}images/payments/2.png" alt=""></li>
                            <li><img src="{{cdn_root}}images/payments/3.png" alt=""></li>
                            <li><img src="{{cdn_root}}images/payments/4.png" alt=""></li>
                            <li><img src="{{cdn_root}}images/payments/5.png" alt=""></li>
                        </ul>
                    </div>
                    <!-- /.payment-methods -->
                </div>
            </div>
        </div>
    </footer>
    <!-- ============================================================= FOOTER : END============================================================= -->
    <!-- For demo purposes – can be removed on production -->
    <!-- For demo purposes – can be removed on production : End -->
    <!-- JavaScripts placed at the end of the document so the pages load faster -->
    <script src="{{ cdn_root }}js/jquery-1.11.1.min.js"></script>
    <script src="{{ cdn_root }}js/bootstrap.min.js"></script>
    <script src="{{ cdn_root }}js/bootstrap-hover-dropdown.min.js"></script>
    <script src="{{ cdn_root }}js/owl.carousel.min.js"></script>
    <script src="{{ cdn_root }}js/echo.min.js"></script>
    <script src="{{ cdn_root }}js/jquery.easing-1.3.min.js"></script>
    <script src="{{ cdn_root }}js/bootstrap-slider.min.js"></script>
    <script src="{{ cdn_root }}js/jquery.rateit.min.js"></script>
    <script type="text/javascript" src="{{ cdn_root }}js/lightbox.min.js"></script>
    <script src="{{ cdn_root }}js/bootstrap-select.min.js"></script>
    <script src="{{ cdn_root }}js/wow.min.js"></script>
    <script src="{{ cdn_root }}js/scripts.js"></script>
    <!-- common JS File -->
    {{ Html.script(rating.min) }}
    {{ Html.script(frontend_common) }}


    <script>
        $(document).ready(function () {
            loadCart();
            if ($("#ck-flash").length > 0) {
                setTimeout(() => {
                    $("#ck-flash").hide();
                }, 3000);
            }
            $(".ck-flash-close").click(function (e) {
                $(this).closest("#ck-flash").hide();
            });

            $(document).on('click', '.option_selected', function (e) {
                var li = $(this).closest("ul").find('li');
                li.each(function (index) {
                    $(this).removeClass("active");
                })

                $(this).closest('li').addClass('active');
                event.preventDefault();
                $('#option_' + $(this).attr('data-name')).val($(this).attr('data-value'));
                $('#option_' + $(this).attr('data-name')).trigger('change');

            });

            $("#variant_id").change(function () {
                console.log($(this));
                $(this).addClass("d-none");
                console.log("selection option val", $(this).val());
                if ($(this).val() == 0) {
                    $('.add-cart').text("Sold out");
                } else {
                    var variantopj = JSON.parse($("#variant_id option:selected").attr("data-opt"));
                    $('.product-price').text("{{ Formats.moneySymbol() }}" + variantopj.price);
                    $('.add-cart').text("Add To Cart");
                }
            });


            $("#variant-form ul li").click(function () {
                $(this).parent().find('li').each(function () {
                    $(this).removeClass('active');
                });
                $(this).addClass('active');
            });


            /* $(".ck-rating").rating(
                 {
                     emptyStar: "fa fa-star-o",
                     halfStar: "fa fa-star-half",
                     filledStar: "fa fa-star",
 
                 }
             );*/
             
              $("[data-rating-stars]").each(function () {
                 $(this).rating(
                 {
                     emptyStar: "fa fa-star-o",
                     halfStar: "fa fa-star-half",
                     filledStar: "fa fa-star",
 
                 });
              });

        })
    </script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ fetch(title_for_layout) }} : {{store_name}}</title>

    <meta name="keywords" content="{{store_name}} ,ecommerce" />
    <meta name="description" content="{{store_name}} ecommerce">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{cdn_root}}images/icons/favicon.ico">

    <script>
        WebFontConfig = {
            google: { families: [ 'Open+Sans:300,400,500,600,700,800','Poppins:300,400,500,600,700' ] }
        };
        (function(d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = '{{cdn_root}}js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{cdn_root}}css/bootstrap.min.css">
    <link rel="stylesheet" href="{{cdn_root}}css/animate.min.css">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{cdn_root}}css/style.min.css">
    <link rel="stylesheet" type="text/css" href="{{cdn_root}}vendor/fontawesome-free/css/all.min.css">
    <style>
        .header .social-icons a{
            border-radius: 50%;
        }
        #home-section-2 .grid{
            left: 2% !important;
        }
    </style>
</head>

<body>
<div class="page-wrapper">
    <div class="header-wrapper position-relative">
        <div class="header position-absolute">
            <div class="header-top">
                <div class="container d-flex">
                    <div class="social-icons">
                        <a href="#" class="social-icon social-instagram icon-instagram" target="_blank"></a>
                        <a href="#" class="social-icon social-twitter icon-twitter" target="_blank"></a>
                        <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"></a>

                    </div>

                    <div class="header-right header-dropdowns ml-0 ml-sm-auto">
                        <div class="header-dropdown dropdown-expanded">
                            <div class="header-menu">
                                <ul>
                                    <li><a href="/track-order">ORDER TRACKING</a></li>
                                    <li><a href="/customer">MY ACCOUNT </a></li>
                                    <li><a href="/login">LOGIN</a></li>
                                    <li><a href="/about-us">ABOUT US</a></li>
                                    <li><a href="/contact-us">CONTACT US</a></li>
                                    <li><a href="/faq">HELP & FAQ</a></li>

                                </ul>
                            </div><!-- End .header-menu -->
                        </div><!-- End .header-dropown -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-top -->

            <div class="header-middle sticky-header">
                <div class="container d-flex">
                    <div class="header-left">
                        <button class="mobile-menu-toggler" type="button">
                            <i class="icon-menu"></i>
                        </button>

                        <a href="/" class="logo">
                            <img src="{{Shop.logo()}}" alt="Porto Logo" height="64px">
                        </a>

                        <nav class="main-nav font2">
                            <ul class="menu">
                                <li>
                                    <a href="/">Home</a>
                                </li>

                                <li tpleach="Shop.asset_menu(navbar-menu)" set="menu">
                                    <a href="{{menu->href}}">{{menu->text}}</a>
                                    <ul tplcheck="Shop.hasmenuchild($menu)">
                                        <li tpleach="menu->children" set="smenu">
                                            <a href="{{smenu->href}}">{{smenu->text}}</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>

                    </div><!-- End .header-left -->

                    <div class="header-right">
                        <a href="/login" class="header-icon"><i class="icon-user-2"></i></a>



                        <div class="header-search header-search-popup header-search-category d-none d-sm-block">
                            <a href="#" class="search-toggle header-icon" role="button">
                                <i class="icon-search-3"></i>
                            </a>

                            <form action="collection/all" method="get">
                                <div class="header-search-wrapper">
                                    <input type="search" class="form-control bg-white" name="q" id="q" placeholder="Search..." required="">

                                    <button class="btn icon-search-3 bg-white" type="submit"></button>
                                </div><!-- End .header-search-wrapper -->
                            </form>
                        </div>

                        <div class="dropdown cart-dropdown" id="cart_ajax">

                        </div><!-- End .dropdown -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->
        </div><!-- End .header -->
    </div>

    {{ Flash.render() }}
    {{ content_for_layout }}


    <footer class="footer bg-dark">
        <div class="footer-middle">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget">
                            <h4 class="widget-title">Contact Info</h4>
                            <ul class="contact-info">
                                <li>
                                    <span class="contact-info-label">Address:</span>1234 Street Name, City, US
                                </li>
                                <li>
                                    <span class="contact-info-label">Phone:</span><a href="tel:">(123) 456-7890</a>
                                </li>
                                <li>
                                    <span class="contact-info-label">Email:</span> <a href="mailto:mail@example.com">mail@example.com</a>
                                </li>
                                <li>
                                    <span class="contact-info-label">Working Days/Hours:</span>
                                    Mon - Sun / 9:00 AM - 8:00 PM
                                </li>
                            </ul>
                            <div class="social-icons">
                                <a href="#" class="social-icon social-facebook icon-facebook" target="_blank" title="Facebook"></a>
                                <a href="#" class="social-icon social-twitter icon-twitter" target="_blank" title="Twitter"></a>
                                <a href="#" class="social-icon social-instagram icon-instagram" target="_blank" title="Instagram"></a>
                            </div><!-- End .social-icons -->
                        </div><!-- End .widget -->
                    </div><!-- End .col-lg-3 -->

                    <div class="col-lg-3 col-sm-6">
                        <div class="widget">
                            <h4 class="widget-title">Customer Service</h4>

                            <ul class="links">
                                <li tpleach="Shop.asset_menu(footer-menu)" set="fmenu">
                                    <a href="{{fmenu->href}}">{{fmenu->text}}</a>
                                </li>
                            </ul>
                        </div><!-- End .widget -->
                    </div><!-- End .col-lg-3 -->

                    <div class="col-lg-3 col-sm-6">
                        <div class="widget">
                            <h4 class="widget-title tag-widget-title">Popular Tags</h4>

                            <div class="tagcloud">
                                <a href="/collection/all?tag=clothes">Clothes</a>
                                <a href="/collection/all?tag=fashion">Fashion</a>
                                <a href="/collection/all?tag=hub">Hub</a>
                                <a href="/collection/all?tag=shirt">Shirt</a>
                                <a href="/collection/all?tag=skirt">Skirt</a>
                                <a href="/collection/all?tag=sports">Sports</a>
                                <a href="/collection/all?tag=sweater">Sweater</a>
                            </div>
                        </div><!-- End .widget -->
                    </div><!-- End .col-lg-3 -->

                    <div class="col-lg-3 col-sm-6">
                        <div class="widget widget-newsletter">
                            <h4 class="widget-title newsletter-title">Subscribe newsletter</h4>
                            <p>Get all the latest information on Events,<br>Sales and Offers. Sign up for newsletter today.</p>
                            <form action="#" class="mb-0" tplform="newsletter">
                                <input type="email" class="form-control m-b-3" placeholder="Email address" name="email" required>

                                <input type="submit" class="btn shadow-none" value="Subscribe">
                            </form>
                        </div><!-- End .widget -->
                    </div><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .footer-middle -->

        <div class="container">
            <div class="footer-bottom d-flex justify-content-between align-items-center flex-wrap">
                <p class="footer-copyright py-3 pr-4 mb-0">&copy; copyright 2020. All Rights Reserved.</p>

                <img src="{{cdn_root}}images/payments.png" alt="payment methods" class="footer-payments py-3">
            </div><!-- End .footer-bottom -->
        </div><!-- End .container -->
    </footer><!-- End .footer -->
</div><!-- End .page-wrapper -->

<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-cancel"></i></span>
        <nav class="mobile-nav">
            <ul class="mobile-menu">
                <li class="active"><a href="/">Home</a></li>

                <li tpleach="Shop.asset_menu(navbar-menu)" set="menu">
                    <a href="{{menu->href}}">{{menu->text}}</a>
                    <ul tplcheck="Shop.hasmenuchild($menu)">
                        <li tpleach="menu->children" set="smenu">
                            <a href="{{smenu->href}}">{{smenu->text}}</a>
                        </li>
                    </ul>
                </li>

                <li><a href="/login">LOG IN</a></li>
            </ul>
        </nav><!-- End .mobile-nav -->

        <div class="social-icons d-flex">
            <a href="#" class="social-icon mr-3" target="_blank"><i class="icon-facebook"></i></a>
            <a href="#" class="social-icon mr-3" target="_blank"><i class="icon-twitter"></i></a>
            <a href="#" class="social-icon" target="_blank"><i class="icon-instagram"></i></a>
        </div><!-- End .social-icons -->
    </div><!-- End .mobile-menu-wrapper -->
</div><!-- End .mobile-menu-container -->


<a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

<!-- Plugins JS File -->
<script src="{{cdn_root}}js/jquery.min.js"></script>
<script src="{{cdn_root}}js/bootstrap.bundle.min.js"></script>
<script src="{{cdn_root}}js/plugins.min.js"></script>
<script src="{{cdn_root}}js/optional/isotope.pkgd.min.js"></script>
<script src="{{cdn_root}}js/jquery.appear.min.js"></script>
<script src="{{cdn_root}}js/main.js"></script>

<!-- common JS File -->
{{ Html.script(frontend_common) }}
{{ Html.script(rating.min) }}
<script>

    $(document).ready(function (e) {
        loadCart();

        if($("#ck-flash").length > 0){
            setTimeout(() => {
                $(this).find('.mfp-close').click();
            },3000);
        }

        $(document).on('click', '.option_selected', function(e){
            var li = $(this).closest("ul").find('li');
            li.each(function (index) {
                $(this).removeClass("active");
            })

            $(this).closest('li').addClass('active');
            event.preventDefault();
            $('#option_' + $(this).attr('data-name')).val($(this).attr('data-value'));
            $('#option_' + $(this).attr('data-name')).trigger('change');

        });

        $("#variant_id").change(function(){
            console.log($(this));
            $(this).addClass("d-none");
            console.log("selection option val",$(this).val());
            if($(this).val() == 0){
                $('.add-cart').text("Sold out");
            }else {
                var variantopj = JSON.parse($( "#variant_id option:selected").attr("data-opt"));
                $('.product-price').text("{{ Formats.moneySymbol() }}" + variantopj.price);
                $('.add-cart').text("Add To Cart");
            }

        });


        $('#customer-signup').click(function() {
          if ($(this).is(':checked')) {
            $("#sign-up-btn").prop('disabled', false)
          }
          else{
            $("#sign-up-btn").prop('disabled', true)
          }
        });


    })
</script>

</body>

</html>
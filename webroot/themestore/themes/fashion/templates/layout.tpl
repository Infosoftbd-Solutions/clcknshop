<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title> {{ fetch(title_for_layout) }} : {{store_name}}</title>

    <meta name="keywords" content="{{store_name}},ecommerce" />
    <meta name="description" content="{{store_name}} ecommerce ">
    <meta name="author" content="clcknshop">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{cdn_root}}images/icons/favicon.ico">


    <script type="text/javascript">
        WebFontConfig = {
            google: { families: [ 'Open+Sans:300,400,600,700,800','Poppins:300,400,500,600,700,800' ] }
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

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{cdn_root}}css/style.css">
    <link rel="stylesheet" type="text/css" href="{{cdn_root}}vendor/fontawesome-free/css/all.min.css">
    {{ Html.css(frontend_common.css)}}
    <link rel="stylesheet" href="{{cdn_root}}css/custom.css">
<style type="text/css">
.header .logo {
    width: 150px !important;
}
</style>
</head>
<body>
<div class="page-wrapper">
    <header class="header">
        <div class="header-middle">
            <div class="container">
                <div class="header-left col-lg-2 w-auto pl-0">
                    <button class="mobile-menu-toggler text-primary mr-2" type="button">
                        <i class="icon-menu"></i>
                    </button>
                    <a href="" class="logo">
                        <img src="{{Shop.logo(images/logo.png)}}" alt="Fashion House">
                    </a>
                </div><!-- End .header-left -->

                <div class="header-right w-lg-max">
                    <div class="header-icon header-icon header-search header-search-inline header-search-category w-lg-max text-right">
                        <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                        <form action="collection/all" method="get">
                            <div class="header-search-wrapper">
                                <input type="search" class="form-control" name="q" id="q" placeholder="Search..." required>
                                <button class="btn icon-search-3 p-0" type="submit"></button>
                            </div><!-- End .header-search-wrapper -->
                        </form>
                    </div><!-- End .header-search -->

                    <div class="header-contact d-none d-lg-flex pl-4 ml-3 mr-xl-5 pr-4">
                        <img alt="phone" src="{{cdn_root}}images/phone.png" width="30" height="30" class="pb-1">
                        <h6>Call us now<a href="tel:#" class="text-dark font1">0176985477</a></h6>
                    </div>

                    <a href="login" class="header-icon"><i class="icon-user-2"></i></a>

                    <div class="dropdown cart-dropdown" id="cart_ajax">
                    </div><!-- End .dropdown -->
                </div><!-- End .header-right -->
            </div><!-- End .container -->
        </div><!-- End .header-middle -->

        <div class="header-bottom sticky-header d-none d-lg-block">
            <div class="container">
                <nav class="main-nav w-100">
                      <ul class="menu sf-js-enabled sf-arrows" style="touch-action: pan-y;">
                    							<li tpleach="Shop.asset_menu(navbar-menu)" set="menu">
                                    <a tplcheck="Shop.hasmenuchild($menu,0)"  href="{{menu->href}}">{{menu->text}}</a>

                    								<a tplcheck="Shop.hasmenuchild($menu)" class="sf-with-ul" href="{{menu->href}}">{{menu->text}}</a>

                                    <ul style="display: none;" tplcheck="Shop.hasmenuchild($menu)">
                                      <li tpleach="menu->children" set="smenu"><a href="{{smenu->href}}">{{smenu->text}}</a></li>
                                    </ul>

                              		</li>




                        <li class="float-right"><a href="page/contact-us" class="px-4">Contact Us</a></li>
                        <li class="float-right mr-0"><a href="page/about-us" class="px-4">About Us</a></li>
                    </ul>
                </nav>
            </div><!-- End .container -->
        </div><!-- End .header-bottom -->
    </header><!-- End .header -->

    {{ Flash.render() }}
    {{ content_for_layout }}

    <footer class="footer bg-dark">
        <div class="footer-middle">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget">
                            <h4 class="widget-title">Update Fashion House</h4>
                            <ul class="contact-info">
                                <li>
                                    <span class="contact-info-label">Address</span>House # 385,Road # 65,Sector # 14,Uttara,Dhaka-1230
                                </li>
                                <li>
                                    <span class="contact-info-label">Phone</span> <a href="tel:">+88018824845</a>
                                </li>
                                <li>
                                    <span class="contact-info-label">Email</span> <a href="mailto:mail@example.com">support@clcknshop.com</a>
                                </li>
                                <li>
                                    <span class="contact-info-label">Working Days/Hours</span>
                                    Friday - Friday / 8:00AM - 11.00 PM
                                </li>
                            </ul>
                            <div class="social-icons">
                                <a href="#" class="social-icon social-instagram icon-instagram" target="_blank" title="Instagram"></a>
                                <a href="#" class="social-icon social-twitter icon-twitter" target="_blank" title="Twitter"></a>
                                <a href="#" class="social-icon social-facebook icon-facebook" target="_blank" title="Facebook"></a>
                            </div><!-- End .social-icons -->
                        </div><!-- End .widget -->
                    </div><!-- End .col-lg-3 -->

                    <div class="col-lg-3 col-sm-6">
                        <div class="widget">
                            <h4 class="widget-title">Customer Service</h4>

                            <ul class="links">
                                <li tpleach="Shop.asset_menu(footer-menu)" set="menu"><a href="{{menu->href}}">{{menu->text}}</a></li>

                            </ul>
                        </div><!-- End .widget -->
                    </div><!-- End .col-lg-3 -->
                    <div class="col-lg-3 col-sm-6">
                      <h4 class="widget-title">My account</h4>

                      <ul class="links">
                          <li ><a href="/login">Signin</a></li>
                          <li ><a href="/register">Register</a></li>
                          <li ><a href="/track-order">Track order</a></li>
                          <li ><a href="/customer">Customer panel</a></li>

                      </ul>
                    </div><!-- End .col-lg-3 -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget">
                            <h4 class="widget-title">Popular Tags</h4>

                            <div class="tagcloud">
                                <a href="collection/bag">T-Shirt</a>
                                <a href="collection/black">Black</a>
                                <a href="collection/blue">Blue</a>
                                <a href="collection/cloth">Clothes</a>
                                <a href="collection/hub">Hub</a>
                                <a href="collection/shirt">Shirt</a>
                                <a href="collection/shoes">Shoes</a>
                                <a href="collection/skirt">Skirt</a>
                                <a href="collection/sport">Sports</a>
                                <a href="collection/sweater">Sweater</a>
                            </div>
                        </div><!-- End .widget -->
                    </div><!-- End .col-lg-3 -->


                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .footer-middle -->

        <div class="container">
            <div class="footer-bottom d-flex justify-content-between align-items-center flex-wrap">
                <p class="footer-copyright py-3 pr-4 mb-0">&copy;  Fashion House. 2021. All Rights Reserved</p>

                <img src="{{Shop.asset_image(payment-logo)}}" alt="payment methods" class="footer-payments py-3" >
            </div><!-- End .footer-bottom -->
        </div><!-- End .container -->
    </footer><!-- End .footer -->
</div><!-- End .page-wrapper -->

<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-cancel"></i></span>
        <nav class="mobile-nav">
            <ul class="mobile-menu mb-3">
                <!--<li class="active"><a href="">Home</a></li>-->


                <li tpleach="Shop.asset_menu(navbar-menu)" set="menu">
                    <a href="{{menu->href}}">{{menu->text}}</a>
                    <ul tplcheck="Shop.hasmenuchild($menu)" >
                       <li tpleach="menu->children" set="smenu"><a href="{{ smenu->href }}">{{ smenu->text }}</a></li>
                    </ul>
                </li>

                <li><a href="page/about-us">About Us</a></li>
                <li><a href="page/contact-us">Contact Us</a></li>

            </ul>
        </nav><!-- End .mobile-nav -->

        <div class="social-icons">
            <a href="#" class="social-icon" target="_blank"><i class="icon-facebook"></i></a>
            <a href="#" class="social-icon" target="_blank"><i class="icon-twitter"></i></a>
            <a href="#" class="social-icon" target="_blank"><i class="icon-instagram"></i></a>
        </div><!-- End .social-icons -->
    </div><!-- End .mobile-menu-wrapper -->
</div><!-- End .mobile-menu-container -->


<!-- Add Cart Modal -->
<div class="modal fade" id="addCartModal" tabindex="-1" role="dialog" aria-labelledby="addCartModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body add-cart-box text-center">
                <p>You've just added this product to the<br>cart:</p>
                <h4 id="productTitle"></h4>
                <img src="#" id="productImage" width="100" height="100" alt="adding cart image">
                <div class="btn-actions">
                    <a href="cart"><button class="btn-primary">Go to cart page</button></a>
                    <a href="#"><button class="btn-primary" data-dismiss="modal">Continue</button></a>
                </div>
            </div>
        </div>
    </div>
</div>

<a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

<!-- Plugins JS File -->
<script src="{{ cdn_root }}js/jquery.min.js"></script>
<script src="{{ cdn_root }}js/bootstrap.bundle.min.js"></script>
<script src="{{ cdn_root }}js/optional/isotope.pkgd.min.js"></script>
<script src="{{ cdn_root }}js/plugins.min.js"></script>

<script src="{{ cdn_root }}js/plugins/jquery.countTo.js"></script>


<script src="{{ cdn_root }}js/main.min.js"></script>

{{ Html.script(frontend_common) }}

<script>
    $(document).ready(function (e) {
        loadCart();

        if($("#ck-flash").length > 0){
            setTimeout(() => {
               $(this).find('.mfp-close').click();
            },3000);
        }


        // $('.option_selected').click(function(event){
        $(document).on('click', '.option_selected', function(e){
            console.log("selected");
            event.preventDefault();
// console.log('option_' + $(this).attr('data-name'));
// console.log($(this).attr('data-value'));
            $('#option_' + $(this).attr('data-name')).val($(this).attr('data-value'));
            $('#option_' + $(this).attr('data-name')).trigger('change');
// console.log("option val got",$('#option_' + $(this).attr('data-name')).val());

        });

        $("#variant_id").change(function(){


//if($(this).val)
            console.log("selection option val",$(this).val());
            if($(this).val() == 0){
                $('.add-cart').text("Sold out");
            }else {
                var variantopj = JSON.parse($( "#variant_id option:selected").attr("data-opt"));
                $('.product-price').text("{{ Formats.moneySymbol() }}" + variantopj.price);
                $('.add-cart').text("Add To Cart");
            }

        });
    })
</script>
</body>
</html>
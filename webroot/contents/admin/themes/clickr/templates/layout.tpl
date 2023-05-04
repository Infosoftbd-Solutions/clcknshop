<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Clcknshop is a SAAS based cloud ECommerce platform. Users can ceate a ECommerce site within 5 minutes." />
    <meta name="keywords" content="cloud ECommerce, SAAS , ECommerce" />  
    <link rel="icon" href="{{ Shop.favicon() }}">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>ClcknShop - Cloud Ecommerce platform</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="icon" href="{{ Shop.favicon() }}">
    <link rel="manifest" href="img/favicons/manifest.json">
    
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="css/theme.css" rel="stylesheet" />

    <link href="vendors/swiper/swiper-bundle.min.css" rel="stylesheet">
  </head>


  <body data-bs-spy="scroll" data-bs-target="#navbar">

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 d-block backdrop shadow-transition" data-navbar-on-scroll="data-navbar-on-scroll" style="background-image: none; background-color: rgba(249, 250, 253, 0.475); transition: none 0s ease 0s;">
        <div class="container"><a class="navbar-brand d-inline-flex" href=""><img class="card-img" alt="..." src="{{ Shop.logo() }}"></a>
          <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item px-2"><a class="nav-link fw-bold" aria-current="page" href="/">Home</a></li>
              <li class="nav-item px-2"><a class="nav-link fw-bold" href="/#howitworks">How it works</a></li>
              <li class="nav-item px-2"><a class="nav-link fw-bold" href="/#portfolio">Portfolio</a></li>
              <li class="nav-item px-2"><a class="nav-link fw-bold" href="/#pricing">Pricing</a></li>
              <li class="nav-item px-2"><a class="nav-link fw-bold" href="/#faqs">FAQs </a></li>
            </ul>
            <form class="ms-lg-5"><a class="btn btn-primary" href="/registration">Get started</a></form>
          </div>
        </div>
      </nav>

    {{ content_for_layout }}


      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="py-0 pt-7">

        <div class="container">
          <div class="row justify-content-xl-between gx-3">
  
            
            <div class="col-6 col-md-3 mb-3">
              <h5 class="lh-lg fw-bold text-1000">Company</h5>
              <ul class="list-unstyled mb-md-4 mb-lg-0">
                <li class="lh-lg"><a class="text-800 text-decoration-none" href="#!">About Us</a></li>
                <li class="lh-lg"><a class="text-800 text-decoration-none" href="#!">Leadership</a></li>
                <li class="lh-lg"><a class="text-800 text-decoration-none" href="#!">Investor Relations</a></li>
                <li class="lh-lg"><a class="text-800 text-decoration-none" href="#!">News</a></li>
              </ul>
            </div>
            
            <div class="col-6 col-md-3 mb-3">
              <h5 class="lh-lg fw-bold text-1000">Pages</h5>
              <ul class="list-unstyled mb-md-4 mb-lg-0">
                <li class="lh-lg"><a class="text-800 text-decoration-none" href="/registration">Registration</a></li>
                <li class="lh-lg"><a class="text-800 text-decoration-none" href="/page/terms">Terms and Conditions</a></li>
                <li class="lh-lg"><a class="text-800 text-decoration-none" href="#!">Return Policy</a></li>
                <li class="lh-lg"><a class="text-800 text-decoration-none" href="#!">Track Order</a></li>
              </ul>
            </div>
            <div class="col-6 col-md-3  mb-3">
              <h5 class="lh-lg fw-bold text-1000">Pricing</h5>
              <ul class="list-unstyled mb-md-4 mb-lg-0">
                <li class="lh-lg"><a class="text-800 text-decoration-none" href="#!">Plans</a></li>
                <li class="lh-lg"><a class="text-800 text-decoration-none" href="#!">Paid vs. Free</a></li>
              </ul>
            </div>
            <div class="col-sm-6 col-md-3 ">
              <h5 class="lh-lg fw-bold text-1000">Contact</h5>
              <p class="text-800"><svg class="svg-inline--fa fa-phone-alt fa-w-16 text-primary me-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="phone-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M497.39 361.8l-112-48a24 24 0 0 0-28 6.9l-49.6 60.6A370.66 370.66 0 0 1 130.6 204.11l60.6-49.6a23.94 23.94 0 0 0 6.9-28l-48-112A24.16 24.16 0 0 0 122.6.61l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.29 24.29 0 0 0-14.01-27.6z"></path></svg><!-- <i class="fas fa-phone-alt text-primary me-2"></i> Font Awesome fontawesome.com --><span class="text-900">+8801734936561</span></p>
              <p class="text-800"><svg class="svg-inline--fa fa-envelope fa-w-16 text-warning me-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="envelope" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"></path></svg><!-- <i class="fas fa-envelope text-warning me-2"></i> Font Awesome fontawesome.com --><span class="text-800">support@clcknshop.com</span></p>
              <p class="text-800"><svg class="svg-inline--fa fa-map-marker-alt fa-w-12 text-success me-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="map-marker-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"></path></svg><!-- <i class="fas fa-map-marker-alt text-success me-2"></i> Font Awesome fontawesome.com --><span class="text-800">Road# 01,House#38,Sector-05,Uttara,Dhaka-1230 </span></p>
            </div>
            <div class="col-12">
              <div class="text-center my-4"><a href="#!"><svg class="svg-inline--fa fa-facebook fa-w-16 me-4 fs-3 text-facebook" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"></path></svg><!-- <i class="me-4 fab fa-facebook fs-3 text-facebook"></i> Font Awesome fontawesome.com --></a><a href="#!"> <svg class="svg-inline--fa fa-twitter fa-w-16 me-4 fs-3 text-twitter" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path></svg><!-- <i class="me-4 fab fa-twitter fs-3 text-twitter"></i> Font Awesome fontawesome.com --></a><a href="#!"> <svg class="svg-inline--fa fa-instagram fa-w-14 me-4 fs-3 text-instagram" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="instagram" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg><!-- <i class="me-4 fab fa-instagram fs-3 text-instagram"></i> Font Awesome fontawesome.com --></a></div>
            </div>
          </div>
          <div class="border-bottom border-3"></div>
          <div class="row">
            <div class="col-md-6">
              <p class="my-2 text-center text-md-start">All rights Reserved © Your Company, 2021</p>
            </div>
            <div class="col-md-6 order-1 order-md-0">
              <p class="my-2 text-1000 text-md-end text-center"> Developed By&nbsp;
                <svg class="bi bi-suit-heart-fill" xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="#EB6453" viewBox="0 0 16 16">
                  <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"></path>
                </svg>&nbsp;by&nbsp;<a class="text-800" href="https://infosoftbd.com/" target="_blank">Infosoftbd Solutions </a>
              </p>
            </div>
          </div>
        </div><!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->


    </main><div style="position: static !important;"></div>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="vendors/@popperjs/popper.min.js"></script>
    <script src="vendors/bootstrap/bootstrap.min.js"></script>
    <script src="vendors/is/is.min.js"></script>
    <script src="vendors/swiper/swiper-bundle.min.js"> </script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="vendors/fontawesome/all.min.js"></script>
    <script src="js/theme.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@400;700&amp;display=swap" rel="stylesheet">
  

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-YHZQKH3336"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-YHZQKH3336');
</script>

</body>

</html>
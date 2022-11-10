<div class="full-banner hero-banner banner-wrap sec-gap-2 v2">
    <ul class="banner-slide v2">
        <li>
            <!--<div class="banner-content">
                <div class="banner-cover">
                    <div class="inner">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-7  col-sm-8  col-xs-12">
                                         

                                    <h6 class="mb-40">Shop our summer collection in huge discount today!</h6>

                                    <a href="/collection/bed-sheet" class="btn btn-default btn-lg">Shop Now <i class="fa  fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
            <figure class="img-hold"><img src="{{Shop.asset_image(slider-1)}}" alt=""></figure>
        </li>

        <li>
          <!--  <div class="banner-content">
                <div class="banner-cover">
                    <div class="inner">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-7  col-sm-8  col-xs-12">
                                        

                                    <h6 class="mb-40">Shop our summer collection in huge discount today!</h6>

                                    <a href="/collection/cushion-cover" class="btn btn-default btn-lg">Shop Now <i class="fa  fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <figure class="img-hold"><img src="{{Shop.asset_image(slider-2)}}" alt=""></figure>
        </li>

        <li>
            <div class="banner-content">
                <div class="banner-cover">
                    <div class="inner">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-7  col-sm-8  col-xs-12">
                                 <!--   <h2 class="tri-font pri-color txt-ex-lg mb-0"> 80% OFF </h2>
                                    <h2 class="tri-font text-uppercase txt-lg">Summer Collection</h2>     -->

                                    <h6 class="mb-40">Shop our summer collection in huge discount today!</h6>

                                    <a href="/collection/comforter" class="btn btn-default btn-lg">Shop Now <i class="fa  fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <figure class="img-hold"><img src="{{Shop.asset_image(slider-3)}}" alt=""></figure>
        </li>
    </ul>
</div>
<!--banner-->

<main>
  <div class="feature-cat sec-gap">
      <div class="outer-wrap">
          <div class="row">
              <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="wrap top-lft image-effect">
                      <a href="/collection/cushion-cover" class="cover-link">&nbsp;</a>
                      <div class="content deeper">
                        <h4>Coushon Collection</h4>
                      
                          <a href="/collection/cushion-cover-18" class="btn bdr">Shop Now <i class="fa  fa-angle-right"></i></a>
                      </div>
                      <figure><img src="{{cdn_root}}images/coushon.jpg" alt=""></figure>
                  </div>
              </div>
              <!--single cat-->

              <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="wrap top-lft image-effect">
                      <a href="/collection/bed-sheet" class="cover-link">&nbsp;</a>
                      <div class="content deeper">
                        <h4>Bedsheet Offers</h4>
                       
                          <a href="/collection/comforter" class="btn bdr">Shop Now <i class="fa  fa-angle-right"></i></a>
                      </div>
                      <figure><img src="{{cdn_root}}images/bedsheet.jpg" alt=""></figure>
                  </div>
              </div>
              <!--single cat-->

              <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="wrap btm-lft image-effect">
                      <a href="/collection/wallets" class="cover-link">&nbsp;</a>
                      <div class="content deeper">
                        <h4>Mosquto Net Designs</h4>
                       
                          <a href="/collection/comforter" class="btn bdr">Shop Now <i class="fa  fa-angle-right"></i></a>
                      </div>
                      <figure><img src="{{cdn_root}}images/mosquto.jpg" alt=""></figure>
                  </div>
              </div>
              <!--single cat-->
          </div>
      </div>
  </div>
  <!--feature cat-->

  <div class="trending-product pdt-full-width mb-40">
    <div class="outer-wrap">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12 text-center">
            <div class="section-title mb-45">
              <h3 class="mb-20">Trending Products</h3>
              <p>
                Collection of most popular products from the store just for you Lorem Ipsum is simply dummy text of the prin ting and typesetting industry orem Ipsum has been the industry's standard.
              </p>
            </div>
          </div>
        </div>
      </div>
      <!--title-->

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
                  <ul class="products">
                      <li class="product" tpleach="shop.products(all,limit:10)" set="product">
                          <figure>
                            <ul class="action-buttons">
                                    <li><a href="{{ product->link }}" ><i class="pe-7s-look"></i></a></li>
                                    <li><a href="{{ product->cartlink }}"><i class="pe-7s-cart"></i></a></li>

                                </ul>

                              <a href="{{ product->link }}" class="image-effect">
                                  <img src="images/product-image.jpg" alt="" tplimage="product->image" width="370" height="450">
                              </a>
                          </figure>
                          <!--fig-->

                          <div class="detl text-center">
                              <a href="{{ product->link }}" title="{{ product->title }}">{{ Formats.tokenTruncate($product->title,25) }}</a>
                              <div class="price">
                                  <del>{{ Formats.moneyFormat($product->compare_price)}}</del> <ins>{{ Formats.moneyFormat($product->price)}}</ins>
                              </div>
                          </div>
                          <!--detail-->
                      </li>
                      <!--product-->


                  </ul>
        </div>
      </div>
    </div>
  </div>



<!--instagram-->
</main>
<!--main-->
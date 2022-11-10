

<div class="breadcrumb-wrap">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <ul id="breadcrumbs" class="breadcrumb">
          <li> <a href="#">Home</a> </li>
          <li> <a href="#">{{product->product_type}}</a> </li>
          <li class="item-current"> {{product->title}}</li>
        </ul>
      </div>
    </div>
  </div>
</div>


  <main class="product">
  <div class="pdt-dtl sec-gap bg-gray pri-pad">
    <div class="container">
      <div class="row">
        <div class="col-md-7 col-sm-12 product-gallery">
          <ul class="pdt-gallery pdt-gal2">
            <li tpleach="product->product_media" set="media"><img src="assets/images/detail-page-var-img.jpg" alt="" tplimage="media->image"></li>

          </ul>

          <div class="thumb-wrap">
                <ul class="pdt-gallery-thumb pdt-thumb2">
                  <li tpleach="product->product_media" set="media"><img src="assets/images/detail-page-var-img.jpg" alt="" tplimage="media->image"></li>

                </ul>
              </div>
        </div>
        <!--product gallery-->

        <div class="col-md-5 col-sm-12 summary">
          <div class="mb-10" >
            <span class="ck-review" review="{{product->rating}}">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
            </span>

            <span class="rating-review">({{product->ratingTotal}} customer review)</span>
          </div>
          <!--rating-->

          <h3 class="product_title">{{ product->title }}</h3>

          <div class="aviliblity mb-10">Availability: <strong class="availability">In Stock</strong></div>
          <!--avilibity-->

          <div class="price">
                            <del class="product-cprice">{{ Formats.moneyFormat($product->compare_price)}}  </del> <ins class="product-price">{{ Formats.moneyFormat($product->price)}} </ins>
                        </div>
                        <!--price-->

                        <hr>

                        <div class="item-desc mb-20" tplvar="product->overview">
                          Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.
                        </div>

            <form action="add_to_cart" tplform="" class="cart mb-25" id="product_frm">
						{{Formats.printProductHiddenFields($product)}}

            <div class="mb-25">
              <span tpleach="product->product_options" set="option">
                <select class="product_options"  data-name="{{ option->option_name }}" name="option[{{ option->option_name }}]" id="option_{{ option->option_name }}">
                  <option value="">{{ option->option_name }}</option>
                  <option tpleach="Formats.split($option->option_values)" set="option_value" value="{{ option_value }}" >{{ option_value }}</option>
                </select>
              </span>



            </div>

                          <div class="quantity-wrap mb-25">
                            <button type='button' class='qtyminus'>-</button>
                <input type='number' name='quantity' value='1' class='qty' id="quantity" max-stock="{{ product->max_stock }}"/>
                <button type='button' class='qtyplus'>+</button>
                          </div>

                          <button type="submit" class="button add-cart">Add to cart <i class="pe-7s-cart"></i> </button>
                        </form>

          <div class="product-share">
            <strong>Share:</strong>
                          <ul class="social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
        </div>
      </div>
    </div>
  </div>
  <!--product top-->

  <div class="product tab-wrap sec-gap">
    <div class="tab-wrapper outer-wrap">
    <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#description" role="tab" data-toggle="tab">Description</a></li>

        <li><a href="#review" role="tab" data-toggle="tab">Reviews ({{product->ratingTotal}})</a></li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane active" id="description">
        <div class="container">
          <div class="row">
            <div class="col-md-10 col-sm-12 col-xs-12 col-md-offset-1" tplvar="product->description">
              <p>
                 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus in euismod velit. Nullam sagittis metus vitae ipsum scelerisque commodo. Ut urna neque, hendrerit non elementum sit amet, posuere cursus mi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ultrices semper eros, in malesuada dolor rutrum at. Nulla mollis, leo ut ullamcorper malesuada, ipsum velit vulputate tortor, ac semper nibh purus quis augue. Maecenas ut interdum nibh. Aliquam diam ex, tempor id posuere non, dictum in quam. Donec mollis nunc sed leo luctus, quis egestas lacus varius. Aliquam dui lorem, suscipit at efficitur in, posuere fringilla neque.
              </p>

              <p>
                Aenean quis rutrum augue. Integer dapibus fringilla sapien. Phasellus ac eleifend felis. Quisque tristique quam non turpis accumsan pretium. Nunc aliquam diam urna, ut tempor purus fermentum eu. Proin at est faucibus, venenatis ligula elementum, pretium arcu. Cras luctus efficitur elementum. Nullam aliquet non arcu sit amet malesuada. Nullam laoreet eros in metus molestie, at rhoncus neque semper. Phasellus finibus luctus aliquam. Morbi eu urna id dolor molestie congue. Nulla ac tempus neque.
              </p>

              <p class="img-center">
                <img src="assets/images/detail-page-extra-img.jpg" class="alignright" alt="">

                <em class="">
                  Quisque feugiat lacinia mattis. Morbi sit amet rutrum dolor. Morbi risus turpis, gravida at ligula non, sollicitudin laoreet libero. Nulla sed dapibus purus. Nulla facilisi. Nulla posuere eget odio eget feugiat. Nullam hendrerit sodales semper. Vesti bulum eu justo malesuada, sollicitudin enim nec, lobortis eros. In hac habitasse platea dictumst. Nam sit amet consectetur felis. Duis vestibulum dolor non sapien rhoncus ultricies. Aliquam gravida nulla sit amet mauris cursus, accond imentum augue faucibus.  Professionally reconceptualize multimedia based catalysts for change through strategic metrics.
                </em>
              </p>

              <div class="clearfix"></div>

              <p class="img-center">
                <img src="assets/images/detail-page-extra-img.jpg" class="alignleft" alt="">

                Aenean quis rutrum augue. Integer dapibus fringilla sapien. Phasellus ac eleifend felis. Quisque tristique quam non turpis accumsan pretium. Nunc aliquam diam urna, ut tempor purus fermentum eu. Proin at est faucibus, venenatis ligula elementum, pretium arcu. Cras luctus efficitur elementum. Nullam aliquet non arcu sit amet malesuada. Nullam laoreet eros in metus molestie, at rhoncus neque semper. Phasellus finibus luctus aliquam. Morbi eu urna id dolor molestie congue. Nulla ac tempus neque.
              </p>

              <p>
                Aenean quis rutrum augue. Integer dapibus fringilla sapien. Phasellus ac eleifend felis. Quisque tristique quam non turpis accumsan pretium. Nunc aliquam diam urna, ut tempor purus fermentum eu. Proin at est faucibus, venenatis ligula elementum, pretium arcu. Cras luctus efficitur elementum. Nullam aliquet non arcu sit amet malesuada. Nullam laoreet eros in metus molestie, at rhoncus neque semper. Phasellus finibus luctus aliquam. Morbi eu urna id dolor molestie congue. Nulla ac tempus neque.
              </p>
            </div>
          </div>
        </div>
        </div>
        <!--description-->

        <div class="tab-pane" id="review">
        <div class="container">
          <div class="row comment-area">

            <div class="col-md-12 col-sm-12 col-xs-12">
              <ul class="comment-list">
                <li class="comment" tpleach="product->reviews" set="review">
                  <figure class="avatar">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/67/User_Avatar.png" alt="">
                  </figure>
                  <!--avatar-->

                  <div class="comment-body">
                    <div class="comment-meta">
                      <h6> {{ review->customer->first_name }} {{ review->customer->last_name}} <span class="pri-font"> {{ review->created }}</span> </h6>
                      <span class="ck-review" review="{{review->rating}}">
                      </span>
                    </div>
                    <!--comment meta-->

                    <div class="comment-content">
                      <p>
                        {{review->comment}}
                      </p>
                    </div>
                    <!--comment content-->
                  </div>
                  <!--comment body-->
                </li>
                <!--single comment-->
              </ul>
              <!--comment list-->

              <div class="comment-respond">
                <div class="content-wrap mb-10">
                  <h4 class="mb-0">Leave a Review</h4>
                </div>
                <!--content wrap-->

                <div class="" tpluser="0">
                  <h5>You must be <a href="login"><b class="text-danger">login</b></a> to Review</h5>
                </div>



                <form action="#" tpluser="1" tplform="review">
                  <div class="row">

                    <div class="form-group col-sm-12">
                      <h2><span id="rating" data-stars="4"></span></h2>
                    </div>

                    <div class="form-group col-sm-12">
                      <label>Comment</label>
                      <textarea required name="comment" placeholder="Write your opinion..."></textarea>
                    </div>
                    <!--text area-->
                    <input type="hidden" name="product_id" value="{{ product->id }}">
                    <div class="form-group col-sm-12">
                      <button type="submit"> Submit <i class="fa fa-angle-right"></i></button>
                    </div>
                  </div>
                </form>
              </div>
              <!--comment respond-->
            </div>
          </div>
          <!--comment area-->
        </div>
        </div>
        <!--reivew-->
      </div>
    </div>
  </div>
  <!--product tab-->

  <div class="additional-pdt product tab-wrap sec-gap">
    <div class="tab-wrapper outer-wrap">
    <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#related" role="tab" data-toggle="tab">Related Products</a></li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane active" id="related">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <ul class="products product-slide">
                              <li class="product" tpleach="Shop.products(all, product_type:$product->product_type, limit:6)">
                                  <figure>
                                      <a href="{{ val->link }}" class="image-effect">
                                          <img src="assets/images/product-image.jpg" alt="" tplimage="val->imagepath" width="370" height="450">
                                      </a>
                                  </figure>
                                  <!--fig-->

                                  <div class="detl text-center">
                                      <a href="{{ val->link }}">{{ val->title }}</a>
                                      <div class="price">
                                          <del>{{Formats.moneyFormat($val->compaire_price)}} </del> <ins>{{ Formats.moneyFormat($val->price )}}</ins>
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
        <!--related-->

      </div>
    </div>
  </div>
  <!--additional pdt-->



  <!--instagram-->
  </main>
  <!--main-->

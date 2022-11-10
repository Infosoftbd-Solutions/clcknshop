<a href="#">
                                        <span class="pe-7s-cart icon"></span>
                                        <span class="count rounded-crcl">{{ cart_count }}</span>
                                    </a>
                                    <div class="widget widget_shopping_cart">
                                        <div class="content">
                                            <ul class="mini-cart">
                                                <li class="item" tpleach="cart_products" set="product">
                                                    <figure>
                                                        <a href="#">
                                                            <img src="assets/images/mini-cart-thumb.jpg" alt="" tplimage="product->image">
                                                        </a>
                                                    </figure>

                                                    <div class="pdt-content">
                                                        <h6>
                                                            <a href="#">{{ product->title }} </a>
                                                        </h6>

                                                        <span class="price">{{ Formats.moneyFormat($product->price) }}</span>
                                                    </div>
                                                </li>
                                                <!--single item-->

                                               
                                            </ul>
                                            <!--mini cart-->

                                            <div class="mini-cart-total">
                                                Total : {{ Formats.moneyFormat($cart_total) }}
                                            </div>
                                            <!--total-->

                                            <a href="cart" class="btn btn-default">Cart<i class="fa  fa-angle-right"></i></a>
                                        </div>
                                    </div>
                                    <!--widget area-->
<div class="breadcrumb-wrap">
			  <div class="container">
			    <div class="row">
			      <div class="col-md-12 col-sm-12 col-xs-12">
			        <ul id="breadcrumbs" class="breadcrumb">
			          <li> <a href="#">Home</a> </li>
			          <li> <a href="collection/all">Collections</a> </li>
			          <li class="item-current"> {{ collection_title }}</li>
			        </ul>
			      </div>
			    </div>
			  </div>
			</div>
	    <!--banner-->

	    <main>
	    	<div class="sorting-wrap">
		    	<div class="container">
	    			<div class="row storefront-sorting ">
				    	<div class="col-md-6-12 col-sm-7 col-xs-6 left">
				    	<!--	<button type="button" class="sort-btn anim">Filter Products <i class="fa fa-sliders"></i></button> -->
				    	<!--	<span class="result-count">Showing {{ pagination->count }} of total {{ pagination->total }} Results</span> -->
				    	</div>

				    	<div class="col-md-6-12 col-sm-5 col-xs-6 text-right">
				    		<form class="ordering" method="get">
                                <select name="orderby" class="orderby" name="orderby"  id="ck-sort-by">
                                   {{sort_by}}
                                </select>
                  </form>
				    	</div>
	    			</div>

	    			<div class="fltr-optn-wrap hide">
	    				<div class="container">
	    					<div class="row">
	    						<div class="col-md-3 col-sm-3">
	    							<h6>Categories</h6>

	    							<form action="#">
	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">All Categories  (987)</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">Best Seller  (300)</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">Hot Products  (190)</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">Man Wears  (379)</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">Women Wears  (129)</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">Kids Wears  (276)</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">Sports Wears  (12)</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">Sale Products  (89)</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">Sneakers  (48)</label>
	    								</div>
	    							</form>
	    						</div>
	    						<!--category-->

	    						<div class="col-md-3 col-sm-3">
	    							<h6>Color</h6>

	    							<form action="#">
	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">All Colors  (876)</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">Red  (20)</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">Black  (298)</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">Blue  (89)</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">Green  (109)</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">Sky Blue  (81)</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">Pink  (100)</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">Purple  (120)</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">Orange  (187)</label>
	    								</div>
	    							</form>
	    						</div>
	    						<!--category-->

	    						<div class="col-md-3 col-sm-3">
	    							<h6>Size</h6>

	    							<form action="#">
	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">All Sizes  (980)</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">Xtra - Small  (100)</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">Small  (235)</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">Xtra - Medium  (90)</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">Medium  (129)</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">Large  (120)</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">Xtra - Large  (89)</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">XXtra - Large  (48)</label>
	    								</div>
	    							</form>
	    						</div>
	    						<!--category-->


	    						<div class="col-md-3 col-sm-3">
	    							<h6>Price</h6>

	    							<form action="#">
	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">All price</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">$0 - $999</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">$1000 - $1999</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">$2000 - $2999</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">$3000 - $3999</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">$4000 - $4999</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">$5000 - $5999</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">$6000 - $6999</label>
	    								</div>

	    								<div class="form-group checkbox-wrap">
                                            <input type="checkbox" value="1">
                                            <label class="checkbox">$7000+</label>
	    								</div>
	    							</form>
	    						</div>
	    						<!--category-->
	    					</div>
	    				</div>
	    			</div>
		    	</div>
		    	<!--sorting-->
	    	</div>
	    	<!--sorting wrap-->

			<div class="container pdt-four-col">
				<div class="row">
	    			<div class="col-md-12 col-sm-12 col-xs-12">
	                    <ul class="products">
	                        <li class="product" tpleach="products" set="product">
	                            <figure>
	                            	<ul class="action-buttons">
                                        <!--<li><a href="#" data-toggle="modal" data-target="#quick-view"><i class="pe-7s-look"></i></a></li> -->
																				<li><a href="{{ product->link }}"><i class="pe-7s-look"></i></a></li>
																				<li><a href="{{ product->cartlink }}"><i class="pe-7s-cart"></i></a></li>
                                        <li><a href="#"><i class="pe-7s-like"></i></a></li>
                                        <li><a href="#"><i class="pe-7s-edit"></i></a></li>
                                    </ul>

	                                <a href="{{product->link}}" class="image-effect">
	                                    <img src="assets/images/product-image.jpg" alt="" tplimage="product->image" width="370" height="450">
	                                </a>
	                            </figure>
	                            <!--fig-->

	                            <div class="detl text-center">
	                                <a href="{{ product->link }}" title="{{ product->title }}">{{ Formats.tokenTruncate($product->title,30) }}</a>
	                                <div class="price">
	                                    <del>{{ Formats.moneyFormat($product->compare_price)}} </del> <ins>{{ Formats.moneyFormat($product->price)}}</ins>
	                                </div>
	                            </div>
	                            <!--detail-->
	                        </li>
	                        <!--product-->



	                    </ul>
	    			</div>
	    		</div>

	    		<div class="row sec-gap">
	    			<div class="col-md-12 col-sm-12 text-center">
	    				<div class="pagination">
		    				<ul class="page-numbers">
	                            <li><a class="prev page-numbers" href="{{ pagination_link_prev }}"><i class="fa fa-angle-left"></i></a></li>
	                           <!-- <li ><span class="page-numbers current">1</span></li> -->
	                            <li tpleach="pagination_links" set="link" ><a class="page-numbers" href="{{ link }}">{{ key }}</a></li>

	                            <li><a class="next page-numbers" href="{{ pagination_link_next }}"><i class="fa fa-angle-right"></i></a></li>
	                        </ul>
                        </div>
	    			</div>
	    		</div>
			</div>
			<!--full width-->


		 	<!--instagram-->
	    </main>
	    <!--main-->
@extends('master')
@section('content')
@include('public.slide.slide_header')
<!-- Start main Content -->
<div class="maincontent bg--white pt--80 pb--55">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 col-12">
				<div class="wn__single__product">
					<div class="row">
						<div class="col-lg-6 col-12">
							<div class="wn__fotorama__wrapper">
								<div class="fotorama wn__fotorama__action" data-nav="thumbs">
											
										@if($thumb == null)
											@for($i=1;$i<9;$i++)	
												<a href="1.jpg"><img src="{{asset('/images/books/'.$i.'jpg')}}" alt=""></a>
											@endfor
										@else
										@foreach ( $thumb as $book)
										<a href="{{$book}}"><img src="{{asset('images/books/'.$item->book_id.'/'.$book)}}"
											alt="Book Thumbnail"></a>
										@endforeach
									@endif
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="product__info__main">
								<h1 id="single_book_name">{{$item->book_name}} </h1>
								<div class="product-info-stock-sku d-flex">
									<p>Availability:<span>
											@if($item->book_total >0 && $item->book_total != null)
												<b> IN STOCK ({{$total_items}})</b>
											@else
												<b class="warning">OUT STOCK!!</b>
											@endif
										</span></p>
									<p>Serial code:<span id="single_book_id"> {{$item->book_id}}</span></p>
								</div>
								<div class="product-reviews-summary d-flex">
									<ul class="rating-summary d-flex">
										<li><i class="zmdi zmdi-star-outline"></i></li>
										<li><i class="zmdi zmdi-star-outline"></i></li>
										<li><i class="zmdi zmdi-star-outline"></i></li>
										<li class="off"><i class="zmdi zmdi-star-outline"></i></li>
										<li class="off"><i class="zmdi zmdi-star-outline"></i></li>
									</ul>
									<div class="reviews-actions d-flex">
										<a href="#">(1 Review)</a>
										<a href="#">Add Your Review</a>
									</div>
								</div>
								@if ($item->promotion_price !=null)	
								<div class="price-box">
									<span>{{number_format(($item->promotion_price),2) ." $"}}</span>
								</div>	
								<div class="discount-item">{{number_format(($item->price),2) ." $"}}</div>
								@else
									<div class="prize-box">
										<span> {{number_format(($item->promotion_price),2) ." $"}}</span>
									</div>							
								@endif
								
								<div class="product-color-label">
									<span>Color</span>
									<div class="color__attribute d-flex">
										<div class="swatch-option color"
											style="background: #000000 no-repeat center; background-size: initial;">
										</div>
										<div class="swatch-option color"
											style="background: #8f8f8f no-repeat center; background-size: initial;">
										</div>
									</div>
								</div>
								<div class="box-tocart d-flex">
									<span>Qty</span>
									<input id="single_book_qty" class="input-text qty" name="qty" min="1" value="1"
										title="Qty" type="number">
									<div id="addtocart__actions" class="addtocart__actions">
										<button id="tocart" class="tocart" type="submit" title="Add to Cart">Add to
											Cart</button>
									</div>
								</div>
								<div class="product-addto-links clearfix">
									<a class="wishlist" href="#"></a>
									<a class="compare" href=""></a>
									<a class="email" href="#"></a>
								</div>
								<div id="product__overview" class="product__overview">
									{!!Str::limit($item->description, $limit = 500, $end = '...')!!}
								</div>
							</div>

						</div>

					</div>
				</div>

				<div class="product__info__detailed">
					<div class="pro_details_nav nav justify-content-start" role="tablist">
						<a class="nav-item nav-link active" data-toggle="tab" href="#nav-details" role="tab">Details</a>
						<a class="nav-item nav-link" data-toggle="tab" href="#nav-review" role="tab">Reviews</a>
					</div>
					<div class="tab__container">
						<!-- Start Single Tab Content -->
						<div class="pro__tab_label tab-pane fade show active" id="nav-details" role="tabpanel">
							<div class="description__attribute">
								{!!$item->description!!}
							</div>
						</div>
						<!-- End Single Tab Content -->
						<!-- Start Single Tab Content -->
						<div class="pro__tab_label tab-pane fade" id="nav-review" role="tabpanel">
							<div class="review__attribute">
								<h1>Customer Reviews</h1>
								<h2>Hastech</h2>
								<div class="review__ratings__type d-flex">
									<div class="review-ratings">
										<div class="rating-summary d-flex">
											<span>Quality</span>
											<ul class="rating d-flex">
												<li><i class="zmdi zmdi-star"></i></li>
												<li><i class="zmdi zmdi-star"></i></li>
												<li><i class="zmdi zmdi-star"></i></li>
												<li class="off"><i class="zmdi zmdi-star"></i></li>
												<li class="off"><i class="zmdi zmdi-star"></i></li>
											</ul>
										</div>

										<div class="rating-summary d-flex">
											<span>Price</span>
											<ul class="rating d-flex">
												<li><i class="zmdi zmdi-star"></i></li>
												<li><i class="zmdi zmdi-star"></i></li>
												<li><i class="zmdi zmdi-star"></i></li>
												<li class="off"><i class="zmdi zmdi-star"></i></li>
												<li class="off"><i class="zmdi zmdi-star"></i></li>
											</ul>
										</div>
										<div class="rating-summary d-flex">
											<span>value</span>
											<ul class="rating d-flex">
												<li><i class="zmdi zmdi-star"></i></li>
												<li><i class="zmdi zmdi-star"></i></li>
												<li><i class="zmdi zmdi-star"></i></li>
												<li class="off"><i class="zmdi zmdi-star"></i></li>
												<li class="off"><i class="zmdi zmdi-star"></i></li>
											</ul>
										</div>
									</div>
									<div class="review-content">
										<p>Hastech</p>
										<p>Review by Hastech</p>
										<p>Posted on 11/6/2018</p>
									</div>
								</div>
							</div>
							<div class="review-fieldset">
								<h2>You're reviewing:</h2>
								<h3>Chaz Kangeroo Hoodie</h3>
								<div class="review-field-ratings">
									<div class="product-review-table">
										<div class="review-field-rating d-flex">
											<span>Quality</span>
											<ul class="rating d-flex">
												<li class="off"><i class="zmdi zmdi-star"></i></li>
												<li class="off"><i class="zmdi zmdi-star"></i></li>
												<li class="off"><i class="zmdi zmdi-star"></i></li>
												<li class="off"><i class="zmdi zmdi-star"></i></li>
												<li class="off"><i class="zmdi zmdi-star"></i></li>
											</ul>
										</div>
										<div class="review-field-rating d-flex">
											<span>Price</span>
											<ul class="rating d-flex">
												<li class="off"><i class="zmdi zmdi-star"></i></li>
												<li class="off"><i class="zmdi zmdi-star"></i></li>
												<li class="off"><i class="zmdi zmdi-star"></i></li>
												<li class="off"><i class="zmdi zmdi-star"></i></li>
												<li class="off"><i class="zmdi zmdi-star"></i></li>
											</ul>
										</div>
										<div class="review-field-rating d-flex">
											<span>Value</span>
											<ul class="rating d-flex">
												<li class="off"><i class="zmdi zmdi-star"></i></li>
												<li class="off"><i class="zmdi zmdi-star"></i></li>
												<li class="off"><i class="zmdi zmdi-star"></i></li>
												<li class="off"><i class="zmdi zmdi-star"></i></li>
												<li class="off"><i class="zmdi zmdi-star"></i></li>
											</ul>
										</div>
									</div>
								</div>
								<div class="review_form_field">
									<div class="input__box">
										<span>Nickname</span>
										<input id="nickname_field" type="text" name="nickname">
									</div>
									<div class="input__box">
										<span>Summary</span>
										<input id="summery_field" type="text" name="summery">
									</div>
									<div class="input__box">
										<span>Review</span>
										<textarea name="review"></textarea>
									</div>
									<div class="review-form-actions">
										<button>Submit Review</button>
									</div>
								</div>
							</div>
						</div>

						<!-- End Single Tab Content -->
					</div>
				</div>
				
				<div class="wn__related__product pt--80 pb--50">
					<div class="section__title text-center">
						<h2 class="title__be--2">Related Products</h2>
					</div>
					<div class="row mt--60">
						<div class="productcategory__slide--2 arrows_style owl-carousel owl-theme">
							<!-- Start Single Product -->
							<div class="col-lg-4 col-md-4 col-sm-6 col-12">
								<div class="product">
									<div class="product__thumb">
										<a class="first__img" href="{{route('shop')}}"><img
												src="{{asset('images/product/1.jpg')}}" alt="product image"></a>
										<a class="second__img animation1" href="single-product.html"><img
												src="{{asset('images/product/2.jpg')}}" alt="product image"></a>
										<div class="new__box">
											<span class="new-label">New</span>
										</div>
										<ul class="prize position__right__bottom d-flex">
											<li>$35.00</li>
											<li class="old_prize">$38.00</li>
										</ul>
										<div class="action">
											<div class="actions_inner">
												<ul class="add_to_links">
													<li><a class="cart" href="cart.html"></a></li>
													<li><a class="wishlist" href="wishlist.html"></a></li>
													<li><a class="compare" href="compare.html"></a></li>
													<li><a data-toggle="modal" title="Quick View"
															class="quickview modal-view detail-link"
															href="#productmodal"></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="product__content">
										<h4><a href="single-product.html">Crown Summit Backpack</a></h4>
										<ul class="rating d-flex">
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
										</ul>
									</div>
								</div>
							</div>
							<!-- Start Single Product -->
							<!-- Start Single Product -->
							<div class="col-lg-4 col-md-4 col-sm-6 col-12">
								<div class="product">
									<div class="product__thumb">
										<a class="first__img" href="single-product.html"><img
												src="{{asset('images/product/2.jpg')}}" alt="product image"></a>
										<a class="second__img animation1" href="single-product.html"><img
												src="{{asset('images/product/4.jpg')}}" alt="product image"></a>
										<div class="new__box">
											<span class="new-label">New</span>
										</div>
										<ul class="prize position__right__bottom d-flex">
											<li>$35.00</li>
											<li class="old_prize">$38.00</li>
										</ul>
										<div class="action">
											<div class="actions_inner">
												<ul class="add_to_links">
													<li><a class="cart" href="cart.html"></a></li>
													<li><a class="wishlist" href="wishlist.html"></a></li>
													<li><a class="compare" href="compare.html"></a></li>
													<li><a data-toggle="modal" title="Quick View"
															class="quickview modal-view detail-link"
															href="#productmodal"></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="product__content">
										<h4><a href="single-product.html">Crown Summit Backpack</a></h4>
										<ul class="rating d-flex">
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
										</ul>
									</div>
								</div>
							</div>
							<!-- Start Single Product -->
							<!-- Start Single Product -->
							<div class="col-lg-4 col-md-4 col-sm-6 col-12">
								<div class="product">
									<div class="product__thumb">
										<a class="first__img" href="single-product.html"><img
												src="{{asset('images/product/3.jpg')}}" alt="product image"></a>
										<a class="second__img animation1" href="single-product.html"><img
												src="{{asset('images/product/6.jpg')}}" alt="product image"></a>
										<div class="new__box">
											<span class="new-label">New</span>
										</div>
										<ul class="prize position__right__bottom d-flex">
											<li>$35.00</li>
											<li class="old_prize">$38.00</li>
										</ul>
										<div class="action">
											<div class="actions_inner">
												<ul class="add_to_links">
													<li><a class="cart" href="cart.html"></a></li>
													<li><a class="wishlist" href="wishlist.html"></a></li>
													<li><a class="compare" href="compare.html"></a></li>
													<li><a data-toggle="modal" title="Quick View"
															class="quickview modal-view detail-link"
															href="#productmodal"></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="product__content">
										<h4><a href="single-product.html">Crown Summit Backpack</a></h4>
										<ul class="rating d-flex">
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
										</ul>
									</div>
								</div>
							</div>
							<!-- Start Single Product -->
							<!-- Start Single Product -->
							<div class="col-lg-4 col-md-4 col-sm-6 col-12">
								<div class="product">
									<div class="product__thumb">
										<a class="first__img" href="single-product.html"><img
												src="{{asset('images/product/4.jpg')}}" alt="product image"></a>
										<a class="second__img animation1" href="single-product.html"><img
												src="{{asset('images/product/8.jpg')}}" alt="product image"></a>
										<div class="new__box">
											<span class="new-label">New</span>
										</div>
										<ul class="prize position__right__bottom d-flex">
											<li>$35.00</li>
											<li class="old_prize">$38.00</li>
										</ul>
										<div class="action">
											<div class="actions_inner">
												<ul class="add_to_links">
													<li><a class="cart" href="cart.html"></a></li>
													<li><a class="wishlist" href="wishlist.html"></a></li>
													<li><a class="compare" href="compare.html"></a></li>
													<li><a data-toggle="modal" title="Quick View"
															class="quickview modal-view detail-link"
															href="#productmodal"></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="product__content">
										<h4><a href="single-product.html">Crown Summit Backpack</a></h4>
										<ul class="rating d-flex">
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
										</ul>
									</div>
								</div>
							</div>
							<!-- Start Single Product -->
							<!-- Start Single Product -->
							<div class="col-lg-4 col-md-4 col-sm-6 col-12">
								<div class="product">
									<div class="product__thumb">
										<a class="first__img" href="single-product.html"><img
												src="{{asset('images/product/9.jpg')}}" alt="product image"></a>
										<a class="second__img animation1" href="single-product.html"><img
												src="{{asset('images/product/2.jpg')}}" alt="product image"></a>
										<div class="new__box">
											<span class="new-label">New</span>
										</div>
										<ul class="prize position__right__bottom d-flex">
											<li>$35.00</li>
											<li class="old_prize">$38.00</li>
										</ul>
										<div class="action">
											<div class="actions_inner">
												<ul class="add_to_links">
													<li><a class="cart" href="cart.html"></a></li>
													<li><a class="wishlist" href="wishlist.html"></a></li>
													<li><a class="compare" href="compare.html"></a></li>
													<li><a data-toggle="modal" title="Quick View"
															class="quickview modal-view detail-link"
															href="#productmodal"></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="product__content">
										<h4><a href="single-product.html">Crown Summit Backpack</a></h4>
										<ul class="rating d-flex">
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
										</ul>
									</div>
								</div>
							</div>
							<!-- Start Single Product -->
							<!-- Start Single Product -->
							<div class="col-lg-4 col-md-4 col-sm-6 col-12">
								<div class="product">
									<div class="product__thumb">
										<a class="first__img" href="single-product.html"><img
												src="{{asset('images/product/9.jpg')}}" alt="product image"></a>
										<a class="second__img animation1" href="single-product.html"><img
												src="{{asset('images/product/8.jpg')}}" alt="product image"></a>
										<div class="new__box">
											<span class="new-label">New</span>
										</div>
										<ul class="prize position__right__bottom d-flex">
											<li>$35.00</li>
											<li class="old_prize">$38.00</li>
										</ul>
										<div class="action">
											<div class="actions_inner">
												<ul class="add_to_links">
													<li><a class="cart" href="cart.html"></a></li>
													<li><a class="wishlist" href="wishlist.html"></a></li>
													<li><a class="compare" href="compare.html"></a></li>
													<li><a data-toggle="modal" title="Quick View"
															class="quickview modal-view detail-link"
															href="#productmodal"></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="product__content">
										<h4><a href="single-product.html">Crown Summit Backpack</a></h4>
										<ul class="rating d-flex">
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
										</ul>
									</div>
								</div>
							</div>
							<!-- Start Single Product -->
						</div>
					</div>
				</div>
				<div class="wn__related__product">
					<div class="section__title text-center">
						<h2 class="title__be--2">upsell products</h2>
					</div>
					<div class="row mt--60">
						<div class="productcategory__slide--2 arrows_style owl-carousel owl-theme">
							<!-- Start Single Product -->
							<div class="col-lg-4 col-md-4 col-sm-6 col-12">
								<div class="product">
									<div class="product__thumb">
										<a class="first__img" href="single-product.html"><img
												src="{{asset('images/product/2.jpg')}}" alt="product image"></a>
										<a class="second__img animation1" href="single-product.html"><img
												src="{{asset('images/product/1.jpg')}}" alt="product image"></a>
										<div class="new__box">
											<span class="new-label">New</span>
										</div>
										<ul class="prize position__right__bottom d-flex">
											<li>$35.00</li>
											<li class="old_prize">$38.00</li>
										</ul>
										<div class="action">
											<div class="actions_inner">
												<ul class="add_to_links">
													<li><a class="cart" href="cart.html"></a></li>
													<li><a class="wishlist" href="wishlist.html"></a></li>
													<li><a class="compare" href="compare.html"></a></li>
													<li><a data-toggle="modal" title="Quick View"
															class="quickview modal-view detail-link"
															href="#productmodal"></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="product__content">
										<h4><a href="single-product.html">Crown Summit Backpack</a></h4>
										<ul class="rating d-flex">
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
										</ul>
									</div>
								</div>
							</div>
							<!-- Start Single Product -->
							<!-- Start Single Product -->
							<div class="col-lg-4 col-md-4 col-sm-6 col-12">
								<div class="product">
									<div class="product__thumb">
										<a class="first__img" href="single-product.html"><img
												src="{{asset('images/product/4.jpg')}}" alt="product image"></a>
										<a class="second__img animation1" href="single-product.html"><img
												src="{{asset('images/product/3.jpg')}}" alt="product image"></a>
										<div class="new__box">
											<span class="new-label">New</span>
										</div>
										<ul class="prize position__right__bottom d-flex">
											<li>$35.00</li>
											<li class="old_prize">$38.00</li>
										</ul>
										<div class="action">
											<div class="actions_inner">
												<ul class="add_to_links">
													<li><a class="cart" href="cart.html"></a></li>
													<li><a class="wishlist" href="wishlist.html"></a></li>
													<li><a class="compare" href="compare.html"></a></li>
													<li><a data-toggle="modal" title="Quick View"
															class="quickview modal-view detail-link"
															href="#productmodal"></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="product__content">
										<h4><a href="single-product.html">Crown Summit Backpack</a></h4>
										<ul class="rating d-flex">
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
										</ul>
									</div>
								</div>
							</div>
							<!-- Start Single Product -->
							<!-- Start Single Product -->
							<div class="col-lg-4 col-md-4 col-sm-6 col-12">
								<div class="product">
									<div class="product__thumb">
										<a class="first__img" href="single-product.html"><img
												src="{{asset('images/product/6.jpg')}}" alt="product image"></a>
										<a class="second__img animation1" href="single-product.html"><img
												src="{{asset('images/product/5.jpg')}}" alt="product image"></a>
										<div class="new__box">
											<span class="new-label">New</span>
										</div>
										<ul class="prize position__right__bottom d-flex">
											<li>$35.00</li>
											<li class="old_prize">$38.00</li>
										</ul>
										<div class="action">
											<div class="actions_inner">
												<ul class="add_to_links">
													<li><a class="cart" href="cart.html"></a></li>
													<li><a class="wishlist" href="wishlist.html"></a></li>
													<li><a class="compare" href="compare.html"></a></li>
													<li><a data-toggle="modal" title="Quick View"
															class="quickview modal-view detail-link"
															href="#productmodal"></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="product__content">
										<h4><a href="single-product.html">Crown Summit Backpack</a></h4>
										<ul class="rating d-flex">
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
										</ul>
									</div>
								</div>
							</div>
							<!-- Start Single Product -->
							<!-- Start Single Product -->
							<div class="col-lg-4 col-md-4 col-sm-6 col-12">
								<div class="product">
									<div class="product__thumb">
										<a class="first__img" href="single-product.html"><img
												src="{{asset('images/product/8.jpg')}}" alt="product image"></a>
										<a class="second__img animation1" href="single-product.html"><img
												src="{{asset('images/product/7.jpg')}}" alt="product image"></a>
										<div class="new__box">
											<span class="new-label">New</span>
										</div>
										<ul class="prize position__right__bottom d-flex">
											<li>$35.00</li>
											<li class="old_prize">$38.00</li>
										</ul>
										<div class="action">
											<div class="actions_inner">
												<ul class="add_to_links">
													<li><a class="cart" href="cart.html"></a></li>
													<li><a class="wishlist" href="wishlist.html"></a></li>
													<li><a class="compare" href="compare.html"></a></li>
													<li><a data-toggle="modal" title="Quick View"
															class="quickview modal-view detail-link"
															href="#productmodal"></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="product__content">
										<h4><a href="single-product.html">Crown Summit Backpack</a></h4>
										<ul class="rating d-flex">
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
										</ul>
									</div>
								</div>
							</div>
							<!-- Start Single Product -->
							<!-- Start Single Product -->
							<div class="col-lg-4 col-md-4 col-sm-6 col-12">
								<div class="product">
									<div class="product__thumb">
										<a class="first__img" href="single-product.html"><img
												src="{{asset('images/product/9.jpg')}}" alt="product image"></a>
										<a class="second__img animation1" href="single-product.html"><img
												src="{{asset('images/product/2.jpg')}}" alt="product image"></a>
										<div class="new__box">
											<span class="new-label">New</span>
										</div>
										<ul class="prize position__right__bottom d-flex">
											<li>$35.00</li>
											<li class="old_prize">$38.00</li>
										</ul>
										<div class="action">
											<div class="actions_inner">
												<ul class="add_to_links">
													<li><a class="cart" href="cart.html"></a></li>
													<li><a class="wishlist" href="wishlist.html"></a></li>
													<li><a class="compare" href="compare.html"></a></li>
													<li><a data-toggle="modal" title="Quick View"
															class="quickview modal-view detail-link"
															href="#productmodal"></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="product__content">
										<h4><a href="single-product.html">Crown Summit Backpack</a></h4>
										<ul class="rating d-flex">
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
										</ul>
									</div>
								</div>
							</div>
							<!-- Start Single Product -->
							<!-- Start Single Product -->
							<div class="col-lg-4 col-md-4 col-sm-6 col-12">
								<div class="product">
									<div class="product__thumb">
										<a class="first__img" href="single-product.html"><img
												src="{{asset('images/product/9.jpg')}}" alt="product image"></a>
										<a class="second__img animation1" href="single-product.html"><img
												src="{{asset('images/product/8.jpg')}}" alt="product image"></a>
										<div class="new__box">
											<span class="new-label">New</span>
										</div>
										<ul class="prize position__right__bottom d-flex">
											<li>$35.00</li>
											<li class="old_prize">$38.00</li>
										</ul>
										<div class="action">
											<div class="actions_inner">
												<ul class="add_to_links">
													<li><a class="cart" href="cart.html"></a></li>
													<li><a class="wishlist" href="wishlist.html"></a></li>
													<li><a class="compare" href="compare.html"></a></li>
													<li><a data-toggle="modal" title="Quick View"
															class="quickview modal-view detail-link"
															href="#productmodal"></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="product__content">
										<h4><a href="single-product.html">Crown Summit Backpack</a></h4>
										<ul class="rating d-flex">
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li class="on"><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
											<li><i class="fa fa-star-o"></i></li>
										</ul>
									</div>
								</div>
							</div>
							<!-- Start Single Product -->
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
				<div class="shop__sidebar">
					<aside class="wedget__categories poroduct--cat">
						<h3 class="wedget__title">Product Categories</h3>
						<ul>
							@foreach ($list_category as $cat_name)
							<li><a href="{{route('category',$cat_name->cat_id)}}"
									value={{$cat_name->cat_name}}>{{$cat_name->cat_name}}
									<span>({{$cat_name->total}})</span></a></li>
							@endforeach

						</ul>
					</aside>
					<aside class="wedget__categories pro--range">
						<h3 class="wedget__title">Filter by price</h3>
						<div class="content-shopby">
							<div class="price_filter s-filter clear">
								<form action="#" method="GET">
									<div id="slider-range"></div>
									<div class="slider__range--output">
										<div class="price__output--wrap">
											<div class="price--output">
												<span>Price :</span><input type="text" id="amount" readonly="">
											</div>
											<div class="price--filter">
												<a href="#">Filter</a>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</aside>
					<aside class="wedget__categories poroduct--compare">
						<h3 class="wedget__title">Compare</h3>
						<ul>
							<li><a href="#">x</a><a href="#">Condimentum posuere</a></li>
							<li><a href="#">x</a><a href="#">Condimentum posuere</a></li>
							<li><a href="#">x</a><a href="#">Dignissim venenatis</a></li>
						</ul>
					</aside>
					<aside class="wedget__categories poroduct--tag">
						<h3 class="wedget__title">Product Tags</h3>
						<ul>
							<ul>
								@foreach ($list_category as $cat_name)
								<li><a href="{{route('shop')}}"
										value={{$cat_name->cat_name}}>{{$cat_name->cat_name}}
										<span>({{$cat_name->total}})</span></a></li>
								@endforeach
							</ul>
						</ul>
					</aside>
					<aside class="wedget__categories sidebar--banner">
						<img src="{{asset('images/others/banner_left.jpg')}}" alt="banner images">
						<div class="text">
							<h2>new products</h2>
							<h6>save up to <br> <strong>40%</strong>off</h6>
						</div>
					</aside>
				</div>
			</div>
		</div>

	</div>
</div>
<!-- End main Content -->
@endsection
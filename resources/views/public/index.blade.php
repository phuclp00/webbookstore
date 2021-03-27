@extends('master')
@section('content')
{{$items =null}}

<!-- Header -->
@include('public.slide.menu_header')

<!-- Start Slider area ( MAX 10 SLIDE )-->
<div class="slider-area brown__nav slider--15 slide__activation slide__arrow01 owl-carousel owl-theme">
    @foreach($slide_items as $slide_items)
    <div class="slide animation__style10 {{$slide_items->name}} fullscreen align__center--left">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="slider__content">
                        <div class="contentbox">
                            {!!$slide_items->description!!}
                            <a class="shopbtn" href="{{route('shop')}}">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!-- End Slider area -->

<!-- Start NEW PRODUCT Area -->
<section class="wn__product__area brown--color pt--80  pb--30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section__title text-center">
                    <h2 class="title__be--2">New <span class="color--theme">Products</span></h2>
                </div>
            </div>
        </div>
        <!-- Start Single Tab Content -->
        <div class="furniture--4 border--round arrows_style owl-carousel owl-theme row mt--50">
            <!-- Start Single Product -->
            @foreach($list_product as $product)
            @if($product->date_released<=20) <div class="product product__style--3">
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="product__thumb">
                        <a class="first__img"
                            href="{{route('product',['id'=>$product->book_id,'cat_id'=>$product->cat_id])}}"><img
                                src="{{asset('images/books/'.$product->book_id.'/'.$product->img)}}" alt="product image"
                                style="width: 270px;height: 340px;"></a>
                        <a class="second__img animation1"
                            href="{{route('product',['id'=>$product->book_id,'cat_id'=>$product->cat_id])}}"><img
                            src="{{asset('images/books/'.$product->book_id.'/'.$product->img)}}" 
                                style="width: 270px;height: 340px;"></a>
                        {{-- This comment will not be present in the rendered HTML 
                                // Danh sach cac san pham moi voi ngay ra mat khong qua 30 ngay 
                                // Neu san pham tong ban tren 30 thi se la HOT, tren 100 la BEST SELLER   
                            --}}

                        @if($product->totall_sell>100 )
                        <div class="hot__box">
                            <span class="hot-label">TOP BEST SALLER</span>
                        </div>
                        @elseif($product->totall_sell >30 )
                        <div class="hot__box">
                            <span class="hot-label">HOT NEW</span>
                        </div>
                        @else
                        <div class="hot__box color--2">
                            <span class="hot-label"> HOT </span>
                        </div>
                        @endif
                    </div>
                    <div class="product__content content--center">
                        <h4><a
                                href="{{route('product',['id'=>$product->book_id,'cat_id'=>$product->cat_id])}}">{{$product->book_name}}</a>
                        </h4>
                        <ul class="prize d-flex">
                            @if($product->promotion_price>0)
                            <li>{{number_format(($product->promotion_price),2) ." $"}}</li>
                            <li class="old_prize">{{number_format(($product->price),2) ." $"}}</li>
                            @else
                            <li>0.00 $</li>
                            <li class="old_prize">{{number_format(($product->price),2) ." $"}}</li>
                            @endif
                        </ul>
                        <div class="action">
                            <div class="actions_inner">
                                <ul class="add_to_links">
                                    <li><a class="cart" href="{{route('add_to_cart',[$product->book_id])}}"><i
                                                class="bi bi-shopping-bag4"></i></a></li>
                                    <li><a class="wishlist" href="{{route('add_to_cart',[$product->book_id])}}"><i
                                                class="bi bi-shopping-cart-full"></i></a></li>
                                    <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li>
                                    <li><a data-toggle="modal" title="Quick View"
                                            class="quickview modal-view detail-link" href="#productmodal"><i
                                                class="bi bi-search"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product__hover--content">
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
        </div>
        @endif
        @endforeach
        <!-- End Single Tab Content -->
    </div>
</section>
<!-- END NEW PRODUCT Area -->


<!-- Start BEst Seller Area -->
<section class="wn__product__area brown--color pt--80  pb--30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section__title text-center">
                    <h2 class="title__be--2">BEST <span class="color--theme">SELLER</span></h2>
                </div>
            </div>
        </div>
        <!-- Start Single Tab Content -->
        <div class="furniture--4 border--round arrows_style owl-carousel owl-theme row mt--50">
            <!-- Start Single Product -->
            @foreach($list_product as $product)
            @if($product->date_released<=20) <div class="product product__style--3">
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="product__thumb">
                        <a class="first__img"
                            href="{{route('product',['id'=>$product->book_id,'cat_id'=>$product->cat_id])}}"><img
                            src="{{asset('images/books/'.$product->book_id.'/'.$product->img)}}" alt="product image"
                                style="width: 270px;height: 340px;"></a>
                        <a class="second__img animation1"
                            href="{{route('product',['id'=>$product->book_id,'cat_id'=>$product->cat_id])}}"><img
                            src="{{asset('images/books/'.$product->book_id.'/'.$product->img)}}"
                                style="width: 270px;height: 340px;"></a>
                        {{-- This comment will not be present in the rendered HTML 
                                // Danh sach cac san pham moi voi ngay ra mat khong qua 30 ngay 
                                // Neu san pham tong ban tren 30 thi se la HOT, tren 100 la BEST SELLER   
                            --}}

                        @if($product->totall_sell>100 )
                        <div class="hot__box">
                            <span class="hot-label">TOP BEST SALLER</span>
                        </div>
                        @elseif($product->totall_sell >30 )
                        <div class="hot__box">
                            <span class="hot-label">HOT NEW</span>
                        </div>
                        @else
                        <div class="hot__box color--2">
                            <span class="hot-label"> HOT </span>
                        </div>
                        @endif
                    </div>
                    <div class="product__content content--center">
                        <h4><a
                                href="{{route('product',['id'=>$product->book_id,'cat_id'=>$product->cat_id])}}">{{$product->book_name}}</a>
                        </h4>
                        <ul class="prize d-flex">
                            @if($product->promotion_price>0)
                            <li>{{number_format(($product->promotion_price),2) ." $"}}</li>
                            <li class="old_prize">{{number_format(($product->price),2) ." $"}}</li>
                            @else
                            <li>0.00 $</li>
                            <li class="old_prize">{{number_format(($product->price),2) ." $"}}</li>
                            @endif
                        </ul>
                        <div class="action">
                            <div class="actions_inner">
                                <ul class="add_to_links">
                                    <li><a class="cart" href="{{route('add_to_cart',[$product->book_id])}}"><i
                                                class="bi bi-shopping-bag4"></i></a></li>
                                    <li><a class="wishlist" href="{{route('add_to_cart',[$product->book_id])}}"><i
                                                class="bi bi-shopping-cart-full"></i></a></li>
                                    <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li>
                                    <li><a data-toggle="modal" title="Quick View"
                                            class="quickview modal-view detail-link" href="#productmodal"><i
                                                class="bi bi-search"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product__hover--content">
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
        </div>
        @endif
        @endforeach
        <!-- End Single Tab Content -->
    </div>
</section>
<!-- END BEst Seller Area -->


<!-- Start BLOG Post Area -->
<section class="wn__recent__post bg--gray ptb--80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section__title text-center">
                    <h2 class="title__be--2">Our <span class="color--theme">Blog</span></h2>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                        lebmid alteration in some ledmid form</p>
                </div>
            </div>
        </div>
        <div class="row mt--50">
            <div class="col-md-6 col-lg-4 col-sm-12">
                <div class="post__itam">
                    <div class="content">
                        <h3><a href="blog-details.html">International activities of the Frankfurt Book </a></h3>
                        <p>We are proud to announce the very first the edition of the frankfurt news.We are proud to
                            announce the very first of edition of the fault frankfurt news for us.</p>
                        <div class="post__time">
                            <span class="day">Dec 06, 18</span>
                            <div class="post-meta">
                                <ul>
                                    <li><a href="#"><i class="bi bi-love"></i>72</a></li>
                                    <li><a href="#"><i class="bi bi-chat-bubble"></i>27</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-sm-12">
                <div class="post__itam">
                    <div class="content">
                        <h3><a href="blog-details.html">Reading has a signficant info number of benefits</a></h3>
                        <p>Find all the information you need to ensure your experience.Find all the information you need
                            to ensure your experience . Find all the information you of.</p>
                        <div class="post__time">
                            <span class="day">Mar 08, 18</span>
                            <div class="post-meta">
                                <ul>
                                    <li><a href="#"><i class="bi bi-love"></i>72</a></li>
                                    <li><a href="#"><i class="bi bi-chat-bubble"></i>27</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-sm-12">
                <div class="post__itam">
                    <div class="content">
                        <h3><a href="blog-details.html">The London Book Fair is to be packed with exciting </a></h3>
                        <p>The London Book Fair is the global area inon marketplace for rights negotiation.The year
                            London Book Fair is the global area inon forg marketplace for rights.</p>
                        <div class="post__time">
                            <span class="day">Nov 11, 18</span>
                            <div class="post-meta">
                                <ul>
                                    <li><a href="#"><i class="bi bi-love"></i>72</a></li>
                                    <li><a href="#"><i class="bi bi-chat-bubble"></i>27</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End BLOG Post Area -->

<!-- QUICKVIEW PRODUCT -->
<div id="quickview-wrapper">
    <!-- Modal -->
    <div class="modal fade" id="productmodal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal__container" role="document">
            <div class="modal-content">
                <div class="modal-header modal__header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                    <div class="modal-product">
                        <!-- Start product images -->
                        <div class="product-images">
                            <div class="main-image images">
                                <img alt="big images" src="{{asset('images/product/big-img/1.jpg')}}">
                            </div>
                        </div>
                        <!-- end product images -->
                        <div class="product-info">
                            <h1></h1>
                            <div class="rating__and__review">
                                <ul class="rating">
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                </ul>
                                <div class="review">
                                    <a href="#">4 customer reviews</a>
                                </div>
                            </div>
                            <div class="price-box-3">
                                <div class="s-price-box">
                                    <span class="new-price">$17.20</span>
                                    <span class="old-price">$45.00</span>
                                </div>
                            </div>
                            <div class="quick-desc">
                                Designed for simplicity and made from high quality materials. Its sleek geometry and
                                material combinations creates a modern look.
                            </div>
                            <div class="select__color">
                                <h2>Select color</h2>
                                <ul class="color__list">
                                    <li class="red"><a title="Red" href="#">Red</a></li>
                                    <li class="gold"><a title="Gold" href="#">Gold</a></li>
                                    <li class="orange"><a title="Orange" href="#">Orange</a></li>
                                    <li class="orange"><a title="Orange" href="#">Orange</a></li>
                                </ul>
                            </div>
                            <div class="select__size">
                                <h2>Select size</h2>
                                <ul class="color__list">
                                    <li class="l__size"><a title="L" href="#">L</a></li>
                                    <li class="m__size"><a title="M" href="#">M</a></li>
                                    <li class="s__size"><a title="S" href="#">S</a></li>
                                    <li class="xl__size"><a title="XL" href="#">XL</a></li>
                                    <li class="xxl__size"><a title="XXL" href="#">XXL</a></li>
                                </ul>
                            </div>
                            <div class="social-sharing">
                                <div class="widget widget_socialsharing_widget">
                                    <h3 class="widget-title-modal">Share this product</h3>
                                    <ul class="social__net social__net--2 d-flex justify-content-start">
                                        <li class="facebook"><a href="#" class="rss social-icon"><i
                                                    class="zmdi zmdi-rss"></i></a></li>
                                        <li class="linkedin"><a href="#" class="linkedin social-icon"><i
                                                    class="zmdi zmdi-linkedin"></i></a></li>
                                        <li class="pinterest"><a href="#" class="pinterest social-icon"><i
                                                    class="zmdi zmdi-pinterest"></i></a></li>
                                        <li class="tumblr"><a href="#" class="tumblr social-icon"><i
                                                    class="zmdi zmdi-tumblr"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="addtocart-btn">
                                <a href="#">Add to cart</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- END QUICKVIEW PRODUCT -->
@endsection
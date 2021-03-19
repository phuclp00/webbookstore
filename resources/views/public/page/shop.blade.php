
@extends('master')

@section('content')
<!-- Start Bradcaump area -->
@include('public.slide.slide_header')
<div class="page-shop-sidebar left--sidebar bg--white section-padding--lg">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
                <div class="shop__sidebar">
                    <aside class="wedget__categories poroduct--cat">
                        <h3 class="wedget__title">Product Categories</h3>
                        <ul>
                            @foreach ($list_category as $cat_name) 
                        <li><a href="{{route('category_view',$cat_name->cat_id)}}" value={{$cat_name->cat_name}}>{{$cat_name->cat_name}} <span>({{$cat_name->total}})</span></a></li>
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
                            @foreach ($list_category as $cat_name) 
                            <li><a href="{{route('shop_view')}}" value={{$cat_name->cat_name}}>{{$cat_name->cat_name}} <span>({{$cat_name->total}})</span></a></li>
                                @endforeach
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
            <div class="col-lg-9 col-12 order-1 order-lg-2">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop__list__wrapper d-flex flex-wrap flex-md-nowrap justify-content-between">
                            <div class="shop__list nav justify-content-center" role="tablist">
                                <a class="nav-item nav-link" data-toggle="tab" href="#nav-grid" role="tab"><i class="fa fa-th"></i></a>
                                <a class="nav-item nav-link active" data-toggle="tab" href="#nav-list" role="tab"><i class="fa fa-list"></i></a>
                            </div>            
                             
                                @if($get_cat_items!=null)
                                    <p>Current Page: {{$get_cat_items->currentPage()." || ".$get_cat_items->count()." of ".$get_cat_items->total()."  Results"}}</p>
                                @elseif($pagi_list_items!=null)                  
                                    <p>Current Page {{$pagi_list_items->currentPage()." || ".$pagi_list_items->count()." of ".$pagi_list_items->total()."  Results"}}</p>
                                @else 
                                     <p>Current Page {{$list_search->currentPage()." || ".$list_search->count()." of ".$list_search->total()."  Results"}}</p>

                                @endif                         
         
                                <div class="orderby__wrapper">
                                <span>Sort By</span>
                                <select class="shot__byselect">
                                    <option>Default sorting</option>
                                    <option>HeadPhone</option>
                                    <option>Furniture</option>
                                    <option>Jewellery</option>
                                    <option>Handmade</option>
                                    <option>Kids</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab__container">
                    <div class="shop-grid tab-pane faded" id="nav-grid" role="tabpanel">
                        <div class="row">
                            <!-- Start Single Product -->
                             {{-- Search key word--}}
                             @if(isset($list_search)==true)
                                @foreach($list_search as $list_product)
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                        <div class="product">
                                            <div class="product__thumb">
                                                <a class="first__img" href="{{ route('product_view',['id'=>$list_product->book_id,'cat_id'=>$list_product->cat_id]) }}"><img src="{{asset('images/books/test_img/'.$list_product->img)}}"  alt="product image"></a>
                                                <a class="second__img animation1" href="{{route('product_view',['id'=>$list_product->book_id,'cat_id'=>$list_product->cat_id])}}"><img src="{{asset('images/books/8k.jpg')}}" alt="product image"></a>
                                                {{-- This comment will not be present in the rendered HTML 
                                                // Danh sach cac san pham moi voi ngay ra mat khong qua 30 ngay 
                                                // Neu san pham tong ban tren 30 thi se la HOT, tren 100 la BEST SELLER   
                                                --}}

                                                @if($list_product->totall_sell>100 )
                                                <div class="hot__box">
                                                    <span class="hot-label">TOP BEST SALLER</span>
                                                </div>
                                                @elseif($list_product->totall_sell >30 )
                                                    <div class="hot__box">
                                                        <span class="hot-label">HOT NEW</span>
                                                    </div>
                                                @else
                                                    <div class="hot__box color--2">
                                                        <span class="hot-label"> HOT </span>
                                                    </div>
                                                @endif
                                                <ul class="prize position__right__bottom d-flex">
                                                    @if($list_product->promotion_price>0)
                                                    <li>{{number_format($list_product->promotion_price,2)."$"}}</li>
                                                    <li class="old_prize">{{number_format($list_product->price,2)."$"}}</li>
                                                @else
                                                    <li>0.00 $</li>
                                                    <li class="old_prize">{{number_format($list_product->price,2)."$"}}</li>
                                                @endif
                                                <div class="action">
                                                    <div class="actions_inner">
                                                        <ul class="add_to_links">
                                                            <li><a class="cart" href="{{route('add_to_cart',[$list_product->book_id])}}"><i class="bi bi-shopping-bag4"></i></a></li>
                                                            <li><a class="wishlist" href="{{route('add_to_cart',[$list_product->book_id])}}"><i class="bi bi-shopping-cart-full"></i></a></li>
                                                            <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li>
                                                            <li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product__content">
                                                <h4><a href="{{route('product_view',['id'=>$list_product->book_id,'cat_id'=>$list_product->cat_id])}}">Strive Shoulder Pack</a></h4>
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
                                @endforeach
                            {{-- Search theo catagory--}}
                            @elseif(isset($get_cat_items)!=null) 
                                @foreach ($get_cat_items as $list_product)
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                        <div class="product">
                                            <div class="product__thumb">
                                                <a class="first__img" href="{{ route('product_view',['id'=>$list_product->book_id,'cat_id'=>$list_product->cat_id]) }}"><img src="{{asset('images/books/test_img/'.$list_product->img)}}"  alt="product image"></a>
                                                <a class="second__img animation1" href="{{route('product_view',['id'=>$list_product->book_id,'cat_id'=>$list_product->cat_id])}}"><img src="{{asset('images/books/8k.jpg')}}" alt="product image"></a>
                                                {{-- This comment will not be present in the rendered HTML 
                                                // Danh sach cac san pham moi voi ngay ra mat khong qua 30 ngay 
                                                // Neu san pham tong ban tren 30 thi se la HOT, tren 100 la BEST SELLER   
                                                --}}

                                                @if($list_product->totall_sell>100 )
                                                <div class="hot__box">
                                                    <span class="hot-label">TOP BEST SALLER</span>
                                                </div>
                                                @elseif($list_product->totall_sell >30 )
                                                    <div class="hot__box">
                                                        <span class="hot-label">HOT NEW</span>
                                                    </div>
                                                @else
                                                    <div class="hot__box color--2">
                                                        <span class="hot-label"> HOT </span>
                                                    </div>
                                                @endif
                                                <ul class="prize position__right__bottom d-flex">
                                                    @if($list_product->promotion_price>0)
                                                    <li>{{number_format($list_product->promotion_price,2)."$"}}</li>
                                                    <li class="old_prize">{{number_format($list_product->price,2)."$"}}</li>
                                                @else
                                                    <li>0.00 $</li>
                                                    <li class="old_prize">{{number_format($list_product->price,2)."$"}}</li>
                                                @endif
                                                <div class="action">
                                                    <div class="actions_inner">
                                                        <ul class="add_to_links">
                                                            <li><a class="cart" href="{{route('add_to_cart',[$list_product->book_id])}}"><i class="bi bi-shopping-bag4"></i></a></li>
                                                            <li><a class="wishlist" href="{{route('add_to_cart',[$list_product->book_id])}}"><i class="bi bi-shopping-cart-full"></i></a></li>
                                                            <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li>
                                                            <li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product__content">
                                                <h4><a href="{{route('product_view',['id'=>$list_product->book_id,'cat_id'=>$list_product->cat_id])}}">Strive Shoulder Pack</a></h4>
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
                                @endforeach     
                            @else
                            {{-- Search ALL--}}
                            @foreach ($pagi_list_items as $list_product)
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                    <div class="product">
                                        <div class="product__thumb">
                                            
                                            <a class="first__img" href="{{route('product_view',['id'=>$list_product->book_id,'cat_id'=>$list_product->cat_id])}}"><img src="{{asset('images/books/test_img/'.$list_product->img)}}"  alt="product image"></a>
                                            <a class="second__img animation1" href="{{route('product_view',['id'=>$list_product->book_id,'cat_id'=>$list_product->cat_id])}}"><img src="{{asset('images/books/8k.jpg')}}" alt="product image"></a>
                                            {{-- This comment will not be present in the rendered HTML 
                                            // Danh sach cac san pham moi voi ngay ra mat khong qua 30 ngay 
                                            // Neu san pham tong ban tren 30 thi se la HOT, tren 100 la BEST SELLER   
                                            --}}

                                            @if($list_product->totall_sell>100 )
                                            <div class="hot__box">
                                                <span class="hot-label">TOP BEST SALLER</span>
                                            </div>
                                            @elseif($list_product->totall_sell >30 )
                                                <div class="hot__box">
                                                    <span class="hot-label">HOT NEW</span>
                                                </div>
                                            @else
                                                <div class="hot__box color--2">
                                                    <span class="hot-label"> HOT </span>
                                                </div>
                                            @endif
                                            <ul class="prize position__right__bottom d-flex">
                                            @if($list_product->promotion_price>0)
                                                <li>{{number_format(($list_product->promotion_price),2) ." $"}}</li>
                                                <li class="old_prize">{{number_format(($list_product->price),2) ." $"}}</li>
                                            @else
                                                <li>0.00 $</li>
                                                <li class="old_prize">{{number_format(($list_product->price),2) ." $"}}</li>
                                            @endif
                                            <div class="action">
                                                <div class="actions_inner">
                                                    <ul class="add_to_links">
                                                        <li><a class="cart" href="{{route('add_to_cart',[$list_product->book_id])}}"><i class="bi bi-shopping-bag4"></i></a></li>
                                                        <li><a class="wishlist" href="{{route('add_to_cart',[$list_product->book_id])}}"><i class="bi bi-shopping-cart-full"></i></a></li>
                                                        <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li>
                                                        <li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product__content">
                                            <h4><a href="{{route('product_view',['id'=>$list_product->book_id,'cat_id'=>$list_product->cat_id])}}">Strive Shoulder Pack</a></h4>
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
                            @endforeach   
                            
                            @endif                                                                             
                          <!-- End Single Product -->
                            </div>
                        
                    </div>
                
                    <div class="shop-grid tab-pane fade show active" id="nav-list" role="tabpanel">
                        <div class="list__view__wrapper">
                            <!-- Start Single Product -->
                             {{-- Search keyword--}}
                            @if(isset($list_search))
                                @foreach ($list_search as $item)                                                    
                                    <div class="list__view mt--40">
                                        <div class="thumb">
                                            <a class="first__img " href="{{route('product_view',['id'=>$item->book_id,'cat_id'=>$item->cat_id])}}"><img src="{{asset('images/books/test_img/'.$item->img)}}" alt="product images"  ></a>
                                            <a class="second__img animation1" href="{{route('product_view',['id'=>$item->book_id,'cat_id'=>$item->cat_id])}}"><img src="{{asset('images/books/8k.jpg')}}" alt="product images"></a>
                                        </div>
                                        <div class="content">
                                            <h2><a href="{{route('product_view',$item->book_id)}}">{{$item->book_name}}</a></h2>
                                            <ul class="rating d-flex">
                                                <li class="on"><i class="fa fa-star-o"></i></li>
                                                <li class="on"><i class="fa fa-star-o"></i></li>
                                                <li class="on"><i class="fa fa-star-o"></i></li>
                                                <li class="on"><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                            </ul>
                                            <ul class="prize__box">
                                                <ul class="prize__box">                                         
                                                @if($item->promotion_price>0)
                                                    <li>{{number_format(($item->promotion_price),2) ." $"}}</li>
                                                    <li class="old__prize">{{number_format(($item->price),2) ." $"}}</li>
                                                @else
                                                    <li>0.00 $</li>
                                                    <li class="old__prize">{{number_format(($item->price),2) ." $"}}</li>
                                                @endif
                                                </ul>
                                            </ul>
                                            <p>{{Str::limit($item->description, $limit = 350, $end = '...')}}</p>
                                            <ul class="cart__action d-flex">
                                                <li class="cart"><a href="{{route('add_to_cart',[$item->book_id])}}">Add to cart</a></li>
                                                <li class="wishlist"><a href="{{route('add_to_cart',[$item->book_id])}}"></a></li>
                                                <li class="compare"><a href="{{route('cart_view')}}"></a></li>
                                            </ul>

                                        </div>
                                    </div>
                                @endforeach
                             {{-- Search theo catagory--}}
                            @elseif(isset($get_cat_items)!=null)
                                @foreach ($get_cat_items as $item)                                                    
                                    <div class="list__view mt--40">
                                        <div class="thumb">
                                            <a class="first__img " href="{{route('product_view',['id'=>$item->book_id,'cat_id'=>$item->cat_id])}}"><img src="{{asset('images/books/test_img/'.$item->img)}}" alt="product images"  ></a>
                                            <a class="second__img animation1" href="{{route('product_view',['id'=>$item->book_id,'cat_id'=>$item->cat_id])}}"><img src="{{asset('images/books/8k.jpg')}}" alt="product images"></a>
                                        </div>
                                        <div class="content">
                                            <h2><a href="{{route('product_view',$item->book_id)}}">{{$item->book_name}}</a></h2>
                                            <ul class="rating d-flex">
                                                <li class="on"><i class="fa fa-star-o"></i></li>
                                                <li class="on"><i class="fa fa-star-o"></i></li>
                                                <li class="on"><i class="fa fa-star-o"></i></li>
                                                <li class="on"><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                            </ul>
                                            <ul class="prize__box">
                                                <ul class="prize__box">                                         
                                                @if($item->promotion_price>0)
                                                    <li>{{number_format(($item->promotion_price),2) ." $"}}</li>
                                                    <li class="old__prize">{{number_format(($item->price),2) ." $"}}</li>
                                                @else
                                                    <li>0.00 $</li>
                                                    <li class="old__prize">{{number_format(($item->price),2) ." $"}}</li>
                                                @endif
                                                </ul>
                                            </ul>
                                            <p>{{Str::limit($item->description, $limit = 350, $end = '...')}}</p>
                                            <ul class="cart__action d-flex">
                                                <li class="cart"><a href="{{route('add_to_cart',[$item->book_id])}}">Add to cart</a></li>
                                                <li class="wishlist"><a href="{{route('add_to_cart',[$item->book_id])}}"></a></li>
                                                <li class="compare"><a href="{{route('cart_view')}}"></a></li>
                                            </ul>

                                        </div>
                                    </div>
                                @endforeach
                            @else
                             {{-- Search ALL --}}                     
                                @foreach ($pagi_list_items as $item)                                             
                                    <div class="list__view mt--40">
                                        <div class="thumb">
                                            <a class="first__img " href="{{route('product_view',['id'=>$item->book_id,'cat_id'=>$item->cat_id])}}"><img src="{{asset('images/books/test_img/'.$item->img)}}" alt="product images"  ></a>
                                            <a class="second__img animation1" href="{{route('product_view',['id'=>$item->book_id,'cat_id'=>$item->cat_id])}}"><img src="{{asset('images/books/8k.jpg')}}" alt="product images"></a>
                                        </div>
                                        <div class="content">
                                            <h2><a href="{{route('product_view',['id'=>$item->book_id,'cat_id'=>$item->cat_id])}}">{{$item->book_name}}</a></h2>
                                            <ul class="rating d-flex">
                                                <li class="on"><i class="fa fa-star-o"></i></li>
                                                <li class="on"><i class="fa fa-star-o"></i></li>
                                                <li class="on"><i class="fa fa-star-o"></i></li>
                                                <li class="on"><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                            </ul>
                                            <ul class="prize__box">
                                                <ul class="prize__box">                                         
                                                @if($item->promotion_price>0)
                                                    <li>{{number_format(($item->promotion_price),2) ." $"}}</li>
                                                    <li class="old__prize">{{number_format(($item->price),2) ." $"}}</li>
                                                @else
                                                    <li>0.00 $</li>
                                                    <li class="old__prize">{{number_format(($item->price),2) ." $"}}</li>
                                                @endif
                                                </ul>
                                            </ul>
                                            <p>{{Str::limit($item->description, $limit = 350, $end = '...')}}</p>
                                            <ul class="cart__action d-flex">
                                                <li class="cart"><a href="{{route('add_to_cart',[$item->book_id])}}">Add to cart</a></li>
                                                <li class="wishlist"><a href="{{route('add_to_cart',[$item->book_id])}}"></a></li>
                                                <li class="compare"><a href="{{route('cart_view')}}"></a></li>
                                            </ul>

                                        </div>
                                    </div>
                                @endforeach
                           
                            @endif
                            <!-- End Single Product -->                     
                        </div>
                    </div>
                    
                  
                </div>
                
                    @if($get_cat_items!=null) 
                        <ul class="wn__pagination" style="margin-top:100px; ">
                            {{ $get_cat_items->links('vendor.pagination.tailwind'),["paginator"=>$get_cat_items]}}
                        </ul>
                    @elseif($pagi_list_items!=null)
                        <ul class="wn__pagination" style="margin-top:100px; ">
                            {{ $pagi_list_items->links('vendor.pagination.tailwind'),["paginator"=>$pagi_list_items]}}
                        </ul>
                    @elseif($list_search !=null)
                        <ul class="wn__pagination" style="margin-top:100px; ">
                            {{ $list_search->links('vendor.pagination.tailwind'),["paginator"=>$list_search]}}
                        </ul>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection
<header id="wn__header" class="header__area header__absolute sticky__header">
    <?php $content = Cart::content(); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-6 col-lg-2">
                <div class="logo">
                    <a href="{{route('home')}}">
                        <img src="{{asset('asset/frontend/images/logo/logo.png')}}" alt="logo images">
                    </a>
                </div>
            </div>
            <div class="col-lg-8 d-none d-lg-block">
                <nav class="mainmenu__nav">
                    <ul class="meninmenu d-flex justify-content-start">
                        <li class="drop with--one--item"><a href="{{route('home')}}">Home</a></li>
                        <li class="drop"><a href="{{route('shop')}}">Shop</a></li>
                        <li class="drop"><a href="{{route('shop')}}">Books</a>
                            <div class="megamenu mega03">
                                <ul class="item item03">
                                    <li class="title">Categories</li>
                                    @foreach($list_category as $cat_list)
                                    <li><a href="{{route('category')}}">{{$cat_list->cat_name}}
                                        </a></li>
                                    @endforeach
                                </ul>
                                <ul class="item item03">
                                    <li class="title">Favourite</li>
                                    @foreach($top_list_category as $top_cat_list)
                                    <li><a href="#">{{$top_cat_list->cat_name}}
                                        </a></li>
                                    @endforeach
                                </ul>
                                <ul class="item item03">
                                    <li class="title">Collections</li>

                                    @foreach($top_list_category as $top_cat_list)
                                    <li><a href="#">{{$top_cat_list->cat_name}}
                                        </a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        <li class="drop"><a href="{{route('blog')}}">Blog</a></li>
                        <li><a href="{{route('contact')}}">Contact</a></li>
                        <li><a href="{{route('about')}}">About Page</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-6 col-sm-6 col-6 col-lg-2">
                <ul class="header__sidebar__right d-flex justify-content-end align-items-center">
                    <li class="shop_search"><a class="search__active" href="#"></a></li>
                    <li class="wishlist"><a href="#"></a></li>
                    <li class="shopcart"><a class="cartbox_active" href="#"><span
                                class="product_qun">{{Cart::count()}}</span></a>
                        <!-- Start Shopping Cart -->
                        <div class="block-minicart minicart__active">
                            <div class="minicart-content-wrapper">
                                <div class="micart__close">
                                    <span>close</span>
                                </div>
                                <div class="items-total d-flex justify-content-between">
                                    <span>{{(Cart::count())}} items</span>
                                    <span>Cart Subtotal</span>
                                </div>
                                <div class="total_amount text-right">
                                    <span>{{Cart::subtotal()."$"}}</span>
                                </div>
                                <div class="mini_action checkout">
                                    <a class="checkout__btn" href="{{route('checkout')}}">Go to Checkout</a>
                                </div>
                                <div class="single__items">
                                    <div class="miniproduct">
                                        @foreach ($content as $item)
                                        <div class="item01 d-flex">
                                            <div class="thumb">
                                                <a href="{{route('product',['id'=>$item->id])}}"><img
                                                        src="{{asset('images/books/'.$item->id.'/'.$item->options->image)}}"
                                                        alt="product images"></a>
                                            </div>
                                            <div class="content">
                                                <h6><a href="product-details.html">{{$item->name}}</a></h6>
                                                <span class="prize">{{number_format(($item->price),2) ." $"}}</span>
                                                <div class="product_prize d-flex justify-content-between">
                                                    <span class="qun">Qty: {{$item->qty}}</span>
                                                    <ul class="d-flex justify-content-end">
                                                        <li><a href="#"><i class="zmdi zmdi-settings"></i></a></li>
                                                        <li><a href="#"><i class="zmdi zmdi-delete"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="mini_action cart">
                                    <a class="cart__btn" href="{{route('cart')}}">View and edit cart</a>
                                </div>
                            </div>
                        </div>
                        <!-- End Shopping Cart -->
                    </li>
                    <li class="setting__bar__icon"><a class="setting__active" href="#"></a>
                        <div class="searchbar__content setting__block">
                            <div class="content-inner">
                                <div class="switcher__account">
                                    @if(Auth::check())
                                    @if(Auth::user()->user_detail->img !=null)
                                    <img src="{{asset('images/user_profile/'.Auth::user()->user_detail->img)}}"
                                        class="avatar"
                                        style="margin:0px auto;vertical-align: middle; width: 100px;height: 100px;border-radius:50%;"
                                        alt="avatar">
                                    @else
                                    <img src="{{asset('images/users/user_default.svg')}}" class="avatar"
                                        style="margin:0px auto;vertical-align: middle; width: 50px;height: 50px;border-radius:50%;"
                                        alt="avatar">
                                    @endif
                                    <h3 class="account__title">Xin chào</h3>
                                    <h5>{{Auth::user()->user_name==null?Auth::user()->email:Auth::user()->user_name}}
                                    </h5>
                                    <div class="switcher-currency">
                                        <strong class="label switcher-label">
                                            <span>My Account</span>
                                        </strong>
                                        <div class="switcher-options">
                                            <div class="switcher-currency-trigger">
                                                <div class="setting__menu">

                                                    <span><a href="{{route('user.account.view')}}">My Account</a></span>
                                                    <span><a href="#">My Wishlist</a></span>
                                                    <span><a href="{{route('log_out')}}">Logout</a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <ul>
                                        <li><a href="{{route('login')}}">Sign In</a></li>
                                        <li><a href="{{route('login')}}">Create An Account</a></li>
                                    </ul>
                                    @endif
                                </div>
                                {{-- <div class="switcher-currency">
                                    <strong class="label switcher-label">
                                        <span>Currency</span>
                                    </strong>
                                    <div class="switcher-options">
                                        <div class="switcher-currency-trigger">
                                            <span class="currency-trigger">USD - US Dollar</span>
                                            <ul class="switcher-dropdown">
                                                <li>GBP - British Pound Sterling</li>
                                                <li>EUR - Euro</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="switcher-currency">
                                    <strong class="label switcher-label">
                                        <span>Language</span>
                                    </strong>
                                    <div class="switcher-options">
                                        <div class="switcher-currency-trigger">
                                            <span class="currency-trigger">English01</span>
                                            <ul class="switcher-dropdown">
                                                <li>English02</li>
                                                <li>English03</li>
                                                <li>English04</li>
                                                <li>English05</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Start Mobile Menu -->
        <div class="row d-none">
            <div class="col-lg-12 d-none">
                <nav class="mobilemenu__nav">
                    <ul class="meninmenu">
                        <li><a href="{{route('home')}}">Home</a>
                        </li>
                        <li><a href="{{route('about')}}">Pages</a>
                            <ul>

                                <li><a href="{{route('about')}}">About Page</a></li>
                                @if(session()->has('user_info'))
                                @foreach (session()->get("user_info") as $user)
                                <li><a href="{{route('account',[$user->user_name])}}">My Account</a></li>
                                @endforeach
                                @endif
                                <li><a href="{{route('checkout')}}">Checkout Page</a></li>
                                <li><a href="{{route('wishlist')}}">Wishlist Page</a></li>
                                <li><a href="{{route('error')}}">404 Page</a></li>
                                <li><a href="{{route('faq')}}">Faq Page</a></li>
                                <li><a href="{{route('team')}}">Team Page</a></li>
                            </ul>
                        </li>
                        <li><a href="{{route('shop')}}">Shop</a>

                        </li>
                        <li><a href="{{route('blog')}}">Blog</a>

                        </li>
                        <li><a href="{{route('contact')}}">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- End Mobile Menu -->
        <div class="mobile-menu d-block d-lg-none">
        </div>
        <!-- Mobile Menu -->
    </div>
</header>
<!-- //Header -->
<!-- Start Search Popup -->
<div class="box-search-content search_active block-bg close__top">
    <form id="search_mini_form" class="minisearch" method="POST">
        <div class="field__search">
            <input type="text" id="searchBox" placeholder="Search for book title or publisher name, book category..."
                autocomplete="on" />
            <div id="searchBox__check" class="action">
                <a href="#"><i class="zmdi zmdi-search"></i></a>
            </div>
            <div id="stats" style="color:white"></div>
            <div id="hits"></div>
        </div>
    </form>
    <div class="close__wrap">
        <span>close</span>
    </div>
</div>
<script src="{{asset('js/algolia.js')}}"></script>
<!-- END Search Popup -->
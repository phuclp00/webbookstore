<div class="site-header header-2 mb--20 d-none d-lg-block">
    <div class="header-middle pt--10 pb--10">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <a href="index.html" class="site-brand">
                        <img src="image/logo.png" alt="">
                    </a>
                </div>
                {{-- Search --}}
                <div class="col-lg-5">
                    <search-panel></search-panel>
                </div>
                <div class="col-lg-4">
                    @if(Auth::check())
                    <div class="main-navigation flex-lg-right">
                        <div class="cart-widget">
                            <div class="login-block">
                                <div>
                                    <a href="{{route('user.account.view')}}">
                                        <img src="{{asset(Auth::user()->image==null?"images/users/user_default.svg":Auth::user()->image)}}"
                                            alt="Avatar" class="rounded-circle avatar"
                                            style="width: 50px;height: 50px;border-radius: 50%;"></a>
                                </div>
                                <notifications :user="{{Auth::user()->load('notifications')}}"></notifications>

                            </div>
                            <shopping-cart></shopping-cart>
                        </div>
                        {{-- <!-- @include('menu.htm') --> --}}
                    </div>
                    @else
                    <div class="main-navigation flex-lg-right">
                        <div class="cart-widget">
                            <div class="login-block">
                                <a href="{{route('login.show')}}" class="font-weight-bold">Đăng Nhập</a> <br>
                                <span>or</span><a href="{{route('login.show')}}">Tạo tài khoản</a>
                            </div>
                            <shopping-cart></shopping-cart>
                        </div>
                        {{-- <!-- @include('menu.htm') --> --}}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom bg-primary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <nav class="category-nav white-nav  ">
                        <div>
                            <a href="javascript:void(0)" class="category-trigger"><i class="fa fa-bars"></i>Danh Mục Sản
                                Phẩm</a>
                            <ul class="category-menu">
                                @foreach ($list_category as $key => $cat )
                                @if ($cat->isRoot())
                                @if ($cat->children->count() >0)
                                <li class="cat-item has-children mega-menu {{$key>5?"hidden-menu-item":""}}"><a
                                        href="{{route('category.show',$cat->id)}}">{{$cat->name}}</a>
                                    <ul class="sub-menu">
                                        @foreach ( $cat->children as $sub_cat)
                                        @if ($sub_cat->hasChildren())
                                        <li class="single-block">
                                            <h3 class="title"><a
                                                    href="{{route('category.show',$sub_cat->id)}}">{{$sub_cat->name}}</a>
                                            </h3>
                                            <ul>
                                                @foreach ($sub_cat->children as $item)
                                                <li><a href="{{route('category.show',$item->id)}}">{{$item->name}}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @else
                                        <li><a href="{{route('category.show',$sub_cat->id)}}">{{$sub_cat}}</a></li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </li>
                                @else
                                <li class="cat-item {{$key>5?"hidden-menu-item":""}}"><a
                                        href="{{route('category.show',$cat->id)}}">{{$cat->name}}</a>
                                </li>
                                @endif
                                @endif
                                @endforeach
                                <li class="cat-item"><a href="#" class="js-expand-hidden-menu">More
                                        Categories</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-lg-2">
                    <div class="header-phone color-white">
                        <div class="icon">
                            <i class="fas fa-headphones-alt"></i>
                        </div>
                        <div class="text">
                            <p>Hỗ Trợ 24/7</p>
                            <p class="font-weight-bold number">+84 37 440 7507</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="main-navigation flex-lg-right">
                        <ul class="main-menu menu-right main-menu--white li-last-0">
                            <li class="menu-item has-children">
                                <a href="{{route('home')}}">Trang Chủ</a>
                            </li>
                            <!-- Shop -->
                            <li class="menu-item has-children mega-menu">
                                <a href="{{route('shop')}}">Shop</a>
                            </li>
                            <!-- Pages -->
                            <li class="menu-item has-children">
                                <a href="javascript:void(0)">Hỗ Trợ <i
                                        class="fas fa-chevron-down dropdown-arrow"></i></a>
                                <ul class="sub-menu">
                                    <li><a href="{{route('order.check.view')}}">Kiểm Tra Đơn Hàng</a></li>
                                    <li><a href="{{route('cart')}}">Giỏ Hàng Của Tôi</a></li>
                                    <li><a href="{{route('faq')}}">Faq</a></li>
                                    <li class="menu-item">
                                        <a href="{{route('contact')}}">Liên Hệ</a>
                                    </li>
                                </ul>
                            </li>
                            @auth
                            <!-- Tài khoản của tôi -->
                            <li class="menu-item has-children">
                                <a href="javascript:void(0)">Tài khoản<i
                                        class="fas fa-chevron-down dropdown-arrow"></i></a>
                                <ul class="sub-menu">
                                    <li><a href="{{route('user.account.view',['token'=>Auth::user()->refresh_token])}}">Trang
                                            Cá Nhân</a></li>
                                    <logout></logout>
                                </ul>
                            </li>
                            @endauth
                            <!-- Blog -->
                            <li class="menu-item has-children mega-menu">
                                <a href="{{route('blog')}}">Blog</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
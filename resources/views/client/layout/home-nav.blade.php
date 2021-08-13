<div class="sticky-init fixed-header common-sticky">
    <div class="container d-none d-lg-block">
        <div class="row align-items-center">
            <div class="col-lg-4">
                <a href="index.html" class="site-brand">
                    <img src="image/logo.png" alt="">
                </a>
            </div>
            <div class="col-lg-8">
                <div class="main-navigation flex-lg-right">
                    <ul class="main-menu menu-right ">
                        <li class="menu-item has-children">
                            <a href="{{route('home')}}">Trang Chủ</a>
                        </li>
                        <!-- Shop -->
                        <li class="menu-item has-children mega-menu">
                            <a href="{{route('shop')}}">Shop</a>
                        </li>
                        <!-- Pages -->
                        <li class="menu-item has-children">
                            <a href="javascript:void(0)">Hỗ Trợ <i class="fas fa-chevron-down dropdown-arrow"></i></a>
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
                            <a href="javascript:void(0)">Tài khoản<i class="fas fa-chevron-down dropdown-arrow"></i></a>
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
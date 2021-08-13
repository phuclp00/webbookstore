<section class="section-margin">
    <div class="container">
        <div class="promo-section-heading">
            <h2>FLASH SALE</h2>
        </div>
        <div class="product-slider with-countdown  slider-border-single-row sb-slick-slider" data-slick-setting='{
                "autoplay": true,
                "autoplaySpeed": 8000,
                "slidesToShow": 4,
                "dots":true
                }' data-slick-responsive='[
                    {"breakpoint":1400, "settings": {"slidesToShow": 4} },
                    {"breakpoint":992, "settings": {"slidesToShow": 3} },
                    {"breakpoint":768, "settings": {"slidesToShow": 2} },
                    {"breakpoint":575, "settings": {"slidesToShow": 2} },
                    {"breakpoint":490, "settings": {"slidesToShow": 1} }
                ]'>
            @foreach (cache()->get('product.flashsale') as $item)
            <div class="single-slide">
                <div class="product-card">
                    <div class="product-header">
                        <span class="author">
                            @foreach ($item->author as $key =>$author )
                            {{($key==0?" ":" - ").$author->name}}
                            @endforeach
                        </span>
                        <h3><a href="/shop/{{$item->slug()!=null?$item->slug()->slug:$item->book_name}}">
                            {{Str::limit($item->book_name,25,'...')}}
                            </a>
                        </h3>
                    </div>
                    <div class=" product-card--body">
                        <div class="card-image">
                            <img src="{{asset($item->img)}}" alt="{{$item->book_name}}">
                            <div class="hover-contents">
                                <a href="/shop/{{$item->slug()!=null?$item->slug()->slug:$item->book_name}}"
                                    class="hover-image">
                                    <img src="{{asset($item->img)}}" alt="{{$item->book_name}}"> </a>
                                <div class="hover-btns">
                                    <add-cart :product="{{$item}}"></add-cart>
                                </div>
                            </div>
                        </div>
                        <div class="price-block">
                            <span class="price">
                                {{number_format(($item->price-$item->price*($item->promotion->percent/100)),0,".",".")}}đ
                            </span>
                            <del class="price-old">{{\number_format($item->price,0,".",".")}} đ</del>
                            <span class="price-discount">{{$item->promotion->percent}} %</span>
                        </div>
                        <div class="count-down-block">
                            <div class="product-countdown" data-countdown="{{$item->promotion->date_expired}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<section class="bg-gray section-padding-top section-padding-bottom section-margin">
    <div class="container">
        <div class="row">
            <div class="col-lg">
                <div class="home-right-block">
                    @foreach (cache()->get('category.books.all') as $item )
                    <div class="single-block bg-white">
                        <div class="section-title mt-0">
                            <h2>{{$item->name}}</h2>
                        </div>
                        <div class="product-slider sb-slick-slider slider-border-single-row" data-slick-setting='{
                                                            
                                                            "autoplaySpeed": 8000,
                                                            "slidesToShow": 3,
                                                            "dots":true
                                                        }' data-slick-responsive='[
                                                            {"breakpoint":992, "settings": {"slidesToShow": 2} },
                                                            {"breakpoint":768, "settings": {"slidesToShow": 2} },
                                                            {"breakpoint":480, "settings": {"slidesToShow": 1} },
                                                            {"breakpoint":320, "settings": {"slidesToShow": 1} }
                                                        ]'>
                            @foreach ($item->books as $list_book)
                            @if (count($list_book)>0)
                            @foreach ($list_book as $book )
                            <div class="single-slide">
                                <div class="product-card">
                                    <div class="product-header">
                                        <span class="author">
                                            @foreach ($book->author as $key =>$author )
                                            {{($key==0?" ":" - ").$author->name}}
                                            @endforeach
                                        </span>
                                        <h3><a href="/shop/{{$book->slug()!=null?$book->slug()->slug:$book->book_name}}"
                                                style="height: 40px">{{Str::limit($book->book_name,25,'...'). ($book->series==null?"":" -Tập ".$book->episode)}}</a>
                                        </h3>
                                    </div>
                                    <div class="product-card--body">
                                        <div class="card-image">
                                            <img src="{{asset($book->img)}}" alt="{{$book->book_name}}">
                                            <div class="hover-contents">
                                                <a href="/shop/{{$book->slug()!=null?$book->slug()->slug:$book->book_name}}"
                                                    class="hover-image">
                                                    <img src="{{asset($book->img)}}" alt="{{$book->book_name}}"></a>
                                                <div class="hover-btns">
                                                    <add-to-cart :product="{{$book}}"></add-to-cart>
                                                    <a href="javascript:void(0)" class="single-btn">
                                                        <i class="fas fa-heart"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" class="single-btn">
                                                        <i class="fas fa-random"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" data-toggle="modal"
                                                        data-target="#quickModal" class="single-btn">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @if($book->promotion !=null)
                                        <div class="price-block">
                                            <span
                                                class="price">{{number_format(($book->price-$book->price*($book->promotion->percent/100)),0,".",".")}}
                                                đ</span>
                                            <del class="price-old">{{\number_format($book->price,0,".",".")}} đ</del>
                                            <span class="price-discount">{{$book->promotion->percent}} %</span>
                                        </div>
                                        @else
                                        <div class="price-block">
                                            <span class="price">{{\number_format($book->price,0,".",".")}} đ</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<section class="hero-area hero-slider-2">
    <div class="container">
        <div class="row align-items-lg-center">
            <div class="col-12">
                <div class="sb-slick-slider" data-slick-setting='{
                                                                "autoplay": true,
                                                                "autoplaySpeed": 8000,
                                                                "slidesToShow": 1,
                                                                "dots":true}'>

                    @foreach ($hero_item as $image )
                    <div class="single-slide bg-image" data-bg="{{asset('images/bg-image/'.$image->thumb)}}">
                        <div class="home-content pl--30">
                            <div class="row">
                                <div class="col-lg-7">
                                    {!!$image->description!!}
                                    <a href="{{$image->link}}" class="btn btn-outlined--primary">
                                        Shop Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
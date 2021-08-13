@extends('client.sections.static.index')
@section('main-body')
<section class="breadcrumb-section">
	<h2 class="sr-only">Site Breadcrumb</h2>
	<div class="container">
		<div class="breadcrumb-contents">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.html">Home</a></li>
					<li class="breadcrumb-item"><a href="index.html">Shop</a></li>
					<li class="breadcrumb-item active">{{$product->book_name}}</li>
				</ol>
			</nav>
		</div>
	</div>
</section>
<product-detail
	:product_detail="{{$product->load('author', 'category', 'publisher', 'format', 'supplier', 'series', 'translator', 'tags','lang','thumb','rating','promotion')}}"
	:view="{{$view}}">
</product-detail>
<!--=================================
	    RELATED PRODUCTS BOOKS
===================================== -->
@if ($related)
<section class="">
	<div class="container">
		<div class="section-title section-title--bordered text-capitalize">
			<h2>Có thể bạn sẽ quan tâm</h2>
		</div>
		<div class="product-slider sb-slick-slider slider-border-single-row" data-slick-setting='{
                "autoplay": true,
                "autoplaySpeed": 8000,
                "slidesToShow": 4,
                "dots":true
            }' data-slick-responsive='[
                {"breakpoint":1200, "settings": {"slidesToShow": 4} },
                {"breakpoint":992, "settings": {"slidesToShow": 3} },
                {"breakpoint":768, "settings": {"slidesToShow": 2} },
                {"breakpoint":480, "settings": {"slidesToShow": 1} }
            ]'>
			@foreach ($related as $book )
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
									<a href="javascript:void(0)" data-toggle="modal" data-target="#quickModal"
										class="single-btn">
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

		</div>
	</div>
</section>
@endif
@endsection
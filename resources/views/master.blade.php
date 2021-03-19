<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Home | Bookshop Responsive Bootstrap4 Template - SHARED ON THEMELOCK.COM</title>
	<meta name="description" content="Home | Bookshop Responsive Bootstrap4 Template - SHARED ON THEMELOCK.COM ">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}" />

	<!-- Favicons -->
	<link rel="shortcut icon" href="{{asset('asset/frontend/images/favicon.ico')}}">
	<link rel="apple-touch-icon" href="{{asset('asset/frontend/images/icon.png')}}">

	<!-- Google font (font-family: 'Roboto', sans-serif; Poppins ; Satisfy) -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,600,600i,700,700i,800"
		rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{asset('asset/frontend/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('asset/frontend/css/plugins.css')}}">
	<link rel="stylesheet" href="{{asset('asset/frontend/style.css')}}">

	<!-- Cusom css -->
	<link rel="stylesheet" href="{{asset('asset/frontend/css/custom.css')}}">

	<!-- Modernizer js -->
	<script src="{{asset('asset/frontend/js/vendor/jquery-3.6.0.min.js')}}"></script>
	<script src="{{asset('asset/frontend/js/vendor/modernizr-3.5.0.min.js')}}"></script>
</head>

<body>
	<div id="loading">
        <div id="loading-center">
        </div>
    </div>
	<div id="app" class="wrapper">
		<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->
		@yield('content')
		<!-- Main wrapper -->
		<div id="myModal" class="modal">
			<!-- Modal content -->
			<div class="modal-content">
				<div class="modal-header">
					<h2 class=" close title__be--2">CLOSE</h2>
				</div>
				<div class="modal-body">
					<div class="section__title text-center">
						<h2 class="title__be--1" style="font-family: 'Times New Roman', Times, serif">Bạn vừa đặt hàng
							thành công</h2>
					</div>
				</div>
				<div class="modal-footer">
					<h3 class="title__be--1">Click any where to close this pop-up</h3>
				</div>
			</div>
		</div>
		<!-- Footer Area -->
		<footer id="wn__footer" class="footer__area bg__cat--8 brown--color">
			<div class="footer-static-top">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="footer__widget footer__menu">
								<div class="ft__logo">
									<a href="#">
										<img src="{{asset('asset/frontend/images/logo/3.png')}}" alt="logo">
									</a>
									<p>There are many variations of passages of Lorem Ipsum available, but the majority
										have suffered duskam alteration variations of passages</p>
								</div>
								<div class="footer__content">
									<ul class="social__net social__net--2 d-flex justify-content-center">
										<li><a href="#"><i class="bi bi-facebook"></i></a></li>
										<li><a href="#"><i class="bi bi-google"></i></a></li>
										<li><a href="#"><i class="bi bi-twitter"></i></a></li>
										<li><a href="#"><i class="bi bi-linkedin"></i></a></li>
										<li><a href="#"><i class="bi bi-youtube"></i></a></li>
									</ul>
									<ul class="mainmenu d-flex justify-content-center">
										<li><a href="#">Trending</a></li>
										<li><a href="#">Best Seller</a></li>
										<li><a href="#">All Product</a></li>
										<li><a href="#">Wishlist</a></li>
										<li><a href="#">Blog</a></li>
										<li><a href="#">Contact</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="copyright__wrapper">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12">
							<div class="copyright">
								<div class="copy__right__inner text-left">
									<p>Copyright <i class="fa fa-copyright"></i> <a href="#">Boighor.</a> All Rights
										Reserved</p>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12">
							<div class="payment text-right">
								<img src="{{asset('asset/frontend/images/icons/payment.png')}}" alt="" />
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- //Footer Area -->
		<!-- //Main wrapper -->
	</div>

	<!-- JS Files -->
	<script>
		var modal = document.getElementById("myModal");

		// Get the button that opens the modal
		var btn = document.getElementById("myBtn");

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];

		// When the user clicks the button, open the modal 
		

		// When the user clicks on <span> (x), close the modal
			
		span.onclick = function() {
			modal.style.display = "none";
			location.reload();
		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
			location.reload();
			}
		}

    
	</script>
	<script src="{{asset('asset/frontend/js/popper.min.js')}}"></script>
	<script src="{{asset('asset/frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('asset/frontend/js/plugins.js')}}"></script>
	<script src="{{asset('asset/frontend/js/active.js')}}"></script>
</body>

</html>
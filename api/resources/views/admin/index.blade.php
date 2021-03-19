<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Booksto - Responsive Bootstrap 4 Admin Dashboard Template</title>
    <link rel="stylesheet" href="{{asset('/css/jquery-confirm.min.css')}}">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('asset/images/favicon.ico')}}" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('asset/css/bootstrap.min.css')}}">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{asset('asset/css/typography.css')}}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('asset/css/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('asset/css/responsive.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js" type="text/javascript"></script>
    <link rel="stylesheet" href="{{asset('/css/app.css')}}" />
    <script src="{{asset('js/jquery.min.js')}}"></script>


</head>

<body>
    
    @if(session()->has('info_warning'))
    <script>
        $.dialog({
         title: '<text style="color:red;margin:0px auto">Messenger To You !</text>',
         content: '{!!session()->get('info_warning')!!}',
      });
    </script>
    @endif
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <div id="wrapper" class="wrapper">
        <!-- loader END -->
        @include('admin.menu.menu')
        <!-- Page Content  -->
        @yield('admin_section')
        <!-- Wrapper END -->
        <!-- Footer -->
    </div>
    </footer>

    <!-- Footer END -->
    <!-- color-customizer -->
    <div class="iq-colorbox color-fix">
        <div class="buy-button"> <a class="color-full" href="#"><i class="fa fa-spinner fa-spin"></i></a> </div>
        <div id="right-sidebar-scrollbar" class="iq-colorbox-inner">
            <div class="clearfix color-picker">
                <h3 class="iq-font-black">Booksto Awesome Color</h3>
                <p>This color combo available inside whole template. You can change on your wish, Even you can create
                    your own with limitless possibilities! </p>
                <ul class="iq-colorselect clearfix">
                    <li class="color-1 iq-colormark" data-style="color-1"></li>
                    <li class="color-2" data-style="iq-color-2"></li>
                    <li class="color-3" data-style="iq-color-3"></li>
                    <li class="color-4" data-style="iq-color-4"></li>
                    <li class="color-5" data-style="iq-color-5"></li>
                    <li class="color-6" data-style="iq-color-6"></li>
                    <li class="color-7" data-style="iq-color-7"></li>
                    <li class="color-8" data-style="iq-color-8"></li>
                    <li class="color-9" data-style="iq-color-9"></li>
                    <li class="color-10" data-style="iq-color-10"></li>
                    <li class="color-11" data-style="iq-color-11"></li>
                    <li class="color-12" data-style="iq-color-12"></li>
                    <li class="color-13" data-style="iq-color-13"></li>
                    <li class="color-14" data-style="iq-color-14"></li>
                    <li class="color-15" data-style="iq-color-15"></li>
                    <li class="color-16" data-style="iq-color-16"></li>
                    <li class="color-17" data-style="iq-color-17"></li>
                    <li class="color-18" data-style="iq-color-18"></li>
                    <li class="color-19" data-style="iq-color-19"></li>
                    <li class="color-20" data-style="iq-color-20"></li>
                </ul>
                <a target="_blank" class="btn btn-primary d-block mt-3" href="#">Purchase Now</a>
            </div>
        </div>
    </div>
    <!-- color-customizer END -->
    <!-- Optional JavaScript -->
    <script src={{asset("/js/app.js")}}></script>
    <script type="text/javascript" src="{{ asset('/js/jquery-confirm.min.js') }}"></script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('asset/js/ls.js')}}" type="text/javascript"></script>
    <script src="{{asset('asset/js/admin_ajax.js')}}"></script>
    <script src="{{asset('asset/js/jquery.min.js')}}"></script>
    <script src="{{asset('asset/js/popper.min.js')}}"></script>
    <script src="{{asset('asset/js/bootstrap.min.js')}}"></script>
    <!-- Appear JavaScript -->
    <script src="{{asset('asset/js/jquery.appear.js')}}"></script>
    <!-- Countdown JavaScript -->
    <script src="{{asset('asset/js/countdown.min.js')}}"></script>
    <!-- Counterup JavaScript -->
    <script src="{{asset('asset/js/waypoints.min.js')}}"></script>
    <script src="{{asset('asset/js/jquery.counterup.min.js')}}"></script>
    <!-- Wow JavaScript -->
    <script src="{{asset('asset/js/wow.min.js')}}"></script>
    <!-- Apexcharts JavaScript -->
    <script src="{{asset('asset/js/apexcharts.js')}}"></script>
    <!-- Slick JavaScript -->
    <script src="{{asset('asset/js/slick.min.js')}}"></script>
    <!-- Select2 JavaScript -->
    <script src="{{asset('asset/js/select2.min.js')}}"></script>
    <!-- Owl Carousel JavaScript -->
    <script src="{{asset('asset/js/owl.carousel.min.js')}}"></script>
    <!-- Magnific Popup JavaScript -->
    <script src="{{asset('asset/js/jquery.magnific-popup.min.js')}}"></script>
    <!-- Smooth Scrollbar JavaScript -->
    <script src="{{asset('asset/js/smooth-scrollbar.js')}}"></script>
    <!-- lottie JavaScript -->
    <script src="{{asset('asset/js/lottie.js')}}"></script>
    <!-- am core JavaScript -->
    <script src="{{asset('asset/js/core.js')}}"></script>
    <!-- am charts JavaScript -->
    <script src="{{asset('asset/js/charts.js')}}"></script>
    <!-- am animated JavaScript -->
    <script src="{{asset('asset/js/animated.js')}}"></script>
    <!-- am kelly JavaScript -->
    <script src="{{asset('asset/js/kelly.js')}}"></script>
    <!-- am maps JavaScript -->
    <script src="{{asset('asset/js/maps.js')}}"></script>
    <!-- am worldLow JavaScript -->
    <script src="{{asset('asset/js/worldLow.js')}}"></script>
    <!-- Raphael-min JavaScript -->
    <script src="{{asset('asset/js/raphael-min.js')}}"></script>
    <!-- Morris JavaScript -->
    <script src="{{asset('asset/js/morris.js')}}"></script>
    <!-- Morris min JavaScript -->
    <script src="{{asset('asset/js/morris.min.js')}}"></script>
    <!-- Flatpicker Js -->
    <script src="{{asset('asset/js/flatpickr.js')}}"></script>
    <!-- Style Customizer -->
    <script src="{{asset('asset/js/style-customizer.js')}}"></script>
    <!-- Chart Custom JavaScript -->
    <script src="{{asset('asset/js/chart-custom.js')}}"></script>
    <!-- Custom JavaScript -->
    <script src="{{asset('asset/js/custom.js')}}"></script>

</body>

<!-- Mirrored from iqonic.design/themes/booksto/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 01 Aug 2020 14:10:36 GMT -->

</html>
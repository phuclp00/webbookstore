<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Booksto - Responsive Bootstrap 4 Admin Dashboard Template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('asset/backend/images/favicon.ico')}}" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('asset/backend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset/backend/css/dataTables.bootstrap4.min.css')}}">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{asset('asset/backend/css/typography.css')}}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('asset/backend/css/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('asset/backend/css/responsive.css')}}">
    {{-- Option CSS --}}
    <link rel="stylesheet" href="{{asset('asset/backend/css/jquery-confirm.min.css')}}">
    <script src="https://cdn.ckeditor.com/ckeditor5/27.0.0/classic/ckeditor.js"></script>
    <script type="text/javascript" src="/js/ckfinder/ckfinder.js"></script>

</head>

<body>
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>

    <div id="app" class="wrapper">
        <!-- loader END -->
        @include('admin.menu.menu')
        <!-- Page Content  -->
        @yield('admin_section')
        <!-- Wrapper END -->
        <!-- Footer -->
    </div>
    @include('admin.page.footer')
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
    <script src="{{asset('asset/backend/js/jquery.min.js')}}"></script>
    <script src="{{asset('asset/backend/js/popper.min.js')}}"></script>
    <script src="{{asset('asset/backend/js/bootstrap.min.js')}}"></script>
    {{-- <script src="{{asset('asset/backend/js/jquery.dataTables.min.js')}}"></script> --}}
    {{-- <script src="{{asset('asset/backend/js/dataTables.bootstrap4.min.js')}}"></script> --}}
    {{-- <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script> --}}
    <script src="{{asset('asset/backend/js/jquery-confirm.min.js')}}"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- Appear JavaScript -->
    <script src="{{asset('asset/backend/js/jquery.appear.js')}}"></script>
    <!-- Countdown JavaScript -->
    <script src="{{asset('asset/backend/js/countdown.min.js')}}"></script>
    <!-- Counterup JavaScript -->
    <script src="{{asset('asset/backend/js/waypoints.min.js')}}"></script>
    <script src="{{asset('asset/backend/js/jquery.counterup.min.js')}}"></script>
    <!-- Wow JavaScript -->
    <script src="{{asset('asset/backend/js/wow.min.js')}}"></script>
    <!-- Apexcharts JavaScript -->
    <script src="{{asset('asset/backend/js/apexcharts.js')}}"></script>
    <!-- Slick JavaScript -->
    <script src="{{asset('asset/backend/js/slick.min.js')}}"></script>
    <!-- Select2 JavaScript -->
    <script src="{{asset('asset/backend/js/select2.min.js')}}"></script>
    <!-- Owl Carousel JavaScript -->
    <script src="{{asset('asset/backend/js/owl.carousel.min.js')}}"></script>
    <!-- Magnific Popup JavaScript -->
    <script src="{{asset('asset/backend/js/jquery.magnific-popup.min.js')}}"></script>
    <!-- Smooth Scrollbar JavaScript -->
    <script src="{{asset('asset/backend/js/smooth-scrollbar.js')}}"></script>
    <!-- lottie JavaScript -->
    <script src="{{asset('asset/backend/js/lottie.js')}}"></script>
    <!-- am core JavaScript -->
    <script src="{{asset('asset/backend/js/core.js')}}"></script>
    <!-- am charts JavaScript -->
    <script src="{{asset('asset/backend/js/charts.js')}}"></script>
    <!-- am animated JavaScript -->
    <script src="{{asset('asset/backend/js/animated.js')}}"></script>
    <!-- am kelly JavaScript -->
    <script src="{{asset('asset/backend/js/kelly.js')}}"></script>
    <!-- am maps JavaScript -->
    <script src="{{asset('asset/backend/js/maps.js')}}"></script>
    <!-- am worldLow JavaScript -->
    <script src="{{asset('asset/backend/js/worldLow.js')}}"></script>
    <!-- Raphael-min JavaScript -->
    <script src="{{asset('asset/backend/js/raphael-min.js')}}"></script>
    <!-- Morris JavaScript -->
    <script src="{{asset('asset/backend/js/morris.js')}}"></script>
    <!-- Morris min JavaScript -->
    <script src="{{asset('asset/backend/js/morris.min.js')}}"></script>
    <!-- Flatpicker Js -->
    <script src="{{asset('asset/backend/js/flatpickr.js')}}"></script>
    <!-- Style Customizer -->
    <script src="{{asset('asset/backend/js/style-customizer.js')}}"></script>
    <!-- Chart Custom JavaScript -->
    <script src="{{asset('asset/backend/js/chart-custom.js')}}"></script>
    <!-- Custom JavaScript -->
    <script src="{{asset('asset/backend/js/custom.js')}}"></script>
    <script src="{{asset('asset/backend/js/admin_ajax.js')}}"></script>
    <script src="{{asset('asset/backend/js/ls.js')}}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    @include('ckfinder::setup')
    <script>
        CKFinder.config( { connectorPath: '/ckfinder/connector',displayFoldersPanel:false } );
    </script>
    <script>
        ClassicEditor.create( document.querySelector( '#editor' ), {
            toolbar:{
                items: [
                    'heading', '|',
                    'bold', 'italic', '|',
                    'link', '|',
                    'bulletedList', 'numberedList', '|',
                    'insertTable', '|',
                    'outdent', 'indent', '|',
                    'uploadImage', 'blockQuote', '|',
                    'undo', 'redo' ,'|',
                    'ckfinder'
                    ],
            },
            ckfinder: {
               uploadUrl:'http://booksto.tk/ckfinder/connector?command=FileUpload&lang=vi&langCode=vi&type=Trash&currentFolder=%2F&hash=90636d853368df3a&responseType=json' ,
            },
          });
    </script>
    @include('vendor.notifications.feeback')
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    @include('client.layout.head')
    @include('client.layout.header.css')
    @include('client.layout.header.links')
</head>

<body>
    @yield('main-body')
    <!--=================================
    Brands Slider
    ===================================== -->
    @include('client.sections.home.brands-silder')
    <!--=================================
    Footer Area
    ===================================== -->
    @include('client.layout.footer')
    <!-- Use Minified Plugins Version For Fast Page Load -->
    @include('client.layout.header.js')
</body>

</html>
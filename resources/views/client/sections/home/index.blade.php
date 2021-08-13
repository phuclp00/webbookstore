@extends('client.sections.static.index')
@section('main-body')
@include('client.layout.home-nav')
<!--=================================
        Hero Area
        ===================================== -->
@include('client.sections.home.hero')
<!--=================================
        Home Features Section
        ===================================== -->
@include('client.sections.home.features')
<!--=================================
        Deal of the day 
        ===================================== -->
@include('client.sections.home.deals')
<!--=================================
        Promotion Section One
        ===================================== -->
@include('client.sections.home.promotion-one')
<!--=================================
        Home Slider Tab
        ===================================== -->
@include('client.sections.home.slider-tab')
<!--=================================
        Home Two Column Section
        ===================================== -->
@include('client.sections.home.two-column')
<!--=================================
        CHILDREN’S BOOKS SECTION
        ===================================== -->
@include('client.sections.home.childrens-books')
<!--=================================
        Promotion Section Two
        ===================================== -->
@include('client.sections.home.promotion-two')

<!--=================================
    Footer
    ===================================== -->
@endsection
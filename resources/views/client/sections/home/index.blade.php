@extends('client.sections.static.index')
@section('main-body')
<div class="site-wrapper" id="top">
    @include('client.layout.header')
    <div class="site-mobile-menu">
        @include('client.layout.mobile.header')
        @include('client.layout.mobile.aside')
    </div>
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
    <!-- Modal -->
    @include('client.sections.home.modal')
    <!--=================================
        Footer
        ===================================== -->
</div>
@endsection
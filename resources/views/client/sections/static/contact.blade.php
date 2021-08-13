@extends('client.sections.static.index')
@section('main-body')
<section class="breadcrumb-section">
    <h2 class="sr-only">Site Breadcrumb</h2>
    <div class="container">
        <div class="breadcrumb-contents">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Contact</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<!-- Cart Page Start -->
<main class="contact_area inner-page-sec-padding-bottom">
    <contact></contact>
</main>
<!-- Cart Page End -->
<!--=================================
@endsection
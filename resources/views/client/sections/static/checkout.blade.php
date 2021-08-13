@extends('client.sections.static.index')
@section('main-body')
<section class="breadcrumb-section">
    <h2 class="sr-only">Site Breadcrumb</h2>
    <div class="container">
        <div class="breadcrumb-contents">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<main id="content" class="page-section inner-page-sec-padding-bottom space-db--20">
    @if(Auth::check())
    <checkout :user="{{Auth::user()->load('phone','address')}}"></checkout>
    @else
    <checkout :user="null"></checkout>
    @endif
</main>
@endsection
@extends('client.sections.static.index')
@section('main-body')
<section class="breadcrumb-section">
    <h2 class="sr-only">Site Breadcrumb</h2>
    <div class="container">
        <div class="breadcrumb-contents">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Order Complete</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<!-- order complete Page Start -->
<order-check></order-check>
<!-- order complete Page End -->
@endsection
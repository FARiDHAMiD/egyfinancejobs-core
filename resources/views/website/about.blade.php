@extends('website.app')
@section('website.content')

<!-- About Us start -->
<div class="job-listing-section main">
    <div class="container">
        <h1 class="h3 mb-3 text-center">About Us</h1>
        <div class="border-box bg-white">
            <p>
                {!! nl2br(e($about->about_company)) !!}
            </p>
        </div>
    </div>
</div>
<!-- About Us end -->
@endsection
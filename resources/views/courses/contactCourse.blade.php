@extends('courses.main')
@section('courses.content')

<!-- Breadcrumb -->
<div class="breadcrumbs overlay" style="background-image:url('{{asset('courses_template/images/breadcrumb-bg.jpg')}}')">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <h2>Conatc Us</h2>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="bread-list">
                    <li><a href="{{route('courses.index')}}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="#">Conatc Us<i class="fa fa-angle-right"></i></a></li>
                    <li class=""><a href="{{route('courses.faqs')}}">FAQs<i class="fa fa-angle-right"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--/ End Breadcrumb -->

<!-- Contact Us -->
<section id="contact" class="contact section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <div class="section-title bg">
                    <h2>Contact <span>Us</span></h2>
                    <p>We’d love to hear from you! Whether you have questions about our courses, need assistance with
                        your account, or want to learn more about our offerings, our team is here to help.</p>
                    <div class="icon"><i class="fa fa-paper-plane"></i></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5 col-md-5 col-12">
                <div class="form-head">
                    <!-- Contact Form -->
                    <form class="form" method="POST" action="{{route('website.contact_us.create')}}">
                        @csrf
                        <div class="row">
                            @if(!auth()->check())
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <i class="fa fa-user"></i>
                                    <input type="text" name="name" class="@error('name') is-invalid @enderror"
                                        value="{{old('name')}}" placeholder="Full Name ..." required>
                                </div>

                                @error('name')
                                <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                                @enderror
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <i class="fa fa-phone"></i>
                                    <input type="text" name="mobile"
                                        class="input-text @error('mobile') is-invalid @enderror"
                                        value="{{old('mobile')}}" placeholder="Mobile No.">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <i class="fa fa-envelope"></i>
                                    <input type="email" name="email" class="@error('email') is-invalid @enderror"
                                        value="{{old('email')}}" placeholder="Please provide valid email address ...">

                                    @error('email')
                                    <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                                    @enderror
                                </div>
                            </div>
                            @endif
                            <div class="col-12">
                                <div class="form-group message">
                                    <i class="fa fa-pencil"></i>
                                    <textarea name="description"
                                        class="input-text @error('description') is-invalid @enderror"
                                        placeholder="Please describe how we can help you" rows="6"
                                        required>{{old('description')}}</textarea>
                                </div>
                            </div>
                            @auth
                            @else

                            <div class="my-2 d-flex justify-content-center">
                                {!!htmlFormSnippet()!!}
                                @error('g-recaptcha-response')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            @endauth

                            <div class="col-12">
                                <div class="form-group">
                                    <div class="button">
                                        <button type="submit" class="btn primary">Send Message</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                    <!--/ End Contact Form -->
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-12">
                <div class="contact-right">
                    <!-- Contact-Info -->
                    <div class="contact-info">
                        <div class="icon"><i class="fa fa-map"></i></div>
                        <h3>Our Location</h3>
                        <p>Heliopolis Sq., Cairo, Egypt.</p>
                    </div>
                    <div id="map">
                        <gmp-map center="30.090984, 31.322708" zoom="10" map-id="DEMO_MAP_ID" style="height: 400px">
                            <gmp-advanced-marker position="30.090984, 31.322708" title="Heliopolis, Cairo.">
                            </gmp-advanced-marker>
                            <gmp-advanced-marker position="30.090984, 31.322708" title="Elnozha, Cairo">
                            </gmp-advanced-marker>
                        </gmp-map>
                    </div>

                    <!-- Contact-Info -->
                    <div class="contact-info">
                        <div class="icon"><i class="fa fa-envelope"></i></div>
                        <h3>contact information</h3>
                        <p><a href="mailto:info@egyfinancejobs.com">info@egyfinancejobs.com</a></p>
                        <p> 01001085717</p>
                    </div>
                    <!-- Contact-Info -->
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Contact Us -->
@endsection
@section('scripts')
<script>
    function initMap() {}
</script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBoyx41RY9j0uxYImbXPWo_2eSC9IRGcjQ&libraries=maps,marker&v=beta"
    defer>

</script>

@endsection
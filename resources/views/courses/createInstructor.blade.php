@extends('courses.main')
@section('courses.content')

<!-- Breadcrumb -->
<div class="breadcrumbs overlay" style="background-image:url('{{asset('courses_template/images/breadcrumb-bg.jpg')}}')">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <h2>Apply As Instructor</h2>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="bread-list">
                    <li><a href="{{route('courses.index')}}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="{{route('courses.instructors')}}">Instructors<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="#">Create Instructor<i class="fa fa-angle-right"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--/ End Breadcrumb -->

<!-- Profile -->
<section class="contact section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <div class="section-title bg">
                    <h2>Join Our Awesome Community <span></span></h2>
                    <p>The best way to learn is to teach. By sharing your knowledge, you not only inspire others but
                        also grow yourself.</p>
                    <div class="icon"><i class="fa fa-user-tie"></i></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5 col-12">
                <div class="faq-image">
                    <img src="{{asset('courses_template/images/teachers/teacher-create.jpg')}}" alt="#">
                </div>
            </div>
            <div class="col-lg-7 col-12">
                <!-- Instructor Create Form -->
                <div class="form-head">
                    <form class="form" method="POST" action="{{route('instructor.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <i class="fa fa-user"></i>
                                    <input name="first_name" type="text" placeholder="First name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <i class="fa fa-user"></i>
                                    <input name="last_name" type="text" placeholder="Last name">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <i class="fa fa-envelope"></i>
                                    <input name="email" type="email" placeholder="Email address">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <i class="fa fa-key"></i>
                                    <input name="password" type="password" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <i class="fa fa-key"></i>
                                    <input name="password_confirmation" type="password" placeholder="Confirm Password"
                                        required>
                                </div>
                            </div>
                            <div class="my-2 d-flex justify-content-center">
                                {!!htmlFormSnippet()!!}
                                @error('g-recaptcha-response')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <div class="button">
                                        <button type="submit" class="btn primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--/ End Instructor Create Form -->
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Faqs -->

@endsection
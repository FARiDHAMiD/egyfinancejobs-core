@extends('courses.main')
@section('courses.content')
<style>
    .profile_image {
        width: 120%;
        max-width: 450px;
    }
</style>

<!-- Breadcrumb -->
<div class="breadcrumbs overlay" style="background-image:url('{{asset('courses_template/images/breadcrumb-bg.jpg')}}')">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <h2>Welcome, {{auth()->user()->first_name}}</h2>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="bread-list">
                    <li><a href="{{route('courses.index')}}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="{{route('courses.instructorProfile', auth()->user()->uuid)}}">Profile<i
                                class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="#">Edit<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="{{route('logout')}}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout<i
                                class="fa fa-angle-right"></i></a></li>
                    <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
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
                    <h2>Edit Profile <span></span></h2>
                    <p>Great educators don’t just share knowledge; they create environments where students thrive and
                        realize their true potential.</p>
                    <div class="icon"><i class="fa fa-question"></i></div>
                </div>
            </div>
        </div>
        <form enctype="multipart/form-data" class="form" method="POST"
            action="{{route('instructor.update', auth()->user()->id)}}">
            @csrf
            <div class="row">

                <div class="col-lg-7 col-12">
                    <!-- Instructor Create Form -->
                    <div class="form-head">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <input name="first_name" type="text" placeholder="First name"
                                        value="{{$instructor->first_name}}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <input name="last_name" type="text" placeholder="Last name"
                                        value="{{$instructor->last_name}}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <input name="job_title" type="text" placeholder="Job Title"
                                        value="{{$profile->job_title}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <input name="qualification" type="text" placeholder="Qualification"
                                        value="{{$profile->qualification}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <input name="birthdate" placeholder="Date Of Birth" onfocus="(this.type='date')"
                                        onblur="if(!this.value) this.type='text'" value="{{$profile->birthdate}}"
                                        required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <input name="mobile" placeholder="Mobile No." type="text"
                                        value="{{$profile->mobile}}" required>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <input name="address" type="text" placeholder="Address"
                                        value="{{$profile->address}}" required>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <textarea name="bio" cols="30" rows="3"
                                        placeholder="Bio">{{$profile->bio}}</textarea>
                                </div>
                            </div>
                            <hr>
                            <h6 class="text-dark ml-2 mb-2">Add your social links</h6>
                            <div class="row">

                                <div class="col-md-6 col-12 my-2">
                                    <div class="form-group">
                                        <label class="text-weight-bold ml-2">Facebook
                                            <i class="fa fa-facebook"></i>
                                        </label>
                                        <input type="text" name="facebook" placeholder="Facebook"
                                            value="{{$instructor->user_social_links != null ? $instructor->user_social_links->facebook : ''}}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 my-2">
                                    <div class="form-group">
                                        <label class="text-weight-bold ml-2">LinkedIn
                                            <i class="fa fa-linkedin"></i>
                                        </label>
                                        <input type="text" name="linkedin" placeholder="Linkedin"
                                            value="{{$instructor->user_social_links != null ? $instructor->user_social_links->linkedin : ''}}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 my-2">
                                    <div class="form-group">
                                        <label class="text-weight-bold ml-2">Youtube
                                            <i class="fa fa-youtube"></i></label>
                                        <input type="text" name="youtube" placeholder="Youtube"
                                            value="{{$instructor->user_social_links != null ? $instructor->user_social_links->youtube : ''}}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 my-2">
                                    <div class="form-group">
                                        <label class="text-weight-bold ml-2">Website
                                            <i class="fa fa-link"></i>
                                        </label>
                                        <input type="text" name="website" placeholder="Website"
                                            value="{{$instructor->user_social_links != null ? $instructor->user_social_links->website : ''}}" />
                                    </div>
                                </div>

                            </div>
                        </div>



                        <!--/ End Instructor Create Form -->
                    </div>
                </div>

                <div class="col-lg-5 col-12">
                    {{-- <div class="instructor-image">
                        <img src="{{asset('courses_template/images/faq.png')}}" alt="#">
                    </div> --}}
                    <div class="row align-items-center upload-image-box">
                        <div class="mb-3 col-lg-12 d-flex align-items-center">
                            <div class="mr-3">
                                <div class="user-image-circle text-center">
                                    <img class="image"
                                        src="{{ empty($instructor->getFirstMedia('instructor_profile')) ? asset('/website/img/avatar.png') : $instructor->getFirstMedia('instructor_profile')->getUrl() }}"
                                        alt="" height="150" width="150">
                                    <div class="my-2 text-center">
                                        <p class="text-dark m-0"><strong>You can upload a .jpg, .png, or
                                                .gif
                                                photo with max size of 5MB</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 col-lg-12 text-lg-center">
                            <label for="profile_img" class="btn btn-default py-2">
                                Upload Your image
                            </label>
                            <input id="profile_img" type="file" name="profile_img" class="d-none image-input">
                        </div>
                    </div>
                </div>


                <div class="col-12">
                    <div class="form-group">
                        <div class="button">
                            <button type="submit" class="btn primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!--/ End Faqs -->

@endsection
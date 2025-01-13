@extends('courses.main')
@section('courses.content')
<style>
    .profile_image {
        width: 100%;
        /* max-width: 350px; */
        max-height: 320px;
        min-height: 320px;
    }
</style>

<!-- Breadcrumb -->
<div class="breadcrumbs overlay" style="background-image:url('{{asset('courses_template/images/breadcrumb-bg.jpg')}}')">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <h2>Our Teachers</h2>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="bread-list">
                    <li><a href="{{route('courses.index')}}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="#">Instructors<i class="fa fa-angle-right"></i></a></li>
                    @if(auth()->check() && !auth()->user()->hasRole('instructor') && auth()->check() &&
                    !auth()->user()->hasRole('admin'))
                    <li><a href="{{route('instructor.create')}}">Apply as instructor<i
                                class="fa fa-angle-right"></i></a></li>
                    @elseif(auth()->check() && auth()->user()->hasRole('instructor'))
                    <li><a href="{{route('courses.instructorProfile', auth()->user()->uuid)}}">My Profile<i
                                class="fa fa-angle-right"></i></a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
<!--/ End Breadcrumb -->

<!-- Teachers -->
<section class="teachers archive section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <div class="section-title bg">
                    <h2>Our <span>Advisors</span></h2>
                    <p>Teaching is not just about transferring knowledge, it’s about inspiring curiosity, fostering
                        growth, and empowering others to believe in their potential.</p>
                    <div class="icon"><i class="fa fa-users"></i></div>
                </div>
            </div>
        </div>
        <div class="row">

            @foreach ($instructors as $instructor)
            @if($instructor->instructor_profile)
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Single Teacher -->
                <div class="single-teacher">
                    <div class="teacher-head overlay">
                        <img src="{{ empty($instructor->getFirstMedia('instructor_profile')) ? asset('/website/img/teacher-avatar.png') : $instructor->getFirstMedia('instructor_profile')->getUrl() }}"
                            alt="" class="profile_image">
                        <ul class="social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                    <div class="teacher-content">
                        <a href="{{route('courses.instructorProfile', $instructor->uuid)}}" class="text-dark">
                            <h4>{{$instructor->first_name}}
                                {{$instructor->last_name}}<span>{{$instructor->instructor_profile->job_title}}</span>
                            </h4>
                        </a>
                    </div>
                </div>
                <!--/ End Single Teacher -->
            </div>
            @endif
            @endforeach


            <div class="col-lg-4 col-md-6 col-12">
                <!-- Single Teacher -->
                <div class="single-teacher">
                    <div class="teacher-head overlay">
                        <img src="{{asset('courses_template/images/teachers/teacher-5.jpg')}}" class="profile_image"
                            alt="#" class="profile_image">
                        <ul class="social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                    <div class="teacher-content">
                        <h4>Ahmed Mostafa<span>Software Developer</span></h4>
                    </div>
                </div>
                <!--/ End Single Teacher -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Single Teacher -->
                <div class="single-teacher">
                    <div class="teacher-head overlay">
                        <img src="{{asset('courses_template/images/teachers/teacher-3.jpg')}}" class="profile_image"
                            alt="#">
                        <ul class="social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                    <div class="teacher-content">
                        <h4>William Holex<span>Civil Engineer</span></h4>
                    </div>
                </div>
                <!--/ End Single Teacher -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Single Teacher -->
                <div class="single-teacher">
                    <div class="teacher-head overlay">
                        <img src="{{asset('courses_template/images/teachers/teacher-4.jpg')}}" class="profile_image"
                            alt="#">
                        <ul class="social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                    <div class="teacher-content">
                        <h4>Boamia Rone<span>Ui Designer</span></h4>
                    </div>
                </div>
                <!--/ End Single Teacher -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Single Teacher -->
                <div class="single-teacher">
                    <div class="teacher-head overlay">
                        <img src="{{asset('courses_template/images/teachers/teacher-1.jpg')}}" class="profile_image"
                            alt="#">
                        <ul class="social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                    <div class="teacher-content">
                        <h4>Rohan Jonson<span>Web Developer</span></h4>
                    </div>
                </div>
                <!--/ End Single Teacher -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Single Teacher -->
                <div class="single-teacher">
                    <div class="teacher-head overlay">
                        <img src="{{asset('courses_template/images/teachers/teacher-2.jpg')}}" class="profile_image"
                            alt="#">
                        <ul class="social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                    <div class="teacher-content">
                        <h4>Katheing William<span>Software Developer</span></h4>
                    </div>
                </div>
                <!--/ End Single Teacher -->
            </div>
        </div>
    </div>
</section>
<!--/ End Teachers -->

@endsection
@extends('courses.main')
@section('courses.content')
<style>
    .profile_image {
        max-height: 600px;
        width: 100%
    }

    .share-buttons .social-list li {
        display: inline-block;
    }

    .share-buttons .social-list li a {
        margin-right: 0px;
        color: #fff;
        background-color: #05c46b;
        width: 35px;
        height: 35px;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        border: 2px solid #05c46b;
    }

    .share-buttons .social-list li a:hover {
        color: #05c46b !important;
        background-color: #fff;
    }
</style>
<!-- Breadcrumb -->
<div class="breadcrumbs overlay" style="background-image:url('{{asset('courses_template/images/breadcrumb-bg.jpg')}}')">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                @if(auth()->check() && auth()->user()->uuid == $instructor->uuid)
                <h2>Welcome, {{$instructor->first_name}}</h2>
                @else
                <h2>{{$instructor->first_name}} {{$instructor->last_name}} <br> {{$profile->job_title}}</h2>
                @endif
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="bread-list">
                    <li><a href="{{route('courses.index')}}">Home<i class="fa fa-angle-right"></i></a></li>
                    @if(auth()->check() && auth()->user()->id == $instructor->id)
                    <li class="active"><a href="#">Profile<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="{{route('instructorProfile.edit', auth()->user()->uuid)}}">Edit<i
                                class="fa fa-angle-right"></i></a></li>
                    <li><a href="{{route('logout')}}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout<i
                                class="fa fa-angle-right"></i></a></li>
                    <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                    @else
                    <li class=""><a href="{{route('courses.instructors')}}">Instructors<i
                                class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="#">{{$instructor->first_name}} {{$instructor->last_name}}<i
                                class="fa fa-angle-right"></i></a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
<!--/ End Breadcrumb -->

<!-- Profile -->
<section class="faqs section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <div class="section-title bg">
                    <h2>Instructor Profile Page</h2>
                    <p>Teaching is not just about transferring knowledge, it’s about inspiring curiosity, fostering
                        growth, and empowering others to believe in their potential.</p>
                    <div class="icon"><i class="fa fa-user" style="font-size: x-large"></i></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5 col-12">
                <div class="">
                    <img src="{{ empty($instructor->getFirstMedia('instructor_profile')) ? asset('/website/img/teacher-avatar.png') : $instructor->getFirstMedia('instructor_profile')->getUrl() }}"
                        alt="" class="profile_image">
                </div>

                {{-- Soical Links --}}
                @if($instructor->user_social_links)
                <hr>
                <div class="col-12 text-center share-buttons">
                    <ul class="social-list social">

                        @if($instructor->user_social_links->facebook)
                        <li>
                            <a class="facebook-bg" href="{{$instructor->user_social_links->facebook}}" target="_blank">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        @endif()

                        @if ($instructor->user_social_links->linkedin)
                        <li>
                            <a class="linkedin-bg" href="{{$instructor->user_social_links->linkedin}}" target="_blank">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                        @endif

                        @if ($instructor->user_social_links->youtube)
                        <li>
                            <a class="youtube-bg" href="{{$instructor->user_social_links->youtube}}" target="_blank">
                                <i class="fa fa-youtube"></i>
                            </a>
                        </li>
                        @endif

                        @if($instructor->instructor_profile->mobile)
                        <li>
                            <a href="https://wa.me/+2{{$instructor->instructor_profile->mobile}}?text=Hello%20{{$instructor->first_name}}"
                                target="_blank" class="whatsapp"><i class="fa fa-whatsapp"></i></a>

                        </li>
                        @endif


                        @if ($instructor->user_social_links->website)
                        <li>
                            <a class="website-bg" href="{{$instructor->user_social_links->website}}" target="_blank">
                                <i class="fa fa-link"></i>
                            </a>
                        </li>
                        @endif


                        <li>
                            <a class="copy-bg copyLink"
                                href="{{ route('courses.instructorProfile', $instructor->uuid) }}"><i
                                    class="fa fa-copy"></i></a>
                            <p class="copyMessage" style="display: none;">Link copied!</p>
                        </li>

                    </ul>
                </div>
                @endif

                {{-- End Social Links --}}

            </div>
            <div class="col-lg-7 col-12">
                <div class="faq-main">
                    <div class="faq-content">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <!-- General Info -->
                            <div class="panel panel-default active">
                                <div class="faq-heading" id="generalinfo">
                                    <h4 class="faq-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                            href="#GeneralInfo"><i class="fa fa-address-card"></i><span
                                                class="text-center" style="font-size: x-large">General Info</span></a>
                                    </h4>
                                </div>
                                <div id="GeneralInfo" class="panel-collapse collapse show" role="tabpanel"
                                    aria-labelledby="generalinfo">
                                    <div class="faq-body">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <p><span class="text-dark font-weight-bold">Name:
                                                    </span>{{$instructor->first_name}}
                                                    {{$instructor->last_name}}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <p><span class="text-dark font-weight-bold">Job Title:
                                                    </span>{{$profile->job_title}}
                                            </div>
                                            <div class="col-md-6">

                                                <p><span class="text-dark font-weight-bold">Email:
                                                    </span>{{$instructor->email}}
                                                </p>
                                            </div>
                                            <div class="col-md-6">

                                                <p><span class="text-dark font-weight-bold">Mobile:
                                                    </span>{{$profile->mobile}}
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--/ End General Info -->
                            <!-- Bio -->
                            <div class="panel panel-default active">
                                <div class="faq-heading" id="bio">
                                    <h4 class="faq-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                            href="#Bio"><i class="fa fa-exclamation"></i><span class="text-center"
                                                style="font-size: x-large">Bio</span></a>
                                    </h4>
                                </div>
                                <div id="Bio" class="panel-collapse expand show" role="tabpanel" aria-labelledby="bio">
                                    <div class="faq-body">{{$profile->bio}} | {{$profile->qualification}}</div>
                                </div>
                            </div>
                            <!--/ End Bio -->
                            <!-- Instructor Courses -->
                            <div class="panel panel-default active">
                                <div class="faq-heading" id="courses">
                                    <h4 class="faq-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                            href="#Courses"><i class="fa fa-book"></i><span class="text-center"
                                                style="font-size: x-large">Courses</span></a>
                                    </h4>
                                </div>
                                <div id="Courses" class="panel-collapse collapse show" role="tabpanel"
                                    aria-labelledby="courses">

                                    <ul class="list-group">
                                        @foreach ($instructor_courses as $course)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <h6>
                                                <a target="_blank"
                                                    href="{{route('courses.show', $course->uuid)}}">{{$course->name}}</a>
                                                <br>
                                                <p class="text-muted">{{$course->cat->name}} | {{$course->type->name}} |
                                                    {{$course->statu->name}}</p>
                                            </h6>
                                            <span class="badge badge-success badge-pill">{{$course->price ? 'EGP ' .
                                                number_format($course->price) : 'Free'}}</span>
                                        </li>

                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                            <!--/ End Instructor Courses -->

                            <!-- Instructor Events -->
                            <div class="panel panel-default active">
                                <div class="faq-heading" id="events">
                                    <h4 class="faq-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                            href="#Events"><i class="fa fa-calendar"></i><span class="text-center"
                                                style="font-size: x-large">Events</span></a>
                                    </h4>
                                </div>
                                <div id="Events" class="panel-collapse collapse show" role="tabpanel"
                                    aria-labelledby="events">

                                    <ul class="list-group">
                                        @foreach ($instructor_events as $event)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <h6>
                                                <a target="_blank"
                                                    href="{{route('courses.events.show', $event->uuid)}}">{{$event->title}}</a>
                                                <br>
                                                <p class="text-muted">{{$event->type->name}} | {{date('jS, F Y',
                                                    strtotime($event->start_date))}}
                                                </p>
                                            </h6>
                                            <span class="badge badge-success badge-pill">{{$event->statu->name}}</span>
                                        </li>

                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                            <!-- End Instructor Events -->

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!--/ End Faqs -->
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
    $('.copyLink').click(function (e) {
        console.log('copied')
        e.preventDefault();
        var copyText = $(this).attr('href');
        document.addEventListener('copy', function (e) {
            e.clipboardData.setData('text/plain', copyText);
            e.preventDefault();
        }, true);

        document.execCommand('copy');
        $('.copyMessage').fadeIn().delay(1000).fadeOut();
    });
});

</script>
@endsection
@endsection
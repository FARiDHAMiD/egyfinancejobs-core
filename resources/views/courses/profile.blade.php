@extends('courses.main')
@section('courses.content')

<!-- Breadcrumb -->
<div class="breadcrumbs overlay" style="background-image:url('{{asset('courses_template/images/breadcrumb-bg.jpg')}}')">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                @if(auth()->check() && auth()->user()->hasRole('instructor') || auth()->check() &&
                auth()->user()->hasRole('admin'))
                <h2 class="mb-0">{{$student->first_name}} {{$student->last_name}}</h2>
                <h5 class="text-light mb-1 mt-1">{{$student->employee_profile->job_title->name ?? 'Deleted Job Title'}} |
                    {{$student->employee_profile->city->name ?? 'Invalid City'}} | {{$student->employee_profile->phone}}</h5>
                @else
                <h2>Welcome, {{auth()->user()->first_name}}</h2>
                @endif
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="bread-list">
                    <li><a href="{{route('courses.index')}}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="#">Profile<i class="fa fa-angle-right"></i></a></li>
                    @if(auth()->check() && auth()->user()->hasRole('employee'))
                    <li><a href="{{route('logout')}}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout<i
                                class="fa fa-angle-right"></i></a></li>
                    <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
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
                    <h2>Courses Profile <span></span></h2>
                    <p>The beautiful thing about learning is that no one can take it away from you. Knowledge is a
                        treasure that follows its owner everywhere.
                    </p>
                    <div class="icon"><i class="fa fa-book" style="font-size: x-large"></i></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="faq-main">
                    <div class="faq-content">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <!-- Single section -->
                            <div class="panel panel-default active">
                                <div class="faq-heading" id="FaqTitle1">
                                    <h4 class="faq-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                            href="#faq1"><i class="fa fw fa-hourglass-half"></i>Ongoing Course</a>
                                    </h4>
                                </div>
                                <div id="faq1" class="panel-collapse collapse show" role="tabpanel"
                                    aria-labelledby="FaqTitle1">
                                    @foreach($enrolls as $enroll)
                                    {{-- check if ongoing course | static ids from mysql ! --}}
                                    @if($enroll->course->statu_id == 4)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <h6>
                                            <a target="_blank" target="_blank"
                                                href="{{route('courses.show', $enroll->course->uuid)}}">{{$enroll->course->name}}</a>
                                            <span class="text-muted">
                                                | by
                                            </span>
                                            <a target="_blank"
                                                href="{{route('courses.instructorProfile', $enroll->course->user_instructor->uuid)}}">
                                                {{$enroll->course->user_instructor->first_name}}
                                                {{$enroll->course->user_instructor->last_name}}
                                            </a>
                                            <br>
                                            <p class="text-muted">{{$enroll->course->cat->name}} |
                                                {{$enroll->course->type->name}} </p>
                                        </h6>

                                        @if ($enroll->course->hide_price)
                                        <span class="badge badge-success badge-pill">
                                            N/A
                                        </span>
                                        @elseif ($enroll->course->price)
                                        <span class="badge badge-success badge-pill">
                                            EGP {{number_format($enroll->course->price)}}
                                        </span>
                                        @else
                                        <span class="badge badge-success badge-pill">
                                            Free
                                        </span>
                                        @endif
                                    </li>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            <!--/ End Single section -->
                            <!-- Single section -->
                            <div class="panel panel-default active">
                                <div class="faq-heading" id="FaqTitle2">
                                    <h4 class="faq-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                            href="#faq2"><i class="fa fw fa-hourglass-start"></i>Upcoming Courses</a>
                                    </h4>
                                </div>
                                <div id="faq2" class="panel-collapse collapse show" role="tabpanel"
                                    aria-labelledby="FaqTitle2">
                                    @foreach($enrolls as $enroll)
                                    {{-- check if ongoing course | static ids from mysql ! --}}
                                    @if($enroll->course->statu_id == 3 || $enroll->course->statu_id == 1)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <h6>
                                            <a target="_blank" target="_blank"
                                                href="{{route('courses.show', $enroll->course->uuid)}}">{{$enroll->course->name}}</a>
                                            @if($enroll->course->user_instructor)
                                            <span class="text-muted">
                                                | by
                                            </span>
                                            <a target="_blank"
                                                href="{{route('courses.instructorProfile', $enroll->course->user_instructor->uuid)}}">
                                                {{$enroll->course->user_instructor->first_name}}
                                                {{$enroll->course->user_instructor->last_name}}
                                            </a>
                                            @endif
                                            <br>
                                            <p class="text-muted">{{$enroll->course->cat->name}} |
                                                {{$enroll->course->type->name}} </p>
                                        </h6>
                                        @if ($enroll->course->hide_price)
                                        <span class="badge badge-success badge-pill">
                                            N/A
                                        </span>
                                        @elseif ($enroll->course->price)
                                        <span class="badge badge-success badge-pill">
                                            EGP {{number_format($enroll->course->price)}}
                                        </span>
                                        @else
                                        <span class="badge badge-success badge-pill">
                                            Free
                                        </span>
                                        @endif
                                    </li>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            <!--/ End Single section -->
                            <!-- Single section -->
                            <div class="panel panel-default active">
                                <div class="faq-heading" id="FaqTitle3">
                                    <h4 class="faq-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                            href="#faq3"><i class="fa fw fa-hourglass-end"></i>Completed Courses</a>
                                    </h4>
                                </div>
                                <div id="faq3" class="panel-collapse collapse show" role="tabpanel"
                                    aria-labelledby="FaqTitle3">
                                    @foreach($enrolls as $enroll)
                                    {{-- check if completed course | static ids from mysql ! --}}
                                    @if($enroll->course->statu_id == 5)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <h6>
                                            <a target="_blank" target="_blank"
                                                href="{{route('courses.show', $enroll->course->uuid)}}">{{$enroll->course->name}}</a>
                                            @if($enroll->course->user_instructor)
                                            <span class="text-muted">
                                                | by
                                            </span>
                                            <a target="_blank"
                                                href="{{route('courses.instructorProfile', $enroll->course->user_instructor->uuid)}}">
                                                {{$enroll->course->user_instructor->first_name}}
                                                {{$enroll->course->user_instructor->last_name}}
                                            </a>
                                            @endif
                                            <br>
                                            <p class="text-muted">{{$enroll->course->cat->name}} |
                                                {{$enroll->course->type->name}} </p>
                                        </h6>
                                        @if ($enroll->course->hide_price)
                                        <span class="badge badge-success badge-pill">
                                            N/A
                                        </span>
                                        @elseif ($enroll->course->price)
                                        <span class="badge badge-success badge-pill">
                                            EGP {{number_format($enroll->course->price)}}
                                        </span>
                                        @else
                                        <span class="badge badge-success badge-pill">
                                            Free
                                        </span>
                                        @endif
                                    </li>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            <!--/ End Single section -->
                            <!-- Single section -->
                            <div class="panel panel-default active">
                                <div class="faq-heading" id="FaqTitle4">
                                    <h4 class="faq-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                            href="#faq4"><i class="fa fa-question"></i>Reviews | All Enrolled
                                            Courses</a>
                                    </h4>
                                </div>

                                {{-- All Student Courses --}}
                                <div id="faq4" class="panel-collapse collapse show" role="tabpanel"
                                    aria-labelledby="FaqTitle4">
                                    @foreach($enrolls as $enroll)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <h6>
                                            <a target="_blank" target="_blank"
                                                href="{{route('courses.show', $enroll->course->uuid)}}">{{$enroll->course->name}}</a>
                                            @if($enroll->course->user_instructor)
                                            <span class="text-muted">
                                                | by
                                            </span>
                                            <a target="_blank"
                                                href="{{route('courses.instructorProfile', $enroll->course->user_instructor->uuid)}}">
                                                {{$enroll->course->user_instructor->first_name}}
                                                {{$enroll->course->user_instructor->last_name}}
                                            </a>
                                            @endif
                                            <br>
                                            <p class="text-muted">{{$enroll->course->cat->name}} |
                                                {{$enroll->course->type->name}} | <span
                                                    class="text-success">{{$enroll->course->statu->name}}</span></p>
                                        </h6>
                                        @if ($enroll->course->hide_price)
                                        <span class="badge badge-success badge-pill">
                                            N/A
                                        </span>
                                        @elseif ($enroll->course->price)
                                        <span class="badge badge-success badge-pill">
                                            EGP {{number_format($enroll->course->price)}}
                                        </span>
                                        @else
                                        <span class="badge badge-success badge-pill">
                                            Free
                                        </span>
                                        @endif
                                    </li>
                                    @endforeach
                                </div>
                            </div>
                            <!--/ End Single section -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Faqs -->

@endsection
@extends('courses.main')
@section('courses.content')
<style>
    .course_image {
        min-height: 250px;
        max-height: 250px;
    }
</style>
<!-- Breadcrumb -->
<div class="breadcrumbs overlay" style="background-image:url('{{asset('courses_template/images/breadcrumb-bg.jpg')}}')">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <h2>Our Courses</h2>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="bread-list">
                    <li><a href="{{route('courses.index')}}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="#">Courses<i class="fa fa-angle-right"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--/ End Breadcrumb -->
<!-- Courses -->
<section class="courses archive section mb-0">
    <div class="container d-flex justify-content-center">
        <div class="col-3">
            <!-- Search box -->
            <div class="search-area">
                <form class="search-form">
                    <div class="row">
                        <div class="col-md-8 col-8">
                            <input type="text" placeholder="Search for course by title" name="search_field" class="mr-5"
                                style="padding: 11px;" value="{{Request::get('search_field')}}">
                        </div>
                        <div class="col-md-4 col-4">
                            <button value="search " type="submit" class="btn primary mr-1"><i
                                    class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- End Search Area-->
        </div>
    </div>

    <div class="container d-flex justify-content-center mt-2">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{$page_name != 'All Courses' ? '' : 'active'}} my-1 m-1" id="pills-all-tab"
                    href="{{route('courses.all')}}" role="tab" aria-controls="pills-all" aria-selected="true">All</a>
            </li>
            @foreach ($cats as $index => $cat)
            <a class="nav-link {{$page_name == $cat->id ? 'active' : ''}} m-1 my-1"
                href="{{route('courses.cat', $cat->id)}}">{{$cat->name}}</a>
            @endforeach
        </ul>

    </div>
    <div class="container">
        @if ($courses->count() <= 0) <div class="text-center">
            <h3 class="text-muted">No Courses Available for this category at the moment !</h3>
    </div>
    @endif
    <h5 class="text-muted text-right">{{$courses->count()}} Courses Found</h5>
    <div class="row">
        @foreach ($courses as $course)
        <div class="col-lg-4 col-md-6 col-12">
            <!-- Single Course -->
            <div class="single-course">
                <!-- Course Head -->
                <div class="course-head overlay">
                    <img src="{{ empty($course->getFirstMedia('course_img')) ? asset('courses_template/images/courses/course3.jpg') : $course->getFirstMedia('course_img')->getUrl() }}"
                        alt="" class="course_image">
                    <a href="{{route('courses.show', $course->uuid)}}" class="btn white primary">Course Details</a>
                </div>
                <!-- Course Body -->
                <div class="course-body">
                    <div class="name-price">
                        <div class="teacher-info">
                            @if($course->user_instructor)
                            <a target="_blank"
                                href="{{route('courses.instructorProfile', $course->user_instructor->uuid)}}">
                                <img src="{{ empty($course->user_instructor->getFirstMedia('instructor_profile')) ? asset('/website/img/avatar.png') : $course->user_instructor->getFirstMedia('instructor_profile')->getUrl() }}"
                                    alt="">
                            </a>
                            @else
                            <img src="{{ asset('/website/img/avatar.png')  }}" alt="">
                            @endif
                            {{-- <img src="{{asset('courses_template/images/author1.jpg')}}" alt="#"> --}}
                            @if($course->user_instructor)
                            <h4 class="title">{{$course->user_instructor->first_name}}
                                {{$course->user_instructor->last_name}}</h4>
                            @else
                            <h4 class="title">Unknown</h4>
                            @endif
                        </div>
                        @if($course->hide_price)
                        <span class="price">N/A</span>
                        @elseif($course->price)
                        <span class="price">{{$course->currency->name}} {{number_format($course->price)}}</span>
                        @else
                        <span class="price">Free</span>
                        @endif
                    </div>
                    <h4 class="c-title"><a href="{{route('courses.show', $course->uuid)}}">{{$course->name}}</a>
                    </h4>
                    <p>{{preg_match('/\p{Arabic}/u', $course->info) ?
                        mb_substr($course->info, 0, 150) :
                        substr($course->info, 0, 150)}}
                        ...</p>
                </div>
                <!-- Course Meta -->
                <div class="course-meta">
                    <!-- Rattings -->
                    <ul class="rattings">
                        {{-- full stars --}}
                        @for ($i = 0; $i < $course->rank - 1; $i++)
                            <li>
                                <i class="fa fa-star"></i>
                            </li>
                            @endfor
                            {{-- half stars --}}
                            @if($course->rank - floor($course->rank) >= 0.5)
                            <li><i class="fa fa-star-half-o"></i></li>
                            @endif

                            {{-- empty stars --}}
                            {{-- Empty stars --}}
                            @for ($i = 0; $i < 5 - floor($course->rank) - ($course->rank - floor($course->rank) ? 1 :
                                0); $i++)
                                <li><i class="fa fa-star-o"></i></li>
                                @endfor
                                <li class="point"><span>{{$course->rank}}</span></li>
                    </ul>


                    <!-- Course Info -->
                    <div class="course-info">
                        <span><i class="fa fa-users"></i>{{$course->max_enroll}} Enroll</span>
                        <span><i class="fa fa-calendar-o"></i>
                            {{
                            round(
                            \Carbon\Carbon::parse($course->start_date)
                            ->diffInDays(\Carbon\Carbon::parse($course->end_date)) / 30
                            ) < 1 ? \Carbon\Carbon::parse($course->start_date)
                                ->diffInDays(\Carbon\Carbon::parse($course->end_date)) . ' Days' :
                                round(\Carbon\Carbon::parse($course->start_date)
                                ->diffInDays(\Carbon\Carbon::parse($course->end_date))
                                / 30) . ' Months'
                                }}

                        </span>
                        @if($course->start_time)
                        <span><i class="fa fa-clock-o"></i>{{$course->start_time}} - {{$course->end_time}}</span>
                        @endif
                    </div>
                </div>
                <!--/ End Course Meta -->
            </div>
            <!--/ End Single Course -->
        </div>
        @endforeach
    </div>
    </div>
</section>
<!--/ End Courses -->
@endsection
@extends('courses.main')
@section('courses.content')
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
    {{-- <div class="container d-flex justify-content-start mt-2">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active btn primary my-1" id="pills-all-tab" href="#pills-all" role="tab"
                    aria-controls="pills-all" aria-selected="true">All</a>
            </li>
            @foreach ($cats as $index => $cat)
            <li class="nav-item">
                <a class="nav-link btn primary ml-1 my-1" id="pills-{{$cat->id}}-tab" href="#pills-{{$cat->id}}"
                    role="tab" aria-controls="pills-{{$cat->id}}" aria-selected="false">{{$cat->name}}</a>
            </li>
            @endforeach
        </ul>
    </div> --}}
    <div class="container">
        @if ($courses->count() <= 0) <div class="text-center">
            <h3 class="text-muted">No Courses Availble for this category at the moment !</h3>
    </div>
    @endif

    <div class="row">
        @foreach ($courses as $course)
        <div class="col-lg-4 col-md-6 col-12">
            <!-- Single Course -->
            <div class="single-course">
                <!-- Course Head -->
                <div class="course-head overlay">
                    <img src="{{asset('courses_template/images/courses/course3.jpg')}}" alt="#">
                    <a href="{{route('courses.show', $course->uuid)}}" class="btn white primary">Course Details</a>
                </div>
                <!-- Course Body -->
                <div class="course-body">
                    <div class="name-price">
                        <div class="teacher-info">
                            <img src="{{asset('courses_template/images/author1.jpg')}}" alt="#">
                            @if($course->user_instructor)
                            <h4 class="title">{{$course->user_instructor->first_name}}
                                {{$course->user_instructor->last_name}}</h4>
                            @endif
                        </div>
                        @if($course->price)
                        <span class="price">EGP {{number_format($course->price)}}</span>
                        @else
                        <span class="price">Free</span>
                        @endif
                    </div>
                    <h4 class="c-title"><a href="{{route('courses.show', 1)}}">{{$course->name}}</a>
                    </h4>
                    <p>{{$course->info}}</p>
                </div>
                <!-- Course Meta -->
                <div class="course-meta">
                    <!-- Rattings -->
                    <ul class="rattings">
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star-half-o"></i></li>
                        <li class="point"><span>4.5</span></li>
                    </ul>
                    <!-- Course Info -->
                    <div class="course-info">
                        <span><i class="fa fa-users"></i>2.4k Enrolled</span>
                        <span><i class="fa fa-calendar-o"></i>2 Month</span>
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
        {{-- preview test data --}}
        {{-- <div class="col-lg-4 col-md-6 col-12">
            <!-- Single Course -->
            <div class="single-course">
                <!-- Course Head -->
                <div class="course-head overlay">
                    <img src="{{asset('courses_template/images/courses/course3.jpg')}}" alt="#">
                    <a href="course-single.html" class="btn white primary">Register Now</a>
                </div>
                <!-- Course Body -->
                <div class="course-body">
                    <div class="name-price">
                        <div class="teacher-info">
                            <img src="{{asset('courses_template/images/author3.jpg')}}" alt="#">
                            <h4 class="title">Noha Brown</h4>
                        </div>
                        <span class="price">Free</span>
                    </div>
                    <h4 class="c-title"><a href="course-single.html">Corporate Finance: Maximizing Business
                            Value</a></h4>
                    <p>Learn the principles of corporate finance, including capital budgeting, financial management,
                        and strategic planning, to help businesses make better financial decisions.</p>
                </div>
                <!-- Course Meta -->
                <div class="course-meta">
                    <!-- Rattings -->
                    <ul class="rattings">
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li class="point"><span>4.0</span></li>
                    </ul>
                    <!-- Course Info -->
                    <div class="course-info">
                        <span><i class="fa fa-users"></i>5.3k Enrolled</span>
                        <span><i class="fa fa-calendar-o"></i>2 Weeks</span>
                        <span><i class="fa fa-clock-o"></i>10:00 - 11:00</span>
                    </div>
                </div>
                <!--/ End Course Meta -->
            </div>
            <!--/ End Single Course -->
        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <!-- Single Course -->
            <div class="single-course">
                <!-- Course Head -->
                <div class="course-head overlay">
                    <img src="{{asset('courses_template/images/courses/course2.jpg')}}" alt="#">
                    <a href="course-single.html" class="btn white primary">Register Now</a>
                </div>
                <!-- Course Body -->
                <div class="course-body">
                    <div class="name-price">
                        <div class="teacher-info">
                            <img src="{{asset('courses_template/images/author2.jpg')}}" alt="#">
                            <h4 class="title">Jenola Protan</h4>
                        </div>
                        <span class="price">$290</span>
                    </div>
                    <h4 class="c-title"><a href="course-single.html">Cryptocurrency and Blockchain for Investors</a>
                    </h4>
                    <p>Gain a clear understanding of blockchain technology and cryptocurrencies, and learn how to
                        navigate this emerging market for investment opportunities.</p>
                </div>
                <!-- Course Meta -->
                <div class="course-meta">
                    <!-- Rattings -->
                    <ul class="rattings">
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star-half-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li class="point"><span>3.9</span></li>
                    </ul>
                    <!-- Course Info -->
                    <div class="course-info">
                        <span><i class="fa fa-users"></i>2.4k Enrolled</span>
                        <span><i class="fa fa-calendar-o"></i>2 Month</span>
                        <span><i class="fa fa-clock-o"></i>10:30 - 12:30</span>
                    </div>
                </div>
                <!--/ End Course Meta -->
            </div>
            <!--/ End Single Course -->
        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <!-- Single Course -->
            <div class="single-course">
                <!-- Course Head -->
                <div class="course-head overlay">
                    <img src="{{asset('courses_template/images/courses/course5.jpg')}}" alt="#">
                    <a href="course-single.html" class="btn white primary">Register Now</a>
                </div>
                <!-- Course Body -->
                <div class="course-body">
                    <div class="name-price">
                        <div class="teacher-info">
                            <img src="{{asset('courses_template/images/author1.jpg')}}" alt="#">
                            <h4 class="title">Jewel Mathies</h4>
                        </div>
                        <span class="price">$350</span>
                    </div>
                    <h4 class="c-title"><a href="course-single.html">Financial Risk Management</a></h4>
                    <p>Learn how to identify, assess, and mitigate financial risks in both personal and corporate
                        settings. Understand the tools and strategies used to protect against financial volatility.
                    </p>
                </div>
                <!-- Course Meta -->
                <div class="course-meta">
                    <!-- Rattings -->
                    <ul class="rattings">
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star-half-o"></i></li>
                        <li class="point"><span>4.5</span></li>
                    </ul>
                    <!-- Course Info -->
                    <div class="course-info">
                        <span><i class="fa fa-users"></i>2.4k Enrolled</span>
                        <span><i class="fa fa-calendar-o"></i>2 Month</span>
                        <span><i class="fa fa-clock-o"></i>09:30 - 12:00</span>
                    </div>
                </div>
                <!--/ End Course Meta -->
            </div>
            <!--/ End Single Course -->
        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <!-- Single Course -->
            <div class="single-course">
                <!-- Course Head -->
                <div class="course-head overlay">
                    <img src="{{asset('courses_template/images/courses/course4.jpg')}}" alt="#">
                    <a href="course-single.html" class="btn white primary">Register Now</a>
                </div>
                <!-- Course Body -->
                <div class="course-body">
                    <div class="name-price">
                        <div class="teacher-info">
                            <img src="{{asset('courses_template/images/author3.jpg')}}" alt="#">
                            <h4 class="title">Noha Brown</h4>
                        </div>
                        <span class="price">Free</span>
                    </div>
                    <h4 class="c-title"><a href="course-single.html">Tax Planning and Strategy</a></h4>
                    <p>Learn how to minimize tax liabilities through smart planning and strategy. Understand tax
                        laws, deductions, credits, and how to file taxes efficiently.</p>
                </div>
                <!-- Course Meta -->
                <div class="course-meta">
                    <!-- Rattings -->
                    <ul class="rattings">
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li class="point"><span>4.0</span></li>
                    </ul>
                    <!-- Course Info -->
                    <div class="course-info">
                        <span><i class="fa fa-users"></i>5.3k Enrolled</span>
                        <span><i class="fa fa-calendar-o"></i>2 Weeks</span>
                        <span><i class="fa fa-clock-o"></i>10:00 - 11:00</span>
                    </div>
                </div>
                <!--/ End Course Meta -->
            </div>
            <!--/ End Single Course -->
        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <!-- Single Course -->
            <div class="single-course">
                <!-- Course Head -->
                <div class="course-head overlay">
                    <img src="{{asset('courses_template/images/courses/course6.jpg')}}" alt="#">
                    <a href="course-single.html" class="btn white primary">Register Now</a>
                </div>
                <!-- Course Body -->
                <div class="course-body">
                    <div class="name-price">
                        <div class="teacher-info">
                            <img src="{{asset('courses_template/images/author2.jpg')}}" alt="#">
                            <h4 class="title">Jenola Protan</h4>
                        </div>
                        <span class="price">$290</span>
                    </div>
                    <h4 class="c-title"><a href="course-single.html">Personal Finance 101: Managing Your Money</a>
                    </h4>
                    <p>Learn the basics of budgeting, saving, investing, and planning for the future to take control
                        of your personal finances and achieve your financial goals.</p>
                </div>
                <!-- Course Meta -->
                <div class="course-meta">
                    <!-- Rattings -->
                    <ul class="rattings">
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star-half-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li class="point"><span>3.9</span></li>
                    </ul>
                    <!-- Course Info -->
                    <div class="course-info">
                        <span><i class="fa fa-users"></i>2.4k Enrolled</span>
                        <span><i class="fa fa-calendar-o"></i>2 Month</span>
                        <span><i class="fa fa-clock-o"></i>10:30 - 12:30</span>
                    </div>
                </div>
                <!--/ End Course Meta -->
            </div>
            <!--/ End Single Course -->
        </div> --}}
        {{-- end preview test data --}}
    </div>
    </div>
</section>
<!--/ End Courses -->
@endsection
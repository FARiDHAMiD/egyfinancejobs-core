@extends('courses.main')
@section('courses.content')
<style>
    .course_image {
        min-height: 250px;
        max-height: 250px;
    }

    .client_images {
        min-height: 100px;
        max-height: 100px;
    }
</style>

<!-- Slider Area -->
<section class="home-slider">
    <div class="slider-active">
        <!-- Single Slider -->
        <div class="single-slider overlay">
            <div class="slider-image"
                style="background-image:url('{{asset('courses_template/images/slider/slider-bg1.jpg')}}')"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-10 col-12">
                        <!-- Slider Content -->
                        <div class="slider-content">
                            <h1 class="slider-title"><span>Knowledge is a journey, not a
                                    destination!</span>EGY FINANCE
                                <b>COURSES</b>
                            </h1>
                            <p class="slider-text">Discover a wide range of expert-led financial courses designed to
                                enhance your knowledge and skills. Whether you're looking to manage personal finances,
                                explore investment strategies, or advance your career in finance, our platform offers
                                flexible, comprehensive courses to suit all levels. Start learning today and unlock new
                                opportunities in the world of finance!</p>
                            <!-- Button -->
                            <div class="button">
                                <a href="{{route('courses.about_us')}}" class="btn white">About Us</a>
                                <a href="{{route('courses.all')}}" class="btn white primary">Our Courses</a>
                            </div>
                            <!--/ End Button -->
                        </div>
                        <!--/ End Slider Content -->
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Single Slider -->
    </div>
</section>
<!--/ End Slider Area -->

<!-- Courses -->
<section class="courses section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <div class="section-title bg">
                    <h2>Our Featured <span>Courses</span></h2>
                    <p>Unlock the world of finance with our expert-led courses. Whether you're a beginner or looking to
                        refine your skills, we offer practical, comprehensive lessons designed to help you master
                        financial concepts, make smarter decisions, and succeed in the ever-evolving financial
                        landscape. Start your journey to financial empowerment today!</p>
                    <div class="icon"><i class="fa fa-clone"></i></div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Single Course -->
            <div class="row">
                @foreach ($courses as $course)
                <div class="col-lg-6 col-md-6 col-12">
                    <!-- Single Course -->
                    <div class="single-course">
                        <!-- Course Head -->
                        <div class="course-head overlay">
                            <img src="{{ empty($course->getFirstMedia('course_img')) ? asset('courses_template/images/courses/course3.jpg') : $course->getFirstMedia('course_img')->getUrl() }}"
                                alt="" class="course_image">
                            <a href="{{route('courses.show', $course->uuid)}}" class="btn white primary">Course
                                Details</a>
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
                                    @for ($i = 0; $i < 5 - floor($course->rank) - ($course->rank - floor($course->rank)
                                        ? 1 : 0); $i++)
                                        <li><i class="fa fa-star-o"></i></li>
                                        @endfor
                                        <li class="point"><span>{{$course->rank}}</span></li>
                            </ul>

                            <!-- Course Info -->
                            <div class="course-info">
                                <span><i class="fa fa-users"></i>{{$course->max_enroll}} Enroll</span>
                                <span><i
                                        class="fa fa-calendar-o"></i>{{\Carbon\Carbon::parse($course->start_date)->diffInMonths(\Carbon\Carbon::parse($course->end_date))}}
                                    Months</span>
                                @if($course->start_time)
                                <span><i class="fa fa-clock-o"></i>{{$course->start_time}} -
                                    {{$course->end_time}}</span>
                                @endif
                            </div>
                        </div>
                        <!--/ End Course Meta -->
                    </div>
                </div>
                @endforeach
            </div>
            <!--/ End Single Course -->

        </div>
        <div class="text-center my-4 mb-0">

            <div class="button">
                <a href="{{route('courses.all')}}" class="btn primary">View All Courses</a>
            </div>
        </div>
    </div>
</section>
<!--/ End Courses -->


<!-- Features -->
<div class="features overlay section" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Single Feature -->
                <a href="{{route('courses.all')}}">

                    <div class="single-feature">
                        <div class="icon-img">
                            <img src="{{asset('courses_template/images/feature1.jpg')}}" alt="#">
                            <i class="fa fa-clone"></i>
                        </div>
                        <div class="feature-content">
                            <h4 class="f-title">Trending Course</h4>
                            <p>Our mission is to provide educators, professionals, and learners of all levels with the
                                knowledge, tools, and resources they need to succeed.</p>
                        </div>
                    </div>
                </a>
                <!--/ End Single Feature -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Single Feature -->
                <a target="_blank" href="{{route('courses.soon')}}">

                    <div class="single-feature">
                        <div class="icon-img">
                            <img src="{{asset('courses_template/images/feature2.jpg')}}" alt="#">
                            <i class="fa fa-book"></i>
                        </div>
                        <div class="feature-content">
                            <h4 class="f-title">Books & Library</h4>
                            <p>Our extensive collection of books, research materials, and library access provides you
                                with
                                the foundational knowledge and deep insights necessary to succeed in your courses.</p>
                        </div>
                    </div>
                </a>
                <!--/ End Single Feature -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Single Feature -->
                <a target="_blank" href="{{route('courses.soon')}}">
                    <div class="single-feature">
                        <div class="icon-img">
                            <img src="{{asset('courses_template/images/feature1.jpg')}}" alt="#">
                            <i class="fa fa-institution"></i>
                        </div>
                        <div class="feature-content">
                            <h4 class="f-title">Best Facility</h4>
                            <p>Our facilities and class offerings are designed to provide you with the best possible
                                learning experience, whether you're studying online or in-person.</p>
                        </div>
                    </div>
                </a>
                <!--/ End Single Feature -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Single Feature -->
                <a href="{{route('courses.instructors')}}">
                    <div class="single-feature">
                        <div class="icon-img">
                            <img src="{{asset('courses_template/images/feature3.jpg')}}" alt="#">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="feature-content">

                            <h4 class="f-title">Certified Teachers</h4>
                            <p>Covers advanced strategies for creating a positive learning environment, managing student
                                behavior, and promoting engagement</p>
                        </div>
                    </div>
                </a>
                <!--/ End Single Feature -->
            </div>
        </div>
    </div>
</div>
<!--/ End Features -->

<!-- Events -->
<section class="events section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <div class="section-title bg">
                    <h2>Upcoming <span>Events</span></h2>
                    <p>Financial events, such as earnings reports or IPOs, provide transparency into a company’s
                        financial health and operations. This helps investors make informed decisions, ensuring that
                        markets function efficiently.</p>
                    <div class="icon"><i class="fa fa-paper-plane"></i></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5 col-12">
                <div class="event-img">
                    <img src="{{asset('courses_template/images/event-left.jpg')}}" alt="#">
                </div>
            </div>
            {{-- upcoming events data --}}
            <div class="col-lg-7 col-12">

                <div class="coming-event">
                    @foreach ($events as $event)
                    <!-- Single Event -->
                    <div class="single-event">
                        <div class="event-date">
                            <p>{{date('d', strtotime($event->start_date))}}<span>{{date('F',
                                    strtotime($event->start_date))}}</span></p>
                        </div>
                        <div class="event-content">
                            <h3 class="event-title"><a
                                    href="{{route('courses.events.show', $event->uuid)}}">{{$event->title}} |
                                    {{$event->type->name}}</a></h3>
                            <p>{{$event->description}}
                            </p>
                            <span class="entry-date-time"><i class="fa fa-calendar" aria-hidden="true"></i> {{date('jS,
                                F
                                Y', strtotime($event->start_date))}}
                                @if ($event->start_date != $event->end_date)
                                to {{date('jS, F Y',
                                strtotime($event->end_date))}}</span>
                            @endif
                        </div>
                    </div>
                    <!-- End Single Event -->
                    @endforeach
                </div>

            </div>
        </div>
        <div class="text-center my-4 mb-0">
            <div class="button">
                <a href="{{route('courses.events')}}" class="btn primary">More Events...</a>
            </div>
        </div>
    </div>
</section>
<!--/ End Events -->

<!-- Call To Action -->
<section class="cta">
    <div class="cta-inner overlay section"
        style="background-image:url('{{asset('courses_template/images/cta-bg.jpg')}}')"
        data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-12">
                    <div class="text-content">
                        <h2>We <span>Focus on</span> Brands, Products & Campaigns</h2>
                        <p>Launching a marketing campaign requires a solid financial foundation. We focus on optimizing
                            campaign budgets, ROI tracking, and resource allocation to ensure that every dollar spent
                            contributes to your campaign’s success. Our tools and strategies help you measure
                            effectiveness and adjust for better outcomes.

                            By focusing on the financial aspects of brands, products, and campaigns, we provide you with
                            the knowledge and tools to maximize growth, profitability, and long-term success. With
                            expert guidance, you’ll be empowered to make strategic decisions that drive measurable
                            results.</p>
                        <!-- CTA Button -->
                        <div class="button">
                            <a class="btn white" href="{{route('instructor.create')}}">Join With Now</a>
                            <a class="btn white primary" href="{{route('courses.all')}}">View Courses</a>
                        </div>
                        <!--/ End CTA Button -->
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <!-- Cta Image -->
                    <div class="cta-image">
                        <img src="{{asset('courses_template/images/girl-1.png')}}" alt="#">
                    </div>
                    <!--/ End Cta Image -->
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Call To Action -->

<!-- Faqs -->
<section class="faqs section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <div class="section-title bg">
                    <h2>Frequently Asked <span>Questions</span></h2>
                    <p>We understand that life is busy. Our platform offers flexible learning formats—online, on-demand,
                        live sessions, and more—so you can learn at your own pace, whenever and wherever works best for
                        you.</p>
                    <div class="icon"><i class="fa fa-question"></i></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5 col-12">
                <div class="faq-image">
                    <img src="{{asset('courses_template/images/faq.png')}}" alt="#">
                </div>
            </div>
            <div class="col-lg-7 col-12">
                <div class="faq-main">
                    <div class="faq-content">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <!-- Single Faq -->
                            @foreach ($faqs as $index => $faq)
                            <div class="panel panel-default {{$index == 0 ? 'active' : ''}}">
                                <div class="faq-heading" id="FaqTitle{{$index}}">
                                    <h4 class="faq-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                            href="#faq{{$index}}"><i class="fa fa-question"></i>{{$faq->question}}</a>
                                    </h4>
                                </div>
                                <div id="faq{{$index}}" class="panel-collapse collapse {{$index == 0 ? 'show' : ''}}"
                                    role="tabpanel" aria-labelledby="FaqTitle{{$index}}">
                                    <div class="faq-body">{{$faq->answer}}</div>
                                </div>
                            </div>
                            <!--/ End Single Faq -->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center my-4 mb-0">
            <div class="button">
                <a href="{{route('courses.faqs')}}" class="btn primary">All FAQs</a>
            </div>
        </div>
    </div>
</section>
<!--/ End Faqs -->

<!-- Clients CSS -->
<div class="clients">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-12">
                <div class="text-content">
                    <h4>Our Awesome Clients!</h4>
                    <p>We’re proud to work with incredible organizations and individuals who trust us to provide
                        world-class learning experiences.</p>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-12">
                <div class="client-slider">
                    <div class="single-slider">
                        <a href="#"><img src="{{asset('courses_template/images/client1.jpg')}}" class="client_images"
                                alt="#"></a>
                    </div>
                    <div class="single-slider">
                        <a href="#"><img src="{{asset('courses_template/images/client2.jpg')}}" class="client_images"
                                alt="#"></a>
                    </div>
                    <div class="single-slider">
                        <a href="#"><img src="{{asset('courses_template/images/client3.png')}}" class="client_images"
                                alt="#"></a>
                    </div>
                    <div class="single-slider">
                        <a href="#"><img src="{{asset('courses_template/images/client4.jpg')}}" class="client_images"
                                alt="#"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ End Clients CSS -->


@endsection
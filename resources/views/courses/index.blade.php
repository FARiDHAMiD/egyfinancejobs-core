@extends('courses.main')
@section('courses.content')

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
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Single Course -->
                <div class="single-course">
                    <!-- Course Head -->
                    <div class="course-head overlay">
                        <img src="{{asset('courses_template/images/courses/course1.jpg')}}" alt="#">
                        <a href="{{route('courses.show', 1)}}" class="btn white primary">Register Now</a>
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
                        <h4 class="c-title"><a href="course-single.html">Financial Literacy for Beginners</a></h4>
                        <p>A beginner-friendly course that introduces key financial concepts such as credit, debt
                            management, and financial planning to build a solid foundation for financial success.</p>
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
            </div>
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
                <div class="single-feature">
                    <div class="icon-img">
                        <img src="{{asset('courses_template/images/feature1.jpg')}}" alt="#">
                        <i class="fa fa-clone"></i>
                    </div>
                    <div class="feature-content">
                        <h4 class="f-title">Trending Course</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam suscipit fugiat sint
                            totam soluta assumenda</p>
                    </div>
                </div>
                <!--/ End Single Feature -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Single Feature -->
                <div class="single-feature">
                    <div class="icon-img">
                        <img src="{{asset('courses_template/images/feature2.jpg')}}" alt="#">
                        <i class="fa fa-book"></i>
                    </div>
                    <div class="feature-content">
                        <h4 class="f-title">Books & Library</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam suscipit fugiat sint
                            totam soluta assumenda</p>
                    </div>
                </div>
                <!--/ End Single Feature -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Single Feature -->
                <div class="single-feature">
                    <div class="icon-img">
                        <img src="{{asset('courses_template/images/feature1.jpg')}}" alt="#">
                        <i class="fa fa-institution"></i>
                    </div>
                    <div class="feature-content">
                        <h4 class="f-title">Best Facility</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam suscipit fugiat sint
                            totam soluta assumenda</p>
                    </div>
                </div>
                <!--/ End Single Feature -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Single Feature -->
                <div class="single-feature">
                    <div class="icon-img">
                        <img src="{{asset('courses_template/images/feature3.jpg')}}" alt="#">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="feature-content">
                        <h4 class="f-title">Certified Teachers</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam suscipit fugiat sint
                            totam soluta assumenda</p>
                    </div>
                </div>
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
                    <img src="{{asset('courses_template/images/event-left.png')}}" alt="#">
                </div>
            </div>
            <div class="col-lg-7 col-12">
                <div class="coming-event">
                    <!-- Single Event -->
                    <div class="single-event">
                        <div class="event-date">
                            <p>23<span>March</span></p>
                        </div>
                        <div class="event-content">
                            <h3 class="event-title"><a href="event-single.html">Admission Fair Spring 2019</a></h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse facilisis
                                ultricies tortor, nec sollicitudin lorem sagittis vitae. Curabitur rhoncus commodo
                            </p>
                            <span class="entry-date-time"><i class="fa fa-clock-o" aria-hidden="true"></i> 05:23 AM
                                - 09:23 AM </span>
                        </div>
                    </div>
                    <!-- End Single Event -->
                    <!-- Single Event -->
                    <div class="single-event">
                        <div class="event-date">
                            <p>25<span>April</span></p>
                        </div>
                        <div class="event-content">
                            <h3 class="event-title"><a href="event-single.html">Internation Web Developments
                                    Awards!</a></h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse facilisis
                                ultricies tortor, nec sollicitudin lorem sagittis vitae. Curabitur rhoncus commodo
                            </p>
                            <span class="entry-date-time"><i class="fa fa-clock-o" aria-hidden="true"></i> 05:23 AM
                                - 09:23 AM </span>
                        </div>
                    </div>
                    <!-- End Single Event -->
                    <!-- Single Event -->
                    <div class="single-event">
                        <div class="event-date">
                            <p>05<span>Jun</span></p>
                        </div>
                        <div class="event-content">
                            <h3 class="event-title"><a href="event-single.html">Actualized Network Seminar</a></h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse facilisis
                                ultricies tortor, nec sollicitudin lorem sagittis vitae. Curabitur rhoncus commodo
                            </p>
                            <span class="entry-date-time"><i class="fa fa-clock-o" aria-hidden="true"></i> 05:23 AM
                                - 09:23 AM </span>
                        </div>
                    </div>
                    <!-- End Single Event -->
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
                        <p>facilisis ultricies tortor, nec sollicitudin lorem sagittis vitae. Curabitur rhoncus
                            commodo rutrum. Pellentesque habitant morbi tristique senectus et netus et malesuada
                            fames ac turpis egestas. Aliquam nec lacus pulvinar, laoreet dolor quis, pellentesque
                            ante. Cras nulla orci, pharetra at dictum consequat, pretium pretium nulla</p>
                        <!-- CTA Button -->
                        <div class="button">
                            <a class="btn white" href="{{route('login')}}">Join With Now</a>
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
                    <p>Able an hope of body. Any nay shyness article matters own removal nothing his forming. Gay
                        own additions education satisfied the perpetual. If he cause manor happy</p>
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
                            <div class="panel panel-default">
                                <div class="faq-heading" id="FaqTitle1">
                                    <h4 class="faq-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                            href="#faq1"><i class="fa fa-question"></i>We have launches a new
                                            software house!</a>
                                    </h4>
                                </div>
                                <div id="faq1" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="FaqTitle1">
                                    <div class="faq-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Suspendisse facilisis ultricies tortor, nec sollicitudin lorem sagittis
                                        vitae. Curabitur rhoncus commodo rutrum. Pellentesque habitant morbi
                                        tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam
                                        nec lacus pulvinar, laoreet dolor quis, pellentesque ante. Cras nulla orci,
                                        pharetra at dictum consequat</div>
                                </div>
                            </div>
                            <!--/ End Single Faq -->
                            <!-- Single Faq -->
                            <div class="panel panel-default active">
                                <div class="faq-heading" id="FaqTitle2">
                                    <h4 class="faq-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                            href="#faq2"><i class="fa fa-question"></i>Curabitur rhoncus commodo
                                            rutrum. Pellentesque</a>
                                    </h4>
                                </div>
                                <div id="faq2" class="panel-collapse collapse show" role="tabpanel"
                                    aria-labelledby="FaqTitle2">
                                    <div class="faq-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Suspendisse facilisis ultricies tortor, nec sollicitudin lorem sagittis
                                        vitae. Curabitur rhoncus commodo rutrum. Pellentesque habitant morbi
                                        tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam
                                        nec lacus pulvinar, laoreet dolor quis, pellentesque ante. Cras nulla orci,
                                        pharetra at dictum consequat</div>
                                </div>
                            </div>
                            <!--/ End Single Faq -->
                            <!-- Single Faq -->
                            <div class="panel panel-default">
                                <div class="faq-heading" id="FaqTitle3">
                                    <h4 class="faq-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                            href="#faq3"><i class="fa fa-question"></i>Suspendisse facilisis
                                            ultricies tortor, nec sollicitudin</a>
                                    </h4>
                                </div>
                                <div id="faq3" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="FaqTitle3">
                                    <div class="faq-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Suspendisse facilisis ultricies tortor, nec sollicitudin lorem sagittis
                                        vitae. Curabitur rhoncus commodo rutrum. Pellentesque habitant morbi
                                        tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam
                                        nec lacus pulvinar, laoreet dolor quis, pellentesque ante. Cras nulla orci,
                                        pharetra at dictum consequat</div>
                                </div>
                            </div>
                            <!--/ End Single Faq -->
                            <!-- Single Faq -->
                            <div class="panel panel-default">
                                <div class="faq-heading" id="FaqTitle4">
                                    <h4 class="faq-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                            href="#faq4"><i class="fa fa-question"></i>Tristique senectus et netus
                                            et malesuada fames ac turpis </a>
                                    </h4>
                                </div>
                                <div id="faq4" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="FaqTitle4">
                                    <div class="faq-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Suspendisse facilisis ultricies tortor, nec sollicitudin lorem sagittis
                                        vitae. Curabitur rhoncus commodo rutrum. Pellentesque habitant morbi
                                        tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam
                                        nec lacus pulvinar, laoreet dolor quis, pellentesque ante. Cras nulla orci,
                                        pharetra at dictum consequat</div>
                                </div>
                            </div>
                            <!--/ End Single Faq -->
                            <!-- Single Faq -->
                            <div class="panel panel-default">
                                <div class="faq-heading" id="FaqTitle5">
                                    <h4 class="faq-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                            href="#faq5"><i class="fa fa-question"></i>Cras nulla orci, pharetra at
                                            dictum consequat</a>
                                    </h4>
                                </div>
                                <div id="faq5" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="FaqTitle5">
                                    <div class="faq-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Suspendisse facilisis ultricies tortor, nec sollicitudin lorem sagittis
                                        vitae. Curabitur rhoncus commodo rutrum. Pellentesque habitant morbi
                                        tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam
                                        nec lacus pulvinar, laoreet dolor quis, pellentesque ante. Cras nulla orci,
                                        pharetra at dictum consequat</div>
                                </div>
                            </div>
                            <!--/ End Single Faq -->
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
                    <p>Vivamus volutpat eros pulvinar velit laoreet, sit amet egestas erat dignissim. Et harum
                        quidem</p>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-12">
                <div class="client-slider">
                    <div class="single-slider">
                        <a href="#"><img src="{{asset('courses_template/images/client1.png')}}" alt="#"></a>
                    </div>
                    <div class="single-slider">
                        <a href="#"><img src="{{asset('courses_template/images/client2.png')}}" alt="#"></a>
                    </div>
                    <div class="single-slider">
                        <a href="#"><img src="{{asset('courses_template/images/client3.png')}}" alt="#"></a>
                    </div>
                    <div class="single-slider">
                        <a href="#"><img src="{{asset('courses_template/images/client4.png')}}" alt="#"></a>
                    </div>
                    <div class="single-slider">
                        <a href="#"><img src="{{asset('courses_template/images/client5.png')}}" alt="#"></a>
                    </div>
                    <div class="single-slider">
                        <a href="#"><img src="{{asset('courses_template/images/client1.png')}}" alt="#"></a>
                    </div>
                    <div class="single-slider">
                        <a href="#"><img src="{{asset('courses_template/images/client2.png')}}" alt="#"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ End Clients CSS -->


@endsection
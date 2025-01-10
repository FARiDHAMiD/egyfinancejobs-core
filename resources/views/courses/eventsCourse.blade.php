@extends('courses.main')
@section('courses.content')

<!-- Breadcrumb -->
<div class="breadcrumbs overlay" style="background-image:url('{{asset('courses_template/images/breadcrumb-bg.jpg')}}')">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <h2>Events</h2>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="bread-list">
                    <li><a href="{{route('courses.index')}}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="#">Events<i class="fa fa-angle-right"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--/ End Breadcrumb -->


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
                            <h3 class="event-title"><a href="event-single.html">Egyptian Economic Summitr Spring
                                    2025</a></h3>
                            <p>To bring together investors, financial professionals, startups, and government officials
                                to discuss the latest trends in investment, digital finance, and economic policy, while
                                providing networking opportunities for collaboration and growth.
                            </p>
                            <span class="entry-date-time"><i class="fa fa-clock-o" aria-hidden="true"></i> 08:0 AM
                                - 05:30 PM </span>
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
                            <p>Connecting Professionals: Financial events allow participants to network with industry
                                leaders, investors, entrepreneurs, and policymakers, leading to potential
                                collaborations, partnerships, and business opportunities.
                            </p>
                            <span class="entry-date-time"><i class="fa fa-clock-o" aria-hidden="true"></i> 08:00 AM
                                - 06:00 PM </span>
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
                            <p>Showcasing Innovations: Financial institutions, banks, and fintech companies often use
                                events to launch new financial products or services, attracting attention from the
                                press, investors, and consumers.
                            </p>
                            <span class="entry-date-time"><i class="fa fa-clock-o" aria-hidden="true"></i> 08:00 AM
                                - 09:30 PM </span>
                        </div>
                    </div>
                    <!-- End Single Event -->
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Events -->
@endsection
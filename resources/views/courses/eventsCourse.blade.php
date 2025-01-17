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
        {{-- Upcoming Events --}}
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
            {{-- picture --}}
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
                <div class="coming-event">

                    <!-- Single Event -->
                    <div class="single-event">
                        <div class="event-date">
                            <p>05<span>Jun</span></p>
                        </div>
                        <div class="event-content">
                            <h3 class="event-title"><a href="{{route('courses.events.show', $event->uuid)}}">Actualized
                                    Network Seminar</a></h3>
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
        <hr>
        {{-- Completed Events --}}
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <div class="section-title bg">
                    <h2>Completed <span>Events</span></h2>
                    <p>Financial events provide a platform for professionals, investors, and businesses to connect,
                        collaborate, and build relationships that can lead to partnerships, investment opportunities,
                        and business growth.</p>
                    <div class="icon"><i class="fa fa-check"></i></div>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- picture --}}
            <div class="col-lg-5 col-12">
                <div class="event-img">
                    <img src="{{asset('courses_template/images/event-single.jpg')}}" alt="#">
                </div>
            </div>

            {{-- upcoming events data --}}
            <div class="col-lg-7 col-12">

                <div class="coming-event">
                    @foreach ($completed_events as $event)
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
                <div class="coming-event">

                    <!-- Single Event -->
                    <div class="single-event">
                        <div class="event-date">
                            <p>05<span>Jun</span></p>
                        </div>
                        <div class="event-content">
                            <h3 class="event-title"><a href="{{route('courses.events.show', $event->uuid)}}">Actualized
                                    Network Seminar</a></h3>
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
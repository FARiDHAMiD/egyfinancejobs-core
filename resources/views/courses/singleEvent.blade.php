@extends('courses.main')
@section('courses.content')
<div class="container">

    <!-- Single Event named contact section for styling ... -->
    <section id="contact" class="contact section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-12">
                    <div class="section-title bg">
                        <h2>{{$event->title}}</h2>
                        <h6 class="text-muted">{{$event->description}}</h6>
                        <div class="icon"><i class="fa fa-calendar" style="font-size: large;"></i></div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="contact-right">

                        <!-- Event-Info -->
                        <div class="contact-info">
                            <div class="icon"><i class="fa fa-calendar" style="font-size: x-large"></i></div>
                            <h3 class="font-weight-bold">event information</h3>
                            <p><span class="text-dark font-weight-bold">Type: </span>{{$event->type->name}}</p>
                            <p><span class="text-dark font-weight-bold">Status: </span>{{$event->statu->name}}</p>
                            <p><span class="text-dark font-weight-bold">Location: </span>{{$event->location ?
                                $event->location : 'N/A'}}</p>
                            <p><span class="text-dark font-weight-bold">From: </span> {{date('jS, F Y',
                                strtotime($event->start_date))}}
                                <span class="text-dark font-weight-bold"> to </span>
                                {{date('jS, F Y',strtotime($event->end_date))}}
                            </p>
                            @if($event->email)
                            <p><span class="text-dark font-weight-bold">Email: </span>{{$event->email}}</p>
                            @endif
                        </div>
                        <!-- End Event-Info -->

                        <!-- Instructor / Organizer Info-Info -->
                        @if($event->user_instructor)
                        <div class="contact-info">
                            <div class="icon"><i class="fa fa-address-book" style="font-size: x-large"></i></div>
                            <h3 class="font-weight-bold">Organizer Information</h3>
                            <a target="_blank"
                                href="{{route('courses.instructorProfile', $event->user_instructor->uuid)}}">
                                <p>
                                    <span class="font-weight-bold">Name: </span> <span class="text-primary">
                                        {{$event->user_instructor->first_name}} {{$event->user_instructor->last_name}}
                                    </span>
                                </p>
                            </a>
                            <p><span class="font-weight-bold">Job Title:
                                </span>{{$event->user_instructor->instructor_profile->job_title}}</p>
                            <p><span class="font-weight-bold">Email: </span>{{$event->user_instructor->email}}</p>
                            <p><span class="font-weight-bold">Mobile:
                                </span>{{$event->user_instructor->instructor_profile->mobile}}</p>
                        </div>
                        @endif
                        {{-- End Instructor Info --}}
                    </div>


                </div>

                {{-- video url --}}
                <div class="col-lg-8 col-md-8 col-12">
                    @if($event->video_url)
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$event->video_url}}"
                            allowfullscreen></iframe>
                    </div>
                    @else
                    <div class="course-head">
                        <img src="{{ empty($event->getFirstMedia('event_img')) ? asset('courses_template/images/courses/course3.jpg') : $event->getFirstMedia('event_img')->getUrl() }}"
                            alt="">
                    </div>
                    @endif

                    @if($event->register_link)
                    <a target="_blank" href="{{$event->register_link}}" class="btn primary my-2">Register Here</a>
                    @endif



                </div>
            </div>
        </div>
    </section>
    <!--/ End Single Event -->
</div>
@endsection
@extends('courses.main')
@section('courses.content')
<div class="container">

    <!-- contact section for styling ... -->
    <section id="contact" class="contact section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-12">
                    <div class="section-title bg">
                        <h2>{{$course->name}}</h2>
                        <h6 class="text-muted">{{$course->info}}</h6>
                        <div class="icon"><i class="fa fa-book" style="font-size: large;"></i></div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="contact-right">

                        <!-- Course-Info -->
                        <div class="contact-info">
                            <div class="icon"><i class="fa fa-book" style="font-size: x-large"></i></div>
                            <h3 class="font-weight-bold">course information</h3>
                            <p><span class="text-dark font-weight-bold">Category: </span>{{$course->cat->name}}</p>
                            <p><span class="text-dark font-weight-bold">Type: </span>{{$course->type->name}}</p>
                            <p><span class="text-dark font-weight-bold">Status: </span>{{$course->statu->name}}</p>
                            <p><span class="text-dark font-weight-bold">Location: </span>{{$course->location ?
                                $course->location : 'N/A'}}</p>
                            <p><span class="text-dark font-weight-bold">From: </span> {{date('d-m-Y',
                                strtotime($course->start_date))}}
                                <span class="text-dark font-weight-bold"> to </span>
                                {{date('d-m-Y',strtotime($course->end_date))}}
                            </p>
                            <p><span class="text-success font-weight-bold">Price: </span> {{$course->price ?
                                $course->price :
                                'Free'}}</p>
                            <p><span class="font-weight-bold">Prerequisite: </span>
                                {{$course->prerequisite ? $course->prerequisite : 'Non'}}
                            </p>
                        </div>
                        <!-- End Course-Info -->
                        <!-- Instructor Info-Info -->
                        <div class="contact-info">
                            <div class="icon"><i class="fa fa-address-book" style="font-size: x-large"></i></div>
                            <h3 class="font-weight-bold">Instructor Information</h3>
                            <a target="_blank"
                                href="{{route('courses.instructorProfile', $course->user_instructor->uuid)}}">
                                <p>
                                    <span class="font-weight-bold">Name: </span> <span class="text-primary">
                                        {{$course->user_instructor->first_name}} {{$course->user_instructor->last_name}}
                                    </span>
                                </p>
                            </a>
                            <p><span class="font-weight-bold">Job Title:
                                </span>{{$course->user_instructor->instructor_profile->job_title}}</p>
                            <p><span class="font-weight-bold">Email: </span>{{$course->user_instructor->email}}</p>
                            <p><span class="font-weight-bold">Mobile:
                                </span>{{$course->user_instructor->instructor_profile->mobile}}</p>
                        </div>
                        {{-- End Instructor Info --}}
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-12">
                    @if($course->video_url)
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$course->video_url}}"
                            allowfullscreen></iframe>
                    </div>
                    @endif
                    <div class="">
                        <a href="#" class="btn primary my-2">Enroll</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Contact Us -->
</div>
@endsection
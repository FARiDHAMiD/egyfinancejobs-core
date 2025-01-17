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
                            <p><span class="text-dark font-weight-bold">Location: </span>{{$course->place ?
                                $course->place : 'N/A'}}</p>
                            <p><span class="text-dark font-weight-bold">From: </span> {{date('d-m-Y',
                                strtotime($course->start_date))}}
                                <span class="text-dark font-weight-bold"> to </span>
                                {{date('d-m-Y',strtotime($course->end_date))}}
                            </p>
                            <p>
                                <span class="text-dark font-weight-bold">Price:</span>
                                <span class="text-success font-weight-bold">
                                    {{$course->hide_price ? 'N/A' : ($course->price ? 'EGP ' .
                                    number_format($course->price) : 'Free')}}
                                </span>
                            </p>
                            <p><span class="text-dark font-weight-bold">Prerequisite: </span>
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

                    {{-- check if current login user enrolled in this course before --}}
                    @if($student_enrolled)
                    <button type="button" class="btn btn-success my-2" disabled>Enrolled Successfully</button>
                    {{-- check if course start date not coming - user can cancel enroll --}}
                    @if($course->start_date > now()) <form method="POST"
                        action="{{route('courses.enroll.cancel', $student_enrolled->id)}}">
                        @csrf
                        <button type="submit" class="btn danger my-2">Cancel !</button>
                    </form>
                    @endif {{-- check if user employee(student) --}}
                    @elseif(auth()->
                    check() && auth()->user()->hasRole('employee') || auth()->check() &&
                    auth()->user()->hasRole('instructor'))
                    <div class="">
                        <form method="POST" action="{{route('courses.enroll', [auth()->user()->id, $course->id])}}">
                            @csrf
                            <button type="submit" class="btn primary my-2">Enroll</button>
                        </form>
                    </div>
                    @else
                    <div class="">
                        <a href="{{route('login_page')}}" class="btn primary my-2">Enroll</a>
                    </div>
                    @endif
                </div>

                {{-- submit review --}}
                <form action="{{ route('courses.review_store', $course->id) }}" method="POST">
                    @csrf
                    <textarea name="review_txt" class="form-control" placeholder="Write your review..."></textarea>
                    <div>
                        <label for="rating">Rating (1-5):</label>
                        <input type="number" name="rating" min="1" max="5" required>
                    </div>
                    <button class="btn white primary" type="submit">Submit Review</button>
                </form>

                <div class="col-lg-12 col-md-12 col-12">
                    {{-- the same course instructors and admins only can view this course enrollments --}}
                    @if(auth()->check() && auth()->user()->hasRole('admin') || auth()->check() && auth()->user()->id
                    == $course->instructor_id)
                    <!-- Enrolled Students -->
                    <div class="contact-info">
                        <div class="icon"><i class="fa fa-users" style="font-size: x-large"></i></div>
                        <h3 class="font-weight-bold">Enrolled Students
                            <span class="text-muted">Only Instructor Can Review this section<br> Total
                                ({{$enrolls->count()}})</span>
                        </h3>
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student</th>
                                        <th>Request Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($enrolls as $enroll)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td class="text-nowrap">
                                            <a class="text-primary" target="_blank"
                                                href="{{route('courses.profile', $enroll->student->uuid)}}">
                                                {{$enroll->student->first_name}} {{$enroll->student->last_name}}
                                            </a>
                                        </td>
                                        <td>{{date('d-m-Y', strtotime($enroll->created_at));}}</td>
                                        @if($enroll->accepted_by)
                                        <td class="text-success">Approved!</td>
                                        @else
                                        <td class="text-center">
                                            <form method="POST"
                                                action="{{route('courses.accept_enroll', $enroll->id)}}">
                                                @csrf
                                                <button type="submit" class="btn primary" style="padding: 5px 10px"><i
                                                        class="fa fa-check"></i>
                                                </button>
                                            </form>
                                        </td>
                                        @endif

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- End Enrolled Students --}}
                    @endif

                </div>
            </div>
        </div>
    </section>
    <!--/ End Contact Us -->
</div>
@endsection
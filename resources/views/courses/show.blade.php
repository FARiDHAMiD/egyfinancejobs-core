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
                        <h6 class="text-muted">{{$course->description}}</h6>
                        <div class="icon"><i class="fa fa-book" style="font-size: large;"></i></div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="contact-right">
                        <!-- Contact-Info -->
                        <div class="contact-info">
                            <div class="icon"><i class="fa fa-address-book" style="font-size: larger"></i></div>
                            <h3>Instructor Information</h3>
                            <p>Name: {{'Instructor Name'}}</p>
                            <p>Email: {{'instructor@example.com'}}</p>
                            <p>Social Linke: {{'instructor@example.com'}}</p>
                        </div>
                        <!-- Contact-Info -->
                        <div class="contact-info">
                            <div class="icon"><i class="fa fa-envelope"></i></div>
                            <h3>course information</h3>
                            <p>Category: <span class="text-dark font-weight-bold">Personal Finance</span></p>
                            <p>Type: <span class="text-dark font-weight-bold"> Classroom-Based</span></p>
                            <p>Status: <span class="text-dark font-weight-bold">Opening to enroll</span></p>
                            <p>Location: <span class="text-dark font-weight-bold">Heliopolis, Cairo.</span></p>
                            <p>From: <span class="text-dark font-weight-bold">Jan, 18th 2025.</span> to <span
                                    class="text-dark font-weight-bold">Mar, 01st 2025.</span></p>
                            <p>Price: <span class="text-success font-weight-bold">EGP 2600</span></p>
                            <p>Prerequisite:
                                <a href="{{route('courses.show', $course->prerequisite)}}">
                                    <span class="text-primary">
                                        Personal Finance 101: Managing Your Money
                                    </span>
                                </a>
                            </p>
                        </div>
                        <!-- Contact-Info -->
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-12">
                    <div class="form-head">
                        <!-- Contact Form -->
                        <form class="form" action="mail/mail.php">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <i class="fa fa-user"></i>
                                        <input name="first-name" type="text" placeholder="First name">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <i class="fa fa-envelope"></i>
                                        <input name="last-name" type="text" placeholder="Last name">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <i class="fa fa-envelope"></i>
                                        <input name="email" type="email" placeholder="Email address">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <i class="fa fa-envelope"></i>
                                        <input name="url" type="url" placeholder="Website url">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group message">
                                        <i class="fa fa-pencil"></i>
                                        <textarea name="message" placeholder="Type your message"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="button">
                                            <button type="submit" class="btn primary">Enroll</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--/ End Contact Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Contact Us -->
</div>
@endsection
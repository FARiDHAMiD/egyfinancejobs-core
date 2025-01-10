@extends('courses.main')
@section('courses.content')
<!-- Breadcrumb -->
<div class="breadcrumbs overlay" style="background-image:url('{{asset('courses_template/images/breadcrumb-bg.jpg')}}')">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <h2>About Us</h2>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="bread-list">
                    <li><a href="{{route('courses.index')}}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="#">About Us<i class="fa fa-angle-right"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--/ End Breadcrumb -->

<!-- About Us -->
<section class="courses archive section">
    <div class="container">
        <h5 class="text-primary my-3">About Us</h5>


        <h6 class="font-weight-bold">

            Welcome to Egy Finance Courses, your trusted partner in financial education! We are dedicated to
            providing high-quality, comprehensive financial courses designed to empower individuals with the
            knowledge and skills necessary to manage their finances effectively and achieve their financial goals.
        </h6>
        <br>

        <h6 class="font-weight-bold">
            At Egy Finance Courses, we understand that financial literacy is the key to success in today’s
            fast-paced world. Whether you're a beginner looking to understand the basics of budgeting and saving, or
            an experienced investor wanting to deepen your knowledge of advanced strategies, our diverse range of
            online courses caters to learners at all levels. From personal finance to investing, wealth management,
            and financial planning, we offer a wide variety of topics that are relevant to your financial journey.
        </h6>
        <br>

        <h6 class="font-weight-bold">
            Our expert instructors are seasoned professionals in the financial industry, bringing real-world
            experience and practical insights into every lesson. We believe in learning by doing, which is why our
            courses are designed with interactive content, real-life case studies, and actionable steps you can
            apply immediately. You won’t just be watching videos—you’ll be gaining skills you can use to take charge
            of your financial future.
        </h6>
        <br>
        <h6 class="font-weight-bold">
            What sets us apart is our commitment to providing personalized learning experiences. We understand that
            every individual’s financial situation and goals are unique. That’s why we offer flexible learning
            paths, from self-paced courses to live webinars and one-on-one coaching, ensuring that you have the
            support you need at every step of your learning journey.
        </h6>
        <br>
        <h6 class="font-weight-bold">
            With a user-friendly platform and engaging content, we aim to make learning about finance not only
            accessible but enjoyable. Whether you're just starting out or looking to refine your skills, our goal is
            to simplify complex financial concepts and make them easy to understand for everyone.
        </h6>
        <br>
        <h6 class="font-weight-bold">
            Join thousands of learners who have taken control of their financial future with Egy Finance Courses.
            Our mission is to inspire confidence, enhance financial knowledge, and equip you with the tools to make
            smarter financial decisions. Start your journey to financial empowerment today and unlock a world of
            possibilities!"

        </h6>
    </div>
</section>

@endsection
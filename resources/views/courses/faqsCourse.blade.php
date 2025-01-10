@extends('courses.main')
@section('courses.content')

<!-- Breadcrumb -->
<div class="breadcrumbs overlay" style="background-image:url('{{asset('courses_template/images/breadcrumb-bg.jpg')}}')">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <h2>Frequently Asked Questions</h2>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="bread-list">
                    <li><a href="{{route('courses.index')}}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="{{route('courses.contact_us')}}">Conatc Us<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="#">FAQs<i class="fa fa-angle-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--/ End Breadcrumb -->

<!-- Faqs -->
<section class="faqs section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <div class="section-title bg">
                    <h2>Frequently Asked <span>Questions</span></h2>
                    <p>Well-crafted FAQs can help alleviate concerns, build confidence in the product, and ultimately
                        encourage users to sign up for services, enroll in courses, or purchase financial products.</p>
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
                            <div class="panel panel-default active">
                                <div class="faq-heading" id="FaqTitle1">
                                    <h4 class="faq-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                            href="#faq1"><i class="fa fa-question"></i>What types of financial courses
                                            do you offer?</a>
                                    </h4>
                                </div>
                                <div id="faq1" class="panel-collapse collapse show" role="tabpanel"
                                    aria-labelledby="FaqTitle1">
                                    <div class="faq-body">We offer a wide range of financial courses including personal
                                        finance, investment strategies, corporate finance, accounting, budgeting,
                                        financial analysis, tax planning, and financial modeling. Courses cater to all
                                        levels, from beginners to advanced professionals.</div>
                                </div>
                            </div>
                            <!--/ End Single Faq -->
                            <!-- Single Faq -->
                            <div class="panel panel-default">
                                <div class="faq-heading" id="FaqTitle2">
                                    <h4 class="faq-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                            href="#faq2"><i class="fa fa-question"></i>Who can take these courses?</a>
                                    </h4>
                                </div>
                                <div id="faq2" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="FaqTitle2">
                                    <div class="faq-body">Our courses are designed for individuals at all experience
                                        levels. Whether you're a beginner looking to learn the basics of budgeting, a
                                        professional aiming to enhance your skills in investment, or someone wanting to
                                        improve their financial literacy, we have courses for you.</div>
                                </div>
                            </div>
                            <!--/ End Single Faq -->
                            <!-- Single Faq -->
                            <div class="panel panel-default">
                                <div class="faq-heading" id="FaqTitle3">
                                    <h4 class="faq-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                            href="#faq3"><i class="fa fa-question"></i>Do I need prior experience in
                                            finance to take these courses?</a>
                                    </h4>
                                </div>
                                <div id="faq3" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="FaqTitle3">
                                    <div class="faq-body">No prior experience is required for many of our courses. We
                                        offer beginner-level courses that cover the basics, as well as more advanced
                                        courses for professionals looking to expand their knowledge.</div>
                                </div>
                            </div>
                            <!--/ End Single Faq -->
                            <!-- Single Faq -->
                            <div class="panel panel-default">
                                <div class="faq-heading" id="FaqTitle4">
                                    <h4 class="faq-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                            href="#faq4"><i class="fa fa-question"></i>How long does it take to complete
                                            a course?</a>
                                    </h4>
                                </div>
                                <div id="faq4" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="FaqTitle4">
                                    <div class="faq-body">Course durations vary depending on the content and format.
                                        Some courses can be completed in just a few hours, while others may take several
                                        weeks. You can learn at your own pace, and there are no strict deadlines unless
                                        specified.</div>
                                </div>
                            </div>
                            <!--/ End Single Faq -->
                            <!-- Single Faq -->
                            <div class="panel panel-default">
                                <div class="faq-heading" id="FaqTitle5">
                                    <h4 class="faq-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                            href="#faq5"><i class="fa fa-question"></i>Do you offer group or corporate
                                            training?</a>
                                    </h4>
                                </div>
                                <div id="faq5" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="FaqTitle5">
                                    <div class="faq-body">Yes, we offer customized training programs for businesses or
                                        groups. If you're looking to train multiple employees in financial concepts or
                                        skills, please contact our team for a tailored solution and pricing.</div>
                                </div>
                            </div>
                            <!--/ End Single Faq -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Faqs -->

@endsection
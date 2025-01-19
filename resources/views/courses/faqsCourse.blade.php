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
                            @foreach ($faqs as $index => $faq)
                            <div class="panel panel-default {{$index == 0 ? 'active' : ''}}">
                                <div class="faq-heading" id="FaqTitle{{$index}}">
                                    <h4 class="faq-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                            href="#faq{{$index}}"><i class="fa fa-question"></i>{{$faq->question}}</a>
                                    </h4>
                                </div>
                                <div id="faq{{$index}}" class="panel-collapse collapse {{$index == 0 ? 'active' : ''}}"
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
    </div>
</section>
<!--/ End Faqs -->

@endsection
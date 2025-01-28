@extends('website.app')
@section('website.content')
<!-- Banner start -->
<div class="banner bg-color-full" id="banner">
    <div id="bannerCarousole" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item banner-max-height active">
                <img class="d-block w-100 h-100" src="{{ url('/website') }}/img/banner-2.jpg" alt="banner">
                <div class="carousel-caption banner-slider-inner d-flex text-center"></div>
            </div>
        </div>
    </div>
    <div class="banner-inner">
        <div class="container">
            <div class="text-center">
                <p>Searching for Financial vacancies?</p>
                <h1 class="b-text banner-title">Find the Best Financial Jobs</h1>
                <div class="inline-search-area ml-auto mr-auto">
                    <form action="{{route('website.jobs')}}" method="get">
                        <div class="search-boxs">
                            <div class="search-col">
                                <input type="text" name="search_field" class="form-control has-icon b-radius"
                                    placeholder="Search on Jobs ...">
                            </div>
                            <div class="find">
                                <button class="btn button-theme btn-search btn-block b-radius">
                                    <i class="fa fa-search"></i> Search
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner end -->


<!-- Top Hiring Companies strat -->
<div class="partners content-area-15">
    <div class="container">
        <div class="main-title text-center">
            <h2 class="section-title">Top Hiring Companies</h2>
        </div>
        <div class="slick-slider-area">
            <div class="row slick-carousel position-relative"
                data-slick='{"slidesToShow": 5, "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 3}}, {"breakpoint": 768,"settings":{"slidesToShow": 2}}]}'>

                @foreach ($featured_companies as $employer)
                <div class="slick-slide-item">
                    <a href="{{ route('employer.profile', $employer->uuid) }}" data-toggle="tooltip"
                        data-placement="top" title="{{$employer->company_name}}">
                        <img style="height: 120px;object-fit: cover"
                            src="{{ empty($employer->getFirstMedia('company_logo')) ? asset('/website/img/company-logo.png') : $employer->getFirstMedia('company_logo')->getUrl() }}"
                            alt="brand" class="img-fluid" width="150" height="100">
                        <div>
                            <h5 class="text-muted text-center">{{$employer->company_name}}</h5>
                        </div>
                    </a>
                </div>
                @endforeach



            </div>
        </div>
    </div>
</div>
<!-- Top Hiring Companies end -->



<!-- Latest Jobs strat -->
<div class="popular-categories content-area-7 bg-grea">
    <div class="container">
        <!-- Main title -->
        <div class="main-title text-center">
            <h2 class="section-title">Latest Jobs</h2>
        </div>
        <div class="row">

            @foreach ($latest_jobs as $job)
            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                <a href="{{ route('website.job-details', $job->job_uuid) }}">
                    <div class="categorie-box home-latest-jobs">
                        <div class="row my-0">
                            <div class="col-7">
                                <h3 class="job-title">{{ $job->job_title }} </h3>
                            </div>
                            <div class="col-2 text-right">
                                @if($job->featured)
                                <img src="{{ asset('/website/img/star.png') }}" alt="brand" class="img-fluid" width="40"
                                    height="40">
                                @endif
                            </div>
                            <div class="col-3">
                                <div class="company-logo">
                                    @if($job->employer)
                                    <img src="{{ empty($job->employer->getFirstMedia('company_logo')) ? asset('/website/img/company-logo.png') : $job->employer->getFirstMedia('company_logo')->getUrl() }}"
                                        alt="brand" class="img-fluid">
                                    @endif
                                </div>
                            </div>

                        </div>
                        <p class="job-location">{{ $job->employer_profile->company_name ?? '' }}</p>
                        <p class="text-muted">{{ substr($job->job_excerpt, 0, 80) ?? '' }}</p>
                        <div class="row">
                            <div class="col-7">
                                <span class="job-date-posted"> <i class="flaticon-time"></i> {{
                                    $job->created_at->diffForHumans() }} </span>

                            </div>
                            <div class="col-5 text-right">
                                <span class="job-date-posted text-end text-sm"> <i class="fa fa-map-marker"></i> {{
                                    $job->city->name
                                    }} </span>
                            </div>
                        </div>

                    </div>
                </a>
            </div>
            @endforeach




        </div>
        <div class="text-center mt-3">
            <a href="{{route('website.jobs')}}" class="btn button-theme">
                See all new jobs
            </a>
        </div>
    </div>
</div>
<!-- Latest Jobs end -->



<!-- Counters strat -->
<div class="counters">
    <div class="container">
        <div class="main-title text-center">
            <h2 class="section-title">Many Years Of Hiring Excellence</h2>
        </div>
        <div class="row">
            <div class="col-md-4 col-12">
                <div class="counter-box">
                    <img src="{{ url('/website') }}/img/profiles.png">
                    <p class="counter">{{$employers}}</p>
                    <p>Employers</p>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="counter-box mid">
                    <img src="{{ url('/website') }}/img/visitors.png">
                    <p class="counter">{{$employee}}</p>
                    <p>Employees</p>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="counter-box">
                    <img src="{{ url('/website') }}/img/clients_rate.png">
                    <p class="counter">{{$jobs}}</p>
                    <p>Job Vacancies</p>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- Counters end -->

{{-- contact us --}}
<div class="popular-categories content-area-7 bg-grea">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h3 class="h5 mb-3">Egy Finance Jobs Team Would Like To Help You!</h3>
                <!-- Form content box start -->
                <div class="form-content-box w-100 mt-0">
                    <!-- details -->
                    <div class="details text-left  border-radius-5">
                        <!-- Form start -->
                        <!-- Form start -->
                        <form action="{{route('website.contact_us.create')}}" method="POST">
                            @csrf
                            @if(!auth()->check())
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="input-text @error('name') is-invalid @enderror"
                                    value="{{old('name')}}" placeholder="Your Name ..." required>
                            </div>
                            @error('name')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror

                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" name="mobile"
                                    class="input-text @error('mobile') is-invalid @enderror" value="{{old('mobile')}}"
                                    placeholder="Mobile No.">
                            </div>
                            @error('mobile')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="input-text @error('email') is-invalid @enderror"
                                    value="{{old('email')}}" placeholder="Please provide valid email address ...">
                            </div>
                            @error('email')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                            @endif

                            <div class="form-group">
                                <label>How can we help you?</label>
                                <textarea name="description"
                                    class="input-text @error('description') is-invalid @enderror"
                                    placeholder="Help, Suggestion, Recommendation, etc..." rows="3"
                                    required>{{old('description')}}</textarea>
                            </div>
                            @error('employer')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror

                            @auth
                            @else
                            <div class="my-2 d-flex justify-content-center">
                                {!!htmlFormSnippet()!!}
                                @error('g-recaptcha-response')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            @endauth

                            <div class="text-right">
                                <button type="submit" class="btn button-theme px-5">
                                    Send
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- Form content box end -->
            </div>
        </div>
    </div>
</div>
{{-- end contact us --}}

<!-- Courses Banner start -->
<div class="banner bg-color-full" id="banner">
    <div id="bannerCarousole" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item banner-max-height active">
                <img class="d-block w-100 h-100" src="{{ url('/website') }}/img/event-avatar.jpg" alt="banner">
                <div class="carousel-caption banner-slider-inner d-flex text-center"></div>
            </div>
        </div>
    </div>
    <div class="banner-inner">
        <div class="container">
            <div class="text-center">
                <h1 class="b-text banner-title">Egy Finance Courses</h1>

                <div class="row align-items-center justify-content-center">
                    <div class="col-md-12">
                        <p class="fs-10 mb-2">
                            Our goal is to empowering you with the knowledge and tools to master your finances.
                            Whether you’re just starting out or looking to refine your financial strategies, our
                            expert-designed courses will guide you every step of the way.
                        </p>

                        <a target="_blank" href="{{route('courses.index')}}" class="btn button-theme mt-2">
                            Explore Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Courses Banner end -->


<!-- FAQs -->
<div class="job-listing-section content-area job-details">
    <h5 class="text-center my-2">Our Clients Frequently Asked Questions</h5>
    <div class="container mt-3">

        <div id="accordion">
            @foreach ($faqs as $index => $faq)
            <div class="card my-2">
                <div class="card-header" id="heading{{$index}}">
                    <h5 class="mb-0">
                        <a class="" data-toggle="collapse" data-target="#collapse{{$index}}" aria-expanded="true"
                            aria-controls="collapseOne">
                            <h6 class="mb-1" style="color: navy;">{{$faq->question}}</h6>
                        </a>
                    </h5>
                </div>

                <div id="collapse{{$index}}" class="collapse" aria-labelledby="heading{{$index}}"
                    data-parent="#accordion">
                    <div class="card-body">
                        <h6 class="mb-2">{{$faq->answer}}</h6>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
        <div class="text-center mt-3">
            <a href="{{route('faqs')}}" class="btn button-theme">
                See All FAQs
            </a>
        </div>
    </div>
</div>
{{-- End FAQs --}}

<!-- Latest Jobs strat in cairo -- temp remove -->
{{-- <div class="popular-categories content-area-7 bg-grea">
    <div class="container">
        <!-- Main title -->
        <div class="main-title text-center">
            <h2 class="section-title">Latest Jobs In Cairo</h2>
        </div>
        <div class="row">

            @foreach ($jobs_cairo as $job_cairo)
            <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                <div class="categorie-box home-latest-jobs">
                    <a href="{{ route('website.job-details', $job_cairo->id) }}">
                        <h3 class="job-title">{{ $job_cairo->job_title }} </h3>
                    </a>
                    <p class="job-location">{{ $job_cairo->employer_profile->company_name ?? '' }}</p>
                    <span class="job-date-posted"> <i class="flaticon-time"></i> {{
                        $job_cairo->created_at->diffForHumans() }} </span>
                </div>
            </div>
            @endforeach




        </div>
        <div class="text-center mt-3">
            <a href="{{ route('website.jobs', ['city_id' => 1]) }}" class="btn button-theme">
                See all new jobs
            </a>
        </div>
    </div>
</div> --}}
<!-- Latest Jobs in cairo end -->




<!-- Packages strat -->
{{-- <div class="popular-categories content-area-7 bg-grea">
    <div class="container">
        <!-- Main title -->
        <div class="main-title text-center">
            <h2 class="section-title">Hire from Largest Talent Financial Employees</h2>
        </div>
        <div class="row">
            <div class="col-lg-4 col-12">
                <div class="categorie-box packages">
                    <div class="package-header">
                        <p class="package-price">1000 EGP</p>
                        <h3 class="package-title"><a href="package-details.html">Lite Package Per Month</a></h3>
                        <p class="package-subtitle">Best for start-ups with basic hiring needs</p>
                    </div>
                    <div class="package-body">
                        <ul>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i> 500 CV Views</li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i> 1500 Candidate Emails</li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i> CVs from 160+
                                Nationalities
                            </li>
                        </ul>
                    </div>
                    <button class="btn button-theme w-100 mt-3">
                        Buy Now
                    </button>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="categorie-box packages">
                    <div class="package-header">
                        <p class="package-price">1000 EGP</p>
                        <h3 class="package-title"><a href="package-details.html">Lite Package Per Month</a></h3>
                        <p class="package-subtitle">Best for start-ups with basic hiring needs</p>
                    </div>
                    <div class="package-body">
                        <ul>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i> 500 CV Views</li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i> 1500 Candidate Emails</li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i> CVs from 160+
                                Nationalities
                            </li>
                        </ul>
                    </div>
                    <button class="btn button-theme w-100 mt-3">
                        Buy Now
                    </button>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="categorie-box packages">
                    <div class="packages-triangle"><i class="fa fa-star" aria-hidden="true"></i></div>
                    <div class="package-header">
                        <p class="package-price">1000 EGP</p>
                        <h3 class="package-title"><a href="package-details.html">Lite Package Per Month</a></h3>
                        <p class="package-subtitle">Best for start-ups with basic hiring needs</p>
                    </div>
                    <div class="package-body">
                        <ul>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i> 500 CV Views</li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i> 1500 Candidate Emails</li>
                            <li><i class="fa fa-check-circle-o" aria-hidden="true"></i> CVs from 160+
                                Nationalities
                            </li>
                        </ul>
                    </div>
                    <button class="btn button-theme w-100 mt-3">
                        Buy Now
                    </button>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- Packages end -->
@endsection
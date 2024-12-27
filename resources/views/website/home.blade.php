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
                <p>Searching for Financial vacancies? One More !</p>
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

                @foreach ($latest_companies as $employer)
                <div class="slick-slide-item">
                    <a href="{{ route('employer.profile', $employer->id) }}">
                        <img style="height: 120px;object-fit: cover"
                            src="{{ empty($employer->getFirstMedia('company_logo')) ? asset('/website/img/company-logo.png') : $employer->getFirstMedia('company_logo')->getUrl() }}"
                            alt="brand" class="img-fluid">
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
            <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                <div class="categorie-box home-latest-jobs">
                    <a href="{{ route('website.job-details', $job->job_uuid) }}">
                        <h3 class="job-title">{{ $job->job_title }} </h3>
                    </a>
                    <p class="job-location">{{ $job->employer_profile->company_name ?? '' }}</p>
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
                    <p>Number of employers</p>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="counter-box mid">
                    <img src="{{ url('/website') }}/img/visitors.png">
                    <p class="counter">{{$employee}}</p>
                    <p>Number of Employee</p>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="counter-box">
                    <img src="{{ url('/website') }}/img/clients_rate.png">
                    <p class="counter">{{$jobs}}</p>
                    <p>Number of jobs</p>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- Counters end -->
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
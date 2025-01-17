@extends('website.app')
@section('website.content')
<!-- Employer Detail start -->
<div class="job-listing-section content-area job-details employer-details">

    <div class="employer-header">
        <img style="object-fit: cover" height="200px"
            src="{{ empty($employer->getFirstMedia('company_banner')) ? asset('/website/img/banner_img.jpg') : $employer->getFirstMedia('company_banner')->getUrl() }}"
            class="employer-banner w-100" alt="">

        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-4">
                    <div class="employer-logo">
                        <img src="{{ empty($employer->getFirstMedia('company_logo')) ? asset('/website/img/company-logo.png') : $employer->getFirstMedia('company_logo')->getUrl() }}"
                            class="employer-banner" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-8 mt-4">
                    <h1 class="h4 mb-1">{{$employer_profile->company_name}}</h1>
                    <p>{{$industry}} . {{$city}}, {{$country}} . {{$employer_profile->company_size}} employees</p>
                    <div class="employer-links">
                        @if (!empty($social_links->website)) <a href="{{$social_links->website}}" target="_blank"
                            class="website">{{$social_links->website}}</a> @endif
                        <ul class="social-media">
                            @if (!empty($social_links->facebook)) <li><a class="facebook-bg"
                                    href="{{$social_links->facebook}}"><i class="fa fa-facebook"></i></a></li> @endif
                            @if (!empty($social_links->twitter)) <li><a class="twitter-bg"
                                    href="{{$social_links->linkedin}}"><i class="fa fa-linkedin"></i></a></li> @endif
                            @if (!empty($social_links->linkedin)) <li><a class="linkedin-bg"
                                    href="{{$social_links->twitter}}"><i class="fa fa-twitter"></i></a></li> @endif
                        </ul>
                    </div>
                </div>
                @if($employer_profile->featured)
                <div class="col-lg-3 col-sm-8 mt-4 text-right">
                    <span class="badge badge-primary font-weight-bold" style="font-size: x-large">Featured!</span>
                    {{-- <img src="{{ asset('/website/img/featured.png') }}" class="img-fluid m-0" style="float: right;"
                        alt="" width="120" height="120"> --}}
                </div>
                @endif
            </div>
            <div class="btn-group mt-3" role="group" aria-label="Basic example">
                <a href="#" type="button" class="btn button-theme">Company Profile</a>
                <a href="#jobs" type="button" class="btn btn-default">Jobs</a>
                <button class="btn button-theme bg-transparent" type="button" data-toggle="modal"
                    data-target="#share-buttons-{{ $employer_profile->uuid }}">
                    Share
                </button>
            </div>
        </div>
    </div>

    <!-- share profile -->
    <!-- Modal -->
    <div class="modal fade" id="share-buttons-{{ $employer_profile->uuid }}" tabindex="-1" role="dialog"
        aria-labelledby="share-buttons-{{ $employer_profile->uuid }}Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close absolute-modal-close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <div class="text-center">
                        <h4>share this Company Profile on</h4>
                        <hr>
                        <div class="employer-links justify-content-center">
                            <ul class="social-media">
                                <li>
                                    <a class="facebook-bg"
                                        href="https://www.facebook.com/sharer/sharer.php?u={{ route('employer.profile', $employer->uuid) }}"
                                        target="_blank">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>


                                <li>
                                    <a class="linkedin-bg"
                                        href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('employer.profile', $employer->uuid) }}&title={{ $employer->first_name }}&summary={{ $employer->employer_profile->company_name }} | {{ $employer->employer_profile->company_description }}&source={{ route('website.home') }}"
                                        target="_blank" rel="noopener noreferrer">
                                        <i class="fa fa-linkedin"></i></a>
                                    </a>
                                </li>

                                <li>
                                    <a class="twitter-bg" target="_blank"
                                        href="https://x.com/intent/tweet?text={{ $employer->first_name . ' ' . $employer->last_name }}&url={{ route('employer.profile', $employer->uuid) }}">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>

                                <li><a class="copy-bg copyLink"
                                        href="{{ route('employer.profile', $employer->uuid) }}"><i
                                            class="fa fa-copy"></i></a>
                                    <p class="copyMessage" style="display: none;">Link copied!</p>

                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end share -->


    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <div class="job-box">
                    <div class="job-info mb-4">
                        <h2 class="h4 mb-3">Company Profile</h2>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-5">
                                        <p class="mb-1"><strong class="text-black">Location:</strong></p>
                                    </div>
                                    <div class="col-lg-8 col-sm-7">
                                        <p class="text-black mb-1">{{$city}}, {{$country}}</p>
                                    </div>
                                </div>
                                <hr class="my-2 d-sm-none d-block">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-5">
                                        <p class="mb-1"><strong class="text-black">Industry:</strong></p>
                                    </div>
                                    <div class="col-lg-8 col-sm-7">
                                        <p class="text-black mb-1">{{$industry}}</p>
                                    </div>
                                </div>
                                <hr class="my-2 d-sm-none d-block">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-5">
                                        <p class="mb-1"><strong class="text-black">Company Size:</strong></p>
                                    </div>
                                    <div class="col-lg-8 col-sm-7">
                                        <p class="text-black mb-1"> {{$employer_profile->company_size}} employees</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <p>
                        {{$employer_profile->company_description}}
                    </p>
                </div>

                {{-- open jobs for company --}}
                <div id="jobs" class="card py-3 px-4 mb-3">
                    <div class="job-info mb-4">
                        <h2 class="h4 mb-3">Open vacancies at {{$employer_profile->company_name}}</h2>
                    </div>
                    <div class="row">
                        @foreach ($emp_jobs->where('archived', 0) as $job)
                        <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                            <a href="{{ route('website.job-details', $job->job_uuid) }}">
                                <div class="categorie-box home-latest-jobs">
                                    <div class="row my-0">
                                        <div class="col-7">
                                            <h3 class="job-title">{{ $job->job_title }} </h3>
                                        </div>
                                        <div class="col-2 text-right">
                                            @if($job->featured)
                                            <img src="{{ asset('/website/img/star.png') }}" alt="brand"
                                                class="img-fluid" width="40" height="40">
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
                                            <span class="job-date-posted text-end text-sm"> <i
                                                    class="fa fa-map-marker"></i> {{
                                                $job->city->name
                                                }} </span>
                                        </div>
                                    </div>

                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>

                </div>

                @if(auth()->check() && auth()->user()->hasRole('admin'))
                {{-- Closed jobs for company --}}
                <div id="jobs" class="card py-3 px-4 mb-3">
                    <div class="job-info mb-4">
                        <h2 class="h4 mb-3"><span class="text-danger">Closed / Previous </span> vacancies at
                            {{$employer_profile->company_name}}</h2> <span class="text-muted">appears for admins
                            only</span>
                    </div>
                    <div class="row">
                        @foreach ($emp_jobs->where('archived', 1) as $job)
                        <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                            <a target="_blank" href="{{ route('jobs.edit', $job->id) }}">
                                <div class="categorie-box home-latest-jobs">
                                    <div class="row my-0">
                                        <div class="col-7">
                                            <h3 class="job-title">{{ $job->job_title }} </h3>
                                        </div>
                                        <div class="col-2 text-right">
                                            @if($job->featured)
                                            <img src="{{ asset('/website/img/star.png') }}" alt="brand"
                                                class="img-fluid" width="40" height="40">
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
                                            <span class="job-date-posted text-end text-sm"> <i
                                                    class="fa fa-map-marker"></i> {{
                                                $job->city->name
                                                }} </span>
                                        </div>
                                    </div>

                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>

                </div>
                @endif
            </div>

        </div>
    </div>
</div>
<!-- Employer Detail end -->
@endsection
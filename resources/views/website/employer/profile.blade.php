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
                <div class="col-lg-9 col-sm-8 mt-4">
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
            </div>
            <div class="btn-group mt-3" role="group" aria-label="Basic example">
                <a href="#" type="button" class="btn button-theme">Company Profile</a>
                <a href="#jobs" type="button" class="btn btn-default">Jobs</a>
                <button class="btn button-theme bg-transparent" type="button" data-toggle="modal"
                    data-target="#share-buttons-{{ $employer_profile->id }}">
                    Share
                </button>
            </div>
        </div>
    </div>

    <!-- share profile -->
    <!-- Modal -->
    <div class="modal fade" id="share-buttons-{{ $employer_profile->id }}" tabindex="-1" role="dialog"
        aria-labelledby="share-buttons-{{ $employer_profile->id }}Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close absolute-modal-close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <div class="text-center share-buttons">
                        <h4>share this Company Profile on</h4>
                        <hr>
                        <ul class="social-list clearfix">
                            <li>
                                <a href="#"
                                    data-href="https://www.facebook.com/sharer.php?u={{ route('employer.profile', $employer_profile->employer_id) }}"
                                    class="share_button facebook"><i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    data-href="https://twitter.com/intent/tweet?url={{ route('employer.profile', $employer_profile->employer_id) }}"
                                    class="share_button twitter"><i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    data-href="https://www.linkedin.com/sharing/share-offsite/?url={{ route('employer.profile', $employer_profile->employer_id) }}"
                                    class="share_button linkedin"><i class="fa fa-linkedin"></i>

                                </a>
                            </li>
                            <li>
                                <a href="{{ route('employer.profile', $employer_profile->employer_id) }}"
                                    class="copyLink">
                                    <i class="fa fa-copy"></i>
                                </a>
                                <p class="copyMessage" style="display: none;">Link copied!</p>

                            </li>

                        </ul>
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
                                    <div class="col-lg-3 col-sm-5">
                                        <p class="mb-1"><strong class="text-black">Location:</strong></p>
                                    </div>
                                    <div class="col-lg-9 col-sm-7">
                                        <p class="text-black mb-1">{{$city}}, {{$country}}</p>
                                    </div>
                                </div>
                                <hr class="my-2 d-sm-none d-block">
                                <div class="row">
                                    <div class="col-lg-3 col-sm-5">
                                        <p class="mb-1"><strong class="text-black">Industry:</strong></p>
                                    </div>
                                    <div class="col-lg-9 col-sm-7">
                                        <p class="text-black mb-1">{{$industry}}</p>
                                    </div>
                                </div>
                                <hr class="my-2 d-sm-none d-block">
                                <div class="row">
                                    <div class="col-lg-3 col-sm-5">
                                        <p class="mb-1"><strong class="text-black">Company Size:</strong></p>
                                    </div>
                                    <div class="col-lg-9 col-sm-7">
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





                <div id="jobs" class="card py-3 px-4 mb-3">
                    <div class="job-info mb-4">
                        <h2 class="h4 mb-3">Open vacancies at {{$employer_profile->company_name}}</h2>
                    </div>
                    <div class="row">
                        @foreach ($employer->employer_jobs as $job)
                        <div class="col-md-6">
                            <div class="job-box">
                                <div class="d-flex justify-content-between align-items-start">
                                    <span class="job-period-type"><i class="flaticon-time"></i>
                                        {{ $job->type->name }}</span>
                                </div>
                                <div class="description">
                                    <div>
                                        <h5 class="title"><a
                                                href="{{ route('website.job-details', $job->job_uuid) }}">{{
                                                $job->job_title }}</a>
                                        </h5>
                                        <div class="candidate-listing-footer">
                                            <ul>
                                                <li><i class="flaticon-work"></i>
                                                    {{ $job->employer_profile->company_name }}</li>
                                                <li><i class="flaticon-pin"></i> {{ empty($job->area) ? null :
                                                    $job->area->name }},
                                                    {{ empty($job->city) ? null : $job->city->name }}, {{
                                                    $job->country->name }}</li>
                                            </ul>

                                            {{-- <h6>Deadline: <span class="text-success">Jan 31, 2019</span></h6> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- Employer Detail end -->
@endsection
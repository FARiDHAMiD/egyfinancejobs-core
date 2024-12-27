@extends('website.app')
@section('website.content')
<div class="job-listing-section content-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="job-parent">
                    <div class="mb-3">
                        <h2 class="page-main-title mb-1">{{$saved_jobs->count()}} Active Saved Job</h2>
                    </div>
                    @foreach ($saved_jobs as $job)
                        <div class="job-box">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="company-logo">
                                    <img src="{{ empty($job->employer->getFirstMedia('company_logo')) ? asset('/website/img/company-logo.png') : $job->employer->getFirstMedia('company_logo')->getUrl() }}" alt="logo">
                                </div>

                                <span class="job-period-type"><i class="flaticon-time"></i>
                                    {{ $job->type->name }}
                                </span>

                            </div>
                            <div class="description">
                                <div class="float-left">
                                    <h5 class="title"><a
                                            href="{{ route('website.job-details', $job->job_uuid) }}">{{ $job->job_title }}</a>
                                    </h5>
                                    <div class="candidate-listing-footer">
                                        <ul>
                                            <li><i class="flaticon-work"></i> {{optional($job->employer_profile)->company_name??'N/A' }}
                                            </li>
                                            <li><i class="flaticon-pin"></i> {{ empty($job->area) ? null : $job->area->name }},
                                                {{ empty($job->city) ? null : $job->city->name }}, {{ $job->country->name }}</li>
                                        </ul>
                                        <p class="job-excerpt">
                                            {{ $job->job_excerpt }}
                                        </p>
                                        {{-- <h6>Deadline: <span class="text-success">Jan 31, 2019</span></h6> --}}
                                    </div>
                                </div>
                                <div class="div-right text-right">

                                    @if (is_job_applied(auth()->user()->id, $job->id))
                                        <button class="btn button-success bg-success text-white disabled">Applied</button>
                                    @endif

                                    <a href="{{ route('website.job-details', $job->id) }}" class="btn button-theme">
                                        Job Details
                                    </a>

                                    @if (is_has_job(auth()->user()->id, $job->id))
                                        <a href="{{ route('employee.jobs.unsave-job', $job->id) }}"
                                            class="btn button-theme">
                                            Unsave
                                        </a>
                                    @else
                                        <a href="{{ route('employee.jobs.save-job', $job->id) }}"
                                            class="btn button-theme bg-transparent">
                                            Save
                                        </a>
                                    @endif


                                    <button class="btn button-theme bg-transparent" type="button"
                                        data-toggle="modal" data-target="#share-buttons-{{ $job->id }}">
                                        Share
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="share-buttons-{{ $job->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="share-buttons-{{ $job->id }}Title"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <button type="button" class="close absolute-modal-close-btn"
                                                    data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <div class="modal-body">
                                                    <div class="text-center share-buttons">
                                                        <h4>share this job on</h4>
                                                        <hr>
                                                        <ul class="social-list clearfix">
                                                            <li><a href="#"
                                                                    data-href="https://www.facebook.com/sharer.php?u={{ route('website.job-details', $job->id) }}"
                                                                    class="share_button facebook"><i
                                                                        class="fa fa-facebook"></i></a></li>
                                                            <li><a href="#"
                                                                    data-href="https://twitter.com/intent/tweet?url={{ route('website.job-details', $job->id) }}"
                                                                    class="share_button twitter"><i
                                                                        class="fa fa-twitter"></i></a>
                                                            </li>
                                                            <li><a href="#"
                                                                    data-href="https://www.linkedin.com/sharing/share-offsite/?url={{ route('website.job-details', $job->id) }}"
                                                                    class="share_button linkedin"><i
                                                                        class="fa fa-linkedin"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
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
@endsection

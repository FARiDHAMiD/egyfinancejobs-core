@extends('website.app')
@section('website.content')
<!-- Job Details start -->
<div class="job-listing-section content-area job-details">
    <div class="container mt-3">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-12 order-lg-1 order-2">
                <div class="job-box">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="company-logo">
                            <img src="{{ empty($job->employer->getFirstMedia('company_logo')) ? asset('/website/img/company-logo.png') : $job->employer->getFirstMedia('company_logo')->getUrl() }}"
                                alt="brand" class="img-fluid">

                        </div>
                        <span class="job-period-type"><i class="flaticon-time"></i> {{ $job->type->name }}</span>
                    </div>
                    <div class="description">

                        <div>
                            {{-- <h5 class="title"><a href="job-details.html">{{ $job->job_title }}</a></h5> --}}
                            <h5 class="title"><a>{{ $job->job_title }}</a></h5>
                            <div class="candidate-listing-footer">
                                <ul>
                                    <li><i class="flaticon-work"></i> {{
                                        optional($job->employer_profile)->company_name??'N/A' }}</li>
                                    <li><i class="flaticon-pin"></i> {{ empty($job->area) ? null : $job->area->name }},
                                        {{ empty($job->city) ? null : $job->city->name }}, {{ $job->country->name }}
                                    </li>
                                </ul>

                                <p class="mb-0">Posted {{ $job->created_at->diffForHumans() }}</p>
                                {{-- <h6>Deadline: <span class="text-success">Jan 31, 2019</span></h6> --}}
                            </div>
                        </div>


                        <div class="div-right text-right">



                            @if (Auth::check() && is_job_applied(auth()->user()->id, $job->id))
                            <button class="btn button-success bg-success text-white disabled">Applied</button>
                            @else
                            @if ($job->external_url)
                            <a href="{{$job->external_url}}" target="_blank" class="btn button-theme">
                                Apply on this job
                            </a>
                            @elseif($job->external_email)
                            <a href="{{$job->external_email}}"
                                class="btn button-success bg-success text-white  copyLink">
                                Copy E-Mail
                            </a>

                            @else
                            <button data-toggle="modal" data-target="#apply-job" class="btn button-theme">
                                Apply on this job
                            </button>
                            @endif
                            @endif


                            @if (Auth::check())
                            @if (is_has_job(auth()->user()->id, $job->id))
                            <button class="btn button-theme bg-transparent" type="button"
                                onclick="window.location='{{ route('employee.jobs.unsave-job', $job->id) }}'">Unsave</button>
                            @else
                            <button class="btn button-theme bg-transparent" type="button"
                                onclick="window.location='{{ route('employee.jobs.save-job', $job->id) }}'">Save</button>
                            @endif


                            <button class="btn button-theme bg-transparent" type="button" data-toggle="modal"
                                data-target="#share-buttons-{{ $job->id }}">
                                Share
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="share-buttons-{{ $job->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="share-buttons-{{ $job->id }}Title" aria-hidden="true">
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
                                                                class="fa fa-facebook"></i></a>

                                                    </li>

                                                    <li><a href="#"
                                                            data-href="https://twitter.com/intent/tweet?url={{ route('website.job-details', $job->id) }}"
                                                            class="share_button twitter"><i
                                                                class="fa fa-twitter"></i></a>
                                                    </li>
                                                    <li><a href="#"
                                                            data-href="https://www.linkedin.com/sharing/share-offsite/?url={{ route('website.job-details', $job->id) }}"
                                                            class="share_button linkedin"><i class="fa fa-linkedin"></i>
                                                    <li><a href="{{ route('website.job-details', $job->id) }}"
                                                            class="copyLink"><i class="fa fa-copy"></i></a>
                                                        <p class="copyMessage" style="display: none;">Link copied!</p>

                                                    </li>
                                                    </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <p class="copyMessage text-right" style="display: none;">E-Mail copied!</p>

                        <!-- Modal -->
                        <div class="modal fade" id="apply-job" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <button type="button" class="close modal-close-btn" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>

                                    @if (empty($job->questions[0]))
                                    <div class="modal-body text-center py-5">
                                        <h2 class="h4">Apply for job</h2>
                                        <p class="text-black">Are you sure you want to apply to this job?</p>
                                        <a href="{{ route('employee.jobs.apply-job', $job->id) }}"
                                            class="btn button-theme w-75">
                                            Apply
                                        </a>
                                    </div>
                                    @else
                                    <form class="modal-body text-center py-5" method="post"
                                        action="{{ route('employee.jobs.apply-job', $job->id) }}">
                                        @csrf
                                        <h2 class="h4">Apply for job</h2>
                                        <hr>
                                        <div class="text-left">
                                            @foreach ($job->questions as $question)
                                            <p class="mb-2"><strong>{{ $question->question }}</strong></p>
                                            <textarea rows="3" name="answers[{{ $question->id }}]"
                                                class="form-control mb-4" placeholder="enter your answer"
                                                rows="6"></textarea>
                                            @endforeach
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn button-theme w-75">
                                            Apply
                                        </button>
                                    </form>
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="job-box">
                    <div class="job-info mb-4">
                        <h2 class="h4 mb-3">Job Details</h2>
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="mb-1"><strong class="text-black">Experience Needed:</strong></p>
                            </div>
                            <div class="col-lg-9">
                                <p class="text-black mb-1">{{ $job->years_experience }} Years</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="mb-1"><strong class="text-black">Career Level:</strong></p>
                            </div>
                            <div class="col-lg-9">
                                <p class="text-black mb-1">{{ $job->career_level->name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="mb-1"><strong class="text-black">Education Level:</strong></p>
                            </div>
                            <div class="col-lg-9">
                                <p class="text-black mb-1">{{ $job->education_level->name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="mb-1"><strong class="text-black">Salary:</strong></p>
                            </div>
                            <div class="col-lg-9">
                                <p class="text-black mb-1">{{ $job->salary }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="mb-1"><strong class="text-black">Job Category:</strong></p>
                            </div>
                            <div class="col-lg-9">
                                <p class="text-black mb-1">{{ $job->category->name ?? ''}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="job-info mb-4">
                        <h2 class="h4">Skills And Tools:</h2>
                        <ul class="skills-list">
                            @foreach ($job->skills as $skill)
                            <li>{{ $skill->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="job-box">
                    <div class="job-info mb-4">
                        <h2 class="h4">Job Description</h2>
                        {{ $job->job_description }}
                    </div>
                </div>
                <div class="job-box">
                    <div class="job-info mb-4">
                        <h2 class="h4">Job Requirements</h2>
                        {{ $job->job_requirements }}
                    </div>
                </div>
                @if (!empty($similar_jobs[0]))
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <h2 class="h4">Similar Jobs</h2>
                    </div>

                    @foreach ($similar_jobs as $job)
                    <div class="col-xl-6">
                        <div class="job-box">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="company-logo">
                                    <img src="{{ empty($job->employer->getFirstMedia('company_logo')) ? asset('/website/img/company-logo.png') : $job->employer->getFirstMedia('company_logo')->getUrl() }}"
                                        alt="brand" class="img-fluid">

                                </div>
                                <span class="job-period-type"><i class="flaticon-time"></i>
                                    {{ $job->type->name }}</span>
                            </div>
                            <div class="description">
                                <div>
                                    <h5 class="title"><a href="{{ route('website.job-details', $job->id) }}">{{
                                            $job->job_title }}</a>
                                    </h5>
                                    <div class="candidate-listing-footer">
                                        <ul>
                                            <li><i class="flaticon-work"></i>
                                                {{ optional($job->employer_profile)->company_name??'N/A' }}</li>
                                            <li><i class="flaticon-pin"></i> {{empty($job->area) ? null :
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
                @endif

            </div>
            <div class="col-xl-4 col-lg-4 col-md-12 order-lg-2 order-1">
                <div class="sidebar-right py-4 px-3">
                    <h3 class="company-name">About {{ optional($job->employer_profile)->company_name??'N/A' }}</h3>
                    <p class="text-dark-light mt-2">{{ optional(optional($job->employer_profile)->industry)->name }}</p>

                    <p class="text-gray">
                        {{ optional(optional($job->employer_profile)->city)->name }},
                        {{ optional(optional($job->employer_profile)->country)->name }}•
                        {{ optional($job->employer_profile)->company_size }}employees

                    </p>

                    <p class="text-dark-light">{{ optional($job->employer_profile)->company_description }}</p>

                    @if($job->employer_profile)

                    <a class="company-jobs-link"
                        href="{{route('employer.profile', optional($job->employer_profile)->employer_id)}}">View Company
                        Profile</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Job Details end -->
@endsection
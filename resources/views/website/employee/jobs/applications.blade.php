@extends('website.app')
@section('website.content')
<style>
    .job-box {
        cursor: pointer;
    }

    .job-box.active {
        border: 2px solid #00c2ff;
    }
</style>
@php
$application_index = 0;
if (request()->has('application_index')) {
$application_index = request()->application_index;
}
@endphp
<div class="job-listing-section content-area">
    <div class="container">

        <div class="row">
            <div class="col-lg-6">
                <div class="d-flex justify-content-between align-items-md-center flex-md-row flex-column mb-4">

                    <h1 class="page-main-title">
                        @if(auth()->check() && auth()->user()->hasRole('admin'))
                        <span>
                            {{$employee->first_name}} {{$employee->last_name}} |
                            {{$employee->employee_profile->job_title->name}} |
                            {{$employee->employee_profile->career_level->name}}
                        </span>
                        <br>
                        @endif
                        Applications ({{ $applications_count }})
                    </h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                @foreach ($applications as $index => $application)
                @if(!$application->job->archived)
                <div data-application-index="{{ $index }}"
                    class="job-box {{ $index == $application_index ? 'active' : '' }}">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="company-logo">
                            <img src="{{ empty($application->job->employer->getFirstMedia('company_logo')) ? asset('/website/img/company-logo.png') : $application->job->employer->getFirstMedia('company_logo')->getUrl() }}"
                                alt="logo">
                        </div>

                        {{-- Style application status tag color --}}
                        @switch($application->statu_id)
                        @case(1)
                        <span class="job-period-type">{{ $application->application_statu->name}}</span>
                        @break
                        @case(2)
                        <span class="job-period-type bg-primary text-light">{{
                            $application->application_statu->name}}</span>
                        @break
                        @case(3)
                        <span class="job-period-type bg-info text-light">{{
                            $application->application_statu->name}}</span>
                        @break
                        @case(4)
                        <span class="job-period-type bg-success text-light">{{
                            $application->application_statu->name}}</span>
                        @break
                        @case(5)
                        <span class="job-period-type bg-danger text-light">{{
                            $application->application_statu->name}}</span>
                        @break
                        @default

                        @endswitch

                    </div>
                    <div class="description">
                        <div class="float-left">
                            <h5 class="title"><a
                                    href="{{ route('website.job-details', $application->job->job_uuid) }}">{{
                                    $application->job->job_title }}</a>
                            </h5>
                            <div class="candidate-listing-footer">
                                <ul>
                                    <li><i class="flaticon-work"></i>
                                        {{optional($application->job->employer_profile)->company_name??'N/A' }}


                                    <li><i class="flaticon-pin"></i> {{ empty($application->job->area) ? null :
                                        $application->job->area->name }},
                                        {{ empty($application->city) ? null : $application->job->city->name }}, {{
                                        $application->job->country->name }}
                                    </li>
                                </ul>
                                <h6>Applied {{ $application->created_at->diffForHumans() }} </h6>
                            </div>
                        </div>
                    </div>
                </div>
                @endif()
                @endforeach

            </div>
            @if ($applications->count() > 0)
            @if(!$applications[$application_index]->job->archived)
            <div class="col-lg-6 d-lg-block d-none">
                <div class="bg-grea-3 p-4">
                    <h5 class="title">{{ $applications[$application_index]->job->job_title }}</h5>
                    <div class="candidate-listing-footer">
                        <ul>
                            <li><i class="flaticon-work"></i>
                                {{optional($applications[$application_index]->job->employer_profile)->company_name??'N/A'
                                }}
                            </li>
                            <li><i class="flaticon-pin"></i>
                                {{ empty($applications[$application_index]->job->area) ? null :
                                $applications[$application_index]->job->area->name }},
                                {{ empty($applications[$application_index]->job->city) ? null :
                                $applications[$application_index]->job->city->name }},
                                {{ $applications[$application_index]->job->country->name }}</li>
                        </ul>
                        <div class="row">
                            <div class="col-md-8 mt-2">
                                <h6>Applied {{ $applications[$application_index]->created_at->diffForHumans() }}</h6>

                            </div>
                            @if(!auth()->user()->hasRole('admin'))
                            <div class="col-md-4 d-flex justify-content-end ">
                                <button class="btn btn-sm btn-danger m-0"
                                    onclick="cancelApplication({{$applications[$application_index]->id}})">
                                    Cancel!
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="sidebar-right py-4 px-3">

                    @if($applications[$application_index]->application_answers->count() > 0)
                    <div class="row">
                        <div class="col-7">
                            @if(auth()->check() && auth()->user()->hasRole('admin'))
                            <h2 class="h4">{{$employee->first_name}} Answers For this Job</h2>
                            @else
                            <h2 class="h4">Your Answers For this Job</h2>
                            @endif
                        </div>
                        <div class="col-5 text-right">
                            <span class="text-gray">Answers
                                {{ $applications[$application_index]->application_answers->count() }}</span>
                        </div>
                    </div>
                    @else
                    <h5 class="text-muted">This Job Vacancy has no required questions!</h5>
                    @endif
                    <hr>
                    @foreach ($applications[$application_index]->application_answers as $answer)
                    <div>
                        <h3 class="h6">{{ $answer->question->question }}</h3>
                        <p class="border-box">
                            {{ $answer->answer }}
                        </p>
                    </div>
                    @endforeach


                </div>
            </div>
            @endif
            @endif

        </div>
    </div>
</div>
@endsection

@section('website.page-scripts')
<script>
    $('.job-box').click(function() {
            var applicationIndex = $(this).attr('data-application-index');
            window.location.href = window.location.pathname + '?application_index=' + applicationIndex;
        })
    function cancelApplication(id){
        if (confirm('Are you sure you want to withdraw from this Job ?')) {
            let url = "{{ route('job_application.destroy', ':id') }}";
            url = url.replace(':id', id);
            window.location=url
            // $("#cancelApplicationForm").submit();
            // document.location.href=url;
        }
    }
</script>
@endsection
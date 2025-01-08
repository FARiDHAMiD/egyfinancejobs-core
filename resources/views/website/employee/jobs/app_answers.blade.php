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

<div class="job-listing-section content-area">
    <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-md-center flex-md-row flex-column mb-4">
                    <h5 class="page-main-title text-muted">
                        {{$employee->first_name}}'s Answers for this job Applications
                    </h5>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-12">
                <div class="bg-grea-3 p-4">
                    <h5 class="title">{{ $application->job->job_title }}</h5>
                    <div class="candidate-listing-footer">
                        <ul>
                            <li><i class="flaticon-work"></i>
                                {{optional($application->job->employer_profile)->company_name??'N/A'
                                }}
                            </li>
                            <li><i class="flaticon-pin"></i>
                                {{ empty($application->job->area) ? null :
                                $application->job->area->name }},
                                {{ empty($application->job->city) ? null :
                                $application->job->city->name }},
                                {{ $application->job->country->name }}</li>
                        </ul>
                        <div class="row">
                            <div class="col-md-8 mt-2">
                                <h6>Applied {{ $application->created_at->diffForHumans() }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sidebar-right py-4 px-3">

                    @if(!$application->application_answers->count() > 0)
                    <h5 class="text-muted">This Job Vacancy has no required questions!</h5>
                    @endif
                    <hr>
                    @foreach ($application->application_answers as $answer)
                    <div>
                        <h3 class="h6">{{ $answer->question->question ?? ''}}</h3>
                        <p class="border-box">
                            {{ $answer->answer }}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
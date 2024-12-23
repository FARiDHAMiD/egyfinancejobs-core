@extends('website.app')
@section('website.content')
    <!-- Sub banner start -->
    <div class="sub-banner bg-blue">
        <div class="container">
            <div class="breadcrumb-area text-left container">
                <h1>Find the Best Jobs</h1>
                <div class="inline-search-area w-100">
                    <form class="search-boxs" action="{{ route('website.jobs') }}" method="GET">
                        <div class="search-col">
                            <input type="text" name="search_field" class="form-control has-icon b-radius"
                                placeholder="Search on Jobs ...">
                        </div>
                        <div class="find">
                            <button type="submit" class="btn button-theme btn-search btn-block b-radius">
                                <i class="fa fa-search"></i> Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Sub banner end -->


    <!-- Jobs Listing start -->
    <div class="job-listing-section content-area py-4">
        <div class="container">
            <div class="d-flex justify-content-between mb-4">
                <div class="d-flex align-items-md-center flex-md-row flex-column">
                    <h2 class="page-main-title mt-0 mb-2">Filters</h2>
                    <a href="{{ route('website.jobs') }}"
                        class="btn btn-default py-1 ml-md-4 d-lg-inline d-none clear-filter">
                        Clear All filters
                    </a>
                </div>

                <p class="m-0">{{ $jobs->total() }} jobs found</p>

            </div>
            <div class="row">
                <div class="col-12 d-lg-none d-flex mb-3">
                    <button data-toggle="collapse" data-target="#filter-col" class="btn button-theme w-50 mr-1 collapsed"
                        type="button"><i class="fa fa-filter"></i>
                        Filter</button>
                    <button class="btn btn-default w-50 ml-1 clear-filter">
                        Clear All filters
                    </button>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 mb-5 collapse" id="filter-col">
                    <div class="sidebar-right form-content-box m-0">
                        <!-- Advanced search start -->
                        <div class="widget-4 advanced-search">
                            <form method="GET" class="informeson" action="{{ route('website.jobs') }}">

                                <div class="form-group">
                                    <h5 class="filter-title mb-3">Country</h5>
                                    <div class="btn-group-toggle mb-2" data-toggle="buttons">
                                        <label class="btn button-theme radio-btn inline-checkbox">
                                            <input class="all-countries-field" name="" value="" type="checkbox"
                                                autocomplete="off">
                                            <p class="m-0">
                                                <i class="fa fa-check fa-lg check-icon" aria-hidden="true"></i>
                                            </p>
                                        </label>
                                        <label class="mb-0">
                                            All
                                        </label>
                                    </div>
                                    @foreach ($countries->take(1) as $country)
                                        <div class="btn-group-toggle mb-2" data-toggle="buttons">
                                            <label
                                                class="btn button-theme radio-btn inline-checkbox {{ in_array($country->id, request('country', [])) ? 'active' : '' }}">
                                                <input class="country-field" name="country[]" value="{{ $country->id }}"
                                                    type="checkbox" autocomplete="off"
                                                    {{ in_array($country->id, request('country', [])) ? 'checked' : '' }}>
                                                <p class="m-0">
                                                    <i class="fa fa-check fa-lg check-icon" aria-hidden="true"></i>
                                                </p>
                                            </label>
                                            <label class="mb-0">
                                                {{ $country->name }} ({{ $country->jobs_count }})
                                            </label>
                                        </div>
                                    @endforeach
                                    <div id="options-country" class="collapse">
                                        @foreach ($countries->slice(1) as $country)
                                            <div class="btn-group-toggle mb-2" data-toggle="buttons">
                                                <label
                                                    class="btn button-theme radio-btn inline-checkbox {{ in_array($country->id, request('country', [])) ? 'active' : '' }}">
                                                    <input class="country-field" name="country[]"
                                                        value="{{ $country->id }}" type="checkbox" autocomplete="off"
                                                        {{ in_array($country->id, request('country', [])) ? 'checked' : '' }}>
                                                    <p class="m-0">
                                                        <i class="fa fa-check fa-lg check-icon" aria-hidden="true"></i>
                                                    </p>
                                                </label>
                                                <label class="mb-0">
                                                    {{ $country->name }} ({{ $country->jobs_count }})
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if ($countries->count() > 2)
                                        <a class="show-more-options" data-toggle="collapse" data-target="#options-country">
                                            <i class="fa fa-plus-circle"></i> Show more
                                        </a>
                                    @endif
                                </div>

                                <hr>

                                <div class="form-group">
                                    <h5 class="filter-title mb-3">City</h5>
                                    <div class="btn-group-toggle mb-2" data-toggle="buttons">
                                        <label class="btn button-theme radio-btn inline-checkbox">
                                            <input class="all-cities-field" name="" value="" type="checkbox"
                                                autocomplete="off">
                                            <p class="m-0">
                                                <i class="fa fa-check fa-lg check-icon" aria-hidden="true"></i>
                                            </p>
                                        </label>
                                        <label class="mb-0">
                                            All
                                        </label>
                                    </div>
                                    @foreach ($cities->take(1) as $city)
                                        <div class="btn-group-toggle mb-2" data-toggle="buttons">
                                            <label
                                                class="btn button-theme radio-btn inline-checkbox {{ in_array($city->id, request('city', [])) ? 'active' : '' }}">
                                                <input class="city-field" name="city[]" value="{{ $city->id }}"
                                                    type="checkbox" autocomplete="off"
                                                    {{ in_array($city->id, request('city', [])) ? 'checked' : '' }}>
                                                <p class="m-0">
                                                    <i class="fa fa-check fa-lg check-icon" aria-hidden="true"></i>
                                                </p>
                                            </label>
                                            <label class="mb-0">
                                                {{ $city->name }} ({{ $city->jobs_count }})
                                            </label>
                                        </div>
                                    @endforeach


                                    <div id="options-city" class="collapse">
                                        @foreach ($cities->slice(1) as $city)
                                            <div class="btn-group-toggle mb-2" data-toggle="buttons">
                                                <label
                                                    class="btn button-theme radio-btn inline-checkbox {{ in_array($city->id, request('city', [])) ? 'active' : '' }}">
                                                    <input class="city-field" name="city[]" value="{{ $city->id }}"
                                                        type="checkbox" autocomplete="off"
                                                        {{ in_array($city->id, request('city', [])) ? 'checked' : '' }}>
                                                    <p class="m-0">
                                                        <i class="fa fa-check fa-lg check-icon" aria-hidden="true"></i>
                                                    </p>
                                                </label>
                                                <label class="mb-0">
                                                    {{ $city->name }} ({{ $city->jobs_count }})
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="show-more-options" data-toggle="collapse" data-target="#options-city">
                                        <i class="fa fa-plus-circle"></i> Show more
                                    </a>
                                </div>

                                <hr>
                                <div class="form-group">
                                    <h5 class="filter-title mb-3">Area</h5>
                                    <div class="btn-group-toggle mb-2" data-toggle="buttons">
                                        <label class="btn button-theme radio-btn inline-checkbox">
                                            <input class="all-areas-field" name="" value="" type="checkbox"
                                                autocomplete="off">
                                            <p class="m-0">
                                                <i class="fa fa-check fa-lg check-icon" aria-hidden="true"></i>
                                            </p>
                                        </label>
                                        <label class="mb-0">
                                            All
                                        </label>
                                    </div>
                                    @foreach ($areas->take(1) as $area)
                                        <div class="btn-group-toggle mb-2" data-toggle="buttons">
                                            <label
                                                class="btn button-theme radio-btn inline-checkbox {{ in_array($area->id, request('area', [])) ? 'active' : '' }}">
                                                <input class="area-field" name="area[]" value="{{ $area->id }}"
                                                    type="checkbox" autocomplete="off"
                                                    {{ in_array($area->id, request('area', [])) ? 'checked' : '' }}>
                                                <p class="m-0">
                                                    <i class="fa fa-check fa-lg check-icon" aria-hidden="true"></i>
                                                </p>
                                            </label>
                                            <label class="mb-0">
                                                {{ $area->name }} ({{ $area->jobs_count }})
                                            </label>
                                        </div>
                                    @endforeach


                                    <div id="options-area" class="collapse">
                                        @foreach ($areas->slice(1) as $area)
                                            <div class="btn-group-toggle mb-2" data-toggle="buttons">
                                                <label
                                                    class="btn button-theme radio-btn inline-checkbox {{ in_array($area->id, request('area', [])) ? 'active' : '' }}">
                                                    <input class="area-field" name="area[]" value="{{ $area->id }}"
                                                        type="checkbox" autocomplete="off"
                                                        {{ in_array($area->id, request('area', [])) ? 'checked' : '' }}>
                                                    <p class="m-0">
                                                        <i class="fa fa-check fa-lg check-icon" aria-hidden="true"></i>
                                                    </p>
                                                </label>
                                                <label class="mb-0">
                                                    {{ $area->name }} ({{ $area->jobs_count }})
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="show-more-options" data-toggle="collapse" data-target="#options-area">
                                        <i class="fa fa-plus-circle"></i> Show more
                                    </a>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <h5 class="filter-title mb-3">Career Level</h5>
                                    <div class="btn-group-toggle mb-2" data-toggle="buttons">
                                        <label class="btn button-theme radio-btn inline-checkbox">
                                            <input class="all-career_levels-field" name="" value=""
                                                type="checkbox" autocomplete="off">
                                            <p class="m-0">
                                                <i class="fa fa-check fa-lg check-icon" aria-hidden="true"></i>
                                            </p>
                                        </label>
                                        <label class="mb-0">
                                            All
                                        </label>
                                    </div>
                                    @foreach ($career_levels->take(1) as $career_level)
                                        <div class="btn-group-toggle mb-2" data-toggle="buttons">
                                            <label
                                                class="btn button-theme radio-btn inline-checkbox {{ in_array($career_level->id, request('career_level', [])) ? 'active' : '' }}">
                                                <input class="career_level-field" name="career_level[]"
                                                    value="{{ $career_level->id }}" type="checkbox" autocomplete="off"
                                                    {{ in_array($career_level->id, request('career_level', [])) ? 'checked' : '' }}>
                                                <p class="m-0">
                                                    <i class="fa fa-check fa-lg check-icon" aria-hidden="true"></i>
                                                </p>
                                            </label>
                                            <label class="mb-0">
                                                {{ $career_level->name }} ({{ $career_level->jobs_count }})
                                            </label>
                                        </div>
                                    @endforeach


                                    <div id="options-career_level" class="collapse">
                                        @foreach ($career_levels->slice(1) as $career_level)
                                            <div class="btn-group-toggle mb-2" data-toggle="buttons">
                                                <label
                                                    class="btn button-theme radio-btn inline-checkbox {{ in_array($career_level->id, request('career_level', [])) ? 'active' : '' }}">
                                                    <input class="career_level-field" name="career_level[]"
                                                        value="{{ $career_level->id }}" type="checkbox"
                                                        autocomplete="off"
                                                        {{ in_array($career_level->id, request('career_level', [])) ? 'checked' : '' }}>
                                                    <p class="m-0">
                                                        <i class="fa fa-check fa-lg check-icon" aria-hidden="true"></i>
                                                    </p>
                                                </label>
                                                <label class="mb-0">
                                                    {{ $career_level->name }} ({{ $career_level->jobs_count }})
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="show-more-options" data-toggle="collapse"
                                        data-target="#options-career_level">
                                        <i class="fa fa-plus-circle"></i> Show more
                                    </a>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <h5 class="filter-title mb-3">Years of experience</h5>
                                    <input type="number" class="w-100 input-text" name="years_of_experience"
                                        placeholder="years of experience" value="{{ request('years_of_experience') }}">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <h5 class="filter-title mb-3">Job Category</h5>
                                    <div class="btn-group-toggle mb-2" data-toggle="buttons">
                                        <label class="btn button-theme radio-btn inline-checkbox">
                                            <input class="all-job_categories-field" name="" value=""
                                                type="checkbox" autocomplete="off">
                                            <p class="m-0">
                                                <i class="fa fa-check fa-lg check-icon" aria-hidden="true"></i>
                                            </p>
                                        </label>
                                        <label class="mb-0">
                                            All
                                        </label>
                                    </div>
                                    @foreach ($job_categories->take(1) as $job_category)
                                        <div class="btn-group-toggle mb-2" data-toggle="buttons">
                                            <label
                                                class="btn button-theme radio-btn inline-checkbox {{ in_array($job_category->id, request('job_category', [])) ? 'active' : '' }}">
                                                <input class="job_category-field" name="job_category[]"
                                                    value="{{ $job_category->id }}" type="checkbox" autocomplete="off"
                                                    {{ in_array($job_category->id, request('job_category', [])) ? 'checked' : '' }}>
                                                <p class="m-0">
                                                    <i class="fa fa-check fa-lg check-icon" aria-hidden="true"></i>
                                                </p>
                                            </label>
                                            <label class="mb-0">
                                                {{ $job_category->name }} ({{ $job_category->jobs_count }})
                                            </label>
                                        </div>
                                    @endforeach


                                    <div id="options-job_category" class="collapse">
                                        @foreach ($job_categories->slice(1) as $job_category)
                                            <div class="btn-group-toggle mb-2" data-toggle="buttons">
                                                <label
                                                    class="btn button-theme radio-btn inline-checkbox {{ in_array($job_category->id, request('job_category', [])) ? 'active' : '' }}">
                                                    <input class="job_category-field" name="job_category[]"
                                                        value="{{ $job_category->id }}" type="checkbox"
                                                        autocomplete="off"
                                                        {{ in_array($job_category->id, request('job_category', [])) ? 'checked' : '' }}>
                                                    <p class="m-0">
                                                        <i class="fa fa-check fa-lg check-icon" aria-hidden="true"></i>
                                                    </p>
                                                </label>
                                                <label class="mb-0">
                                                    {{ $job_category->name }} ({{ $job_category->jobs_count }})
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="show-more-options" data-toggle="collapse"
                                        data-target="#options-job_category">
                                        <i class="fa fa-plus-circle"></i> Show more
                                    </a>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <h5 class="filter-title mb-3">Job Type</h5>
                                    <div class="btn-group-toggle mb-2" data-toggle="buttons">
                                        <label class="btn button-theme radio-btn inline-checkbox">
                                            <input class="all-job_types-field" name="" value=""
                                                type="checkbox" autocomplete="off">
                                            <p class="m-0">
                                                <i class="fa fa-check fa-lg check-icon" aria-hidden="true"></i>
                                            </p>
                                        </label>
                                        <label class="mb-0">
                                            All
                                        </label>
                                    </div>
                                    @foreach ($job_types->take(1) as $job_type)
                                        <div class="btn-group-toggle mb-2" data-toggle="buttons">
                                            <label
                                                class="btn button-theme radio-btn inline-checkbox {{ in_array($job_type->id, request('job_type', [])) ? 'active' : '' }}">
                                                <input class="job_type-field" name="job_type[]"
                                                    value="{{ $job_type->id }}" type="checkbox" autocomplete="off"
                                                    {{ in_array($job_type->id, request('job_type', [])) ? 'checked' : '' }}>
                                                <p class="m-0">
                                                    <i class="fa fa-check fa-lg check-icon" aria-hidden="true"></i>
                                                </p>
                                            </label>
                                            <label class="mb-0">
                                                {{ $job_type->name }} ({{ $job_type->jobs_count }})
                                            </label>
                                        </div>
                                    @endforeach


                                    <div id="options-job_type" class="collapse">
                                        @foreach ($job_types->slice(1) as $job_type)
                                            <div class="btn-group-toggle mb-2" data-toggle="buttons">
                                                <label
                                                    class="btn button-theme radio-btn inline-checkbox {{ in_array($job_type->id, request('job_type', [])) ? 'active' : '' }}">
                                                    <input class="job_type-field" name="job_type[]"
                                                        value="{{ $job_type->id }}" type="checkbox" autocomplete="off"
                                                        {{ in_array($job_type->id, request('job_type', [])) ? 'checked' : '' }}>
                                                    <p class="m-0">
                                                        <i class="fa fa-check fa-lg check-icon" aria-hidden="true"></i>
                                                    </p>
                                                </label>
                                                <label class="mb-0">
                                                    {{ $job_type->name }} ({{ $job_type->jobs_count }})
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="show-more-options" data-toggle="collapse" data-target="#options-job_type">
                                        <i class="fa fa-plus-circle"></i> Show more
                                    </a>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <h5 class="filter-title mb-3">Date Posted</h5>
                                    <div class="btn-group-toggle mb-2" data-toggle="buttons">
                                        <label
                                            class="btn button-theme radio-btn inline-checkbox {{ in_array('past_week', request('date_posted', [])) ? 'active' : '' }}">
                                            <input name="date_posted[]" value="past_week"
                                                {{ in_array('past_week', request('date_posted', [])) ? 'checked' : '' }}
                                                type="checkbox" autocomplete="off">
                                            <p class="m-0">
                                                <i class="fa fa-check fa-lg check-icon" aria-hidden="true"></i>
                                            </p>
                                        </label>
                                        <label class="mb-0">
                                            Past Week
                                            ({{ $jobs->where('created_at', '>=', Carbon\Carbon::now()->subWeek())->count() }})
                                        </label>
                                    </div>
                                    <div class="btn-group-toggle mb-2" data-toggle="buttons">
                                        <label
                                            class="btn button-theme radio-btn inline-checkbox {{ in_array('past_month', request('date_posted', [])) ? 'active' : '' }}">
                                            <input name="date_posted[]" value="past_month"
                                                {{ in_array('past_month', request('date_posted', [])) ? 'checked' : '' }}
                                                type="checkbox" autocomplete="off">
                                            <p class="m-0">
                                                <i class="fa fa-check fa-lg check-icon" aria-hidden="true"></i>
                                            </p>
                                        </label>
                                        <label class="mb-0">
                                            Past Month
                                            ({{ $jobs->where('created_at', '>=', Carbon\Carbon::now()->subMonth())->count() }})
                                        </label>
                                    </div>
                                </div>

                                <button type="submit" class="btn button-theme w-100">
                                    Filter
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-12">
                    @foreach ($jobs as $job)
                        <div class="job-box">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="company-logo">
                                    <img src="{{ empty($job->employer->getFirstMedia('company_logo')) ? asset('/website/img/company-logo.png') : $job->employer->getFirstMedia('company_logo')->getUrl() }}" alt="brand" class="img-fluid">

                                </div>

                                <span class="job-period-type justify-content-start align-items-end"><i class="fa fa-calendar-check-o"></i>
                                    {{ $job->type->name }}
                                </span>
                                <span class="job-period-type"><i class="flaticon-time"></i>
                                    {{ $job->created_at->diffForHumans() }}
                                </span>

                            </div>
                            <div class="description">
                                <div class="float-left">
                                    <h5 class="title"><a
                                            href="{{ route('website.job-details', $job->id) }}">{{ $job->job_title }}</a>
                                    </h5>
                                    <div class="candidate-listing-footer">
                                        <ul>
                                            <li><i class="flaticon-work"></i> {{ optional($job->employer_profile)->company_name??'N/A' }}
                                            </li>
                                            <li><i class="flaticon-pin"></i> {{ empty($job->area) ? null : $job->area->name }},
                                                {{ $job->city->name }}, {{ $job->country->name }}</li>
                                        </ul>
                                        <p class="job-excerpt">
                                            {{ $job->job_excerpt }}
                                        </p>
                                        {{-- <h6>Deadline: <span class="text-success">Jan 31, 2019</span></h6> --}}
                                    </div>
                                </div>
                                <div class="div-right text-right">

                                    @if (Auth::check() && is_job_applied(auth()->user()->id, $job->id))
                                        <button class="btn button-success bg-success text-white disabled">Applied</button>
                                    @endif

                                    <a href="{{ route('website.job-details', $job->id) }}" class="btn button-theme">
                                        Job Details
                                    </a>

                                    @if (Auth::check())
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
                                                                            class="fa fa-linkedin"></i></a>
                                                                        </li>
                                                                 <li><a href="{{ route('website.job-details', $job->id) }}" class="copyLink" ><i
                                                                            class="fa fa-copy"></i></a>
                                                                            <p class="copyMessage" style="display: none;">Link copied!</p>

                                                                        </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach


                    <!-- Page navigation start -->
                    <div class="pagination-box hidden-mb-45 text-center">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                @if ($jobs->onFirstPage())
                                    <li class="page-item disabled"><a class="page-link" href="#">Prev</a></li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $jobs->previousPageUrl() }}">Prev</a></li>
                                @endif

                                @for ($i = 1; $i <= $jobs->lastPage(); $i++)
                                    @php
                                        $url = str_replace(url()->current() . '?', '', $jobs->url($i));
                                    @endphp
                                    <li class="page-item {{ $jobs->currentPage() == $i ? 'active' : '' }}"><a
                                            class="page-link"
                                            href="{{ url()->current() }}?{{ $url }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                @if ($jobs->hasMorePages())
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $jobs->nextPageUrl() }}">Next</a></li>
                                @else
                                    <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                                @endif
                            </ul>
                        </nav>
                    </div>


                </div>

            </div>
        </div>
    </div>
    <!-- Jobs Listing end -->
@endsection

@section('website.page-scripts')
    <script>
        $(document).ready(function() {
            // Set up filter section
            setupFilterSection('.country-field', '.all-countries-field', '#options-country');
            setupFilterSection('.city-field', '.all-cities-field', '#options-city');
            setupFilterSection('.area-field', '.all-areas-field', '#options-area');
            setupFilterSection('.career_level-field', '.all-career_levels-field', '#options-career_level');
            setupFilterSection('.job_category-field', '.all-job_categories-field', '#options-job_category');
            setupFilterSection('.job_type-field', '.all-job_types-field', '#options-job_type');

            $('.clear-filter').on('click', function() {
                clearFilter('input[type="checkbox"]');
                collapseFilterSection('#options-country');
                collapseFilterSection('#options-city');
                collapseFilterSection('#options-area');
                collapseFilterSection('#options-career_level');
                collapseFilterSection('#options-job_category');
                collapseFilterSection('#options-job_type');
            });

        });

        function setupFilterSection(fieldSelector, allFieldSelector, sectionSelector) {
            // Set up "All" checkbox
            setupAllCheckbox(fieldSelector, allFieldSelector);

            // Set up individual checkboxes
            $(fieldSelector).on('change', function() {
                updateAllCheckbox(fieldSelector, allFieldSelector);
            });

            // Show section if any checkboxes are selected
            if (countSelectedCheckboxes(fieldSelector) != 0) {
                $(sectionSelector).collapse('show');
            }
        }

        function clearFilter(fieldSelector) {
            // Clear checkboxes and remove active class
            $('.input-text').val('');
            $(fieldSelector).prop('checked', false);
            $(fieldSelector).parent().removeClass('active');
        }

        function collapseFilterSection(sectionSelector) {
            $(sectionSelector).collapse('hide');
        }

        function setupAllCheckbox(fieldSelector, allFieldSelector) {
            if ($(fieldSelector + ':checked').length == $(fieldSelector).length) {
                $(allFieldSelector).prop('checked', true);
                $(allFieldSelector).parent().addClass('active');
            } else {
                $(allFieldSelector).prop('checked', false);
                $(allFieldSelector).parent().removeClass('active');
            }

            $(allFieldSelector).on('change', function() {
                if ($(this).is(':checked')) {
                    $(fieldSelector).prop('checked', true);
                    $(fieldSelector).parent().addClass('active');
                } else {
                    $(fieldSelector).prop('checked', false);
                    $(fieldSelector).parent().removeClass('active');
                }
            });
        }

        function updateAllCheckbox(fieldSelector, allFieldSelector) {
            if ($(fieldSelector + ':checked').length == $(fieldSelector).length) {
                $(allFieldSelector).prop('checked', true);
                $(allFieldSelector).parent().addClass('active');
            } else {
                $(allFieldSelector).prop('checked', false);
                $(allFieldSelector).parent().removeClass('active');
            }
        }

        function countSelectedCheckboxes(fieldSelector) {
            return $(fieldSelector + ':checked').length;
        }
    </script>
@endsection

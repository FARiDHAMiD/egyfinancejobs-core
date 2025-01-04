@extends('website.app')
@section('website.content')
<!-- create profile section start -->
<div id="multi-step-form-container" class="py">
    <div class="container">

        <ul class="form-stepper form-stepper-horizontal text-center mx-auto pl-0">
            <!-- Step 1 -->
            <li class="form-stepper-active text-center form-stepper-list" step="1">
                <a class="mx-2">
                    <div class="step-label">Step 1/3</div>
                    <span class="form-stepper-circle">
                        <span>1</span>
                    </span>
                    <div class="label">Career Interests</div>
                </a>
            </li>
            <!-- Step 2 -->
            <li class="form-stepper-unfinished text-center form-stepper-list" step="2">
                <a class="mx-2">
                    <div class="step-label">Step 2/3</div>
                    <span class="form-stepper-circle text-muted">
                        <span>2</span>
                    </span>
                    <div class="label text-muted">General Info</div>
                </a>
            </li>
            <!-- Step 3 -->
            <li class="form-stepper-unfinished text-center form-stepper-list" step="3">
                <a class="mx-2">
                    <div class="step-label">Step 3/3</div>
                    <span class="form-stepper-circle text-muted">
                        <span>3</span>
                    </span>
                    <div class="label text-muted">Professional Info</div>
                </a>
            </li>
        </ul>
        <div class="row">
            <div class="col-lg-12">
                <!-- Form content box start -->
                <div class="form-content-box w-100">
                    <div class="details text-left">
                        <!-- Form start -->
                        <form id="userAccountSetupForm" enctype="multipart/form-data" method="post"
                            action="{{ route('employee.profile.store') }}">
                            @csrf
                            <section id="step-1" class="form-step">
                                <div class="section-header">
                                    <h2 class="form-title text-center mb-0">Career Interests</h2>
                                    <p class="text-center mt-0">
                                        Providing this information enables us to recommend better opportunities to
                                        you.
                                    </p>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-12">
                                        <p class="section-subtitle">What is your current career level?
                                            <span>(This is a required field)</span>
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <div class="btn-group-toggle row" data-toggle="buttons">
                                            @foreach ($career_levels as $career_level)
                                            <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-2 px-2">
                                                <label
                                                    class="btn button-theme radio-btn w-100 {{ old('career_level_id') == $career_level->id ? 'active' : '' }}">
                                                    <input {{ old('career_level_id')==$career_level->id ? 'checked' : ''
                                                    }}
                                                    name="career_level_id" value="{{ $career_level->id }}"
                                                    type="radio" autocomplete="off"> {{ $career_level->name }}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-5">
                                    <div class="col-12">
                                        <p class="section-subtitle mb-0">What type(s) of job are you open to?
                                            <span>(This is a required field)</span>
                                        </p>
                                        <p>You can choose more than one Job type</p>
                                    </div>
                                    <div class="col-12">
                                        <div class="btn-group-toggle row" data-toggle="buttons">

                                            @foreach ($job_types as $job_type)
                                            <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-2 px-2">
                                                <label
                                                    class="btn button-theme radio-btn w-100 {{ old('open_job_type_ids') != null ? (in_array($job_type->id, old('open_job_type_ids')) ? 'active' : '') : '' }}">
                                                    <input type="checkbox" name="open_job_type_ids[]"
                                                        value="{{ $job_type->id }}" {{ old('open_job_type_ids') !=null ?
                                                        (in_array($job_type->id, old('open_job_type_ids')) ? 'checked' :
                                                    '') : '' }}
                                                    autocomplete="off">
                                                    <p class="m-0">
                                                        {{ $job_type->name }}
                                                        <i class="fa fa-plus-circle fa-lg plus-icon"
                                                            aria-hidden="true"></i>
                                                        <i class="fa fa-check-circle fa-lg check-icon"
                                                            aria-hidden="true"></i>
                                                    </p>
                                                </label>
                                            </div>
                                            @endforeach




                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-5">
                                    <div class="col-12">
                                        <p class="section-subtitle">What are the job titles that describe what
                                            you are looking for?
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <select class="w-100 input-text" name="job_title_id">
                                                <option value="">Select</option>
                                                @foreach ($job_titles as $job_title)
                                                <option {{ old('job_title_id') !=null ? ( $job_title->id ==
                                                    old('job_title_id') ? 'selected' : '') : '' }}
                                                    value="{{ $job_title->id }}">{{ $job_title->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="row mt-5">
                                    <div class="col-12 mb-4">
                                        <p class="section-subtitle mb-0">What job categories are you interested in?
                                            <span>(Add 1 or more)</span>
                                        </p>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <select class="multiple-select w-100 input-text" data-placeholder="Select"
                                                name="job_category_ids[]" multiple="multiple">
                                                @foreach ($job_categories as $job_category)
                                                <option {{ old('job_category_ids') !=null ? (in_array($job_category->id,
                                                    old('job_category_ids')) ? 'selected' : '') : '' }}
                                                    value="{{ $job_category->id }}">{{ $job_category->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <hr>
                                <div class="row mt-5">
                                    <div class="col-12 mb-4">
                                        <p class="section-subtitle mb-0">
                                            What is the minimum salary you would accept?
                                        </p>
                                        <p>Add a net salary (i.e., final amount you want after taxes and insurance).
                                        </p>

                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <input type="number" name="accepted_salary" class="input-text"
                                                placeholder="EGP/ Month" value="{{ old('accepted_salary') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4 d-flex">
                                        <div class="btn-group-toggle d-inline" data-toggle="buttons">
                                            <label
                                                class="btn button-theme radio-btn inline-checkbox {{ old('show_salary') != null ? 'active' : '' }}">
                                                <input {{ old('show_salary') !=null ? 'checked' : '' }}
                                                    name="show_salary" type="checkbox" autocomplete="off">
                                                <p class="m-0">
                                                    <i class="fa fa-check fa-lg check-icon" aria-hidden="true"></i>
                                                </p>
                                            </label>
                                        </div>
                                        <div>
                                            <p class="section-subtitle mb-0 text-sm"> Show my minimum salary from
                                                campanies</p>
                                            <p class="text-sm">We'll only use your minimum salary to recommend jobs
                                                for you</p>
                                        </div>

                                    </div>
                                </div>

                                <div class="mt-3 d-flex justify-content-between flex-md-row flex-column">
                                    <button class="btn button-theme mb-md-0 mb-3" type="button">Skip & Search
                                        jobs</button>
                                    <button class="btn button-theme btn-navigate-form-step" type="button"
                                        step_number="2">Save & Continue</button>
                                </div>
                            </section>


                            <section id="step-2" class="form-step d-none">
                                <div class="section-header">
                                    <h2 class="form-title text-center mb-0">General Info</h2>
                                    <p class="text-center mt-0">
                                        Tell companies more about yourself.
                                    </p>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-12">
                                        <p class="section-subtitle">Your Personal Info
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <div class="row datedrop-box">
                                            <div class="col-12 form-group mb-0">
                                                <label>Birthdate</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input value="{{ old('birthdate') }}" placeholder="Day" type="date"
                                                        name="birthdate" class="input-text">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="btn-group-toggle d-inline form-group d-flex"
                                                    data-toggle="buttons">
                                                    <div class="mr-4">
                                                        <label
                                                            class="btn button-theme radio-btn inline-radio {{ old('gender') == 'male' ? 'active' : '' }} ">
                                                            <input {{ old('gender')=='male' ? 'checked' : '' }}
                                                                name="gender" value="male" type="radio"
                                                                autocomplete="off">
                                                            <p class="m-0">
                                                                <i class="fa fa-check fa-lg check-icon"
                                                                    aria-hidden="true"></i>
                                                            </p>
                                                        </label>
                                                        <label class="mb-0">Male</label>
                                                    </div>
                                                    <div>
                                                        <label
                                                            class="btn button-theme radio-btn inline-radio {{ old('gender') == 'female' ? 'active' : '' }}">
                                                            <input {{ old('gender')=='female' ? 'checked' : '' }}
                                                                name="gender" value="female" type="radio"
                                                                autocomplete="off">
                                                            <p class="m-0">
                                                                <i class="fa fa-check fa-lg check-icon"
                                                                    aria-hidden="true"></i>
                                                            </p>
                                                        </label>
                                                        <label class="mb-0">Female</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-5">
                                    <div class="col-12 mb-4">
                                        <p class="section-subtitle mb-0">
                                            Your Location
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <select type="text" name="country_id"
                                                        class="input-text country-selection">
                                                        <option selected value="" disabled>Select</option>
                                                        @foreach ($countries as $country)
                                                        <option {{ old('country_id')==$country->id ? 'selected' : '' }}
                                                            value="{{ $country->id }}">{{ $country->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <select type="text" name="city_id"
                                                        class="input-text city-selection">
                                                        <option selected value="" disabled>Select</option>
                                                        @foreach ($cities as $city)
                                                        <option {{ old('city_id')==$city->id ? 'selected' : '' }}
                                                            value="{{ $city->id }}"
                                                            data-country-id="{{ $city->country_id }}">
                                                            {{ $city->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Area</label>
                                                    <select type="text" name="area_id"
                                                        class="input-text area-selection">
                                                        <option selected value="" disabled>Select</option>
                                                        @foreach ($areas as $area)
                                                        <option {{ old('area_id')==$area->id ? 'selected' : '' }}
                                                            value="{{ $area->id }}"
                                                            data-city-id="{{ $area->city_id }}">
                                                            {{ $area->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <div class="row mt-5">
                                    <div class="col-12">
                                        <p class="section-subtitle">Contact Info
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Mobile Number</label>
                                                    <input value="{{ old('phone') }}" type="text" name="phone"
                                                        class="input-text" placeholder="Enter your phone number">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 d-flex justify-content-between flex-md-row flex-column">
                                    <button class="btn button-theme btn-navigate-form-step mb-md-0 mb-3" type="button"
                                        step_number="1">Previous Step</button>
                                    <button class="btn button-theme btn-navigate-form-step" type="button"
                                        step_number="3">Save & Continue</button>
                                </div>
                            </section>

                            <section id="step-3" class="form-step d-none">
                                <div class="section-header">
                                    <h2 class="form-title text-center mb-0">Professional Info</h2>
                                    <p class="text-center mt-0">
                                        Tell companies about your professional experience.
                                    </p>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-12">
                                        <p class="section-subtitle">What is your work experience?
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Job Title</label>
                                                    <input
                                                        value="{{ old('experience') != null ? old('experience')['job_title'] : '' }}"
                                                        type="text" name="experience[job_title]" class="input-text"
                                                        placeholder="Job Title">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Company/organization name</label>
                                                    <input
                                                        value="{{ old('experience') != null ? old('experience')['company_name'] : '' }}"
                                                        type="text" name="experience[company_name]" class="input-text"
                                                        placeholder="Company/organization name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Job category</label>
                                                    <select type="text" name="experience[job_category_id]"
                                                        class="input-text">
                                                        <option selected value="" disabled>Select
                                                        </option>
                                                        @foreach ($job_categories as $job_category)
                                                        <option {{ old('experience') !=null &&
                                                            array_key_exists('job_category_id', old('experience')) ?
                                                            (old('experience')['job_category_id']==$job_category->id ?
                                                            'selected' : '') : '' }}
                                                            value="{{ $job_category->id }}">
                                                            {{ $job_category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Company Industry</label>
                                                    <select type="text" name="experience[company_industry_id]"
                                                        class="input-text">
                                                        <option selected value="" disabled>Select
                                                        </option>
                                                        @foreach ($industries as $industry)
                                                        <option {{ old('experience') !=null &&
                                                            array_key_exists('company_industry_id', old('experience')) ?
                                                            (old('experience')['company_industry_id']==$industry->id ?
                                                            'selected' : '') : '' }}
                                                            value="{{ $industry->id }}">{{ $industry->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group mb-0">
                                                    <label>Experience type</label>
                                                </div>
                                                <div class="btn-group-toggle row" data-toggle="buttons">
                                                    @foreach ($job_types as $job_type)
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-2 px-2">
                                                        <label
                                                            class="btn button-theme radio-btn w-100 {{ old('experience') != null ? (old('experience')['job_type_id'] == $job_type->id ? 'active' : '') : '' }}">
                                                            <input name="experience[job_type_id]" {{ old('experience')
                                                                !=null ?
                                                                (old('experience')['job_type_id']==$job_type->id ?
                                                            'checked' : '') : '' }}
                                                            value="{{ $job_type->id }}" type="radio"
                                                            autocomplete="off" checked> {{ $job_type->name }}
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-6  datedrop-box">
                                                <div class="form-group">
                                                    <label>Starting from</label>
                                                    <div class="form-group">
                                                        <input
                                                            value="{{ old('experience') != null ? old('experience')['starting_from'] : '' }}"
                                                            placeholder="Day" type="date"
                                                            name="experience[starting_from]" class="input-text">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6  datedrop-box">
                                                <div class="form-group">
                                                    <label>Ending in</label>
                                                    <div class="form-group">
                                                        <input
                                                            value="{{ old('experience') != null ? old('experience')['ending_in'] : '' }}"
                                                            placeholder="Day" type="date" name="experience[ending_in]"
                                                            id="ending_in-0" class="input-text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 d-flex">
                                                <div class="btn-group-toggle d-inline" data-toggle="buttons">
                                                    <label
                                                        class="btn button-theme radio-btn inline-checkbox {{ old('experience') != null && array_key_exists('currently_work_there', old('experience')) ? (old('experience')['currently_work_there'] != null ? 'active' : '') : '' }}">
                                                        <input {{ old('experience') !=null &&
                                                            array_key_exists('currently_work_there', old('experience'))
                                                            ? (old('experience')['currently_work_there'] !=null
                                                            ? 'checked' : '' ) : '' }}
                                                            name="experience[currently_work_there]"
                                                            class="currently_work_there" data-id="0" type="checkbox"
                                                            autocomplete="off">
                                                        <p class="m-0">
                                                            <i class="fa fa-check fa-lg check-icon"
                                                                aria-hidden="true"></i>
                                                        </p>
                                                    </label>
                                                </div>
                                                <div>
                                                    <p class="section-subtitle mb-0 mt-1 text-sm"> I currently work
                                                        there</p>
                                                </div>

                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-5">
                                    <div class="col-12">
                                        <p class="section-subtitle">Degree Details
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Degree Details</label>
                                                    <input
                                                        value="{{ old('education') != null ? old('education')['degree_details'] : '' }}"
                                                        type="text" name="education[degree_details]" class="input-text"
                                                        placeholder="e.g., Business, Accounting">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>What is your educational level?</label>
                                                    <p>If you are currently studying, select your expected degree.</p>
                                                    <select type="text" name="education[education_level_id]"
                                                        class="input-text">
                                                        <option selected value="" disabled>
                                                            select
                                                        </option>
                                                        @foreach ($education_levels as $education_level)
                                                        <option {{ old('education') !=null &&
                                                            array_key_exists('education_level_id', old('education')) ?
                                                            (old('education')['education_level_id']==$education_level->
                                                            id ? 'selected' : '') : '' }}
                                                            value="{{ $education_level->id }}">
                                                            {{ $education_level->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>University/Institution</label>
                                                    <select type="text" name="education[university_id]"
                                                        class="input-text">
                                                        <option selected value="" disabled>
                                                            e.g.,Ain Shams University, National Institute of
                                                            Technology, ...
                                                        </option>
                                                        @foreach ($universities as $university)
                                                        <option {{ old('education') !=null &&
                                                            array_key_exists('university_id', old('education')) ?
                                                            (old('education')['university_id']==$university->id ?
                                                            'selected' : '') : '' }}
                                                            value="{{ $university->id }}">
                                                            {{ $university->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="mb-0">When did you get your degree?</label>
                                                    <p>Or when are you expected to get it?</p>
                                                    <div class="form-group datedrop-box">
                                                        <input
                                                            value="{{ old('education') != null ? old('education')['degree_date'] : '' }}"
                                                            type="date" name="education[degree_date]"
                                                            class="input-text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Grade</label>

                                                    <select name="education[grade]" class="input-text">
                                                        <option value="">please selecte your grade</option>
                                                        <option {{ old('education') !=null ?
                                                            (old('education')['grade']=='Fair' ? 'selected' : '' ) : ''
                                                            }} value="Fair">Fair</option>
                                                        <option {{ old('education') !=null ?
                                                            (old('education')['grade']=='Good' ? 'selected' : '' ) : ''
                                                            }} value="Good">Good</option>
                                                        <option {{ old('education') !=null ?
                                                            (old('education')['grade']=='Very Good' ? 'selected' : '' )
                                                            : '' }} value="Very Good">Very Good</option>
                                                        <option {{ old('education') !=null ?
                                                            (old('education')['grade']=='Excellent' ? 'selected' : '' )
                                                            : '' }} value="Excellent">Excellent</option>
                                                        <option {{ old('education') !=null ?
                                                            (old('education')['grade']=='Very good with honors'
                                                            ? 'selected' : '' ) : '' }} value="Very good with honors">
                                                            Very good with honors</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 d-flex justify-content-between flex-md-row flex-column">
                                    <button class="btn button-theme btn-navigate-form-step mb-md-0 mb-3" type="button"
                                        step_number="2">Previous Step</button>
                                    <button class="btn button-theme submit-btn" type="submit">Save</button>
                                </div>
                            </section>
                        </form>
                        <!-- Form end -->
                    </div>
                </div>
                <!-- Form content box end -->
            </div>
        </div>
    </div>
</div>
<!-- create profile section end -->
@endsection
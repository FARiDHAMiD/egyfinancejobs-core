@extends('website.app')
@section('website.content')
<div class="main">
    <div class="container user-settings">

        <div class="row">
            <div class="mb-4 col-md-4">
                @include('website.employee.profile.user-settings-sidebar')
            </div>
            <div class="mb-4 col-md-8">
                <div class="form-content-box w-100 my-0">
                    <div class="details text-left">
                        <!-- Form start -->
                        <form method="post" action="{{route('employee.profile.career-inetrests.update')}}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <p class="section-subtitle">What is your current career level?
                                        <span>(This is a required field)</span>
                                    </p>
                                </div>
                                <div class="col-12">
                                    <div class="btn-group-toggle row" data-toggle="buttons">
                                        @foreach ($career_levels as $career_level)
                                            <div class="col-lg-4 col-md-6 col-12 mb-2 px-2">
                                                <label
                                                    class="btn button-theme radio-btn w-100 {{ $profile->career_level_id  == $career_level->id ? 'active' : '' }}">
                                                    <input
                                                        {{ $profile->career_level_id  == $career_level->id ? 'checked' : '' }}
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
                                            <div class="col-lg-4 col-md-6 col-12 mb-2 px-2">
                                                <label
                                                    class="btn button-theme radio-btn w-100 {{ $open_job_type_ids != null ? (in_array($job_type->id, $open_job_type_ids) ? 'active' : '') : '' }}">
                                                    <input type="checkbox" name="open_job_type_ids[]"
                                                        value="{{ $job_type->id }}"
                                                        {{ $open_job_type_ids != null ? (in_array($job_type->id, $open_job_type_ids) ? 'checked' : '') : '' }}
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
                                <div class="col-12 mb-4">
                                    <p class="section-subtitle mb-0">What are the job titles that describe what
                                        you are looking for?
                                       
                                    </p>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <select class="w-100 input-text" name="job_title_id">
                                            <option value="">Select</option>
                                            @foreach ($job_titles as $job_title)
                                                <option
                                                    {{ $job_title->id  == $profile->job_title_id ? 'selected' : '' }}
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
                                <div class="col-12">
                                    <div class="form-group">
                                        <select class="multiple-select w-100 input-text" data-placeholder="Select"
                                            name="job_category_ids[]" multiple="multiple">
                                            @foreach ($job_categories as $job_category)
                                                <option
                                                    {{ $job_category_ids != null ? (in_array($job_category->id, $job_category_ids) ? 'selected' : '') : '' }}
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
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="number" name="accepted_salary" class="input-text"
                                            placeholder="EGP/ Month" value="{{$profile->accepted_salary}}">
                                    </div>
                                </div>
                                <div class="col-12 mb-4 d-flex">
                                    <div class="btn-group-toggle d-inline" data-toggle="buttons">
                                        <label
                                            class="btn button-theme radio-btn inline-checkbox {{ $profile->show_salary != null ? 'active' : '' }}">
                                            <input {{ $profile->show_salary != null ? 'checked' : '' }}
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
                            <div class="mt-0">
                                <button class="btn button-theme mb-md-0 mb-3" type="submit">Save Changes</button>
                            </div>

                        </form>
                        <!-- Form end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

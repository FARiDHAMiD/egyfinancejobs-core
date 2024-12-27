@extends('admin.app')
@section('admin.content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create New Job</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('jobs.store') }}" method="post">
                @method('post')
                @csrf
                <div class="row">



                    <div class="col-md-6 mb-3">
                        <div>
                            <label class="text-dark"><strong>Employer</strong></label>
                            <select name="employer" class="form-control @error('employer') is-invalid @enderror">
                                <option value="">Select employer</option>
                                @foreach ($employers as $employer)
                                <option value="{{ $employer->id }}" {{ old('employer')==$employer->id ? 'selected' : ''
                                    }}>
                                    {{ $employer->first_name }} {{ $employer->last_name }}
                                    {{ $employer->employer_profile != null ? ' | ' .
                                    $employer->employer_profile->company_name : '' }}
                                </option>
                                @endforeach
                            </select>

                            @error('employer')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div>
                            <label class="text-dark"><strong>Job Title</strong></label>
                            <input type="text" name="job_title"
                                class="form-control @error('job_title') is-invalid @enderror "
                                value="{{ old('job_title') }}">
                            @error('job_title')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="text-dark"><strong>Country</strong></label>
                            <select type="text" name="country"
                                class="form-control country-selection @error('country') is-invalid @enderror ">
                                <option value="">select country</option>
                                @foreach ($countries as $country)
                                <option {{ old('country')==$country->id ? 'selected' : '' }}
                                    value="{{ $country->id }}">{{ $country->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('country')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="text-dark"><strong>City</strong></label>
                            <select type="text" name="city"
                                class="form-control city-selection @error('city') is-invalid @enderror">
                                <option value="">Select City</option>
                                @foreach ($cities as $city)
                                <option {{ old('city')==$city->id ? 'selected' : '' }}
                                    value="{{ $city->id }}" data-country-id="{{ $city->country_id }}">
                                    {{ $city->name }}</option>
                                @endforeach
                            </select>
                            @error('city')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="text-dark"><strong>Area</strong></label>
                            <select type="text" name="area"
                                class="form-control area-selection @error('area') is-invalid @enderror">
                                <option value="">Select Area</option>
                                @foreach ($areas as $area)
                                <option {{ old('area')==$area->id ? 'selected' : '' }}
                                    value="{{ $area->id }}" data-city-id="{{ $area->city_id }}">
                                    {{ $area->name }}</option>
                                @endforeach
                            </select>
                            @error('area')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div>
                            <label class="text-dark"><strong>Job Category</strong></label>
                            <select name="job_category"
                                class="form-control @error('job_category') is-invalid @enderror">
                                <option value="">Select category</option>
                                @foreach ($job_categories as $job_category)
                                <option value="{{ $job_category->id }}" {{ old('job_category')==$job_category->id ?
                                    'selected' : '' }}>
                                    {{ $job_category->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('job_category')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div>
                            <label class="text-dark"><strong>Education Level</strong></label>
                            <select name="education_level"
                                class="form-control @error('education_level') is-invalid @enderror">
                                <option value="">Select educational level</option>
                                @foreach ($education_levels as $level)
                                <option value="{{ $level->id }}" {{ old('education_level')==$level->id ? 'selected' : ''
                                    }}>
                                    {{ $level->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('education_level')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div>
                            <label class="text-dark"><strong>Job Type</strong></label>
                            <select name="type" class="form-control @error('type') is-invalid @enderror">
                                <option value="">Select educational level</option>
                                @foreach ($types as $type)
                                <option value="{{ $type->id }}" {{ old('type')==$type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('type')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div>
                            <label class="text-dark"><strong>Career Level</strong></label>
                            <select name="career_level"
                                class="form-control @error('career_level') is-invalid @enderror">
                                <option value="">Select career level</option>
                                @foreach ($career_levels as $career_level)
                                <option value="{{ $career_level->id }}" {{ old('career_level')==$career_level->id ?
                                    'selected' : '' }}>
                                    {{ $career_level->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('career_level')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div>
                            <label class="text-dark"><strong>Years of experience</strong></label>
                            <input type="text" name="years_experience"
                                class="form-control @error('years_experience') is-invalid @enderror "
                                value="{{ old('years_experience') }}">
                            @error('years_experience')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div>
                            <label class="text-dark"><strong>Salary</strong></label>
                            <input type="number" name="salary"
                                class="form-control @error('salary') is-invalid @enderror " value="{{ old('salary') }}">
                            @error('salary')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div>
                            <label class="text-dark"><strong>Job description</strong></label>
                            <textarea name="job_description"
                                class="form-control @error('job_description') is-invalid @enderror ">{{ old('job_description') }}</textarea>
                            @error('job_description')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div>
                            <label class="text-dark"><strong>Job excerpt</strong></label>
                            <textarea name="job_excerpt"
                                class="form-control @error('job_excerpt') is-invalid @enderror ">{{ old('job_excerpt') }}</textarea>
                            @error('job_excerpt')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div>
                            <label class="text-dark"><strong>Job requirements</strong></label>
                            <textarea name="job_requirements"
                                class="form-control @error('job_requirements') is-invalid @enderror ">{{ old('job_requirements') }}</textarea>
                            @error('job_requirements')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="text-dark"><strong>Job Quetions</strong></label>
                        <div class="repeater-container" repeater-field-name="job_questions">
                            <div class=" repeater-box">
                                <div class="repeater mb-3">
                                    <div class="row m-0">

                                        <div class="col-md-9 col-8 col-12">
                                            <div class="form-group m-sm-0 mb-2">
                                                <input type="text" data-name="question" name="question"
                                                    class="form-control" placeholder="Enter question">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-4 text-end">
                                            <button type="button"
                                                class="btn bg-gradient-success btn-sm m-0 add_new_file"><i
                                                    class="fas fa-plus text-white"></i></button>
                                            <button type="button"
                                                class="btn bg-gradient-danger btn-sm m-0 remove-repeater-row"><i
                                                    class="fas fa-trash text-white"></i></button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div>
                            <label class="text-dark"><strong>Job Skills</strong></label>
                            <select class="multiple-select w-100 input-text @error('job_skills') is-invalid @enderror"
                                data-placeholder="Select" name="job_skills[]" multiple="multiple">
                                @foreach ($skills as $skill)
                                <option {{ old('job_skills') !=null ? (in_array($skill->id, old('job_skills')) ?
                                    'selected' : '') : '' }}
                                    value="{{ $skill->id }}">{{ $skill->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('job_skills')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <div>
                            <label class="text-dark"><strong>External Link " Optional if exists Apply button will
                                    replaced"</strong></label>
                            <input type="url" name="external_url"
                                class="form-control @error('external_url') is-invalid @enderror "
                                value="{{ old('external_url') }}">
                            @error('external_url')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div>
                            <label class="text-dark"><strong>E-Mail " Optional if exists Apply button will
                                    replaced"</strong></label>
                            <input type="email" name="external_email"
                                class="form-control @error('external_email') is-invalid @enderror "
                                value="{{ old('external_email') }}">
                            @error('external_email')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="row mt-4 justify-content-center">
                    <div class="col-md-6 mb-3">
                        <button type="submit" class="btn btn-info  w-100">
                            <i class="fas fa-save"></i> save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
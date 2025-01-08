@extends('admin.app')
@section('admin.content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Job</h6>
                </div>
                <div class="col-6 text-right">
                    @if(!$job->archived)
                    <button type="button" data-toggle="modal" data-target="#archiveModal"
                        class="font-weight-bold btn btn-sm btn-outline-danger">Archive Job</button>
                    @else
                    <button type="button" data-toggle="modal" data-target="#archiveModal"
                        class="font-weight-bold btn btn-sm btn-outline-success">Reactivate Job</button>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('jobs.update', $job->id) }}" method="post">
                @method('put')
                @csrf
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <div>
                            <label class="text-dark"><strong>Employer</strong></label>
                            <select name="employer" class="form-control @error('employer') is-invalid @enderror">
                                <option value="">Select employer</option>
                                @foreach ($employers as $employer)
                                <option value="{{ $employer->id }}" {{ $job->employer_id == $employer->id ? 'selected' :
                                    '' }}>
                                    {{$employer->employer_profile->company_name ?? ''}}
                                </option>
                                @endforeach
                            </select>

                            @error('employer')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div>
                            <label class="text-dark"><strong>Job Title</strong></label>
                            <input type="text" name="job_title"
                                class="form-control @error('job_title') is-invalid @enderror "
                                value="{{ $job->job_title }}">
                            @error('job_title')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <span class="text-muted">Job will appear in latest jobs / on top of job listings page</span>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" {{ old('featured')==1 ||
                                $job->featured ? 'checked'
                            : '' }} name="featured" id="featured">
                            <label class="text-success" for="featured">
                                Is Featured
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="text-dark"><strong>Country</strong></label>
                            <select type="text" name="country"
                                class="form-control country-selection @error('country') is-invalid @enderror ">
                                <option value="">select country</option>
                                @foreach ($countries as $country)
                                <option {{ $job->country_id == $country->id ? 'selected' : '' }}
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
                                <option {{ $job->city_id == $city->id ? 'selected' : '' }}
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
                                <option {{ $job->area_id == $area->id ? 'selected' : '' }}
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
                                <option value="{{ $job_category->id }}" {{ $job->category_id == $job_category->id ?
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
                                <option value="{{ $level->id }}" {{ $job->education_level_id == $level->id ? 'selected'
                                    : '' }}>
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
                                <option value="{{ $type->id }}" {{ $job->type_id == $type->id ? 'selected' : '' }}>
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
                                <option value="{{ $career_level->id }}" {{ $job->career_level_id == $career_level->id ?
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
                    <div class="col-md-2 col-6 mb-3">
                        <div>
                            <label class="text-dark"><strong>Experience from</strong></label>
                            <input type="text" name="years_experience_from"
                                class="form-control @error('years_experience_from') is-invalid @enderror "
                                value="{{ $job->years_experience_from }}">
                            @error('years_experience_from')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div>
                            <label class="text-dark"><strong>Experience to</strong></label>
                            <input type="text" name="years_experience_to"
                                class="form-control @error('years_experience_to') is-invalid @enderror "
                                value="{{ $job->years_experience_to }}">
                            @error('years_experience_to')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div>
                            <label class="text-dark"><strong>Salary From</strong></label>
                            <input type="number" name="salary_from"
                                class="form-control @error('salary_from') is-invalid @enderror "
                                value="{{ $job->salary_from }}">
                            @error('salary_from')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div>
                            <label class="text-dark"><strong>Salary To</strong></label>
                            <input type="number" name="salary_to"
                                class="form-control @error('salary_to') is-invalid @enderror "
                                value="{{ $job->salary_to }}">
                            @error('salary_to')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-0">
                        <label for="currency" class="text-dark"><strong>Currency</strong></label>
                        <select name="currency" class="form-control @error('currency') is-invalid @enderror">
                            @foreach ($currencies as $currency)
                            <option value="{{ $currency->id }}" {{ old('currency')==$currency->id ?
                                'selected' : '' }}>
                                {{ $currency->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div class="form-check mt-4">
                            <input class="form-check-input" type="radio" name="net_gross" id="flexRadioDefault1"
                                value="1" {{ old('net_gross')==0 || $job->net_gross ? 'checked'
                            : '' }}>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Net
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="net_gross" id="flexRadioDefault2"
                                value="1" {{ old('net_gross')==1 || $job->net_gross ? 'checked'
                            : '' }}>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Gross
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div>
                            <label class="text-dark"><strong>Job description</strong></label>
                            <textarea name="job_description"
                                class="form-control @error('job_description') is-invalid @enderror ">{{ $job->job_description }}</textarea>
                            @error('job_description')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div>
                            <label class="text-dark"><strong>Job excerpt</strong></label>
                            <textarea name="job_excerpt"
                                class="form-control @error('job_excerpt') is-invalid @enderror ">{{ $job->job_excerpt }}</textarea>
                            @error('job_excerpt')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div>
                            <label class="text-dark"><strong>Job requirements</strong></label>
                            <textarea name="job_requirements"
                                class="form-control @error('job_requirements') is-invalid @enderror ">{{ $job->job_requirements }}</textarea>
                            @error('job_requirements')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="text-dark"><strong>Job Quetions</strong></label>
                        @foreach ($job_questions as $index => $question)
                        <div class="repeater-container" repeater-field-name="job_questions">
                            <div class=" repeater-box">
                                <div class="repeater mb-3">
                                    <div class="row m-0">

                                        <div class="col-md-9 col-8 col-12">
                                            <div class="form-group m-sm-0 mb-2">
                                                <input type="text" value="{{$question->question}}" data-name="question"
                                                    name="question" class="form-control" placeholder="Enter question">
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
                        @endforeach

                    </div>

                    <div class="col-md-6 mb-3">
                        <div>
                            <label class="text-dark"><strong>Job Skills</strong></label>
                            <select class="multiple-select w-100 input-text @error('job_skills') is-invalid @enderror"
                                data-placeholder="Select" name="job_skills[]" multiple="multiple">
                                @foreach ($skills as $skill)
                                <option {{ $job_skills !=null ? (in_array($skill->id, $job_skills) ? 'selected' : '') :
                                    '' }}
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
                                value="{{ $job->external_url }}">
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
                                value="{{ $job->external_email }}">
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

<!-- Archive / Reactivate Modal -->
<div class="modal fade" id="archiveModal" tabindex="-1" role="dialog" aria-labelledby="archiveModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content d-flex justify-content-center align-items-center">
            <div class="modal-header">
                <h5 class="modal-title" id="archiveModalLabel">
                    <i class="fa fa-exclamation-triangle" style="font-size:48px;color:orange"></i>
                </h5>
            </div>
            @if(!$job->archived)
            <div class="modal-body text-center">
                This job will dissapear from all relevant results <br> (Home/Jobs Page, employees applications or saved
                jobs)
                !
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="{{route('admin.job.archive', $job->id)}}" class="btn btn-danger">Confirm Archiving</a>
            </div>
            @else
            <div class="modal-body text-center">
                By reactivate this job it will appear in all relevant results <br> (Home/Jobs Page, employees
                applications or saved
                jobs)
                !
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="{{route('admin.job.reactivate', $job->id)}}" class="btn btn-success">Reactivate</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
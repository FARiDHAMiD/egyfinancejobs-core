@extends('admin.app')
@section('admin.content')

@if (session()->has('submit_anyway'))
<div class="modal fade" id="alert-message-modal" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center alert alert-{{ session()->get('submit_anyway')['icon'] }}">
                    {{ session()->get('submit_anyway')['message'] }}
                    <a target="_blank" href="{{route('jobs.index')}}" class="btn btn-outline-dark">Check recent
                        jobs!</a>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-primary" id="force_submit" data-dismiss="modal">Submit
                        Anyway</button>
                    <a href="" class="btn btn-danger">Cancel Job</a>
                </div>
                {{ session()->forget('submit_anyway') }}
            </div>
        </div>
    </div>
</div>
@endif
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
                    <div class="col-md-5 mb-3">
                        <div>
                            <label class="text-dark"><strong>Company</strong></label>
                            {{-- <select name="employer" class="form-control @error('employer') is-invalid @enderror">
                                <option value="">Select employer</option>
                                @foreach ($employers as $employer)
                                <option value="{{ $employer->id }}" {{ old('employer')==$employer->id ? 'selected' : ''
                                    }}>
                                    {{ $employer->first_name }} {{ $employer->last_name }}
                                    {{ $employer->employer_profile != null ? ' | ' .
                                    $employer->employer_profile->company_name : '' }}
                                </option>
                                @endforeach
                            </select> --}}
                            <input id="employerInput" list="companyList"
                                class="form-control  @error('employer') is-invalid @enderror"
                                placeholder="Select Company / Employer" autocomplete="off">
                            <datalist id="companyList">
                                @foreach ($employers as $employer)
                                <option data-value="{{$employer->id}}"
                                    value="{{ $employer->employer_profile->company_name }}">
                                    {{ $employer->first_name }} {{ $employer->last_name }}
                                    {{ $employer->employer_profile != null ? ' | ' .
                                    $employer->employer_profile->company_name : '' }}
                                </option>
                                @endforeach
                            </datalist>
                            <input type="hidden" name="employer" id="employerInput-hidden" value="{{old('employer')}}">
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
                                value="{{ old('job_title') }}">
                            @error('job_title')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <span class="text-muted">Job will appear in latest jobs / on top of job listings page</span>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" {{ old('featured')==1 ? 'checked'
                                : '' }} name="featured" id="featured">
                            <label class="text-success" for="featured">
                                Is Featured
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="text-dark"><strong>Country</strong></label>
                            <select type="text" name="country" id="country"
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
                            <select type="text" name="city" id="city"
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
                            <select type="text" name="area" id="area"
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
                            <select name="job_category" id="category"
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
                            <select name="education_level" id="education_level"
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
                            <select name="type" class="form-control @error('type') is-invalid @enderror" id="type">
                                <option value="">Select job type</option>
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
                            <select name="career_level" id="career_level"
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
                    <div class="col-md-2 col-6 mb-3">
                        <div>
                            <label class="text-dark"><strong>Experience from</strong></label>
                            <input type="text" name="years_experience_from"
                                class="form-control @error('years_experience_from') is-invalid @enderror "
                                value="{{ old('years_experience_from') }}">
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
                                value="{{ old('years_experience_to') }}">
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
                                value="{{ old('salary_from') }}">
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
                                value="{{ old('salary_to') }}">
                            @error('salary_to')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-0">
                        <label for="currency" class="text-dark"><strong>Currency</strong></label>
                        <select name="currency" id="currency"
                            class="form-control @error('currency') is-invalid @enderror">
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
                                checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Net
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="net_gross" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Gross
                            </label>
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

                    <div class="col-md-12 col-12 mb-3">
                        <div>
                            <label class="text-dark"><strong>Job Skills</strong></label>
                            <select
                                class="multiple-select form-control input-text @error('job_skills') is-invalid @enderror"
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
    <div id="submitSuccess" style="display: none;" class="alert alert-success alert-dismissible fade show col-sm-8"
        role="alert">Form submitted successfully
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="قريب"></button>
    </div>
    <div id="submitFail" style="display: none;" class="alert alert-warning alert-dismissible fade show col-sm-8"
        role="alert">Form Failed
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="قريب"></button>
    </div>

</div>
@endsection
@section('scripts')

<script>
    // get employer datalist selected value by id
    $("#employerInput").on('input', function () {
        var val = this.value;
        var shownVal = document.getElementById("employerInput").value;
        var value2send = document.querySelector("#companyList option[value='"+shownVal+"']").dataset.value;
        var reult = $("#employerInput-hidden").val(value2send)
        console.log(reult)
    });

    // force store job
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $(document).on('click', '#force_submit', function(e){
            e.preventDefault();
            $.ajax({
            type: "POST",
            url: "{{ route('admin.job.force_submit') }}",
            data: {
                '_token' : "{{ csrf_token() }}",
                'employer_id' : $("#employerInput-hidden").val(), // test employer id
                'job_title' : $("input[name='job_title']").val(),
                'country_id' : $('#country').find(":selected").val(),
                'city_id' : $('#city').find(":selected").val(),
                'area_id' : $('#area').find(":selected").val(),
                'category_id' : $('#category').find(":selected").val(),
                'education_level_id' : $('#education_level').find(":selected").val(),
                'type_id' : $('#type').find(":selected").val(),
                'career_level_id' : $('#career_level').find(":selected").val(),
                'job_description' : $("textarea[name='job_description']").val(),
                'job_excerpt' : $("textarea[name='job_excerpt']").val(),
                'job_requirements' : $("textarea[name='job_requirements']").val(),
                'external_url' : $("input[name='external_url']").val(),
                'external_email' : $("input[name='external_email']").val(),
                'featured' : $('#featured').is(':checked') ? 1 : 0,
                'currency_id' : $('#currency').find(":selected").val(),
                'years_experience_from' : $("input[name='years_experience_from']").val(),
                'years_experience_to' : $("input[name='years_experience_to']").val(),
                'salary_from' : $("input[name='salary_from']").val(),
                'salary_to' : $("input[name='salary_to']").val(),
                'net_gross' : $('#flexRadioDefault1').is(':checked') ? 1 : 0,
            },
            dataType: "",
            success: function (response) {
                window.location.href = "{{ route('jobs.index') }}";
            },
            error: function () { 
                $('#submitFail').show();
            }
        });
    });
</script>

@endsection
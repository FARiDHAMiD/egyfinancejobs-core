<hr>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Job Title</label>
            <input
                value="{{ old('experience') != null ? old('experience')['job_title'] : '' }}"
                type="text" name="experience[job_title][]"
                class="input-text" placeholder="Job Title">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Company/organization name</label>
            <input
                value="{{ old('experience') != null ? old('experience')['company_name'] : '' }}"
                type="text" name="experience[company_name][]"
                class="input-text" placeholder="Company/organization name">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Job category</label>
            <select type="text" name="experience[job_category_id][]"
                class="input-text">
                <option selected value="" disabled>Select
                </option>
                @foreach ($job_categories as $job_category)
                    <option
                        {{ old('experience') != null && array_key_exists('job_category_id', old('experience')) ? (old('experience')['job_category_id'] == $job_category->id ? 'selected' : '') : '' }}
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
            <select type="text" name="experience[company_industry_id][]"
                class="input-text">
                <option selected value="" disabled>Select
                </option>
                @foreach ($industries as $industry)
                    <option
                        {{ old('experience') != null && array_key_exists('company_industry_id', old('experience')) ? (old('experience')['company_industry_id'] == $industry->id ? 'selected' : '') : '' }}
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
                        <input name="experience[job_type_id][]"
                            {{ old('experience') != null ? (old('experience')['job_type_id'] == $job_type->id ? 'checked' : '') : '' }}
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
                    name="experience[starting_from][]" class="input-text">
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6  datedrop-box">
        <div class="form-group">
            <label>Ending in</label>
            <div class="form-group">
                <input
                    value="{{ old('experience') != null ? old('experience')['ending_in'] : '' }}"
                    placeholder="Day" type="date"
                    name="experience[ending_in][]" class="input-text" id="ending_in-0">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 d-flex">
        <div class="btn-group-toggle d-inline" data-toggle="buttons">
            <label
                class="btn button-theme radio-btn inline-checkbox {{ old('experience') != null && array_key_exists('currently_work_there', old('experience')) ? (old('experience')['currently_work_there'] != null ? 'active' : '') : '' }}">
                <input
                    {{ old('experience') != null && array_key_exists('currently_work_there', old('experience')) ? (old('experience')['currently_work_there'] != null ? 'checked' : '') : '' }}
                    name="experience[currently_work_there][]" class="currently_work_there" data-id="0" type="checkbox"
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

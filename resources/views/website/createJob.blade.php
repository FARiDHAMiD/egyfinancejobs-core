@extends('website.app')
@section('website.content')
<div class="job-listing-section main">
    <div class="container">
        <h1 class="h3 mb-3 text-primary text-center">Post Job on Egy Finance Jobs</h1>
        <div class="">
            <form method="POST" action="{{route('job.request.store')}}">
                @method('post')
                @csrf
                <div class="card-header border-box m-1">
                    <h6 class="text-primary text-center">Employer Info</h6>
                </div>
                <div class="card-body">


                    <div class="row">
                        <div class="col-md-6 col-12 my-1">
                            <label>Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="username" value="{{old('username')}}"
                                class="form-control @error('username') is-invalid @enderror ">
                            @error('username')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                        <div class="col-md-6 col-12 my-1">
                            <label>Company <span class="text-danger">*</span></label>
                            <input type="text" name="company" value="{{old('company')}}"
                                class="form-control @error('company') is-invalid @enderror ">
                            @error('company')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                        <div class="col-md-6 col-12 my-1">
                            <label>Email</label>
                            <input type="email" name="email" value="{{old('email')}}"
                                class="form-control @error('email') is-invalid @enderror ">
                            @error('email')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                        <div class="col-md-6 col-12 my-1">
                            <label>Mobile</label>
                            <input type="text" name="mobile" value="{{old('mobile')}}"
                                class="form-control @error('mobile') is-invalid @enderror ">
                            @error('mobile')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>

                        <div class="col-md-12 col-12 my-1">
                            <label>Location <span class="*"></span></label>
                            <input type="text" name="location" placeholder="Detailed Address (Country, City, Area)"
                                value="{{old('location')}}"
                                class="form-control @error('location') is-invalid @enderror ">
                            @error('location')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="card-header border-box m-1">
                    <h6 class="text-primary text-center">Job Details</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-12 my-1">
                            <label>Job Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" value="{{old('title')}}"
                                class="form-control @error('title') is-invalid @enderror ">
                            @error('title')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                        <div class="col-md-4 col-12 my-1">
                            <label>Job Excerpt <span class="text-muted">(short description)</span></label>
                            <input type="text" name="excerpt" value="{{old('excerpt')}}"
                                class="form-control @error('excerpt') is-invalid @enderror ">
                            @error('excerpt')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                        <div class="col-md-4 col-12 my-1">
                            <label>Job Category</label>
                            <select name="category_id" class="form-control">
                                <option value="">--select--</option>
                                @foreach ($cats as $cat)
                                <option value="{{$cat->id}}" {{$cat->id == old('category_id') ? 'selected' : ''}}>
                                    {{$cat->name}}
                                </option>
                                @endforeach
                            </select>
                            @error('cateory_id')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                        <div class="col-md-4 col-12 my-1">
                            <label>Job Type</label>
                            <select name="type_id" class="form-control">
                                <option value="">--select--</option>
                                @foreach ($types as $type)
                                <option value="{{$type->id}}" {{$type->id == old('type_id') ? 'selected' : ''}}>
                                    {{$type->name}}
                                </option>
                                @endforeach
                            </select>
                            @error('type_id')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                        <div class="col-md-4 col-12 my-1">
                            <label>Education Level</label>
                            <select name="education_level_id" class="form-control">
                                <option value="">--select--</option>
                                @foreach ($educations as $education)
                                <option value="{{$education->id}}" {{$education->id == old('education_level_id') ?
                                    'selected' : ''}}>
                                    {{$education->name}}
                                </option>
                                @endforeach
                            </select>
                            @error('education_level_id')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                        <div class="col-md-4 col-12 my-1">
                            <label>Career Level <span class="text-danger">*</span></label>
                            <select name="career_level_id" class="form-control">
                                <option value="">--select--</option>
                                @foreach ($career_levels as $career_level)
                                <option value="{{$career_level->id}}" {{$career_level->id == old('career_level_id') ?
                                    'selected' : ''}}>
                                    {{$career_level->name}}
                                </option>
                                @endforeach
                            </select>
                            @error('career_level_id')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                        <div class="col-md-6 col-12 my-1">
                            <label>Job Description <span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                rows="2">{{old('description')}}</textarea>
                            @error('description')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                        <div class="col-md-6 col-12 my-1">
                            <label>Requirements <span class="text-danger">*</span></label>
                            <textarea name="requirements"
                                class="form-control @error('requirements') is-invalid @enderror"
                                rows="2">{{old('requirements')}}</textarea>
                            @error('requirements')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                        <div class="col-md-3 col-6 my-1">
                            <label>Salary From</label>
                            <input type="number" name="salary_from" value="{{old('salary_from')}}"
                                class="form-control @error('salary_from') is-invalid @enderror">
                            @error('salary_from')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                        <div class="col-md-3 col-6 my-1">
                            <label>Salary To</label>
                            <input type="number" name="salary_to" value="{{old('salary_to')}}"
                                class="form-control @error('salary_to') is-invalid @enderror">
                            @error('salary_to')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                        <div class="col-md-3 col-6 my-1">
                            <label>Experience From</label>
                            <input type="number" name="years_experience_from" value="{{old('years_experience_from')}}"
                                class="form-control @error('years_experience_from') is-invalid @enderror">
                            @error('years_experience_from')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                        <div class="col-md-3 col-6 my-1">
                            <label>Experience To</label>
                            <input type="number" name="years_experience_to" value="{{old('years_experience_to')}}"
                                class="form-control @error('years_experience_to') is-invalid @enderror">
                            @error('years_experience_to')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                        <div class="col-md-12 col-12 my-1">
                            <label>Website Url</label>
                            <input type="text" name="url_link" value="{{old('url_link')}}"
                                class="form-control @error('url_link') is-invalid @enderror ">
                            @error('url_link')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                        <div class="col-md-12 col-12 my-1">
                            <label>Additional Info
                                <span class="text-muted">(External Links - Questions for candidates - etc...)</span>
                            </label>
                            <textarea name="questions" class="form-control @error('questions') is-invalid @enderror"
                                rows="3">{{old('questions')}}</textarea>
                            @error('questions')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="my-2 d-flex justify-content-center">
                    {!!htmlFormSnippet()!!}
                    @error('g-recaptcha-response')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="card-footer text-right">
                    <button class="btn btn-primary" type="submit">Submit Request</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
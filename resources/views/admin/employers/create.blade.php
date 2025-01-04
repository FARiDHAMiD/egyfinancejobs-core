@extends('admin.app')
@section('admin.content')
<div class="container-fluid">
    <form action="{{ route('employers.store') }}" class="mb-5" method="post" enctype="multipart/form-data">
        @method('post')
        @csrf
        {{-- Employer Profile Secion --}}
        {{-- Will be disabled temporary --}}
        {{-- <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Employer Details</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="text-dark"><strong>First Name</strong></label>
                            <input type="text" name="first_name"
                                class="form-control @error('first_name') is-invalid @enderror "
                                value="{{ old('first_name') }}">
                            @error('first_name')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="text-dark"><strong>Last Name</strong></label>
                            <input type="text" name="last_name"
                                class="form-control @error('last_name') is-invalid @enderror "
                                value="{{ old('last_name') }}">
                            @error('last_name')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="text-dark"><strong>Job Title</strong></label>
                            <input type="text" name="job_title"
                                class="form-control @error('job_title') is-invalid @enderror "
                                value="{{ old('job_title') }}">
                            @error('job_title')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="text-dark"><strong>Email</strong></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror "
                                value="{{ old('email') }}">
                            @error('email')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="text-dark"><strong>Mobile Number</strong></label>
                            <input type="text" name="mobile_number"
                                class="form-control @error('mobile_number') is-invalid @enderror "
                                value="{{ old('mobile_number') }}">
                            @error('mobile_number')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="text-dark"><strong>Password</strong></label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror "
                                value="{{ old('password') }}">
                            @error('password')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label class="text-dark"><strong>Password Confirmation</strong></label>
                            <input type="password" name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror "
                                value="{{ old('password_confirmation') }}">
                            @error('password_confirmation')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- Company Details Section --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Company Details</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="text-dark"><strong>Company Name</strong></label>
                            <input type="text" name="company_name"
                                class="form-control @error('company_name') is-invalid @enderror "
                                value="{{ old('company_name') }}">
                            @error('company_name')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="text-dark"><strong>Company Size</strong></label>
                            <select type="text" name="company_size"
                                class="form-control @error('company_size') is-invalid @enderror ">
                                <option value="">select company size</option>
                                <option {{ old('company_size')=='1-10' ? 'selected' : '' }} value="1-10">1-10</option>
                                <option {{ old('company_size')=='11-100' ? 'selected' : '' }} value="11-100">11-100
                                </option>
                                <option {{ old('company_size')=='101-1000' ? 'selected' : '' }} value="101-1000">
                                    101-1000</option>
                                <option {{ old('company_size')=='1000+' ? 'selected' : '' }} value="1000+">1000+
                                </option>
                            </select>
                            @error('company_size')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <span class="text-muted">Will appear in top hiring companies</span>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" {{ old('featured') == 1 ? 'checked' : '' }} name="featured" id="featured">
                            <label class="text-success" for="featured">
                                Is Featured
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="text-dark"><strong>Company Industry</strong></label>
                            <select type="text" name="company_industry"
                                class="form-control @error('company_industry') is-invalid @enderror ">
                                <option value="">select company industry</option>
                                @foreach ($industries as $industry)
                                <option {{ old('company_industry')==$industry->id ? 'selected' : '' }}
                                    value="{{$industry->id}}">{{$industry->name}}</option>
                                @endforeach
                            </select>
                            @error('company_industry')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="text-dark"><strong>Company Description</strong></label>
                            <textarea type="text" name="company_description"
                                class="form-control @error('company_description') is-invalid @enderror ">{{old('company_description')}}</textarea>
                            @error('company_description')
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
                                    value="{{ $city->id }}"
                                    data-country-id="{{ $city->country_id }}">
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
                                    value="{{ $area->id }}"
                                    data-city-id="{{ $area->city_id }}">
                                    {{ $area->name }}</option>
                                @endforeach
                            </select>
                            @error('area')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <hr>
                        <div class="row justify-content-between">
                            <div class="col-auto text-center">
                                <label class="text-dark"><strong>Company Logo</strong></label>
                                <div class="upload-image-box">
                                    <div class="user-image-circle">
                                        <img height="200px" class="image" src="{{ asset('/website/img/avatar.png') }}"
                                            alt="">
                                    </div>
                                    <div class="mt-4">
                                        <label for="company_logo" class="btn btn-info py-2">
                                            Upload Logo
                                        </label>
                                        <input id="company_logo" type="file" name="company_logo"
                                            class="d-none image-input @error('company_logo') is-invalid @enderror">
                                        @error('company_logo')
                                        <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto text-center">
                                <label class="text-dark"><strong>Company banner</strong></label>
                                <div class="upload-image-box">
                                    <div class="user-image-circle">
                                        <img height="200px" class="image"
                                            src="{{ asset('/website/img/banner_img.jpg') }}" alt="">
                                    </div>
                                    <div class="mt-4">
                                        <label for="company_banner" class="btn btn-info py-2">
                                            Upload banner
                                        </label>
                                        <input id="company_banner" type="file" name="company_banner"
                                            class="d-none image-input @error('company_banner') is-invalid @enderror">
                                        @error('company_banner')
                                        <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="row mt-4 justify-content-center">
            <div class="col-md-6">
                <button type="submit" class="btn btn-info  w-100">
                    <i class="fas fa-save"></i> save
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
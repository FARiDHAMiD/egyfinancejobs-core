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
                        <form enctype="multipart/form-data" method="post" action="{{route('employee.profile.general-info.update')}}">
                            @csrf

                            <div class="section-header">
                                <div class="row align-items-center upload-image-box">
                                    <div class="mb-3 col-lg-8 d-flex align-items-center">
                                        <div class="mr-3">
                                            <div class="user-image-circle">
                                                <img class="image" src="{{ empty($employee->getFirstMedia('employee_profile')) ? asset('/website/img/avatar.png') : $employee->getFirstMedia('employee_profile')->getUrl() }}" alt="">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-dark m-0"><strong>Profile Photo</strong></p>
                                            <p class="text-sm text-dark-light m-0">You can upload a .jpg, .png, or
                                                .gif
                                                photo with max size of 5MB.</p>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-lg-4 text-lg-right">
                                        <label for="profile_img" class="btn btn-default py-2">
                                            Upload Your image
                                        </label>
                                        <input id="profile_img" type="file" name="profile_img" class="d-none image-input">
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="row mt-5">
                                <div class="col-12">
                                    <p class="section-subtitle">Your Personal Info
                                    </p>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" name="first_name" class="input-text"
                                                    placeholder="Enter your first name" value="{{$employee->first_name}}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" name="last_name" class="input-text"
                                                    placeholder="Enter your last name" value="{{$employee->last_name}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row datedrop-box">
                                        <div class="col-12 form-group mb-0">
                                            <label>Birthdate</label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input value="{{$profile->birthdate}}" type="date" name="birthdate" class="input-text">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group m-0">
                                                <label>Gender</label>
                                            </div>
                                            <div class="btn-group-toggle d-inline form-group d-flex"
                                                data-toggle="buttons">
                                                <div class="mr-4">
                                                    <label
                                                        class="btn button-theme radio-btn inline-radio {{ $profile->gender == 'male' ? 'active' : '' }} ">
                                                        <input {{ $profile->gender == 'male' ? 'checked' : '' }}
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
                                                        class="btn button-theme radio-btn inline-radio {{ $profile->gender == 'female' ? 'active' : '' }}">
                                                        <input {{ $profile->gender == 'female' ? 'checked' : '' }}
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
                                        <div class="col-12">
                                            <div class="form-group m-0">
                                                <label>Marital Status</label>
                                            </div>
                                            <div class="btn-group-toggle d-inline form-group d-flex"
                                                data-toggle="buttons">

                                                <div class="mr-4">
                                                    <label class="btn button-theme radio-btn inline-radio {{ $profile->marital_status == 'unspecified' ? 'active' : '' }}">
                                                        <input {{ $profile->marital_status == 'unspecified' ? 'active' : '' }} checked name="marital_status" value="unspecified"
                                                            type="radio" autocomplete="off">
                                                        <p class="m-0">
                                                            <i class="fa fa-check fa-lg check-icon"
                                                                aria-hidden="true"></i>
                                                        </p>
                                                    </label>
                                                    <label class="mb-0">Unspecified</label>
                                                </div>
                                                <div class="mr-4">
                                                    <label class="btn button-theme radio-btn inline-radio {{ $profile->marital_status == 'single' ? 'active' : '' }}">
                                                        <input {{ $profile->marital_status == 'single' ? 'active' : '' }} name="marital_status" value="single" type="radio"
                                                            autocomplete="off">
                                                        <p class="m-0">
                                                            <i class="fa fa-check fa-lg check-icon"
                                                                aria-hidden="true"></i>
                                                        </p>
                                                    </label>
                                                    <label class="mb-0">Single</label>
                                                </div>
                                                <div>
                                                    <label class="btn button-theme radio-btn inline-radio {{ $profile->marital_status == 'married' ? 'active' : '' }}">
                                                        <input {{ $profile->marital_status == 'married' ? 'active' : '' }} name="marital_status" value="married" type="radio"
                                                            autocomplete="off">
                                                        <p class="m-0">
                                                            <i class="fa fa-check fa-lg check-icon"
                                                                aria-hidden="true"></i>
                                                        </p>
                                                    </label>
                                                    <label class="mb-0">Married</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group m-0">
                                                <label>Military Status</label>
                                            </div>
                                            <div class="btn-group-toggle d-inline form-group d-flex"
                                                data-toggle="buttons">

                                                <div class="mr-4">
                                                    <label class="btn button-theme radio-btn inline-radio {{ $profile->military_status == 'exempted' ? 'active' : '' }}">
                                                        <input {{ $profile->military_status == 'exempted' ? 'active' : '' }} checked name="military_status" value="exempted"
                                                            type="radio" autocomplete="off">
                                                        <p class="m-0">
                                                            <i class="fa fa-check fa-lg check-icon"
                                                                aria-hidden="true"></i>
                                                        </p>
                                                    </label>
                                                    <label class="mb-0">Exempted</label>
                                                </div>
                                                <div class="mr-4">
                                                    <label class="btn button-theme radio-btn inline-radio {{ $profile->military_status == 'completed' ? 'active' : '' }}">
                                                        <input {{ $profile->military_status == 'completed' ? 'active' : '' }} checked name="military_status" value="completed"
                                                            type="radio" autocomplete="off">
                                                        <p class="m-0">
                                                            <i class="fa fa-check fa-lg check-icon"
                                                                aria-hidden="true"></i>
                                                        </p>
                                                    </label>
                                                    <label class="mb-0">Completed</label>
                                                </div>
                                                <div class="mr-4">
                                                    <label class="btn button-theme radio-btn inline-radio {{ $profile->military_status == 'postponed' ? 'active' : '' }}">
                                                        <input {{ $profile->military_status == 'postponed' ? 'active' : '' }} checked name="military_status" value="postponed"
                                                            type="radio" autocomplete="off">
                                                        <p class="m-0">
                                                            <i class="fa fa-check fa-lg check-icon"
                                                                aria-hidden="true"></i>
                                                        </p>
                                                    </label>
                                                    <label class="mb-0">Postponed</label>
                                                </div>
                                                <div>
                                                    <label class="btn button-theme radio-btn inline-radio {{ $profile->military_status == 'not applicable' ? 'active' : '' }}">
                                                        <input {{ $profile->military_status == 'not applicable' ? 'active' : '' }} name="military_status" value="not applicable" type="radio"
                                                            autocomplete="off">
                                                        <p class="m-0">
                                                            <i class="fa fa-check fa-lg check-icon"
                                                                aria-hidden="true"></i>
                                                        </p>
                                                    </label>
                                                    <label class="mb-0">Not applicable</label>
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
                                                    class="country-selection form-control">
                                                    <option selected value="" disabled>Select</option>
                                                    @foreach ($countries as $country)
                                                        <option
                                                            {{ $profile->country_id == $country->id ? 'selected' : '' }}
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
                                                    class="form-control city-selection">
                                                    <option selected value="" disabled>Select</option>
                                                    @foreach ($cities as $city)
                                                        <option {{ $profile->city_id  == $city->id ? 'selected' : '' }}
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
                                                    class="form-control area-selection">
                                                    <option selected value="" disabled>Select</option>
                                                    @foreach ($areas as $area)
                                                        <option {{ $profile->area_id  == $area->id ? 'selected' : '' }}
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
                                        <span>(Hint: Companies will be contacting you on
                                            this number)</span>
                                    </p>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Mobile Number</label>
                                                <input type="text" name="phone" class="input-text"
                                                    placeholder="Enter your phone number" value="{{$profile->phone}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="section-subtitle">Email</label>
                                                <input type="email" name="email" class="input-text"
                                                    placeholder="Enter your email" value="{{$employee->email}}">
                                            </div>
                                        </div>
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

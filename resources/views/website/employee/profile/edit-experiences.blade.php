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
                        <div>
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <p class="section-subtitle mb-0">
                                        What is your work experience?
                                    </p>
                                </div>
                                <div class="col-12">

                                    @foreach ($experiences as $experience)
                                        <div class="work-experience-box">
                                            <div class="description">
                                                <h5 class="title">{{$experience->job_title}} <span>{{$experience->job_type->name}}</span></h5>
                                                <p>{{$experience->company_name}} - {{$experience->industry->name}}</p>
                                                <p>{{date('F Y', strtotime($experience->starting_from))}} - {{$experience->ending_in == null ? "Present" : date('F Y', strtotime($experience->ending_in))}}</p>
                                                <p class="text-primary">{{experience_calc($experience->starting_from, $experience->ending_in)}}</p>
                                            </div>
                                            <form method="post" action="{{route('employee.profile.experiences.destroy', $experience->id)}}" class="d-inline">
                                                @csrf
                                                <button onclick="return confirm('Are you sure you want to delete?')"  class="delete-btn"><i class="fa fa-trash"></i></button>
                                            </form>
                                            <button data-toggle="modal" data-target="#edit-experience-{{$experience->id}}" type="button" class="edit-btn"><i class="fa fa-pencil-square-o"></i></button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="edit-experience-{{$experience->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <button type="button" class="close modal-close-btn" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <div class="modal-body text-left py-5">
                                                            <form method="post" action="{{route('employee.profile.experiences.update', $experience->id)}}">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label>Job Title</label>
                                                                    <input
                                                                        value="{{$experience->job_title}}"
                                                                        type="text" name="job_title"
                                                                        class="input-text" placeholder="Job Title">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Company/organization name</label>
                                                                    <input
                                                                        value="{{$experience->company_name}}"
                                                                        type="text" name="company_name"
                                                                        class="input-text" placeholder="Company/organization name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Job category</label>
                                                                    <select type="text" name="job_category_id"
                                                                        class="input-text">
                                                                        <option selected value="" disabled>Select</option>
                                                                        @foreach ($job_categories as $job_category)
                                                                            <option {{ $experience->job_category_id == $job_category->id ? 'selected'  : '' }} value="{{ $job_category->id }}"> {{ $job_category->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Company Industry</label>
                                                                    <select type="text" name="company_industry_id"
                                                                        class="input-text">
                                                                        <option selected value="" disabled>Select</option>
                                                                        @foreach ($industries as $industry)
                                                                            <option {{ $experience->company_industry_id == $industry->id ? 'selected'  : '' }}  value="{{ $industry->id }}">{{ $industry->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group mb-0">
                                                                            <label>Experience type</label>
                                                                        </div>
                                                                        <div class="btn-group-toggle row" data-toggle="buttons">
                                                                            @foreach ($job_types as $job_type)
                                                                                <div class="col-lg-4 col-sm-6 col-12 mb-2 px-2">
                                                                                    <label
                                                                                        class="btn button-theme radio-btn w-100 {{ $experience->job_type_id  == $job_type->id ? 'active' : '' }}">
                                                                                        <input name="job_type_id" {{ $experience->job_type_id  == $job_type->id ? 'checked' : '' }} value="{{ $job_type->id }}" type="radio" autocomplete="off" checked> {{ $job_type->name }}
                                                                                    </label>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6  datedrop-box">
                                                                        <div class="form-group">
                                                                            <label>Starting from</label>
                                                                            <div class="form-group">
                                                                                <input value="{{ $experience->starting_from }}" placeholder="Day" type="date" name="starting_from" class="input-text">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6  datedrop-box">
                                                                        <div class="form-group">
                                                                            <label>Ending in</label>
                                                                            <div class="form-group" >
                                                                                <input @if($experience->currently_work_there != null) style="display:none" @endif value="{{ $experience->ending_in }}" placeholder="Day" type="date" name="ending_in" id="ending_in-{{$experience->id}}" class="input-text">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6 d-flex">
                                                                        <div class="btn-group-toggle d-inline" data-toggle="buttons">
                                                                            <label
                                                                                class="btn button-theme radio-btn inline-checkbox {{ $experience->currently_work_there != null ? 'active' : '' }}">
                                                                                <input  {{ $experience->currently_work_there != null ? 'checked' : '' }} name="currently_work_there" data-id="{{$experience->id}}" class="currently_work_there" type="checkbox" autocomplete="off">
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

                                                                <button type="submit" class="btn button-theme w-100 mt-4">
                                                                    save
                                                                </button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach


                                </div>
                            </div>
                            <div class="mt-0">
                                <button data-toggle="modal" data-target="#work-experience" class="btn button-theme bg-transparent mb-md-0 mb-3" type="button">Add
                                    Experience / Activity</button>
                            </div>

                            <div class="modal fade" id="work-experience" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <button type="button" class="close modal-close-btn" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>

                                        <form class="modal-body p-4" method="post" action="{{route('employee.profile.experiences.store')}}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <p class="section-subtitle">What is your work experience?
                                                    </p>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Job Title</label>
                                                                <input
                                                                    value="{{ old('job_title') }}"
                                                                    type="text" name="job_title"
                                                                    class="input-text" placeholder="Job Title">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Company/organization name</label>
                                                                <input
                                                                    value="{{ old('company_name') }}"
                                                                    type="text" name="company_name"
                                                                    class="input-text" placeholder="Company/organization name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Job category</label>
                                                                <select type="text" name="job_category_id"
                                                                    class="input-text">
                                                                    <option selected value="" disabled>Select
                                                                    </option>
                                                                    @foreach ($job_categories as $job_category)
                                                                        <option
                                                                            {{ old('job_category_id') == $job_category->id ? 'selected' : '' }}
                                                                            value="{{ $job_category->id }}">
                                                                            {{ $job_category->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Company Industry</label>
                                                                <select type="text" name="company_industry_id"
                                                                    class="input-text">
                                                                    <option selected value="" disabled>Select
                                                                    </option>
                                                                    @foreach ($industries as $industry)
                                                                        <option
                                                                            {{ old('company_industry_id') == $industry->id ? 'selected' : '' }}
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
                                                                    <div class="col-lg-4 col-md-6 col-12 mb-2 px-2">
                                                                        <label
                                                                            class="btn button-theme radio-btn w-100 {{ old('job_type_id') == $job_type->id ? 'active' : '' }}">
                                                                            <input name="job_type_id"
                                                                                {{ old('job_type_id') == $job_type->id ? 'checked' : '' }}
                                                                                value="{{ $job_type->id }}" type="radio"
                                                                                autocomplete="off"> {{ $job_type->name }}
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6  datedrop-box">
                                                            <div class="form-group">
                                                                <label>Starting from</label>
                                                                <div class="form-group">
                                                                    <input
                                                                        value="{{ old('starting_from') }}"
                                                                        placeholder="Day" type="date"
                                                                        name="starting_from" class="input-text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6  datedrop-box">
                                                            <div class="form-group">
                                                                <label>Ending in</label>
                                                                <div class="form-group">
                                                                    <input
                                                                        value="{{ old('ending_in') }}"
                                                                        placeholder="Day" type="date"
                                                                        name="ending_in" class="input-text" id="ending_in-0" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 d-flex">
                                                            <div class="btn-group-toggle d-inline" data-toggle="buttons">
                                                                <label class="btn button-theme radio-btn inline-checkbox {{ old('currently_work_there') != null ? 'active' : '' }}">
                                                                    <input {{old('currently_work_there') != null ? 'checked' : ''}} name="currently_work_there" class="currently_work_there" data-id="0" type="checkbox" autocomplete="off">
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
                                            <div class="mt-4">
                                                <button class="btn button-theme mb-md-0 mb-3 w-100" type="submit" fdprocessedid="1gmn7a">Save</button>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- Form end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

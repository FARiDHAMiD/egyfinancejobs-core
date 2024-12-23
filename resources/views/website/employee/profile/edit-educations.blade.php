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
                        <div class="row mt-2">
                            <div class="col-12 mb-3">
                                <p class="section-subtitle mb-0">University Degrees
                                </p>
                            </div>
                            <div class="col-12 mb-3">
                                @foreach ($educations as $education)
                                    <div class="work-experience-box">
                                        <div class="description">
                                            <h5 class="title">{{$education->degree_details}} | <span class="text-info">{{$education->education_level->name}}</span> </h5>
                                            <p>{{$education->university->name}}</p>
                                            <p> Grade: <span class="text-info">{{$education->grade}}</span></p>
                                            <p>{{$education->degree_date}}</p>
                                            @if($education->getFirstMedia('education_certificate'))
                                            <p>Certificate: <a href="{{$education->getFirstMedia('education_certificate')->getUrl()}}" download="" style="  font-size: 30px;" > <i class="fa fa-download"></i>  </a></p>
                                            @endif
                                        </div>
                                        <form method="post" action="{{route('employee.profile.educations.destroy', $education->id)}}" class="d-inline">
                                            @csrf
                                            <button onclick="return confirm('Are you sure you want to delete?')"  class="delete-btn"><i class="fa fa-trash"></i></button>
                                        </form>
                                        <button data-toggle="modal" data-target="#edit-education-{{$education->id}}" type="button" class="edit-btn"><i class="fa fa-pencil-square-o"></i></button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="edit-education-{{$education->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <button type="button" class="close modal-close-btn" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <div class="modal-body text-left py-5">
                                                        <form method="post" action="{{route('employee.profile.educations.update', $education->id)}}" enctype="multipart/form-data" >
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <p class="section-subtitle">Degree Details
                                                                    </p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label>Degree Details</label>
                                                                                <input
                                                                                    value="{{ $education->degree_details }}"
                                                                                    type="text" name="degree_details"
                                                                                    class="input-text" placeholder="e.g., Business, Accounting">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label>What is your educational level?</label>
                                                                                <p>If you are currently studying, select your expected degree.</p>
                                                                                <select type="text" name="education_level_id"
                                                                                    class="input-text">
                                                                                    <option selected value="" disabled>
                                                                                        select
                                                                                    </option>
                                                                                    @foreach ($education_levels as $education_level)
                                                                                        <option
                                                                                            {{ $education->education_level_id  == $education_level->id ? 'selected' : '' }}
                                                                                            value="{{ $education_level->id }}">
                                                                                            {{ $education_level->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label>University/Institution</label>
                                                                                <select type="text" name="university_id"
                                                                                    class="input-text">
                                                                                       <option selected value="" disabled>
                                                                                        e.g.,Ain Shams University, National Institute of
                                                                                        Technology, ...
                                                                                    </option>
                                                                                    @foreach ($universities as $university)
                                                                                        <option
                                                                                            {{ $education->university_id == $university->id ? 'selected' : '' }}
                                                                                            value="{{ $university->id }}">
                                                                                            {{ $university->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label class="mb-0">When did you get your degree?</label>
                                                                                <p>Or when are you expected to get it?</p>
                                                                                <div class="form-group datedrop-box">
                                                                                    <input
                                                                                        value="{{ $education->degree_date }}"
                                                                                        type="date" name="degree_date"
                                                                                        class="input-text">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label>Grade</label>
                                                                                <select name="grade" class="input-text">
                                                                                    <option value="">please selecte your grade</option>
                                                                                    <option {{ $education->grade == 'Fair' ? 'selected' : '' }} value="Fair">Fair</option>
                                                                                    <option {{ $education->grade == 'Good' ? 'selected' : '' }} value="Good">Good</option>
                                                                                    <option {{ $education->grade == 'Very Good' ? 'selected' : '' }} value="Very Good">Very Good</option>
                                                                                    <option {{ $education->grade == 'Excellent' ? 'selected' : '' }} value="Excellent">Excellent</option>
                                                                                    <option {{ $education->grade == 'Very good with honors' ? 'selected' : '' }} value="Very good with honors">Very good with honors</option>
                                                                                </select>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Certificate Title</label>

                                                                            <input type="text" class="input-text" value="{{old('certificate_title',$education->certificate_title)}}" name="certificate_title">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="@if($education->getFirstMedia('education_certificate')) col-10 @else col-12 @endif">
                                                                    <div class="form-group">
                                                                        <label>Upload Certificate</label>

                                                                            <input type="file" class="input-text" name="certificate_image">
                                                                    </div>
                                                                </div>
                                                                @if($education->getFirstMedia('education_certificate'))
                                                                    <div class="col-2">
                                                                        <a style="margin-top: 33px;" href="{{$education->getFirstMedia('education_certificate')->getUrl()}}" class="btn btn-info" download=""><i class="fa fa-download"></i></a>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="mt-4">
                                                                <button class="btn button-theme mb-md-0 mb-3 w-100" type="submit">Save</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach


                                <button data-toggle="modal" data-target="#add-degree" class="btn button-theme bg-transparent mb-md-0 mb-3" type="button">Add Degree</button>
                            </div>






                            <div class="modal fade" id="add-degree" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <button type="button" class="close modal-close-btn" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>


                                        <form class="modal-body p-4" method="post" action="{{route('employee.profile.educations.store')}}" enctype="multipart/form-data" >
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <p class="section-subtitle">Degree Details
                                                    </p>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Degree Details</label>
                                                                <input
                                                                    value="{{ old('degree_details') }}"
                                                                    type="text" name="degree_details"
                                                                    class="input-text" placeholder="e.g., Business, Accounting">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>What is your educational level?</label>
                                                                <p>If you are currently studying, select your expected degree.</p>
                                                                <select type="text" name="education_level_id"
                                                                    class="input-text">
                                                                    <option selected value="" disabled>
                                                                        select
                                                                    </option>
                                                                    @foreach ($education_levels as $education_level)
                                                                        <option
                                                                            {{ old('education_level_id') == $education_level->id ? 'selected' : '' }}
                                                                            value="{{ $education_level->id }}">
                                                                            {{ $education_level->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>University/Institution</label>
                                                                <select type="text" name="university_id"
                                                                    class="input-text">
                                                                    <option selected value="" disabled>
                                                                        e.g.,Ain Shams University, National Institute of
                                                                        Technology, ...
                                                                    </option>
                                                                    @foreach ($universities as $university)
                                                                        <option
                                                                            {{ old('university_id') == $university->id ? 'selected' : '' }}
                                                                            value="{{ $university->id }}">
                                                                            {{ $university->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="mb-0">When did you get your degree?</label>
                                                                <p>Or when are you expected to get it?</p>
                                                                <div class="form-group datedrop-box">
                                                                    <input
                                                                        value="{{ old('degree_date') }}"
                                                                        type="date" name="degree_date"
                                                                        class="input-text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Grade</label>
                                                                <select name="grade" class="input-text">
                                                                    <option value="">please selecte your grade</option>
                                                                    <option {{ old('grade') == 'Fair' ? 'selected' : '' }} value="Fair">Fair</option>
                                                                    <option {{ old('grade') == 'Good' ? 'selected' : '' }} value="Good">Good</option>
                                                                    <option {{ old('grade') == 'Very Good' ? 'selected' : '' }} value="Very Good">Very Good</option>
                                                                    <option {{ old('grade') == 'Excellent' ? 'selected' : '' }} value="Excellent">Excellent</option>
                                                                    <option {{ old('grade') == 'Very good with honors' ? 'selected' : '' }} value="Very good with honors">Very good with honors</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Certificate Title</label>

                                                                <input type="text" class="input-text" value="{{old('certificate_title')}}" name="certificate_title">
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Upload Certificate</label>

                                                                    <input type="file" class="input-text" name="certificate_image">
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>


                                            </div>

                                            <div class="mt-4">
                                                <button class="btn button-theme mb-md-0 mb-3 w-100" type="submit">add</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

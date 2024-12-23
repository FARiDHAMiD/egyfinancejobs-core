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
                        <form enctype="multipart/form-data" method="post" action="{{route('employee.profile.cv.update')}}">
                            @csrf
                            <div class="row">
                                <div class="col-12 text-center">
                                    <input id="cv" type="file" name="cv" class="button-theme bg-transparent mb-4"> <br>

                                    <p class="section-subtitle mb-0">
                                        Drag and drop files here or click here to browse a file to upload
                                    </p>
                                    <p>Supported files: .docx, .doc or .pdf, with maximum size of 5MB</p>
                                    <div class="mt-2">
                                        <label for="cv" class="btn button-theme bg-transparent mb-md-0 mb-3">
                                            Upload Your CV
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5">
                                <button class="btn button-theme mb-md-0 mb-3 w-100" type="submitt">Save</button>
                            </div>

                        </form>
                        <!-- Form end -->

                        @if ($employee->getFirstMedia('employee_cv'))
                            <hr>
                            <h3>
                                Current CV
                                <a class="btn button-theme px-1 py-0" target="_blank" href="{{$employee->getFirstMedia('employee_cv')->getUrl()}}"><i class="fa fa-eye"></i></a>
                                <label for="cv" class="btn button-theme px-1 py-0 mb-0"> <i class="fa fa-pencil-square-o"></i> </label>
                                <form method="post" action="{{route('employee.profile.cv.destroy', $employee->getFirstMedia('employee_cv')->id)}}" class="d-inline">
                                    @csrf
                                    <button onclick="return confirm('Are you sure you want to delete?')"  class="btn button-theme px-1 py-0 mb-0 bg-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </h3>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('website.app')
@section('website.content')
<style>
    h2 {
        margin: 50px 0;
    }



    .file-drop-area {
        position: relative;
        display: flex;
        align-items: center;
        width: 450px;
        max-width: 100%;
        padding: 25px;
        border: 1px dashed rgba(255, 255, 255, 0.4);
        border-radius: 3px;
        transition: 0.2s;

    }

    .choose-file-button {
        flex-shrink: 0;
        background-color: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 3px;
        padding: 8px 15px;
        margin-right: 10px;
        font-size: 12px;
        text-transform: uppercase;
    }

    .file-message {
        font-size: small;
        font-weight: 300;
        line-height: 1.4;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .file-input {
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        cursor: pointer;
        opacity: 0;

    }

    .mt-100 {
        margin-top: 100px;
    }
</style>
<div class="main">
    <div class="container user-settings">

        <div class="row">
            <div class="mb-4 col-md-4">
                @include('website.employee.profile.user-settings-sidebar')
            </div>
            <div class="mb-4 col-md-8">
                <div class="form-content-box w-100 my-0">
                    <div class="details">

                        <!-- Form start -->
                        <form enctype="multipart/form-data" method="post"
                            action="{{route('employee.profile.cv.update')}}">
                            @csrf

                            <div class="container d-flex justify-content-center mt-100 my-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="my-0 text-center">Upload Your Resume / CV</h2>
                                        <p>Supported files: .docx, .doc or .pdf, with maximum size of 5MB</p>
                                        <span class="file-drop-area button-theme bg-transparent mb-4">
                                            <span class="choose-file-button">Choose files</span>
                                            <span class="file-message">Or Drag and drop</span>
                                            <span class="m-2">
                                                <h4> <i class="text-lg fa fa-upload"></i></h4>
                                            </span>
                                            <input class="file-input" id="cv" type="file" name="cv"
                                                class="button-theme bg-transparent mb-4" multiple>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <button class="btn button-theme mb-md-0 mb-3 w-100" type="submitt">Submit</button>
                            </div>

                        </form>
                        <!-- Form end -->

                        @if ($employee->getFirstMedia('employee_cv'))
                        <hr>
                        <h3>
                            Current CV
                            <a class="btn button-theme px-1 py-0" target="_blank"
                                href="{{$employee->getFirstMedia('employee_cv')->getUrl()}}"><i
                                    class="fa fa-eye"></i></a>
                            <label for="cv" class="btn button-theme px-1 py-0 mb-0"> <i
                                    class="fa fa-pencil-square-o"></i> </label>
                            <form method="post"
                                action="{{route('employee.profile.cv.destroy', $employee->getFirstMedia('employee_cv')->id)}}"
                                class="d-inline">
                                @csrf
                                <button onclick="return confirm('Are you sure you want to delete?')"
                                    class="btn button-theme px-1 py-0 mb-0 bg-danger"><i
                                        class="fa fa-trash"></i></button>
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
@section('scripts')
{{-- Upload cv script --}}
<script type="text/javascript">
    console.log();    
    $(document).on('change', '.file-input', function() {
        
        var filesCount = $(this)[0].files.length;
        var textbox = $(this).prev();
      
        if (filesCount === 1) {
          var fileName = $(this).val().split('\\').pop();
          textbox.text(fileName);
        } else {
          textbox.text(filesCount + ' files selected');
        }
      });
</script>
@endsection
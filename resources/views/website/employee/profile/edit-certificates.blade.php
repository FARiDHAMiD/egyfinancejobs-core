@extends('website.app')
@section('css_c')
    <link rel="stylesheet" href="{{ url('website/newStyle.css') }}">
@endsection
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
                            <form method="post" action="{{ route('employee.profile.certificates.update') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <p class="section-subtitle  text-center">
                                    Browse and upload a file.
                                </p>
                                @foreach ($employee->getMedia('employee_certificates') as $item)
                                    <div class="up-files mt-4">
                                        <div class="file-input mb-3"
                                            style="display: flex; justify-content: space-between; border:1px solid #17479e; border-radius: 5px; padding:3px;">
                                            <div class="custom-file">
                                                <a href="{{ $item->getFullUrl() }}" target="_blank"
                                                    rel="noopener noreferrer">{{ $item->file_name }}</a>
                                            </div>
                                            <a href="{{ route('employee.profile.certificates.delete', $item->id) }}"
                                                class="btn btn-danger">Clear</a>
                                        </div>
                                    </div>
                                @endforeach

                                <h6 class="text-green text-center">You can add up to six files one by one.</h6>
                                <div id="file-input-container" class="up-files mt-4">
                                    <div class="file-input mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile0"
                                                name="certificates[]">
                                            <label class="custom-file-label" for="customFile0">Choose file</label>
                                        </div>
                                        <button type="button" class="btn btn-danger clear-btn">Clear</button>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <button class="btn button-theme mb-md-0 mb-3 w-100" type="submitt">Save</button>
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
@section('website.page-scripts')
    <script>
        $(document).ready(function() {
            let fileInputCount = 1; // Unique ID counter
            const maxInputs = 6;

            function updateFileInputLabel(input) {
                const label = $(input).siblings('.custom-file-label');

                if (input.files.length > 0) {
                    const fileName = input.files[0].name;
                    label.text(fileName);
                    $(input).closest('.file-input').addClass('file-uploaded has-value');
                } else {
                    label.text('Choose file');
                    $(input).closest('.file-input').removeClass('file-uploaded has-value');
                }
            }

            function addNewInput(container) {
                const newInputHtml = `
            <div class="file-input mb-3">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile${fileInputCount}" name="certificates[${fileInputCount}]">
                    <label class="custom-file-label" for="customFile${fileInputCount}">Choose file</label>
                </div>
                <button type="button" class="btn btn-danger clear-btn">Clear</button>
            </div>
        `;
                container.append(newInputHtml);
                fileInputCount++;
            }

            $(document).on('change', '.custom-file-input', function() {
                updateFileInputLabel(this);

                const container = $('#file-input-container');
                const inputs = container.find('.file-input');
                const emptyInputs = inputs.filter(function() {
                    return $(this).find('.custom-file-input').val() === '';
                });

                if (emptyInputs.length === 0 && inputs.length < maxInputs) {
                    addNewInput(container);
                }
            });

            $(document).on('click', '.clear-btn', function() {
                const container = $('#file-input-container');
                const inputs = container.find('.file-input');
                const clickedInput = $(this).closest('.file-input');
                const emptyInputs = inputs.filter(function() {
                    return $(this).find('.custom-file-input').val() === '';
                });

                if (inputs.length > 1 && emptyInputs.length > 0 && !clickedInput.is(inputs.last())) {
                    clickedInput.remove();
                } else {
                    const fileInput = $(this).siblings('.custom-file').find('input[type="file"]');
                    fileInput.val('');
                    updateFileInputLabel(fileInput[0]);
                }
            });
        });
    </script>
@endsection

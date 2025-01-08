@extends('admin.app')
@section('admin.content')
<div class="container-fluid">
    <form enctype="multipart/form-data" action="{{ route('AboutUsUpdate') }}" class="mb-5" method="post">
        @method('post')
        @csrf
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="text-dark"><strong>Facebook</strong></label>
                            <input type="text" name="facebook"
                                class="form-control @error('facebook') is-invalid @enderror "
                                value="{{ $aboutSection->facebook }}">
                            @error('facebook')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="text-dark"><strong>telegram</strong></label>
                            <input type="text" name="telegram"
                                class="form-control @error('telegram') is-invalid @enderror "
                                value="{{ $aboutSection->telegram }}">
                            @error('telegram')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="text-dark"><strong>linkedin</strong></label>
                            <input type="text" name="linkedin" value="{{$aboutSection['linkedin']}}"
                                class="form-control @error('linkedin') is-invalid @enderror "
                                value="{{ $aboutSection->linkedid }}">
                            @error('linkedin')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="text-dark"><strong>phone</strong></label>
                            <input type="text" name="phone" value="{{$aboutSection['phone']}}"
                                class="form-control @error('phone') is-invalid @enderror ">
                            @error('phone')
                            <span role=" alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="text-dark"><strong>About Company</strong></label>
                            <textarea class="form-control @error('about_company') is-invalid @enderror " rows="10"
                                cols="5" name="about_company">{{$aboutSection['about_company']}}</textarea>

                            @error('about_company')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
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
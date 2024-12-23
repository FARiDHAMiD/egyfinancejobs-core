@extends('admin.app')
@section('admin.content')
    <div class="container-fluid">
        <form enctype="multipart/form-data" action="{{ route('admins.update', $user->id) }}" class="mb-5" method="post">
            @method('put')
            @csrf
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">User Details</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-dark"><strong>First Name</strong></label>
                                <input type="text" name="first_name"
                                    class="form-control @error('first_name') is-invalid @enderror "
                                    value="{{ $user->first_name }}">
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
                                    value="{{ $user->last_name }}">
                                @error('last_name')
                                    <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-dark"><strong>Email</strong></label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror "
                                    value="{{ $user->email }}">
                                @error('email')
                                    <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">File</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">  
                            <hr>  
                            <div class="row justify-content-between">
                                <div class="col-auto text-center">
                                    <label class="text-dark"><strong>User Logo</strong></label>
                                    <div class="upload-image-box">
                                        <div class="user-image-circle">
                                            <img height="200px" class="image" src="{{ empty($user->getFirstMedia('profile_img')) ? asset('/website/img/avatar.png') : $user->getFirstMedia('profile_img')->getUrl() }}" alt="">
                                        </div>
                                        <div class="mt-4">
                                            <label for="profile_img" class="btn btn-info py-2">
                                                Upload Logo
                                            </label>
                                            <input id="profile_img" type="file" name="profile_img" class="d-none image-input @error('profile_img') is-invalid @enderror">
                                            @error('profile_img')
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

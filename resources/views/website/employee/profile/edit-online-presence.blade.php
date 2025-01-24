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
                        <form method="post" action="{{route('employee.profile.online-presence.edit')}}">
                            @csrf
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <p class="section-subtitle mb-0">
                                        Your Online Presence
                                    </p>
                                </div>
                                <div class="col-12">
                                    <div class="row form-group align-items-center">
                                        <div class="col-lg-2">
                                            <label class="m-0">LinkedIn</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="form-group mb-0">
                                                <input
                                                    value="{{$employee->user_social_links != null ? $employee->user_social_links->linkedin : ''}}"
                                                    type="text" name="linkedIn" class="input-text"
                                                    placeholder="LinkedIn">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group align-items-center">
                                        <div class="col-lg-2">
                                            <label class="m-0">Facebook</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="form-group mb-0">
                                                <input
                                                    value="{{$employee->user_social_links != null ? $employee->user_social_links->facebook : ''}}"
                                                    type="text" name="Facebook" class="input-text"
                                                    placeholder="Facebook">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group align-items-center">
                                        <div class="col-lg-2">
                                            <label class="m-0">YouTube</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="form-group mb-0">
                                                <input
                                                    value="{{$employee->user_social_links != null ? $employee->user_social_links->youtube : ''}}"
                                                    type="text" name="YouTube" class="input-text" placeholder="YouTube">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group align-items-center">
                                        <div class="col-lg-2">
                                            <label class="m-0">Website</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="form-group mb-0">
                                                <input
                                                    value="{{$employee->user_social_links != null ? $employee->user_social_links->website : ''}}"
                                                    type="text" name="Website" class="input-text" placeholder="Website">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group align-items-center">
                                        <div class="col-lg-2">
                                            <label class="m-0">Other</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="form-group mb-0">
                                                <input
                                                    value="{{$employee->user_social_links != null ? $employee->user_social_links->other : ''}}"
                                                    type="text" name="Other" class="input-text" placeholder="Other">
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
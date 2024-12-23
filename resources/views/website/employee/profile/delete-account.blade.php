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
                        <form enctype="multipart/form-data" method="post" action="{{route('employee.profile.delete_account.post')}}">
                            @csrf

                            <div class="row">
                                <div class="col-12 mb-4">
                                    <p class="section-subtitle">Delete Account</p>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" class="input-text" placeholder="please enter your password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="mt-0">
                                <button onclick="return alert('Are you sure you want to delete your account? This action cannot be undone.')" class="btn button-theme mb-md-0 mb-3" type="submit">Save Changes</button>
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

@extends('website.app')
@section('website.content')
<!-- Register section start -->
<div class="contact-section main" style="background-image: url('{{ url('/website') }}/img/banner-2.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Form content box start -->
                <div class="form-content-box">
                    <!-- details -->
                    <div class="details text-left">
                        <!-- Name -->
                        <h1 class="form-title text-center">Register and Start Applying For Jobs</h1>
                        <div class="form-group mb-0 btn-with-image-box">
                            <img src="{{ url('/website') }}/img/google-icon.png" alt="logo" class="f-logo">
                            <a href="{{ route('redirect.google') }}"
                                class="btn-md btn text-dark btn-block btn-outline-primary my-2"
                                style="font-weight: bold;">
                                Sign Up Using Google Account</a>
                        </div>
                        <div class="my-4">
                            <p class="overline-line"><span class="overline-word">OR</span></p>
                        </div>
                        <!-- Form start -->
                        <form method="POST" action="{{ route('employee_register') }}">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input required id="first_name" type="text" name="first_name"
                                            class="form-control @error('first_name') is-invalid @enderror"
                                            placeholder="Enter your first name" value="{{ old('first_name') }}">
                                        @error('first_name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input required id="last_name" type="text" name="last_name"
                                            class="form-control @error('last_name') is-invalid @enderror"
                                            placeholder="Enter your last name" value="{{ old('last_name') }}">
                                        @error('last_name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input required id="email" type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Enter your personal email address" value="{{ old('email') }}">
                                @error('email')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input required id="password" type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter your password">
                                @error('password')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Password Confirmation</label>
                                <input id="password_confirmation" type="password" name="password_confirmation"
                                    class="form-control" placeholder="Password Confirmation">
                            </div>
                            <div>
                                {{-- <p class="text-center text-sm">
                                    By signing up, you agree to our
                                    <a href="terms.html">Terms and Conditions </a>
                                </p> --}}
                            </div>


                            <div class="my-2 d-flex justify-content-center">
                                {!!htmlFormSnippet()!!}
                                @error('g-recaptcha-response')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-0">
                                <button type="submit" class="btn-md button-theme btn-block">Create my
                                    account</button>
                            </div>
                            {{-- <div class="my-4">
                                <p class="overline-line"><span class="overline-word">OR</span></p>
                            </div>
                            <div class="form-group mb-0 btn-with-image-box">
                                <img src="{{ url('/website') }}/img/google-icon.png" alt="Google Icon">
                                <button type="submit" class="btn-md btn text-dark btn-block">Register with
                                    Gmail</button>
                            </div> --}}
                            <div class="mt-3">
                                <p class="text-center">
                                    Already have an account?
                                    <a href="{{route('login_page')}}">Log in </a>
                                </p>
                            </div>
                        </form>
                    </div>
                    <!-- Footer -->
                    {{-- <div class="footer text-sm">
                        <span>Looking to post jobs? <a href="employer/login.html">Create an Employer
                                Account</a></span>
                    </div> --}}
                </div>
                <!-- Form content box end -->
            </div>
        </div>
    </div>
</div>
<!-- Register section end -->
@endsection
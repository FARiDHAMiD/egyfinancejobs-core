@extends('website.app')
@section('website.content')
    <!-- Login section start -->
    <div class="contact-section main" style="background-image: url('{{ url('/website') }}/img/banner-2.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Form content box start -->
                    <div class="form-content-box">
                        <!-- details -->
                        <div class="details text-left">

                            <!-- Name -->
                            <h1 class="form-title text-center">Log in to your account</h1>
                            <div class="d-flex justify-content-center my-2">
                                <h2 class="btn-group d-flex w-100" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-success text-light"><i
                                            class="fa fa-google"></i></button>
                                    <a href="{{ route('redirect.google') }}" type="button" class="btn btn-primary w-100" style="font-weight: bold">Login
                                        Using Google Account</a>
                                </h2>
                            </div>
    
                            <!-- Form start -->
                            @error('login_error')
                                <div class="text-danger text-center mb-4">
                                    {{ $message }}
                                </div>
                            @enderror
                            <form form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" name="email" class="input-text"
                                        placeholder="Email Address" value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" name="password" class="input-text"
                                        placeholder="Password">
                                </div>
                                <div class="checkbox">
                                    <div class="btn-group-toggle d-inline" data-toggle="buttons">
                                        <label class="btn button-theme radio-btn inline-checkbox">
                                            <input name="remember" {{ old('remember') ? 'checked' : '' }} type="checkbox"
                                                autocomplete="off">
                                            <p class="m-0">
                                                <i class="fa fa-check fa-lg check-icon" aria-hidden="true"></i>
                                            </p>
                                        </label>
                                        <label class="mb-0">
                                            Remember me
                                        </label>
                                    </div>

                                    <a href="{{route('forget_password')}}" class="link-not-important pull-right">Forgot
                                        Password?</a>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn-md button-theme btn-block">login</button>
                                </div>
                                {{-- <div class="my-4">
                                    <p class="overline-line"><span class="overline-word">OR</span></p>
                                </div>
                                <div class="form-group mb-0 btn-with-image-box">
                                    <img src="{{ url('/website') }}/img/google-icon.png" alt="Google Icon">
                                    <button type="submit" class="btn-md btn text-dark btn-block">Log in with
                                        Gmail</button>
                                </div> --}}
                            </form>
                        </div>
                        <!-- Footer -->
                        <div class="footer">
                            <span>Don't have an account? <a href="{{route('employee_register_page')}}">Register here</a></span>
                        </div>
                    </div>
                    <!-- Form content box end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Login section end -->
@endsection

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
                            <h1 class="form-title text-center">Forget Password</h1>
                            <!-- Form start -->
                            @error('login_error')
                                <div class="text-danger text-center mb-4">
                                    {{ $message }}
                                </div>
                            @enderror
                            <form form method="POST" action="{{ route('new_password') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" name="email" class="input-text"
                                        placeholder="Email Address" value="{{ old('email') }}">
                                </div>


                                <div class="form-group mb-0">
                                    <button type="submit" class="btn-md button-theme btn-block">Send</button>
                                </div>

                            </form>
                        </div>
                        <!-- Footer -->
                        <div class="footer">
                        <div class="mt-3">
                                    <p class="text-center">
                                        Already have an account?
                                        <a href="{{route('login_page')}}">Log in </a>
                                    </p>
                                </div>                        </div>
                    </div>
                    <!-- Form content box end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Login section end -->
@endsection

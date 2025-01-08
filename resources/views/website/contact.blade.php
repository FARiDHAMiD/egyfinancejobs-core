@extends('website.app')
@section('website.content')
<!-- About Us start -->
<div class="job-listing-section main">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @if(auth()->check())
                <h1 class="h3 mb-3">Hi {{auth()->user()->first_name}}, </h1>
                @else
                <h1 class="h3 mb-3">Contact Us</h1>
                @endif()
                <!-- Form content box start -->
                <div class="form-content-box w-100 mt-0">
                    <!-- details -->
                    <div class="details text-left  border-radius-5">
                        <!-- Form start -->
                        <form action="{{route('website.contact_us.create')}}" method="POST">
                            @csrf
                            @if(!auth()->check())
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="input-text @error('name') is-invalid @enderror"
                                    value="{{old('name')}}" placeholder="Your Name ..." required>
                            </div>
                            @error('name')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror

                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" name="mobile"
                                    class="input-text @error('mobile') is-invalid @enderror" value="{{old('mobile')}}"
                                    placeholder="Mobile No.">
                            </div>
                            @error('mobile')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="input-text @error('email') is-invalid @enderror"
                                    value="{{old('email')}}" placeholder="Please provide valid email address ...">
                            </div>
                            @error('email')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                            @endif

                            <div class="form-group">
                                <label>How can we help you?</label>
                                <textarea name="description"
                                    class="input-text @error('description') is-invalid @enderror"
                                    placeholder="Please describe how we can help you" rows="6"
                                    required>{{old('description')}}</textarea>
                            </div>
                            @error('employer')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror

                            <div class="text-right">
                                <button type="submit" class="btn button-theme px-5">
                                    Send
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- Form content box end -->
            </div>
        </div>
    </div>
</div>
<!-- About Us end -->
@endsection
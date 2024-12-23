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
                        <form method="post" action="{{route('employee.profile.learning-interests.update')}}">
                            @csrf
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <p class="section-subtitle mb-0">
                                        What are the topics that interest you?
                                    </p>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="text" name="interested_Topics" class="input-text"
                                            placeholder="Write skills / Topic you are interested in">
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

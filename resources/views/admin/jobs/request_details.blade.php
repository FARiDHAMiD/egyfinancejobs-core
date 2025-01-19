@extends('admin.app')
@section('admin.content')
<div class="container">
    <h4 class="text-primary text-center my-2">Job Request Details</h4>
    <div class="card">

        <div class="card-body">
            <h5 class="card-title text-dark text-weight-bold">{{$job->title}} | {{$job->company}} | {{$job->location}}
            </h5>
            <h6 class="card-title">{{$job->username}} | {{$job->mobile}} | {{$job->email}}</h6>
            <hr>
            <label for="" class="text-dark">Excerpt</label>
            <p class="card-text">{{$job->excerpt}}</p>
            <hr>
            <label for="" class="text-dark">Description</label>
            <p class="card-text">{{$job->description}}</p>
            <hr>
            <label for="" class="text-dark">Requirements</label>
            <p class="card-text">{{$job->requirements}}</p>

            <div class="row">
                <div class="col-6">
                    <label for="" class="text-dark">Salary From</label>
                    <p class="card-text">{{$job->salary_from}}</p>
                </div>
                <div class="col-6">
                    <label for="" class="text-dark">Salary To</label>
                    <p class="card-text">{{$job->salary_to}}</p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6">
                    <label for="" class="text-dark">Experience From</label>
                    <p class="card-text">{{$job->years_experience_from}}</p>
                </div>
                <div class="col-6">
                    <label for="" class="text-dark">Experience To</label>
                    <p class="card-text">{{$job->years_experience_to}}</p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6">
                    <label for="" class="text-dark">Job Type</label>
                    <p class="card-text">{{$job->type->name}}</p>
                </div>
                <div class="col-6">
                    <label for="" class="text-dark">Job Cateory</label>
                    <p class="card-text">{{$job->category->name}}</p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6">
                    <label for="" class="text-dark">Education Level</label>
                    <p class="card-text">{{$job->education_level->name}}</p>
                </div>
                <div class="col-6">
                    <label for="" class="text-dark">Career Level</label>
                    <p class="card-text">{{$job->career_level->name}}</p>
                </div>
            </div>
            <hr>
            <label for="" class="text-dark">Additional Info</label>
            <p class="card-text">{{$job->questions}}</p>
            <hr>
            <div class="row">
                <div class="col-6">
                    <label for="" class="text-dark">External Link</label>
                    <p class="card-text">{{$job->url_link}}</p>
                </div>
                <div class="col-6">
                    <label for="" class="text-dark">Requested On</label>
                    <p class="card-text">{{$job->created_at}}</p>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <a href="#" class="btn btn-primary">Mark as Reviewed <i class="fa fa-check"></i></a>
            <a href="#" class="btn btn-danger">Delete Request <i class="fa fa-trash"></i></a>
        </div>
    </div>
</div>
@endsection
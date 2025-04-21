@extends('reports.main')
@section('content')
<div class="container text-center">

    <img src="{{ asset('/website/img/working.jpg') }}" alt="brand" class="img-fluid">
    <div class="my-4">
        <a class="btn btn-dark" href="{{url()->previous()}}">Back</a>
    </div>
</div>

@endsection
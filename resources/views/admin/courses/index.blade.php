@extends('admin.app')
@section('admin.content')
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary">Courses ({{$courses->count()}})
                    </h6>
                </div>

                <div class="col-6 text-right">
                    <a href="{{ route('courses.create') }}" class="btn btn-info btn-sm">
                        <i class="fas fa-plus"></i> Add New Course
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Instructor</th>
                            <th>Price</th>
                            <th>Start Date</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><a target="_blank" href="{{route('courses.show', $course->uuid)}}">
                                    {{$course->name}}
                                </a>
                            </td>
                            <td>
                                <a target="_blank"
                                    href="{{route('courses.instructorProfile', $course->user_instructor->uuid ?? '')}}">

                                    {{$course->user_instructor->first_name ?? ''}} {{$course->user_instructor->last_name
                                    ??
                                    ''}}
                                </a>
                            </td>
                            <td>{{$course->price}}</td>
                            <td>{{$course->start_date}}</td>
                            <td>{{$course->user->first_name ?? ''}}</td>
                            <td>
                                <a href="{{route('courses.edit', $course->id)}}" class="btn btn-success btn-sm m-1">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form method="post" class="d-inline" action="">
                                    @method('delete')
                                    @csrf
                                    <button onclick="return confirm('Are you sure you want to delete this?')"
                                        class="btn btn-danger btn-sm m-1" type="submit">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
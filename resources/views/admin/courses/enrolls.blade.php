@extends('admin.app')
@section('admin.content')
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary">All Enrolls Requests ({{$enrolls->count()}})
                    </h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Course</th>
                            <th>Requested On</th>
                            <th>Accept</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enrolls as $enroll)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><a target="_blank" href="{{route('courses.profile', $enroll->student->uuid)}}">
                                    {{$enroll->student->first_name}} {{$enroll->student->last_name}}
                                </a>
                            </td>
                            <td>
                                <a target="_blank" href="{{route('courses.show', $enroll->course->uuid)}}">
                                    {{$enroll->course->name}}
                                </a>
                            </td>
                            <td>{{$enroll->created_at}}</td>
                            @if($enroll->enroll_statu)
                            <td class="text-success text-center">Accepted!</td>
                            @else
                            <td class="text-center">
                                <form method="post" class="d-inline"
                                    action="{{route('courses.accept_enroll', $enroll->id)}}">
                                    {{-- @method('put') --}}
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm m-1">
                                        <i class="fa fw fa-check"></i>
                                    </button>
                                </form>
                            </td>
                            @endif
                            @if($enroll->accepted_by)
                            <td>{{$enroll->user->first_name}} {{$enroll->user->last_name}}</td>
                            @else
                            <td>Pending...</td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
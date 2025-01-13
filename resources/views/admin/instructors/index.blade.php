@extends('admin.app')
@section('admin.content')
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary">Instructors ({{$instructors->count()}})
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
                            <th>Name</th>
                            <th>email</th>
                            <th>Verified</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($instructors as $instructor)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$instructor->first_name}} {{$instructor->last_name}}</td>
                            <td>{{$instructor->email}}</td>
                            <td>
                                @if(!$instructor->email_verified_at)
                                <i class="fa fa-ban" style="color: red; font-size: large"></i>
                                @else
                                <i class="fa fa-check" style="color: green; font-size: large"></i>
                                @endif
                            </td>
                            <td>
                                @if(!$instructor->email_verified_at)
                                <a href="{{ route('admin.instructor.verify', $instructor->id) }}"
                                    class="btn btn-success btn-sm m-1">
                                    <i class="fas fa-check"></i>
                                </a>
                                @endif
                                <a href="{{route('courses.instructorProfile', $instructor->uuid)}}"
                                    class="btn btn-info btn-sm m-1" type="submit">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form method="post" class="d-inline"
                                    action="{{ route('admin.instructor.delete', $instructor->id) }}">
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
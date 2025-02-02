@extends('admin.app')
@section('admin.content')
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary">Events ({{$events->count()}})
                    </h6>
                </div>

                <div class="col-6 text-right">
                    <a href="{{ route('events.create') }}" class="btn btn-info btn-sm">
                        <i class="fas fa-plus"></i> Create Event
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
                            <th>Title</th>
                            <th>Origanizer</th>
                            <th>Status</th>
                            <th>Start Date</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><a href="{{route('courses.events.show', $event->uuid)}}">{{$event->title}}</a></td>
                            <td>{{$event->user_instructor->first_name ?? ''}} {{$event->user_instructor->last_name ?? ''}}</td>
                            <td>{{$event->statu->name}}</td>
                            <td>{{$event->start_date}}</td>
                            <td>{{$event->user->first_name}} {{$event->user->last_name}}</td>
                            <td>
                                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-info btn-sm m-1">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form method="post" class="d-inline" action="{{ route('events.destroy', $event->id) }}">
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
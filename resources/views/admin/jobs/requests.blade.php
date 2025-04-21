@extends('admin.app')
@section('admin.content')
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary">Job Requests ({{$jobs->count()}})</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Job Title</th>
                            <th>Company</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Details</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($jobs as $job)
                        <tr class="text-center">
                            <td>{{$job->username}}</td>
                            <td>{{$job->title}}</td>
                            <td>{{$job->company}}</td>
                            <td>{{date('d-m-Y', strtotime($job->created_at))}}</td>
                            <td>{{ $job->pending ? 'Pending...' : 'Reviewed' }}</td>
                            <td>
                                <a href="{{ route('jobs.requests.details', $job->id) }}"
                                    class="btn btn-info btn-sm m-1">
                                    <i class="fas fa-eye"></i>
                                </a>
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
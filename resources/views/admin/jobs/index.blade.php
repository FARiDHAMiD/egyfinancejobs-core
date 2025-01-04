@extends('admin.app')
@section('p_css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
@section('admin.content')
<div class="container-fluid">

    {{-- start filter --}}
    <style>
        #search-form input,
        #search-form select {
            color: #000;
            font-weight: bold;
        }

        .filter-sec {
            border: 1px solid #b4c1e5;
            border-bottom: 2px solid #476dda;
            border-radius: 0;
        }

        .b-sharp {
            border-radius: 0;
        }
    </style>
    <div class="card shadow mb-4 filter-sec">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary">Filter Options:</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="" method="get" id="search-form">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control b-sharp" name="job" value="{{@$search['job']}}"
                                placeholder="Job Title">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control b-sharp" name="employer"
                                value="{{@$search['employer']}}" placeholder="Company Name Or Phone">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control b-sharp" name="salary" value="{{@$search['salary']}}"
                                placeholder="Salary">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control b-sharp datepiker" name="from_date"
                                value="{{@$search['from_date']}}" placeholder="From Date">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control b-sharp datepiker" name="to_date"
                                value="{{@$search['to_date']}}" placeholder="To Date">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="job_category" class="form-control">
                                <option value="">Job Category</option>
                                @foreach ($job_categories as $job_category)
                                <option value="{{ $job_category->id }}" {{ @$search['job_category']==$job_category->id ?
                                    'selected' : '' }}>
                                    {{ $job_category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="type" class="form-control ">
                                <option value="">Job Type</option>
                                @foreach ($types as $type)
                                <option value="{{ $type->id }}" {{ @$search['type']==$type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="m-2 my-1">
                        <button type="submit" class="btn btn-success b-sharp" style="width: 100%;">Search</button>
                    </div>
                    <div class="m-2 my-1">
                        <a href="{{\Request::url()}}" class="btn btn-info b-sharp" style="width: 100%;">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- end filter --}}
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary">Job List ({{$jobs->count()}})</h6>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('jobs.create') }}" class="btn btn-info btn-sm">
                        <i class="fas fa-plus"></i> Add new job
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Company</th>
                            <th>Location</th>
                            <th>Category</th>
                            <th>Job Type</th>
                            <th>Salary</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <!-- <tfoot>
                            <tr>
                                <th>Job Title</th>
                                <th>Company Name</th>
                                <th>Location</th>
                                <th>Category</th>
                                <th>Job Type</th>
                                <th>Salary</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </tfoot> -->
                    <tbody>
                        @foreach ($jobs as $job)
                        <tr>
                            <td><a href="{{ route('website.job-details', $job->job_uuid) }}" target="_blank">{{
                                    $job->job_title}}</a></td>
                            <td>
                                @if ($job->employer_profile)
                                <a href="{{ route('employer.profile.employer_id', $job->employer_profile->employer_id ) }}"
                                    target="_blank">{{
                                    $job->employer_profile->company_name}}</a>
                                @else
                                no company added
                                @endif
                            </td>
                            <td> {{ empty($job->area) ? null : $job->area->name }}, {{ empty($job->city) ? null :
                                $job->city->name }}, {{ $job->country->name }}</td>
                            <td>{{ empty($job->category) ? 'uncategorized' : $job->category->name }}</td>
                            <td>{{ $job->type->name }}</td>
                            <td>{{ $job->salary }}</td>

                            <td>{{date('d-m-Y', strtotime($job->created_at))}}</td>
                            <td>
                                <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form method="post" class="d-inline" action="{{ route('jobs.destroy', $job->id) }}">
                                    @method('delete')
                                    @csrf
                                    <button
                                        onclick="return confirm('Are you sure you want to delete this? it will delete all applications under this jobs! ')"
                                        class="btn btn-danger btn-sm" type="submit">
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
@section('p_js')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    $(".datepiker").flatpickr();
</script>
@endsection
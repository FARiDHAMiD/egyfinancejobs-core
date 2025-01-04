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
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control b-sharp" name="employee_name"
                                value="{{@$search['employee_name']}}" placeholder="Employee Name">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control b-sharp" name="employee_phone"
                                value="{{@$search['employee_phone']}}" placeholder="Employee Phone">
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
                    <div class="m-2">
                        <button type="submit" class="btn btn-success b-sharp" style="width: 100%;">Search</button>
                    </div>
                    <div class="m-2">
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
                    <h6 class="m-0 font-weight-bold text-primary">Employees List ({{$employees->count()}})</h6>
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Mobile Number</th>
                            <th>Email</th>
                            <th>Job Applications</th>
                            <th>Address</th>
                            <th>Created at</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Employee Name</th>
                            <th>Mobile Number</th>
                            <th>Email</th>
                            <th>Job Applications</th>
                            <th>Address</th>
                            <th>Created at</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        @foreach ($employees as $employee)
                        @php $employee_profile = $employee->employee_profile; @endphp
                        @if($employee_profile)
                        <tr>
                            <td><a href="{{ route('employee.profile.view', $employee->uuid) }}" target="_blank">{{
                                    $employee->first_name }} {{ $employee->last_name }}</a></td>
                            <td>{{ $employee_profile->phone}}</td>
                            <td>{{ $employee->email}}</td>
                            <td><a href="{{url('admin/job-applications/'.$employee->id)}}">{{
                                    $employee->applied_jobs->count()}} {{ $employee->applied_jobs->count() == 1 ? 'Job'
                                    : 'Jobs'}}</a></td>
                            <td>{{ empty($employee_profile->area) ? null : $employee_profile->area->name }}, {{
                                empty($employee_profile->city) ? null : $employee_profile->city->name }}, {{
                                $employee_profile->country->name }}</td>
                            <td>{{date('d-m-Y', strtotime($employee->created_at))}}</td>
                        </tr>
                        @endif
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
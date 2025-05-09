@extends('admin.app')
@section('p_css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
@section('admin.content')

@if (session()->has('statu_changed'))
<div class="modal fade" id="alert-message-modal" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center alert alert-{{ session()->get('statu_changed')['icon'] }}">
                    {{ session()->get('statu_changed')['message'] }}
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-success" id="send_mail" data-dismiss="modal" disabled>
                        Email sent successfully! <i class="fa fa-forward"></i></button>
                    <button data-dismiss="modal" class="btn btn-secondary">Close</button>
                </div>
                {{ session()->forget('statu_changed') }}
            </div>
        </div>
    </div>
</div>
@endif
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
                    <h6 class="m-0 font-weight-bold text-primary">Filter Options: </h6>
                </div>
                <div class="col-md-6">
                    <span class="text-lg text-muted text-end"> Working on it...</span>
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
                            <input type="text" class="form-control b-sharp" name="employer"
                                value="{{@$search['employer']}}" placeholder="Company Name Or Phone">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" class="form-control b-sharp" name="job" value="{{@$search['job']}}"
                                placeholder="Job Title">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" class="form-control b-sharp datepiker" name="from_date"
                                value="{{@$search['from_date']}}" placeholder="From Date">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" class="form-control b-sharp datepiker" name="to_date"
                                value="{{@$search['to_date']}}" placeholder="To Date">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <select class="form-control b-sharp " name="status">
                                <option value="">Select Status</option>
                                <option value="pending" {{ @$search['status']=='pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="accepted" {{ @$search['status']=='accepted' ? 'selected' : '' }}>Accepted
                                </option>
                                <option value="rejected" {{ @$search['status']=='rejected' ? 'selected' : '' }}>Rejected
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <select name="city" class="form-control @error('city') is-invalid @enderror">
                                <option value="">Select cities</option>
                                @php
                                $cities = \DB::table('cities')->get()
                                @endphp
                                @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ @$search['city']==$city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <select name="university" class="form-control @error('university') is-invalid @enderror">
                                <option value="">Select universities</option>
                                @php
                                $universities = \DB::table('universities')->get()
                                @endphp
                                @foreach ($universities as $university)
                                <option value="{{ $university->id }}" {{ @$search['university']==$university->id ?
                                    'selected' : '' }}>
                                    {{ $university->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <select name="skill" class="form-control @error('skill') is-invalid @enderror">
                                <option value="">Select skills</option>
                                @php
                                $skills = \DB::table('skills')->where('category', '!=', 'language')->get()
                                @endphp
                                @foreach ($skills as $skill)
                                <option value="{{ $skill->id }}" {{ @$search['skill']==$skill->id ? 'selected' : '' }}>
                                    {{ $skill->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <select class="form-control b-sharp " name="skill_level">
                                <option value="">Select skill level</option>
                                <option value="1" {{ @$search['skill_level']=='1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ @$search['skill_level']=='2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ @$search['skill_level']=='3' ? 'selected' : '' }}>3 </option>
                                <option value="4" {{ @$search['skill_level']=='4' ? 'selected' : '' }}>4 </option>
                                <option value="5" {{ @$search['skill_level']=='5' ? 'selected' : '' }}>5 </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <select name="language" class="form-control @error('language') is-invalid @enderror">
                                <option value="">Select languages</option>
                                @php
                                $rows = \DB::table('skills')->where('category', 'language')->get()
                                @endphp
                                @foreach ($rows as $row)
                                <option value="{{ $row->id }}" {{ @$search['language']==$row->id ? 'selected' : '' }}>
                                    {{ $row->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <select class="form-control b-sharp " name="language_level">
                                <option value="">Select language level</option>
                                <option value="1" {{ @$search['language_level']=='1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ @$search['language_level']=='2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ @$search['language_level']=='3' ? 'selected' : '' }}>3 </option>
                                <option value="4" {{ @$search['language_level']=='4' ? 'selected' : '' }}>4 </option>
                                <option value="5" {{ @$search['language_level']=='5' ? 'selected' : '' }}>5 </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" class="form-control b-sharp" name="app_id" value="{{@$search['app_id']}}"
                                placeholder="Apply Code">
                        </div>
                    </div>
                    <div class="col-md-2 my-1">
                        <button type="submit" class="btn btn-success b-sharp" style="width: 100%;">Search</button>
                    </div>
                    <div class="col-md-2 my-1">
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
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary">Latest Applications ({{ $applications->total() }})
                    </h6>
                </div>
                <div class="col-md-6 text-right">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Filter
                    </button>
                    @if($applications->total() > 0)
                    <a href="{{url('admin/export-application?employee_name='.request()->employee_nam.'&employer='.request()->employer.'&job='.request()->job.'&from_date='.request()->from_date.'&to_date='.request()->to_date.'&status='.request()->status.'&city='.request()->city.'&university='.request()->university.'&skill='.request()->skill.'&skill_level='.request()->skill_level.'&language='.request()->language.'&language_level='.request()->language_level.'&app_id='.request()->app_id)}}"
                        class="btn btn-info"> <i class="fa fa-download"></i> excel</a>
                    @endif
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.home') }}" method="get">
                                        <div class="row text-left">
                                            <div class="col-12">
                                                <div>
                                                    <label class="text-dark"><strong>Employee Name</strong></label>
                                                    <input value="{{request()->employee_name}}" type="text"
                                                        name="employee_name" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4 justify-content-center">
                                            <div class="col-md-6 mb-3">
                                                <button type="submit" class="btn btn-info  w-100">
                                                    <i class="fas fa-save"></i> Search
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0" id="dataTable">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Job Title</th>
                            <th>Company Name</th>
                            <th>Status</th>
                            <th>city</th>
                            <th>university</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <!-- <tfoot>
                            <tr>
                                <th>Employee Name</th>
                                <th>Job Title</th>
                                <th>Company Name</th>
                                <th>Status</th>
                                <th>city</th>
                                <th>university</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>

                             <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>university</th>
                                <th></th>
                                <th>Action</th>
                        </tfoot> -->
                    <tbody>

                        @foreach ($applications as $application)
                        <tr data-update-url="{{ route('job-applications.update', $application->id) }}">
                            <td><a href="{{ route('employee.profile.view', $application->employee->uuid) }}"
                                    target="_blank">{{ $application->employee->first_name . ' ' .
                                    $application->employee->last_name }}</a>
                            </td>
                            <td><a href="{{ route('website.job-details', $application->job->job_uuid) }}"
                                    target="_blank">{{ $application->job->job_title }}</a></td>
                            <td>
                                <a href="{{ route('employer.profile.employer_id', optional($application->job->employer_profile)->employer_id ?? '') }}"
                                    target="_blank">
                                    {{ optional($application->job->employer_profile)->company_name}}
                                </a>
                            </td>

                            {{-- applications status after update | Farid on 07-01-2025 --}}
                            <td>
                                <button @switch($application->statu_id)
                                    @case(1)
                                    class="btn btn-sm btn-outline-dark"
                                    @break
                                    @case(2)
                                    class="btn btn-sm btn-outline-primary"
                                    @break
                                    @case(3)
                                    class="btn btn-sm btn-outline-info"
                                    @break
                                    @case(4)
                                    class="btn btn-sm btn-outline-success"
                                    @break
                                    @case(5)
                                    class="btn btn-sm btn-outline-danger"
                                    @break
                                    @default

                                    @endswitch data-target="#application_statu{{$application->id}}" data-toggle="modal">
                                    {{$application->application_statu->name}}
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="application_statu{{$application->id}}" tabindex="-1"
                                    role="dialog" aria-labelledby="application_statuLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="application_statuLabel">
                                                    {{$application->employee->first_name . ' ' .
                                                    $application->employee->last_name}} | Application
                                                    #{{$application->id}}<br>
                                                    {{$application->job->employer_profile->company_name}} |
                                                    {{ $application->job->job_title }}
                                                </h5>
                                            </div>
                                            <form action="{{route('job_application.update_statu', $application->id)}}"
                                                method="POST">
                                                <div class="modal-body">
                                                    @csrf
                                                    <select name="statu_id" class="form-control">
                                                        @foreach ($status as $statu)
                                                        <option value="{{$statu->id}}" @if ($application->
                                                            application_statu->id == $statu->id)
                                                            selected
                                                            @endif
                                                            >{{$statu->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>

                                {{ optional(optional(optional($application->employee)->employee_profile)->city)->name }}
                            </td>
                            <td>
                                @foreach ($application->employee->employee_educations as $education)

                                {{ optional($education->university)->name}} -

                                @endforeach

                            </td>
                            <td>{{ date('d-m-Y', strtotime($application->created_at)) }}</td>
                            <td>
                                <form method="post" class="d-inline"
                                    action="{{ route('job-applications.destroy', $application->id) }}">
                                    @method('delete')
                                    @csrf
                                    <button onclick="return confirm('Are you sure you want to delete this?')"
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

    <div class="text-center">
        <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
            <ul class="pagination justify-content-center">
                @if ($applications->onFirstPage())
                <li class="paginate_button page-item previous disabled" id="dataTable_previous"><a href="#"
                        aria-controls="dataTable" tabindex="0" class="page-link">Previous</a></li>
                @else
                <li class="paginate_button page-item previous" id="dataTable_previous"><a
                        href="{{ $applications->previousPageUrl() }}" aria-controls="dataTable" tabindex="0"
                        class="page-link">Previous</a></li>
                @endif

                @php
                $maxButtons = 7;
                $currentPage = $applications->currentPage();
                $lastPage = $applications->lastPage();
                $halfMaxButtons = floor($maxButtons / 2);
                $startPage = max(1, $currentPage - $halfMaxButtons);
                $endPage = min($lastPage, $currentPage + $halfMaxButtons);
                @endphp

                @if ($startPage > 1)
                <li class="paginate_button page-item"><a href="{{ $applications->url(1) }}" aria-controls="dataTable"
                        tabindex="0" class="page-link">1</a></li>
                @if ($startPage > 2)
                <li class="paginate_button page-item disabled"><span class="page-link">...</span></li>
                @endif
                @endif

                @for ($i = $startPage; $i <= $endPage; $i++) <li
                    class="paginate_button page-item {{ $applications->currentPage() === $i ? 'active' : '' }}"><a
                        href="{{ $applications->url($i) }}" aria-controls="dataTable" tabindex="0" class="page-link">{{
                        $i }}</a></li>
                    @endfor

                    @if ($endPage < $lastPage) @if ($endPage < $lastPage - 1) <li
                        class="paginate_button page-item disabled"><span class="page-link">...</span></li>
                        @endif
                        <li class="paginate_button page-item"><a href="{{ $applications->url($lastPage) }}"
                                aria-controls="dataTable" tabindex="0" class="page-link">{{ $lastPage }}</a></li>
                        @endif

                        @if ($applications->hasMorePages())
                        <li class="paginate_button page-item next" id="dataTable_next"><a
                                href="{{ $applications->nextPageUrl() }}" aria-controls="dataTable" tabindex="0"
                                class="page-link">Next</a></li>
                        @else
                        <li class="paginate_button page-item next disabled" id="dataTable_next"><a href="#"
                                aria-controls="dataTable" tabindex="0" class="page-link">Next</a></li>
                        @endif
            </ul>
        </div>

    </div>

</div>
@endsection

@section('admin.page-scripts')
<script>
    $('.status').change(function() {
            var status = $(this)
            var updateUrl = status.closest('tr').data('update-url')
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: 'post',
                url: updateUrl + window.location.search,
                data: {
                    status: status.val()
                },
                success: function(response) {


                    if (status.val() == 'pending') {
                        status.parent().find('.status_text').html(
                            '<span class="text-warning">Pending</span>')
                    } else if (status.val() == 'ReviewedyourApplication') {
                        status.parent().find('.status_text').html(
                            '<span class="text-primary">Reviewed your Application</span>')


                    } else if (status.val() == 'Shortlisted') {
                        status.parent().find('.status_text').html(
                            '<span class="text-info">Shortlisted</span>')

                    } else if (status.val() == 'accepted') {
                        status.parent().find('.status_text').html(
                            '<span class="text-success">Accepted</span>')
                    } else if (status.val() == 'rejected') {
                        status.parent().find('.status_text').html(
                            '<span class="text-danger">Rejected</span>')
                    }

                }
            })


        })
</script>
@endsection

@section('p_js')
{{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    $(".datepiker").flatpickr();
</script> --}}
@endsection
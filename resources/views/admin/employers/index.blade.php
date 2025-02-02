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
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control b-sharp" name="employer"
                                value="{{@$search['employer']}}" placeholder="Company Name Or Phone">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control b-sharp" name="employer_name"
                                value="{{@$search['employer_name']}}" placeholder="Employer Name">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control b-sharp" name="employer_phone"
                                value="{{@$search['employer_phone']}}" placeholder="Employer Phone">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control b-sharp datepiker" name="from_date"
                                value="{{@$search['from_date']}}" placeholder="From Date">
                        </div>
                    </div>
                    <div class="col-md-4">
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
                    <h6 class="m-0 font-weight-bold text-primary">Employers List ({{$employers->count()}})</h6>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('employers.create') }}" class="btn btn-info btn-sm">
                        <i class="fas fa-plus"></i> Add new employer
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
                            <th>Employer Name</th>
                            <th>Mobile Number</th>
                            <th>Company Name</th>
                            <th>Company location</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($employers as $employer)
                        @php $employer_profile = $employer->employer_profile; @endphp
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><a href="{{ route('employer.profile', $employer->uuid) }}" target="_blank">{{
                                    $employer->first_name }}</a></td>
                            <td>{{ $employer_profile->mobile_number ?? ''}}</td>
                            <td><a href="{{ route('employer.profile', $employer->uuid) }}" target="_blank">{{
                                    $employer_profile->company_name ?? '' }}</a></td>
                            <td> {{empty($employer_profile->area) ? null : $employer_profile->area->name }}, {{
                                empty($employer_profile->city) ? null : $employer_profile->city->name }}, {{
                                $employer_profile->country->name ?? '' }}</td>

                            {{-- <td>{{date('d-m-Y', strtotime($employer->created_at))}}</td> --}}
                            <td>{{$employer->created_at}}</td>
                            <td>
                                <a href="{{ route('employers.edit', $employer->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form method="post" class="d-inline"
                                    action="{{ route('employers.destroy', $employer->id) }}">
                                    @method('delete')
                                    @csrf
                                    <button
                                        onclick="return confirm('Are you sure you want to delete this? it will delete all jobs and applications under this company! ')"
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
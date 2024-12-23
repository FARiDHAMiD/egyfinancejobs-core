@extends('admin.app')
@section('admin.content')
    <div class="container-fluid">



        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="m-0 font-weight-bold text-primary">Applications ({{ $applications->total() }})</h6>
                    </div>
                    <div class="col-md-6 text-right">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Filter
                        </button>

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
                                        <form action="{{ route('admin.job_applications') }}" method="get">
                                            <div class="row text-left">
                                                <div class="col-12">
                                                    <div>
                                                        <label class="text-dark"><strong>Employee Name</strong></label>
                                                        <input value="{{request()->employee_name}}" type="text" name="employee_name" class="form-control">
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
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Employee Name</th>
                                <th>Job Title</th>
                                <th>Company Name</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Employee Name</th>
                                <th>Job Title</th>
                                <th>Company Name</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach ($applications as $application)
                                <tr data-update-url="{{ route('job-applications.update', $application->id) }}">
                                    <td><a href="{{ route('employee.profile.view', $application->employee->id) }}"
                                            target="_blank">{{ $application->employee->first_name . ' ' . $application->employee->last_name }}</a>
                                    </td>
                                    <td><a href="{{ route('website.job-details', $application->job->id) }}"
                                            target="_blank">{{ $application->job->job_title }}</a></td>
                                    <td><a href="{{ route('employer.profile', $application->job->employer_profile->employer_id) }}"
                                            target="_blank">{{ $application->job->employer_profile->company_name }}</a></td>
                                    <td>
                                        <p class="status_text d-inline">
                                            @if ($application->status == 'pending')
                                                <span class="text-warning">Pending</span>
                                            @elseif($application->status == 'accepted')
                                                <span class="text-success">Accepted</span>
                                            @elseif($application->status == 'rejected')
                                                <span class="text-danger">Rejected</span>
                                            @endif
                                        </p>
                                        <select name="status" class="status"
                                            style="width: 20px; margin-right: 10px; float: left;">
                                            <option value="pending"
                                                {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="accepted"
                                                {{ $application->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                            <option value="rejected"
                                                {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected
                                            </option>
                                        </select>
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
                        <li class="paginate_button page-item"><a href="{{ $applications->url(1) }}"
                                aria-controls="dataTable" tabindex="0" class="page-link">1</a></li>
                        @if ($startPage > 2)
                            <li class="paginate_button page-item disabled"><span class="page-link">...</span></li>
                        @endif
                    @endif

                    @for ($i = $startPage; $i <= $endPage; $i++)
                        <li class="paginate_button page-item {{ $applications->currentPage() === $i ? 'active' : '' }}"><a
                                href="{{ $applications->url($i) }}" aria-controls="dataTable" tabindex="0"
                                class="page-link">{{ $i }}</a></li>
                    @endfor

                    @if ($endPage < $lastPage)
                        @if ($endPage < $lastPage - 1)
                            <li class="paginate_button page-item disabled"><span class="page-link">...</span></li>
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
                type: 'PUT',
                url: updateUrl + window.location.search,
                data: {
                    status: status.val()
                },
                success: function(response) {
                    if (status.val() == 'pending') {
                        status.parent().find('.status_text').html(
                            '<span class="text-warning">Pending</span>')
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

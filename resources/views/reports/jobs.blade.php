@extends('reports.main')
@section('content')
<div class="container-fluid">
    <div class="container">

        <div class="row">
            <div class="col-md-2 col-6">
                <input class="form-control form-control-sm m-1" type="number" id="minSalary" placeholder="Min. Salary">
            </div>
            <div class="col-md-2 col-6">
                <input class="form-control form-control-sm m-1" type="number" id="maxSalary" placeholder="Max. Salary">
            </div>

            <div class="col-md-2 col-6">
                <input class="form-control form-control-sm m-1" type="number" id="minExp" placeholder="Min. Exp"
                    min="0">
            </div>
            <div class="col-md-2 col-6">

                <input class="form-control form-control-sm m-1" type="number" id="maxExp" placeholder="Max. Exp"
                    min="0">
            </div>

            <div class="col-md-2 col-6">
                <input class="form-control form-control-sm m-1" onfocus="(this.type='date')" onblur="(this.type='text')"
                    placeholder="Posted From" id="minDate">
            </div>
            <div class="col-md-2 col-6">
                <input class="form-control form-control-sm m-1" onfocus="(this.type='date')" onblur="(this.type='text')"
                    placeholder="Posted To" id="maxDate">
            </div>
        </div>
    </div>
    <hr>

    <div class="table-responsive">
        <table id="jobsTable" class="table table-hover display" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Company</th>
                    <th>Location</th>
                    <th class="noExport">
                        Category
                        <select class="form-select form-select-sm" id="categoryFilter">
                            <option value="">All</option>
                            @foreach ($cats as $cat)
                            <option value="{{$cat->name}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </th>
                    <th>Type</th>
                    <th>Career Level</th>
                    <th>Experience</th>
                    <th>Salary</th>
                    <th class="noExport">Applications</th>
                    <th>Posted On</th>
                    <th>Admin</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobs as $job)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <a target="_blank" href="{{route('website.job-details', $job->job_uuid)}}">
                            {{$job->job_title}}
                        </a>
                    </td>
                    <td>
                        <a target="_blank"
                            href="{{route('employer.profile.employer_id', $job->employer_profile->employer_id)}}">
                            {{$job->employer_profile->company_name}}
                        </a>
                    </td>
                    <td>{{$job->city->name ?? ''}}, {{$job->country->name}}.</td>
                    <td>{{$job->category->name}}</td>
                    <td>{{$job->type->name}}</td>
                    <td>{{$job->career_level->name}}</td>
                    @if ($job->years_experience_from)
                    <td data-experience="{{ $job->years_experience_from }}-{{ $job->years_experience_to }}">
                        {{$job->years_experience_from}} - {{$job->years_experience_to}}</td>
                    @else
                    <td></td>
                    @endif
                    @if ($job->salary_from)
                    <td>
                        <span class="text-nowrap">

                            @if($job->salary_from >=1000)
                            {{round($job->salary_from / 1000, 1) .'K'}} - {{round($job->salary_to / 1000, 1) .'K'}}
                            @else
                            {{number_format($job->salary_from)}} - {{number_format($job->salary_to)}}
                            @endif
                        </span>
                        <br>
                        <span style="font-size: small">{{$job->currencies->name}}</span>
                    </td>
                    @else
                    <td>N/A</td>
                    @endif
                    @if ($job->external_email)
                    <td class="noExport">
                        <a type="button" class="text-info" data-bs-toggle="modal" data-bs-target="#emailModal">
                            Email
                        </a>
                        <div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body text-center">
                                        {{$job->external_email}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </td>
                    @elseif($job->external_url)
                    <td>
                        <a target="_blank" href="{{$job->external_url}}" class="text-info">
                            Link
                        </a>
                    </td>
                    @else
                    <td class="noExport">
                        <a type="button" class="" data-bs-toggle="modal"
                            data-bs-target="#applicationsModal{{$job->id}}">
                            {{$job->applications->count()}}
                        </a>
                        <div class="modal fade" id="applicationsModal{{$job->id}}" tabindex="-1"
                            aria-labelledby="applicationsModal{{$job->id}}Label" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body text-center">
                                        <ul class="list-group list-group-flush">
                                            @foreach ($job->applications as $app)
                                            <li class="list-group-item">
                                                <a target="_blank"
                                                    href="{{route('employee.profile.view', $app->employee->uuid)}}">
                                                    {{$app->employee->first_name}} {{$app->employee->last_name}}
                                                </a> | {{$app->employee->employee_profile->job_title->name}} | Applied
                                                On: {{$app->created_at}}
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    @endif

                    <td>{{$job->created_at}}</td>
                    <td>{{$job->user->first_name}} {{$job->user->last_name}}</td>
                    @if (!$job->archived)
                    <td class="text-success">Active</td>
                    @else
                    <td class="text-danger">Archived</td>
                    @endif

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('scripts')

<script>
    var username = @json(auth()->user()->first_name . ' ' . auth()->user()->last_name); // Replace this with dynamic username (e.g., from session)
    var currentDate = new Date().toLocaleString(); // Get formatted date

    var table = new DataTable('#jobsTable', {
        dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        pageLength: 20,
        columnDefs: [
            { targets: 4, orderable: false } // Disables sorting for the "Job Category" column
        ],
        "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]], // Defines available page sizes
        fixedColumns: {
            start: 2
        },
        scrollX: true,
        buttons: [
            'copyHtml5',
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':not(.noExport)', // Excludes columns with class "noExport"
                    modifier: {
                            search: 'applied',
                            order: 'applied'
                        },
                },
            },
            'csvHtml5',
            {
                extend: 'pdfHtml5',
                text: 'PDF',
                exportOptions: {
                    columns: ':visible:not(.noExport)',
                    modifier: {
                            search: 'applied',
                            order: 'applied'
                        },
                    
                },
                customize: function(doc) {

                    // rest indexing
                    var tableNode = doc.content[1].table.body;
                    // Loop through table rows and reset numbering in the first column
                    for (var i = 1; i < tableNode.length; i++) {
                        tableNode[i][0].text = i; // Set the first column as the row number
                    }
                    
                    doc['header'] = function(currentPage, pageCount, pageSize) {
                        return [
                            {
                                text: 'Generated by: ' + username + '\n' + currentDate,
                                alignment: 'right',
                                margin: [0, 10, 10, 0], // [left, top, right, bottom]
                                fontSize: 10,
                                italics: true
                            }
                        ];
                    };
                },

                title: 'Egy Finance Jobs | Jobs Report', // Custom title
                orientation: 'landscape', // Use 'portrait' or 'landscape'
                pageSize: 'A4', // Set page size           
            
            },
            { extend: 'colvis', className: 'btn btn-default', text: 'Display' },
        ]
    });

    // Custom filtering function for  Date Posted
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        var datePosted = data[10]; // Date Posted Column
        
        // 👉 Date Range Filtering
        var minDate = $('#minDate').val();
        var maxDate = $('#maxDate').val();
        var jobDate = new Date(datePosted);

        if (minDate && jobDate < new Date(minDate)) return false;
        if (maxDate) {
            var maxDateObj = new Date(maxDate);
            maxDateObj.setDate(maxDateObj.getDate() + 1); // ✅ Fix: Include max date
            if (jobDate >= maxDateObj) return false;
        }

        return true;
    });

    // Custom filtering function for experience range
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        var min = parseInt($('#minExp').val(), 10);
        var max = parseInt($('#maxExp').val(), 10);

        var experienceRange = data[7].split('-'); // Assuming experience is in the 7th column (index 7) Zero Based
        var minExp = parseInt(experienceRange[0], 10);
        var maxExp = parseInt(experienceRange[1], 10);

        if ((isNaN(min) && isNaN(max)) ||  // No filter applied
            (isNaN(min) && max >= minExp) || // Only max filter
            (min <= maxExp && isNaN(max)) || // Only min filter
            (min <= maxExp && max >= minExp)) { // Both min and max filters
            return true;
        }
        return min <= maxExp && max >= minExp;
    });

    // // Function to convert "K" notation to numbers
    // function parseSalary(value) {
    //     value = value.toUpperCase().trim(); // Ensure it's uppercase
    //     if (value.includes("K")) {
    //         return parseInt(value.replace("K", ""), 10) * 1000; // Convert "3K" → 3000
    //     }
    //     return parseInt(value, 10); // Convert normal number
    // }

    // Custom filtering function for salary range
     // Function to convert "K" notation and remove currency
     function parseSalary(value) {
        value = value.replace(/[^\dK-]/g, '').trim(); // Remove currency and keep only numbers, "K", and "-"
        var parts = value.split('-'); // Split min and max salary

        var minSalary = parts[0] ? parts[0].toUpperCase().replace("K", "") * 1000 : 0;
        var maxSalary = parts[1] ? parts[1].toUpperCase().replace("K", "") * 1000 : minSalary; // If no max, use min

        return [parseInt(minSalary, 10), parseInt(maxSalary, 10)];
    }

    // Custom filtering function for salary range
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        var minSalaryInput = parseInt($('#minSalary').val(), 10);
        var maxSalaryInput = parseInt($('#maxSalary').val(), 10);

        var salaryRange = parseSalary(data[8]); // Assuming salary is in the 4th column (index 3)
        var minSalary = salaryRange[0];
        var maxSalary = salaryRange[1];

        if (isNaN(minSalaryInput)) minSalaryInput = -Infinity;
        if (isNaN(maxSalaryInput)) maxSalaryInput = Infinity;

        return minSalaryInput <= maxSalary && maxSalaryInput >= minSalary;
    });


    // Attach event listeners for live filtering when inputs change
    $('#minSalary, #maxSalary, #minExp, #maxExp, #minDate, #maxDate').on('input change', function () {
        table.draw();
    });


    $('#categoryFilter').on('change', function() {
        let columnIndex = 4; // Change this to match the column index
        let filterValue = $(this).val(); // Get selected value from dropdown

        // Apply the filter to DataTable
        table.column(columnIndex).search(filterValue).draw();
    });
</script>
@endsection
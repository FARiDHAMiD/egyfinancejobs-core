@extends('reports.main')
@section('content')
<div class="container-fluid">

    {{-- created at filter --}}
    <div class="d-flex justify-content-center mb-2">

        <div class="row">
            <div class="col-6">
                <input class="form-control form-control-sm m-1" onfocus="(this.type='date')" onblur="(this.type='text')"
                    placeholder="Apps Created From" id="minDate">
            </div>
            <div class="col-6">
                <input class="form-control form-control-sm m-1" onfocus="(this.type='date')" onblur="(this.type='text')"
                    placeholder="Apps Created To" id="maxDate">
            </div>
        </div>
    </div>

    {{-- datatable --}}
    <div class="table-responsive">
        <table id="appsTable" class="table table-hover display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Job Title</th> {{-- grouped by --}}
                    <th>Employee</th>
                    <th>Level</th>
                    <th>Emp Salary</th>
                    <th>Age</th>
                    <th>Mobile</th>
                    <th class="noExport">Skills</th>
                    <th>Applied</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($applications as $app)

                @php
                // employee profile
                $profile = $app->employee->employee_profile
                @endphp

                <tr>
                    <td></td>
                    <td>
                        {{$app->job->job_title}} @ {{$app->job->employer_profile->company_name}} |
                        {{$app->job->city->name}} {{$app->job->country->name}}.
                        {{-- <a target="_blank" href="{{route('website.job-details', $app->job->job_uuid)}}">
                        </a> --}}
                    </td>
                    <td>
                        <a target="_blank" href="{{route('employee.profile.view', $app->employee->uuid)}}">
                            {{$app->employee->first_name}} {{$app->employee->last_name}}
                        </a>
                    </td>
                    <td>{{$profile->career_level->name}}</td>
                    <td>
                        @if($profile->accepted_salary >=1000)
                        {{round($profile->accepted_salary / 1000, 1) .'K'}}
                        @else
                        {{number_format($profile->accepted_salary)}}
                        @endif

                    </td>
                    <td>{{\Carbon\Carbon::parse($profile->birthdate)->age ?? ''}}</td>
                    <td>{{$profile->phone}}</td>

                    <td>
                        <a type="button" class="" data-bs-toggle="modal" data-bs-target="#skillsModal{{$profile->id}}"
                            style="text-decoration: none;">
                            {{$app->employee->employee_skills2->count()}}
                        </a>
                        <div class="modal fade" id="skillsModal{{$profile->id}}" tabindex="-1"
                            aria-labelledby="skillsModal{{$profile->id}}Label" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body text-center">
                                        <ul class="list-group list-group-flush">
                                            @foreach ($app->employee->employee_skills2 as $skill)
                                            <li class="list-group-item">
                                                {{$skill->skill->name}} | {{$skill->skill_level}} |
                                                {{$skill->created_at}}
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
                    <td>{{$app->created_at}}</td>
                    <td>{{$app->application_statu->name}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- datatable --}}
    {{-- <div class="table-responsive">
        <table id="appsTable" class="table table-hover display" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Job Title</th>
                    <th>Company</th>
                    <th>Location</th>
                    <th>Exp</th>
                    <th>Posted</th>
                    <th>Employee</th>
                    <th>Level</th>
                    <th>Emp Salary</th>
                    <th>Age</th>
                    <th>Mobile</th>
                    <th class="noExport">Skills</th>
                    <th>Applied</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($applications as $app)
                @php
                $profile = $app->employee->employee_profile
                @endphp
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <a target="_blank" href="{{route('website.job-details', $app->job->job_uuid)}}">
                            {{$app->job->job_title ?? ''}}
                        </a>
                    </td>
                    <td>
                        <a target="_blank"
                            href="{{route('employer.profile.employer_id', $app->job->employer_profile->employer_id)}}">
                            {{$app->job->employer_profile->company_name}}
                        </a>
                    </td>
                    <td>{{$app->job->city->name}} {{$app->job->country->name}}.</td>
                    <td>{{$app->job->years_experience_from}} - {{$app->job->years_experience_to}}</td>
                    <td>{{$app->job->created_at}}</td>
                    <td>
                        <a target="_blank" href="{{route('employee.profile.view', $app->employee->uuid)}}">
                            {{$app->employee->first_name}} {{$app->employee->last_name}}
                        </a>
                    </td>
                    <td>{{$profile->career_level->name}}</td>
                    <td>
                        @if($profile->accepted_salary >=1000)
                        {{round($profile->accepted_salary / 1000, 1) .'K'}}
                        @else
                        {{number_format($profile->accepted_salary)}}
                        @endif

                    </td>
                    <td>{{\Carbon\Carbon::parse($profile->birthdate)->age ?? ''}}</td>
                    <td>{{$profile->phone}}</td>

                    <td>
                        <a type="button" class="" data-bs-toggle="modal" data-bs-target="#skillsModal{{$profile->id}}"
                            style="text-decoration: none;">
                            {{$app->employee->employee_skills2->count()}}
                        </a>
                        <div class="modal fade" id="skillsModal{{$profile->id}}" tabindex="-1"
                            aria-labelledby="skillsModal{{$profile->id}}Label" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body text-center">
                                        <ul class="list-group list-group-flush">
                                            @foreach ($app->employee->employee_skills2 as $skill)
                                            <li class="list-group-item">
                                                {{$skill->skill->name}} | {{$skill->skill_level}} |
                                                {{$skill->created_at}}
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
                    <td>{{$app->created_at}}</td>
                    <td>{{$app->application_statu->name}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}
</div>
@endsection
@section('scripts')
<script>
    var username = @json(auth()->user()->first_name . ' ' . auth()->user()->last_name); // Replace this with dynamic username (e.g., from session)
    var currentDate = new Date().toLocaleString(); // Get formatted date

    var table = new DataTable('#appsTable', {
        dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        pageLength: 20,
        "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]], // Defines available page sizes
        order: [[1, 'asc']], // Order by Job Title (2nd column)
        rowGroup: {
            dataSrc: 1, // Group by Job Title (2nd column)
            startRender: function(rows, group) {
                // Reset index for each new group
                let index = 1;

                // Add group header with job title
                return $('<tr/>')
                    .append('<td colspan="7" class="group-toggle"><strong>📂 ' + group + '</strong></td>')
                    .attr('class', 'group collapsed')
                    .on('click', function() {
                        var nextRows = $(this).nextUntil('.group');
                        if ($(this).hasClass('collapsed')) {
                            nextRows.show();
                            $(this).removeClass('collapsed').addClass('expanded');
                        } else {
                            nextRows.hide();
                            $(this).removeClass('expanded').addClass('collapsed');
                        }
                    })
                    .after(
                        `<tr class="group-header" style="display:none;">
                            <th>#</th>
                            <th>Company</th>
                            <th>Employee Name</th>
                            <th>Age</th>
                            <th>Experience Level</th>
                            <th>Status</th>
                            <th>Applied Date</th>
                        </tr>`
                    );
            }
        },
        columnDefs: [
            { targets: 1, visible: false }, // Hide Job Title column (used for grouping)
            { orderable: false, targets: 0 } // Disable sorting for the index column
        ],
        drawCallback: function(settings) {
            var api = this.api();
            var lastGroup = null;
            var index = 1; // Index for each group

            api.rows({ page: 'current' }).every(function(rowIdx, tableLoop, rowLoop) {
                var row = this.node();
                var data = this.data();
                var currentGroup = data[1]; // Job Title

                if (lastGroup !== currentGroup) {
                    index = 1; // Reset index for new job title
                    lastGroup = currentGroup;
                }

                $('td:eq(0)', row).html(index++); // Assign index within the group
            });

            $('.group').each(function() {
                $(this).nextUntil('.group').hide(); // Hide all grouped rows initially
            });
        },

        scrollX: true,
        buttons: [
            'copyHtml5',
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':not(.noExport)' // Excludes columns with class "noExport"
                }
            },
            'csvHtml5',
            // pdf
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

                title: 'Egy Finance Jobs | Applications Report', // Custom title
                orientation: 'portrait', // Use 'portrait' or 'landscape'
                pageSize: 'A4', // Set page size           
            
            },
            // show/hide columns 
            { extend: 'colvis', className: 'btn btn-default', text: 'Display' },
        ]
    });

     // Show headers when expanding a group
     $(document).on('click', '.group', function() {
        var headerRow = $(this).next('.group-header');
        headerRow.toggle();
    });

    // Convert "YYYY-MM-DD HH:mm:ss" (e.g., "2025-02-14 20:38:00") to JavaScript Date
    function parseDate(dateString) {
        if (!dateString || typeof dateString !== "string") return null;

        console.log("Parsing Date String:", dateString.trim()); // Debugging

        var dateTimeParts = dateString.trim().split(" "); // Trim and split into date + time
        var dateParts = dateTimeParts[0].split("-"); // Extract date part

        if (dateParts.length !== 3) return null; // Ensure correct date format

        var year = parseInt(dateParts[0], 10);
        var month = parseInt(dateParts[1], 10) - 1; // JS months are 0-based
        var day = parseInt(dateParts[2], 10);

        var parsedDate = new Date(year, month, day);

        console.log("Converted to JS Date:", parsedDate); // Debugging

        return isNaN(parsedDate.getTime()) ? null : parsedDate;
    }

    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        var min = $('#minDate').val(); // Get min date input (YYYY-MM-DD)
        var max = $('#maxDate').val(); // Get max date input (YYYY-MM-DD)
        var rowDate = parseDate(data[8]); // Assuming column index 6 contains the datetime

        if (!rowDate) return false;

        // Convert rowDate to local "YYYY-MM-DD" format (NO timezone shift)
        var rowDateOnly = rowDate.getFullYear() + '-' + 
                        String(rowDate.getMonth() + 1).padStart(2, '0') + '-' +
                        String(rowDate.getDate()).padStart(2, '0');

        console.log("Filtering - Min:", min, "Max:", max, "RowDate:", rowDateOnly); // Debugging

        return (!min || rowDateOnly >= min) && (!max || rowDateOnly <= max);
    });


    // Trigger filter when date inputs change
    $('#minDate, #maxDate').on('change', function () {
        table.draw();
    });

</script>

@endsection
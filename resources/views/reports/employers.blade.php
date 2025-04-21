@extends('reports.main')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-center mb-2">

        <div class="row">
            {{-- created date range filter --}}
            <div class="col-6">
                <input class="form-control form-control-sm m-1" onfocus="(this.type='date')" onblur="(this.type='text')"
                    placeholder="Created From" id="minDate">
            </div>
            <div class="col-6">
                <input class="form-control form-control-sm m-1" onfocus="(this.type='date')" onblur="(this.type='text')"
                    placeholder="Created To" id="maxDate">
            </div>
        </div>
    </div>

    {{-- Datatable --}}
    <div class="table-responsive">
        <table id="employersTable" class="table table-hover display" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Company Name</th>
                    <th>Industry</th>
                    <th>Size</th>
                    <th>Location</th>
                    <th class="noExport">Admin
                        <select id="adminFilter" class="form-select form-select-sm">
                            <option value="">All</option>
                            @foreach ($admins as $admin)
                            <option value="{{$admin->first_name}} {{$admin->first_name}}">
                                {{$admin->first_name}} {{$admin->last_name}}
                            </option>
                            @endforeach
                        </select>
                    </th>
                    <th>Created</th>
                    <th>Featured</th>
                    <th>Jobs</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employers as $employer)
                @php $profile = $employer->employer_profile; @endphp
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <a target="_blank" href="{{route('employer.profile', $employer->uuid)}}">
                            {{$employer->first_name}}
                        </a>
                    </td>
                    <td>{{$profile->industry->name ?? ''}}</td>
                    <td>{{$profile->company_size ?? ''}}</td>
                    <td>{{$profile->city->name ?? ''}}, {{$profile->country->name ?? ''}}</td>
                    <td class="created-by">
                        {{$profile->user_created->first_name ?? ''}} {{$profile->user_created->last_name ?? ''}}
                    </td>
                    <td class="text-nowrap" data-order="{{ $employer->created_at->timestamp }}">
                        {{$employer->created_at->format('d-M-Y')}}
                    </td>
                    @if($profile && $profile->featured)
                    <td class="text-success text-center"><i class="fa fa-check"></i></td>
                    @else
                    <td></td>
                    @endif
                    <td>

                        <a type="button" class="" data-bs-toggle="modal" data-bs-target="#jobModal{{$employer->id}}"
                            style="text-decoration: none;">
                            {{$employer->employer_jobs->count()}}
                        </a>
                        <div class="modal fade" id="jobModal{{$employer->id}}" tabindex="-1"
                            aria-labelledby="jobModalLabel{{$employer->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body text-center">
                                        <ul class="list-group list-group-flush">
                                            @foreach ($employer->employer_jobs as $job)
                                            <li class="list-group-item">
                                                <a target="_blank"
                                                    href="{{route('website.job-details', $job->job_uuid)}}">
                                                    {{$job->job_title}}
                                                </a>
                                                | {{$job->country->name}}, {{$job->city->name ?? ''}} |
                                                {{$job->created_at}} |
                                                {{$job->user->first_name}}_{{$job->user->last_name}}
                                                @if($job->archived) | <span class="text-danger">Archived!</span>@endif
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

    var table = new DataTable('#employersTable', {
        dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        pageLength: 20,
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

                title: 'Egy Finance Jobs | Companies Report', // Custom title
                orientation: 'portrait', // Use 'portrait' or 'landscape'
                pageSize: 'A4', // Set page size           
            
            },
            { extend: 'colvis', className: 'btn btn-default', text: 'Display' },
        ],
        columnDefs: [
            { orderable: false, targets: 5 } // Disables sorting on the admin column
        ]
    });

    // Convert "d-m-y" (e.g., "12-02-25") to JavaScript Date
    function parseDate(dateString) {
        var parts = dateString.split("-"); // Split "12-Feb-2025" → ["12", "Feb", "2025"]
        var day = parseInt(parts[0], 10);
        var month = new Date(Date.parse(parts[1] + " 1, 2000")).getMonth(); // Convert "Feb" to 1 (February)
        var year = parseInt(parts[2], 10); // Extract the full year

        return new Date(year, month, day);
    }

    // Date filter function
    function filterByDate(createdDate) {
        var minDate = $('#minDate').val() ? new Date($('#minDate').val()) : null;
        var maxDate = $('#maxDate').val() ? new Date($('#maxDate').val()) : null;
        var rowDate = parseDate(createdDate); // Convert table date to Date object

        return (!minDate && !maxDate) || 
               (!minDate && rowDate <= maxDate) ||
               (minDate <= rowDate && !maxDate) ||
               (minDate <= rowDate && rowDate <= maxDate);
    }

    // Custom DataTables filtering function
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        var createdDate = data[6]; // Created date column (index 7)
        return filterByDate(createdDate);
    });

    // Attach event listeners to inputs
    $('#minDate, #maxDate').on('input change', function () {
        table.draw();
    });

   // Apply filtering when dropdown value changes
   $('#adminFilter').on('change', function () {
        let selectedValue = $(this).val(); // Get selected value
        table.column(5).search(selectedValue).draw(); // Filter Role column (Index 5)
    });
    
</script>
@endsection
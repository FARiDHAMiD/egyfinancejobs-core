@extends('reports.main')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-center mb-2">

        <div class="row">
            <div class="col-6">
                <input class="form-control form-control-sm m-1" onfocus="(this.type='date')" onblur="(this.type='text')"
                    placeholder="Profile Created From" id="minDate">
            </div>
            <div class="col-6">
                <input class="form-control form-control-sm m-1" onfocus="(this.type='date')" onblur="(this.type='text')"
                    placeholder="Profile Created To" id="maxDate">
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table id="instructors" class="table table-hover display" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Job Title</th>
                    <th>Age</th>
                    <th>DOB</th>
                    <th>Qualification</th>
                    <th>address</th>
                    <th>Mobile</th>
                    <th>Created</th>
                    <th>Status</th>
                    <th>Courses</th>
                    <th class="noExport">Total Enrolls</th>
                </tr>
            </thead>
            <tbody>
                @php $index = 1; @endphp
                @foreach ($instructors as $instructor)
                @php $profile = $instructor->instructor_profile; @endphp
                @if ($profile)
                <tr>
                    <td>{{ $index++ }}</td> {{-- Increments only when a row is added --}}
                    <td>
                        <a target="_blank" href="{{route('courses.instructorProfile', $instructor->uuid)}}"
                            style="text-decoration: none;">

                            {{$instructor->first_name}} {{$instructor->last_name}}
                        </a>
                    </td>
                    <td>{{$profile->job_title}}</td>
                    <td>{{\Carbon\Carbon::parse($profile->birthdate)->age ?? ''}}</td>
                    <td data-order="{{ $profile->birthdate }}">
                        {{date('d-m-Y', strtotime($profile->birthdate))}}
                    </td>
                    <td>{{$profile->qualification}}</td>
                    <td>{{$profile->address}}</td>
                    <td>{{$profile->mobile}}</td>
                    <td data-order="{{ $instructor->created_at->timestamp }}">
                        {{$instructor->created_at->format('d-m-y')}}
                    </td>
                    @if($profile->active)
                    <td class="text-success">Active</td>
                    @else
                    <td class="text-danger">Disabled</td>
                    @endif
                    <td>
                        <a target="_blank" href="{{route('courses.instructorProfile', $instructor->uuid)}}">
                            {{$instructor->instructor_courses->count()}}
                        </a>
                    </td>
                    <td>
                        <a type="button" class="" data-bs-toggle="modal"
                            data-bs-target="#educationModal{{$instructor->id}}" style="text-decoration: none;">
                            {{$instructor->instructor_courses->sum(fn($item) => $item->enrolls->count())}}
                        </a>

                        <div class="modal fade" id="educationModal{{$instructor->id}}" tabindex="-1"
                            aria-labelledby="educationModalLabel{{$instructor->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body text-center">
                                        <ul class="list-group list-group-flush">
                                            @foreach ($instructor->instructor_courses as $item)
                                            <li class="list-group-item">
                                                <h5 class="text-primary">
                                                    {{$item->name}} | {{$item->enrolls->count()}} Students
                                                </h5>
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Student</th>
                                                            <th>Status</th>
                                                            <th>Enroll Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($item->enrolls as $enroll)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td class="text-nowrap">{{$enroll->student->first_name}}
                                                                {{$enroll->student->last_name}}</td>
                                                            <td class="text-success">{{$enroll->enroll_statu ?
                                                                'Approved' : ''}}</td>
                                                            <td>{{$enroll->created_at}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
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
                @endif


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

    var table = new DataTable('#instructors', {
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

                title: 'Egy Finance Jobs | Instructors Report', // Custom title
                orientation: 'portrait', // Use 'portrait' or 'landscape'
                pageSize: 'A4', // Set page size           
            
            },
            // show/hide columns 
            { extend: 'colvis', className: 'btn btn-default', text: 'Display' },
        ]
    });

    // Convert date from "d-m-Y" to a JavaScript Date object
    // Convert "d-m-y" (e.g., "12-02-25") to JavaScript Date
    function parseDate(dateString) {
        var parts = dateString.split("-"); // Split "12-02-25" → ["12", "02", "25"]
        var day = parseInt(parts[0], 10);
        var month = parseInt(parts[1], 10) - 1; // Months are 0-based in JS
        var year = parseInt(parts[2], 10) + 2000; // Always assume 20XX

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
        var createdDate = data[8]; // Created date column (index 12)
        return  filterByDate(createdDate);
    });

    // Attach event listeners to inputs
    $('#minDate, #maxDate').on('keyup change', function () {
        table.draw();
    });

</script>

@endsection
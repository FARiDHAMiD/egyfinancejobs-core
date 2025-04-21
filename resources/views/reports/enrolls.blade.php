@extends('reports.main')
@section('content')
<div class="container-fluid">

    <div class="table-responsive">
        {{-- <table id="enrolls" class="table table-hover display" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    <th>Course</th>
                    <th>Enroll Date</th>
                    <th>Status</th>
                    <th>Approved By</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($enrolls as $enroll)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><a target="_blank" href="{{route('courses.profile', $enroll->student->uuid)}}">
                            {{$enroll->student->first_name}} {{$enroll->student->last_name}}
                        </a>
                    </td>
                    <td>
                        <a target="_blank" href="{{route('courses.show', $enroll->course->uuid)}}">
                            {{$enroll->course->name}}
                        </a>
                    </td>
                    <td>{{$enroll->created_at}}</td>
                    <td class="text-success">{{$enroll->enroll_statu ? 'Approved' : ''}}</td>
                    @if($enroll->accepted_by)
                    <td>{{$enroll->user->first_name}} {{$enroll->user->last_name}}</td>
                    @else
                    <td>Pending...</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table> --}}
        {{-- table grouped by student --}}
        <table id="enrolls" class="table table-hover display" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    <th>Course</th>
                    <th>Enroll Date</th>
                    <th>Status</th>
                    <th>Approved By</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)

                @foreach ($student->courses as $item)
                <tr>
                    <td></td> <!-- Index will be auto-filled by DataTables -->
                    <td class="text-nowrap">
                        <a target="_blank" href="{{route('courses.profile', $student->uuid)}}">
                            {{ $student->first_name }} {{ $student->last_name }} |
                            {{$student->employee_profile->job_title->name ?? ''}} |
                            {{$student->employee_profile->phone ?? ''}}
                        </a>
                    </td>
                    <td>
                        <a target="_blank" href="{{route('courses.show', $item->course->uuid)}}">
                            {{ $item->course->name }}
                        </a>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</td>
                    <td>{{ $item->enroll_statu ? 'Approved' : 'Pending' }}</td>
                    <td>{{$item->user->first_name ?? ''}} {{$item->user->last_name ?? ''}}</td>
                </tr>
                @endforeach
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

    var table = new DataTable('#enrolls', {
        dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        pageLength: 20,
        "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]], // Defines available page sizes
        fixedColumns: {
            start: 2
        },
        "info": false,
        "rowGroup": {
            dataSrc: 1 // Group by Student Name (Second Column)
        },
        "columnDefs": [
            { "visible": false, "targets": 1 }, // Hide "Student Name" column
            { "searchable": false, "orderable": false, "targets": 0 } // Disable sorting on index column
        ],
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
                    format: {
                        body: function (data, row, column, node) {
                            return $(node).text().trim(); // Remove HTML tags
                        }
                    },
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
                
                customize: function (doc) {
                    var rowGroup = table.rowGroup().dataSrc();
                    var body = doc.content[1].table.body;

                    // Insert Student Name before each grouped row
                    var lastGroup = null;
                    for (var i = body.length - 1; i >= 1; i--) {
                        var row = table.row(i-1).data();
                        if (row && $(row[1]).text().trim() !== lastGroup) {
                            body.splice(i, 0, [{ text: $(row[1]).text().trim(), bold: true, colSpan: 4, alignment: 'center', noWrap: true }, {}, {}, {}, {}]);
                            lastGroup = $(row[1]).text().trim();
                        }
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


                title: 'Egy Finance Jobs | Courses Enrolls Report', // Custom title
                orientation: 'portrait', // Use 'portrait' or 'landscape'
                pageSize: 'A4', // Set page size           
            
            },
            { extend: 'colvis', className: 'btn btn-default', text: 'Display' },
        ]
    });

    table.on('order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
    
</script>


@endsection
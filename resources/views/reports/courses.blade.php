@extends('reports.main')
@section('content')
<div class="container-fluid">

    <div class="table-responsive">
        <table id="courses" class="table table-hover display" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Course Title</th>
                    <th>Instructor</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Period</th>
                    <th>Featured</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Created</th>
                    <th>Enrolls</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)

                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <a target="_blank" href="{{route('courses.show', $course->uuid)}}">

                            {{$course->name}}
                        </a>
                    </td>
                    <td>
                        <a target="_blank"
                            href="{{route('courses.instructorProfile', $course->user_instructor->uuid ?? '')}}">
                            {{$course->user_instructor->first_name ?? ''}}
                            {{$course->user_instructor->last_name ?? ''}}
                        </a>
                    </td>
                    <td>{{$course->price ?? 'N/A'}}</td>
                    <td>{{$course->statu->name}}</td>
                    <td class="text-nowrap">{{date('d-M-y', strtotime($course->start_date))}}</td>
                    <td class="text-nowrap">{{date('d-M-y', strtotime($course->end_date))}}</td>
                    <td>
                        {{
                        round(
                        \Carbon\Carbon::parse($course->start_date)
                        ->diffInDays(\Carbon\Carbon::parse($course->end_date)) / 30
                        ) < 1 ? \Carbon\Carbon::parse($course->start_date)
                            ->diffInDays(\Carbon\Carbon::parse($course->end_date)) . ' Days' :
                            round(\Carbon\Carbon::parse($course->start_date)
                            ->diffInDays(\Carbon\Carbon::parse($course->end_date))
                            / 30) . ' Months'
                            }}
                    </td>
                    <td class="text-success">{{$course->featured ? 'Featured' : ''}}</td>
                    <td>{{$course->cat->name}}</td>
                    <td>{{$course->type->name}}</td>
                    <td class="text-nowrap">{{date('d-M-y', strtotime($course->created_at))}}</td>
                    <td>
                        <a target="_blank" href="{{route('courses.show', $course->uuid ?? '')}}">

                            {{$course->enrolls->count()}}
                        </a>
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

    new DataTable('#courses', {
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

                title: 'Egy Finance Jobs | Courses Report', // Custom title
                orientation: 'landcape', // Use 'portrait' or 'landscape'
                pageSize: 'A4', // Set page size           
            
            },
            { extend: 'colvis', className: 'btn btn-default', text: 'Display' },
        ]
    });
</script>

@endsection
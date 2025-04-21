@extends('reports.main')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-end mb-2">

        <div class="row">
            <div class="col-md-2 col-6">
                <input class="form-control form-control-sm m-1" type="number" id="minAge" placeholder="Min. Age"
                    min="0">
            </div>
            <div class="col-md-2 col-6">

                <input class="form-control form-control-sm m-1" type="number" id="maxAge" placeholder="Max. Age"
                    min="0">
            </div>

            <div class="col-md-2 col-6">
                <input class="form-control form-control-sm m-1" type="number" id="minSalary" placeholder="Min. Salary">
            </div>
            <div class="col-md-2 col-6">
                <input class="form-control form-control-sm m-1" type="number" id="maxSalary" placeholder="Max. Salary">
            </div>


            <div class="col-md-2 col-6">
                <input class="form-control form-control-sm m-1" onfocus="(this.type='date')" onblur="(this.type='text')"
                    placeholder="Profile Created From" id="minDate">
            </div>
            <div class="col-md-2 col-6">
                <input class="form-control form-control-sm m-1" onfocus="(this.type='date')" onblur="(this.type='text')"
                    placeholder="Profile Created To" id="maxDate">
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table id="employees" class="table table-hover display" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Job Title</th>
                    <th>Age</th>
                    <th>DOB</th>
                    <th>Career Level</th>
                    <th>Salary</th>
                    <th>Education</th>
                    <th>Location</th>
                    <th>Phone</th>
                    <th>Martial</th>
                    <th>Profile Date</th>
                    <th class="noExport">Jobs</th>
                    <th class="noExport">Courses</th>
                    <th class="noExport">Skills</th>
                    <th>Featured</th>
                </tr>
            </thead>
            <tbody>
                @php $index = 1; @endphp
                @foreach ($employees as $employee)
                @php $profile = $employee->employee_profile; @endphp
                @if ($profile)
                <tr>
                    <td>{{ $index++ }}</td> {{-- Increments only when a row is added --}}
                    <td>
                        <a target="_blank" href="{{route('employee.profile.view', $employee->uuid)}}"
                            style="text-decoration: none;">

                            {{$employee->first_name}} {{$employee->last_name}}
                        </a>
                    </td>
                    <td>{{$profile->job_title->name}}</td>
                    <td>{{\Carbon\Carbon::parse($profile->birthdate)->age ?? ''}}</td>
                    <td data-order="{{ $profile->birthdate }}">
                        {{date('d-m-Y', strtotime($profile->birthdate));}}
                    </td>
                    <td>{{$profile->career_level->name}}</td>
                    <td>
                        @if($profile->accepted_salary >=1000)
                        {{round($profile->accepted_salary / 1000, 1) .'K'}}
                        @else
                        {{number_format($profile->accepted_salary)}}
                        @endif
                    </td>

                    <td class="noExport">
                        <a type="button" class="" data-bs-toggle="modal"
                            data-bs-target="#educationModal{{$employee->id}}" style="text-decoration: none;">
                            {{$employee->employee_educations->count()}}
                        </a>
                        <div class="modal fade" id="educationModal{{$employee->id}}" tabindex="-1"
                            aria-labelledby="educationModalLabel{{$employee->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body text-center">
                                        <ul class="list-group list-group-flush">
                                            @foreach ($employee->employee_educations as $item)
                                            <li class="list-group-item">
                                                {{$item->education_level->name}} | {{$item->degree_details}} |
                                                {{$item->university->name}} |
                                                {{date('d-M-Y', strtotime($item->degree_date))}} | {{$item->grade}}
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
                    <td>{{$profile->city->name ?? ''}} {{$profile->country->name}}.</td>
                    <td>{{$profile->phone}}</td>
                    <td>{{$profile->marital_status}}</td>
                    <td data-order="{{ $employee->created_at->timestamp }}">
                        {{$employee->created_at->format('d-m-y')}}
                    </td>
                    <td><a target="_blank" href="{{route('admin.employee.applications', $employee->id)}}"
                            style="text-decoration: none;">
                            {{$employee->applied_jobs->count()}}</a></td>
                    <td>
                        <a target="_blank" href="{{route('courses.profile', $employee->uuid)}}"
                            style="text-decoration: none;">
                            {{$employee->courses->count()}}
                        </a>
                    </td>

                    <td class="noExport">
                        <a type="button" class="" data-bs-toggle="modal" data-bs-target="#skillsModal{{$employee->id}}"
                            style="text-decoration: none;">
                            {{$employee->employee_skills2->count()}}
                        </a>
                        <div class="modal fade" id="skillsModal{{$employee->id}}" tabindex="-1"
                            aria-labelledby="skillsModal{{$employee->id}}Label" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body text-center">
                                        <ul class="list-group list-group-flush">
                                            @foreach ($employee->employee_skills2 as $skill)
                                            <li class="list-group-item">
                                                {{$skill->skill->name ?? ''}} | {{$skill->skill_level}} |
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
                    @if ($employee->featured)
                    <td class="text-success">Featured!</td>
                    @else
                    <td></td>
                    @endif

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

    var table = new DataTable('#employees', {
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

                title: 'Egy Finance Jobs | Employees Report', // Custom title
                orientation: 'landscape', // Use 'portrait' or 'landscape'
                pageSize: 'A4', // Set page size           
            
            },
            // show/hide columns 
            { extend: 'colvis', className: 'btn btn-default', text: 'Display' },
        ]
    });

     // Convert salary string (e.g., "5K" → 5000)
     function parseSalary(salary) {
        if (salary.includes("K")) {
            return parseFloat(salary.replace("K", "")) * 1000;
        }
        return parseFloat(salary) || 0;
    }

    // Convert date from "d-m-Y" to a JavaScript Date object
    // Convert "d-m-y" (e.g., "12-02-25") to JavaScript Date
    function parseDate(dateString) {
        var parts = dateString.split("-"); // Split "12-02-25" → ["12", "02", "25"]
        var day = parseInt(parts[0], 10);
        var month = parseInt(parts[1], 10) - 1; // Months are 0-based in JS
        var year = parseInt(parts[2], 10) + 2000; // Always assume 20XX

        return new Date(year, month, day);
    }

    // Age filter function
    function filterByAge(age) {
        var minAge = parseInt($('#minAge').val(), 10);
        var maxAge = parseInt($('#maxAge').val(), 10);

        return (isNaN(minAge) && isNaN(maxAge)) || 
               (isNaN(minAge) && age <= maxAge) ||
               (minAge <= age && isNaN(maxAge)) ||
               (minAge <= age && age <= maxAge);
    }

    // Salary filter function
    function filterBySalary(salary) {
        var minSalary = parseInt($('#minSalary').val(), 10);
        var maxSalary = parseInt($('#maxSalary').val(), 10);

        return (isNaN(minSalary) && isNaN(maxSalary)) || 
               (isNaN(minSalary) && salary <= maxSalary) ||
               (minSalary <= salary && isNaN(maxSalary)) ||
               (minSalary <= salary && salary <= maxSalary);
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
        var age = parseFloat(data[3]) || 0; // Age column (index 4)
        var salary = parseSalary(data[6]); // Salary column (index 7)
        var createdDate = data[11]; // Created date column (index 12)

        return filterByAge(age) && filterBySalary(salary) && filterByDate(createdDate);
    });

    // Attach event listeners to inputs
    $('#minAge, #maxAge, #minSalary, #maxSalary, #minDate, #maxDate').on('keyup change', function () {
        table.draw();
    });

</script>

@endsection
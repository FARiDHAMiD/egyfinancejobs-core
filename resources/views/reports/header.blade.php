<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="{{ url('/website') }}/css/bootstrap-5.3.3.min.css">
        <link rel="stylesheet" type="text/css" href="{{ url('/website') }}/css/reportsDatatables.css">
        <link rel="stylesheet" type="text/css" href="{{ url('/website') }}/css/buttons.dataTables.css">
        <link rel="stylesheet" type="text/css" href="{{ url('/website') }}/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="{{ url('/website') }}/css/rowGroup.dataTables.min.css">
        {{--
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"> --}}
        <title>Reports</title>
</head>
<style>
        a {
                text-decoration: none;
        }
</style>
<div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
                <a href="/reports"
                        class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                        <span class="fs-4" style="font-weight: bold">Reports</span>
                </a>
                <ul class="nav nav-pills">
                        <li class="nav-item"><a href="{{route('reports.index')}}"
                                        class="nav-link @if ($page == 'main') active @endif"
                                        aria-current="page">Main</a></li>
                        <li class="nav-item"><a href="{{route('reports.users')}}"
                                        class="nav-link @if ($page == 'users') active @endif">Users</a></li>
                        <li class="nav-item"><a href="{{route('reports.jobs')}}"
                                        class="nav-link @if ($page == 'jobs') active @endif">Jobs</a></li>
                        <li class="nav-item"><a href="{{route('reports.employees')}}"
                                        class="nav-link @if ($page == 'employees') active @endif">Employees</a></li>
                        <li class="nav-item"><a href="{{route('reports.employers')}}"
                                        class="nav-link @if ($page == 'employers') active @endif">Companies</a></li>
                        <li class="nav-item"><a href="{{route('reports.apps')}}"
                                        class="nav-link @if ($page == 'apps') active @endif">Applications</a></li>
                        <li class="nav-item"><a href="{{route('reports.courses')}}"
                                        class="nav-link @if ($page == 'courses') active @endif">Courses</a></li>
                        <li class="nav-item"><a href="{{route('reports.instructors')}}"
                                        class="nav-link @if ($page == 'instructors') active @endif">Instructors</a></li>
                        <li class="nav-item"><a href="{{route('reports.enrolls')}}"
                                        class="nav-link @if ($page == 'enrolls') active @endif">Enrolls</a></li>
                        <li class="nav-item"><a href="{{route('reports.advanced')}}"
                                        class="nav-link @if ($page == 'advanced') active @endif">Advanced</a></li>

                </ul>
        </header>
</div>
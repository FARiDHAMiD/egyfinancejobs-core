@extends('reports.main')
@section('content')

<div class="container-fluid">
    <div class="table-responsive">
        <table id="example" class="table table-hover display" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users->where('email') as $user)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        @switch(implode(', ', $user->roles->pluck('name')->toArray()))
                        @case('admin')
                        <a target="_blank" href="{{route('admins.edit', $user->id)}}" style="text-decoration: none">
                            {{$user->first_name}} {{$user->last_name}}
                        </a>
                        @break
                        @case('employee')
                        @if ($user->employee_profile)

                        <a target="_blank" href="{{route('employee.profile.view', $user->uuid)}}"
                            style="text-decoration: none">
                            {{$user->first_name}} {{$user->last_name}}
                        </a>
                        @else
                        {{$user->first_name}} {{$user->last_name}}
                        @endif
                        @break
                        @case('employer')
                        <a target="_blank" href="{{route('employer.profile', $user->uuid)}}"
                            style="text-decoration: none">
                            {{$user->first_name}} {{$user->last_name}}
                        </a>

                        @break
                        @case('instructor')
                        <a target="_blank" href="{{route('courses.instructorProfile', $user->uuid)}}"
                            style="text-decoration: none">
                            {{$user->first_name}} {{$user->last_name}}
                        </a>

                        @break
                        @default

                        @endswitch
                    </td>
                    <td>{{$user->email}}</td>
                    <td>{{implode(', ', $user->roles->pluck('name')->toArray())}}</td>
                    <td data-order="{{ $user->created_at->timestamp }}">
                        {{$user->created_at->format('d-M-Y')}}
                    </td>
                    <td>
                        @switch($user->roles[0]->id)
                        @case(1)
                        <span class="text-info">Admin</span>
                        @break
                        @case(3)
                        @if($user->employee_profile)
                        <span class="text-success">Completed</span>
                        @else
                        <span class="text-warning">Uncompleted</span>
                        @endif
                        @break
                        @case(4)
                        @if($user->instructor_profile && $user->instructor_profile->active)
                        <span class="text-success">Active</span>
                        @else
                        <span class="text-danger">Not Active</span>
                        @endif
                        @break
                        @default

                        @endswitch
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
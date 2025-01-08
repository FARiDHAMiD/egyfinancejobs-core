@extends('admin.app')
@section('admin.content')
<div class="container-fluid">
    {{-- start filter --}}
    <style>
        #search-form input,
        #search-form select {
            color: #000;
            font-weight: bold;
        }

        .filter-sec {
            border: 1px solid #b4c1e5;
            border-bottom: 2px solid #476dda;
            border-radius: 0;
        }

        .b-sharp {
            border-radius: 0;
        }
    </style>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary">Contact Us Inqueries ({{$contacts->count()}})
                    </h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>On</th>
                            <th>Inquery</th>
                            <th>Replied by</th>
                            <th>Reply</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($contacts as $contact)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$contact->name}}</td>
                            <td class="text-nowrap">{{date('d-M', strtotime($contact->created_at))}}</td>
                            <td>{{substr($contact->description, 0, 80)}}...</td>
                            @if($contact->user_id)
                            <td>{{$contact->user->first_name}} {{$contact->user->last_name}}</td>
                            @else
                            <td>Pending</td>
                            @endif
                            <td class="text-nowrap">
                                <a href="{{ route('contact_us.edit', $contact->id) }}" class="btn btn-info btn-sm m-1">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form method="post" class="d-inline"
                                    action="{{ route('contact_us.destroy', $contact->id) }}">
                                    @method('delete')
                                    @csrf
                                    <button onclick="return confirm('Are you sure you want to delete this?')"
                                        class="btn btn-danger btn-sm m-1" type="submit">
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
</div>
@endsection
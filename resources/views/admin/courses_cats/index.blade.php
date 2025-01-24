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
                    <h6 class="m-0 font-weight-bold text-primary">CATs ({{$cats->count()}})
                    </h6>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('cats.create') }}" class="btn btn-info btn-sm">
                        <i class="fas fa-plus"></i> Add New Category
                    </a>
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
                            <th>Total Courses</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($cats as $cat)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                {{$cat->name}}
                            </td>
                            <td>---</td>
                            <td>
                                <a href="{{ route('cats.edit', $cat->id) }}" class="btn btn-info btn-sm m-1">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form method="post" class="d-inline" action="{{ route('cats.destroy', $cat->id) }}">
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
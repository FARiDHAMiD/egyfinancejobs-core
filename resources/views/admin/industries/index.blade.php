@extends('admin.app')
@section('admin.content')
    <div class="container-fluid">
        {{-- start filter --}}
        <style>
            #search-form input, #search-form select{
                color: #000;
                font-weight: bold;
            }
            .filter-sec{
                border: 1px solid #b4c1e5;
                border-bottom: 2px solid #476dda;
                border-radius: 0;
            }
            .b-sharp{
                border-radius: 0;
            }
        </style>
        <div class="card shadow mb-4 filter-sec">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="m-0 font-weight-bold text-primary">Filter Options:</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="" method="get" id="search-form">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control b-sharp" name="name" value="{{@$search['name']}}" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success b-sharp" style="width: 100%;">Search</button>
                        </div>
                        <div class="col-md-2">
                            <a href="{{\Request::url()}}" class="btn btn-info b-sharp" style="width: 100%;">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-6">
                        <h6 class="m-0 font-weight-bold text-primary">Industries ({{$industries->count()}})</h6>
                    </div>
                    <div class="col-6 text-right"> 
                        <a href="{{ route('industries.create') }}" class="btn btn-info btn-sm">
                            <i class="fas fa-plus"></i> Add new industry
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Industry</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Industry</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach ($industries as $industry)
                                <tr>
                                    <td>{{$industry->name}}</td>

                                    <td>
                                        <a href="{{ route('industries.edit', $industry->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form method="post" class="d-inline" action="{{ route('industries.destroy', $industry->id) }}">
                                            @method('delete')
                                            @csrf
                                            <button onclick="return confirm('Are you sure you want to delete this?')"  class="btn btn-danger btn-sm" type="submit">
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

@extends('admin.app')
@section('admin.content')
<div class="container-fluid">
    <form action="{{ route('currencies.store') }}" class="mb-5" method="post">
        @method('post')
        @csrf
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="text-dark"><strong>Currency Name</strong></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror "
                                value="{{ old('name')}}">
                            @error('name')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="text-dark"><strong>Currency Unicode</strong></label>
                            <select name="unicode" class="form-control @error('unicode') is-invalid @enderror ">
                                <option value="">chose currency unicode</option>
                            </select>
                            @error('unicode')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4 justify-content-center">
            <div class="col-md-6">
                <button type="submit" class="btn btn-info  w-100">
                    <i class="fas fa-save"></i> save
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
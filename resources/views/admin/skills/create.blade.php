@extends('admin.app')
@section('admin.content')
    <div class="container-fluid">
        <form enctype="multipart/form-data" action="{{ route('skills.store') }}" class="mb-5" method="post">
            @method('post')
            @csrf
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6"> 
                            <div class="mb-3">
                                <label class="text-dark"><strong>Skill Name</strong></label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror "
                                    value="{{ old('name')}}">
                                @error('name')
                                    <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-dark"><strong>Skill Category</strong></label>
                                <select name="category" class="form-control @error('category') is-invalid @enderror ">
                                    <option value="">chose skill category</option>
                                    <option {{ old('category') == 'language' ? 'selected' : '' }} value="language">language
                                    </option>
                                    <option {{ old('category') == 'technical' ? 'selected' : '' }} value="technical">
                                        technical
                                    </option>
                                    <option {{ old('category') == 'technology' ? 'selected' : '' }} value="technology">
                                        technology</option>
                                    <option {{ old('category') == 'soft' ? 'selected' : '' }} value="soft">soft</option>
                                </select>
                                @error('category')
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

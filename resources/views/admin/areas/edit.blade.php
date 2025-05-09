@extends('admin.app')
@section('admin.content')
    <div class="container-fluid">
        <form enctype="multipart/form-data" action="{{ route('areas.update' , $area->id) }}" class="mb-5" method="post">
            @method('put')
            @csrf
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3"> 
                                <label class="text-dark"><strong>Country</strong></label>
                                <select type="text" name="country_id" class="form-control country-selection @error('country_id') is-invalid @enderror "> 
                                    <option value="">select country</option>
                                    @foreach ($countries as $country)
                                        <option
                                            {{ $area->country_id == $country->id ? 'selected' : '' }}
                                            value="{{ $country->id }}">{{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                    <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3"> 
                                <label class="text-dark"><strong>City</strong></label>
                                <select type="text" name="city_id" class="form-control city-selection @error('city_id') is-invalid @enderror">
                                    <option value="" >Select City</option>
                                    @foreach ($cities as $city)
                                        <option {{ $area->city_id == $city->id ? 'selected' : '' }}
                                            value="{{ $city->id }}"
                                            data-country-id="{{ $city->country_id }}">
                                            {{ $city->name }}</option>
                                    @endforeach
                                </select>
                                @error('city_id')
                                    <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="text-dark"><strong>Area Name</strong></label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror "
                                    value="{{ $area->name}}">
                                @error('name')
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

@extends('admin.app')
@section('admin.content')
<div class="container-fluid">
    <form action="{{ route('contact_us.update', $contact->id ?? 'contact_u') }}" class="mb-5" method="post">
        @method('put')
        @csrf
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="card-header">
                        <h5 class="text-primary">{{$contact->name}} | {{$contact->mobile}} | {{$contact->email}}</h5>
                        <h6 class="text-muted">Sent On {{$contact->created_at}}</h6>
                    </div>
                    <div class="col-md-12 my-2">
                        <div class="mb-2">
                            <label class="text-dark"><strong>Inquery</strong></label>
                            <div class="modal-body">
                                {{$contact->description}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-2">
                            <label class="text-dark"><strong>Reply <span class="text-muted">(This reply will be stored
                                        for later reviewing - nothing will be sent to client)</span></strong></label>
                            <textarea name="reply" class="form-control @error('reply') is-invalid @enderror " cols="30"
                                rows="3">{{$contact->reply}}</textarea>
                            @error('reply')
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
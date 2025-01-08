@extends('admin.app')
@section('admin.content')
<div class="container-fluid">
    <form action="{{ route('faqs.update', $faq->id) }}" class="mb-5" method="post">
        @method('put')
        @csrf
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-2">
                            <label class="text-dark"><strong>Question</strong></label>
                            <textarea name="question" class="form-control @error('question') is-invalid @enderror "
                                cols="30" rows="3">{{$faq->question}}</textarea>
                            @error('question')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-2">
                            <label class="text-dark"><strong>Answer</strong></label>
                            <textarea name="answer" class="form-control @error('answer') is-invalid @enderror "
                                cols="30" rows="3">{{$faq->answer}}</textarea>
                            @error('answer')
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
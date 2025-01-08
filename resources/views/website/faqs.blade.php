@extends('website.app')
@section('website.content')

<!-- FAQs -->
<div class="job-listing-section content-area job-details bg-gray">
    <h3 class="text-center my-2" style="color: darkgreen">Egy Finance Jobs - FAQs</h3>
    <div class="container mt-3">

        <div id="accordion">
            @foreach ($faqs as $index => $faq)
            <div class="card">
                <div class="card-header" id="heading{{$index}}">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$index}}"
                            aria-expanded="true" aria-controls="collapseOne">
                            <h5 class="mb-1" style="color: navy;">{{$faq->question}}</h5>
                        </button>
                    </h5>
                </div>

                <div id="collapse{{$index}}" class="collapse" aria-labelledby="heading{{$index}}"
                    data-parent="#accordion">
                    <div class="card-body">
                        <h6 class="mb-2" style="color: darkslategrey">{{$faq->answer}}</h6>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
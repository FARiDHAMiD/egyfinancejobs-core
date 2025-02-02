@extends('admin.app')
@section('admin.content')
<div class="container-fluid">
    <!-- Event Edit Form -->
    <form enctype="multipart/form-data" method="POST" action="{{route('events.update', $event->id)}}">
        @method('put')
        @csrf
        <div class="row">
            {{-- Edit New Event --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Event</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="text-dark"><strong>Event Title</strong></label>
                                <input type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror "
                                    value="{{ $event->title }}">
                                @error('title')
                                <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="mb-3">
                                <label class="text-dark"><strong>Event Type</strong></label>
                                <select type="text" name="type_id"
                                    class="form-control @error('type_id') is-invalid @enderror ">
                                    <option value="">--select--</option>
                                    @foreach ($types as $type)
                                    <option {{ $event->type_id==$type->id ? 'selected' : '' }}
                                        value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                                @error('cat_id')
                                <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="mb-3">
                                <label class="text-dark"><strong>Organizer/Instructor</strong></label>
                                <select type="text" name="instructor_id"
                                    class="form-control @error('instructor_id') is-invalid @enderror ">
                                    <option value="">--select--</option>
                                    @foreach ($instructors as $instructors)
                                    <option {{ $event->instructor_id==$instructors->id ? 'selected' : '' }}
                                        value="{{$instructors->id}}">{{$instructors->first_name}}
                                        {{$instructors->last_name}}</option>
                                    @endforeach
                                </select>
                                @error('instructor_id')
                                <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="text-dark"><strong>Description (Description)</strong></label>
                                <textarea name="description"
                                    class="form-control @error('description') is-invalid @enderror " cols="30"
                                    rows="3">{{$event->description}}</textarea>
                                @error('description')
                                <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <span class="text-muted">Will appear in top results</span>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" {{ $event->featured==1
                                ? 'checked' : '' }} name="featured" id="featured">
                                <label class="text-success" for="featured">
                                    Is Featured
                                </label>
                            </div>
                        </div>


                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label class="text-dark"><strong>Location</strong></label>
                                <input type="text" name="location"
                                    class="form-control @error('location') 'is-invalid' @enderror"
                                    value="{{$event->location}}">
                            </div>
                            @error('location')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label class="text-dark"><strong>Event Status</strong></label>
                                <select type="text" name="statu_id"
                                    class="form-control @error('statu_id') is-invalid @enderror">
                                    <option value="">--select--</option>
                                    @foreach ($status as $statu)
                                    <option {{ $event->statu_id==$statu->id ? 'selected' : '' }}
                                        value="{{$statu->id}}">{{$statu->name}}</option>
                                    @endforeach
                                </select>
                                @error('statu_id')
                                <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label class="text-dark"><strong>Start Date</strong></label>
                                <input type="date" name="start_date"
                                    class="form-control @error('start_date') is-invalid @enderror"
                                    value="{{$event->start_date}}">
                                @error('start_date')
                                <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label class="text-dark"><strong>End Date</strong></label>
                                <input type="date" name="end_date"
                                    class="form-control @error('end_date') is-invalid @enderror"
                                    value="{{$event->end_date}}">
                                @error('end_date')
                                <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label class="text-dark"><strong>Video URL <span class="text-muted">(Youtube Id video
                                            string after v=?)</span></strong></label>
                                <input type="text" name="video_url"
                                    class="form-control @error('video_url') 'is-invalid' @enderror"
                                    value="{{$event->video_url}}">
                            </div>
                            @error('video_url')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>



                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label class="text-dark"><strong>Register Link <span class="text-muted">(Url or Email)
                                        </span> </strong> </label>
                                <input type="text" name="register_link"
                                    class="form-control @error('register_link') 'is-invalid' @enderror"
                                    value="{{$event->register_link}}">
                            </div>
                            @error('register_link')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label class="text-dark"><strong>Email <span class="text-muted">(Will appear in event
                                            page)
                                        </span> </strong> </label>
                                <input type="email" name="email"
                                    class="form-control @error('email') 'is-invalid' @enderror"
                                    value="{{$event->email}}">
                            </div>
                            @error('email')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>

                        {{-- image --}}
                        <div class="col-12">
                            <hr>
                            <div class="row justify-content-between">
                                <div class="col-auto text-center">
                                    <label class="text-dark"><strong>Event Thumbnail</strong></label>
                                    <div class="upload-image-box">
                                        <div class="user-image-circle">
                                            <img class="image"
                                                src="{{ empty($event->getFirstMedia('event_img')) ? 
                                            asset('/website/img/event-avatar.png') : $event->getFirstMedia('event_img')->getUrl() }}"
                                                alt="" width="150">
                                        </div>
                                        <div class="mt-4">
                                            <label for="event_img" class="btn btn-info py-2">
                                                Upload Image
                                            </label>
                                            <input id="event_img" type="file" name="event_img"
                                                class="d-none image-input @error('event_img') is-invalid @enderror">
                                            @error('event_img')
                                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-2 justify-content-center">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success  w-100">
                            <i class="fas fa-save"></i> Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--/ End Event Update Form -->

</div>
@endsection
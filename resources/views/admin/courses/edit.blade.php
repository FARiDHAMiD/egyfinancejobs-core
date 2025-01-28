@extends('admin.app')
@section('admin.content')
<div class="container-fluid">
    <!-- Course Edit Form -->
    <form enctype="multipart/form-data" method="POST" action="{{route('courses.update', $course->id)}}">
        @method('put')
        @csrf
        <div class="row">
            {{-- Edit New Course --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Course</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="text-dark"><strong>Course Name</strong></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ $course->name }}">
                                @error('name')
                                <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="mb-3">
                                <label class="text-dark"><strong>Course Category</strong></label>
                                <select type="text" name="cat_id"
                                    class="form-control @error('cat_id') is-invalid @enderror ">
                                    @foreach ($cats as $cat)
                                    <option {{ $course->cat_id==$cat->id ? 'selected' : '' }}
                                        value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endforeach
                                </select>
                                @error('cat_id')
                                <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="mb-3">
                                <label class="text-dark"><strong>Instructor</strong></label>
                                <select type="text" name="instructor_id"
                                    class="form-control @error('instructor_id') is-invalid @enderror ">
                                    <option value="">--select--</option>
                                    @foreach ($instructors as $instructors)
                                    <option {{ $course->instructor_id == $instructors->id ? 'selected' : '' }}
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
                                <label class="text-dark"><strong>Description (Info)</strong></label>
                                <textarea name="info" class="form-control @error('info') is-invalid @enderror "
                                    cols="30" rows="3">{{$course->info}}</textarea>
                                @error('info')
                                <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <span class="text-muted">Will appear in top results</span>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" {{ $course->featured==1
                                ? 'checked' : '' }} name="featured" id="featured">
                                <label class="text-success" for="featured">
                                    Is Featured
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label class="text-dark"><strong>Course Type</strong></label>
                                <select type="text" name="type_id"
                                    class="form-control @error('type_id') is-invalid @enderror">
                                    @foreach ($types as $type)
                                    <option {{ $course->type_id == $type->id ? 'selected' : '' }}
                                        value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                                @error('type_id')
                                <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label class="text-dark"><strong>Course Status</strong></label>
                                <select type="text" name="statu_id"
                                    class="form-control @error('statu_id') is-invalid @enderror">
                                    @foreach ($status as $statu)
                                    <option {{ $course->statu_id == $statu->id ? 'selected' : '' }}
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
                                    value="{{$course->start_date}}">
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
                                    value="{{$course->end_date}}">
                                @error('end_date')
                                <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label class="text-dark"><strong>Total Hours</strong></label>
                                <input type="number" name="hours"
                                    class="form-control @error('hours') 'is-invalid' @enderror"
                                    value="{{$course->hours}}">
                            </div>
                            @error('hours')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label class="text-dark"><strong>Max Enrolls</strong></label>
                                <input type="number" name="max_enroll"
                                    class="form-control @error('max_enroll') 'is-invalid' @enderror"
                                    value="{{$course->max_enroll}}">
                            </div>
                            @error('max_enroll')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>

                        <div class="col-md-4 col-12">
                            <div class="mb-3">
                                <label class="text-dark"><strong>Place</strong></label>
                                <input type="text" name="place"
                                    class="form-control @error('place') 'is-invalid' @enderror"
                                    value="{{$course->place}}">
                            </div>
                            @error('place')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>



                        <div class="col-md-3 col-12">
                            <div class="mb-3">
                                <label class="text-dark"><strong>Price</strong></label>
                                <input type="number" name="price"
                                    class="form-control @error('price') 'is-invalid' @enderror"
                                    value="{{$course->price}}">
                            </div>
                            @error('price')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>

                        <div class="col-md-2 col-6 mb-0">
                            <label for="currency" class="text-dark"><strong>Currency</strong></label>
                            <select name="currency" class="form-control @error('currency') is-invalid @enderror">
                                @foreach ($currencies as $currency)
                                <option value="{{ $currency->id }}" {{ $course->currency_id==$currency->id ?
                                    'selected' : '' }}>
                                    {{ $currency->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-3 mb-3">
                            <span class="text-muted">Hide Course Price From Users</span>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" {{ $course->hide_price==1
                                ? 'checked' : '' }} name="hide_price" id="hide_price">
                                <label class="text-success" for="hide_price">
                                    Hide Price
                                </label>
                            </div>
                        </div>


                        <div class="col-md-4 col-12">
                            <div class="mb-3">
                                <label class="text-dark"><strong>Start Time <span class="text-muted">start session
                                            time</span></strong></label>
                                <input type="text" name="start_time"
                                    class="form-control @error('start_time') 'is-invalid' @enderror"
                                    value="{{$course->start_time}}">
                            </div>
                            @error('start_time')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>


                        <div class="col-md-4 col-12">
                            <div class="mb-3">
                                <label class="text-dark"><strong>End Time <span class="text-muted">end session
                                            time</span></strong></label>
                                <input type="text" name="end_time"
                                    class="form-control @error('end_time') 'is-invalid' @enderror"
                                    value="{{$course->end_time}}">
                            </div>
                            @error('end_time')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>
                        {{-- Course Rank --}}
                        <div class="col-md-4 col-12">
                            <div class="mb-3">
                                <label class="text-dark">Rank <span class="text-muted" style="font-size: small">(Temp.
                                        Untill Reviews Working)</span></label>
                                <input type="text" class="form-control @error('rank') is-invalid @enderror" name="rank"
                                    value="{{$course->rank}}">
                                @error('rank')
                                <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-dark"><strong>Prerequisites</strong></label>
                                <textarea name="prerequisite"
                                    class="form-control @error('prerequisite') is-invalid @enderror "
                                    rows="2">{{$course->prerequisite}}</textarea>
                                @error('prerequisite')
                                <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label class="text-dark"><strong>Video URL <span class="text-muted">(Youtube Id video
                                            string after ?v=)</span></strong></label>
                                <input type="text" name="video_url"
                                    class="form-control @error('video_url') 'is-invalid' @enderror"
                                    value="{{$course->video_url}}">
                            </div>
                            @error('video_url')
                            <span role="alert" class="invalid-feedback">( {{ $message }} )</span>
                            @enderror
                        </div>

                        {{-- image --}}
                        <div class="col-12">
                            <hr>
                            <div class="row justify-content-between">
                                <div class="col-auto text-center">
                                    <label class="text-dark"><strong>Course Thumbnail</strong></label>
                                    <div class="upload-image-box">
                                        <div class="user-image-circle">
                                            <img class="image"
                                                src="{{ empty($course->getFirstMedia('course_img')) ? 
                                            asset('/website/img/course-avatar.png') : $course->getFirstMedia('course_img')->getUrl() }}"
                                                alt="" width="150">
                                        </div>
                                        <div class="mt-4">
                                            <label for="course_img" class="btn btn-info py-2">
                                                Upload Image
                                            </label>
                                            <input id="course_img" type="file" name="course_img"
                                                class="d-none image-input @error('course_img') is-invalid @enderror">
                                            @error('course_img')
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
    <!--/ End Course Update Form -->

</div>
@endsection
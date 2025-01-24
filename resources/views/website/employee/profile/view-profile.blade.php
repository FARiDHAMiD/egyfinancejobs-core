@extends('website.app')
@section('website.content')
<!-- Employer Detail start -->
<div class="job-listing-section content-area job-details bg-gray">

    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-9 col-md-12 order-lg-1 order-2">
                <div class="work-experience-box bg-grea-3">
                    <div class="description w-100">
                        <div class="row align-items-start">
                            <div class="col-xl-2 col-sm-3 col-4 pr-0">
                                <div class="user-image-circle">
                                    <img src="{{ empty($employee->getFirstMedia('employee_profile')) ? asset('/website/img/avatar.png') : $employee->getFirstMedia('employee_profile')->getUrl() }}"
                                        alt="">
                                </div>
                            </div>
                            <div class="col-xl-10 col-sm-9 col-8">
                                <p class="text-dark m-0">
                                    <strong>{{ $employee->first_name . ' ' . $employee->last_name }}</strong>
                                </p>
                                <p class="text-sm text-dark-light m-0">{{ $profile->job_title->name }} | {{
                                    $profile->career_level->name ?? '' }}</p>
                                <p class="text-sm text-dark-light m-0 text-gray mb-1">{{ empty($profile->area) ? null :
                                    $profile->area->name }},
                                    {{ empty($profile->city) ? null : $profile->city->name }}, {{
                                    $profile->country->name }}</p>

                                <p class="text-sm text-dark-light m-0">{{ $employee->employee_profile->bio}}</p>

                            </div>
                        </div>
                    </div>
                    @if (auth()->check() && (auth()->user()->hasRole('admin')) ||
                    auth()->check() && auth()->user()->uuid == $employee->uuid)
                    <a href="{{ route('employee.profile.general-info.edit') }}"><button class="edit-btn bg-grea-3"><i
                                class="fa fa-pencil-square-o"></i></button></a>
                    @endif
                </div>

                {{-- General Info Section --}}
                <div class="job-box">
                    <div class="job-info mb-4">
                        <div class="row">

                            @if (auth()->check() && (auth()->user()->hasRole('admin')) ||
                            auth()->check() && auth()->user()->uuid == $employee->uuid)
                            <div class="col-xl-6 border-right">
                                <h2 class="h5 mb-3 mt-4">General Info:
                                </h2>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <p class="mb-0"><strong class="text-black text-sm">Age:</strong></p>
                                    </div>
                                    <div class="col-sm-7">
                                        <p class="text-black mb-0 text-sm">{{ get_age($profile->birthdate) }} Years</p>
                                    </div>
                                </div>

                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <p class="mb-0"><strong class="text-black text-sm">Salary:</strong>
                                        </p>
                                    </div>
                                    <div class="col-sm-7">
                                        <p class="text-black mb-0 text-sm">
                                            {{ number_format($profile->accepted_salary, 0) }} EGP

                                        </p>
                                    </div>
                                </div>

                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <p class="mb-0"><strong class="text-black text-sm">Gender:</strong></p>
                                    </div>
                                    <div class="col-sm-7">
                                        <p class="text-black mb-0 text-sm">{{ $profile->gender }}</p>
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <p class="mb-0"><strong class="text-black text-sm">Nationality:</strong></p>
                                    </div>
                                    <div class="col-sm-7">
                                        <p class="text-black mb-0 text-sm">{{ $profile->country->name }}</p>
                                    </div>
                                </div>
                                @if (!empty($profile->military_status))
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <p class="mb-0"><strong class="text-black text-sm">Military Status:</strong>
                                        </p>
                                    </div>
                                    <div class="col-sm-7">
                                        <p class="text-black mb-0 text-sm">{{ $profile->military_status }}</p>
                                    </div>
                                </div>
                                @endif
                                @if (!empty($profile->marital_status))
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <p class="mb-0"><strong class="text-black text-sm">Marital Status:</strong>
                                        </p>
                                    </div>
                                    <div class="col-sm-7">
                                        <p class="text-black mb-0 text-sm">{{ $profile->marital_status }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endif

                            <div class="col-xl-6">
                                @if (auth()->check() && (auth()->user()->hasRole('admin')) ||
                                auth()->check() && auth()->user()->uuid == $employee->uuid)
                                <div>
                                    <h2 class="h5 mb-3 mt-4">Contact Info:</h2>
                                    <p class="mb-0"><a href="#" class="text-black">{{ $profile->phone }}</a>
                                    </p>
                                    <hr class="my-2">
                                    <p class="mb-0"><a href="#" class="text-black">{{ $employee->email }}</a>
                                    </p>
                                </div>
                                @endif

                                {{-- Career Intersts / job types --}}
                                <div>
                                    <h2 class="h5 mb-3 mt-4">Career Interests: </h2>
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="mb-0"><strong class="text-black text-sm">Job Categories</strong>
                                            </p>
                                            <p>
                                                @foreach ($job_categories as $index => $category)
                                                {!! $index != 0 ? ' <span class="text-info"> | </span> ' : '' !!}
                                                {{$category->name}}
                                                @endforeach

                                            </p>
                                        </div>
                                    </div>

                                    <hr class="my-1">
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="mb-0"><strong class="text-black text-sm">Job Types:</strong></p>
                                            <p>
                                                @foreach ($job_types as $index => $type)
                                                {!! $index != 0 ? ' <span class="text-info"> | </span> ' : '' !!}
                                                {{$type->name}}
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>
                                    @if($user_social_links)
                                    <hr class="my-1">
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="mb-0"><strong class="text-black text-sm">Online Presence:</strong>
                                            </p>
                                            <div class="employer-links justify-content-center">
                                                <ul class="social-media">
                                                    @if($user_social_links->facebook)<li>
                                                        <a class="facebook-bg" href="{{$user_social_links->facebook}}"
                                                            target="_blank"><i class="fa fa-facebook"></i></a>
                                                    </li>
                                                    @endif
                                                    @if($user_social_links->linkedin)<li>
                                                        <a class="linkedin-bg" href="{{$user_social_links->linkedin}}"
                                                            target="_blank"><i class="fa fa-linkedin"></i></a>
                                                    </li>
                                                    @endif
                                                    @if($user_social_links->youtube)<li>
                                                        <a class="youtube-bg" style="background-color:    #f00;"
                                                            href="{{$user_social_links->youtube}}" target="_blank"><i
                                                                class="fa fa-youtube"></i></a>
                                                    </li>
                                                    @endif
                                                    @if($user_social_links->website)<li>
                                                        <a class="website-bg" style="background-color:    #1c4ea7;"
                                                            href="{{$user_social_links->website}}" target="_blank"><i
                                                                class="fa fa-sitemap" aria-hidden="true"></i></a>
                                                    </li>
                                                    @endif
                                                    @if($user_social_links->other)<li>
                                                        <a class="other-bg" href="{{$user_social_links->other}}"
                                                            target="_blank"><i class="fa fa-cubes"
                                                                aria-hidden="true"></i></a>
                                                    </li>
                                                    @endif


                                                    </li>

                                                </ul>

                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                {{-- Work Experience Section --}}
                <div class="job-box">
                    <div class="job-info">
                        <div class="row mb-3">
                            <div class="col-md 8">
                                <h2 class="h5 mb-3">Work Experience: </h2>
                            </div>
                        </div>

                        @foreach ($experiences as $experience)
                        <div class="work-experience-box">
                            <div class="description">
                                <h5 class="title">{{$experience->job_title}}
                                    <span>{{$experience->job_type->name}}</span>
                                </h5>
                                <p>{{$experience->company_name}} - {{$experience->industry->name}}</p>
                                <p>{{date('F Y', strtotime($experience->starting_from))}} - {{$experience->ending_in ==
                                    null ? "Present" : date('F Y', strtotime($experience->ending_in))}}</p>
                                <p class="text-primary">{{experience_calc($experience->starting_from,
                                    $experience->ending_in)}}</p>
                            </div>
                        </div>

                        @endforeach

                    </div>
                </div>

                {{-- Education Section --}}
                <div class="job-box">
                    <div class="job-info">
                        <div class="row mb-3">
                            <div class="col-md 8">
                                <h2 class="h5 mb-3">Education: </h2>
                            </div>
                        </div>
                        @foreach ($educations as $education)
                        <div class="work-experience-box">
                            <div class="description">
                                <h5 class="title">{{$education->degree_details}} | <span
                                        class="text-info">{{$education->education_level->name}}</span> </h5>
                                <p>{{$education->university->name}}</p>
                                <p> <strong>Grade:</strong> <span class="text-info">{{$education->grade}}</span></p>
                                <p>{{$education->degree_date}}</p>
                                @if($education->getFirstMedia('education_certificate'))
                                <p><strong>Certificate:</strong> <span>{{$education->certificate_title}}</span> | <a
                                        target="_blank"
                                        href="{{$education->getFirstMedia('education_certificate')->getUrl()}}">view
                                        <i class="fa fa-eye"></i></a> </p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                @if ($employee->employee_achievements != null)
                <div class="job-box">
                    <div class="job-info text-center">
                        <h2 class="h5 mb-1">Achievements</h2>
                        <p class="mb-2">{!! $employee->employee_achievements->description !!}</p>
                    </div>
                </div>
                @endif

                @if ($employee->getFirstMedia('employee_certificates'))
                <div class="job-box">
                    <div class="job-info text-center">
                        <h2 class="h5 mb-1">Certificates</h2>
                        @foreach ($employee->getMedia('employee_certificates') as $item)
                        <div class="up-files mt-4">
                            <div class="mb-3 text-primary"
                                style="display: flex; justify-content: space-between; padding:3px;">
                                <div class="custom-file text-left">
                                    <a href="{{ $item->getFullUrl() }}" target="_blank" rel="noopener noreferrer">{{
                                        $item->file_name }}</a>
                                </div>
                            </div>
                        </div>
                        <hr class="my-1">
                        @endforeach
                    </div>
                </div>
                @endif

            </div>
            <div class="col-lg-3 col-md-12 order-lg-2 order-2">
                <div class="sidebar-right py-4 px-3 text-center">
                    @if (auth()->check() && (auth()->user()->hasRole('admin')) ||
                    auth()->check() && auth()->user()->uuid == $employee->uuid)
                    <p class="text-dark-light">Share your Profile</p>
                    @else
                    <p class="text-dark-light">Share {{$employee->first_name}}'s Profile</p>
                    @endif
                    <div class="employer-links justify-content-center">
                        <ul class="social-media">
                            <li>
                                <a class="facebook-bg"
                                    href="https://www.facebook.com/sharer/sharer.php?u={{ route('employee.profile.view', $employee->uuid) }}"
                                    target="_blank">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>


                            <li>
                                <a class="linkedin-bg"
                                    href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('employee.profile.view', $employee->uuid) }}&title={{ $employee->first_name }}&summary={{ str_replace(' ', '%', $employee->employee_profile->job_title) }} | {{ str_replace(' ', '%', $employee->employee_profile->bio) }}&source={{ route('website.home') }}"
                                    target="_blank" rel="noopener noreferrer">
                                    <i class="fa fa-linkedin"></i></a>
                                </a>
                            </li>

                            <li>
                                <a class="twitter-bg" target="_blank"
                                    href="https://x.com/intent/tweet?text={{ $employee->first_name . ' ' . $employee->last_name }}&url={{ route('employee.profile.view', $employee->uuid) }}">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>

                            <li><a class="copy-bg copyLink"
                                    href="{{ route('employee.profile.view', $employee->uuid) }}"><i
                                        class="fa fa-copy"></i></a>
                                <p class="copyMessage" style="display: none;">Link copied!</p>

                            </li>

                        </ul>
                    </div>
                    {{-- QR Code generator --}}
                    <div class="d-flex justify-content-center mt-2">
                        {!!
                        DNS2D::getBarcodeHTML('https://egyfinancejobs.com/employee/profile/view/'.$employee->uuid,
                        'QRCODE', 3, 3) !!}
                    </div>
                </div>
                @if (auth()->check() && (auth()->user()->hasRole('admin')) ||
                auth()->check() && auth()->user()->uuid == $employee->uuid)
                @if ($employee->getFirstMedia('employee_cv'))
                <div class="sidebar-right py-4 px-3 text-center">
                    <h2 class="h5 mb-3">CV / Resume</h2>
                    <a href="{{$employee->getFirstMedia('employee_cv')->getUrl()}}" target="_blank"><button
                            class="btn button-theme mb-md-0 mb-3" type="submit">View <i
                                class="fa fa-eye"></i></button></a>
                </div>
                @endif
                @endif
                @if (count($employee->employee_skills()) > 0)
                <div class="sidebar-right py-4 px-3 mt-3">
                    @if (count($languages) !=0)
                    <h2 class="h5 mb-3">Languages: </h2>
                    @foreach ($languages as $language)
                    <div>
                        <p class="text-gray mb-1">{{$language->skill->name}}</p>
                        <span class="stars" data-stars-number="{{$language->skill_level}}">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </span>
                    </div>
                    @endforeach
                    <hr>
                    @endif
                    @if (count($soft_skills) !=0)
                    <h2 class="h5 mb-3">Soft Skills: </h2>
                    @foreach ($soft_skills as $soft_skill)
                    <div>
                        <p class="text-gray mb-1">{{$soft_skill->skill->name}}</p>
                        <span class="stars" data-stars-number="{{$soft_skill->skill_level}}">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </span>
                    </div>
                    @endforeach
                    <hr>
                    @endif
                    @if (count($technical_skills) !=0)
                    <h2 class="h5 mb-3">Technical Skills: </h2>
                    @foreach ($technical_skills as $technical_skill)
                    <div>
                        <p class="text-gray mb-1">{{$technical_skill->skill->name}}</p>
                        <span class="stars" data-stars-number="{{$technical_skill->skill_level}}">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </span>
                    </div>
                    @endforeach
                    <hr>
                    @endif
                    @if (count($technology_skills) !=0)
                    <h2 class="h5 mb-3">Technologies: </h2>
                    @foreach ($technology_skills as $technology_skill)
                    <div>
                        <p class="text-gray mb-1">{{$technology_skill->skill->name}}</p>
                        <span class="stars" data-stars-number="{{$technology_skill->skill_level}}">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </span>
                    </div>
                    @endforeach
                    <hr>
                    @endif


                </div>
                @endif

            </div>
        </div>
    </div>
</div>
<!-- Employer Detail end -->
@endsection
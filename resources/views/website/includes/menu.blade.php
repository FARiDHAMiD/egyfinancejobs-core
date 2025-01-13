<header class="main-header header-transparent sticky-header">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand logo" href="{{ route('website.home') }}">
                <img src="{{ url('/website') }}/img/logo.png" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav header-ml">
                    <li class="nav-item">
                        <a class="nav-link {{ isset($page_name) && $page_name == 'home' ? 'active' : '' }}"
                            href="{{ route('website.home') }}">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ isset($page_name) && $page_name == 'jobs' ? 'active' : '' }}"
                            href="{{ route('website.jobs') }}">
                            Find Jobs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a target="_blank" class="nav-link" href="{{ route('courses.index') }}">
                            Courses
                        </a>
                    </li>
                </ul>
                @if (!Auth::check())
                <ul class="navbar-nav ml-auto mb-3">
                    <li class="nav-item">
                        <a href="{{ route('login_page') }}" class="nav-link link-color">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employee_register_page') }}"
                            class="nav-link link-color bg-transparent">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-color bg-transparent" href="{{ route('website.jobs') }}">
                            Post Job!
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="employer/index.html" class="nav-link link-color bg-transparent">For
                            Employers</a>
                    </li> --}}
                </ul>
                @elseif(auth()->user()->hasRole('employee'))
                <div class="navbar-buttons ml-auto">
                    <ul>
                        <li>
                            <div class="btn-group dropleft user-menu-quick-links">
                                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ empty(auth()->user()->getFirstMedia('employee_profile')) ? asset('/website/img/avatar.png') : auth()->user()->getFirstMedia('employee_profile')->getUrl() }}"
                                        alt="avatar">
                                    {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}
                                </a>
                                <div class="dropdown-menu">
                                    <div class="d-flex align-items-center px-3 pt-2">
                                        <div>
                                            <div class="user-image-circle">
                                                <img src="{{ empty(auth()->user()->getFirstMedia('employee_profile')) ? asset('/website/img/avatar.png') : auth()->user()->getFirstMedia('employee_profile')->getUrl() }}"
                                                    alt="">
                                            </div>
                                        </div>
                                        <div class="pl-3">
                                            <p class="text-dark m-0">
                                                <strong>{{ auth()->user()->first_name . ' ' . auth()->user()->last_name
                                                    }}</strong>
                                            </p>
                                            <p class="text-sm text-dark-light m-0 text-gray">
                                                {{ auth()->user()->email }}</p>
                                            <a href="{{route('employee.profile.view')}}"
                                                class="btn button-theme bg-transport p-1">View Profile</a>
                                        </div>
                                    </div>
                                    <hr class="my-2">
                                    <a class="dropdown-item" href="{{route('employee.jobs.saved-jobs')}}">Saved Jobs</a>
                                    <a class="dropdown-item"
                                        href="{{route('employee.jobs.applications')}}">Applications</a>
                                    <a class="dropdown-item" href="{{route('employee.profile.general-info.edit')}}">Edit
                                        profile</a>
                                    {{-- <a class="dropdown-item" href="about-us.html">About Us</a>
                                    <a class="dropdown-item" href="contact-us.html">Contact Us</a>
                                    <a class="dropdown-item" href="account-settings.html">Account Settings</a> --}}
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                    </form>
                                </div>

                                <!-- noti start ssss -->
                                <div class="dropdown-wr no-arrow noti-drop">
                                    <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"
                                        aria-expanded="false">
                                        <span class="noti-num">{{
                                            auth()->user()->unreadnotifications()->count()}}</span>
                                        <span class="i-wr">
                                            <img src="/bell.svg" alt="">
                                        </span>
                                    </button>
                                    @php
                                    $user = auth()->user();
                                    $notifications = $user->notifications()->paginate(50);
                                    $notifications_read = $user->readnotifications()->paginate(50);
                                    @endphp
                                    <div class="dropdown-menu">
                                        @foreach($notifications as $item)

                                        <a class="dropdown-item"
                                            href="{{(str_contains($item->data['url'], '?'))? $item->data['url'].'&notify='.$item->id : $item->data['url'].'?notify='.$item->id}}">
                                            <img src="/bell.svg" alt="">
                                            <div class="noti-text" @if($item->read_at) style=" color: #919191;" @endif>
                                                <strong>{{$item->data['title']}}</strong>
                                            </div>

                                            <p class="text-sm text-dark-light m-0 text-gray">
                                                {{\Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</p>
                                        </a>
                                        @endforeach


                                    </div>
                                </div>
                                <!-- noti enddddddd -->
                            </div>
                        </li>
                    </ul>
                </div>
                @elseif(auth()->user()->hasRole('employer'))
                <div class="navbar-buttons ml-auto">
                    <ul>
                        <li>
                            <div class="btn-group dropleft user-menu-quick-links">
                                <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="../img/avatar.png" alt="avatar">
                                    Username
                                </a>
                                <div class="dropdown-menu">
                                    <div class="d-flex align-items-center px-3 pt-2">
                                        <div>
                                            <div class="user-image-circle">
                                                <img src="../img/avatar.png" alt="">
                                            </div>
                                        </div>
                                        <div class="pl-3">
                                            <p class="text-dark m-0"><strong>Username</strong></p>
                                            <p class="text-sm text-dark-light m-0">Etislate Egypt</p>
                                            <p class="text-sm text-dark-light m-0 text-gray">Username@gmail.com</p>
                                            <a href="company-profile.html"
                                                class="btn button-theme bg-transport p-1">View Company
                                                Profile</a>
                                        </div>
                                    </div>
                                    <hr class="my-2">
                                    <a class="dropdown-item" href="pricing-plans.html">Plans &amp; Pricies</a>
                                    <a class="dropdown-item" href="edit-company-profile.html">Edit Company
                                        Page</a>
                                    <a class="dropdown-item" href="users.html">Manage Users</a>
                                    <a class="dropdown-item" href="account-settings.html">Account Settings</a>
                                    <a class="dropdown-item" href="../contact-us.html">Contact Us</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                @else
                <ul class="navbar-nav ml-auto mb-3">
                    <li class="nav-item">
                        @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.home') }}" class="nav-link link-color">You are admin!</a>
                        @elseif(auth()->user()->hasRole('instructor'))
                        <a href="{{ route('courses.instructorProfile', auth()->user()->uuid) }}" class="nav-link link-color">Instructor Profile!</a>
                        @else
                        <a href="{{ route('login_page') }}" class="nav-link link-color">Login</a>
                        @endif
                    </li>
                    {{-- @if(!auth()->user()->hasRole('admin'))
                    <li class="nav-item">
                        <a href="{{ route('employee_register_page') }}"
                            class="nav-link link-color bg-transparent">Register</a>
                    </li>
                    @endif --}}
                    {{-- <li class="nav-item">
                        <a href="employer/index.html" class="nav-link link-color bg-transparent">For
                            Employers</a>
                    </li> --}}
                </ul>
                @endif

            </div>
        </nav>
    </div>
</header>
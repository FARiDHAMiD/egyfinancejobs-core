<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.home')}}">
        <div class="sidebar-brand-icon">
            <img width="30px" src="{{ url('/website') }}/img/fav-icon.png" alt="">
        </div>
        <div class="sidebar-brand-text mx-3">Egy Finance</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ isset($page_name) && $page_name == 'home' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item {{ isset($page_name) && $page_name == 'jobs' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('jobs.index')}}">
            <i class="fas fa-fw fa-briefcase"></i>
            <span>Jobs</span></a>
    </li>
    <li class="nav-item {{ isset($page_name) && $page_name == 'Job Request' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('jobs.requests')}}">
            <i class="fas fa-fw fa-question"></i>
            <span>Jobs Requests</span></a>
    </li>
    <li class="nav-item {{ isset($page_name) && $page_name == 'employers' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('employers.index')}}">
            <i class="fas fa-fw fa-building"></i>
            <span>Employers</span></a>
    </li>
    <li class="nav-item {{ isset($page_name) && $page_name == 'employees' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('employees.index')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>Employees</span></a>
    </li>

    <li class="nav-item {{ isset($page_name) && $page_name == 'instructors' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('instructor.index')}}">
            <i class="fas fa-fw fa-user-tie"></i>
            <span>Instructors</span></a>
    </li>

    <li
        class="nav-item {{ isset($page_name) && $page_name == 'Admin Courses' || isset($page_name) && $page_name == 'Edit Course' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.course.index')}}">
            <i class="fas fa-fw fa-user-graduate"></i>
            <span>Courses</span></a>
    </li>

    <li
        class="nav-item {{ isset($page_name) && $page_name == 'CATs' || isset($page_name) && $page_name == 'Edit CATs' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('cats.index')}}">
            <i class="fas fa-fw fa-list"></i>
            <span>Courses Cats</span></a>
    </li>

    <li class="nav-item {{ isset($page_name) && $page_name == 'Courses Enrolls' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admin.course.enrolls')}}">
            <i class="fas fa-fw fa-graduation-cap"></i>
            <span>Courses Enrolls</span></a>
    </li>

    <li
        class="nav-item {{ isset($page_name) && $page_name == 'Events' || isset($page_name) && $page_name == 'Create Event' || isset($page_name) && $page_name == 'Edit Event' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('events.index')}}">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Events</span></a>
    </li>

    <li class="nav-item {{ isset($page_name) && $page_name == 'locations' ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-map-marker"></i>
            <span>Locations</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('countries.index')}}">Countries</a>
                <a class="collapse-item" href="{{route('cities.index')}}">Cities</a>
                <a class="collapse-item" href="{{route('areas.index')}}">Areas</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ isset($page_name) && $page_name == 'career-levels' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('career-levels.index')}}">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Career Levels</span></a>
    </li>

    <li class="nav-item {{ isset($page_name) && $page_name == 'education-levels' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('education-levels.index')}}">
            <i class="fas fa-fw fa-user-graduate"></i>
            <span>Education Levels</span></a>
    </li>

    <li class="nav-item {{ isset($page_name) && $page_name == 'industries' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('industries.index')}}">
            <i class="fas fa-fw fa-industry"></i>
            <span>Industries</span></a>
    </li>

    <li class="nav-item {{ isset($page_name) && $page_name == 'job-categories' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('job-categories.index')}}">
            <i class="fas fa-fw fa-briefcase"></i>
            <span>Job Categories</span></a>
    </li>

    <li class="nav-item {{ isset($page_name) && $page_name == 'job-titles' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('job-titles.index')}}">
            <i class="fas fa-fw fa-id-card"></i>
            <span>Job Titles</span></a>
    </li>

    <li class="nav-item {{ isset($page_name) && $page_name == 'job-types' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('job-types.index')}}">
            <i class="fas fa-fw fa-toolbox"></i>
            <span>Job Type</span></a>
    </li>

    <li class="nav-item {{ isset($page_name) && $page_name == 'currencies' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('currencies.index')}}">
            <i class="fas fa-fw fa-coins"></i>
            <span>Currencies</span></a>
    </li>

    <li class="nav-item {{ isset($page_name) && $page_name == 'skills' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('skills.index')}}">
            <i class="fas fa-fw fa-brain"></i>
            <span>Skills</span></a>
    </li>

    <li class="nav-item {{ isset($page_name) && $page_name == 'universities' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('universities.index')}}">
            <i class="fas fa-fw fa-university"></i>
            <span>Universities</span></a>
    </li>
    <li class="nav-item {{ isset($page_name) && $page_name == 'admins' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admins.index')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>Dashboard Stuff</span></a>
    </li>

    <li class="nav-item {{ isset($page_name) && $page_name == 'About_Company_social' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('AboutUs.index')}}">
            <i class="fas fa-fw fa-phone"></i>
            <span>About Us & Social</span></a>
    </li>

    <li class="nav-item {{ isset($page_name) && $page_name == 'FAQs' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('faqs.index')}}">
            <i class="fas fa-fw fa-question-circle"></i>
            <span>FAQs</span></a>
    </li>

    <li class="nav-item {{ isset($page_name) && $page_name == 'Contact Us' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('contact_us.index')}}">
            <i class="fas fa-fw fa-exclamation-circle"></i>
            <span>Contact Us</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
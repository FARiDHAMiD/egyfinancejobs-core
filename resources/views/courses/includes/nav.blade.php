<!-- Header -->
<header class="header">
    <!-- Header Inner -->
    <div class="header-inner overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-12">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="{{route('website.home')}}"><img src="{{asset('courses_template/images/logo.png')}}"
                                width="100" height="100" alt="#"></a>
                    </div>
                    <!--/ End Logo -->
                    <div class="mobile-menu"></div>
                </div>
                <div class="col-lg-9 col-md-9 col-12">
                    <div class="menu-bar">
                        <nav class="navbar navbar-default">
                            <div class="navbar-collapse">
                                <!-- Main Menu -->
                                <ul id="nav" class="nav menu navbar-nav">
                                    <li class="{{ isset($page_name) && $page_name == 'Courses' ? 'active' : '' }}"><a
                                            href="{{route('courses.index')}}"><i class="fa fa-home"></i>Home</a></li>

                                    <li class="{{ isset($page_name) && $page_name == 'Instructors' ? 'active' : '' }}">
                                        <a href="{{route('courses.instructors')}}"><i
                                                class="fa fa-clone"></i>Instructors</a>
                                    </li>
                                    <li
                                        class="{{ isset($page_name) && $page_name == 'All Courses' || $page_name == 'Show Course' ? 'active' : '' }}">
                                        <a href="{{route('courses.all')}}"><i class="fa fa-clone"></i>Our Courses</a>
                                    </li>
                                    <li
                                        class="{{ isset($page_name) && $page_name == 'Events' || $page_name == 'Events' ? 'active' : '' }}">
                                        <a href="{{route('courses.events')}}"><i class="fa fa-bullhorn"></i>Events</a>
                                    </li>
                                    <li
                                        class="{{ isset($page_name) && $page_name == 'Contact Us' || $page_name == 'FAQs' ? 'active' : '' }}">
                                        <a href="{{route('courses.contact_us')}}"><i
                                                class="fa fa-address-book"></i>Contact</a>
                                    </li>
                                </ul>
                                <!-- End Main Menu -->
                            </div>
                        </nav>
                        <!-- Search Area -->
                        <div class="search-area">
                            <a href="#header" class="icon"><i class="fa fa-search"></i></a>
                            <form class="search-form">
                                <input type="text" placeholder="ex: premium course" name="search">
                                <button value="search " type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <!-- End Search Area-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>
<!--/ End Header -->
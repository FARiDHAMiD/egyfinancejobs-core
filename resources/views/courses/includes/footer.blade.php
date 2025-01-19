<!-- Footer -->
<footer class="footer section">
    <!-- Footer Top -->
    <div class="footer-top overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- About -->
                    <div class="single-widget about">
                        <h2>Egy Finance Courses</h2>
                        <ul class="list">
                            <li><a href="tel:+201001085717"><i class="fa fa-phone"></i>Phone: 01001085717 </a></li>
                            <li><i class="fa fa-envelope"></i>Email: <a
                                    href="mailto:info@egyfinancejobs.com">Info@egyfinancejobs.com</a></li>
                            <li><i class="fa fa-map-o"></i>Address: Heliopolis, Cairo, Egypt.</li>
                        </ul>
                        <!-- Social -->
                        <ul class="social">
                            <li><a target="_blank" href="https://t.me/+201001085717"><i class="fa fa-telegram"></i></a>
                            </li>
                            <li><a target="_blank"
                                    href="https://www.facebook.com/profile.php?id=61553917499086&mibextid=ZbWKwL"><i
                                        class="fa fa-facebook"></i></a></li>
                            <li class="active"><a target="_blank"
                                    href="https://wa.me/+201001085717?text=Hello%20Egyfinancejobs"><i
                                        class="fa fa-whatsapp"></i></a></li>
                            <li><a target="_blank" href="https://www.linkedin.com/company/egy-finance-jobs"><i
                                        class="fa fa-linkedin"></i></a></li>
                        </ul>
                        <!-- End Social -->
                    </div>
                    <!--/ End About -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Useful Links -->
                    <div class="single-widget list">
                        <h2>Get Started</h2>
                        <ul>
                            @if(auth()->check())
                            <li><i class="fa fa-angle-right"></i><a
                                    href="{{route('courses.profile', auth()->user()->uuid)}}">My Profile</a>
                            </li>
                            @else
                            <li><i class="fa fa-angle-right"></i><a href="{{route('login_page')}}">Login / Register</a>
                            </li>
                            @endif
                            <li><i class="fa fa-angle-right"></i><a href="{{route('courses.about_us')}}">About Us</a>
                            </li>
                            <li><i class="fa fa-angle-right"></i><a href="{{route('courses.all')}}">Our Courses</a></li>
                            <li><i class="fa fa-angle-right"></i><a href="{{route('courses.events')}}">Upcoming
                                    Events</a></li>
                            <li><i class="fa fa-angle-right"></i><a href="{{route('courses.faqs')}}">Faq's</a></li>
                        </ul>
                    </div>
                    <!--/ End Useful Links -->
                </div>


                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Extra Links -->
                    <div class="single-widget list">
                        <h2>Useful Links</h2>
                        <ul>
                            <li><i class="fa fa-angle-right"></i><a href="{{route('courses.privacy')}}">Privacy
                                    Policy</a></li>
                            <li><i class="fa fa-angle-right"></i><a href="{{route('courses.terms')}}">Terms /
                                    Condition</a>
                            </li>
                            <li><i class="fa fa-angle-right"></i><a href="{{route('instructor.create')}}">I'm
                                    Instructor</a></li>
                            <li><i class="fa fa-angle-right"></i><a
                                    href="https://wa.me/+201001085717?text=Hello%20Egyfinancejobs">Become a partner</a>
                            </li>
                            <li><i class="fa fa-angle-right"></i><a
                                    href="https://wa.me/+201001085717?text=Hello%20Egyfinancejobs">About Developers</a>
                            </li>
                        </ul>
                    </div>
                    <!--/ End Extra Links -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Footer Top -->
    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Copyright -->
                    <div class="copyright">
                        <p>© Copyright egyfinancejobs {{date('Y')}}. Design & Development by <a target="_blank"
                                href="https://egyfinancejobs.com">egyfinancejobs.com</a> Team

                    </div>
                    <!--/ End Copyright -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Footer Bottom -->
</footer>
<!--/ End Footer -->

<script src="{{asset('courses_template/js/jquery.min.js')}}"></script>
<script src="{{asset('courses_template/js/jquery-migrate.min.js')}}"></script>
<script src="{{asset('courses_template/js/colors.js')}}"></script>
<script src="{{asset('courses_template/js/popper.min.js')}}"></script>
<script src="{{asset('courses_template/js/bootstrap.min.js')}}"></script>
<script src="{{asset('courses_template/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('courses_template/js/jquery.stellar.min.js')}}"></script>
<script src="{{asset('courses_template/js/finalcountdown.min.js')}}"></script>
<script src="{{asset('courses_template/js/facnybox.min.js')}}"></script>
<script src="{{asset('courses_template/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('courses_template/js/circle-progress.min.js')}}"></script>
<script src="{{asset('courses_template/js/niceselect.js')}}"></script>
<script src="{{asset('courses_template/js/jquery.stellar.min.js')}}"></script>
<script src="{{asset('courses_template/js/cube-portfolio.min.js')}}"></script>
<script src="{{asset('courses_template/js/slicknav.min.js')}}"></script>
<script src="{{asset('courses_template/js/easing.min.js')}}"></script>
<script src="{{asset('courses_template/js/waypoints.min.js')}}"></script>
<script src="{{asset('courses_template/js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('courses_template/js/jquery.scrollUp.min.js')}}"></script>
{{-- <script src="{{asset('courses_template/js/gmaps.min.js')}}"></script> --}}
<script src="{{asset('courses_template/js/main.js')}}"></script>

{{-- upload image --}}
<script src="{{ url('/website') }}/js/jquery.scrollUp.js"></script>
<script src="{{ url('/website') }}/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="{{ url('/website') }}/js/select2.min.js"></script>
<script src="{{ url('/website') }}/js/app.js"></script>
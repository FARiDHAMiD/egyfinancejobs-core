<!-- Footer start -->
<footer class="footer">
    <div class="container footer-inner">
        <div class="row">
            <div class="col-lg-5 col-md-6">
                <div class="footer-item clearfix">
                    <img src="{{ url('/website') }}/img/white-logo.png" alt="logo" class="f-logo">
                    <p class="footer-description">
                       {{ about_us()->about_company }}
                    </p>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="footer-item">
                    <h4>Get started</h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('website.home') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('website.jobs') }}">Find Jobs</a>
                        </li>

                        <li>
                            <a href="JavaScript::void();"><i class="fa fa-phone"></i>{{ about_us()->phone}}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="footer-item">
                    <h4>Learn More</h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('login_page') }}">Log in</a>
                        </li>
                        <li>
                            <a href="{{ route('employee_register_page') }}">Register</a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-item">
                    <h4>Follow Us</h4>
                    <ul class="social-list clearfix">
                        <li><a href="{{ about_us()->facebook}}" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="{{ about_us()->twitter}}" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="{{ about_us()->linkedin}}" target="_blank" class="linkedin"><i class="fa fa-linkedin"></i></a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer end -->

<!-- Sub footer start -->
<div class="sub-footer">
    <div class="container">
        <div class="text-center">
            <p class="copy">Copyright ©2022 Egy finance jobs . All rights reserved. Use of this site is subject
                to certain Terms and Conditions.</p>
        </div>
    </div>
</div>
<!-- Sub footer end -->

<script src="{{ url('/website') }}/js/jquery-2.2.0.min.js"></script>
<script src="{{ url('/website') }}/js/popper.min.js"></script>
<script src="{{ url('/website') }}/js/bootstrap.min.js"></script>
<script src="{{ url('/website') }}/js/bootstrap-submenu.js"></script>
<script src="{{ url('/website') }}/js/rangeslider.js"></script>
<script src="{{ url('/website') }}/js/jquery.mb.YTPlayer.js"></script>
<script src="{{ url('/website') }}/js/bootstrap-select.min.js"></script>
<script src="{{ url('/website') }}/js/jquery.easing.1.3.js"></script>
<script src="{{ url('/website') }}/js/jquery.scrollUp.js"></script>
<script src="{{ url('/website') }}/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="{{ url('/website') }}/js/leaflet.js"></script>
<script src="{{ url('/website') }}/js/leaflet-providers.js"></script>
<script src="{{ url('/website') }}/js/leaflet.markercluster.js"></script>
<script src="{{ url('/website') }}/js/moment.min.js"></script>
<script src="{{ url('/website') }}/js/daterangepicker.min.js"></script>
<script src="{{ url('/website') }}/js/dropzone.js"></script>
<script src="{{ url('/website') }}/js/slick.min.js"></script>
<script src="{{ url('/website') }}/js/jquery.filterizr.js"></script>
<script src="{{ url('/website') }}/js/jquery.magnific-popup.min.js"></script>
<script src="{{ url('/website') }}/js/jquery.countdown.js"></script>
<script src="{{ url('/website') }}/js/maps.js"></script>
<script src="{{ url('/website') }}/js/select2.min.js"></script>
<script src="{{ url('/website') }}/js/app.js"></script>
<script src="{{ url('/website') }}/js/custom.js"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="{{ url('/website') }}/js/ie10-viewport-bug-workaround.js"></script>
<!-- Custom javascript -->
<script src="{{ url('/website') }}/js/ie10-viewport-bug-workaround.js"></script>

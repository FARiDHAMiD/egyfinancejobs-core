<!-- Footer start -->
<footer class="footer">
    <div class="container footer-inner">
        <div class="row">
            <div class="col-lg-2 col-md-6 col-6">
                <div class="footer-item clearfix">
                    <img src="{{ url('/website') }}/img/white-logo.png" alt="logo" class="f-logo">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6">
                <img src="{{ asset('/website/img/egyfinancejobs_QR.png') }}" alt="brand" class="img-fluid" width="90"
                    height="90">
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="footer-item">
                    {{-- link to promo / how to --}}
                    <a href="">
                        <h4>Get started</h4>
                    </a>
                    <ul class="links">
                        <li>
                            @if(auth()->check() && auth()->user()->hasRole('admin'))
                            <a target="_blank" href="{{ route('contact_us.index') }}">Contact Us</a>
                            @else
                            <a target="_blank" href="{{ route('website.contact_us') }}">Contact Us</a>
                            @endif
                        </li>
                        <li>
                            <a href="{{ route('website.privacy') }}">Privacy Policy</a>
                        </li>

                        <li>
                            <a href="tel:+201001085717"><i class="fa fa-phone"></i> 01001085717</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="footer-item">
                    <a target="_blank" href="{{route('faqs')}}">
                        <h4>FAQs <i class="fa fa-question-circle"></i></h4>
                    </a>
                    <ul class="links">

                        <li>
                            <a target="_blank" href="{{ route('about_us_guest') }}">About Us</a>
                        </li>
                        <li>
                            <a href="{{ route('login_page') }}">Log in</a> |
                            <a href="{{ route('employee_register_page') }}">Sign Up</a>
                        </li>
                        <li>
                            <a target="_blank" href="mailto:info@egyfinancejobs.com">Website Developers <i
                                    class="fa fa-code"></i></a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-item">
                    <h4>Follow Us</h4>
                    <ul class="social-list clearfix">
                        <li><a href="https://www.facebook.com/profile.php?id=61553917499086&mibextid=ZbWKwL"
                                target="_blank" class="facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://wa.me/+201001085717?text=Hello%20Egyfinancejobs" target="_blank"
                                class="whatsapp"><i class="fa fa-whatsapp"></i></a></li>
                        <li><a href="https://t.me/+201001085717" target="_blank" class="telegram"><i
                                    class="fa fa-telegram"></i></a></li>
                        <li><a href="https://www.linkedin.com/company/egy-finance-jobs" target="_blank"
                                class="linkedin"><i class="fa fa-linkedin"></i></a></li>

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
            <p class="copy">Copyright ©{{date('Y')}} Egy finance jobs . All rights reserved.
                Use of this site is subject
                to certain <a target="_blank" class="text-light font-weight-bold"
                    href="{{route('website.terms')}}">Terms and Conditions.</a></p>
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
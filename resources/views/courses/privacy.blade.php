@extends('courses.main')
@section('courses.content')

<!-- Breadcrumb -->
<div class="breadcrumbs overlay" style="background-image:url('{{asset('courses_template/images/breadcrumb-bg.jpg')}}')">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <h2>Privacy Policy</h2>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="bread-list">
                    <li><a href="{{route('courses.index')}}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="#">Priavcy Policy<i class="fa fa-angle-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--/ End Breadcrumb -->

<!-- Privacy -->
<section class="privacy section">
    <div class="container">
        <h4 class="text-start">Privacy Policy</h4>
        <hr>
        {!! nl2br(e(
        "At Egy Finance Courses, we value the privacy and security of your personal information. This Privacy
        Policy outlines how we collect, use, disclose, and safeguard your data when you visit our website and use our
        services. By accessing or using our site, you agree to the terms outlined in this policy.
        1. Information We Collect

        We collect several types of information in order to provide and improve our services:

        Personal Information: When you register for an account, enroll in a course, or contact us, we may collect
        personal information such as your name, email address, phone number, billing information, and other contact
        details.

        Usage Data: We may collect information on how our website is accessed and used. This may include your IP
        address, browser type, device information, pages visited, and timestamps.

        Payment Information: When you make a purchase, we may collect payment details such as credit card numbers and
        billing addresses, which are processed securely by our payment providers.

        2. How We Use Your Information

        We use your information for the following purposes:

        To provide and maintain our services, including course enrollment and delivery
        To communicate with you about course updates, promotions, or important information
        To process payments and manage your account
        To analyze website traffic and improve user experience
        To comply with legal obligations and enforce our terms of service

        3. Sharing Your Information

        We do not sell your personal information. However, we may share your data with third parties in the following
        cases:

        Service Providers: We may share data with trusted third-party service providers (e.g., payment processors, email
        providers) to facilitate our services.
        Legal Compliance: We may disclose your information when required by law or to protect our rights or the rights
        of others.

        4. Data Security

        We employ industry-standard security measures to protect your personal data from unauthorized access, loss, or
        alteration. However, no method of transmission over the Internet or method of electronic storage is completely
        secure, so we cannot guarantee absolute security.
        5. Your Data Protection Rights

        Depending on your location, you may have the following rights concerning your personal information:

        The right to access and update your information
        The right to request the deletion of your data
        The right to object to or restrict processing
        The right to withdraw consent (if applicable)

        To exercise these rights, please contact us at [Insert Contact Information].
        6. Cookies and Tracking Technologies

        We use cookies and similar tracking technologies to enhance your experience on our site, analyze trends, and
        track users' movements on the website. You can manage your cookie preferences through your browser settings.
        7. Third-Party Links

        Our website may contain links to third-party sites. We are not responsible for the privacy practices or content
        of those sites.
        8. Children’s Privacy

        Our services are not intended for children under the age of 13, and we do not knowingly collect personal
        information from children. If you believe that we have inadvertently collected information from a child under
        13, please contact us so we can take appropriate action.
        9. Changes to This Privacy Policy

        We may update this Privacy Policy from time to time. Any changes will be posted on this page with an updated
        effective date. We encourage you to review this policy periodically for any updates.
        10. Contact Us

        If you have any questions about this Privacy Policy or our data practices, please contact us at:

        Egy Finance Jobs
        info@egyfinancejobs.com
        +201001085717"
        )) !!}

    </div>

</section>
<!--/ End privacy -->
@endsection
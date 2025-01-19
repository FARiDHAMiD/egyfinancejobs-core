@extends('courses.main')
@section('courses.content')

<!-- Breadcrumb -->
<div class="breadcrumbs overlay" style="background-image:url('{{asset('courses_template/images/breadcrumb-bg.jpg')}}')">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <h2>Terms & Conditions</h2>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="bread-list">
                    <li><a href="{{route('courses.index')}}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="#">Terms&Conditions<i class="fa fa-angle-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--/ End Breadcrumb -->

<!-- Terms -->
<section class="terms section">
    <div class="container">
        <h4 class="text-start">Terms & Conditions</h4>
        <hr>
        {!! nl2br(e(
        "These Terms and Conditions terms govern your access to and use of Egy Finance Courses Website,
        and the services we provide, including online courses, materials, and resources
        services. By accessing or using our Website, you agree to be bound by these Terms. If you do not agree to
        these Terms, please do not use our Website or Services.

        1. Account Registration
        To access certain features of our Website, such as enrolling in courses or accessing course materials, you may
        be required to create an account. When registering, you agree to provide accurate, current, and complete
        information and to update your information as needed. You are responsible for maintaining the confidentiality of
        your account credentials and for all activities that occur under your account.

        2. Use of Our Services
        You may use our Website and Services for lawful purposes only. You agree not to:
        Copy, reproduce, distribute, or publicly display any content from the Website without permission.
        Use the Website to engage in any unlawful, fraudulent, or harmful activity.
        Interfere with or disrupt the functioning of the Website, its servers, or networks.
        Attempt to gain unauthorized access to any part of the Website or its systems.

        3. Course Enrollment and Payments (No Payments Services at the moment)
        Future in payment subscriptions; before enroll in a paid courses, you must create an account and pay the
        applicable fees. By enrolling, you agree to pay
        the full course fees and acknowledge that the fees are non-refundable unless otherwise specified. All payment
        transactions are processed securely, and you agree to comply with the payment provider’s terms and conditions.

        4. User Content
        You may upload, post, or submit content (e.g., assignments, comments, feedback) to the Website as part of your
        use of our Services. By submitting content, you grant Egy Finance Courses a non-exclusive, royalty-free
        license to use, display, modify, and distribute the content in connection with our Services. You are solely
        responsible for the content you submit and must ensure that it does not violate any intellectual property
        rights, privacy laws, or other third-party rights.

        5. Intellectual Property
        All content, materials, and resources provided on the Website, including but not limited to text, images,
        videos, course materials, logos, and trademarks, are the intellectual property of Egy Finance Courses or
        its licensors and are protected by copyright and trademark laws. You may not copy, modify, distribute, or use
        any of this content without permission.

        6. Termination of Access
        We reserve the right to suspend or terminate your account and access to our Services at our discretion, without
        notice, for any violation of these Terms or for any other reason, including if you engage in activities that
        harm the Website or other users.

        7. Privacy Policy
        Your use of the Website is also governed by our Privacy Policy, which outlines how we collect, use, and protect
        your personal data. By using our Website, you consent to our data practices as described in the Privacy Policy.

        8. Disclaimers and Limitation of Liability
        While we strive to provide high-quality content and services, we cannot guarantee that the Website and Services
        will always be error-free or uninterrupted. The Website and Services are provided 'as is,' and we disclaim all
        warranties, express or implied, including warranties of merchantability or fitness for a particular purpose.

        In no event shall Egy Finance Courses be liable for any direct, indirect, incidental, special, or
        consequential damages, including but not limited to loss of data, profits, or business opportunities, arising
        from the use or inability to use our Website or Services.

        9. Indemnification
        You agree to indemnify, defend, and hold harmless Egy Finance Courses, its officers, employees, agents,
        and affiliates from any claims, losses, liabilities, expenses, or damages (including reasonable attorneys’ fees)
        arising from your use of the Website, violation of these Terms, or infringement of any third-party rights.
        10. Governing Law

        These Terms and any disputes arising from or related to the Website shall be governed by and construed in
        accordance with the laws of [Insert jurisdiction, e.g., the state of California, United States], without regard
        to its conflict of law principles. You agree to submit to the exclusive jurisdiction of the courts located in
        [Cairo, Eypt] for any legal action arising out of or related to these Terms.

        11. Changes to These Terms
        We reserve the right to update or modify these Terms at any time. Any changes will be posted on this page with
        an updated effective date. We encourage you to review these Terms periodically. Your continued use of the
        Website after any changes constitute your acceptance of the revised Terms.

        12. Contact Us
        If you have any questions or concerns about these Terms and Conditions, please contact us at:

        Egy Finance Jobs
        info@egyfinancejobs.com
        +201001085717"
        )) !!}
    </div>

</section>
<!--/ End terms -->

@endsection
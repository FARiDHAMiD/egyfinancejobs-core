<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    @include('courses.includes.header')
    @yield('styles')
    {!!htmlScriptTagJsApi()!!}
</head>

<body>



    @include('courses.includes.nav')
    <!-- content start -->
    @yield('courses.content')
    <!-- content end -->

    <!-- Footer start -->
    @include('courses.includes.footer')
    <!-- Footer end -->

    @if (session()->has('alert_message'))
    <div class="modal fade" id="alert-message-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center alert alert-{{ session()->get('alert_message')['icon'] }}">
                        {{ session()->get('alert_message')['message'] }}
                    </div>
                    {{ session()->forget('alert_message') }}
                </div>
            </div>
        </div>
    </div>
    @endif

    @if ($errors->any())
    <!-- errors Modal -->
    <div class="modal fade show" id="errors-modal" tabindex="-1" aria-labelledby="errors-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger py-1 mb-1">
                        <p class="m-0">- {{ $error }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

    <script>
        $("#alert-message-modal").modal('show');
        $("#errors-modal").modal('show');
    </script>
    {{-- custom scripts --}}
    @yield('scripts')

</body>

</html>
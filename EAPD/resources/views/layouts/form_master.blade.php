<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">

    <!--favicon icon-->
    <link rel="icon" type="image/png" href="{{ asset('/assets/img/favicon.png') }}">

    <title>الوكالة المصرية للشراكة من أجل التنمية</title>

    <!--web fonts-->
    <!-- <link href="http://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,700,900" rel="stylesheet">

    <!--bootstrap styles-->
    {{-- <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"> --}}

    <!--icon font-->
    <link href="{{ asset('/assets/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/vendor/dashlab-icon/dashlab-icon.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/vendor/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/vendor/themify-icons/css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/vendor/weather-icons/css/weather-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/select2/css/select2.css') }}" rel="stylesheet">

    <!--custom scrollbar-->
    <link href="{{ asset('/assets/vendor/m-custom-scrollbar/jquery.mCustomScrollbar.css') }}" rel="stylesheet">

    <!--jquery dropdown-->
    <link href="{{ asset('/assets/vendor/jquery-dropdown-master/jquery.dropdown.css') }}" rel="stylesheet">

    <!--jquery ui-->
    <link href="{{ asset('/assets/vendor/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">

    <!--iCheck-->
    <link href="{{ asset('/assets/vendor/icheck/skins/all.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/date-picker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">

    <!--custom styles-->
    <link href="{{ asset('/assets/css/main.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ asset('/assets/vendor/html5shiv.js') }}"></script>
    <script src="{{ asset('/assets/vendor/respond.min.js') }}"></script>
    <![endif]-->

    @yield('styles')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body class="top-nav">

    <!--/navigation : sidebar & header-->

    <!--main content wrapper-->
    <div class="content-wrapper">

        <div class="container">

            @yield('content')


        </div>

        <!--footer-->
        <footer class="sticky-footer">
            <div class="container">
                <div class="text-center">
                    <small>2018 &copy; الوكالة المصرية للشراكة من أجل التنمية | جميع الحقوق محفوظة.</small>
                </div>
            </div>
        </footer>
        <!--/footer-->
    </div>
    <!--/main content wrapper-->

    <!--basic scripts-->
    <script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/jquery-dropdown-master/jquery.dropdown.js') }}"></script>
    <script src="{{ asset('/assets/vendor/m-custom-scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/icheck/skins/icheck.min.js') }}"></script>

    <!--[if lt IE 9]>
<script src="{{ asset('/assets/vendor/modernizr.js') }}"></script>
<![endif]-->

    <!--basic scripts initialization-->
    <script src="{{ asset('/assets/js/scripts.min.js') }}"></script>
    @yield('scripts')
    <!--select2-->

    <!--init select2-->
    <script>
        // select country
        $(".selc_country").select2({
            placeholder: "@lang('main.select_country')"
        });
        $(".selc_course").select2({
            placeholder: "اختر دورة"
        });
        $(".selc_gender").select2({
            placeholder: "@lang('main.select_gender')"
        });
        $(".selc_stats").select2({
            placeholder: "@lang('main.select_status')"
        });
        $(".selc_stats2").select2({
            placeholder: "اختر حالة ترشيح المتدرب"
        });
    </script>
    <script src="{{ asset('assets/vendor/date-picker/js/bootstrap-datepicker.min.js') }}" charset="UTF-8"></script>

    <script src="{{ asset('assets/js/scripts.min.js') }}"></script>

    <script>
        $('.date-picker-input').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            orientation: "bottom",
            rtl: true,
            templates: {
                leftArrow: '<i class="fa fa-angle-right"></i>',
                rightArrow: '<i class="fa fa-angle-left"></i>'
            }
        });
    </script>
</body>

</html>

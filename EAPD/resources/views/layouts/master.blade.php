<!DOCTYPE html>
<?php
$locale = App::getLocale() == 'ar' ? '' : 'ltr_';
$direction = App::getLocale() == 'ar' ? 'rtl' : 'ltr';
?>
<html lang="{{ App::getLocale() }}" dir="{{ $direction }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="Egyptian Agency for Partnership for Development">
    <meta name="author" content="Mosaddek">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- favicon icon -->
    <link rel="icon" type="image/png" href="{{ asset($locale . 'assets/img/favicon.png') }}">

    <title>الوكالة المصرية للشراكة من أجل التنمية</title>

    <!-- web fonts - preconnect for performance -->
    <!-- Preload Google Fonts -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&display=swap">
    </noscript>

    <!-- Preload icon fonts -->
    <link rel="preload" href="{{ asset($locale . 'assets/vendor/font-awesome/css/font-awesome.min.css') }}"
        as="style">
    <link rel="preload" href="{{ asset($locale . 'assets/vendor/dashlab-icon/dashlab-icon.css') }}" as="style">
    <link rel="preload" href="{{ asset($locale . 'assets/vendor/simple-line-icons/css/simple-line-icons.css') }}"
        as="style">
    <link rel="preload" href="{{ asset($locale . 'assets/vendor/themify-icons/css/themify-icons.css') }}"
        as="style">

    <!-- icon fonts - load only what's needed -->
    <link href="{{ asset($locale . 'assets/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset($locale . 'assets/vendor/dashlab-icon/dashlab-icon.css') }}" rel="stylesheet">
    <link href="{{ asset($locale . 'assets/vendor/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">
    <link href="{{ asset($locale . 'assets/vendor/themify-icons/css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset($locale . 'assets/vendor/weather-icons/css/weather-icons.min.css') }}" rel="stylesheet">

    <!-- essential UI components -->
    {{-- <link href="{{ asset($locale . 'assets/vendor/m-custom-scrollbar/jquery.mCustomScrollbar.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset($locale . 'assets/vendor/jquery-dropdown-master/jquery.dropdown.css') }}" rel="stylesheet">
    <link href="{{ asset($locale . 'assets/vendor/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset($locale . 'assets/vendor/date-picker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset($locale . 'assets/vendor/icheck/skins/all.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/sweetalert/sweetalert.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->



    @yield('styles')

    <!-- Main stylesheet -->
    @vite(['resources/assets/sass/app.scss', 'resources/assets/sass/layout.scss'])

    <style>

    </style>
</head>

<body class="container-fluid">
    <!-- Mobile sidebar toggle button -->
    <button class="btn btn-primary sidebar-toggler" id="sidebar-toggle" aria-label="Toggle sidebar">
        <i class="fa fa-bars"></i>
    </button>
    <!-- Header -->
    <x-header :active="$active ?? ''" />
    <!-- Sidebar -->
    <x-sidebar :active="$active ?? ''" />

    <!-- Main Content -->
    <div class="content-wrapper {{ $direction == 'rtl' ? 'me-auto' : 'ms-auto' }}">
        @yield('content')
        <x-footer />
    </div>

    <!-- Scripts -->
    <script src="{{ asset($locale . 'assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset($locale . 'assets/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset($locale . 'assets/vendor/popper.min.js') }}"></script>

    @vite(['resources/assets/js/app.js'])

    {{-- <script src="{{ asset($locale . 'assets/vendor/jquery-dropdown-master/jquery.dropdown.js') }}" defer></script> --}}
    <script src="{{ asset($locale . 'assets/vendor/icheck/skins/icheck.min.js') }}" defer></script>

    <!-- Additional scripts -->
    <script src="{{ asset('assets/sweetalert/sweetalert.min.js') }}" defer></script>
    {{-- <script src="{{ asset($locale . 'assets/vendor/m-custom-scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"
        defer></script> --}}
    {{-- <script src="{{ asset($locale . 'assets/vendor/m-custom-scrollbar/jquery.mCustomScrollbar.js') }}" defer></script> --}}
    {{-- <script src="{{ asset($locale . 'assets/vendor/m-custom-scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"
        defer></script> --}}
    {{-- <script src="{{ asset($locale . 'assets/js/scripts.min.js') }}" defer></script> --}}
    {{-- <script src="{{ asset($locale . 'assets/vendor/date-picker/js/bootstrap-datepicker.min.js') }}" charset="UTF-8" defer> --}}
    </script>
    {{-- <script src="{{ asset($locale . 'assets/vendor/select2/js/select2.min.js') }}"></script> --}}

    @stack('scripts')

    <script>
        // Initialize UI components when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle sidebar on mobile
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const collapseBtn = document.getElementById('collapse-sidebar');
            const sidebar = document.querySelector('.sidebar-container');
            const body = document.body;

            // Handle sidebar collapse
            if (collapseBtn) {
                // Check if sidebar was previously collapsed
                if (localStorage.getItem('sidebarCollapsed') === 'true') {
                    body.classList.add('sidebar-collapsed');
                    collapseBtn.querySelector('i').classList.add('fa-chevron-right');
                    collapseBtn.querySelector('i').classList.remove('fa-chevron-left');
                }

                collapseBtn.addEventListener('click', function() {
                    body.classList.toggle('sidebar-collapsed');
                    const isCollapsed = body.classList.contains('sidebar-collapsed');

                    // Store the state
                    localStorage.setItem('sidebarCollapsed', isCollapsed);

                    // Toggle the icon
                    const icon = this.querySelector('i');
                    if (isCollapsed) {
                        icon.classList.remove('fa-chevron-left');
                        icon.classList.add('fa-chevron-right');
                    } else {
                        icon.classList.remove('fa-chevron-right');
                        icon.classList.add('fa-chevron-left');
                    }
                });
            }

            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                    body.classList.toggle('sidebar-open');
                });

                // Close sidebar when clicking outside on mobile
                document.addEventListener('click', function(event) {
                    const isClickInsideSidebar = sidebar.contains(event.target);
                    const isClickOnToggle = sidebarToggle.contains(event.target);

                    if (!isClickInsideSidebar && !isClickOnToggle && sidebar.classList.contains('show')) {
                        sidebar.classList.remove('show');
                        body.classList.remove('sidebar-open');
                    }
                });
            }

            // Toggle collapse icons
            document.querySelectorAll('[data-bs-toggle="collapse"]').forEach((toggle) => {
                toggle.addEventListener("click", function() {
                    const icon = this.querySelector(".fa-chevron-down");
                    if (icon) icon.classList.toggle("rotate-180");
                });
            });

            const selectAllPermissions = document.getElementById('select-all-permissions');
            if (selectAllPermissions) {
                selectAllPermissions.addEventListener('change', function() {
                    const checkboxes = document.querySelectorAll('input[name="permissions[]"]');
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                });
            }

            // Make sidebar only scroll when content overflows
            const sidebarContent = document.querySelector('.sidebar-container .d-flex');
            if (sidebarContent) {
                sidebarContent.style.overflowY = 'auto';
                sidebarContent.style.overflowX = 'hidden';
                sidebarContent.style.height = '100%';
            }

            // Initialize datepicker
            $('.date-picker-input').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                orientation: "bottom",
                rtl: {{ $direction == 'rtl' ? 'true' : 'false' }},
                templates: {
                    leftArrow: '<i class="fa fa-angle-{{ $direction == 'rtl' ? 'right' : 'left' }}"></i>',
                    rightArrow: '<i class="fa fa-angle-{{ $direction == 'rtl' ? 'left' : 'right' }}"></i>'
                }
            });

            // Initial setup based on localStorage
            const setupSidebarState = () => {
                const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
                if (isCollapsed) {
                    // Apply collapsed state without animation
                    document.documentElement.style.setProperty('--transition-speed', '0s');
                    body.classList.add('sidebar-collapsed');
                    if (collapseBtn) {
                        const icon = collapseBtn.querySelector('i');
                        icon.classList.remove('fa-chevron-left');
                        icon.classList.add('fa-chevron-right');
                    }
                    // Restore animation after initial state is set
                    setTimeout(() => {
                        document.documentElement.style.setProperty('--transition-speed', '0.3s');
                    }, 50);
                }
            };

            // Run setup immediately
            setupSidebarState();

            // Handle window resize
            const handleResize = () => {
                if (window.innerWidth > 991.98) {
                    // Only remove mobile sidebar classes
                    sidebar.classList.remove('show');
                    body.classList.remove('sidebar-open');
                }
            };

            window.addEventListener('resize', handleResize);

            // Handle ESC key to close sidebar
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                    body.classList.remove('sidebar-open');
                }
            });

            // Add touch swipe functionality for mobile
            let touchStartX = 0;
            let touchEndX = 0;

            document.addEventListener('touchstart', e => {
                touchStartX = e.changedTouches[0].screenX;
            }, {
                passive: true
            });

            document.addEventListener('touchend', e => {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            }, {
                passive: true
            });

            function handleSwipe() {
                const swipeThreshold = 100;

                if (direction === 'rtl') {
                    // RTL direction
                    if (touchEndX - touchStartX > swipeThreshold) {
                        // Swipe right (open sidebar)
                        if (!sidebar.classList.contains('show')) {
                            sidebar.classList.add('show');
                            body.classList.add('sidebar-open');
                        }
                    } else if (touchStartX - touchEndX > swipeThreshold) {
                        // Swipe left (close sidebar)
                        if (sidebar.classList.contains('show')) {
                            sidebar.classList.remove('show');
                            body.classList.remove('sidebar-open');
                        }
                    }
                } else {
                    // LTR direction
                    if (touchEndX - touchStartX > swipeThreshold) {
                        // Swipe right (close sidebar)
                        if (sidebar.classList.contains('show')) {
                            sidebar.classList.remove('show');
                            body.classList.remove('sidebar-open');
                        }
                    } else if (touchStartX - touchEndX > swipeThreshold) {
                        // Swipe left (open sidebar)
                        if (!sidebar.classList.contains('show')) {
                            sidebar.classList.add('show');
                            body.classList.add('sidebar-open');
                        }
                    }
                }
            }
        });

        // Delete confirmation
        $('body').on('click', '.delete-row', function(e) {
            var url = $(this).data('delete-url');
            swal({
               title: "{{ trans('main.تأكيد الحذف') }}",
                text: "{{ trans('main.هل أنت متأكد أنك تريد حذف هذا العنصر؟') }}",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "{{ trans('main.نعم، احذف') }}",
                cancelButtonText: "{{ trans('main.إلغاء') }}",
                closeOnConfirm: false
            }, function() {
                window.location = url;
            });
        });
    </script>
</body>

</html>

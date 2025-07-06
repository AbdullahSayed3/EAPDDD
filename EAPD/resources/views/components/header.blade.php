@props(['active' => ''])
<?php
$locale = App::getLocale() == 'ar' ? '' : 'ltr_';
$direction = App::getLocale() == 'ar' ? 'rtl' : 'ltr';
?>

<header class="header bg-primary shadow-sm py-2 px-3 d-flex justify-content-between align-items-center">
    <!-- Logo Section -->
    <div class="d-flex align-items-center">
        <a href="/" class="d-flex align-items-center text-decoration-none">
            <img src="{{ asset('/assets/img/top-logo.png') }}" alt="Logo" class="img-fluid header-logo"
                style="max-height: 40px;">
        </a>
    </div>

    <!-- Right Section (Language Switcher & User Profile) -->
    <div class="d-flex align-items-center gap-3">
        <!-- Language Switcher -->
        <div class="language-switcher">
            @include('components.language-switcher')
        </div>

        <!-- User Profile -->
        <div class="user-profile">
            @include('components.user-profile')
        </div>
    </div>

    <style>
        .header {
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1030;
            height: 60px;
        }

        .header-logo {
            max-width: 150px;
            height: auto;
        }

        /* Mobile optimizations */
        @media (max-width: 767.98px) {
            .header {
                padding: 0.5rem !important;
            }

            .header-logo {
                max-width: 120px;
            }

            .language-switcher,
            .user-profile {
                padding: 0.25rem !important;
            }
        }
    </style>
</header>

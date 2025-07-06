@props(['active' => ''])
<?php
$locale = App::getLocale() == 'ar' ? '' : 'ltr_';
$direction = App::getLocale() == 'ar' ? 'rtl' : 'ltr';
?>

<!-- Include the CSS file -->
@vite(['resources/assets/sass/sidebar.scss'])

{{-- <div class="py-5"> --}}
<div class="col-md-2 col-xl-2 d-flex flex-row px-0 mt-3 rounded-4 bg-white sidebar-container position-fixed"
    id="sidebar">
    <div class="position-relative d-flex flex-column align-items-center align-items-sm-start px-2 py-2 text-primary">
        <!-- Main content wrapper with scrolling -->
        <div class="w-100 d-flex flex-column flex-fill overflow-auto sidebar-content">
            <!-- Navigation Items -->
            <ul class="nav nav-pills flex-column w-100 mb-auto" id="sidebar-nav">
                <!-- Dashboard -->
                <li class="nav-item mb-2">
                    <a href="{{ route('home') }}"
                        class="nav-link text-primary d-flex align-items-center gap-2 py-2 {{ request()->routeIs('home') ? 'active' : '' }}"
                        data-bs-toggle="tooltip" data-bs-placement="right" title="{{ awtTrans('الصفحة الرئيسية') }}">
                        <i class="vl_dashboard"></i><span class="nav-text">{{ awtTrans('الصفحة الرئيسية') }}</span>
                    </a>
                </li>

                <!-- Courses Menu -->
                @can('show_courses')
                    @include('components.sidebar-dropdown', [
                        'active' => $active,
                        'section' => 'courses',
                        'icon' => 'icon-book-open',
                        'title' => awtTrans('الدورات التدريبية'),
                        'items' => [
                            ['route' => 'courses.index', 'text' => awtTrans('الدورات التدريبية')],
                            ['route' => 'courses.create', 'text' => awtTrans('إضافة دورة تدريبية')],
                            ['route' => 'countries.index', 'text' => awtTrans('الدول')],
                            ['route' => 'places.index', 'text' => trans('awt.مكان الإنعقاد')],
                            ['route' => 'coursesPartners.index', 'text' => awtTrans('مراكز التميز والشركاء')],
                            ['route' => 'assessments.index', 'text' => awtTrans('التقييمات')],
                        ],
                    ])
                @endcan

                <!-- Applicants Menu -->
                @can('show_applicants')
                    @include('components.sidebar-dropdown', [
                        'active' => $active,
                        'section' => 'applicants',
                        'icon' => 'icon-people',
                        'title' => awtTrans('قائمة المتدربين'),
                        'items' => [
                            ['route' => 'applicants.index', 'text' => awtTrans('قائمة المتدربين')],
                            ['route' => 'applicants.create', 'text' => awtTrans('إضافة متدربين')],
                            // [
                            //     'route' => 'applicants.index',
                            //     'text' => awtTrans('قائمة الإنتظار'),
                            //     'params' => ['waitList' => 'true'],
                            // ],
                        ],
                    ])
                @endcan

                <!-- Experts Menu -->
                @can('show_experts')
                    <li class="nav-item mb-2">
                        <a href="{{ route('experts.index') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                            title="{{ awtTrans('قسم الخبراء') }}"
                            class="nav-link text-primary d-flex align-items-center gap-2 py-2 {{ request()->routeIs('experts.*') ? 'active' : '' }}">
                            <i class="ti-id-badge"></i><span class="nav-text">{{ awtTrans('قسم الخبراء') }}</span>
                        </a>
                    </li>
                @endcan

                <!-- Aids Menu -->
                @can('show_aids')
                    @include('components.sidebar-dropdown', [
                        'active' => $active,
                        'section' => 'aids',
                        'icon' => 'icon-people',
                        'title' => awtTrans('المنح والمعونات'),
                        'items' => [
                            ['route' => 'aids.index', 'text' => awtTrans('المساعدات')],
                            ['route' => 'cravans.index', 'text' => awtTrans('caravan')],
                        ],
                    ])
                    <li class="nav-item mb-2">
                        <a href="{{ route('aids.index') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                            title="{{ awtTrans('المنح والمعونات') }}"
                            class="nav-link text-primary d-flex align-items-center gap-2 py-2 {{ request()->routeIs('aids.*') ? 'active' : '' }}">
                            <i class="fa fa-money"></i><span class="nav-text">{{ awtTrans('المنح والمعونات') }}</span>
                        </a>
                    </li>
                @endcan

                <!-- Events Menu -->
                @can('show_events')
                    <li class="nav-item mb-2">
                        <a href="{{ route('events.index') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                            title="{{ awtTrans('الفعاليات') }}"
                            class="nav-link text-primary d-flex align-items-center gap-2 py-2 {{ request()->routeIs('events.*') ? 'active' : '' }}">
                            <i class="fa fa-calendar"></i><span class="nav-text">{{ awtTrans('الفعاليات') }}</span>
                        </a>
                    </li>
                @endcan

                <!-- Scholarships Menu -->
                @can('show_scholarships')
                    <li class="nav-item mb-2">
                        <a href="{{ route('scholarships.index') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                            title="{{ awtTrans('المنح الدراسية') }}"
                            class="nav-link text-primary d-flex align-items-center gap-2 py-2 {{ request()->routeIs('scholarships.*') ? 'active' : '' }}">
                            <i class="fa fa-graduation-cap"></i><span
                                class="nav-text">{{ awtTrans('المنح الدراسية') }}</span>
                        </a>
                    </li>
                @endcan

                <!-- Learners Menu -->
                @can('show_learners')
                    <li class="nav-item mb-2">
                        <a href="{{ route('learners.index') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                            title="{{ awtTrans('قائمة الدارسين') }}"
                            class="nav-link text-primary d-flex align-items-center gap-2 py-2 {{ request()->routeIs('learners.*') ? 'active' : '' }}">
                            <i class="fa fa-users"></i><span class="nav-text">{{ awtTrans('قائمة الدارسين') }}</span>
                        </a>
                    </li>
                @endcan

                <!-- Reports Menu -->
                @can('show_reports')
                    <li class="nav-item mb-2">
                        <a href="{{ route('reports.index') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                            title="{{ awtTrans('التقارير') }}"
                            class="nav-link text-primary d-flex align-items-center gap-2 py-2 {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                            <i class="fa fa-files-o"></i><span class="nav-text">{{ awtTrans('التقارير') }}</span>
                        </a>
                    </li>
                @endcan


                <!-- Settings Menu -->
                @can('show_achivements')
                    @include('components.sidebar-dropdown', [
                        'active' => $active,
                        'section' => 'achievements',
                        'icon' => 'fa fa-cogs',
                        'title' => awtTrans('الانجازات'),
                        'items' => [
                            ['route' => 'achievements.index', 'text' => awtTrans('الانجازات')],

                            ['route' => 'achievement_type.index', 'text' => awtTrans('تصنيفات الانجازات')],
                        ],
                    ])
                @endcan
                <!-- Settings Menu -->
                @can('mange_website')
                    @include('components.sidebar-dropdown', [
                        'active' => $active,
                        'section' => 'website',
                        'icon' => 'fa fa-cogs',
                        'title' => awtTrans('ادارة الموقع الالكتروني'),
                        'items' => [
                            ['route' => 'partners.index', 'text' => awtTrans('partners')],
                            ['route' => 'faqs.index', 'text' => awtTrans('faqs')],
                            ['route' => 'blogs.index', 'text' => awtTrans('blogs')],
                            ['route' => 'teams.index', 'text' => awtTrans('teams')],
                            ['route' => 'jobs.index', 'text' => awtTrans('jobs')],
                            ['route' => 'job_types.index', 'text' => trans('awt.jobs_types')],
                            ['route' => 'contact_us.index', 'text' => trans('awt.contact_us')],
                        ],
                    ])
                @endcan

                <!-- Settings Menu -->
                @can('show_settings')
                    @include('components.sidebar-dropdown', [
                        'active' => $active,
                        'section' => 'settings',
                        'icon' => 'fa fa-cogs',
                        'title' => awtTrans('الإعدادات'),
                        'items' => [
                            ['route' => 'event_types.index', 'text' => awtTrans('انواع الفعاليات')],
                            ['route' => 'aids_types.index', 'text' => awtTrans('انواع المنح')],
                            ['route' => 'aids_suppliers.index', 'text' => awtTrans('موردين المنح')],
                            ['route' => 'trial_terals_fields.index', 'text' => awtTrans('مجالات التعاون')],
                            [
                                'route' => 'course_naturals.index',
                                'text' => awtTrans('طبيعه الدورات التدريبيه'),
                            ],
                            ['route' => 'course_fields.index', 'text' => awtTrans('مجالات الدورات التدريبيه')],
                            [
                                'route' => 'course_trainees.index',
                                'text' => awtTrans('مدربين الدورات التدريبيه'),
                            ],
                            ['route' => 'roles.index', 'text' => awtTrans('صلاحيات المسمى الوظيفي')],
                            ['route' => 'users.index', 'text' => awtTrans('قائمة الأعضاء')],
                            ['route' => 'activity_logs.index', 'text' => awtTrans('activity_logs')],
                        ],
                    ])
                @endcan
            </ul>
        </div>
        <!-- Sidebar collapse button -->
        <button class="collapse-btn" id="collapse-sidebar" aria-label="Collapse sidebar">
            <i class="fa fa-chevron-{{ $direction == 'rtl' ? 'right' : 'left' }}"></i>
        </button>
    </div>
</div>
{{-- </div> --}}

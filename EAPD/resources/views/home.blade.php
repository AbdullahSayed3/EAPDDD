@extends('layouts.master')

@section('content')
    <!-- Page Title -->
    <x-base.breadcrumb title="الصفحة الرئيسية" :breadcrumbs="[['label' => 'الصفحة الرئيسية']]" />

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="row col-lg-6" style="height: fit-content;">
            @include('components.charts.stat-card', [
                'route' => route('scholarships.index'),
                'colClasses' => 'col-lg-4 col-md-4 col-sm-6',
                'bgColor' => 'bg-white',
                // 'icon' => 'fa fa-graduation-cap',
                'value' => $scholarships,
                'label' => awtTrans('المنح الدراسية'),
            ])
            @include('components.charts.stat-card', [
                'route' => route('courses.index'),
                'colClasses' => 'col-lg-4 col-md-4 col-sm-6',
                'bgColor' => 'bg-white',
                // 'icon' => 'fa fa-book',
                'value' => $courses,
                'label' => awtTrans('الدورات'),
            ])
            @include('components.charts.stat-card', [
                'route' => route('applicants.index'),
                'colClasses' => 'col-lg-4 col-md-4 col-sm-6',
                'bgColor' => 'bg-white',
                // 'icon' => 'fa fa-users',
                'value' => $applicants,
                'label' => awtTrans('المتدربين'),
            ])
            @include('components.charts.stat-card', [
                'route' => route('aids.index'),
                'colClasses' => 'col-lg-4 col-md-4 col-sm-6',
                'bgColor' => 'bg-white',
                // 'icon' => 'fa fa-handshake-o',
                'value' => $aids,
                'label' => awtTrans('المنح والمعونات'),
            ])
            @include('components.charts.stat-card', [
                'route' => route('aids.index'),
                'colClasses' => 'col-lg-4 col-md-4 col-sm-6',
                'bgColor' => 'bg-white',
                // 'icon' => 'fa fa-handshake-o',
                'value' => $aids,
                'label' => awtTrans('المنح والمعونات'),
            ])
            @include('components.charts.stat-card', [
                'route' => '#',
                'colClasses' => 'col-lg-4 col-md-4 col-sm-6',
                'bgColor' => 'bg-danger',
                'textColor' => 'text-white fw-bold',
                // 'icon' => 'fa fa-money',
                'value' => $total,
                'decimals' => 2,
                'label' => awtTrans('التكلفة الكلية'),
            ])
        </div>
        @include('components.charts.chart-card', [
            'class' => 'col-lg-6',
            'height' => '320',
            'title' => awtTrans('عدد المتدربين حسب مجال التدريب'),
            'canvasId' => 'traineesPerFieldChart',
        ])
    </div>

    <!-- Charts Section -->
    <div class="row mb-4">
        @include('components.charts.chart-card', [
            'title' => awtTrans('نوع الدورة وعدد الدورات والمتدربين حسب الجنس'),
            'canvasId' => 'coursesByTypeChart',
            'class' => 'col-lg-4',
        ])
        @include('components.charts.chart-card', [
            'title' => awtTrans('تزايد أعداد المتدربين والدورات'),
            'canvasId' => 'monthlyProgressChart',
            'class' => 'col-lg-8',
        ])
    </div>

    <!-- Additional Charts Section -->
    <div class="row mb-4">
        @include('components.charts.chart-card', [
            'class' => 'col-lg-6',
            'height' => '400',
            'title' => awtTrans('عدد الخبراء حسب التخصص'),
            'canvasId' => 'expertsBySpecialistChart',
        ])
        @include('components.charts.chart-card', [
            'title' => awtTrans('عدد المنح وجهات المنح'),
            'canvasId' => 'scholarshipsByOwnerChart',
        ])
    </div>

    <!-- Bio Charts Section -->
    <div class="row mb-4">
        @include('components.charts.chart-card', [
            'title' => awtTrans('مقارنة المتدربين بين آخر عامين'),
            'canvasId' => 'genderComparisonChart',
        ])

    </div>
@endsection

@section('styles')
    <style>
        .card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
        }

        .icon-circle {
            transition: all 0.3s ease;
        }

        .card:hover .icon-circle {
            transform: scale(1.1);
        }

        .chart-container {
            position: relative;
            height: 300px;
        }
    </style>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Color Palette
        const colorPalette = ['#2980b9', '#27ae60', '#8e44ad', '#f39c12', '#c0392b', '#7f8c8d'];

        // Helper function to create bar charts with optimized y-axis
        function createBarChart(canvasId, labels, datasets, title, yLabel, xLabel, suggestedMin = 0, suggestedMax = null) {
            const ctx = document.getElementById(canvasId).getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: title
                        },
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            enabled: true
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMin: suggestedMin,
                            suggestedMax: suggestedMax,
                            title: {
                                display: true,
                                text: yLabel
                            },
                            ticks: {
                                stepSize: 1
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: xLabel
                            }
                        }
                    }
                }
            });
        }

        // Chart initializations
        (function() {
            // Chart 1: Trainees per Field
            const traineesData = @json($traineesPerField);
            const traineeColors = colorPalette.slice(0, traineesData.length);
            createBarChart(
                'traineesPerFieldChart',
                traineesData.map(item => item.field),
                [{
                    label: '{{ trans('awt.عدد المتدربين') }}',
                    data: traineesData.map(item => item.trainees),
                    backgroundColor: traineeColors,
                    borderColor: traineeColors,
                    borderWidth: 1,
                    // Add this for individual bar labels:
                    datalabels: {
                        color: '#000', // Label color
                        font: {
                            size: 12, // Font size for bar labels
                            weight: 'bold' // Optional: font weight
                        },
                        anchor: 'end', // Position relative to the bar
                        align: 'top', // Alignment
                        formatter: function(value) {
                            return value; // You can format the value here if needed
                        }
                    }
                }],
                '{{ trans('awt.عدد المتدربين حسب مجال التدريب') }}',
                '{{ trans('awt.عدد المتدربين') }}',
                '{{ trans('awt.مجال التدريب') }}',
                0,
                Math.max(...traineesData.map(item => item.trainees)) + 1, {
                    plugins: {
                        // Configure the datalabels plugin
                        datalabels: {
                            display: true,
                            color: '#000',
                            font: {
                                size: 12,
                                weight: 'bold'
                            },
                            anchor: 'end',
                            align: 'top'
                        },
                        tooltip: {
                            mode: 'nearest',
                            intersect: true
                        }
                    },
                    // Additional options to prevent label crowding
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                font: {
                                    size: 10 // Y-axis label font size
                                }
                            }
                        },
                        x: {
                            ticks: {
                                font: {
                                    size: 7 // X-axis label font size
                                }
                            }
                        }
                    }
                }
            );

            // Chart 2: Courses by Type
            const coursesData = @json($coursesByType);
            const maxCourses = Math.max(...coursesData.map(item => item.courses_count));
            const maxTrainees = Math.max(...coursesData.map(item => item.total_trainees));
            const suggestedMaxCourses = Math.max(maxCourses, maxTrainees) + 1;
            createBarChart(
                'coursesByTypeChart',
                coursesData.map(item => item.type),
                [{
                        label: '{{ trans('awt.عدد الدورات') }}',
                        data: coursesData.map(item => item.courses_count),
                        backgroundColor: '#00E096',
                        borderColor: '#00E096',
                        borderWidth: 1,
                        barPercentage: 0.5,
                        categoryPercentage: 0.5
                    },
                    {
                        label: '{{ trans('awt.متدربين ذكور') }}',
                        data: coursesData.map(item => item.male_trainees),
                        backgroundColor: '#0077E4',
                        borderColor: '#0077E4',
                        borderWidth: 1,
                        barPercentage: 0.5,
                        categoryPercentage: 0.5
                    },
                    {
                        label: '{{ trans('awt.متدربات إناث') }}',
                        data: coursesData.map(item => item.female_trainees),
                        backgroundColor: '#00E096',
                        borderColor: '#00E096',
                        borderWidth: 1,
                        barPercentage: 0.5,
                        categoryPercentage: 0.5
                    },
                    {
                        label: '{{ trans('awt.إجمالي المتدربين') }}',
                        data: coursesData.map(item => item.total_trainees),
                        backgroundColor: '#0077E4',
                        borderColor: '#0077E4',
                        borderWidth: 1,
                        barPercentage: 0.5,
                        categoryPercentage: 0.5
                    }
                ],
                '{{ trans('awt.نوع الدورة وعدد الدورات والمتدربين حسب الجنس') }}',
                '{{ trans('awt.عدد المتدربين') }}',
                '{{ trans('awt.نوع الدورة') }}',
                0,
                suggestedMaxCourses
            );

            // Chart 3: Experts by Specialist
            const expertsData = @json($expertsBySpecialist);
            const expertColors = colorPalette.slice(0, expertsData.length);
            createBarChart(
                'expertsBySpecialistChart',
                expertsData.map(item => item.specialist),
                [{
                    label: '{{ trans('awt.عدد الخبراء') }}',
                    data: expertsData.map(item => item.experts_count),
                    backgroundColor: expertColors,
                    borderColor: expertColors,
                    borderWidth: 1
                }],
                '{{ trans('awt.عدد الخبراء حسب التخصص') }}',
                '{{ trans('awt.عدد الخبراء') }}',
                '{{ trans('awt.التخصص') }}',
                0,
                Math.max(...expertsData.map(item => item.experts_count)) + 1
            );

            // Chart 4: Scholarships by Owner
            const scholarshipsData = @json($scholarshipsByOwner);
            const scholarshipColors = colorPalette.slice(0, scholarshipsData.length);
            createBarChart(
                'scholarshipsByOwnerChart',
                scholarshipsData.map(item => item.owner),
                [{
                    label: '{{ trans('awt.عدد المنح') }}',
                    data: scholarshipsData.map(item => item.scholarships_count),
                    backgroundColor: scholarshipColors,
                    borderColor: scholarshipColors,
                    borderWidth: 1
                }],
                '{{ trans('awt.عدد المنح وجهات المنح') }}',
                '{{ trans('awt.عدد المنح') }}',
                '{{ trans('awt.جهة المنحة') }}',
                0,
                Math.max(...scholarshipsData.map(item => item.scholarships_count)) + 1, {
                    tooltips: {
                        mode: 'nearest',
                        intersect: false
                    }
                }
            );

            // Chart 5: Gender Comparison
            const genderData = @json($genderComparison);
            const maxGender = Math.max(genderData.last_year.male, genderData.last_year.female, genderData.current_year
                .male, genderData.current_year.female);
            createBarChart(
                'genderComparisonChart',
                [genderData.last_year.year, genderData.current_year.year],
                [{
                        label: '{{ trans('awt.ذكر') }}',
                        data: [genderData.last_year.male, genderData.current_year.male],
                        backgroundColor: '#2980b9',
                        borderColor: '#2980b9',
                        borderWidth: 1
                    },
                    {
                        label: '{{ trans('awt.إناث') }}',
                        data: [genderData.last_year.female, genderData.current_year.female],
                        backgroundColor: '#e83e8c',
                        borderColor: '#e83e8c',
                        borderWidth: 1
                    }
                ],
                '{{ trans('awt.مقارنة المتدربين بين آخر عامين') }}',
                '{{ trans('awt.عدد المتدربين') }}',
                '{{ trans('awt.السنة') }}',
                0,
                maxGender + 1, {
                    tooltips: {
                        mode: 'nearest',
                        intersect: true
                    }
                }
            );

            // Chart 6: Monthly Progress (Line Chart)
            const monthlyData = @json($monthlyData);
            const ctx7 = document.getElementById('monthlyProgressChart').getContext('2d');
            new Chart(ctx7, {
                type: 'line',
                data: {
                    labels: monthlyData.map(item => item.month),
                    datasets: [{
                            label: '{{ trans('awt.عدد المتدربين') }}',
                            data: monthlyData.map(item => item.trainees),
                            borderColor: '#00E096',
                            backgroundColor: 'rgba(41, 128, 185, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4
                        },
                        {
                            label: '{{ trans('awt.عدد الدورات') }}',
                            data: monthlyData.map(item => item.courses),
                            borderColor: '#FB5B5F',
                            backgroundColor: 'rgba(243, 156, 18, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: '{{ trans('awt.تزايد أعداد المتدربين والدورات') }}'
                        },
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            enabled: true,
                            position: 'nearest'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMin: 0,
                            suggestedMax: Math.max(...monthlyData.map(item => Math.max(item.trainees, item
                                .courses))) + 1,
                            title: {
                                display: true,
                                text: '{{ trans('awt.العدد') }}'
                            },
                            ticks: {
                                stepSize: 1
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: '{{ trans('awt.الشهر') }}'
                            },
                            ticks: {
                                maxRotation: 45,
                                minRotation: 0
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'nearest'
                    }
                }
            });
        })();
    </script>
@endpush

   // Chart 1: عدد المتدربين حسب مجال التدريب
    const traineesPerFieldData = @json($traineesPerField);
    const ctx1 = document.getElementById('traineesPerFieldChart').getContext('2d');

    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: traineesPerFieldData.map(item => item.field),
            datasets: [{
                label: 'عدد المتدربين',
                data: traineesPerFieldData.map(item => item.trainees),
                backgroundColor: [
                    '#007bff',
                    '#28a745',
                    '#ffc107',
                    '#dc3545',
                    '#6f42c1',
                    '#fd7e14'
                ],
                borderColor: [
                    '#0056b3',
                    '#1e7e34',
                    '#e0a800',
                    '#c82333',
                    '#5a32a3',
                    '#e8610e'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'عدد المتدربين حسب مجال التدريب'
                },
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'عدد المتدربين'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'مجال التدريب'
                    }
                }
            }
        }
    });

    // Chart 2: نوع الدورة وعدد الدورات والمتدربين حسب الجنس
    const coursesByTypeData = @json($coursesByType);
    const ctx2 = document.getElementById('coursesByTypeChart').getContext('2d');
    
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: coursesByTypeData.map(item => item.type),
            datasets: [
                {
                    label: '{{trans('awt.عدد الدورات')}}',
                    data: coursesByTypeData.map(item => item.courses_count),
                    backgroundColor: '#007bff',
                    borderColor: '#0056b3',
                    borderWidth: 1
                },
                {
                    label: '{{trans('awt.متدربين ذكور')}}',
                    data: coursesByTypeData.map(item => item.male_trainees),
                    backgroundColor: '#28a745',
                    borderColor: '#1e7e34',
                    borderWidth: 1
                },
                {
                    label: '{{trans('awt.متدربات إناث')}}',
                    data: coursesByTypeData.map(item => item.female_trainees),
                    backgroundColor: '#ffc107',
                    borderColor: '#e0a800',
                    borderWidth: 1
                },
                {
                    label: '{{trans('awt.إجمالي المتدربين')}}',
                    data: coursesByTypeData.map(item => item.total_trainees),
                    backgroundColor: '#dc3545',
                    borderColor: '#c82333',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'نوع الدورة وعدد الدورات والمتدربين حسب الجنس'
                },
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'العدد'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'نوع الدورة'
                    }
                }
            }
        }
    });

    // Chart 3: عدد الخبراء حسب التخصص
    const expertsBySpecialistData = @json($expertsBySpecialist);
    const ctx3 = document.getElementById('expertsBySpecialistChart').getContext('2d');
    
    new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: expertsBySpecialistData.map(item => item.specialist),
            datasets: [{
                label: 'عدد الخبراء',
                data: expertsBySpecialistData.map(item => item.experts_count),
                backgroundColor: [
                    '#17a2b8',
                    '#6f42c1',
                    '#fd7e14',
                    '#20c997',
                    '#e83e8c',
                    '#6c757d'
                ],
                borderColor: [
                    '#138496',
                    '#5a32a3',
                    '#e8610e',
                    '#1c9c7d',
                    '#d91a72',
                    '#545b62'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'عدد الخبراء حسب التخصص'
                },
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'عدد الخبراء'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'التخصص'
                    }
                }
            }
        }
    });

    // Chart 4: عدد المنح وجهات المنح
    const scholarshipsByOwnerData = @json($scholarshipsByOwner);
    const ctx4 = document.getElementById('scholarshipsByOwnerChart').getContext('2d');
    
    new Chart(ctx4, {
        type: 'bar',
        data: {
            labels: scholarshipsByOwnerData.map(item => item.owner),
            datasets: [{
                label: 'عدد المنح',
                data: scholarshipsByOwnerData.map(item => item.scholarships_count),
                backgroundColor: [
                    '#ffc107',
                    '#28a745',
                    '#007bff',
                    '#dc3545',
                    '#6f42c1',
                    '#fd7e14',
                    '#20c997'
                ],
                borderColor: [
                    '#e0a800',
                    '#1e7e34',
                    '#0056b3',
                    '#c82333',
                    '#5a32a3',
                    '#e8610e',
                    '#1c9c7d'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'عدد المنح وجهات المنح'
                },
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'عدد المنح'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'جهة المنح'
                    },
                    ticks: {
                        maxRotation: 45,
                        minRotation: 0
                    }
                }
            }
        }
    });

     // Bar Chart: مقارنة بين آخر عامين
    const genderComparisonData = @json($genderComparison);
    const ctx6 = document.getElementById('genderComparisonChart').getContext('2d');
    
    new Chart(ctx6, {
        type: 'bar',
        data: {
            labels: [genderComparisonData.last_year.year, genderComparisonData.current_year.year],
            datasets: [
                {
                    label: 'ذكور',
                    data: [genderComparisonData.last_year.male, genderComparisonData.current_year.male],
                    backgroundColor: '#007bff',
                    borderColor: '#0056b3',
                    borderWidth: 1
                },
                {
                    label: 'إناث',
                    data: [genderComparisonData.last_year.female, genderComparisonData.current_year.female],
                    backgroundColor: '#e83e8c',
                    borderColor: '#d91a72',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'مقارنة المتدربين بين آخر عامين'
                },
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'عدد المتدربين'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'السنة'
                    }
                }
            }
        }
    });

    // Line Chart: تزايد أعداد المتدربين والدورات
    const monthlyData = @json($monthlyData);
    const ctx7 = document.getElementById('monthlyProgressChart').getContext('2d');
    
    new Chart(ctx7, {
        type: 'line',
        data: {
            labels: monthlyData.map(item => item.month),
            datasets: [
                {
                    label: 'عدد المتدربين',
                    data: monthlyData.map(item => item.trainees),
                    borderColor: '#28a745',
                    backgroundColor: 'rgba(40, 167, 69, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'عدد الدورات',
                    data: monthlyData.map(item => item.courses),
                    borderColor: '#dc3545',
                    backgroundColor: 'rgba(220, 53, 69, 0.1)',
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
                    text: 'تزايد أعداد المتدربين والدورات (آخر 12 شهر)'
                },
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'العدد'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'الشهر'
                    },
                    ticks: {
                        maxRotation: 45,
                        minRotation: 0
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Courses DataTable Configuration
        if (document.getElementById('courses-datatable')) {
            const coursesTable = $('#courses-datatable').DataTable({
                ...dataTablesConfig,
                ajax: {
                    url: '{{ route('reports.comprehensive.data', ['type' => 'courses']) }}',
                    method: 'GET',
                    data: function(d) {
                        // Attach searchParams to request
                        Object.entries(searchParams).forEach(([key, value]) => {
                            if (key === 'country' && Array.isArray(value)) {
                                value.forEach((id, index) => {
                                    d[`country[${index}]`] = id;
                                });
                            } else {
                                d[key] = value;
                            }
                        });

                        // console.log("Courses DataTable request parameters:", d);
                        return d;
                    },
                    error: function(xhr, error) {
                        console.error('Ajax error:', error);
                        console.error('Response:', xhr.responseText);
                    },
                    dataSrc: function(json) {
                        // console.log('Courses API Response:', json);
                        if (json.data && json.data.length > 0) {
                            // console.log('First course record structure:', json.data[0]);
                        }
                        return json.data;
                    }
                },
                columns: [{
                        data: null,
                        name: 'index',
                        orderable: false,
                        searchable: false,
                        render: (data, type, row, meta) => meta.row + meta.settings._iDisplayStart +
                            1
                    },
                    {
                        data: 'name_ar',
                        name: 'name_ar'
                    },
                    {
                        data: 'field_ar',
                        name: 'field_ar',
                        // render: (data) => data || ''
                    },
                    {
                        data: 'type_name',
                        name: 'type_name'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date'
                    },
                    {
                        data: 'end_date',
                        name: 'end_date'
                    },
                    {
                        data: 'applications_count',
                        name: 'applications_count'
                    },
                    {
                        data: 'participating_countries',
                        name: 'participating_countries',
                        orderable: false,
                        render: (data, type) =>
                            type === 'display' && data ?
                            `<div class="countries-list">${data}</div>` : data || ''
                    },
                    {
                        data: 'cost',
                        name: 'cost'
                    }
                ],
                drawCallback: function(settings) {
                    $('.courses-count').text(settings?.json?.recordsTotal || 0);
                    if (searchParams.country?.length) {
                        highlightFilteredCountries(searchParams.country);
                    }
                },
                initComplete: function() {
                    // console.log('Courses DataTable initialization complete');

                    const urlParams = new URLSearchParams(window.location.search);
                    if (urlParams.get('active_tab') === 'courses') {
                        const tabContent = document.getElementById('corses');
                        const tabButton = document.querySelector(
                            'button[data-bs-target="#courses"]');

                        if (tabContent) {
                            tabContent.classList.add('show', 'active');
                            tabContent.style.cssText =
                                'display: block !important; opacity: 1 !important;';
                        }
                        if (tabButton) {
                            tabButton.classList.add('active');
                        }
                    }

                    // Immediately adjust columns (no delay needed)
                    coursesTable.columns.adjust().draw();
                }
            });

            // Make available globally
            window.coursesTable = coursesTable;
        }

        // Highlight countries helper
        function highlightFilteredCountries(countryIds) {
            if (!Array.isArray(countryIds)) {
                countryIds = [String(countryIds)];
            } else {
                countryIds = countryIds.map(String);
            }

            $('.countries-list').each(function() {
                const $list = $(this);
                let text = $list.text();

                countryIds.forEach((countryId) => {
                    const countryName = getCountryNameById(countryId);
                    if (countryName && text.includes(countryName)) {
                        const highlightedText = text.replace(
                            new RegExp(countryName, 'g'),
                            `<span class="highlighted-country">${countryName}</span>`
                        );
                        $list.html(highlightedText);
                    }
                });
            });
        }

        // Placeholder function - should map ID to country name
        function getCountryNameById(id) {
            // Replace this with actual lookup logic or dictionary
            return null;
        }
    })
</script>

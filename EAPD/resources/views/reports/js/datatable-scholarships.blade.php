<script>
    document.addEventListener('DOMContentLoaded', function() {


        // Scholarships DataTable Configuration
        if (document.getElementById('scholarships-datatable')) {
            var scholarshipsTable = $('#scholarships-datatable').DataTable({
                ...dataTablesConfig,
                ajax: {
                    url: '{{ route('reports.comprehensive.data', ['type' => 'scholarships']) }}',
                    method: 'GET',
                    data: function(d) {
                        // Add searchParams to DataTables parameters
                        for (var key in searchParams) {
                            d[key] = searchParams[key];
                        }
                        return d;
                    },
                    error: function(xhr, error, thrown) {
                        // console.log('Ajax error:', error);
                        // console.log('Response:', xhr.responseText);
                    },
                    dataSrc: function(json) {
                        // Debug: Log the response data structure
                        // console.log('Scholarships API Response:', json);
                        if (json.data && json.data.length > 0) {
                            // console.log('First scholarship record structure:', json.data[0]);
                        }
                        return json.data;
                    }
                },
                columns: [{
                        data: null,
                        name: 'index',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name_ar',
                        name: 'name_ar'
                    },
                    {
                        data: 'specialization',
                        name: 'specialization'
                    },
                    {
                        data: 'participants',
                        name: 'participants',
                        orderable: false
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
                        data: 'annual_cost',
                        name: 'annual_cost'
                    }
                ],
                drawCallback: function(settings) {
                    // Update the badge count with the total records
                    $('.scholarships-count').text(settings.json.recordsTotal);
                }
            });
        }
    })
</script>

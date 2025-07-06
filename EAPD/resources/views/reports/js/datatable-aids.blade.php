<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Aids DataTable Configuration
        if (document.getElementById('aids-datatable')) {
            var aidsTable = $('#aids-datatable').DataTable({
                ...dataTablesConfig,
                ajax: {
                    url: '{{ route('reports.comprehensive.data', ['type' => 'aids']) }}',
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
                        // console.log('Aids API Response:', json);
                        if (json.data && json.data.length > 0) {
                            // console.log('First aid record structure:', json.data[0]);
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
                        data: 'type_name',
                        name: 'type_name'
                    },
                    {
                        data: 'country_name',
                        name: 'country_name'
                    },
                    {
                        data: 'ship_date',
                        name: 'ship_date'
                    },
                    {
                        data: 'cost',
                        name: 'cost'
                    }
                ],
                drawCallback: function(settings) {
                    // Update the badge count with the total records
                    $('.aids-count').text(settings.json.recordsTotal);
                }
            });
        }
    })
</script>

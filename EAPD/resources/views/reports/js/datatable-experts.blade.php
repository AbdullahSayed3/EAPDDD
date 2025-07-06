<script>
    // Experts DataTable Configuration
    document.addEventListener('DOMContentLoaded', function() {

        if (document.getElementById('experts-datatable')) {
            var expertsTable = $('#experts-datatable').DataTable({
                ...dataTablesConfig,
                ajax: {
                    url: '{{ route('reports.comprehensive.data', ['type' => 'experts']) }}',
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
                        // console.log('Experts API Response:', json);
                        if (json.data && json.data.length > 0) {
                            // console.log('First expert record structure:', json.data[0]);
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
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'specialist',
                        name: 'specialist'
                    },
                    {
                        data: 'country_name',
                        name: 'country_name'
                    },
                    {
                        data: 'delegate_country_name',
                        name: 'delegate_country_name'
                    },
                    {
                        data: 'contract_date',
                        name: 'contract_date'
                    },
                    {
                        data: 'end_date',
                        name: 'end_date'
                    },
                    {
                        data: 'cost',
                        name: 'cost'
                    }
                ],
                drawCallback: function(settings) {
                    // Update the badge count with the total records
                    $('.experts-count').text(settings.json.recordsTotal);
                }
            });
        }
    })
</script>

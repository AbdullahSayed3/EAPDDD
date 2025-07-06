<script>
    document.addEventListener('DOMContentLoaded', function() {


        // Events DataTable Configuration
        if (document.getElementById('events-datatable')) {
            var eventsTable = $('#events-datatable').DataTable({
                ...dataTablesConfig,
                ajax: {
                    url: '{{ route('reports.comprehensive.data', ['type' => 'events']) }}',
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
                        // console.log('Events API Response:', json);
                        if (json.data && json.data.length > 0) {
                            // console.log('First event record structure:', json.data[0]);
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
                        data: 'subject',
                        name: 'subject'
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
                        data: 'place',
                        name: 'place'
                    },
                    {
                        data: 'comp_names',
                        name: 'comp_names'
                    }
                ],
                drawCallback: function(settings) {
                    // Update the badge count with the total records
                    $('.events-count').text(settings.json.recordsTotal);
                }
            });
        }
    })
</script>

<script>
    // Store search parameters globally
    var searchParams = {};

    // DataTable configurations for each table
    var dataTablesConfig = {
        language: {
            processing: "{{ __('datatable.processing') }}",
            search: "{{ __('datatable.search') }}",
            lengthMenu: "{{ __('datatable.lengthMenu') }}",
            info: "{{ __('datatable.info') }}",
            infoEmpty: "{{ __('datatable.infoEmpty') }}",
            infoFiltered: "({{ __('datatable.infoFiltered') }} _MAX_ )",
            loadingRecords: "{{ __('datatable.loadingRecords') }}",
            zeroRecords: "{{ __('datatable.emptyTable') }}",
            emptyTable: "{{ __('datatable.emptyTable') }}",
            paginate: {
                first: "{{ __('datatable.first') }}",
                previous: "{{ __('datatable.previous') }}",
                next: "{{ __('datatable.next') }}",
                last: "{{ __('datatable.last') }}"
            }
        },
        processing: true,
        serverSide: true,
        "aaSorting": [],
        "columnDefs": [{
            "orderable": true,
            "searchable": false,
            "targets": 0
        }],
        // Add responsive and auto-width options
        responsive: true,
        autoWidth: false,
        // Improve performance with deferred rendering
        deferRender: true,
        // Set a fixed layout for better performance
        scrollCollapse: true
    };
</script>

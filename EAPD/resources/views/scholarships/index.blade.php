@extends('layouts.master')

@section('content')
    @php($dataT = [])
    <!--main content wrapper-->
    <!--page title-->

    <x-base.breadcrumb title="المنح الدراسية" :breadcrumbs="[['label' => 'الصفحة الرئيسية', 'url' => route('home')], ['label' => 'المنح الدراسية']]" />
    <!-- Conten of the page -->
    @include('scholarships.filter')

    <!-- end search -->
    <!--/page title-->
    <!-- begin table -->
    <form method="post" action="{{ route($route . '.delete', $dataT) }}">

        {{ csrf_field() }}
        <div class="row">
            <div class="col-xl-12">
                @include('flash::message')
                <div class="mb-4">
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-md-12">
                                @can('create_scholarships')
                                    <a href="{{ route($route . '.create') }}" class="btn btn-primary float-start"><i
                                            class="fa fa-plus-square-o me-2"></i>{{ awtTrans('اضافه منحة') }}</a>
                                @endcan

                                @can('delete_scholarships')
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                        class="btn btn-danger float-end ms-1"><i class="fa fa-trash-o me-2"></i>
                                        @lang('main.delete')</button>
                                @endcan
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    {{ trans('main.confirm') }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                {{ trans('main.delete_confirm') }}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">{{ trans('awt.main.close') }}</button>
                                                <button type="submit" name="submit" value="delete"
                                                    class="btn btn-danger float-end ms-1"><i class="fa fa-trash-o me-2"></i>
                                                    @lang('main.delete')</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Button trigger modal -->

                                <button type="submit" name="submit" value="print"
                                    class="btn btn-primary float-end ms-1"><i class="fa fa-print me-2"></i>
                                    {{ awtTrans('طباعة') }}</button>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary float-end ms-1" formtarget="_blank"
                                    data-bs-toggle="modal" data-bs-target="#print">
                                    <i class="fa fa-print me-2"></i> {{ awtTrans('طباعة') }}</button>

                                <!-- Modal -->
                                <div class="modal fade" id="print" tabindex="-1" aria-labelledby="printLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="printitle">
                                                    {{ awtTrans('اختر خانات الطباعه') }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="print_title"
                                                        class="form-label">{{ awtTrans('عنوان التقرير') }}</label>
                                                    <input type="text" class="form-control" id="print_title"
                                                        name="print_title" aria-describedby="print_title"
                                                        placeholder="{{ awtTrans('عنوان التقرير') }}"
                                                        value="{{ old('print_title') }}">
                                                </div>
                                                @foreach ($table_rows as $row)
                                                    @if ($row['name'] == 'chk' || $row['name'] == 'edit' || $row['name'] == 'id' || $row['name'] == 'assessments')
                                                    @else
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="{!! $row['name'] !!}"
                                                                name="print_choices[{!! $row['display'] !!}]"
                                                                value="{!! $row['name'] !!}" checked>
                                                            <label class="form-check-label" for="{!! $row['name'] !!}">
                                                                {!! $row['display'] !!}</label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">{{ trans('awt.main.close') }}</button>
                                                <button type="submit" name="submit" value="print2" formtarget="_blank"
                                                    class="btn btn-primary float-end ms-1"><i class="fa fa-print me-2"></i>
                                                    {{ awtTrans('طباعة2') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" name="submit" value="export"
                                    class="btn btn-primary float-end ms-1"><i
                                        class="fa fa-file-excel-o me-2"></i>{{ awtTrans('تحميل اكسل') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-3 pb-4">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped" cellspacing="0"
                                style="border-bottom: 2px solid #ddd;">
                                <thead>
                                    <tr>
                                        @foreach ($table_rows as $row)
                                            <th>{!! $row['display'] !!}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                {{-- <tfoot>
                                <tr>
                                    @foreach ($table_rows as $row)
                                        <th>{!!$row['display']!!}</th>
                                    @endforeach
                                </tr>
                                </tfoot> --}}
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>

    <!--/footer-->
    <!--/main content wrapper-->
@endsection
@push('scripts')
    <!--datatables-->
    <script src="{{ asset('assets/vendor/icheck/skins/icheck.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Get current URL parameters
            const urlParams = new URLSearchParams(window.location.search);

            // Initialize DataTable
            const dataTable = $('#datatable').DataTable({
                "columnDefs": [{
                    "orderable": false,
                    "searchable": false,
                    "targets": 0
                }],

                "aaSorting": [],
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
                ajax: {
                    url: '{{ route($route . '.datatable') }}',
                    data: function(d) {
                        // Add URL parameters to the DataTables request
                        urlParams.forEach((value, key) => {
                            d[key] = value;
                        });
                    }
                },
                columns: [
                    @foreach ($table_rows as $row)
                        {
                            data: '{{ $row['data'] }}',
                            name: '{{ $row['name'] }}',
                            orderable: {{ $row['orderable'] }},
                            searchable: {{ $row['searchable'] }}
                        },
                    @endforeach
                ],
                drawCallback: function(settings) {
                    // Re-initialize iCheck for dynamically loaded checkboxes
                    $('.chk-item, #check-all').iCheck({
                        checkboxClass: 'icheckbox_minimal-blue'
                    });

                    // After redraw, update the "Select All" checkbox state
                    updateSelectAllCheckbox();
                }
            });

            // Function to update the "Select All" checkbox state
            function updateSelectAllCheckbox() {
                const totalCheckboxes = $('.chk-item').length;
                const checkedCheckboxes = $('.chk-item:checked').length;
                if (totalCheckboxes === 0) {
                    $('#check-all').iCheck('uncheck');
                    $('#check-all').prop('indeterminate', false);
                } else if (checkedCheckboxes === totalCheckboxes) {
                    $('#check-all').iCheck('check');
                    $('#check-all').prop('indeterminate', false);
                } else if (checkedCheckboxes > 0) {
                    $('#check-all').iCheck('uncheck');
                    $('#check-all').prop('indeterminate', true);
                } else {
                    $('#check-all').iCheck('uncheck');
                    $('#check-all').prop('indeterminate', false);
                }
            }

            // Handle "Select All" checkbox
            $(document).on('ifChanged', '#check-all', function(event) {
                const isChecked = $(this).prop('checked');
                $('.chk-item').iCheck(isChecked ? 'check' : 'uncheck');
            });

            // Handle individual checkboxes
            $(document).on('ifChanged', '.chk-item', function() {
                updateSelectAllCheckbox();
            });

            // Initial iCheck setup for checkboxes
            $('.chk-item, #check-all').iCheck({
                checkboxClass: 'icheckbox_minimal-blue'
            });

            // Handle DataTable state save/restore
            dataTable.on('stateSaveParams.dt', function(e, settings, data) {
                // Save current URL parameters with the state
                data.urlParams = Object.fromEntries(urlParams);
            });

            dataTable.on('stateLoadParams.dt', function(e, settings, data) {
                // Restore URL parameters from saved state
                if (data.urlParams) {
                    Object.entries(data.urlParams).forEach(([key, value]) => {
                        urlParams.set(key, value);
                    });
                }
            });
        });
    </script>
@endpush

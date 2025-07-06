@extends('layouts.master')

@section('content')
    @php($dataT = [])

    <!-- Page Title -->
    <x-base.breadcrumb title="فعاليات" :breadcrumbs="[['label' => 'الصفحة الرئيسية', 'url' => route('home')], ['label' => 'فعاليات']]" />

    <!-- start search -->
    @include('events.filter')
    <!-- end search -->

    <!-- begin table -->
    <form method="post" action="{{ route($route . '.delete', $dataT) }}">
        @csrf
        <div class="row">
            <div class="col-xl-12">
                @include('flash::message')

                <div class="mb-4">
                    <div class="border-0">
                        <div class="row">
                            <div class="col-md-12">
                                @can('create_events')
                                    <x-base.fillBtn :href="route($route . '.create')" icon="fa-plus-square-o"
                                        label="{{ awtTrans('اضافه فعاليه') }}" float="start" />
                                @endcan

                                @can('delete_events')
                                    <!-- Delete button with counter -->
                                    <x-base.fillBtn id="deleteBtn" style="display:none" modalTarget="deleteModal"
                                        modalToggle="true" class="btn-danger" float="end" label="{{ awtTrans('حذف') }}"
                                        badge="true" badgeId="selectedCount" />
                                @endcan
                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">{{ __('main.confirm') }}</h5>
                                                <x-base.fillBtn type="button" class="btn-close" modalToggle="true"
                                                    aria-label="Close" />
                                            </div>
                                            <div class="modal-body">
                                                {{ __('main.delete_confirm') }}
                                            </div>
                                            <div class="modal-footer">
                                                <x-base.fillBtn type="button" class="btn-secondary"
                                                    label="{{ trans('awt.main.close') }}" modalToggle="true" />
                                                <x-base.fillBtn type="submit" name="submit" value="delete"
                                                    class="btn-danger" icon="fa-trash-o" label="main.delete" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Button trigger modal -->
                                <x-base.notfillBtn type="button" modalTarget="print" modalToggle="true" icon="fa-print"
                                    label="{{ awtTrans('طباعة') }}" />

                                <!-- Modal -->
                                <div class="modal fade" id="print" tabindex="-1" role="dialog" aria-labelledby="print"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="printModalLabel">
                                                    {{ trans('awt.اختر خانات الطباعه') }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="print_title"
                                                        class="form-label">{{ trans('awt.عنوان التقرير') }}</label>
                                                    <input type="text" class="form-control" id="print_title"
                                                        name="print_title" placeholder="{{ trans('awt.عنوان التقرير') }}">
                                                </div>

                                                <div class="d-flex mb-2 justify-content-end">
                                                    <button type="button" class="btn btn-sm btn-outline-primary me-2"
                                                        id="select-all-print">
                                                        {{ trans('awt.تحديد الكل') }}
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary"
                                                        id="deselect-all-print">
                                                        {{ trans('awt.إلغاء تحديد الكل') }}
                                                    </button>
                                                </div>

                                                <div class="row">
                                                    @foreach ($table_rows as $row)
                                                        @if (!in_array($row['name'], ['chk', 'edit', 'id', 'assessments']))
                                                            <div class="col-md-6">
                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input print-choice"
                                                                        type="checkbox" id="print_{!! $row['name'] !!}"
                                                                        name="print_choices[{!! $row['display'] !!}]"
                                                                        value="{!! $row['name'] !!}">
                                                                    <label class="form-check-label"
                                                                        for="print_{!! $row['name'] !!}">
                                                                        {!! $row['display'] !!}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <x-base.notfillBtn type="button" class="btn-secondary" label="إغلاق"
                                                    modalToggle="true" />
                                                <x-base.notfillBtn type="submit" name="submit" value="print"
                                                    class="btn-primary" icon="fa-print" label="طباعة" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <x-base.notfillBtn type="submit" name="submit" value="export" float="end"
                                    icon="fa-file-excel-o" label="{{ awtTrans('تحميل اكسل') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="pt-3 pb-4">
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
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('assets/vendor/icheck/skins/icheck.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Store search parameters globally
            var searchParams = {};

            // Print modal select/deselect all functionality
            $('#select-all-print').on('click', function() {
                $('.print-choice').prop('checked', true);
            });

            $('#deselect-all-print').on('click', function() {
                $('.print-choice').prop('checked', false);
            });

            // Initialize DataTable
            var table = $('#datatable').DataTable({
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
                    url: '{{ route($route . '.datatable', $dataT) }}',
                    data: function(d) {
                        return $.extend({}, d, searchParams);
                    },
                    error: function(xhr, error, thrown) {
                        // // console.log('Ajax error:', error);
                        // // console.log('Response:', xhr.responseText);
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
                ]
            });

            // Function to update search parameters and reload table
            function updateSearch(params) {
                searchParams = params;
                table.ajax.reload();
            }

            // Handle Quick Search Form Submission
            $('#quick-search-form').on('submit', function(e) {
                e.preventDefault();
                var formData = {};
                $(this).serializeArray().forEach(function(field) {
                    if (field.value) {
                        if (formData[field.name]) {
                            if (!Array.isArray(formData[field.name])) {
                                formData[field.name] = [formData[field.name]];
                            }
                            formData[field.name].push(field.value);
                        } else {
                            formData[field.name] = field.value;
                        }
                    }
                });
                updateSearch(formData);
            });

            // Handle Advanced Search Form Submission
            $('#advanced-search-form').on('submit', function(e) {
                e.preventDefault();
                var formData = {};
                $(this).serializeArray().forEach(function(field) {
                    if (field.value) {
                        if (formData[field.name]) {
                            if (!Array.isArray(formData[field.name])) {
                                formData[field.name] = [formData[field.name]];
                            }
                            formData[field.name].push(field.value);
                        } else {
                            formData[field.name] = field.value;
                        }
                    }
                });
                updateSearch(formData);
                $('#advancedSearchModal').modal('hide');
            });

            // Handle Reset Search
            $('#reset-search').on('click', function(e) {
                e.preventDefault();
                updateSearch({});
                $('#quick-search-form')[0].reset();
                $('#advanced-search-form')[0].reset();
                $('.selec_event').val(null).trigger('change');
            });

            // Handle Clear Advanced Search Form
            $('#clear-advanced-search').on('click', function() {
                $('#advanced-search-form')[0].reset();
                $('.selec_event').val(null).trigger('change');
            });

            // Initialize Select2
            $(".selec_event").select2({
                placeholder: "{{ awtTrans('اختر نوع الفعالية') }}"
            });

            // Initialize Date Pickers
            $('.date-picker-input').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });

            // Handle Check All Functionality
            $("#check-all").click(function() {
                $('input:checkbox.chk-item').prop('checked', $('input:checkbox.chk-all').prop('checked'));
                toggleDeleteButton();
            });

            // Handle individual checkbox changes
            $(document).on('change', '.chk-item', function() {
                toggleDeleteButton();
            });

            // Function to toggle delete button visibility and update counter
            function toggleDeleteButton() {
                var checkedCount = $('.chk-item:checked').length;
                $('#selectedCount').text(checkedCount);
                if (checkedCount > 0) {
                    $('#deleteBtn').show();
                } else {
                    $('#deleteBtn').hide();
                }
            }
        });
    </script>
@endpush

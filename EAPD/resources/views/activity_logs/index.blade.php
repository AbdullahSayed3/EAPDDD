@extends('layouts.master')

@section('content')
    @php($dataT = [])

    <!--main content wrapper-->
    <!--page title-->
    <x-base.breadcrumb title="سجل الانشطه" :breadcrumbs="[['label' => 'الصفحة الرئيسية', 'url' => route('home')], ['label' => 'سجل الانشطه']]" />

    <!--/page title-->

    <!-- Conten of the page -->


        <!-- start search -->
        @include('activity_logs.filter')
        <!-- end search -->

    <!-- begin table -->
    <form method="post" action="{{ route('applicants.delete', $dataT) }}">
        @csrf
        <div class="row">
            <div class="col-xl-12">
                @include('flash::message')

                <div class="mb-4">
                    <div class="border-0">
                        <div class="row">
                            {{-- <div class="col-md-12">
                                    <!-- Button trigger modal -->
                                    <x-base.notfillBtn type="button" modalTarget="print" modalToggle="true" icon="fa-print"
                                        label="طباعة" />

                                    <!-- Modal -->
                                    <div class="modal fade" id="print" tabindex="-1" role="dialog"
                                        aria-labelledby="print" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="printitle">{{ __('اختر خانات الطباعه') }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="print_title"
                                                            class="form-label">{{ __('عنوان التقرير') }}</label>
                                                        <input type="text" class="form-control" id="print_title"
                                                            name="print_title" placeholder="{{ __('عنوان التقرير') }}">
                                                    </div>

                                                    <div class="d-flex mb-2 justify-content-end">
                                                        <button type="button" class="btn btn-sm btn-outline-primary me-2"
                                                            id="select-all-print">
                                                            {{ __('تحديد الكل') }}
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-outline-secondary"
                                                            id="deselect-all-print">
                                                            {{ __('إلغاء تحديد الكل') }}
                                                        </button>
                                                    </div>

                                                    <div class="row">
                                                        @foreach ($table_rows as $row)
                                                            @if (!in_array($row['name'], ['chk', 'edit', 'id', 'assessments']))
                                                                <div class="col-md-6">
                                                                    <div class="form-check mb-2">
                                                                        <input class="form-check-input print-choice"
                                                                            type="checkbox"
                                                                            id="print_{!! $row['name'] !!}"
                                                                            name="print_choices[{!! $row['display'] !!}]"
                                                                            value="{!! $row['name'] !!}" checked>
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
                                                    <x-base.notfillBtn type="button" class="btn-secondary"
                                                        label="إغلاق" modalToggle="true" />
                                                    <x-base.notfillBtn type="submit" name="submit" value="print2"
                                                        formtarget="_blank" class="btn-primary" icon="fa-print"
                                                        label="طباعة" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <x-base.notfillBtn type="submit" name="submit" value="export" float="end"
                                        icon="fa-file-excel-o" label=" تحميل اكسل" />
                                @endif
                            </div> --}}
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

    <!--/footer-->
    <!--/main content wrapper-->
@endsection
@push('scripts')
    <!--datatables-->
    <script src="{{ asset('assets/vendor/icheck/skins/icheck.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            let from = $('#from').val()
            let to = $('#to').val()

            // Store search parameters globally
            var searchParams = {};

            // Initialize Select2 for dropdowns
            $(".selc_country, .selc_course, .selc_gender").select2({
                placeholder: "{{ __('اختر') }}"
            });

            // Initialize Date Pickers
            $('.date-picker-input').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });

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
                @if (isset($_GET['course_id']))
                    ajax: '{{ route($route . '.datatable', ['course_id' => $_GET['course_id']]) }}',
                @else
                    @php($dataT['from'] = getRequest('from'))
                    @php($dataT['to'] = getRequest('to'))
                    ajax: {                        
                            url: `{{ route('activity_logs.datatable') }}?from=${from}&to=${to}`,
                            data: function(d) {
                                
                                return $.extend({}, d, searchParams);
                            },
                            error: function(xhr, error, thrown) {
                                console.log('Ajax error:', error);
                                console.log('Response:', xhr.responseText);
                            }
                        },
                @endif
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

@extends('layouts.master')

@section('content')
    @php
        // Initialize dataT array to store filter parameters
        $dataT = [];

        // Get filter parameters from request
        if (request()->has('name')) {
            $dataT['name'] = request('name');
        }

        if (request()->has('delegate_country')) {
            // Handle multiple values for delegate_country
            $dataT['delegate_country'] = is_array(request('delegate_country'))
                ? implode(',', request('delegate_country'))
                : request('delegate_country');
        }

        if (request()->has('country')) {
            // Handle multiple values for country
            $dataT['country'] = is_array(request('country')) ? implode(',', request('country')) : request('country');
        }

        if (request()->has('specialist')) {
            $dataT['specialist'] = request('specialist');
        }

        if (request()->has('sub_specialist')) {
            $dataT['sub_specialist'] = request('sub_specialist');
        }

        if (request()->has('contract_date')) {
            $dataT['contract_date'] = request('contract_date');
        }

        if (request()->has('end_date')) {
            $dataT['end_date'] = request('end_date');
        }

        if (request()->has('contract_from')) {
            $dataT['contract_from'] = request('contract_from');
        }

        if (request()->has('contract_to')) {
            $dataT['contract_to'] = request('contract_to');
        }

        if (request()->has('contract_end_from')) {
            $dataT['contract_end_from'] = request('contract_end_from');
        }

        if (request()->has('contract_end_to')) {
            $dataT['contract_end_to'] = request('contract_end_to');
        }

        if (request()->has('qualification')) {
            $dataT['qualification'] = request('qualification');
        }

        if (request()->has('gender')) {
            $dataT['gender'] = request('gender');
        }

        if (request()->has('languages')) {
            $dataT['languages'] = request('languages');
        }

        if (request()->has('current_employer')) {
            $dataT['current_employer'] = request('current_employer');
        }

        if (request()->has('phone')) {
            $dataT['phone'] = request('phone');
        }

        if (request()->has('email')) {
            $dataT['email'] = request('email');
        }

        if (request()->has('delegate_org')) {
            $dataT['delegate_org'] = request('delegate_org');
        }

        if (request()->has('status')) {
            // Handle multiple values for status
            $dataT['status'] = is_array(request('status')) ? implode(',', request('status')) : request('status');
        }

        if (request()->has('cost_from')) {
            $dataT['cost_from'] = request('cost_from');
        }

        if (request()->has('cost_to')) {
            $dataT['cost_to'] = request('cost_to');
        }
    @endphp

    <!-- Page Title -->
    <x-base.breadcrumb title="قسم الخبراء" :breadcrumbs="[['label' => 'الصفحة الرئيسية', 'url' => route('home')], ['label' => 'قسم الخبراء']]" />

    <!-- start search -->
    @include('experts.filter')
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
                                @can('create_experts')
                                    
                                <x-base.fillBtn :href="route($route . '.create')" icon="fa-plus-square-o" label="{{awtTrans('اضافه خبير')}}"
                                    float="start" />
                                @endcan

                                <!-- Delete button with counter -->
                                @can('delete_experts')                                    
                                <x-base.fillBtn id="deleteBtn" style="display:none" modalTarget="deleteModal"
                                    modalToggle="true" class="btn-danger" float="end" label="{{awtTrans('حذف')}}" badge="true"
                                    badgeId="selectedCount" />
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
                                                <x-base.fillBtn type="button" class="btn-secondary" label="{{trans('awt.main.close')}}"
                                                    modalToggle="true" />
                                                <x-base.fillBtn type="submit" name="submit" value="delete"
                                                    class="btn-danger" icon="fa-trash-o" label="main.delete" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Button trigger modal -->
                                <x-base.notfillBtn type="button" modalTarget="print" modalToggle="true" icon="fa-print"
                                    label="{{awtTrans('طباعة')}}" />

                                <!-- Modal -->
                                <div class="modal fade" id="print" tabindex="-1" aria-labelledby="printLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="printitle">{{ trans('awt.اختر خانات الطباعة') }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="print_title"
                                                        class="form-label">{{ awtTrans('عنوان التقرير') }}</label>
                                                    <input type="text" class="form-control" id="print_title"
                                                        name="title" aria-describedby="print_title"
                                                        placeholder="{{ awtTrans('عنوان التقرير') }}"
                                                        value="{{ old('title', '') }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="print_limit"
                                                        class="form-label">{{ trans('awt.عدد السجلات') }}</label>
                                                    <select class="form-select" id="print_limit" name="print_limit">
                                                        <option value="all">{{ trans('awt.كل السجلات') }}</option>
                                                        <option value="10">10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                        <option value="custom">{{ trans('awt.تحديد عدد مخصص') }}</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3 custom-limit-container d-none">
                                                    <label for="custom_limit"
                                                        class="form-label">{{ awtTrans('أدخل عدد السجلات') }}</label>
                                                    <input type="number" class="form-control" id="custom_limit"
                                                        name="custom_limit" min="1"
                                                        placeholder="{{ awtTrans('أدخل عدد السجلات') }}">
                                                </div>

                                                <div class="d-flex mb-2 justify-content-end">
                                                    <button type="button" class="btn btn-sm btn-outline-primary me-2"
                                                        id="select-all-print">
                                                        {{ awtTrans('تحديد الكل') }}
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary"
                                                        id="deselect-all-print">
                                                        {{ awtTrans('إلغاء تحديد الكل') }}
                                                    </button>
                                                </div>

                                                <div class="row">
                                                    @foreach ([
            'name' => awtTrans('الاسم'),
            'country' => awtTrans('الدولة'),
            'specialist' => awtTrans('التخصص'),
            'sub_specialist' => awtTrans('التخصص الفرعي'),
            'qualification' => awtTrans('المؤهل الدراسي'),
            'gender' => awtTrans('النوع'),
            'languages' => awtTrans('اللغات التي يجيدها'),
            'current_employer' => __('main.current_employer'),
            'employer_address' => __('main.employer_address'),
            'employer_phone' => __('main.employer_phone'),
            'employer_email' => __('main.employer_email'),
            'old_contracts' => awtTrans('سوابق التعاقدات مع الوكالة إن وجدت'),
            'phone' => awtTrans('رقم الهاتف'),
            'email' => awtTrans('البريد الإلكتروني'),
            'status' => awtTrans('حالة الخبير'),
            'delegate_country' => awtTrans('الدولة الموفد إليها حالياً'),
            'delegate_org' => awtTrans('الجهة الموفد إليها حالياً'),
            'contract_date' => awtTrans('بداية التعاقد'),
            'end_date' => awtTrans('نهاية التعاقد'),
            'cost' => awtTrans('التكلفة السنوية'),
            'notes' => awtTrans('ملاحظات'),
        ] as $field => $label)
                                                        <div class="col-md-6">
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input print-choice"
                                                                    type="checkbox" id="print_{{ $field }}"
                                                                    name="print_choices[{{ $field }}]"
                                                                    value="{{ $field }}" checked>
                                                                <label class="form-check-label"
                                                                    for="print_{{ $field }}">
                                                                    {{ $label }}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <x-base.notfillBtn type="button" class="btn-secondary" label="{{awtTrans('إغلاق')}}"
                                                    modalToggle="true" />
                                                <x-base.notfillBtn type="submit" name="submit" value="print2"
                                                    formtarget="_blank" class="btn-primary" icon="fa-print"
                                                    label="{{awtTrans('طباعة')}}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <x-base.notfillBtn type="submit" name="submit" value="export" float="end"
                                    icon="fa-file-excel-o" label="{{awtTrans('تحميل اكسل')}}" />
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
        document.addEventListener('DOMContentLoaded', function() {
            // Print modal select/deselect all functionality
            const selectAllPrintBtn = document.getElementById('select-all-print');
            const deselectAllPrintBtn = document.getElementById('deselect-all-print');
            const printCheckboxes = document.querySelectorAll('.print-choice');

            if (selectAllPrintBtn) {
                selectAllPrintBtn.addEventListener('click', function() {
                    printCheckboxes.forEach(checkbox => {
                        checkbox.checked = true;
                    });
                });
            }

            if (deselectAllPrintBtn) {
                deselectAllPrintBtn.addEventListener('click', function() {
                    printCheckboxes.forEach(checkbox => {
                        checkbox.checked = false;
                    });
                });
            }

            // Handle print limit selection
            const printLimitSelect = document.getElementById('print_limit');
            const customLimitContainer = document.querySelector('.custom-limit-container');
            const customLimitInput = document.getElementById('custom_limit');

            if (printLimitSelect) {
                printLimitSelect.addEventListener('change', function() {
                    if (this.value === 'custom') {
                        customLimitContainer.classList.remove('d-none');
                    } else {
                        customLimitContainer.classList.add('d-none');
                        customLimitInput.value = '';
                    }
                });
            }

            // Validate custom limit input
            if (customLimitInput) {
                customLimitInput.addEventListener('input', function() {
                    if (this.value < 1) {
                        this.value = 1;
                    }
                });
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            // Store search parameters globally
            var searchParams = {};

            // Initialize DataTable
            var dataTable = $('#datatable').DataTable({
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
                    method: 'GET',
                    data: function(d) {
                        // Add search parameters to DataTables request
                        var params = $.extend({}, d, searchParams);

                        // Log what parameters we're sending (for debugging)
                        // console.log("Parameters being sent:", JSON.stringify(params));

                        // Process array-like parameters (checking with proper syntax)
                        // Handle parameters that might come in the form param[] from form submissions
                        Object.keys(params).forEach(function(key) {
                            // Check if this is a key with [] suffix
                            if (key.endsWith('[]')) {
                                var baseKey = key.substring(0, key.length - 2);
                                // Only process if the value is array-like
                                if (params[key] && (Array.isArray(params[key]) || typeof params[
                                        key] === 'object')) {
                                    // Convert to array if needed, then join
                                    var valueArray = Array.isArray(params[key]) ? params[key] :
                                        [params[key]];
                                    params[baseKey] = valueArray.join(',');
                                    // Remove the original array parameter
                                    delete params[key];
                                }
                            }
                        });

                        // Process regular arrays (like delegate_country, status)
                        // Don't modify DataTables core parameters
                        var coreParams = ['columns', 'order', 'start', 'length', 'draw'];

                        Object.keys(params).forEach(function(key) {
                            // Skip DataTables core parameters
                            if (coreParams.includes(key)) {
                                return;
                            }

                            // Handle direct array parameters
                            if (Array.isArray(params[key])) {
                                params[key] = params[key].join(',');
                            }
                        });

                        // console.log("Parameters after processing:", JSON.stringify(params));

                        return params;
                    },
                    error: function(xhr, error, thrown) {
                        // console.log('Ajax error:', error);
                        // console.log('Response:', xhr.responseText);

                        if (xhr.status === 500) {
                            alert(
                                'An error occurred while processing your request. The server might be experiencing issues with the filter parameters.'
                            );
                        } else if (xhr.status === 400) {
                            alert('Bad request. Please check your filter parameters.');
                        } else {
                            alert('Error: ' + thrown);
                        }
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
                // Don't modify DataTables core parameters
                var coreParams = ['columns', 'order', 'start', 'length', 'draw'];

                // Process array values to match controller expectations
                for (var key in params) {
                    // Skip DataTables core parameters
                    if (coreParams.includes(key)) {
                        continue;
                    }

                    if (Array.isArray(params[key])) {
                        // Convert arrays to comma-separated strings
                        params[key] = params[key].join(',');
                    }
                }
                searchParams = params;
                dataTable.ajax.reload();
            }

            // Handle Quick Search Form Submission
            $('#quick-search-form').on('submit', function(e) {
                e.preventDefault();
                var formData = {};

                // Handle select multiple fields separately to ensure correct array format
                var multiselectFields = ['delegate_country', 'status'];

                // First initialize empty arrays for multi-select fields to avoid null issues
                multiselectFields.forEach(function(field) {
                    formData[field] = [];
                });

                // Process all form fields
                $(this).serializeArray().forEach(function(field) {
                    if (field.value) {
                        // If this is a multi-select field
                        if (multiselectFields.includes(field.name)) {
                            formData[field.name].push(field.value);
                        } else {
                            // Normal field handling
                            if (formData[field.name]) {
                                if (!Array.isArray(formData[field.name])) {
                                    formData[field.name] = [formData[field.name]];
                                }
                                formData[field.name].push(field.value);
                            } else {
                                formData[field.name] = field.value;
                            }
                        }
                    }
                });

                // Convert multi-select arrays to comma-separated strings
                multiselectFields.forEach(function(field) {
                    if (formData[field] && formData[field].length > 0) {
                        formData[field] = formData[field].join(',');
                    } else {
                        // If empty array, remove it to avoid sending empty values
                        delete formData[field];
                    }
                });

                // console.log("Search parameters:", formData);
                updateSearch(formData);
            });

            // Handle Advanced Search Form Submission
            $('#advanced-search-form').on('submit', function(e) {
                e.preventDefault();
                var formData = {};

                // Handle select multiple fields separately to ensure correct array format
                var multiselectFields = ['delegate_country', 'status'];

                // First initialize empty arrays for multi-select fields to avoid null issues
                multiselectFields.forEach(function(field) {
                    formData[field] = [];
                });

                // Process all form fields
                $(this).serializeArray().forEach(function(field) {
                    if (field.value) {
                        // If this is a multi-select field
                        if (multiselectFields.includes(field.name)) {
                            formData[field.name].push(field.value);
                        } else {
                            // Normal field handling
                            if (formData[field.name]) {
                                if (!Array.isArray(formData[field.name])) {
                                    formData[field.name] = [formData[field.name]];
                                }
                                formData[field.name].push(field.value);
                            } else {
                                formData[field.name] = field.value;
                            }
                        }
                    }
                });

                // Convert multi-select arrays to comma-separated strings
                multiselectFields.forEach(function(field) {
                    if (formData[field] && formData[field].length > 0) {
                        formData[field] = formData[field].join(',');
                    } else {
                        // If empty array, remove it to avoid sending empty values
                        delete formData[field];
                    }
                });

                // console.log("Advanced search parameters:", formData);
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

            // Initialize Select2
            $(".selc_country").select2({
                placeholder: "{{ awtTrans('اختر دولة') }}"
            });
            $(".selec_stat_exp").select2({
                placeholder: "{{ awtTrans('اختر حالة الخبير') }}"
            });
            $('.selec_tag').select2({
                placeholder: "{{ awtTrans('اللغات التي يجيدها') }}",
                tags: true
            });
        });
    </script>
@endpush

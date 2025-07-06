@extends('layouts.master')

@section('content')
    @php($dataT = [])
    <!--main content wrapper-->
    <!--page title-->
    <x-base.breadcrumb title="{{ $active }}" :breadcrumbs="[['label' => 'الصفحة الرئيسية', 'url' => route('home')], ['label' => $active]]" />
    <!-- Content of the page -->

    @include('aids.filter')
    {{-- <x-aids.filter /> --}}

    <!-- end search -->
    <!--/page title-->

    <form method="post" action="{{ route($route . '.delete', $dataT) }}">

        {{ csrf_field() }}
        <div class="row">
            <div class="col-xl-12">
                @include('flash::message')

                <div class="card shadow mb-4">
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-md-12">

                                @can('create_aids')
                                    <x-base.fillBtn :href="route($route . '.create')" icon="fa-plus-square-o" :label="awtTrans('اضافه منحه')" float="start" />
                                @endcan

                                @can('delete_aids')
                                    <x-base.fillBtn type="button" class="btn-danger" icon="fa-trash-o" :label="__('main.delete')"
                                        modalTarget="deleteModal" modalToggle="true" float="end" />
                                @endcan

                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">
                                                    {{ trans('main.confirm') }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                {{ awtTrans('main.delete_confirm') }}
                                            </div>
                                            <div class="modal-footer">
                                                {{-- <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{trans('awt.main.close')}}</button>
                                              --}}
                                                <x-base.fillBtn type="button" class="btn-secondary"
                                                    label="{{ trans('awt.main.close') }}" modalToggle="true" />
                                                <x-base.fillBtn type="submit" name="submit" value="delete"
                                                    class="btn-danger" icon="fa-trash-o" :label="__('main.delete')" float="end" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <x-base.notfillBtn type="submit" name="submit" value="print" icon="fa-print"
                                    :label="awtTrans('طباعة')" float="end" />

                                <x-base.notfillBtn type="submit" name="submit" value="export" icon="fa-file-excel-o"
                                    :label="awtTrans('تحميل اكسل')" float="end" />

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
                ajax: '{{ route($route . '.datatable', $dataT) }}',
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
        });
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
            console.log(formData);

            updateSearch(formData);
        });

        function updateSearch(params) {
            searchParams = params;
            console.log(params);

            var url = "{{ route('aids.datatable') }}" +
                `?country=${searchParams.country ?? ''}&type_id=${searchParams.type_id ?? ''}&quick_ship_date=${searchParams.quick_ship_date ?? ''}`;
            $('#datatable').DataTable().ajax.url(url).load();
        }


        $("#check-all").click(function() {
            if ($('input:checkbox.chk-all').prop('checked')) {
                $('input:checkbox.chk-item').prop('checked', true);
            } else {
                $('input:checkbox.chk-item').prop('checked', false);
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            if ($.fn.select2) {
                // select country
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
            }
        })
    </script>
@endpush

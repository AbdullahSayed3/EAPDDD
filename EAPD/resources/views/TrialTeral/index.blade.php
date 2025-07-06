@extends('layouts.master')

@section('content')
    @php($dataT = [])

    <!--main content wrapper-->
    <!--page title-->
    <div class="row">
        <div class="col-md-12">
            <div class="mb-4">
                <div class="page-title d-flex align-items-center p-3">
                    <div>
                        <h4 class="weight500 d-inline-block pr-3 mr-3 mb-0 border-right">{{ awtTrans('التعاون الثلاثي') }}
                        </h4>
                        <nav aria-label="breadcrumb" class="d-inline-block ">
                            <ol class="breadcrumb p-0">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('home') }}">{{ awtTrans('الصفحة الرئيسية') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ awtTrans('التعاون الثلاثي') }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Conten of the page -->

    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="mb-4">

                <div class="card-body">

                    <dl class="toggle">
                        <dt>
                            <a href="">{{ awtTrans('البحث السريع') }}</a>
                        </dt>
                        <dd>
                            <form>
                                <div class="form-group row">
                                    @php($dataT['country'] = getRequest('country'))

                                    <label for="inpu23" class="col-sm-1 col-form-label">{{ awtTrans('الدول') }}</label>
                                    <div class="col-sm-4">
                                        <select class="form-control selc_country" name="country">
                                            <option></option>
                                            @foreach (getCountries() as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ getRequest('country') == $key ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @php($dataT['countryA'] = getRequest('countryA'))

                                    <label for="inpu61" class="col-sm-1 col-form-label">{{ awtTrans('الجهات') }}</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control " id="inpu61" name="countryA"
                                            value="{{ getRequest('countryA') }}" placeholder="{{ awtTrans('الجهات') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    @php($dataT['status'] = getRequest('status'))

                                    <label for="inpu13" class="col-sm-1 col-form-label">{{ awtTrans('الحالة') }}</label>
                                    <div class="col-sm-4">
                                        <select class="form-control selc_stats" name="status">
                                            <option></option>
                                            <option value="active"
                                                {{ getRequest('status') == 'active' ? 'selected' : '' }}>
                                                {{ awtTrans('ساري') }}
                                            </option>
                                            <option value="disabled"
                                                {{ getRequest('status') == 'disabled' ? 'selected' : '' }}>
                                                {{ awtTrans('غير ساري') }}
                                            </option>
                                            <option value="holding"
                                                {{ getRequest('status') == 'holding' ? 'selected' : '' }}>
                                                {{ awtTrans('معلق') }}
                                            </option>

                                        </select>
                                    </div>
                                    @php($dataT['field'] = getRequest('field'))

                                    <label for="inpu16"
                                        class="col-sm-1 col-form-label">{{ awtTrans('مجالات التعاون') }}</label>
                                    <div class="col-sm-4">
                                        <select class="form-control selec_coop" name="field" required>
                                            <option></option>
                                            @foreach (\App\Models\TrialTeralField::all() as $field)
                                                <option value="{{ $field->id }}">
                                                    {{ $field->name_ar }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @php($dataT['date_from'] = getRequest('date_from'))

                                <div class="form-group row">
                                    <label for="inpu5"
                                        class="col-sm-1 col-form-label">{{ awtTrans('تاريخ من') }}</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="date_from" value="{{ getRequest('date_from') }}"
                                            class="form-control date-picker-input" id="inpu5"
                                            placeholder="{{ awtTrans('تاريخ من') }}">
                                    </div>
                                    @php($dataT['date_to'] = getRequest('date_to'))

                                    <label for="inpu6"
                                        class="col-sm-1 col-form-label">{{ awtTrans('إلى تاريخ') }}</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="date_to" value="{{ getRequest('date_to') }}"
                                            class="form-control date-picker-input" id="inpu6"
                                            placeholder="{{ awtTrans('إلى تاريخ') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 text-right">
                                        <button type="submit" class="btn btn-primary">{{ awtTrans('بحث') }}</button>
                                    </div>
                                </div>
                            </form>
                        </dd>
                    </dl>

                </div>
            </div>

        </div>
    </div>
    <!-- end search -->
    <!--/page title-->
    <!-- begin table -->
    <form method="post" action="{{ route($route . '.delete') }}">

        {{ csrf_field() }}
        <div class="row">
            <div class="col-xl-12">
                @include('flash::message')

                <div class="mb-4">
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route($route . '.create') }}" class="btn btn-primary float-left"><i
                                        class="fa fa-plus-square-o"></i>{{ awtTrans('اضافه اتفاقيه') }}</a>
                                <button type="button" data-toggle="modal" data-target="#exampleModal"
                                    class="btn btn-danger float-right ml-1"><i class="fa fa-trash-o"></i>
                                    @lang('main.delete')</button>
                                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> --}}
                                {{-- Launch demo modal --}}
                                {{-- </button> --}}

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    {{ awtTrans('main.confirm') }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                {{ awtTrans('main.delete_confirm') }}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{trans('awt.main.close')}}</button>
                                                <button type="submit" name="submit" value="delete"
                                                    class="btn btn-danger float-right ml-1"><i class="fa fa-trash-o"></i>
                                                    @lang('main.delete')</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" name="submit" value="print"
                                    class="btn btn-primary float-right ml-1"><i class="fa fa-print"></i>
                                    {{ awtTrans('طباعة') }}</button>

                                <button type="submit" name="submit" value="export"
                                    class="btn btn-primary float-right ml-1"><i
                                        class="fa fa-file-excel-o"></i>{{ awtTrans(' تحميل اكسل') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body- pt-3 pb-4">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped" cellspacing="0">
                                <thead>
                                    <tr>
                                        @foreach ($table_rows as $row)
                                            <th>{!! $row['display'] !!}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        @foreach ($table_rows as $row)
                                            <th>{!! $row['display'] !!}</th>
                                        @endforeach
                                    </tr>
                                </tfoot>
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
            $('#datatable').DataTable({
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


        $("#check-all").click(function() {

            if ($('input:checkbox.chk-all').prop('checked')) {
                $('input:checkbox.chk-item').prop('checked', true);
            } else {
                $('input:checkbox.chk-item').prop('checked', false);
            }
        });
    </script>
    <script>
        // select country
        $(".selc_country").select2({
            placeholder: "اختر دولة"
        });
        $(".selc_stats").select2({
            placeholder: "اختر حالة الاتفاق"
        });
        $(".selec_coop").select2({
            placeholder: "اختر مجالات التعاون"
        });
    </script>
@endpush

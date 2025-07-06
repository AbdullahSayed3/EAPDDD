@extends('layouts.master')

@section('content')
    @php($dataT = [])
    @php($dataT['c_id'] = getRequest('c_id'))
    @php($dataT['inv'] = getRequest('inv'))
    @php($dataT['cost'] = getRequest('cost'))


    <!--main content wrapper-->
    <!--page title-->
    <div class="row">
        <div class="col-md-12">
            <div class="mb-4">
                <x-base.breadcrumb
                    title="{{ isset($invited)
                        ? (isset($course)
                            ? 'الدول المدعوه في الدوره التدريبية'
                            : 'الدول المدعوه في الدورات التدريبية')
                        : (isset($course)
                            ? 'الدول المشاركة في دوره التدريبية'
                            : 'الدول المدعوه في الدورات التدريبية') }}"
                    :breadcrumbs="[
                        ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
                        ['label' => 'الدول المدعوه في الدورات التدريبية', 'url' => route($route . '.index')],
                        [
                            'label' => isset($invited)
                                ? (isset($course)
                                    ? 'الدول المدعوه في الدوره التدريبية'
                                    : 'الدول المدعوه في الدورات التدريبية')
                                : (isset($course)
                                    ? 'الدول المشاركة في دوره التدريبية'
                                    : 'الدول المدعوه في الدورات التدريبية'),
                        ],
                    ]" />
                @if (getRequest('inv'))
                @else
                    <form>

                        <div class="form-group row p-3">

                            <label for="" class="col-sm-2 col-form-label">{{ awtTrans('التكلفة') }}</label>
                            <div class="col-sm-4">
                                <select class="form-control selc_rep_cost" name="cost">
                                    <option value="true" {{ getRequest('cost') == 'true' ? 'selected' : '' }}>

                                        {{ awtTrans('شامل التكلفة') }}
                                    </option>
                                    <option value="false" {{ getRequest('cost') == 'false' ? 'selected' : '' }}>
                                        {{ awtTrans('غير شامل التكلفة') }}
                                    </option>

                                </select>
                            </div>
                            <div class="col-sm-12 text-end">
                                <x-base.fillBtn type="submit" label="{{awtTrans('بحث')}}" />
                                <x-base.notfillBtn type="reset" label="{{awtTrans('الغاء')}}"
                                    class="btn-outline-danger border border-danger" />
                            </div>

                        </div>
                    </form>
                @endif


            </div>

        </div>
    </div>

    @if (isset($course))
        <!-- Conten of the page -->

        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="mb-4">

                    <div class="card-body">

                        <form>
                            <div class="form-group row">
                                <label for="inpu1"
                                    class="col-sm-2 col-form-label">{{ awtTrans('اسم الدورة التدريبية') }}</label>
                                <div class="col-sm-6">
                                    <p>{{ $course->name_ar }}</p>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
        <!-- end search -->
    @endif

    <!--/page title-->
    <!-- begin table -->
    <form method="post" action="{{ route('courses.countriesAction', $dataT) }}">

        {{ csrf_field() }}
        <div class="row">
            <div class="col-xl-12">
                @include('flash::message')

                <div class="mb-4">
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-md-12">
                                <x-base.fillBtn href="{{ route($route . '.create') }}" icon="fa-plus-square-o"
                                    label="{{awtTrans('اضافه دوره تدريبيه')}}" class="btn-primary float-start" />
                                <x-base.notfillBtn type="submit" name="submit" value="print" icon="fa-print"
                                    label="{{awtTrans('طباعة')}}" />
                                <x-base.notfillBtn type="submit" name="submit" value="export" icon="fa-file-excel-o"
                                    label="{{awtTrans('تحميل اكسل')}}" />
                            </div>
                        </div>
                    </div>
                    <div class="card-body- pt-3 pb-4">
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
                ajax: '{{ route($route . '.coursesDatatable', $dataT) }}',
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
    <script src="{{ asset('/assets/vendor/select2/js/select2.min.js') }}"></script>

    <script>
        // select country
        $(".selc_country").select2({
            placeholder: "{{ awtTrans('اختر الدول') }}"
        });
        $(".selc_cour_typ").select2({
            placeholder: "{{ awtTrans('اختر نوع الدورة') }}"
        });
        $(".selc_cour_train").select2({
            placeholder: "{{ awtTrans('اختر جهة التدريب') }}"
        });
    </script>
    <script>
        $(".selec_cours_typ").select2({
            placeholder: "{{ awtTrans('اختر نوع الدورة التدريبية') }}"
        });
        $(".selec_cours_typ2").select2({
            placeholder: "{{ awtTrans('اختر طبيعة الدورة التدريبية') }}"
        });
        $(".selec_cours_typ3").select2({
            placeholder: "{{ awtTrans('اختر مجال التعاون') }}"
        });
        $(".selc_cour_train").select2({
            placeholder: "{{ awtTrans('اختر الجهة المنطمة') }}"
        });
        $(".selc_cours_cord").select2({
            placeholder: "{{ awtTrans('اختر منسق الدورة') }}"
        });
    </script>
@endpush

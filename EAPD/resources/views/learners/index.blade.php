@extends('layouts.master')

@section('content')

@php
    // Initialize filter data array since backend isn't providing it
    $dataT = [
        'first_name'      => getRequest('first_name'),
        'second_name'     => getRequest('second_name'),
        'third_name'      => getRequest('third_name'),
        'country'         => getRequest('country'),
        'scholarships_id' => getRequest('scholarships_id'),
        'gender'          => getRequest('gender'),
    ];
@endphp

<!--main content wrapper-->
<!--page title-->
<x-base.breadcrumb title="قائمة الدارسين"
    :breadcrumbs="[['label' => 'الصفحة الرئيسية', 'url' => route('home')], ['label' => 'قائمة الدارسين']]" />
<!--/page title-->

<!-- start Filter -->
@include('learners.filter', ['dataT' => $dataT, 'route' => $route])
<!-- end Filter -->

<!-- begin table -->
<form method="post" action="{{ route('learners.delete', $dataT) }}">

    {{ csrf_field() }}
    <div class="row">
        <div class="col-xl-12">
            @include('flash::message')

            <div class="mb-4">
                <div class="card-header border-0">
                    <div class="row">
                        <div class="col-md-12">
                            @can('create_learners')
                            <a href="{{ route($route . '.create') }}" class="btn btn-primary float-start"><i class="fa fa-plus-square-o me-2"></i>{{ awtTrans('إضافة دارسين') }}</a>
                            @endcan

                            @can('delete_learners')
                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-danger float-end ms-1"><i class="fa fa-trash-o me-2"></i>@lang('main.delete')</button>
                            @endcan

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ trans('main.confirm') }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{ trans('main.delete_confirm') }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{trans('awt.main.close')}}</button>
                                            <button type="submit" name="submit" value="delete" class="btn btn-danger float-end ms-1"><i class="fa fa-trash-o me-2"></i>@lang('main.delete')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" name="submit" value="print" class="btn btn-primary float-end ms-1"><i class="fa fa-print me-2"></i>{{ awtTrans('طباعة') }}</button>
                            <button type="button" class="btn btn-primary float-end ms-1" formtarget="_blank" data-bs-toggle="modal" data-bs-target="#print"><i class="fa fa-print me-2"></i> {{ awtTrans('طباعة2') }}</button>

                            <!-- Modal -->
                            <div class="modal fade" id="print" tabindex="-1" aria-labelledby="printLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="printitle">{{ awtTrans('اختر خانات الطباعه') }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="print_title" class="form-label">{{ awtTrans('عنوان التقرير') }}</label>
                                                <input type="text" class="form-control" id="print_title" name="print_title" aria-describedby="print_title" placeholder="{{ awtTrans('عنوان التقرير') }}" value="{{ old('print_title') }}">
                                            </div>
                                            @foreach ($table_rows as $row)
                                                @if (!in_array($row['name'], ['chk','edit','id','assessments']))
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="{!! $row['name'] !!}" name="print_choices[{!! $row['display'] !!}]" value="{!! $row['name'] !!}" checked>
                                                        <label class="form-check-label" for="{!! $row['name'] !!}">{!! $row['display'] !!}</label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{trans('awt.main.close')}}</button>
                                            <button type="submit" name="submit" value="print2" formtarget="_blank" class="btn btn-primary float-end ms-1"><i class="fa fa-print me-2"></i>{{ awtTrans('طباعة2') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" name="submit" value="export" class="btn btn-primary float-end ms-1"><i class="fa fa-file-excel-o me-2"></i>{{ awtTrans('تحميل اكسل') }}</button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-3 pb-4">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-striped" cellspacing="0" style="border-bottom: 2px solid #ddd;">
                            <thead>
                                <tr>
                                    @foreach ($table_rows as $row)
                                        <th>{!! $row['display'] !!}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody></tbody>
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
    $('#datatable').DataTable({
        "columnDefs": [{ "orderable": false, "searchable": false, "targets": 0 }],
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
            paginate: { first: "{{ __('datatable.first') }}", previous: "{{ __('datatable.previous') }}", next: "{{ __('datatable.next') }}", last: "{{ __('datatable.last') }}" }
        },
        processing: true,
        serverSide: true,
        ajax: '{{ route($route . '.datatable', $dataT) }}',
        columns: [
            @foreach($table_rows as $row) {
                data: '{{ $row['data'] }}', name: '{{ $row['name'] }}', orderable: {{ $row['orderable'] }}, searchable: {{ $row['searchable'] }}
            },
            @endforeach
        ]
    });

    // Toggle all checkboxes
    $("#check-all").click(function() {
        $('input:checkbox.chk-item').prop('checked', this.checked);
    });
});
</script>
@endpush
@extends('layouts.master')

@section('content')
    <!--main content wrapper-->
    <!--page title-->
    <x-base.breadcrumb title="قائمة التقييمات" :breadcrumbs="[['label' => 'الصفحة الرئيسية', 'url' => route('home')], ['label' => 'قائمة التقييمات']]" />

    <!--/page title-->

    <!-- Conten of the page -->
    <div class="row">
        <div class="col-xl-12 col-md-12">
            @can('create_assessment')
            <div class="mb-4">
                <div class="card-body">
                    <form method="post" action="{{ route('assessments.import') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="inpu16"
                                class="col-sm-2 col-form-label">{{ awtTrans('تحميل ملف التقييمات') }}</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control " name="zip_file" id="inpu16"
                                    placeholder="{{ awtTrans('تحميل ملف المتدربين') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn btn-primary">{{ awtTrans('إضافة') }}</button>
                                <button type="reset" class="btn btn-danger">{{ awtTrans('إلغاء') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>      
            @endcan
          
        </div>
    </div>
    @if (isset($course))
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="mb-4">

                    <div class="card-body">


                        <div class="form-group row">
                            <label for="inpu1" class="col-sm-2 col-form-label">@lang('main.course_name')</label>
                            <div class="col-sm-4">
                                <p>{{ optional($course)->name() ?? ''  }}</p>
                            </div>

                        </div>


                    </div>
                </div>

            </div>
        </div>
    @endif
    <!-- begin table -->
    <form method="post" action="{{ route('assessments.delete') }}">

        {{ csrf_field() }}
        <div class="row">
            <div class="col-xl-12">
                @include('flash::message')
                <div class="mb-4">
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" name="submit" value="export" class="btn btn-primary float-left"><i
                                        class="fa fa fa-download"></i>@lang('main.export_data')</button>
                                        @can('delete_assessment')
                                <button type="button" data-toggle="modal" data-target="#exampleModal"
                                    class="btn btn-danger float-right ml-1"><i class="fa fa-trash-o"></i>
                                    @lang('main.delete')</button>             
                                        @endcan
                               
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
                @if (isset($_GET['course_id']))
                    ajax: '{{ route($route . '.datatable', ['course_id' => $_GET['course_id']]) }}',
                @else

                    ajax: '{{ route($route . '.datatable') }}',
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
        });


        $("#check-all").click(function() {

            if ($('input:checkbox.chk-all').prop('checked')) {
                $('input:checkbox.chk-item').prop('checked', true);
            } else {
                $('input:checkbox.chk-item').prop('checked', false);
            }
        });
    </script>
@endpush

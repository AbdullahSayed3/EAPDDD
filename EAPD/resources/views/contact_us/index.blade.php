@extends('layouts.master')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--main content wrapper-->
    <!--page title-->
    <x-base.breadcrumb title="{{ App::getLocale() == 'en' ? 'contact_us': 'contact_us' }}" :translate="true" :breadcrumbs="[['label' => 'الصفحة الرئيسية', 'url' => route('home')], ['label' => App::getLocale() == 'en' ? 'contact_us': 'contact_us' ]]" />

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

    <!--/page title-->
    <!-- begin table -->
    <form method="post" action="{{ route('courses.delete') }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-xl-12">
                @include('flash::message')
                <div class="mb-4">
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-md-12">
                                {{-- <a href="{{ route($route . '.create') }}" class="btn btn-primary float-left"><i
                                        class="fa fa-plus-square-o"></i>{{ awtTrans('اضافه قيمه') }}</a> --}}
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
                ajax: '{{ route($route . '.datatable') }}',
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

        $(document).on('click', '.delete-row', function(e) {
            e.preventDefault();

            const button = $(this); // store reference
            const url = button.data('delete-url');

            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert('Deleted successfully');

                    // For static (non-server-side) tables:
                    button.closest('tr').remove();

                    // For server-side DataTables (use only one of the two):
                    // $('#datatable').DataTable().ajax.reload(null, false); // false = don't reset pagination
                },
            });
        });
    </script>
@endpush

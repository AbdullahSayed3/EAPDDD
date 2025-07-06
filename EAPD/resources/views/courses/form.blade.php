@extends('layouts.master')

@section('content')
    <!--page title-->
    <x-base.breadcrumb :title="request()->routeIs('courses.create') ? 'إضافة دورة تدريبية' : 'تعديل دورة تدريبية'" :breadcrumbs="[
        ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
        ['label' => 'الدورات التدريبية', 'url' => route($route . '.index')],
        ['label' => request()->routeIs('courses.create') ? 'إضافة دورة تدريبية' : 'تعديل دورة تدريبية'],
    ]" />
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="mb-4">

                <div class="card-body">

                    @include('flash::message')

                    {!! form($form) !!}
                </div>
            </div>

        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
@endpush
@push('scripts')
    <!--select2-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize all Select2 elements with data-bs-toggle="select2"
            if ($.fn.select2) {
                $('[data-bs-toggle="select2"]').select2({
                    width: '100%'
                });

                // Also initialize by class for backward compatibility
                $(".selc_country").select2({
                    placeholder: "اختر دولة"
                });

                $(".selec_cours_typ").select2({
                    placeholder: "اختر نوع الدورة التدريبية"
                });
                $(".selec_cours_typ2").select2({
                    placeholder: "اختر طبيعة الدورة التدريبية"
                });
                $(".selec_cours_typ3").select2({
                    placeholder: "اختر مجال التعاون"
                });
                $(".selc_cour_train").select2({
                    placeholder: "اختر الجهة المنطمة"
                });
                $(".select2-place").select2({
                    placeholder: ""
                });
                $(".selc_cours_cord").select2({
                    placeholder: "اختر منسق الدورة"
                });


                $(".form-select").select2({
                    placeholder: ""
                });
            }

            function initializeTagsInput() {
                $('.input-tags').tagsinput({
                    trimValue: true,
                    confirmKeys: [13, 44], // Enter and comma
                    focusClass: 'focus',
                    allowDuplicates: false
                });

                // Handle tags input events
                $('.input-tags').on('itemAdded', function(event) {
                    console.log('Tag added:', event.item);
                });

                $('.input-tags').on('itemRemoved', function(event) {
                    console.log('Tag removed:', event.item);
                });
            }

            // Initialize Multi-Select for countries
            function initializeMultiSelect() {
                $('select[name="country_id[]"]').select2({
                    theme: 'bootstrap-5',
                    placeholder: '{{ awtTrans('select_countries') }}',
                    allowClear: true,
                    multiple: true,
                    width: '100%'
                });
            }

        });

        function limitImageUpload(input, maxFiles) {
            if (input.files.length > maxFiles) {
                alert(`You can only upload up to ${maxFiles} images.`);
                input.value = ''; // reset file input
            }
        }
    </script>
@endpush

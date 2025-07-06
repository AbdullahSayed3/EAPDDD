@extends('layouts.master')

@section('content')
    <!--page title-->
    <x-base.breadcrumb :title="request()->routeIs('scholarships.create') ? 'إضافة منحة' : 'تعديل منحة'" :breadcrumbs="[
        ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
        ['label' => 'الخبراء', 'url' => route($route . '.index')],
        ['label' => request()->routeIs('scholarships.create') ? 'إضافة منحة' : 'تعديل منحة'],
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
@push('scripts')
    <!--select2-->
    <script>
        $(document).ready(function() {
            // Initialize all Select2 elements with data-bs-toggle="select2"
            if ($.fn.select2) {
                // select country
                $(".participants").select2({
                    placeholder: ""
                });
            }
        })
    </script>
@endpush

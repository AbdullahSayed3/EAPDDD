@extends('layouts.master')

@section('content')
    <!--page title-->
    <div class="row">
        {{-- <div class="col-md-12">
            <div class="mb-4">
                <div class="page-title d-flex align-items-center p-3">
                    <div>
                        <h4 class="weight500 d-inline-block pr-3 mr-3 mb-0 border-right">{{ awtTrans('إضافة دارسين') }}</h4>
                        <nav aria-label="breadcrumb" class="d-inline-block ">
                            <ol class="breadcrumb p-0">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('home') }}">{{ awtTrans('الصفحة الرئيسية') }}</a></li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route($route . '.index') }}">{{ awtTrans('قائمة الدارسين') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ awtTrans('إضافة دارسين') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    
      <x-base.breadcrumb 
    :title="request()->routeIs('learners.create') ? 'إضافة دارسين' : 'تعديل دارسين'" 
    :breadcrumbs="[
        ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
        ['label' => 'الدارسين', 'url' => route($route . '.index')],
        ['label' => request()->routeIs('learners.create') ? 'إضافة دارسين' : 'تعديل دارسين'],
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
        // select country
        $(".selc_country").select2({
            placeholder: 'اختر دوله الجنسيه'
        });
        $(".selc_gender").select2({
            placeholder: "اختر النوع"
        });
        $(".selc_scholarship").select2({
            placeholder: "اختر منحة"
        });
    </script>
@endpush

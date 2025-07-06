@extends('layouts.master')

@section('content')
    <!--page title-->
    {{-- <x-base.breadcrumb title="إضافة مركز تميز / شريك" :breadcrumbs="[
        ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
        ['label' => 'الدورات التدريبية', 'url' => route('courses.index')],
        ['label' => 'مراكز التميز والشركاء', 'url' => route($route . '.index')],
        ['label' => 'إضافة مركز تميز / شريك'],
    ]" /> --}}

    <x-base.breadcrumb 
    :title="request()->routeIs('coursesPartners.create')  ? 'إضافة مركز تميز / شريك' : 'تعديل مركز تميز / شريك' "
    :breadcrumbs="[
        ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
        ['label' => 'الدورات التدريبية', 'url' => route('courses.index')],
        ['label' => 'مراكز التميز والشركاء', 'url' => route($route . '.index')],
        ['label' => request()->routeIs('coursesPartners.create')  ? 'إضافة مركز تميز / شريك' : 'تعديل مركز تميز / شريك' ],
    ]"
/>

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
        $(".selc_cours_cord").select2({
            placeholder: "اختر منسق الدورة"
        });
    </script>
@endpush

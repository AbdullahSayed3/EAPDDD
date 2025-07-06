@extends('layouts.master')

@section('content')
    <!--page title-->
    <x-base.breadcrumb 
    :title="request()->routeIs('events.create') ? 'إضافة فعالية' : 'تعديل فعالية'" 
    :breadcrumbs="[
        ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
        ['label' => 'فعاليات', 'url' => route($route . '.index')],
        ['label' => request()->routeIs('courses.create') ? 'إضافة فعالية' : 'تعديل فعالية'],
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
@section('custom_scripts')
@endsection

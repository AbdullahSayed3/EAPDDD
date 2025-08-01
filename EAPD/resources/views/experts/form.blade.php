@extends('layouts.master')

@section('content')
    <!--page title-->


    <x-base.breadcrumb :title="request()->routeIs('experts.create') ? 'إضافة خبير' : 'تعديل خبير'" :breadcrumbs="[
        ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
        ['label' => 'الخبراء', 'url' => route($route . '.index')],
        ['label' => request()->routeIs('courses.create') ? 'إضافة خبير' : 'تعديل خبير'],
    ]" />

    <!-- Conten of the page -->
    <div class="row">
        <div class="col-xl-10 col-md-10">
            <div class="mb-4">
                <div class="card-body">
                    <form method="post" action="{{ route('experts.import') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="inpu16" class="col-sm-2 col-form-label">{{ awtTrans('تحميل ملف خبراء') }}</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control " name="zip_file" id="inpu16"
                                    placeholder="{{ awtTrans('تحميل ملف خبراء') }}">
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
        </div>
        <div class="col-md-2">
            <a href="{{ asset('excel_example/expertsExample.xlsx') }}" target="_blank"
                class="btn btn-primary">{{ awtTrans('تحميل ملف') }}</a>

        </div>
    </div>
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

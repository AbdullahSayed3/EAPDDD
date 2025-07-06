@extends('layouts.master')

@section('content')
    <!--/page title-->

    <x-base.breadcrumb title="{{ $model->type->name_ar }}" :translate="false" :breadcrumbs="[
        ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
        ['label' => 'فعاليات', 'url' => route($route . '.index')],
        ['label' => $model->type->name_ar],
    ]" />
    <!-- Content of the page -->

    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card shadow-sm mb-4">

                <div class="card-body">
                    <form method="post" action="{{ route($route . '.delete') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="courses[]" value="{{ $model->id }}">
                        <div class="mb-3 row">
                            <label for="inpu1" class="col-sm-2 col-form-label">{{ awtTrans('نوع الفعالية') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->type->name_ar ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inpu11" class="col-sm-2 col-form-label">{{ awtTrans('الموضوع الرئيسي') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->subject }}</p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inpu11" class="col-sm-2 col-form-label">{{ trans('awt.الجهات المشاركة') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">
                                    {{ $model->organizations() }}
                                </p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inpu5" class="col-sm-2 col-form-label">{{ awtTrans('تاريخ البدء') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->start_date->format('Y-m-d') }}</p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inpu10" class="col-sm-2 col-form-label">{{ awtTrans('تاريخ الإنتهاء') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->end_date->format('Y-m-d') }}</p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inpu15" class="col-sm-2 col-form-label">{{ awtTrans('مكان الإنعقاد') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->location }}</p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inpu16" class="col-sm-2 col-form-label">{{ awtTrans('وثائق ذات صلة') }} </label>
                            <div class="col-sm-6">
                                @foreach (unserialize($model->documents) as $file)
                                    <a href="{{ asset('uploads/events/' . $file) }}" target="_blank" class="d-block mb-1">
                                        <i class="fa fa-file-pdf-o me-1"></i> {{ awtTrans('تحميل الملف') }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu9" class="col-sm-2 col-form-label">{{ awtTrans('ملاحظات أخرى') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->notes }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row d-print-none">
                            <div class="col-sm-12 text-end">
                                @can('edit_events')                                    
                                <x-base.fillBtn href="{{ route($route . '.edit', $model->id) }}" icon="fa-file-text-o"
                                    label="{{trans('awt.تعديل')}}" />
                                @endcan

                                <x-base.notfillBtn type="submit" name="submit" value="print" icon="fa-print"
                                    label="{{trans('awt.طباعة')}}" />

                                <input name="courses[]" type="hidden" value="{{ $model->id }}">

                                <x-base.notfillBtn type="submit" name="submit" value="export" icon="fa-file-excel-o"
                                    label="{{trans('awt.تحميل ملف اكسل')}}" />

                                <x-base.notfillBtn href="{{ route($route . '.index') }}" icon="fa-sign-out" label="{{trans('awt.back')}}"
                                    class="btn-outline-danger border border-danger" />
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
    <!-- end search -->
@endsection
@push('scripts')
@endpush

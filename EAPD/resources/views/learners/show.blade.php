@extends('layouts.master')

@section('content')
    <!--/page title-->
    <x-base.breadcrumb title="{{ $model->name() }}" :translate="false" :breadcrumbs="[
        ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
        ['label' => 'قائمة الدارسين', 'url' => route($route . '.index')],
        ['label' => $model->name()],
    ]" />
    <!-- Conten of the page -->

    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="mb-4">

                <div class="card-body">

                    <form method="post" action="{{ route($route . '.delete') }}">

                        {{ csrf_field() }}
                        <input type="hidden" name="learners[]" value="{{ $model->id }}">
                        <div class="form-group row">
                            <label for="inpu1" class="col-sm-2 col-form-label">{{ awtTrans('الاسم') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->name() }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu11" class="col-sm-2 col-form-label">{{ awtTrans('النوع') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->gender == 'male' ? awtTrans('ذكر') : awtTrans('انثي') }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu11" class="col-sm-2 col-form-label">{{ awtTrans('الجنسيه') }}</label>
                            <div class="col-sm-6">
                                <p>
                                    {{ getCountry($model->nationality) }}
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu5"
                                class="col-sm-2 col-form-label">{{ awtTrans('البريد الالكتروني') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->email_address }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu10" class="col-sm-2 col-form-label">{{ awtTrans('المنحة الحالية') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->scholarship->program }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu15" class="col-sm-2 col-form-label">{{ awtTrans('السن') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->age() }}</p>

                            </div>
                        </div>



                        <div class="form-group row d-print-none">
                            <div class="col-sm-12 text-right">
                                @can('edit_learners')                                    
                                <a href="{{ route($route . '.edit', [$model->id]) }}" class="btn btn-primary"><i
                                        class="fa fa-file-text-o"></i> {{ awtTrans('تعديل') }}</a>
                                @endcan

                                <button type="submit" name="submit" value="print" class="btn btn-primary"><i
                                        class="fa fa-print"></i>{{ awtTrans('طباعة') }} </button>
                                <input name="courses[]" type="hidden" value="{{ $model->id }}">

                                <button type="submit" name="submit" value="export" class="btn btn-primary"><i
                                        class="fa fa-file-excel-o"></i> {{ awtTrans('تحميل ملف اكسل') }} </button>


                                <a href="{{ route($route . '.index') }}" class="btn btn-danger"><i
                                        class="fa fa-sign-out"></i> {{ awtTrans('عوده') }} </a>
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

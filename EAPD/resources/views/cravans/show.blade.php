@extends('layouts.master')

@section('content')
    <!--page title-->
    {{-- <div class="row">
        <div class="col-md-12">
            <div class="mb-4">
                <div class="page-title d-flex justify-content-between align-items-center p-3">
                    <h4 class="fw-500 d-inline-block pe-3 me-3 mb-0 border-end">{{ $model->type->name_ar }}</h4>
                    <nav aria-label="breadcrumb" class="d-inline-block">
                        <ol class="breadcrumb p-0 mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ awtTrans('الصفحة الرئيسية') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route($route . '.index') }}">{{ awtTrans('المنح والمعونات') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $model->type->name_ar }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div> --}}
    <x-base.breadcrumb title="{{ optional($model->type)->name_ar }}" :translate="false" :breadcrumbs="[
        ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
        ['label' => 'المنح والمعونات', 'url' => route($route . '.index')],
        ['label' => optional($model->type)->name_ar],
    ]" />
    <!--/page title-->

    <!-- Content of the page -->
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form method="post" action="{{ route($route . '.delete') }}">
                        {{ csrf_field() }}
                          <div class="mb-3 row">
                            <label for="input_status" class="col-sm-2 col-form-label">{{ awtTrans('الحالة') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">
                                    @if($model->is_active)
                                        <span class="badge bg-success">
                                            <i class="fa fa-check me-1"></i>{{ awtTrans('نشط') }}
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="fa fa-times me-1"></i>{{ awtTrans('غير نشط') }}
                                        </span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        @if($model->image)
                        <div class="mb-3 row">
                            <label for="input_image" class="col-sm-2 col-form-label">{{ awtTrans('صورة الوظيفة') }}</label>
                            <div class="col-sm-6">
                                <img src="{{ asset('uploads/aids_file/' . $model->image) }}" alt="{{ $model->name }}" 
                                     class="img-thumbnail" style="max-width: 200px; max-height: 150px;">
                            </div>
                        </div>
                        @endif
                        <div class="mb-3 row">
                            <label for="inpu1" class="col-sm-2 col-form-label">{{ awtTrans('name_en') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->title_en }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu1" class="col-sm-2 col-form-label">{{ awtTrans('name_ar') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->title_ar }}</p>
                            </div>
                        </div>

                        
                        <div class="mb-3 row">
                            <label for="inpu1" class="col-sm-2 col-form-label">{{ awtTrans('name_fr') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->title_fr }}</p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inpu1" class="col-sm-2 col-form-label">{{ awtTrans('نوع المنحة') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ optional($model->type)->name_ar }}</p>
                            </div>
                        </div>
                           <div class="mb-3 row">
                            <label for="inpu1" class="col-sm-2 col-form-label">{{ trans('awt.link') }}</label>
                            <div class="col-sm-6">
                               <a href="{{$model->url}}">{{$model->url}}</a>
                            </div>
                        </div>

                          <div class="mb-3 row">
                            <label for="inpu1" class="col-sm-2 col-form-label">{{ trans('awt.contact') }}</label>
                            <div class="col-sm-6">
                               <a href="{{$model->contact}}">{{$model->contact}}</a>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword3"
                                class="col-sm-2 col-form-label">{{ awtTrans('الدولة المستفيدة') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ getCountry($model->country_id) }}</p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inpu11"
                                class="col-sm-2 col-form-label">{{ awtTrans('الجهة المتلقية بالدولة') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->country_org }}</p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inpu111"
                                class="col-sm-2 col-form-label">{{ awtTrans('رقم موافقة الوزير أو مجلس الإدارة') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->minister_name }}</p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inpu5" class="col-sm-2 col-form-label">{{ awtTrans('تاريخ الشحن') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->ship_date->format('Y-m-d') }}</p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inpu5" class="col-sm-2 col-form-label">{{ awtTrans('تاريخ الوصول') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->arrive_date->format('Y-m-d') }}</p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inpu10"
                                class="col-sm-2 col-form-label">{{ awtTrans('القيمة (شاملة الشحن)') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->cost }}</p>
                            </div>
                        </div>
                        <hr>
                        <h4>{{ awtTrans('بيانات المورد') }}</h4>
                        @foreach (unserialize($model->suppliers) as $row)
                            <div class="mb-3 row">
                                <label for="inpu10" class="col-sm-2 col-form-label">{{ awtTrans('اسم المورد') }}</label>
                                <div class="col-sm-6">
                                    <p class="form-control-plaintext">{{ getSupplier($row['id']) }}</p>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inpu10" class="col-sm-2 col-form-label">{{ awtTrans('القيمة') }}</label>
                                <div class="col-sm-6">
                                    <p class="form-control-plaintext">{{ $row['cost'] }}</p>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inpu9" class="col-sm-2 col-form-label">{{ awtTrans('التفاصيل') }}</label>
                                <div class="col-sm-6">
                                    <p class="form-control-plaintext">
                                        {{ isset($row['details']) ? $row['details'] : 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inpu10"
                                    class="col-sm-2 col-form-label">{{ awtTrans('تاريخ الإنتهاء / الصلاحية') }}</label>
                                <div class="col-sm-6">
                                    <p class="form-control-plaintext">{{ $row['end_date'] }}</p>
                                </div>
                            </div>
                            <hr>
                        @endforeach

                        <div class="mb-3 row">
                            <label for="inpu9" class="col-sm-2 col-form-label">{{ awtTrans('ملاحظات أخرى') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->notes }}</p>
                            </div>
                        </div>
                        <div class="mb-3 row d-print-none">
                            <div class="col-sm-12 text-end">
                                @can('edit_aids')
                                    
                                <x-base.fillBtn href="{{ route($route . '.edit', [$model->id]) }}" icon="fa-file-text-o"
                                    label="تعديل" />
                                @endcan

                                <x-base.notfillBtn type="submit" name="submit" value="print" icon="fa-print"
                                    label="طباعة" />

                                <input name="courses[]" type="hidden" value="{{ $model->id }}">

                                <x-base.notfillBtn type="submit" name="submit" value="export" icon="fa-file-excel-o"
                                    label="تحميل ملف اكسل" />

                                <x-base.notfillBtn href="{{ route($route . '.index') }}" icon="fa-sign-out" label="عوده"
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

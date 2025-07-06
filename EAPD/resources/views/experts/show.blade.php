@extends('layouts.master')

@section('content')
    <!--/page title-->


    <!--page title-->
    <x-base.breadcrumb title="{{ $model->name }}" :translate="false" :breadcrumbs="[
        ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
        ['label' => 'قسم الخبراء', 'url' => route($route . '.index')],
        ['label' => $model->name],
    ]" />
    <!-- Conten of the page -->

    <div class="row">
        <div class="col-xl-3 col-md-3">
            <div class="mb-4">
                <div class="card-body">
                    <img class="rounded-circle" src="{{ asset('uploads/experts/' . $model->personal_picture) }}" width="100%"
                        alt="" />
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-md-9">
            <div class="mb-4">
                <div class="card-body">

                    <form method="post" action="{{ route($route . '.delete') }}">

                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="inpu1" class="col-sm-2 col-form-label">{{ awtTrans('الاسم') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->name }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">{{ awtTrans('الدولة') }}</label>
                            <div class="col-sm-6">
                                <p>{{ getCountry($model->country) }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu2" class="col-sm-2 col-form-label">{{ awtTrans('التخصص') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->specialist }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu3" class="col-sm-2 col-form-label">{{ awtTrans('التخصص الفرعي') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->sub_specialist }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu7" class="col-sm-2 col-form-label">{{ awtTrans('المؤهل الدراسي') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->qualification }}</p>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu15" class="col-sm-2 col-form-label">{{ awtTrans('الشهادات') }}</label>
                            <div class="col-sm-4">
                                @foreach (unserialize($model->certifications) as $row)
                                    <a target="_blank" href="{{ asset('/uploads/experts/' . $row) }}" class="d-block"><i
                                            class="fa fa-file-pdf-o"></i> {{ awtTrans('تحميل الملف') }}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group row">

                            <label for="inpu8" class="col-sm-2 col-form-label">{{ awtTrans('النوع') }}</label>
                            <div class="col-sm-6">
                                <p>{{ awtTrans($model->gender) }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu9"
                                class="col-sm-2 col-form-label">{{ awtTrans('اللغات التي يجيدها') }}</label>
                            <div class="col-sm-6">
                                <p>
                                    @foreach (unserialize($model->languages) as $row)
                                        {{ $row }}<br>
                                    @endforeach
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="inpu10" class="col-sm-2 col-form-label">@lang('main.current_employer')</label>
                            <div class="col-sm-6">
                                <p>{{ $model->current_employer }}</p>
                            </div>
                        </div>
                        <div class="form-group row">

                            <label for="inpu10" class="col-sm-2 col-form-label">@lang('main.employer_address')</label>
                            <div class="col-sm-6">
                                <p>{{ $model->employer_address }}</p>
                            </div>
                        </div>
                        <div class="form-group row">

                            <label for="inpu10" class="col-sm-2 col-form-label">@lang('main.employer_phone')</label>
                            <div class="col-sm-6">
                                @foreach (unserialize($model->employer_phone) as $row)
                                    {{ $row }}<br />
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="inpu10" class="col-sm-2 col-form-label">@lang('main.employer_email')</label>
                            <div class="col-sm-6">
                                <p>{{ $model->employer_email }}</p>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu9"
                                class="col-sm-2 col-form-label">{{ awtTrans('سوابق التعاقدات مع الوكالة إن وجدت') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->old_contracts }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-2 col-form-label">{{ awtTrans('السيرة الذاتية') }}</label>
                            <div class="col-sm-4">
                                @if (!empty($model->cv))
                                    <a href="{{ asset('/uploads/experts/' . $model->cv) }}" class="d-block"><i
                                            class="fa fa-file-pdf-o"></i>{{ awtTrans('السيرة الذاتية') }}</a>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu11" class="col-sm-2 col-form-label">{{ awtTrans('رقم الهاتف') }}</label>
                            <div class="col-sm-6">
                                @foreach (unserialize($model->phone) as $row)
                                    {{ $row }}<br />
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group row">

                            <label for="inpu12"
                                class="col-sm-2 col-form-label">{{ awtTrans('البريد الإلكتروني') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->email }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu13" class="col-sm-2 col-form-label">{{ awtTrans('حالة الخبير') }}</label>
                            <div class="col-sm-4">
                                @if ($model->status == 'current')
                                    <p>{{ awtTrans('خبير حالي') }}</p>
                                @elseif($model->status == 'old')
                                    <p>{{ awtTrans('خبير سابق') }}</p>
                                @else
                                    <p>{{ awtTrans('مرشح للعمل') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu18" class="col-sm-2 col-form-label">{{ awtTrans('شروط التعاقد') }}</label>
                            <div class="col-sm-4">
                                @foreach (unserialize($model->contract_rules) as $row)
                                    <a target="_blank" href="{{ asset('/uploads/experts/' . $row) }}" class="d-block"><i
                                            class="fa fa-file-pdf-o"></i> {{ awtTrans('تحميل الملف') }}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu14"
                                class="col-sm-2 col-form-label">{{ awtTrans('الدولة الموفد إليها حالياً') }}</label>
                            <div class="col-sm-6">
                                <p>{{ getCountry($model->delegate_country) }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu9"
                                class="col-sm-2 col-form-label">{{ awtTrans('الجهة الموفد إليها حالياً') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->delegate_org }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu5" class="col-sm-2 col-form-label">{{ awtTrans('بداية التعاقد') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->contract_date->format('Y-m-d') }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu6" class="col-sm-2 col-form-label">{{ awtTrans('نهاية التعاقد') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->end_date->format('Y-m-d') }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu6"
                                class="col-sm-2 col-form-label">{{ awtTrans('التكلفة السنوية') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->cost }} {{ trans('awt.جنيه مصري') }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu19"
                                class="col-sm-2 col-form-label">{{ awtTrans('بيانات الموافقات ذات الصلة') }}</label>
                            <div class="col-sm-4">
                                @foreach (unserialize($model->acceptation_info) as $row)
                                    <a target="_blank" href="{{ asset('/uploads/experts/' . $row) }}" class="d-block"><i
                                            class="fa fa-file-pdf-o"></i> {{ awtTrans('تحميل الملف') }}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu9" class="col-sm-2 col-form-label">{{ awtTrans('ملاحظات أخرى') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->notes }}</p>
                            </div>
                        </div>


                        <div class="form-group row d-print-none">
                            <div class="col-sm-12 text-right">
                                @can('edit_experts')
                                    
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

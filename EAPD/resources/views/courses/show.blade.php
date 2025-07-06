@extends('layouts.master')

@section('content')
    <!--page title-->
    <x-base.breadcrumb title="{{ $model->name_ar }}" :translate="false" :breadcrumbs="[
        ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
        ['label' => 'الدورات التدريبية', 'url' => route($route . '.index')],
        ['label' => $model->name_ar],
    ]" />

    <!-- Content of the page -->

    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form method="post" action="{{ route($route . '.delete') }}">
                        {{ csrf_field() }}

                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                {!! $qrCode !!}
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inpu1"
                                class="col-sm-2 col-form-label">{{ awtTrans('اسم الدورة التدريبية') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->name_ar }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu1" class="col-sm-2 col-form-label">{{ awtTrans('name_en') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->name_en }}</p>
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <label for="inpu1" class="col-sm-2 col-form-label">{{ awtTrans('name_fr') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->name_fr }}</p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">{{ awtTrans('نوع الدورة') }}</label>
                            <div class="col-sm-4">
                                <p class="form-control-plaintext">{{ $choices[$model->type_id] ?? trans('awt.Unknown') }}
                                </p>
                            </div>

                            <label for="inpu11" class="col-sm-2 col-form-label">{{ awtTrans('طبيعة الدورة') }}</label>
                            <div class="col-sm-4">
                                <p class="form-control-plaintext">{{ $model->natural->name_ar ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu111" class="col-sm-2 col-form-label">{{ awtTrans('مجال التعاون') }}</label>
                            <div class="col-sm-4">
                                <p class="form-control-plaintext">{{ $model->field->name_ar }}</p>
                            </div>
                            <label for="inpu10" class="col-sm-2 col-form-label">{{ awtTrans('اسم منسق الدورة') }}</label>
                            <div class="col-sm-4">
                                @foreach (unserialize($model->trainees) as $item)
                                    <?php $t = \App\Models\CourseTrianee::where('id', $item)->first(); ?>
                                    @if (!empty($t))
                                        <p class="form-control-plaintext"><a href="#">{{ $t->name_ar }}</a></p>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inpu5" class="col-sm-2 col-form-label">{{ awtTrans('المحتوى') }}</label>
                            <div class="col-sm-4">
                                <p class="form-control-plaintext">{{ $model->content }}</p>
                            </div>
                            <br>

                            <div class="col-sm-4">
                                <p class="form-control-plaintext">{{ $model->content_en }}</p>
                            </div>

                            <div class="col-sm-4">
                                <p class="form-control-plaintext">{{ $model->content_fr }}</p>
                            </div>

                            <label for="inpu10" class="col-sm-2 col-form-label">{{ awtTrans('وثائق ذات صلة') }}</label>
                            <div class="col-sm-4">
                                @foreach (unserialize($model->documents) as $file)
                                    <a href="{{ asset('uploads/course/' . $file) }}" target="_blank"
                                        class="d-block mb-1"><i class="fa fa-file-pdf-o"></i>
                                        {{ awtTrans('تحميل الملف') }}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inpu5" class="col-sm-2 col-form-label">{{ awtTrans('تاريخ البدء') }}</label>
                            <div class="col-sm-4">
                                <p class="form-control-plaintext">{{ $model->start_date->format('Y-m-d') }}</p>
                            </div>
                            <label for="inpu15" class="col-sm-2 col-form-label">{{ awtTrans('تاريخ الإنتهاء') }}</label>
                            <div class="col-sm-4">
                                <p class="form-control-plaintext">{{ $model->end_date->format('Y-m-d') }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu10" class="col-sm-2 col-form-label">{{ awtTrans('مكان الإنعقاد') }}</label>
                            <div class="col-sm-4">
                                <p class="form-control-plaintext">{{ optional($model->place)['name_' . App::getLocale()] }}
                                </p>
                            </div>
                            <label for="inpu10" class="col-sm-2 col-form-label">{{ awtTrans('الجهة المنظمة') }}</label>
                            <div class="col-sm-4">
                                <p class="form-control-plaintext">{{ optional($model->organization)->name }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu9" class="col-sm-2 col-form-label">{{ awtTrans('الدول المدعوة') }}</label>
                            <div class="col-sm-6">
                                @foreach (unserialize($model->countries) as $item)
                                    <p class="form-control-plaintext">{{ getCountry($item) }}</p>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu10"
                                class="col-sm-2 col-form-label">{{ awtTrans('إجمالي عدد المتدربين') }}</label>
                            <div class="col-sm-4">
                                <p class="form-control-plaintext">
                                    {{ $model->applications()->where('wait_list', 'false')->count() }}</p>
                            </div>

                            <label for="inpu10" class="col-sm-2 col-form-label">{{ awtTrans('عدد المتدربات') }}</label>
                            <div class="col-sm-4">
                                <p class="form-control-plaintext">
                                    {{ $model->applications()->where('wait_list', 'false')->where('gender', 'female')->count() }}
                                </p>
                            </div>
                        </div>

                        {{-- <div class="mb-3 row">
                            <label for="inpu10" class="col-sm-2 col-form-label">{{ awtTrans('تكلفة الفرد') }}</label>
                            <div class="col-sm-4">
                                <p class="form-control-plaintext">{{ $model->cost }}</p>
                            </div>
                            <label for="inpu10"
                                class="col-sm-2 col-form-label">{{ awtTrans('التكلفة الإجمالية') }}</label>
                            <div class="col-sm-4">
                                <p class="form-control-plaintext">{{ $model->cost * $model->applications->count() }}</p>
                            </div>
                        </div> --}}
                        <div class="mb-3 row">
                            <label for="inpu9" class="col-sm-2 col-form-label">{{ awtTrans('ملاحظات أخرى') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->notes }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row d-print-none">
                            <div class="col-sm-6">
                                <a href="{{ route('applicants.index', ['course' => $model->id]) }}"
                                    class="btn btn-primary">
                                    <i class="icon-people"></i> {{ awtTrans('قائمة المتدربين') }}
                                </a>
                            </div>
                            <div class="col-sm-12 text-end">
                                @can('edit_courses')
                                    <a href="{{ route($route . '.edit', [$model->id]) }}" class="btn btn-primary">
                                        <i class="fa fa-file-text-o"></i> {{ awtTrans('تعديل') }}
                                    </a>
                                @endcan

                                <input name="courses[]" type="hidden" value="{{ $model->id }}">
                                <button type="submit" name="submit" value="print" class="btn btn-primary">
                                    <i class="fa fa-print"></i> {{ awtTrans('طباعة') }}
                                </button>

                                {{-- <button type="submit" name="submit" value="print_qr" class="btn btn-primary">
                                    <i class="fa fa-print"></i> {{ awtTrans('print_qrcode') }}
                                </button> --}}

                                <a class="btn btn-primary" target="_blank"
                                    href="{{ route('print_qrcode', $model->id) }}">{{ awtTrans('print_qrcode') }}</a>
                                <button type="submit" name="submit" value="export" class="btn btn-primary">
                                    <i class="fa fa-file-excel-o"></i> {{ awtTrans('تحميل ملف اكسل') }}
                                </button>

                                <a href="{{ route($route . '.index') }}" class="btn btn-danger">
                                    <i class="fa fa-sign-out"></i> {{ awtTrans('عوده') }}
                                </a>
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

@extends('layouts.master')

@section('content')
    <!--/page title-->
    <x-base.breadcrumb title="{{ $model->program }}" :translate="false" :breadcrumbs="[
        ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
        ['label' => 'المنح الدراسية', 'url' => route($route . '.index')],
        ['label' => $model->program],
    ]" />

    <!-- Conten of the page -->

    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="mb-4">

                <div class="card-body">

                    <form method="post" action="{{ route($route . '.delete') }}">

                        {{ csrf_field() }}
                        <input type="hidden" name="scholarships[]" value="{{ $model->id }}">
                        @if($model->image)
                        <div class="form-group row">
                            <label for="image" class="col-sm-2 col-form-label">{{ awtTrans('الصورة') }}</label>
                            <div class="col-sm-6">
                                <img src="{{ asset('uploads/scholarships' . $model->image) }}" alt="{{ $model->program }}" class="img-thumbnail" style="max-width: 200px;">
                            </div>
                        </div>
                        @endif

                          <!-- Status -->
                        <div class="form-group row">
                            <label for="is_active" class="col-sm-2 col-form-label">{{ awtTrans('الحالة') }}</label>
                            <div class="col-sm-6">
                                @if($model->is_active)
                                    <span class="text-success">{{ awtTrans('نشط') }}</span>
                                @else
                                    <span class="text-danger">{{ awtTrans('غير نشط') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu1"
                                class="col-sm-2 col-form-label">{{ awtTrans('program_ar') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->program }}</p>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="inpu1"
                                class="col-sm-2 col-form-label">{{ awtTrans('program_en') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->program_en }}</p>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="inpu1"
                                class="col-sm-2 col-form-label">{{ awtTrans('program_fr') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->program_fr }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu11" class="col-sm-2 col-form-label">{{ awtTrans('الجهة') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->owner }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu11" class="col-sm-2 col-form-label">{{ awtTrans('الدول المشاركة') }}</label>
                            <div class="col-sm-6">
                                <p>
                                    @foreach (unserialize($model->participants) as $row)
                                        {{ getCountry($row) }}<br>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu5" class="col-sm-2 col-form-label">{{ awtTrans('تاريخ البدء') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->start_date->format('Y-m-d') }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu10" class="col-sm-2 col-form-label">{{ awtTrans('تاريخ الإنتهاء') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->end_date->format('Y-m-d') }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu15" class="col-sm-2 col-form-label"> {{ awtTrans('مجال الدراسة') }}</label>
                            <div class="col-sm-6">
                                <p> {{ $model->field->name_ar }}</p>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu16" class="col-sm-2 col-form-label">{{ awtTrans('عدد الدراسين') }} </label>
                            <div class="col-sm-6">
                                <p>{{ $model->learners->count() }}</p>
                            </div>
                        </div>

                            <!-- Content Arabic -->
                        @if($model->content_ar)
                        <div class="form-group row">
                            <label for="content_ar" class="col-sm-2 col-form-label">{{ awtTrans('المحتوى (عربي)') }}</label>
                            <div class="col-sm-10">
                                <div class="border p-3 bg-light">
                                    {!! nl2br(e($model->content_ar)) !!}
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Content English -->
                        @if($model->content_en)
                        <div class="form-group row">
                            <label for="content_en" class="col-sm-2 col-form-label">{{ awtTrans('المحتوى (إنجليزي)') }}</label>
                            <div class="col-sm-10">
                                <div class="border p-3 bg-light">
                                    {!! nl2br(e($model->content_en)) !!}
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Content French -->
                        @if($model->content_fr)
                        <div class="form-group row">
                            <label for="content_fr" class="col-sm-2 col-form-label">{{ awtTrans('المحتوى (فرنسي)') }}</label>
                            <div class="col-sm-10">
                                <div class="border p-3 bg-light">
                                    {!! nl2br(e($model->content_fr)) !!}
                                </div>
                            </div>
                        </div>
                        @endif






                        <div class="form-group row d-print-none">
                            <div class="col-sm-12 text-right">
                                @can('edit_scholarships')
                                <a href="{{ route($route . '.edit', [$model->id]) }}" class="btn btn-primary"><i
                                        class="fa fa-file-text-o"></i> {{ awtTrans('تعديل') }}</a>
                                    
                                @endcan
                                <button type="submit" name="submit" value="print" class="btn btn-primary"><i
                                        class="fa fa-print"></i>{{ awtTrans('طباعة') }} </button>
                                <input name="scholarships[]" type="hidden" value="{{ $model->id }}">

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

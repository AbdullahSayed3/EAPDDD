@extends('layouts.master')

@section('content')
    <!--page title-->
    <x-base.breadcrumb title="{{ $model->name }}" :translate="false" :breadcrumbs="[
        ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
        ['label' => 'الدورات التدريبية', 'url' => route('courses.index')],
        ['label' => 'مراكز التميز والشركاء', 'url' => route($route . '.index')],
        ['label' => $model->name],
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
                            <label for="inpu1"
                                class="col-sm-2 col-form-label">{{ awtTrans('اسم المركز / الشريك') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->name }}</p>
                            </div>
                        </div>

                        
                        <div class="mb-3 row">
                            <label for="inpu1"
                                class="col-sm-2 col-form-label">{{ awtTrans('name_en') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->name_en }}</p>
                            </div>
                        </div>

                        
                        <div class="mb-3 row">
                            <label for="inpu1"
                                class="col-sm-2 col-form-label">{{ awtTrans('name_fr') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->name_fr }}</p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">{{ awtTrans('مجال العمل') }}</label>
                            <div class="col-sm-4">
                                <p class="form-control-plaintext">{{ $model->field->name_ar }}</p>
                            </div>
                            <label for="inpu11" class="col-sm-2 col-form-label">{{ awtTrans('طبيعة الجهة') }}</label>
                            <div class="col-sm-4">
                                <p class="form-control-plaintext">{{ $model->natural->name_ar }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu5" class="col-sm-2 col-form-label">{{ awtTrans('العنوان بالعربية') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->address }}</p>
                            </div>
                        </div>

                        
                        <div class="mb-3 row">
                            <label for="inpu5" class="col-sm-2 col-form-label">{{ awtTrans('العنوان بالانجليزية') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->address_en }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu5" class="col-sm-2 col-form-label">{{ awtTrans('العنوان بالفرنسية') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->address_fr }}</p>
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <label for="inpu5"
                                class="col-sm-2 col-form-label">{{ awtTrans('اسم نقطة الاتصال') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->contact_name }}</p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inpu5" class="col-sm-2 col-form-label">{{ awtTrans('التليفون') }}</label>
                            <div class="col-sm-4">
                                <p class="form-control-plaintext">{{ $model->contact_phone }}</p>
                            </div>
                            <label for="inpu15"
                                class="col-sm-2 col-form-label">{{ awtTrans('البريد الالكتروني') }}</label>
                            <div class="col-sm-4">
                                <p class="form-control-plaintext">{{ $model->contact_email }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu10" class="col-sm-2 col-form-label">{{ awtTrans('وثائق ذات صلة') }}</label>
                            <div class="col-sm-4">
                                @foreach (unserialize($model->documents) as $file)
                                    <a href="{{ asset('uploads/course/' . $file) }}" target="_blank" class="d-block"><i
                                            class="fa fa-file-pdf-o"></i> {{ awtTrans('تحميل الملف') }}</a>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu10"
                                class="col-sm-2 col-form-label">{{ awtTrans('إجمالي عدد المتدربين') }}</label>
                            <div class="col-sm-4">
                                <?php
                                $coures = $model->courses;
                                $total = 0;
                                foreach ($coures as $course) {
                                    $total += $course->applications()->where('wait_list', 'false')->count();
                                }
                                echo $total;
                                ?>
                            </div>

                            <label for="inpu10" class="col-sm-2 col-form-label">{{ awtTrans('عدد المتدربات') }}</label>
                            <div class="col-sm-4">
                                <?php
                                $coures = $model->courses;
                                $total = 0;
                                foreach ($coures as $course) {
                                    $total += $course->applications()->where('wait_list', 'false')->where('gender', 'female')->count();
                                }
                                echo $total;
                                ?>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu9" class="col-sm-2 col-form-label">{{ awtTrans('ملاحظات أخرى') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->notes }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row d-print-none">
                            <div class="col-sm-6">
                                <a href="{{ route('courses.index', ['organization[]' => $model->id]) }}"
                                    class="btn btn-primary"><i class="icon-book-open"></i>
                                    {{ awtTrans(' قائمة الدورات') }}</a>
                                <a href="{{ route('applicants.index', ['organization' => $model->id]) }}"
                                    class="btn btn-primary"><i class="icon-people"></i>
                                    {{ awtTrans('قائمة المتدربين') }}</a>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a href="{{ route($route . '.edit', [$model->id]) }}" class="btn btn-primary"><i
                                        class="fa fa-file-text-o"></i> {{ awtTrans('تعديل') }}</a>
                                <button type="submit" name="submit" value="print" class="btn btn-primary"><i
                                        class="fa fa-print"></i> {{ awtTrans('طباعة') }} </button>
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

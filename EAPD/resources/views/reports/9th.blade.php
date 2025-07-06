@extends('layouts.master')

@section('content')
    <!--page title-->
    <div class="row">
        <div class="col-md-12">
            <div class="mb-4">
                <div class="page-title d-flex align-items-center p-3">
                    <div>
                        <h4 class="weight500 d-inline-block pr-3 mr-3 mb-0 border-right">{{ $title }}</h4>
                        <nav aria-label="breadcrumb" class="d-inline-block ">
                            <ol class="breadcrumb p-0">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('home') }}">{{ awtTrans('الصفحة الرئيسية') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('reports.index') }}">{{ awtTrans('التقارير') }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $title }} </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--/page title-->


    <!-- Conten of the page -->

    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="mb-4">

                <div class="card-body">

                    <form>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">{{ awtTrans('اختر الدورة') }}</label>
                            <div class="col-sm-4">
                                <select class="form-control selc_cour_name" name="course">
                                    <option></option>
                                    @foreach (\App\Models\Course::where('type_id', 'police')->get() as $course)
                                        <option value="{{ $course->id }}"
                                            {{ getRequest('course') == $course->id ? 'selected' : '' }}>
                                            {{ $course->name_ar }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ awtTrans('اختر لغه الطباعه') }}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{ awtTrans('عنوان التقرير') }}</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                name="rep_title" aria-describedby="emailHelp"
                                                placeholder="{{ awtTrans('عنوان التقرير') }}">
                                        </div>


                                        <label for="exampleInputEmail1">{{ awtTrans('لغه التقرير') }}</label>

                                        <div class="radio">
                                            <label><input type="radio" name="lang" value="ar"
                                                    checked>{{ awtTrans('Arabic') }}</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="lang"
                                                    value="en">{{ awtTrans('English') }}</label>
                                        </div>
                                        <div class="radio disabled">
                                            <label><input type="radio" name="lang"
                                                    value="fr">{{ awtTrans('French') }}</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ awtTrans('الغاء') }}</button>
                                        <button type="submit" name="print" value="true"
                                            class="btn btn-primary">{{ awtTrans('طباعه') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn btn-primary">{{ awtTrans('بحث') }}</button>
                                <button type="reset" class="btn btn-danger">{{ awtTrans('إلغاء') }}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
    <!-- end search -->
    <!-- begin table -->
    <div class="row">
        <div class="col-xl-12">
            <div class="mb-4">
                <div class="card-header border-0">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="" class="btn btn-primary float-right ml-1" data-toggle="modal"
                                data-target="#exampleModal"><i class="fa fa-print"></i> </a>
                        </div>
                    </div>
                </div>
                <div class="card-body- p-4">

                    @if (!empty($model))
                        <div class="row ">
                            <div class="col-12">
                                <div class="page-title">
                                    <h3 class="weight500 d-block pr-3">{{ awtTrans('بيانات الدورة ') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-5">
                            <div class="col-10">
                                <div class="form-group row">
                                    <label for="inpu1"
                                        class="col-sm-2 col-form-label">{{ awtTrans('اسم الدورة التدريبية') }}</label>
                                    <div class="col-sm-6">
                                        <p>{{ $model->name_ar }}</p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3"
                                        class="col-sm-2 col-form-label">{{ awtTrans('نوع الدورة') }}</label>
                                    <div class="col-sm-4">
                                        <p>{{ awtTrans($model->type_id) }}</p>
                                    </div>
                                    <label for="inpu11"
                                        class="col-sm-2 col-form-label">{{ awtTrans('طبيعة الدورة') }}</label>
                                    <div class="col-sm-4">
                                        <p>{{ $model->natural->name_ar }}</p>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="inpu111"
                                        class="col-sm-2 col-form-label">{{ awtTrans('مجال التعاون') }}</label>
                                    <div class="col-sm-4">
                                        <p>{{ $model->field->name_ar }}</p>
                                    </div>
                                    <label for="inpu10"
                                        class="col-sm-2 col-form-label">{{ awtTrans('اسم منسق الدورة') }}</label>
                                    <div class="col-sm-4">

                                        @foreach (unserialize($model->trainees) as $item)
                                            <?php $t = \App\Models\CourseTrianee::where('id', $item)->first(); ?>
                                            @if (!empty($t))
                                                <p><a href="">{{ $t->name_ar }}</a></p>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inpu5"
                                        class="col-sm-2 col-form-label">{{ awtTrans('المحتوى') }}</label>
                                    <div class="col-sm-4">
                                        {{ $model->content }}
                                    </div>
                                    <label for="inpu10"
                                        class="col-sm-2 col-form-label">{{ awtTrans('وثائق ذات صلة') }}</label>
                                    <div class="col-sm-4">
                                        @foreach (unserialize($model->documents) as $file)
                                            <a href="{{ asset('uploads/course/' . $file) }}" target="_blank"
                                                class="d-block"><i class="fa fa-file-pdf-o"></i>
                                                {{ awtTrans('تحميل الملف') }}</a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inpu5"
                                        class="col-sm-2 col-form-label">{{ awtTrans('تاريخ البدء') }}</label>
                                    <div class="col-sm-4">
                                        {{ $model->start_date }}
                                    </div>
                                    <label for="inpu15"
                                        class="col-sm-2 col-form-label">{{ awtTrans('تاريخ الإنتهاء') }}</label>
                                    <div class="col-sm-4">
                                        {{ $model->end_date }}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inpu10"
                                        class="col-sm-2 col-form-label">{{ awtTrans('مكان الإنعقاد') }}</label>
                                    <div class="col-sm-4">
                                        {{ $model->location }}
                                    </div>
                                    <label for="inpu10"
                                        class="col-sm-2 col-form-label">{{ awtTrans('الجهة المنظمة') }}</label>
                                    <div class="col-sm-4">
                                        <p>{{ $model->organization->name_ar }}</p>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="inpu9"
                                        class="col-sm-2 col-form-label">{{ awtTrans('الدول المشاركة') }}</label>
                                    <div class="col-sm-6">

                                        @foreach (unserialize($model->countries) as $item)
                                            <p>{{ getCountry($item) }}</p>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inpu10"
                                        class="col-sm-2 col-form-label">{{ awtTrans('إجمالي عدد المتدربين') }}</label>
                                    <div class="col-sm-4">
                                        {{ $model->applications->count() }}
                                    </div>

                                    <label for="inpu10"
                                        class="col-sm-2 col-form-label">{{ awtTrans('عدد المتدربات') }}</label>
                                    <div class="col-sm-4">
                                        {{ $model->applications()->where('gender', 'female')->count() }}

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inpu10"
                                        class="col-sm-2 col-form-label">{{ awtTrans('تكلفة الفرد') }}</label>
                                    <div class="col-sm-4">
                                        {{ $model->cost }}
                                    </div>
                                    <label for="inpu10"
                                        class="col-sm-2 col-form-label">{{ awtTrans('التكلفة الإجمالية') }}</label>
                                    <div class="col-sm-4">
                                        {{ $model->cost * $model->applications->count() }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inpu9"
                                        class="col-sm-2 col-form-label">{{ awtTrans('ملاحظات أخرى') }}</label>
                                    <div class="col-sm-6">
                                        <p>{{ $model->notes }}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr />
                        <div class="row ">
                            <div class="col-12">
                                <div class="page-title">
                                    <h3 class="weight500 d-block pr-3">{{ awtTrans('بيانات المشاركين في الدورة') }} </h3>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-5">
                            <div class="col-10">
                                <div class="table-responsive">
                                    <table class="table table-bordered" cellspacing="0">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>{{ awtTrans('الاسم') }}</th>
                                                <th>{{ awtTrans('النوع') }}</th>
                                                <th>{{ awtTrans('الدولة') }}</th>
                                                <th>{{ awtTrans('الوظيفة') }}</th>
                                                <th>{{ awtTrans('السن') }}</th>
                                                <th>{{ awtTrans('البريد الالكتروني') }}</th>
                                                <th>{{ awtTrans('الهاتف') }}</th>
                                                <th>{{ awtTrans('رقم جواز السفر') }}</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php($ii = 1)

                                            @foreach ($model->applications as $app)
                                                <tr>
                                                    <td>{{ $ii }}</td>
                                                    @php($ii++)
                                                    <td><a
                                                            href="{{ route('applicants.index', [$app->id]) }}">{{ $app->name() }}</a>
                                                    </td>
                                                    <td>{{ awtTrans($app->gender) }}</td>
                                                    <td>{{ getCountry($app->country) }}</td>
                                                    <td>{{ $app->current_employer }}</td>
                                                    <td>{{ \Carbon\Carbon::createFromTimeString($app->birth_date)->diff(\Carbon\Carbon::now())->format('%y') }}
                                                    </td>
                                                    <td>{{ $app->email_address }}</td>
                                                    <td>{{ serialize($app->phone_number)[0] }}</td>
                                                    <td>{{ $app->passport_id }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End Table -->


@endsection
@push('scripts')
    <script src="{{ asset('/assets/vendor/select2/js/select2.min.js') }}"></script>

    <script>
        // select country
        $(".selc_country").select2({
            placeholder: "{{ awtTrans('اختر الدول') }}"
        });
        $(".selc_cour_typ").select2({
            placeholder: "{{ awtTrans('اختر نوع الدورة') }}"
        });
        $(".selc_cour_train").select2({
            placeholder: "{{ awtTrans('اختر جهة التدريب') }}"
        });
    </script>
    <script>
        $(".selec_cours_typ").select2({
            placeholder: "{{ awtTrans('اختر نوع الدورة التدريبية') }}"
        });
        $(".selec_cours_typ2").select2({
            placeholder: "{{ awtTrans('اختر طبيعة الدورة التدريبية') }}"
        });
        $(".selec_cours_typ3").select2({
            placeholder: "{{ awtTrans('اختر مجال التعاون') }}"
        });
        $(".selc_cour_train").select2({
            placeholder: "{{ awtTrans('اختر الجهة المنطمة') }}"
        });
        $(".selc_cours_cord").select2({
            placeholder: "{{ awtTrans('اختر منسق الدورة') }}"
        });
    </script>
@endpush

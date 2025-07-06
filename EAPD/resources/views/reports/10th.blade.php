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
                            <label for="" class="col-sm-2 col-form-label">{{ awtTrans('الدولة') }}</label>
                            <div class="col-sm-4">
                                <select class="form-control selc_country" name="country">
                                    <option></option>
                                    @if (getRequest('country') == 'all' || getRequest('country') == null)
                                        <option value="all" selected>{{ awtTrans('كل الدول') }}</option>
                                    @endif
                                    @foreach (getCountries() as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ getRequest('country') == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">{{ awtTrans('نوع الدورة') }}</label>
                            <div class="col-sm-4">
                                <select class="form-control selc_cour_type" name="type">
                                    <option></option>

                                    <option value="citizan" {{ getRequest('type') == 'citizan' ? 'selected' : '' }}>
                                        {{ awtTrans('مدني') }}
                                    </option>
                                    <option value="police" {{ getRequest('type') == 'police' ? 'selected' : '' }}>
                                        {{ awtTrans('شرطة') }}
                                    </option>
                                    <option value="army" {{ getRequest('type') == 'army' ? 'selected' : '' }}>
                                        {{ awtTrans('جيش') }}
                                    </option>
                                </select>
                            </div>
                            <label for="" class="col-sm-2 col-form-label">{{ awtTrans('مجال الدورة') }}</label>
                            <div class="col-sm-4">
                                <select class="form-control selc_cour_field" name="field">
                                    <option></option>
                                    @foreach (\App\Models\CourseField::all() as $key)
                                        <option value="{{ $key->id }}"
                                            {{ getRequest('field') == $key->id ? 'selected' : '' }}>
                                            {{ $key->name_ar }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">

                            <label for="" class="col-sm-2 col-form-label">{{ awtTrans('التكلفة') }}</label>
                            <div class="col-sm-4">
                                <select class="form-control selc_rep_cost" name="cost">
                                    <option value="true" {{ getRequest('cost') == 'true' ? 'selected' : '' }}>

                                        {{ awtTrans('شامل التكلفة') }}
                                    </option>
                                    <option value="false" {{ getRequest('cost') == 'false' ? 'selected' : '' }}>
                                        {{ awtTrans('غير شامل التكلفة') }}
                                    </option>

                                </select>
                            </div>
                            <label for="" class="col-sm-2 col-form-label">{{ awtTrans('عرض المشاركين') }}</label>
                            <div class="col-sm-4">
                                <select class="form-control selc_rep_train" name="apps">
                                    <option></option>
                                    <option value="true">
                                        {{ awtTrans('عرض المشاركين') }}
                                    </option>
                                    <option value="false">
                                        {{ awtTrans('عدم عرض المشاركين') }}
                                    </option>


                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu115" class="col-sm-2 col-form-label">{{ awtTrans('التاريخ من') }}</label>
                            <div class="col-sm-4">
                                <input type="text" autocomplete="off" name="date_from"
                                    value="{{ getRequest('date_from') }}" class="form-control date-picker-input"
                                    id="inpu115" placeholder="التاريخ من">

                            </div>
                            <label for="inpu116" class="col-sm-2 col-form-label">{{ awtTrans('التاريخ إلى') }}</label>
                            <div class="col-sm-4">
                                <input type="text" autocomplete="off" name="date_to" value="{{ getRequest('date_to') }}"
                                    class="form-control date-picker-input" id="inpu116" placeholder="التاريخ إلى">
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


                    <div class="row ">
                        <div class="col-12">
                            <div class="page-title">
                                <h3 class="weight500 d-block pr-3"> {{ awtTrans('بيانات دورات الوكالة') }} </h3>
                            </div>
                        </div>
                    </div>


                    <div class="row justify-content-center mt-5">
                        <div class="col-10">
                            <div class="table-responsive">
                                <table class="table table-bordered " cellspacing="0" style="text-align: center;">
                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="6" style="text-align:center">
                                                {{ awtTrans('بيان بالدورات بالفترة') }}

                                                <?php
                                                if (getRequest('date_from') !== null) {
                                                    $date = getRequest('date_from');
                                                    $date = explode('-', $date);
                                                    echo awtTrans('من');
                                                
                                                    echo $date[0];
                                                }
                                                
                                                ?>

                                                {{ awtTrans('إلى') }}

                                                <?php
                                                if (getRequest('date_to') !== null) {
                                                    $date = getRequest('date_to');
                                                    $date = explode('-', $date);
                                                    echo $date[0];
                                                } else {
                                                    echo \Carbon\Carbon::now()->format('Y');
                                                }
                                                
                                                ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>{{ awtTrans('اسم الدورة') }}</th>
                                            <th>{{ awtTrans('تاريخ الدورة') }}</th>
                                            <th>{{ awtTrans('عدد المتدربين') }}</th>
                                            @if (getRequest('cost') != 'false')
                                                <th>{{ awtTrans('التكلفة الإجمالية') }}</th>
                                            @endif
                                        </tr>

                                    </thead>
                                    <tfoot class="thead-light">
                                        <tr>
                                            <th colspan="2">{{ awtTrans('عدد الدورات') }}</th>
                                            <td colspan="2">{{ $mainDetails['total'] }}</td>
                                        </tr>
                                        @if (getRequest('cost') != 'false')
                                            <tr>
                                                <th colspan="2">{{ awtTrans('عدد المتدربين') }}</th>
                                                <td colspan="2">{{ $mainDetails['total_apps'] }}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="2">{{ awtTrans('التكلفة الإجمالية') }}</th>
                                                <td colspan="2">{{ $costs['courses'] }}</td>
                                            </tr>
                                        @endif
                                        @if (getRequest('cost') == 'false')
                                            <tr>
                                                <th colspan="2">{{ awtTrans('عدد المتدربين') }}</th>
                                                <td colspan="2">{{ $mainDetails['total_apps'] }}</td>
                                            </tr>
                                        @endif
                                    </tfoot>
                                    <tbody>
                                        @foreach ($courses as $course)
                                            <tr>
                                                <td>{{ $course->name_ar }}</td>
                                                <td>{{ $course->start_date->format('d/m/Y') }}
                                                    - {{ $course->end_date->format('d/m/Y') }}</td>
                                                @if ($country == 'all')
                                                    <td>{{ $course->applications()->count() }}</td>
                                                    @if (getRequest('cost') != 'false')
                                                        <td>{{ $course->applications()->count() * $course->cost }}</td>
                                                    @endif
                                                @else
                                                    <td>{{ $course->applications()->where('nationality', $country)->count() }}
                                                    </td>
                                                    @if (getRequest('cost') != 'false')
                                                        <td>{{ $course->applications()->where('nationality', $country)->count() * $course->cost }}
                                                        </td>
                                                    @endif
                                                @endif



                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if (getRequest('apps') == 'true')
                        <hr />
                        <div class="row ">
                            <div class="col-12">
                                <div class="page-title">
                                    <h3 class="weight500 d-block pr-3">{{ awtTrans('بيانات المشاركين') }} </h3>
                                </div>
                            </div>
                        </div>
                        @foreach ($courses as $course)
                            <div class="row justify-content-center mt-5">
                                <div class="col-10">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" cellspacing="0">

                                            <thead class="thead-light">
                                                <tr>
                                                    <th colspan="6" style="text-align:center">{{ $course->name_ar }}
                                                    </th>
                                                    <th colspan="2" style="text-align:center">
                                                        {{ $course->start_date->format('d/m/Y') }}
                                                        - {{ $course->end_date->format('d/m/Y') }}</th>
                                                </tr>
                                                <tr>
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
                                            <tfoot class="thead-light">

                                                <tr>
                                                    <th colspan="2">{{ awtTrans('عدد المتدربين') }}</th>
                                                    <td colspan="2">{{ $mainDetails['total_apps'] }}</td>
                                                </tr>
                                                @if (getRequest('cost') != 'false')
                                                    <tr>
                                                        <th colspan="2">{{ awtTrans('التكلفة الإجمالية') }}</th>
                                                        <td colspan="2">{{ $costs['courses'] }}</td>
                                                    </tr>
                                                @endif

                                            </tfoot>
                                            <tbody>
                                                @if ($country = 'all')
                                                    @php($coursesApp = $course->applications()->get())
                                                @else
                                                    @php($coursesApp = $course->applications()->where('nationality', $country)->get())
                                                @endif
                                                @foreach ($coursesApp as $app)
                                                    <tr>
                                                        <td>
                                                            <a
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
                        @endforeach
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

@extends('layouts.master')

@section('content')
    <!--page title-->
    <div class="row">
        <div class="col-md-12">
            <div class="mb-4">
                <div class="page-title d-flex align-items-center p-3">
                    <div>
                        {{-- <h4 class="weight500 d-inline-block pr-3 mr-3 mb-0 border-right">{{$title}}</h4> --}}
                        <nav aria-label="breadcrumb" class="d-inline-block ">
                            <ol class="breadcrumb p-0">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('home') }}">{{ awtTrans('الصفحة الرئيسية') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('reports.index') }}">{{ awtTrans('التقارير') }}</a>
                                </li>
                                {{-- <li class="breadcrumb-item active" aria-current="page">{{$title}} </li> --}}
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

                    <form action="{{ route('reports.render', [1]) }}">
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">{{ awtTrans('الدولة') }}</label>
                            <div class="col-sm-4">
                                <select class="form-control selc_country" name="country" required>
                                    <option></option>
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
                                        <label for="exampleInputEmail1">{{ awtTrans('اختر خانات الطباعه') }}</label>

                                        <ul style="list-style:none;">
                                            <li><input type="checkbox" id="aids" name="print_choices[aids]"
                                                    value="aids">
                                                <label for="aids">
                                                    {{ awtTrans('المنح والمعونات المقدمة ') }}</label>
                                            </li>
                                            <li><input type="checkbox" id="participants_data"
                                                    name="print_choices[participants_data]" value="participants_data">
                                                <label for="participants_data">
                                                    {{ awtTrans('بيانات المشاركه بدورات الوكالة') }}</label>
                                            </li>
                                            <li><input type="checkbox" id="expert" name="print_choices[expert]"
                                                    value="expert">
                                                <label for="expert"> {{ awtTrans('الخبراء') }}</label>
                                            </li>
                                            <li><input type="checkbox" id="scholarships" name="print_choices[scholarships]"
                                                    value="scholarships">
                                                <label for="scholarships"> {{ awtTrans('المنح الدراسية') }}</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" id="cost" name="print_choices[cost]"
                                                    value="cost">
                                                <label for="cost">
                                                    {{ awtTrans('التكلفة التقديرية لقيمة الدعم المقدم') }}</label>
                                            </li>
                                        </ul>

                                        <label> {{ awtTrans('الدورات التدريبية') }}</label>
                                        <ul style="list-style:none;">
                                            <li><input type="checkbox" id="course_start" name="print_choices[course_start]"
                                                    value="course_start">
                                                <label for="course_start">
                                                    {{ awtTrans('تاريخ البدء') }}</label>
                                            </li>
                                            <li><input type="checkbox" id="course_end" name="print_choices[course_end]"
                                                    value="course_end">
                                                <label for="course_end">
                                                    {{ awtTrans('تاريخ الإنتهاء') }}</label>
                                            </li>
                                        </ul>





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

                            <!-- Modal -->
                        </div>
                    </div>
                </div>
                <div class="card-body- p-4">
                    <div class="row ">
                        <div class="col-12">
                            <div class="page-title">
                                <h3 class="text-center">{{ awtTrans('الدوله') }} {{ getCountry(getRequest('country')) }}
                                </h3>


                                <h3 class="weight500 d-block pr-3 mb-5">{{ awtTrans('المنح والمعونات المقدمة ') }}</h3>
                                @if (isset($_GET['date_from']) && $_GET['date_from'] != null && (isset($_GET['date_to']) && $_GET['date_to'] != null))
                                    <h4 class="text-center weight500">
                                        {{ awtTrans('(في الفترة الزمنية') }}


                                        {{ awtTrans('من') }}
                                        {{ $_GET['date_from'] }}

                                        {{ awtTrans('إلى ') }}
                                        {{ $_GET['date_to'] }}
                                        )
                                    </h4>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-10 ">
                            <div class="table-responsive">
                                <table class="table table-bordered " cellspacing="0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ awtTrans('الدولة') }}</th>
                                            <th>{{ awtTrans('النوع') }}</th>
                                            <th>{{ awtTrans('تاريخ الشحن') }}</th>
                                            <th>{{ awtTrans('قيمة المعونة') }}</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="thead-light">
                                        <tr>
                                            <th colspan="2">{{ awtTrans('الإجمالى') }}</th>
                                            {{-- <td colspan="3">{{$costs['aids']}} {{awtTrans('جنيه مصرى')}}</td> --}}
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @if (count($aids) == 0)
                                            <td>#</td>
                                            <td>#</td>
                                            <td>#</td>
                                            <td>#</td>
                                            <td>#</td>
                                        @endif
                                        @foreach ($aids as $aid)
                                            <tr>
                                                <td>{{ $aid->id }}</td>
                                                <td>{{ getCountry(getRequest('country')) }}</td>
                                                <td><a
                                                        href="{{ route('aids.show', [$aid->id]) }}">{{ $aid->type->name_ar }}</a>
                                                </td>
                                                <td>{{ $aid->ship_date->format('Y/m/d') }}</td>
                                                <td>{{ $aid->cost }} {{ awtTrans('جنيه') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="row ">
                        <div class="col-12">
                            <div class="page-title">
                                <h3 class="weight500 d-block pr-3"> {{ awtTrans('بيانات المشاركه بدورات الوكالة') }} </h3>
                            </div>
                        </div>
                    </div>

                    @if (isset($_GET['country']))
                        <table class="table table-bordered " cellspacing="0" style="text-align: center;">
                            <thead class="thead-light">
                                @if (getRequest('country') !== null)
                                    <tr>
                                        <th colspan="5" style="text-align:center"> {{ awtTrans('الدوله') }}
                                            {{ getCountry(getRequest('country')) }}</th>
                                    </tr>
                                @endif
                                <tr>
                                    <th>{{ awtTrans('اجمالى عدد الدورات') }}</th>
                                    <td>{{ count($courses) }}</td>
                                    <th>{{ awtTrans('إجمالى عدد المتدربين') }}</th>
                                    <td colspan="2">{{ $mainDetails['total_apps'] }}</td>
                                </tr>
                                <tr>
                                    <th>{{ awtTrans('عدد الدورات النوعية') }}</th>
                                    <td>{{ $mainDetails['total_city'] }}</td>
                                    <th>{{ awtTrans('عدد دورات الجيش والشرطة') }}</th>
                                    <td colspan="2">{{ $mainDetails['total_army'] + $mainDetails['total_police'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ awtTrans('رقم الدورة') }}</th>
                                    <th>{{ awtTrans('الدورة التدريبية') }}</th>
                                    <th>{{ awtTrans('تاريخ البدء') }}</th>
                                    <th>{{ awtTrans('تاريخ الإنتهاء') }}</th>
                                    <th>{{ awtTrans('جهة التدريب') }}</th>
                                    <th>{{ awtTrans('عدد المتدربين') }}</th>
                                    <th>{{ awtTrans('المتدربات النساء') }}</th>
                                </tr>
                            </thead>
                            <tfoot class="thead-light">
                                <tr>
                                    <th>{{ awtTrans('الدورات') }}</th>
                                    <th colspan="2">{{ awtTrans('دورات نوعية') }}</th>
                                    <th colspan="2">{{ awtTrans('دورات جيش وشرطة') }}</th>
                                </tr>

                                <tr>
                                    <th>{{ awtTrans('التكلفة') }}</th>
                                    <td colspan="2">{{ $coursesDetails['city_cost'] }}</td>
                                    <td colspan="2">{{ $coursesDetails['other_cost'] }}</td>
                                </tr>
                                <tr>
                                    <th colspan="2">{{ awtTrans('التكلفة الإجمالية') }}</th>
                                    <td colspan="3">{{ $coursesDetails['other_cost'] + $coursesDetails['city_cost'] }}
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody>
                                @php($ii = 1)
                                @foreach ($courses as $course)
                                    <tr>
                                        <td>{{ $ii }}</td>
                                        <td><a
                                                href="{{ route('courses.show', [$course->id]) }}">{{ $course->name_ar }}</a>
                                        </td>
                                        <td>{{ $course->start_date->format('Y-m-d') }}</td>
                                        <td>{{ $course->end_date->format('Y-m-d') }}</td>
                                        <td>{{ $course->organization->name }}</td>
                                        <td>{{ $course->applications()->where('nationality', 'LIKE', '%' . $country . '%')->count() }}
                                        </td>
                                        <td>{{ $course->applications()->where('nationality', 'LIKE', '%' . $country . '%')->where('gender', 'female')->count() }}
                                        </td>
                                    </tr>
                                    @php($ii++)
                                @endforeach

                            </tbody>
                        </table>
                    @endif
                    <hr />
                    <div class="row ">
                        <div class="col-12">
                            <div class="page-title">
                                <h3 class="weight500 d-block pr-3"> {{ awtTrans('الخبراء') }} </h3>
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
                                            <th>{{ awtTrans('التخصص') }}</th>
                                            <th>{{ awtTrans('الجهه الموفد اليها') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($ex = 1)
                                        @foreach ($experts as $row)
                                            <tr>
                                                <td>{{ $ex }}</td>
                                                @php($ex++)

                                                <td><a
                                                        href="{{ route('experts.show', [$row->id]) }}">{{ $row->name }}</a>
                                                </td>
                                                <td>{{ $row->specialist }}</td>
                                                <td>{{ $row->delegate_org }}</td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <hr />
                    <div class="row ">
                        <div class="col-12">
                            <div class="page-title">
                                <h3 class="weight500 d-block pr-3"> {{ awtTrans('المنح الدراسية') }} </h3>
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
                                            <th>{{ awtTrans('البرنامج / المنحة') }}</th>
                                            <th>{{ awtTrans('الجهة') }}</th>
                                            <th>{{ awtTrans('الدول المشاركة') }}</th>
                                            <th>{{ awtTrans('مجال الدراسة') }}</th>
                                            <th>{{ awtTrans('عدد الدراسين') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($s = 1)
                                        @foreach ($scholarships as $scholarship)
                                            <tr>
                                                <td>{{ $s }}</td>
                                                @php($s++)

                                                <td><a
                                                        href="{{ route('scholarships.show', $scholarship->id) }}">{{ $scholarship->program }}</a>
                                                </td>
                                                <td>{{ $scholarship->owner }}</td>
                                                <td>
                                                    @foreach (unserialize($scholarship->participants) as $row)
                                                        {{ getCountry($row) }}<br />
                                                    @endforeach
                                                </td>

                                                <td>{{ $scholarship->field->name_ar }}</td>
                                                <td>{{ $scholarship->learners->count() }}</td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr />

                    <div class="row ">
                        <div class="col-12">
                            <div class="page-title">
                                <h3 class="weight500 d-block pr-3">{{ awtTrans('التكلفة التقديرية لقيمة الدعم المقدم') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-5">
                        <div class="col-10">
                            <div class="table-responsive">
                                <table class="table table-bordered" cellspacing="0">

                                    <tbody class="thead-light">
                                        <tr>
                                            <th colspan="2">{{ awtTrans('المنح والمعونات') }}</th>
                                            <td colspan="2">{{ $costs['aids'] }} {{ awtTrans('جنيه مصري ') }}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">{{ awtTrans('الدورات التدريبية') }}</th>
                                            @if ($costs['courses'] == 0)
                                                <td colspan="2">{{ $costs['applicants'] }}
                                                    {{ awtTrans('جنيه مصري ') }}
                                                </td>
                                            @else
                                                <td colspan="2">{{ $costs['courses'] }} {{ awtTrans('جنيه مصري ') }}
                                                </td>
                                            @endif
                                        </tr>

                                        <tr>
                                            <th colspan="2">{{ awtTrans('الخبراء') }}</th>
                                            <td colspan="2">{{ $costs['experts'] }} {{ awtTrans('جنيه مصري ') }}
                                            </td>
                                        </tr>


                                        <tr>
                                            <th colspan="2">{{ awtTrans('التكلفة الإجمالية') }}</th>
                                            @if ($costs['courses'] == 0)
                                                <td colspan="2">{{ $costs['total'] }} {{ awtTrans('جنيه مصري ') }}
                                                </td>
                                            @else
                                                <td colspan="2">{{ $costs['total'] - $costs['applicants'] }}
                                                    {{ awtTrans('جنيه مصري ') }}</td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


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

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
                                    id="inpu115" placeholder="التاريخ من" required>

                            </div>
                            <label for="inpu116" class="col-sm-2 col-form-label">{{ awtTrans('التاريخ إلى') }}</label>
                            <div class="col-sm-4">
                                <input type="text" autocomplete="off" name="date_to" value="{{ getRequest('date_to') }}"
                                    class="form-control date-picker-input" id="inpu116" placeholder="التاريخ إلى"
                                    required>
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
                                {{-- <h3 class="weight500 d-block pr-3">1- {{awtTrans('بيانات المشاركة بدورات الوكالة')}} </h3> --}}
                            </div>
                        </div>
                    </div>


                    @php($t = 0)
                    <?php
                    $firstDate = getRequest('date_from');
                    $lastDate = getRequest('date_to');
                    
                    ?>

                    <article size="A4" class="section">
                        <div class="PDFcontent">


                            <div class="table-content">
                                @if ($t == 0)
                                    <div class="page-title">
                                        <h3 class="text-center weight500">{{ getCountry($country) }}</h3>
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
                                        <h3 class="weight500 d-block pr-3 mb-5">
                                            {{ awtTrans('بيانات المشاركة بدورات الوكالة') }}</h3>
                                    </div>
                                    @php($t = 1)
                                @endif
                            </div>
                            <div class="data-table">

                                <table class="table table-bordered " cellspacing="0" style="text-align: center;">
                                    <thead class="thead-light">

                                        <tr>
                                            <th>{{ awtTrans('رقم الدورة') }}</th>
                                            <th>{{ awtTrans('الدورة التدريبية') }}</th>
                                            <th>{{ awtTrans('جهة التدريب') }}</th>
                                            <th>{{ awtTrans('عدد المتدربين') }}</th>
                                            <th>{{ awtTrans('المتدربات النساء') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php($ii = 1)

                                        @foreach ($courses as $course)
                                            <tr>
                                                <td>{{ $ii }}</td>
                                                @php($ii++)

                                                <td>
                                                    <a
                                                        href="{{ route('courses.show', [$course->id]) }}">{{ $course->name_ar }}</a>
                                                </td>
                                                <td>{{ $course->organization->name }}</td>
                                                <td>{{ $course->applications()->where('country', 'LIKE', '%' . $country . '%')->count() }}
                                                </td>
                                                <td>{{ $course->applications()->where('country', 'LIKE', '%' . $country . '%')->where('gender', 'female')->count() }}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </article>
                    {{-- @endforeach --}}

                    <hr />
                    <div class="row ">
                        <div class="col-12">
                            <div class="page-title">
                                <h3 class="weight500 d-block pr-3">{{ awtTrans('الإجمالى') }} </h3>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-5">
                        <div class="col-10">
                            <div class="table-responsive">
                                <table class="table table-bordered" cellspacing="0">

                                    <tbody class="thead-light">
                                        <tr>
                                            <th>{{ awtTrans('اجمالى عدد الدورات') }}</th>
                                            <td>{{ $mainDetails['total'] }}</td>
                                            <th>{{ awtTrans('عدد الدورات المدنية') }}</th>
                                            <td>{{ $mainDetails['total_city'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ awtTrans('عدد الدورات الجيش') }}</th>
                                            <td>{{ $mainDetails['total_army'] }}</td>
                                            <th>{{ awtTrans('عدد دورات الشرطة') }}</th>
                                            <td>{{ $mainDetails['total_police'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ awtTrans('إجمالى عدد المتدربين') }}</th>
                                            <td>{{ $mainDetails['total_apps'] }}</td>
                                            <th>{{ awtTrans('إجمالى عدد المتدربات') }}</th>
                                            <td>{{ $mainDetails['total_fapps'] }}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">{{ awtTrans('التكلفة الإجمالية') }}</th>
                                            <td colspan="2">{{ $mainDetails['total_cost'] }}
                                                {{ awtTrans('جنيه مصري') }}
                                            </td>
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

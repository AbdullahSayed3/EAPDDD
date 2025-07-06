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

                                        @if (getRequest('cost') != null)
                                            <input type="hidden" name="cost" value="1">
                                        @endif

                                        <label for="exampleInputEmail1">{{ awtTrans('لغه التقرير') }}</label>

                                        <div class="radio">
                                            <label><input type="radio" name="lang" value="ar"
                                                    checked>{{ awtTrans('Arabic') }}
                                            </label>
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
                    <hr />
                    <div class="row ">
                        <div class="col-12">
                            <div class="page-title">
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
                                {{-- <h3 class="weight500 d-block pr-3">2- {{awtTrans("أعمال الوكالة سنويا")}} </h3> --}}
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center mt-5">
                        <div class="col-10 ">
                            <div class="table-responsive">
                                <table class="table table-bordered" cellspacing="0">
                                    <thead class="thead-light">

                                        <tr>

                                            <th>{{ awtTrans('عدد الدورات التدريبية') }}</th>
                                            <td>{{ isset($mainData['total_courses']) ? $mainData['total_courses'] : 0 }}
                                            </td>
                                            <th>{{ awtTrans('عدد الدورات المدنية') }}</th>
                                            <td>{{ isset($mainData['total_citizen']) ? $mainData['total_citizen'] : 0 }}
                                            </td>

                                        </tr>

                                        <tr>
                                            <th>{{ awtTrans('عدد دورات الجيش') }}</th>
                                            <td>{{ isset($mainData['total_army']) ? $mainData['total_army'] : 0 }}
                                            </td>

                                            <th>{{ awtTrans('عدد دورات الشرطة') }}</th>
                                            <td>{{ isset($mainData['total_police']) ? $mainData['total_police'] : 0 }}
                                            </td>

                                        </tr>
                                        <tr>
                                            <th>{{ awtTrans('عدد المتدربين') }}</th>
                                            <td>{{ isset($mainData['total_apps']) ? $mainData['total_apps'] : 0 }}
                                            </td>

                                            <th>{{ awtTrans('عدد المتدربات') }}</th>
                                            <td>{{ isset($mainData['total_female']) ? $mainData['total_female'] : 0 }}
                                            </td>

                                        </tr>
                                        <tr>
                                            <th>{{ awtTrans('عدد المنح والمعونات') }}</th>
                                            <td>{{ isset($mainData['total_aids']) ? $mainData['total_aids'] : 0 }}
                                            </td>

                                            <th>{{ awtTrans('عدد الخبراء') }}</th>
                                            <td>{{ isset($mainData['total_experts']) ? $mainData['total_experts'] : 0 }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ awtTrans('عدد المنح الدراسية') }}</th>
                                            <td>{{ $mainData['total_scholarships'] }}</td>
                                            <th>{{ awtTrans('عدد الدول المستفيدة') }}</th>
                                            <td>{{ count(array_unique($countries)) }}</td>
                                        </tr>

                                        @if (getRequest('cost') != null)
                                            <tr style="height: 50px; border: none">
                                                <th style="border: unset" colspan="2"></th>
                                                <th style="border: unset" colspan="2"></th>
                                            </tr>
                                            <tr>
                                                <th colspan="2">{{ awtTrans('التكلفة الإجمالية للدورات التدريبية') }}
                                                </th>

                                                <td colspan="2">
                                                    {{ isset($mainData['total_cost_courses_year']) ? $mainData['total_cost_courses_year'] : 0 }}
                                                    {{ awtTrans('جنيه مصرى') }}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="2">{{ awtTrans('التكلفة الإجمالية للمنح والمعونات') }}
                                                </th>

                                                <td colspan="2">
                                                    {{ isset($mainData['total_cost_aids_year']) ? $mainData['total_cost_aids_year'] : 0 }}
                                                    {{ awtTrans('جنيه مصرى') }}</td>

                                            </tr>

                                            <tr>
                                                <th colspan="2">{{ awtTrans('التكلفة الإجمالية للخبراء') }}</th>
                                                <td colspan="2">
                                                    {{ isset($mainData['total_cost_experts_year']) ? $mainData['total_cost_experts_year'] : 0 }}
                                                    {{ awtTrans('جنيه مصرى') }}</td>

                                            </tr>
                                            <tr>
                                                <th colspan="2">{{ awtTrans('التكلفة الإجمالية للمنح الدراسية') }}</th>
                                                <td colspan="2">{{ $mainData['total_sc_cost'] }}
                                                    {{ awtTrans('جنيه مصرى') }}</td>
                                            </tr>
                                        @endif
                                    </thead>

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

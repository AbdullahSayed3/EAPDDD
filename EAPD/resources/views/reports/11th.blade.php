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
                            <label for=""
                                class="col-sm-2 col-form-label">{{ awtTrans('الدولة الموفد إليها') }}</label>
                            <div class="col-sm-4">
                                <select class="form-control selc_country" name="dcountry">
                                    <option></option>
                                    @foreach (getCountries() as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ getRequest('dcountry') == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <label for="" class="col-sm-2 col-form-label">{{ awtTrans('التكلفة') }}</label>
                            <div class="col-sm-4">
                                <select class="form-control selc_rep_cost" name="cost">
                                    <option value="true">
                                        {{ awtTrans('شامل التكلفة') }}
                                    </option>
                                    <option value="false">
                                        {{ awtTrans(' غير شامل التكلفة') }}
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

                        <div class="form-group row">
                            <label for="inpu13" class="col-sm-2 col-form-label">{{ awtTrans('حالة الخبير') }}</label>
                            <div class="col-sm-4">
                                <select class="form-control selec_stat_exp" name="status"
                                    placeholder="{{ awtTrans('حالة الخبير') }}" multiple="multiple">
                                    <option value="current" {{ getRequest('status') == 'current' ? 'selected' : '' }}>
                                        {{ awtTrans('خبير حالي') }}
                                    </option>
                                    <option value="old" {{ getRequest('status') == 'old' ? 'selected' : '' }}>
                                        {{ awtTrans('خبير سابق') }}
                                    </option>
                                    <option value="candidate" {{ getRequest('status') == 'candidate' ? 'selected' : '' }}>
                                        {{ awtTrans('مرشح للعمل') }}
                                    </option>

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

                                        <label> {{ awtTrans('الدورات التدريبية') }}</label>
                                        <ul style="list-style:none;">
                                            <li><input type="checkbox" id="delegate_country"
                                                    name="print_choices[delegate_country]" value="delegate_country">
                                                <label for="delegate_country">
                                                    {{ awtTrans('الدولة') }}</label>
                                            </li>
                                            <li><input type="checkbox" id="name" name="print_choices[name]"
                                                    value="name">
                                                <label for="name">
                                                    {{ awtTrans('الاسم') }}</label>
                                            </li>
                                            <li><input type="checkbox" id="specialist" name="print_choices[specialist]"
                                                    value="specialist">
                                                <label for="specialist">
                                                    {{ awtTrans('التخصص') }}</label>
                                            </li>


                                            <li><input type="checkbox" id="status" name="print_choices[status]"
                                                    value="status">
                                                <label for="status">
                                                    {{ awtTrans('حالة الخبير') }}</label>


                                            <li><input type="checkbox" id="contract_date"
                                                    name="print_choices[contract_date]" value="contract_date">
                                                <label for="contract_date">
                                                    {{ awtTrans('بداية التعاقد') }}</label>



                                            </li>
                                            <li><input type="checkbox" id="end_date" name="print_choices[end_date]"
                                                    value="end_date">
                                                <label for="end_date">
                                                    {{ awtTrans('نهاية التعاقد') }}</label>
                                            </li>
                                            <li><input type="checkbox" id="passport_number"
                                                    name="print_choices[passport_number]" value="passport_number">
                                                <label for="passport_number">
                                                    {{ awtTrans('رقم جواز السفر') }}</label>
                                            </li>
                                            <li><input type="checkbox" id="delegate_org"
                                                    name="print_choices[delegate_org]" value="delegate_org">
                                                <label for="delegate_org">
                                                    {{ awtTrans('الجهه الموفد اليها') }}</label>
                                            </li>
                                            <li><input type="checkbox" id="cost" name="print_choices[cost]"
                                                    value="cost">
                                                <label for="cost">
                                                    {{ awtTrans('التكلفة السنوية') }}</label>
                                            </li>

                                            <li><input type="checkbox" id="count" name="print_choices[count]"
                                                    value="count">
                                                <label for="count">
                                                    {{ awtTrans(' العدد الإجمالي') }}</label>
                                            </li>
                                            <li><input type="checkbox" id="total_cost" name="print_choices[total_cost]"
                                                    value="total_cost">
                                                <label for="total_cost">
                                                    {{ awtTrans(' التكلفة الإجمالية') }}</label>
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
                                <a href="{{ url()->current() }}" class="btn btn-danger">{{ awtTrans('إلغاء') }}</a>
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
                                <h3 class="text-center weight500">{{ getCountry($dcountry) }}</h3>

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
                                {{-- <h3 class="weight500 d-block pr-3">1-{{awtTrans('بيانات الخبراء')}}</h3> --}}
                            </div>
                        </div>
                    </div>



                    <div class="row justify-content-center mt-5">
                        <div class="col-10">
                            <div class="table-responsive">
                                <table class="table table-bordered " cellspacing="0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ awtTrans('الدولة') }}</th>
                                            <th>{{ awtTrans('الاسم') }}</th>
                                            <th>{{ awtTrans('التخصص') }}</th>
                                            <th>{{ awtTrans('حالة الخبير') }}</th>
                                            <th>{{ awtTrans('بداية التعاقد') }}</th>
                                            <th>{{ awtTrans('نهاية التعاقد') }}</th>
                                            <th>{{ awtTrans('رقم جواز السفر') }}</th>
                                            <th>{{ awtTrans('الجهه الموفد اليها') }}</th>
                                            @if (getRequest('cost') != 'false')
                                                <th>{{ awtTrans('التكلفة السنوية') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tfoot class="thead-light">
                                        <tr>
                                            <th colspan="3">{{ awtTrans(' العدد الإجمالي') }}</th>
                                            <td colspan="6">{{ count($experts) }}</td>
                                        </tr>
                                        @if (getRequest('cost') != 'false')
                                            <tr>
                                                <th colspan="3">{{ awtTrans(' التكلفة الإجمالية') }}</th>
                                                <td colspan="6">{{ $costs['experts'] }} {{ awtTrans('جنيه مصرى') }}
                                                </td>
                                            </tr>
                                        @endif
                                    </tfoot>
                                    <tbody>
                                        @php($ii = 1)

                                        @foreach ($experts as $row)
                                            <tr>
                                                <td>{{ $ii }}</td>
                                                @php($ii++)
                                                <td>{{ getCountry($row->delegate_country) }}</td>
                                                <td><a
                                                        href="{{ route('experts.show', [$row->id]) }}">{{ $row->name }}</a>
                                                </td>
                                                <td>{{ $row->specialist }}</td>
                                                @if ($row->status == 'current')
                                                    <td>{{ awtTrans('خبير حالي') }}</td>
                                                @elseif($row->status == 'old')
                                                    <td>{{ awtTrans('خبير سابق') }}</td>
                                                @else
                                                    <td>{{ awtTrans('مرشح للعمل') }}</td>
                                                @endif
                                                <td>{{ is_null($row->contract_date) ? '#' : $row->contract_date->format('d/m/Y') }}
                                                </td>
                                                <td>{{ is_null($row->end_date) ? '#' : $row->end_date->format('d/m/Y') }}
                                                </td>
                                                <td>{{ $row->passport_number }}</td>
                                                <td>{{ $row->delegate_org }}</td>
                                                @if (getRequest('cost') != 'false')
                                                    <td>{{ $row->cost }} {{ awtTrans('جنيه مصرى') }}</td>
                                                @endif
                                            </tr>
                                        @endforeach

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
        $(".selec_stat_exp").select2({
            placeholder: "{{ awtTrans('حالة الخبير') }}"
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

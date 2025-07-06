@extends('layouts.master')

@section('content')
    <!--page title-->
    <div class="row">
        <div class="col-md-12">
            <div class="mb-4">
                <div class="page-title d-flex align-items-center p-3">
                    <div>
                        <h4 class="weight500 d-inline-block pr-3 mr-3 mb-0 border-right">{{ awtTrans('المنح والمعونات') }}
                        </h4>
                        <nav aria-label="breadcrumb" class="d-inline-block ">
                            <ol class="breadcrumb p-0">
                                <li class="breadcrumb-item"><a href="index.html">الصفحة الرئيسية</a></li>
                                <li class="breadcrumb-item"><a href="courses-main.html">الدورات التدريبية</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> {{request()->routeIs('trial_terals_fields.create') ? 'إضافة دورة تدريبية' : 'تعديل دورة تدريبية'}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="mb-4">

                <div class="card-body">

                    @include('flash::message')
                    <form action="{{ route($route . '.store') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        <div class="form-group row country-item">
                            <span class="country-item-num" data-number="1"></span>
                            <label for="inputPassword3"
                                class="col-sm-2 col-form-label">{{ awtTrans('الدولة المستفيدة') }}</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="country[0][id]">
                                    <option value="0">
                                        {{ awtTrans('لا يوجد') }}
                                    </option>
                                    @foreach (getCountries() as $key => $value)
                                        <option value="{{ $key }}">
                                            {{ $value }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                            <label for="inpu61" class="col-sm-2 col-form-label">الجهة</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control " id="inpu61" placeholder="الجهة"
                                    name="country[0][org]">
                            </div>
                        </div>
                        <div id="new-div-country-item"></div>

                        <div class="form-group row">
                            <div class="col-sm-12 text-center">
                                <div type="button" class="btn btn-primary item-add" data-item-class="country-item"
                                    data-input-name="country">إضافة
                                </div>
                                <button type="button" class="btn btn-danger item-remove" data-item-class="country-item">
                                    حذف
                                </button>
                            </div>
                        </div>
                        <hr />

                        <div class="form-group row">
                            <label for="inpu11" class="col-sm-2 col-form-label">{{ awtTrans('اسم الاتفاق') }}</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="inpu11" name="name"
                                    placeholder="{{ awtTrans('اسم الاتفاق') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu110" class="col-sm-2 col-form-label">{{ awtTrans('ملفات الاتفاق') }}</label>
                            <div class="col-sm-6">
                                <input type="file" class="form-control" id="inpu110" multiple required
                                    name="contract_files[]" placeholder="{{ awtTrans('ملفات الاتفاق') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu91" class="col-sm-2 col-form-label">{{ awtTrans('مجالات التعاون') }}</label>
                            <div class="col-sm-6">
                                <select class="form-control selec_coop" name="contract_field[]" required
                                    multiple="multiple">
                                    <option></option>
                                    @foreach (\App\Models\TrialTeralField::all() as $field)
                                        <option value="{{ $field->id }}">
                                            {{ $field->name_ar }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu111" class="col-sm-2 col-form-label">{{ awtTrans('التكلفة الكلية') }}</label>
                            <div class="col-sm-6">
                                <input type="number" min="1" class="form-control" id="inpu111" required
                                    name="cost" placeholder="{{ awtTrans('التكلفة الكلية') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu112"
                                class="col-sm-2 col-form-label">{{ awtTrans('تكلفة مساهمة الوكالة') }}</label>
                            <div class="col-sm-6">
                                <input type="number" min="1" class="form-control" id="inpu112" name="agency_cost"
                                    placeholder="{{ awtTrans('تكلفة مساهمة الوكالة') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu9" class="col-sm-2 col-form-label">{{ awtTrans('التفاصيل') }}</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" id="inpu9" rows="6" required name="details"
                                    placeholder="{{ awtTrans('التفاصيل') }}"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu10"
                                class="col-sm-2 col-form-label">{{ awtTrans('تاريخ بدء الاتفاق') }}</label>
                            <div class="col-sm-6">
                                <input type="text" name="start_date" required autocomplete="off"
                                    class="form-control date-picker-input" id="inpu10"
                                    placeholder="{{ awtTrans('تاريخ بدء الاتفاق') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu13" class="col-sm-2 col-form-label">{{ awtTrans('الحالة') }}</label>
                            <div class="col-sm-6">
                                <select class="form-control selc_stats" required name="param">
                                    <option></option>
                                    <option value="active">
                                        {{ awtTrans('ساري') }}
                                    </option>
                                    <option value="disabled">
                                        {{ awtTrans('غير ساري') }}
                                    </option>
                                    <option value="holding">
                                        {{ awtTrans('معلق') }}
                                    </option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu11" class="col-sm-2 col-form-label">
                                {{ awtTrans('رقم موافقة الوزير أو مجلس الإدارة') }}
                            </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="inpu11" name="acceptation_number"
                                    required placeholder=" {{ awtTrans('رقم موافقة الوزير أو مجلس الإدارة') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu9" class="col-sm-2 col-form-label"> {{ awtTrans('ملاحظات أخرى') }}</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="notes" id="inpu9" rows="6"
                                    placeholder=" {{ awtTrans('ملاحظات أخرى') }}"></textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn btn-primary"> {{ awtTrans('إضافة') }}</button>
                                <button type="reset" class="btn btn-danger">{{ awtTrans('إلغاء') }}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <!--init select2-->
    <script>
        // select country
        $(".selc_country").select2({
            placeholder: "اختر دولة"
        });
        $(".selc_stats").select2({
            placeholder: "اختر حالة الاتفاق"
        });
        $(".selec_coop").select2({
            placeholder: "اختر مجالات التعاون"
        });
    </script>
@endpush

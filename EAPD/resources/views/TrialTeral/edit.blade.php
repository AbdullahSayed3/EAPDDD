@extends('layouts.master')

@section('content')
    <!--page title-->
    <div class="row">
        <div class="col-md-12">
            <div class="mb-4">
                <div class="page-title d-flex align-items-center p-3">
                    <div>
                        <h4 class="weight500 d-inline-block pr-3 mr-3 mb-0 border-right">{{ $model->name }}</h4>
                        <nav aria-label="breadcrumb" class="d-inline-block ">
                            <ol class="breadcrumb p-0">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('home') }}">{{ awtTrans('الصفحة الرئيسية') }}</a></li>
                                <li class="breadcrumb-item " aria-current="page"><a
                                        href="{{ route($route . '.index') }}">{{ awtTrans('التعاون الثلاثي') }}</a></li>
                                <li class="breadcrumb-item " aria-current="page"><a
                                        href="{{ route($route . '.show', ['id' => $model->id]) }}">{{ $model->name }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ awtTrans('تعديل الاتفاقيه') }}
                                </li>
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
                    <form action="{{ route($route . '.update', ['id' => $model->id]) }}" method="post"
                        enctype="multipart/form-data">

                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}

                        @php($v = 0)
                        @foreach ($model->beneficiary_countries as $row)
                            <div class="form-group row country-item">
                                <span class="country-item-num" data-number="{{ $v + 1 }}"></span>
                                <label for="inputPassword3"
                                    class="col-sm-2 col-form-label">{{ awtTrans('الدولة المستفيدة') }}</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="country[{{ $v }}][id]">
                                        <option value="0">
                                            {{ awtTrans('لا يوجد') }}
                                        </option>
                                        @foreach (getCountries() as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ $row['id'] == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                <label for="inpu61" class="col-sm-2 col-form-label">الجهة</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control " value="{{ $row['org'] }}" id="inpu61"
                                        placeholder="الجهة" name="country[{{ $v }}][org]">
                                </div>
                            </div>
                            @php($v++)
                        @endforeach
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
                                <input type="text" class="form-control" id="inpu11" value="{{ $model->name }}"
                                    name="name" placeholder="{{ awtTrans('اسم الاتفاق') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu110" class="col-sm-2 col-form-label">{{ awtTrans('ملفات الاتفاق') }}</label>
                            <div class="col-sm-6">
                                <input type="file" class="form-control" id="inpu110" multiple name="contract_files[]"
                                    placeholder="{{ awtTrans('ملفات الاتفاق') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu91" class="col-sm-2 col-form-label">{{ awtTrans('مجالات التعاون') }}</label>
                            <div class="col-sm-6">
                                <select class="form-control selec_coop" name="contract_field[]" required
                                    multiple="multiple">
                                    <option></option>
                                    @foreach (\App\Models\TrialTeralField::all() as $field)
                                        <option value="{{ $field->id }}"
                                            {{ in_array($field->id, $model->contract_field) ? 'selected' : '' }}>
                                            {{ $field->name_ar }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu111" class="col-sm-2 col-form-label">{{ awtTrans('التكلفة الكلية') }}</label>
                            <div class="col-sm-6">
                                <input type="number" min="1" class="form-control" id="inpu111"
                                    value="{{ $model->cost }}" required name="cost"
                                    placeholder="{{ awtTrans('التكلفة الكلية') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu112"
                                class="col-sm-2 col-form-label">{{ awtTrans('تكلفة مساهمة الوكالة') }}</label>
                            <div class="col-sm-6">
                                <input type="number" min="1" class="form-control" id="inpu112"
                                    value="{{ $model->agency_cost }}" name="agency_cost"
                                    placeholder="{{ awtTrans('تكلفة مساهمة الوكالة') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu9" class="col-sm-2 col-form-label">{{ awtTrans('التفاصيل') }}</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" id="inpu9" rows="6" required name="details"
                                    placeholder="{{ awtTrans('التفاصيل') }}">{{ $model->details }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu10"
                                class="col-sm-2 col-form-label">{{ awtTrans('تاريخ بدء الاتفاق') }}</label>
                            <div class="col-sm-6">
                                <input type="text" name="start_date" required autocomplete="off"
                                    value="{{ $model->start_date }}" class="form-control date-picker-input"
                                    id="inpu10" placeholder="{{ awtTrans('تاريخ بدء الاتفاق') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu13" class="col-sm-2 col-form-label">{{ awtTrans('الحالة') }}</label>
                            <div class="col-sm-6">
                                <select class="form-control selc_stats" required name="param">
                                    <option></option>
                                    <option value="active" {{ $model->status == 'active' ? 'selected' : '' }}>
                                        {{ awtTrans('ساري') }}
                                    </option>
                                    <option value="disabled" {{ $model->status == 'disabled' ? 'selected' : '' }}>
                                        {{ awtTrans('غير ساري') }}
                                    </option>
                                    <option value="holding" {{ $model->status == 'holding' ? 'selected' : '' }}>
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
                                    value="{{ $model->acceptation_number }}" required
                                    placeholder=" {{ awtTrans('رقم موافقة الوزير أو مجلس الإدارة') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu9" class="col-sm-2 col-form-label"> {{ awtTrans('ملاحظات أخرى') }}</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="notes"id="inpu9" rows="6"
                                    placeholder=" {{ awtTrans('ملاحظات أخرى') }}">{{ $model->notes }}</textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn btn-primary"> {{ awtTrans('تعديل') }}</button>
                                <a href="{{ route($route . '.show', ['id' => $model->id]) }}"
                                    class="btn btn-danger">{{ awtTrans('عودة') }}</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <!--select2-->

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

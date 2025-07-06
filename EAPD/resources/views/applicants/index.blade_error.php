@extends('layouts.master')
@section('styles')
<link href="{{ asset('/assets/vendor/data-tables/dataTables.bootstrap4.min.css') }}"
    rel="stylesheet">


@endsection
@section('content')
<!--main content wrapper-->
<!--page title-->
<div class="row">
    <div class="col-md-12">
        <div class="mb-4">
            <div class="page-title d-flex align-items-center p-3">
                <div>
                    @if(getRequest('waitList')=='true')

                    <h4 class="weight500 d-inline-block pr-3 mr-3 mb-0 border-right">
                        {{ awtTrans('قائمة الانتظار') }}
                    </h4>
                    <nav aria-label="breadcrumb" class="d-inline-block ">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('home') }}">{{ awtTrans('الصفحة الرئيسية') }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><a
                                    href="{{ route('applicants.index') }}">{{ awtTrans('قائمة الانتظار') }}</a>
                            </li>
                        </ol>
                    </nav>

                    @else

                    <h4 class="weight500 d-inline-block pr-3 mr-3 mb-0 border-right">
                        {{ awtTrans('قائمة المتدربين') }}
                    </h4>
                    <nav aria-label="breadcrumb" class="d-inline-block ">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('home') }}">{{ awtTrans('الصفحة الرئيسية') }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><a
                                    href="{{ route('applicants.index') }}">{{ awtTrans('قائمة المتدربين') }}</a>
                            </li>
                        </ol>
                    </nav>

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

<!--/page title-->

<!-- Conten of the page -->

@if(isset($course))
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="mb-4">

            <div class="card-body">


                <div class="form-group row">
                    <label for="inpu1" class="col-sm-2 col-form-label">@lang('main.course_name')</label>
                    <div class="col-sm-4">
                        <p>{{  optional($course)->name() ?? ''  }}</p>
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">@lang('main.course_id')</label>
                    <div class="col-sm-4">
                        <p>{{ $course->course_id }}</p>
                    </div>
                </div>



            </div>
        </div>

    </div>
</div>

@else



<!-- Conten of the page -->

<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="mb-4">

            <div class="card-body">

                <dl class="toggle_">
                    <dt>
                        <a
                            href="">{{ awtTrans('البحث السريع') }}</a>
                    </dt>
                    <dd>
                        <form>
                            @if(getRequest('advanced')!='true')
                            <div class="form-group row">

                                {{-- <label for="inpu1" class="col-sm-1 col-form-label">{{awtTrans('الاسم') }}</label>
                                <div class="col-sm-4">
                                    <input type="text" name="name"
                                        value="{{ getRequest('name') }}" class="form-control"
                                        id="inpu1"
                                        placeholder="{{ awtTrans('الاسم') }}">
                                </div>
                                <blade
                                    php|(%24dataT%5B%26%2339%3Bname%26%2339%3B%5D%3DgetRequest(%26%2339%3Bname%26%2339%3B))%20--%7D%7D%0D>

                                    <label for="inpu1"
                                        class="col-sm-1 col-form-label">{{ awtTrans("الاسم الاول") }}</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="inpu1" name="first_name"
                                            value="{{ getRequest('first_name') }}"
                                            placeholder="{{ awtTrans("الاسم الاول") }}">
                                    </div>
                                    <blade
                                        php|(%24dataT%5B%26%2339%3Bfirst_name%26%2339%3B%5D%3DgetRequest(%26%2339%3Bfirst_name%26%2339%3B))%0D>
                                        <label for="second_name"
                                            class="col-sm-1 col-form-label">{{ awtTrans("الاسم الثاني") }}</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="second_name"
                                                name="second_name"
                                                value="{{ getRequest('second_name') }}"
                                                placeholder="{{ awtTrans("الاسم الثاني") }}">
                                        </div>
                            </div>
                            <div class="form-group row">


                                <blade
                                    php|(%24dataT%5B%26%2339%3Bsecond_name%26%2339%3B%5D%3DgetRequest(%26%2339%3Bsecond_name%26%2339%3B))%0D>
                                    <label for="third_name"
                                        class="col-sm-1 col-form-label">{{ awtTrans("اللقب") }}</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="third_name"
                                            name="third_name"
                                            value="{{ getRequest('third_name') }}"
                                            placeholder="{{ awtTrans("اللقب") }}">
                                    </div>
                                    <blade
                                        php|(%24dataT%5B%26%2339%3Bthird_name%26%2339%3B%5D%3DgetRequest(%26%2339%3Bthird_name%26%2339%3B))%0D>
                                        <label for="inputPassword3"
                                            class="col-sm-1 col-form-label">{{ awtTrans('الدولة') }}</label>
                                        <div class="col-sm-4">
                                            <blade
                                                php|(%24dataT%5B%26%2339%3Bcountry%26%2339%3B%5D%3DgetRequest(%26%2339%3Bcountry%26%2339%3B))%0D>

                                                <select class="form-control selc_country" name="country">
                                                    <option></option>
                                                    <blade
                                                        foreach|(getCountries()%20as%20%24key%20%3D%3E%20%24value)%0D>
                                                        <option value="{{ $key }}"
                                                            {{ getRequest('country')==$key?'selected':'' }}>
                                                            {{ $value }}
                                                        </option>
                                                        @endforeach
                                                </select>
                                        </div>
                            </div>
                            <div class="form-group row">
                                <blade
                                    php|(%24dataT%5B%26%2339%3Bcourse%26%2339%3B%5D%3DgetRequest(%26%2339%3Bcourse%26%2339%3B))%0D>

                                    <label for="inpu2"
                                        class="col-sm-1 col-form-label">{{ awtTrans('اسم الدورة') }}</label>
                                    <div class="col-sm-4">
                                        <select class="form-control selc_course" name="course">
                                            <option></option>
                                            <blade
                                                foreach|(%5CApp%5CModels%5CCourse%3A%3Aall()%20as%20%24item)%0D>
                                                <option value="{{ $item->id }}"
                                                    {{ getRequest('course')==$item->id?'selected':'' }}>
                                                    {{ $item->name_ar }}
                                                </option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <blade
                                        php|(%24dataT%5B%26%2339%3Bgender%26%2339%3B%5D%3DgetRequest(%26%2339%3Bgender%26%2339%3B))%0D>

                                        <label for="inpu3"
                                            class="col-sm-1 col-form-label">{{ awtTrans('النوع') }}</label>
                                        <div class="col-sm-4">
                                            <select class="form-control selc_gender" name="gender">
                                                <option></option>
                                                <option value="male"
                                                    {{ getRequest('gender')=='male'?'selected':'' }}>
                                                    {{ awtTrans('ذكر') }}
                                                </option>
                                                <option value="female"
                                                    {{ getRequest('gender')=='female'?'selected':'' }}>
                                                    {{ awtTrans('أنثى') }}
                                                </option>

                                            </select>
                                        </div>
                            </div>
                            <div class="form-group row">
                                <blade
                                    php|(%24dataT%5B%26%2339%3Bdate_from%26%2339%3B%5D%3DgetRequest(%26%2339%3Bdate_from%26%2339%3B))%0D>
                                    <blade
                                        php|(%24dataT%5B%26%2339%3Bdate_to%26%2339%3B%5D%3DgetRequest(%26%2339%3Bdate_to%26%2339%3B))%0D>

                                        <label for="inpu5"
                                            class="col-sm-1 col-form-label">{{ awtTrans('التاريخ من') }}</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="date_from"
                                                value="{{ getRequest('date_from') }}"
                                                class="form-control date-picker-input" id="inpu5"
                                                placeholder="التاريخ من">

                                        </div>
                                        <label for="inpu6"
                                            class="col-sm-1 col-form-label">{{ awtTrans('التاريخ إلى') }}</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="date_to"
                                                value="{{ getRequest('date_to') }}"
                                                class="form-control date-picker-input" id="inpu6"
                                                placeholder="التاريخ إلى">
                                        </div>
                            </div>
                            @else
                            <blade
                                php|(%24dataT%5B%26%2339%3Bname%26%2339%3B%5D%3DgetRequest(%26%2339%3Bname%26%2339%3B))%0D>

                                <div class="form-group row">
                                    <label for="inpu1"
                                        class="col-sm-2 col-form-label">{{ awtTrans('اسم الدورة التدريبية') }}</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="name"
                                            value="{{ getRequest('name') }}"
                                            class="form-control" id="inpu1"
                                            placeholder="{{ awtTrans('اسم الدورة التدريبية') }}">
                                    </div>
                                    <label for="inpu1"
                                        class="col-sm-2 col-form-label">{{ awtTrans('نوع الدورة') }}</label>
                                    <div class="col-sm-4">
                                        <blade
                                            php|(%24dataT%5B%26%2339%3Btype%26%2339%3B%5D%3DgetRequest(%26%2339%3Btype%26%2339%3B))%0D>

                                            <select class="form-control selec_cours_typ" name="type"
                                                multiple="multiple">
                                                <option></option>
                                                <blade
                                                    foreach|(%5CApp%5CModels%5CCourseType%3A%3Aall()%20as%20%24item)%0D>
                                                    <option value="{{ $item->id }}"
                                                        {{ getRequest('type')==$item->id?'selected':'' }}>
                                                        {{ $item->name_ar }}
                                                    </option>
                                                    @endforeach

                                            </select>
                                    </div>
                                </div>
                                <blade
                                    php|(%24dataT%5B%26%2339%3Bnatural%26%2339%3B%5D%3DgetRequest(%26%2339%3Bnatural%26%2339%3B))%0D>

                                    <div class="form-group row">
                                        <label for="inpu151"
                                            class="col-sm-2 col-form-label">{{ awtTrans('طبيعة الدورة') }}</label>
                                        <div class="col-sm-4">
                                            <select class="form-control selec_cours_typ2" name="natural"
                                                multiple="multiple">
                                                <option></option>
                                                <blade
                                                    foreach|(%5CApp%5CModels%5CCourseNatural%3A%3Aall()%20as%20%24item)%0D>
                                                    <option value="{{ $item->id }}"
                                                        {{ getRequest('natural')==$item->id?'selected':'' }}>
                                                        {{ $item->name_ar }}
                                                    </option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        <blade
                                            php|(%24dataT%5B%26%2339%3Bfield%26%2339%3B%5D%3DgetRequest(%26%2339%3Bfield%26%2339%3B))%0D>

                                            <label for="inpu141"
                                                class="col-sm-2 col-form-label">{{ awtTrans('مجال التعاون') }}</label>
                                            <div class="col-sm-4">
                                                <select class="form-control selec_cours_typ3" name="field"
                                                    multiple="multiple">
                                                    <option></option>
                                                    <blade
                                                        foreach|(%5CApp%5CModels%5CCourseField%3A%3Aall()%20as%20%24item)%0D>
                                                        <option value="{{ $item->id }}"
                                                            {{ getRequest('field')==$item->id?'selected':'' }}>
                                                            {{ $item->name_ar }}
                                                        </option>
                                                        @endforeach
                                                </select>
                                            </div>
                                    </div>
                                    <blade
                                        php|(%24dataT%5B%26%2339%3Bstart_date_from%26%2339%3B%5D%3DgetRequest(%26%2339%3Bstart_date_from%26%2339%3B))%0D>

                                        <div class="form-group row">
                                            <label for="inpu115"
                                                class="col-sm-2 col-form-label">{{ awtTrans('تاريخ البدء من') }}</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="start_date_from"
                                                    value="{{ getRequest('start_date_from') }}"
                                                    class="form-control date-picker-input" id="inpu115"
                                                    placeholder="{{ awtTrans('تاريخ البدء من') }}">

                                            </div>
                                            <blade
                                                php|(%24dataT%5B%26%2339%3Bstart_date_to%26%2339%3B%5D%3DgetRequest(%26%2339%3Bstart_date_to%26%2339%3B))%0D>

                                                <label for="inpu116"
                                                    class="col-sm-2 col-form-label">{{ awtTrans('تاريخ البدء الي') }}</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="start_date_to"
                                                        value="{{ getRequest('start_date_to') }}"
                                                        class="form-control date-picker-input" id="inpu116"
                                                        placeholder="{{ awtTrans('تاريخ البدء الي') }}">
                                                </div>
                                        </div>
                                        <blade
                                            php|(%24dataT%5B%26%2339%3Bend_date_from%26%2339%3B%5D%3DgetRequest(%26%2339%3Bend_date_from%26%2339%3B))%0D>

                                            <div class="form-group row">
                                                <label for="inpu25"
                                                    class="col-sm-2 col-form-label">{{ awtTrans('تاريخ الإنتهاء من') }}</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="end_date_from"
                                                        value="{{ getRequest('end_date_from') }}"
                                                        class="form-control date-picker-input" id="inpu25"
                                                        placeholder="{{ awtTrans('تاريخ الإنتهاء من') }}">

                                                </div>
                                                <blade
                                                    php|(%24dataT%5B%26%2339%3Bend_date_to%26%2339%3B%5D%3DgetRequest(%26%2339%3Bend_date_to%26%2339%3B))%0D>

                                                    <label for="inpu26"
                                                        class="col-sm-2 col-form-label">{{ awtTrans('تاريخ الإنتهاء الي') }}</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="end_date_to"
                                                            value="{{ getRequest('end_date_to') }}"
                                                            class="form-control date-picker-input" id="inpu26"
                                                            placeholder="{{ awtTrans('تاريخ الإنتهاء الي') }}">
                                                    </div>
                                            </div>
                                            <blade
                                                php|(%24dataT%5B%26%2339%3Blocation%26%2339%3B%5D%3DgetRequest(%26%2339%3Blocation%26%2339%3B))%0D>

                                                <div class="form-group row">
                                                    <label for="inpu7"
                                                        class="col-sm-2 col-form-label">{{ awtTrans('مكان الإنعقاد ') }}</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="location"
                                                            value="{{ getRequest('location') }}"
                                                            class="form-control " id="inpu7"
                                                            placeholder="{{ awtTrans('مكان الإنعقاد ') }}">

                                                    </div>
                                                    <blade
                                                        php|(%24dataT%5B%26%2339%3Borganization%26%2339%3B%5D%3DgetRequest(%26%2339%3Borganization%26%2339%3B))%0D>

                                                        <label for="inpu111"
                                                            class="col-sm-2 col-form-label">{{ awtTrans('الجهة المنظمة') }}</label>
                                                        <div class="col-sm-4">
                                                            <select class="form-control selc_cour_train"
                                                                name="organization" multiple="multiple">
                                                                <option></option>
                                                                <blade
                                                                    foreach|(%5CApp%5CModels%5CCoursePartner%3A%3Aall()%20as%20%24item)%0D>
                                                                    <option value="{{ $item->id }}"
                                                                        {{ getRequest('organization')==$item->id?'selected':'' }}>
                                                                        {{ $item->name_ar }}
                                                                    </option>
                                                                    @endforeach
                                                            </select>
                                                        </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for=""
                                                        class="col-sm-2 col-form-label">{{ awtTrans('الدول المشاركة') }}</label>
                                                    <div class="col-sm-4">
                                                        <option></option>
                                                        <blade
                                                            php|(%24dataT%5B%26%2339%3Bcountry%26%2339%3B%5D%3DgetRequest(%26%2339%3Bcountry%26%2339%3B))%0D>

                                                            <select class="form-control selc_country"
                                                                name="country">
                                                                <option></option>
                                                                <blade
                                                                    foreach|(getCountries()%20as%20%24key%20%3D%3E%20%24value)%0D>
                                                                    <option value="{{ $key }}"
                                                                        {{ getRequest('country')==$key?'selected':'' }}>
                                                                        {{ $value }}
                                                                    </option>
                                                                    @endforeach
                                                            </select>
                                                    </div>
                                                    <label for="inpu111"
                                                        class="col-sm-2 col-form-label">{{ awtTrans('اسم منسق الدورة') }}</label>
                                                    <div class="col-sm-4">
                                                        <blade
                                                            php|(%24dataT%5B%26%2339%3Btrainee%26%2339%3B%5D%3DgetRequest(%26%2339%3Btrainee%26%2339%3B))%0D>

                                                            <select class="form-control selc_cours_cord"
                                                                name="trainee" multiple="multiple">
                                                                <option></option>
                                                                <blade
                                                                    foreach|(%5CApp%5CModels%5CCourseTrianee%3A%3Aall()%20as%20%24item)%0D>
                                                                    <option value="{{ $item->id }}"
                                                                        {{ getRequest('trainee')==$item->id?'selected':'' }}>
                                                                        {{ $item->name_ar }}
                                                                    </option>
                                                                    @endforeach
                                                            </select>

                                                    </div>
                                                </div>

                                                {{-- @php($dataT['per_cost_from']=getRequest('per_cost_from')) --}}

                                                {{-- <div class="form-group row"> --}}
                                                {{-- <label for="inpu119" class="col-sm-2 col-form-label">{{awtTrans('التكلفة الفرد من') }}</label>--}}
                                                {{-- <div class="col-sm-4"> --}}
                                                {{-- <input type="number" min="0" name="per_cost_from" value="{{getRequest('per_cost_from') }}"
                                                class="form-control " id="inpu119"
                                                placeholder="{{ awtTrans('التكلفة الفرد من') }}">--}}
                                                {{-- </div> --}}
                                                {{-- @php($dataT['per_cost_to']=getRequest('per_cost_to')) --}}

                                                {{-- <label for="inpu119" class="col-sm-2 col-form-label">{{awtTrans('التكلفة الفرد إلى') }}</label>--}}
                                                {{-- <div class="col-sm-4"> --}}
                                                {{-- <input type="number" min="0" name="per_cost_to" value="{{getRequest('per_cost_to') }}"
                                                class="form-control " id="inpu119"
                                                placeholder="{{ awtTrans('التكلفة الفرد الحد الأقصى') }}">--}}
                                                {{-- </div> --}}
                                                {{-- </div> --}}
                                                {{-- @php($dataT['cost_from']=getRequest('cost_from')) --}}

                                                {{-- <div class="form-group row"> --}}
                                                {{-- <label for="inpu129" class="col-sm-2 col-form-label">{{awtTrans('التكلفة الكلية من') }}</label>--}}
                                                {{-- <div class="col-sm-4"> --}}
                                                {{-- <inputtype="number" min="0" name="cost_from" value="{{getRequest('cost_from') }}"
                                                class="form-control " id="inpu129"
                                                placeholder="{{ awtTrans('التكلفة الكلية الحد الأدنى') }}">--}}
                                                {{-- </div> --}}
                                                {{-- @php($dataT['cost_to']=getRequest('cost_to')) --}}

                                                {{-- <label for="inpu139" class="col-sm-2 col-form-label">{{awtTrans('التكلفة الكلية إلى') }}</label>--}}
                                                {{-- <div class="col-sm-4"> --}}
                                                {{-- <input type="number" min="0" name="cost_to" value="{{getRequest('cost_to') }}"
                                                class="form-control " id="inpu139"
                                                placeholder="{{ awtTrans('التكلفة الكلية الحد الأقصى') }}">--}}
                                                {{-- </div> --}}
                                                {{-- </div> --}}
                                                <div class="form-group row">
                                                    <blade
                                                        php|(%24dataT%5B%26%2339%3Bapp_from%26%2339%3B%5D%3DgetRequest(%26%2339%3Bapp_from%26%2339%3B))%0D>

                                                        <label for="inpu133"
                                                            class="col-sm-2 col-form-label">{{ awtTrans('إجمالي عدد المتدربين من') }}</label>
                                                        <div class="col-sm-4">
                                                            <input type="number" min="0" name="app_from"
                                                                value="{{ getRequest('app_from') }}"
                                                                class="form-control " id="inpu133"
                                                                placeholder="{{ awtTrans('إجمالي عدد المتدربين الحد الأدنى') }}">
                                                        </div>
                                                        <blade
                                                            php|(%24dataT%5B%26%2339%3Bapp_to%26%2339%3B%5D%3DgetRequest(%26%2339%3Bapp_to%26%2339%3B))%0D>

                                                            <label for="inpu134"
                                                                class="col-sm-2 col-form-label">{{ awtTrans('إجمالي عدد المتدربين إلى') }}</label>
                                                            <div class="col-sm-4">
                                                                <input type="number" min="0" name="app_to"
                                                                    value="{{ getRequest('app_to') }}"
                                                                    class="form-control " id="inpu134"
                                                                    placeholder="{{ awtTrans('إجمالي عدد المتدربين الحد الأقصى') }}">
                                                            </div>
                                                </div>
                                                <blade
                                                    php|(%24dataT%5B%26%2339%3Bappfem_from%26%2339%3B%5D%3DgetRequest(%26%2339%3Bappfem_from%26%2339%3B))%0D>

                                                    <div class="form-group row">
                                                        <label for="inpu136"
                                                            class="col-sm-2 col-form-label">{{ awtTrans('عدد المتدربات النساء من') }}</label>
                                                        <div class="col-sm-4">
                                                            <input type="number" min="0" name="appfem_from"
                                                                value="{{ getRequest('appfem_from') }}"
                                                                class="form-control " id="inpu136"
                                                                placeholder="{{ awtTrans('عدد المتدربات النساء الحد الأدنى') }}">
                                                        </div>
                                                        <blade
                                                            php|(%24dataT%5B%26%2339%3Bappfem_to%26%2339%3B%5D%3DgetRequest(%26%2339%3Bappfem_to%26%2339%3B))%0D>

                                                            <label for="inpu137"
                                                                class="col-sm-2 col-form-label">{{ awtTrans('عدد المتدربات النساء إلى') }}</label>
                                                            <div class="col-sm-4">
                                                                <input type="number" min="0" name="appfem_to"
                                                                    value="{{ getRequest('appfem_to') }}"
                                                                    class="form-control " id="inpu137"
                                                                    placeholder="{{ awtTrans('عدد المتدربات النساء الحد الأقصى') }}">
                                                            </div>
                                                    </div>

                                                    @endif
                                                    <div class="form-group row">
                                                        <div class="col-sm-12 text-right">
                                                            <blade
                                                                if|(getRequest(%26%2339%3Badvanced%26%2339%3B)%3D%3D%26%2339%3Btrue%26%2339%3B)%0D>
                                                                <button type="submit" name="advanced" value="true"
                                                                    class="btn btn-primary">{{ awtTrans('بحث') }}</button>

                                                                <a href="{{ route($route.'.index') }}"
                                                                    name="advanced" value="true"
                                                                    class="btn btn-secondary">{{ awtTrans('بحث عادي') }}</a>
                                                                @else
                                                                <button type="submit"
                                                                    class="btn btn-primary">{{ awtTrans('بحث') }}</button>

                                                                {{-- <button type="submit" name="advanced" value="true" --}}
                                                                {{-- class="btn btn-secondary">{{awtTrans('بحث متقدم') }}</button>--}}

                                                                @endif
                                                        </div>
                                                    </div>
                        </form>
                    </dd>
                </dl>

            </div>
        </div>

    </div>
</div>
@endif
<!-- begin table -->
<form method="post" action="{{ route('applicants.delete',$dataT) }}">

    {{ csrf_field() }}
    <div class="row">
        <div class="col-xl-12">
            @include('flash::message')

            <div class="mb-4">
                <div class="card-header border-0">
                    <div class="row">
                        <div class="col-md-12">
                            @if(isset($course))

                            <a href="{{ route($route.'.index') }}"
                                class="btn btn-primary float-right ml-1"><i
                                    class="fa fa-backward"></i>{{ awtTrans('عوده') }}</a>
                            @else
                            <a href="{{ route($route.'.create') }}"
                                class="btn btn-primary float-left"><i
                                    class="fa fa-plus-square-o"></i>{{ awtTrans('إضافة متدربين') }}</a>
                            <button type="button" data-toggle="modal" data-target="#exampleModal"
                                class="btn btn-danger float-right ml-1"><i class="fa fa-trash-o"></i>
                                @lang('main.delete')</button>
                            {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> --}}
                            {{-- Launch demo modal --}}
                            {{-- </button> --}}

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                {{ awtTrans('main.confirm') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {{ awtTrans('main.delete_confirm') }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{trans('awt.main.close')}}</button>
                                            <button type="submit" name="submit" value="delete"
                                                class="btn btn-danger float-right ml-1"><i
                                                    class="fa fa-trash-o"></i> @lang('main.delete')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" name="submit" value="print"
                                class="btn btn-primary float-right ml-1"><i class="fa fa-print"></i>
                                {{ awtTrans('طباعة') }}</button>
                            <button type="submit" name="submit" value="print2"
                                class="btn btn-primary float-right ml-1"><i class="fa fa-print"></i>
                                {{ awtTrans('طباعة2') }}</button>
                            <button type="submit" name="submit" value="export"
                                class="btn btn-primary float-right ml-1"><i
                                    class="fa fa-file-excel-o"></i>{{ awtTrans(' تحميل اكسل') }}</button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body- pt-3 pb-4">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-striped" cellspacing="0"
                            style="border-bottom: 2px solid #ddd;">
                            <thead>
                                <tr>
                                    @foreach($table_rows as $row)
                                    <th>{!! $row['display'] !!}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <!-- <tfoot>
                                <tr>
@foreach($table_rows as $row)
                                        <th>{!!$row['display']!!}</th>
@endforeach
                                </tr>
                                </tfoot> -->
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>

<!--/footer-->
<!--/main content wrapper-->


@endsection
@push('scripts')

<!--datatables-->
<script src="{{ asset('/assets/vendor/data-tables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/data-tables/dataTables.bootstrap4.min.js') }}"></script>
<!--init datatable-->
<script src="{{ asset('/assets/vendor/js-init/init-datatable.js') }}"></script>
<script src="{{ asset('assets/vendor/icheck/skins/icheck.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "columnDefs": [{
                "orderable": false,
                "searchable": false,
                "targets": 0
            }],
            "aaSorting": [],
            language: {
                processing: "{{ __('datatable.processing') }}",
                search: "{{ __('datatable.search') }}",
                lengthMenu: "{{ __('datatable.lengthMenu') }}",
                info: "{{ __('datatable.info') }}",
                infoEmpty: "{{ __('datatable.infoEmpty') }}",
                infoFiltered: "({{ __('datatable.infoFiltered') }} _MAX_ )",
                loadingRecords: "{{ __('datatable.loadingRecords') }}",
                zeroRecords: "{{ __('datatable.emptyTable') }}",
                emptyTable: "{{ __('datatable.emptyTable') }}",
                paginate: {
                    first: "{{ __('datatable.first') }}",
                    previous: "{{ __('datatable.previous') }}",
                    next: "{{ __('datatable.next') }}",
                    last: "{{ __('datatable.last') }}"
                }
            },

            processing: true,
            serverSide: true,
            <
            blade
            if | (isset( % 24 _GET % 5 B % 26 % 2339 % 3 Bcourse_id % 26 % 2339 % 3 B % 5 D)) % 0 D >
            ajax: '{{ route($route.'.datatable ',['
            course_id '=>$_GET['
            course_id ']]) }}',

            <
            blade
            else | % 0 D / >
                <
                blade php | ( % 24 dataT % 5 B % 26 % 2339 % 3 Borganization % 26 % 2339 % 3 B % 5 D %
                    3 DgetRequest( % 26 % 2339 % 3 Borganization % 26 % 2339 % 3 B)) % 0 D >
                <
                blade php | ( % 24 dataT % 5 B % 26 % 2339 % 3 BwaitList % 26 % 2339 % 3 B % 5 D %
                    3 DgetRequest( % 26 % 2339 % 3 BwaitList % 26 % 2339 % 3 B)) % 0 D >
                ajax: '{{ route($route.'.datatable ',$dataT) }}',

            <
            /blade endif|%0D>
            columns: [ <
                blade foreach | ( % 24 table_rows % 20 as % 20 % 24 row) % 0 D > {
                    data: '{{ $row['
                    data '] }}',
                    name: '{{ $row['
                    name '] }}',
                    orderable: {
                        {
                            %
                            24 row % 5 B % 26 % 2339 % 3 Borderable % 26 % 2339 % 3 B % 5 D
                        }
                    },
                    searchable: {
                        {
                            %
                            24 row % 5 B % 26 % 2339 % 3 Bsearchable % 26 % 2339 % 3 B % 5 D
                        }
                    }
                }, <
                /blade endforeach|%0D>

            ]
        });
    });


    $("#check-all").click(function() {

        if ($('input:checkbox.chk-all').prop('checked')) {
            $('input:checkbox.chk-item').prop('checked', true);
        } else {
            $('input:checkbox.chk-item').prop('checked', false);
        }
    });
</script>

@endsection
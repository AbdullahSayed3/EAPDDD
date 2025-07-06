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
                                    @foreach (getCountries() as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ getRequest('country') == $key ? 'selected' : '' }}>
                                            {{ $value }}
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
                            <br>
                            <div class="col-sm-12">
                                <input type="checkbox" autocomplete="off" name="details"
                                    {{ getRequest('details') == 'details' ? 'checked' : '' }} value="details">
                                {{ awtTrans('ادراج التفاصيل') }}<br>

                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn btn-primary">{{ awtTrans('بحث') }}</button>
                                <button type="reset" class="btn btn-danger">{{ awtTrans('إلغاء') }}</button>
                            </div>
                        </div>
                    </form>
                    <a href="/reports/21" class="btn btn-primary">إلغاء الفلترة</a>

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
                                <h3 class="weight500 d-block pr-3 mb-5">القوافل المقدمة</h3>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-10 ">
                            <div class="table-responsive">
                                <table class="table table-bordered" cellspacing="0">
                                    <thead class="thead-light">
                                        <tr>

                                            <th>{{ awtTrans('الدولة') }}</th>
                                            <th>{{ awtTrans('النوع') }}</th>
                                            <th>{{ awtTrans('تاريخ الشحن') }}</th>
                                            <th>{{ awtTrans('تاريخ الوصول') }}</th>
                                            @if (getRequest('details') == 'details')
                                                <th>{{ awtTrans('التفاصيل') }}</th>
                                            @endif
                                            <th>{{ awtTrans('القيمة الإجمالية (شاملة الشحن)') }}</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="thead-light">
                                        <tr>
                                            <th colspan="{{ getRequest('details') == 'details' ? 3 : 3 }}">
                                                إجمالي عدد القوافل</th>
                                            <td colspan="{{ getRequest('details') == 'details' ? 5 : 4 }}">
                                                {{ count($aids) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="{{ getRequest('details') == 'details' ? 3 : 3 }}">
                                                بإجمالي مبلغ و قدره
                                            </th>
                                            <td colspan="{{ getRequest('details') == 'details' ? 5 : 4 }}">
                                                {{ $costs['aids'] }}
                                                {{ awtTrans('جنيه مصرى') }}</td>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                        @php
                                            $aidNo = 1;
                                        @endphp
                                        @if (getRequest('details') == 'details1')
                                            @foreach ($aidsByCountry as $country => $aid)
                                                @php
                                                    $mAids = $aid['aids'];
                                                    $Aidsuppliers = $mAids[0]->suppArray;
                                                @endphp
                                                <tr>

                                                    @php $aidNo++ @endphp
                                                    <td rowspan="{{ count($mAids) }}">
                                                        {{ getCountry($mAids[0]->country_id) }}</td>
                                                    <td rowspan="{{ count($mAids[0]->suppArray) }}"><a
                                                            href="{{ route('aids.show', [$mAids[0]->id]) }}">{{ $mAids[0]->type->name_ar }}</a>
                                                    </td>
                                                    <td rowspan="{{ count($mAids[0]->suppArray) }}">
                                                        {{ $mAids[0]->ship_date->format('Y/m/d') }}</td>
                                                    <td rowspan="{{ count($mAids[0]->suppArray) }}">
                                                        {{ $mAids[0]->arrive_date->format('Y/m/d') }}</td>
                                                    {{-- @if (getRequest('details') == 'details') --}}

                                                    {{-- <td>{{$Aidsuppliers[0]['details']}}</td> --}}
                                                    {{-- <td>{{$Aidsuppliers[0]['cost']}} {{awtTrans('جنيه')}}</td> --}}

                                                    {{-- @php unset($Aidsuppliers[0]) @endphp --}}
                                                    {{-- @endif --}}
                                                    <td rowspan="{{ count($mAids[0]->suppArray) }}">{{ $mAids[0]->cost }}
                                                        {{ awtTrans('جنيه') }}</td>
                                                </tr>
                                                @php  unset($mAids[0]); @endphp

                                                @foreach ($Aidsuppliers as $su)
                                                    @if (!isset($su['details']))
                                                        @continue
                                                    @endif
                                                    <tr>
                                                        <td>{{ $su['details'] }}</td>
                                                        <td>{{ $su['cost'] }} {{ awtTrans('جنيه') }}</td>
                                                    </tr>
                                                @endforeach

                                                @foreach ($mAids as $a)
                                                    @php
                                                        $mAidsuppliers = $a->suppArray;
                                                        $rowSpan = count($mAidsuppliers);
                                                    @endphp

                                                    <tr>
                                                        <td rowspan="{{ $rowSpan }}"><a
                                                                href="{{ route('aids.show', [$a->id]) }}">{{ $a->type->name_ar }}</a>
                                                        </td>
                                                        <td rowspan="{{ $rowSpan }}">
                                                            {{ $a->ship_date->format('Y/m/d') }}</td>
                                                        <td rowspan="{{ $rowSpan }}">
                                                            {{ $a->arrive_date->format('Y/m/d') }}</td>
                                                        @if (getRequest('details') == 'details')
                                                            <td>{!! $mAidsuppliers[0]['details'] !!}</td>
                                                            <td>{{ $mAidsuppliers[0]['cost'] }} {{ awtTrans('جنيه') }}
                                                            </td>

                                                            @php unset($mAidsuppliers[0]) @endphp
                                                        @endif
                                                        <td rowspan="{{ $rowSpan }}">{{ $a->cost }}
                                                            {{ awtTrans('جنيه') }}</td>
                                                    </tr>

                                                    @foreach ($mAidsuppliers as $su)
                                                        @if (!isset($su['details']))
                                                            @continue
                                                        @endif
                                                        <tr>
                                                            <td>{{ $su['details'] }}</td>
                                                            <td>{{ $su['cost'] }} {{ awtTrans('جنيه') }}</td>

                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @else
                                            @foreach ($aidsByCountry as $country => $aid)
                                                @php
                                                    $mAids = $aid['aids'];
                                                    $Aidsuppliers = $mAids[0]->suppArray;
                                                @endphp
                                                <tr>

                                                    <td rowspan="{{ count($mAids) }}">
                                                        {{ getCountry($mAids[0]->country_id) }}</td>
                                                    <td rowspan="1"><a
                                                            href="{{ route('aids.show', [$mAids[0]->id]) }}">{{ $mAids[0]->type->name_ar ?? '-' }}</a>
                                                    </td>
                                                    <td rowspan="1">{{ $mAids[0]->ship_date->format('Y/m/d') }}</td>
                                                    <td rowspan="1">{{ $mAids[0]->arrive_date->format('Y/m/d') }}</td>
                                                    @if (getRequest('details') == 'details')
                                                        <td rowspan="1">{{ $Aidsuppliers[0]['details'] }}</td>


                                                        @php unset($Aidsuppliers[0]) @endphp
                                                    @endif
                                                    <td rowspan="1">{{ $mAids[0]->cost }} {{ awtTrans('جنيه') }}</td>
                                                </tr>
                                                @php  unset($mAids[0]); @endphp


                                                @foreach ($mAids as $a)
                                                    @php
                                                        $mAidsuppliers = $a->suppArray;
                                                        $rowSpan = count($mAidsuppliers);
                                                    @endphp
                                                    @php   $Aidsuppliers=$a->suppArray @endphp

                                                    <tr>
                                                        <td rowspan="1"><a
                                                                href="{{ route('aids.show', [$a->id]) }}">{{ $a->type->name_ar ?? '-' }}</a>
                                                        </td>
                                                        <td rowspan="1">{{ $a->ship_date->format('Y/m/d') }}</td>
                                                        <td rowspan="1">{{ $a->arrive_date->format('Y/m/d') }}</td>
                                                        @if (getRequest('details') == 'details')
                                                            @if (count($Aidsuppliers) == 0)
                                                                <td rowspan="1"></td>
                                                                <td rowspan="1"></td>
                                                            @else
                                                                <td rowspan="1">{{ $Aidsuppliers[0]['details'] }}</td>
                                                            @endif

                                                            @php unset($Aidsuppliers[0]) @endphp
                                                        @endif
                                                        <td rowspan="1">{{ $a->cost }} {{ awtTrans('جنيه') }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        @endif
                                        {{-- @foreach ($aids as $aid) --}}
                                        {{-- @php  if($aid->suppliers!=null){$Aidsuppliers=unserialize($aid->suppliers);}else{$Aidsuppliers=[];}@endphp --}}

                                        {{-- <tr> --}}
                                        {{-- <td >{{$aid->id}}</td> --}}
                                        {{-- <td >{{getCountry($aid->country_id)}}</td> --}}
                                        {{-- <td><a --}}
                                        {{-- href="{{route('aids.show',[$aid->id])}}">{{$aid->type->name_ar}}</a> --}}
                                        {{-- </td> --}}

                                        {{-- <td >{{$aid->ship_date->format('Y/m/d')}}</td> --}}
                                        {{-- <td >{{$aid->ship_date->format('Y/m/d')}}</td> --}}
                                        {{-- @if (getRequest('details') == 'details') --}}
                                        {{-- <td>{{$asupp['details']}}</td> --}}
                                        {{-- <tr> --}}
                                        {{-- <td>{{$Aidsuppliers[0]['details']}}</td> --}}
                                        {{-- <td>{{$Aidsuppliers[0]['cost']}} {{awtTrans('جنيه')}}</td> --}}
                                        {{-- </tr> --}}
                                        {{-- @php unset($Aidsuppliers[0]) @endphp --}}
                                        {{-- @endif --}}
                                        {{-- <td >{{$aid->cost}} {{awtTrans('جنيه')}}</td> --}}
                                        {{-- </tr> --}}

                                        {{-- @if (getRequest('details') == 'details') --}}
                                        {{-- @foreach ($Aidsuppliers as $asupp)@if (!isset($asupp['details'])) @continue @endif --}}
                                        {{-- <td>{{$asupp['details']}}</td> --}}
                                        {{-- <tr> --}}
                                        {{-- <td>أسماك ومأكولات بحرية طازجة من مصر للمملكة الأردنية الهاشمية</td> --}}
                                        {{-- <td>5،500 جنيه</td> --}}
                                        {{-- </tr> --}}
                                        {{-- @endforeach --}}
                                        {{-- @endif --}}
                                        {{-- @endforeach --}}
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

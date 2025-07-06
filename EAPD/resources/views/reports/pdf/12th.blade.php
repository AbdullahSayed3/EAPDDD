<!DOCTYPE html>
<html>

<head>
    <style>
        /* Styles go here */

        .page-header, .page-header-space {
            height: 150px;
        }

        .page-footer, .page-footer-space {
            height: 50px;
            direction: ltr !important;

        }


        .page-footer {
            text-align: center;
            direction: rtl !important;
            position: fixed;
            bottom: 0;
            width: 100%;
            padding-top: 2px;
            border-top: 1px solid #6c345e; /* for demo */
            font-size: 0.8rem;
            /*background: rgba(255, 144, 22, 0.22); !* for demo *!*/
        }

        .page-header {
            position: fixed;
            top: 6mm;
            width: 100%;
            /*border-bottom: 1px solid #6c345e; !* for demo *!*/
            /*background: #ff9016; !* for demo *!*/
        }

        .page {
            page-break-after: always;
        }

        @page {
            margin: 10mm;
            margin-bottom: 0mm;
            margin-top: 0mm;
        }

        @media print {
            thead {
                display: table-header-group;
            }

            tfoot {
                display: table-footer-group;
            }

            button {
                display: none;
            }

            body {
                margin: 0;
            }
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        .mytable td, th {
            border: 1px solid #444444;
            text-align: center;
            padding: 2px;
            /*padding: 10px;*/
            /*text-align: center;*/
            font-size: 13px;
        }

        .mytable table tr td {
            padding: 5px;
            text-align: center;
            border: 1px solid #2d2d2d;
        }

        .mytable table thead th {
            padding: 10px;
            text-align: center;
            border: 1px solid #2d2d2d;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .PDFcontent .header img.left {
            width: 4.5cm;
            vertical-align: middle !important;
            margin: 0;
            float: left
        }

        .PDFcontent .header img.right {
            width: 3cm;
            vertical-align: middle !important;
            margin: 0;
            float: right;
        }


    </style>
</head>

<body
        onload="window.print()"
        dir="rtl" class="PDFcontent">

<div class="page-header header" style="text-align: right;">
    <div style="padding-right: 30px; padding-top: 10px; ">
        <img src="{{asset('pdf/logo-'.$lang.'.png')}}" class="left">
        <img src="{{asset('pdf/m-logo-'.$lang.'.png')}}" class="right">
    </div>


</div>


<table>

    <thead>
    <tr>
        <td>
            <!--place holder for the fixed-position header-->
            <div class="page-header-space"></div>
            {{--<div class="page-header-space"></div>--}}
        </td>
    </tr>
    </thead>

    <tbody>
    <tr>
        <td>

            <div class="page" style="text-align: center">
                <div class="main-title">
                    <h2>{{$title}}</h2>
                    {{--                    <h3 class="text-center weight500">{{getCountry($country)}}</h3>--}}
                    @if((isset($_GET['date_from']) && $_GET['date_from']!=null) && (isset($_GET['date_to']) && $_GET['date_to']!=null))

                        <h4 class="text-center weight500">
                            {{awtTrans('(في الفترة الزمنية')}}


                            {{awtTrans('من')}}
                            {{$_GET['date_from'] }}

                            {{awtTrans('إلى ')}}
                            {{$_GET['date_to'] }}
                            )
                        </h4>

                    @endif
                </div>
                <div class="table-content">
                    <div class="page-title">
                        <h3 class="weight500 d-block pr-3 mb-5"> {{awtTrans('المنح والمعونات المقدمة')}}</h3>
                    </div>
                </div>
                <table class="mytable">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>{{awtTrans('الدولة')}}</th>
                            <th>{{awtTrans('النوع')}}</th>
                            <th>{{awtTrans('تاريخ الشحن')}}</th>
                            <th>{{awtTrans('تاريخ الوصول')}}</th>
                            @if(getRequest('details')=="details")
                                <th>{{awtTrans('التفاصيل')}}</th>
                                <th>{{awtTrans('القيمه')}}</th>
                            @endif
                            <th>{{awtTrans('القيمة الإجمالية (شاملة الشحن)')}}</th>
                        </tr>
                        </thead>
                        <tfoot class="thead-light">
                        <tr>
                            <th colspan="{{getRequest('details')=="details"?3:3}}">{{awtTrans('العدد الإجمالى')}}</th>
                            <td colspan="{{getRequest('details')=="details"?5:4}}"> {{count($aids)}}</td>
                        </tr>
                        <tr>
                            <th colspan="{{getRequest('details')=="details"?3:3}}">{{awtTrans("الإجمالى")}}</th>
                            <td colspan="{{getRequest('details')=="details"?5:4}}">{{$costs['aids']}} {{awtTrans("جنيه مصرى")}}</td>
                        </tr>
                        </tfoot>
                        <tbody>
                        @if(getRequest('details')=="details1")

                            @foreach($aidsByCountry as $country=>$aid)
                                @php $mAids=$aid['aids'];  $Aidsuppliers=$mAids[0]->suppArray @endphp
                                <tr>
                                    <td rowspan="{{count($mAids)}}">{{$mAids[0]->id}}</td>
                                    <td rowspan="{{count($mAids)}}">{{getCountry($mAids[0]->country_id)}}</td>
                                    <td rowspan="{{count($mAids[0]->suppArray)}}"><a
                                                href="{{route('aids.show',[$mAids[0]->id])}}">{{$mAids[0]->type->name_ar}}</a>
                                    </td>
                                    <td rowspan="{{count($mAids[0]->suppArray)}}">{{$mAids[0]->ship_date->format('Y/m/d')}}</td>
                                    <td rowspan="{{count($mAids[0]->suppArray)}}">{{$mAids[0]->arrive_date->format('Y/m/d')}}</td>
                                    {{--@if(getRequest('details')=="details")--}}

                                    {{--<td>{{$Aidsuppliers[0]['details']}}</td>--}}
                                    {{--<td>{{$Aidsuppliers[0]['cost']}} {{awtTrans('جنيه')}}</td>--}}

                                    {{--@php unset($Aidsuppliers[0]) @endphp--}}
                                    {{--@endif--}}
                                    <td rowspan="{{count($mAids[0]->suppArray)}}">{{$mAids[0]->cost}} {{awtTrans('جنيه')}}</td>
                                </tr>
                                @php  unset($mAids[0]); @endphp

                                @foreach($Aidsuppliers as $su)@if(!isset($su['details'])) @continue @endif
                                <tr>
                                    <td>{{$su['details']}}</td>
                                    <td>{{$su['cost']}} {{awtTrans('جنيه')}}</td>
                                </tr>
                                @endforeach

                                @foreach($mAids as $a)
                                    @php $mAidsuppliers=$a->suppArray; $rowSpan=count($mAidsuppliers) @endphp

                                    <tr>
                                        <td rowspan="{{$rowSpan}}"><a
                                                    href="{{route('aids.show',[$a->id])}}">{{$a->type->name_ar}}</a>
                                        </td>
                                        <td rowspan="{{$rowSpan}}">{{$a->ship_date->format('Y/m/d')}}</td>
                                        <td rowspan="{{$rowSpan}}">{{$a->arrive_date->format('Y/m/d')}}</td>
                                        @if(getRequest('details')=="details")

                                            <td>{!! $mAidsuppliers[0]['details'] !!}</td>
                                            <td>{{$mAidsuppliers[0]['cost']}} {{awtTrans('جنيه')}}</td>

                                            @php unset($mAidsuppliers[0]) @endphp
                                        @endif
                                        <td rowspan="{{$rowSpan}}">{{$a->cost}} {{awtTrans('جنيه')}}</td>
                                    </tr>

                                    @foreach($mAidsuppliers as $su)@if(!isset($su['details'])) @continue @endif
                                    <tr>
                                        <td>{{$su['details']}}</td>
                                        <td>{{$su['cost']}} {{awtTrans('جنيه')}}</td>

                                    </tr>
                                    @endforeach

                                @endforeach
                            @endforeach

                        @else
						@php $m=0 @endphp
                            @foreach($aidsByCountry as $country=>$aid)
							@php $m++ @endphp
                                @php $mAids=$aid['aids'];  $Aidsuppliers=$mAids[0]->suppArray @endphp

                                <tr>
                                    <td rowspan="{{count($mAids)}}">{{$m}}</td>
                                    <td rowspan="{{count($mAids)}}">{{getCountry($mAids[0]->country_id)}}</td>
                                    <td rowspan="1"><a
                                                href="{{route('aids.show',[$mAids[0]->id])}}">{{$mAids[0]->type->name_ar}}</a>
                                    </td>
                                    <td rowspan="1">{{$mAids[0]->ship_date->format('Y/m/d')}}</td>
                                    <td rowspan="1">{{$mAids[0]->arrive_date->format('Y/m/d')}}</td>
                                    @if(getRequest('details')=="details")

                                        <td rowspan="1">{{$Aidsuppliers[0]['details']}}</td>
                                        @if($Aidsuppliers[0]['cost']==null)

                                            <td rowspan="1">0</td>

                                        @else

                                            <td rowspan="1">{{$Aidsuppliers[0]['cost']}} {{awtTrans('جنيه')}}</td>

                                        @endif

                                        @php unset($Aidsuppliers[0]) @endphp
                                    @endif
                                    <td rowspan="1">{{$mAids[0]->cost}} {{awtTrans('جنيه')}}</td>
                                </tr>
                                @php  unset($mAids[0]); @endphp


                                @foreach($mAids as $a)
                                    @php $mAidsuppliers=$a->suppArray; $rowSpan=count($mAidsuppliers) @endphp
                                    @php   $Aidsuppliers=$a->suppArray @endphp

                                    <tr>
                                        <td rowspan="1"><a
                                                    href="{{route('aids.show',[$a->id])}}">{{$a->type->name_ar}}</a>
                                        </td>
                                        <td rowspan="1">{{$a->ship_date->format('Y/m/d')}}</td>
                                        <td rowspan="1">{{$a->arrive_date->format('Y/m/d')}}</td>
                                        @if(getRequest('details')=="details")
                                            @if(count($Aidsuppliers)==0)

                                                <td rowspan="1"></td>
                                                <td rowspan="1"></td>

                                            @else

                                                <td rowspan="1">{{$Aidsuppliers[0]['details']}}</td>
                                            @if($Aidsuppliers[0]['cost']==null)

                                                    <td rowspan="1">0</td>

                                                @else

                                                    <td rowspan="1">{{$Aidsuppliers[0]['cost']}} {{awtTrans('جنيه')}}</td>

                                                @endif

                                            @endif

                                            @php unset($Aidsuppliers[0]) @endphp
                                        @endif
                                        <td rowspan="1">{{$a->cost}} {{awtTrans('جنيه')}}</td>
                                    </tr>

                                @endforeach
                            @endforeach
                        @endif
                        {{--@foreach($aids as $aid)--}}
                        {{--@php  if($aid->suppliers!=null){$Aidsuppliers=unserialize($aid->suppliers);}else{$Aidsuppliers=[];}@endphp--}}

                        {{--<tr>--}}
                        {{--<td >{{$aid->id}}</td>--}}
                        {{--<td >{{getCountry($aid->country_id)}}</td>--}}
                        {{--<td><a--}}
                        {{--href="{{route('aids.show',[$aid->id])}}">{{$aid->type->name_ar}}</a>--}}
                        {{--</td>--}}

                        {{--<td >{{$aid->ship_date->format('Y/m/d')}}</td>--}}
                        {{--<td >{{$aid->ship_date->format('Y/m/d')}}</td>--}}
                        {{--@if(getRequest('details')=="details")--}}
                        {{--<td>{{$asupp['details']}}</td>--}}
                        {{--<tr>--}}
                        {{--<td>{{$Aidsuppliers[0]['details']}}</td>--}}
                        {{--<td>{{$Aidsuppliers[0]['cost']}} {{awtTrans('جنيه')}}</td>--}}
                        {{--</tr>--}}
                        {{--@php unset($Aidsuppliers[0]) @endphp--}}
                        {{--@endif--}}
                        {{--<td >{{$aid->cost}} {{awtTrans('جنيه')}}</td>--}}
                        {{--</tr>--}}

                        {{--@if(getRequest('details')=="details")--}}
                        {{--@foreach($Aidsuppliers as $asupp)@if(!isset($asupp['details'])) @continue @endif--}}
                        {{--<td>{{$asupp['details']}}</td>--}}
                        {{--<tr>--}}
                        {{--<td>أسماك ومأكولات بحرية طازجة من مصر للمملكة الأردنية الهاشمية</td>--}}
                        {{--<td>5،500 جنيه</td>--}}
                        {{--</tr>--}}
                        {{--@endforeach--}}
                        {{--@endif--}}
                        {{--@endforeach--}}
                        </tbody>
                </table>
            </div>

        </td>
    </tr>
    </tbody>

    <tfoot>
    <tr>
        <td>
            <!--place holder for the fixed-position footer-->
            <div class="page-footer-space"></div>
        </td>
    </tr>
    </tfoot>

</table>

</body>

</html>

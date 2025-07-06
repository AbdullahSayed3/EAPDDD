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
            @php($t = 0)
            <?php
            $firstDate = getRequest('date_from');
            $lastDate = getRequest('date_to');
            ?>

                @foreach ($courses as $key => $values)


                    <div class="page" style="text-align: center">
                        <div class="main-title">
                            @if($t==0)
                                <h2>{{$title}}</h2>
                                <h3 class="text-center weight500">{{getCountry($country)}}</h3>
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
                                @php($t=1)
                            @endif

                        </div>
                        <div class="table-content">
                            <div class="page-title">
                                <h3 class="weight500 d-block pr-3 mb-5"> {{awtTrans('بيانات المشاركة بدورات الوكالة')}}</h3>
                            </div>
                        </div>
                        <table class="mytable">

                            <thead class="thead-light">
                            <tr>
                                <th colspan="5" style="text-align:center">    <?php

                                    if ($firstDate[6] < 7 && $firstDate[5] == 0) {
                                        $DateFrom = $key - 1;
                                        $DateTo = $key;
                                    } else {
                                        $DateFrom = $key + 1;

                                        $DateTo = $key + 2;
                                    }
            ?>
                                {{ awtTrans('العام المالي') }} {{ $DateFrom }}

                                / {{ $DateTo }}</th>
                            </tr>
                            <tr>
                                <th>{{awtTrans('اجمالى عدد الدورات')}}</th>
                                <td>{{ $coursesDetails[$key]['total_coursers_year'] }}</td>
                                <th>{{awtTrans('إجمالى عدد المتدربين')}}</th>
                                <td colspan="2">{{ $coursesDetails[$key]['total_apps_year'] }}</td>
                            </tr>


                            <tr>
                                <th>{{awtTrans('عدد الدورات النوعية')}}</th>
                                <td>{{ $coursesDetails[$key]['total_city_year'] }}</td>
                                <th>{{awtTrans('عدد دورات الجيش والشرطة')}}</th>
                                <td colspan="2">{{$coursesDetails[$key]['total_army_year'] + $coursesDetails[$key]['total_police_year'] }}</td>
                            </tr>
                            <tr>
                                <th>{{awtTrans('رقم الدورة')}}</th>
                                <th>{{awtTrans('الدورة التدريبية')}}</th>
                                <th>{{awtTrans('جهة التدريب')}}</th>
                                <th>{{awtTrans('عدد المتدربين')}}</th>
                                <th>{{awtTrans('المتدربات النساء')}}</th>
                            </tr>

                            </thead>
                            {{--<tfoot class="thead-light">--}}
                            {{----}}

                            {{--</tfoot>--}}
                            <tbody>
                            @php($ii=1)

                            @foreach($coursesDetails[$key]['total_coursers_year_data'] as $course)
                                <tr>
                                    <td>{{$ii}}</td>
                                    @php($ii++)

                                    <td>
                                        <a href="{{route('courses.show',[$course->id])}}">{{$course->name_ar}}</a>
                                    </td>
                                    <td>{{$course->organization->name}}</td>
                                    <td>{{$course->applications()->where('country','LIKE','%'.$country.'%')->count()}}</td>
                                    <td>{{$course->applications()->where('country','LIKE','%'.$country.'%')->where('gender','female')->count()}}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>


                @endforeach

            <div class="page" style="text-align: center">

                <div class="table-content">
                    <div class="page-title">
                        <h3 class="weight500 d-block pr-3 mb-5"> {{awtTrans('الإجمالى')}}</h3>
                    </div>
                </div>
                <table class="mytable">

                    <thead class="thead-light">
                        <tr>
                            <th>{{ awtTrans('اجمالى عدد الدورات') }}</th>
                            <td>{{ $mainDetails['total']  }}</td>
                            <th>{{ awtTrans('عدد الدورات المدنية') }}</th>
                            <td>{{ $mainDetails['total_city']  }}</td>
                        </tr>
                        <tr>
                            <th>{{ awtTrans('عدد الدورات الجيش') }}</th>
                            <td>{{ $mainDetails['total_army']}}</td>
                            <th>{{ awtTrans('عدد دورات الشرطة') }}</th>
                            <td>{{ $mainDetails['total_police']  }}</td>
                        </tr>
                        <tr>
                            <th>{{ awtTrans('إجمالى عدد المتدربين') }}</th>
                            <td>{{ $mainDetails['total_apps']  }}</td>
                            <th>{{ awtTrans('إجمالى عدد المتدربات') }}</th>
                            <td>{{ $mainDetails['total_fapps']  }}</td>
                        </tr>
                    </thead>

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

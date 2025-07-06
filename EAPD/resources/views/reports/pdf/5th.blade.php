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

        .mytable  table thead th {
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
                        @if(isset($_GET['inv']) && $_GET['inv']!=null)
                            <h3 class="weight500 d-block pr-3"> {{awtTrans('بيانات الدعوه بدورات الوكالة')}} </h3>

                        @else
                            <h3 class="weight500 d-block pr-3"> {{awtTrans('بيانات المشاركة بدورات الوكالة')}} </h3>

                        @endif
                    </div>
                </div>
                <table class="mytable">

                    <thead class="thead-light">
                    <tr>
                        <th colspan="7" style="text-align:center">{{awtTrans("بيان بمشاركة الدول بالفترة")}}

                            <?php
                            if (getRequest('date_from') !== null) {
                                $date=getRequest('date_from');
                                $date=explode('-',$date);
                                echo      awtTrans("من");

                                echo $date[0];

                            }

                            ?>

                            {{awtTrans("إلى")}}

                            <?php
                            if (getRequest('date_to') !== null) {
                                $date=getRequest('date_to');
                                $date=explode('-',$date);
                                echo $date[0];

                            }else
                            {
                                echo \Carbon\Carbon::now()->format('Y');
                            }


                            ?>
                        </th>
                    </tr>
                    <tr>
                        <th>#</th>

                        <th>{{awtTrans('الدولة')}}</th>

                        <th>{{awtTrans('عدد المتدربين')}}</th>
                        <th>{{awtTrans('عدد الدورات النوعية')}}</th>
                        <th>{{awtTrans('عدد دورات الجيش والشرطة')}}</th>
                        @if(isset($_GET['inv']) && $_GET['inv']==1)
                            <th>{{awtTrans('عدد الدورات المدعوة')}}</th>

                            <th>{{awtTrans('عدد الدورات المشاركة')}}</th>

                        @else
                            <th>{{awtTrans('عدد الدورات المشاركة')}}</th>

                            <th>{{awtTrans('عدد الدورات المدعوة')}}</th>

                        @endif
                        {{--                    <th>{{awtTrans('التكلفة الإجمالية')}}</th>--}}
                    </tr>


                    </thead>
                    {{--<tfoot class="thead-light">--}}
                    {{----}}

                    {{--</tfoot>--}}
                    <tbody>
                    @php($m=1)

                    @foreach($countries as $country)
                        <tr>
                            <td>{{$m}}</td>

                            <td>{{$country['name']}}</td>

                            <td>{{$country['total_apps']}}</td>
                            <td>{{$country['total_city']}}</td>
                            <td>{{$country['total_army']+$country['total_police']}}</td>
                            <td>{{$country['total_courses']}}</td>
                            <td>{{$country['total_in_courses']}}</td>
                            {{--                        <td>{{$country['cost']}}</td>--}}
                        </tr>
                        @php($m++)

                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="page" style="text-align: center">

                <div class="table-content">
                    <div class="page-title">
                        <h3 class="weight500 d-block pr-3 mb-5"> {{awtTrans('الإجمالى')}}</h3>
                    </div>
                </div>
                <table class="mytable">

                    <tbody>
                    <tr>
                        <th>{{awtTrans('اجمالى عدد الدورات')}}</th>
                        <td>{{    $countryArrayData['total_courses']}}</td>
                        <th>{{awtTrans('عدد الدورات المدنية')}}</th>
                        <td>{{ $countryArrayData['total_city']}}</td>
                    </tr>
                    <tr>
                        <th>{{awtTrans('عدد الدورات الجيش')}}</th>
                        <td>{{$countryArrayData['total_army']}}</td>
                        <th>{{awtTrans('عدد دورات الشرطة')}}</th>
                        <td>{{$countryArrayData['total_police']}}</td>
                    </tr>
                    <tr>
                        <th>{{awtTrans('إجمالى عدد المتدربين')}}</th>
                        <td>{{    $countryArrayData['total_apps']}}</td>
                        <th>{{awtTrans('إجمالى عدد المتدربات')}}</th>
                        <td>{{  $countryArrayData['total_apps_fem']}}</td>
                    </tr>
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

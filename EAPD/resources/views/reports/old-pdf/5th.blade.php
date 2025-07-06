<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Influence Monitoring System">
    <meta name="author" content="ORYX LAB">

    <link rel="shortcut icon" href="assets/images/assets/images/favicon.png">

    <title>الوكالة المصرية للشراكة من أجل التنمية</title>


    <style>
        html,
        body {
            height: 297mm;
            width: 210mm;
        }

        body {
            background: white;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            direction: rtl;
        }

        @page {
            size: 21cm 29.7cm;
            margin: 0;
        }

        article {
            display: block;
            margin: 0 0 0.5cm 0;
            position: relative;
            border: 3px solid #2d2d2d;
        }

        article[size="A4"] {
            width: 21cm;
            height: 29.7cm;
        }

        article:nth-last-of-type(1) {
            margin-bottom: 0cm;
        }

        article.section {
            background: #fff;
            background-size: 21cm 29.7cm;
            position: relative;
            width: 21cm;
            height: 29.7cm;
            page-break-before: always !important;
            page-break-after: always !important;
            /* margin: 0 0 0.5cm 0; */
        }

        article[size="A4"][layout="portrait"] {
            width: 29.7cm;
            height: 21cm;
        }

        article[size="A3"] {
            width: 29.7cm;
            height: 42cm;
        }

        article[size="A3"][layout="portrait"] {
            width: 42cm;
            height: 29.7cm;
        }

        article[size="A5"] {
            width: 14.8cm;
            height: 21cm;
        }

        article[size="A5"][layout="portrait"] {
            width: 21cm;
            height: 14.8cm;
        }

        .PDFcontent {
            max-width: 95%;
            width: 95%;
            margin: 0 auto;
            display: block;
            padding: 2% 0;
            position: relative;
            height: 95%;
            page-break-after: always;
        }

        .PDFcontent .header {
            margin: .5cm 0 1cm;
            width: 100%;
            display: block;
        }

        .PDFcontent .header div:after {
            display: block;
            content: '';
            clear: both;
        }

        .PDFcontent .header div {
            vertical-align: middle !important;
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

        .PDFcontent .main-title {
            width: 100%;
            display: block;
            text-align: center !important;
        }

        .PDFcontent .main-title h1 {
            display: block;
            margin: 0 auto 1cm;
            text-decoration: underline;
            max-width: 80%;
        }

        .PDFcontent .table-content {
            width: 100%;
            text-align: center;
            margin-bottom: 1cm;
        }

        .PDFcontent .table-content::after {
            display: block;
            content: '';
            clear: both;
        }

        .PDFcontent .table-content table {
            width: calc(( 100% / 2) - 40px);
            float: right;
            margin: 0 20px 0 20px;
            padding: 0;
            border-spacing: 0;
        }

        .PDFcontent .table-content table:nth-last-of-type(1) {
            margin: 0 20px 0 20px;
        }

        .PDFcontent .table-content table tr {
            background: transparent;
        }

        .PDFcontent .table-content table tr td {
            padding: 10px;
            width: 50%;
            text-align: center;
            border: 1px solid #2d2d2d;
        }

        .PDFcontent .table-content table tr th {
            padding: 10px;
            width: 50%;
            text-align: right;
            border: 1px solid #2d2d2d;
        }

        .PDFcontent .data-table table {
            width: calc(100% - 40px);
            border-spacing: 0;
            margin: 0 auto;
            padding: 0;
        }

        .PDFcontent .data-table table thead {
            background: #eee;
            text-align: center
        }

        .PDFcontent .data-table table thead th {
            padding: 10px;
            text-align: center;
            border: 1px solid #2d2d2d;
        }

        .PDFcontent .data-table table tr td {
            padding: 5px;
            text-align: center;
            border: 1px solid #2d2d2d;
        }

        @media print {
            body,
            article {
                margin: 0;
                box-shadow: 0;
            }
        }
    </style>
</head>

<body onload="window.print()">



<article size="A4" class="section">
    <div class="PDFcontent">
        <div class="header">
            <div>
                <img src="{{asset('pdf/logo-'.$lang.'.png')}}" class="left">
                <img src="{{asset('pdf/m-logo-'.$lang.'.png')}}" class="right">
            </div>


        </div>
        <div class="main-title">
            <h1>{{$title}}</h1>
        </div>
        <div class="table-content">
            <div class="page-title">
                @if((isset($_GET['date_from']) && $_GET['date_from']!='null') && (isset($_GET['date_to']) && $_GET['date_to']!='null'))

                    <h4 class="text-center weight500">{{$_GET['date_from'] }} - {{$_GET['date_to'] }}</h4>

                @endif
                <h3 class="weight500 d-block pr-3 mb-5">1- {{awtTrans('بيانات المشاركة بدورات الوكالة')}}</h3>
            </div>
        </div>
        <div class="data-table">

            <table class="table table-bordered " cellspacing="0" style="text-align: center;">
                <thead class="thead-light">
                <tr>
                    <th colspan="6" style="text-align:center">{{awtTrans("بيان بمشاركة الدول بالفترة")}}

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
                    <th>{{awtTrans('الدولة')}}</th>
                    <th>{{awtTrans('عدد الدورات')}}</th>
                    @if(isset($_GET['inv']) && $_GET['inv']==1)
                        <th>{{awtTrans('عدد الدورات المشاركة')}}</th>

                    @else
                        <th>{{awtTrans('عدد الدورات المدعوة')}}</th>

                    @endif
                    <th>{{awtTrans('عدد المتدربين')}}</th>
                    <th>{{awtTrans('عدد الدورات النوعية')}}</th>
                    <th>{{awtTrans('عدد دورات الجيش والشرطة')}}</th>
{{--                    <th>{{awtTrans('التكلفة الإجمالية')}}</th>--}}
                </tr>

                </thead>
                {{--<tfoot class="thead-light">--}}
                {{--<tr>--}}
                {{--<th>{{awtTrans('الإجمالى')}}</th>--}}
                {{--<th>{{    $countryArrayData['total_courses']}}</th>--}}
                {{--<th>{{ $countryArrayData['total_apps']}}</th>--}}
                {{--<th>{{   $countryArrayData['total_city']}}</th>--}}
                {{--<th>{{ $countryArrayData['total_army']+  $countryArrayData['total_police']}}</th>--}}
                {{--<th>{{   $countryArrayData['cost']}}</th>--}}
                {{--</tr>--}}


                {{--</tfoot>--}}
                <tbody>
                @foreach($countries as $country)
                    <tr>
                        <td>{{$country['name']}}</td>
                        <td>{{$country['total_courses']}}</td>
                        <td>{{$country['total_in_courses']}}</td>
                        <td>{{$country['total_apps']}}</td>
                        <td>{{$country['total_city']}}</td>
                        <td>{{$country['total_army']+$country['total_police']}}</td>
{{--                        <td>{{$country['cost']}}</td>--}}
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>


    </div>
</article>

<article size="A4" class="section">
    <div class="PDFcontent">
        <div class="header">
            <div>
                <img src="{{asset('pdf/logo-'.$lang.'.png')}}" class="left">
                <img src="{{asset('pdf/m-logo-'.$lang.'.png')}}" class="right">
            </div>


        </div>
        <div class="main-title">
            <h1>{{$title}}</h1>
        </div>
        <div class="table-content">
            <div class="page-title">
                <h3 class="weight500 d-block pr-3 mb-5">2- {{awtTrans('الإجمالى')}}</h3>
            </div>
        </div>
        <div class="data-table">

            <table class="table table-bordered" cellspacing="0">

                <tbody class="thead-light">
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
                {{--<tr>--}}
                {{--<th colspan="2">{{awtTrans('التكلفة الإجمالية')}}</th>--}}
                {{--<td colspan="2">{{  $countryArrayData['cost']}} {{awtTrans('جنيه مصري')}}</td>--}}
                {{--</tr>--}}
                </tbody>
            </table>
        </div>


    </div>
</article>


</body>

</html>
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


@foreach($mainData as $key => $item)

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
                @if((isset($_GET['date_from']) && $_GET['date_from']!=null) && (isset($_GET['date_to']) && $_GET['date_to']!=null))

                    <h4 class="text-center weight500">{{$_GET['date_from'] }}
                        - {{$_GET['date_to'] }}</h4>

                @endif
                <h3 class="weight500 d-block pr-3 mb-5">1- {{awtTrans('أعمال الوكالة سنويا')}}</h3>
            </div>
        </div>
        <div class="data-table">

            <table class="table table-bordered" cellspacing="0">
                <thead class="thead-light">
                <tr>
                    <th colspan="4" style="text-align: center;">أ{{awtTrans('عمال الوكالة العام المالي')}} {{$key+1}} / {{$key}}</th>
                </tr>
                <tr>

                    <th>{{awtTrans('عدد الدورات التدريبية')}}</th>
                    <td>{{$item['total_courses']}}</td>
                    <th>{{awtTrans('عدد الدورات المدنية')}}</th>
                    <td>{{$item['total_citizen']}}</td>
                </tr>

                <tr>
                    <th>{{awtTrans('عدد دورات الجيش')}}</th>
                    <td>{{  $item['total_army']}}</td>
                    <th>{{awtTrans('عدد دورات الشرطة')}}</th>
                    <td>{{$item['total_police']}}</td>
                </tr>
                <tr>
                    <th>{{awtTrans('عدد المتدربين')}}</th>
                    <td>{{ $item['total_apps']}}</td>
                    <th>{{awtTrans('عدد المتدربات')}}</th>
                    <td>{{ $item['total_female']}}</td>
                </tr>
                <tr>
                    <th>{{awtTrans('عدد المنح والمعونات')}}</th>
                    <td>{{ $item['total_aids']}}</td>
                </tr>
                <tr>
                    <th>{{awtTrans('عدد الخبراء')}}</th>
                    <td>{{ $item['total_experts']}}</td>
                    <th>{{awtTrans('عدد الدول المستفيدة')}}</th>
                    <td>{{  $item['total_countries']}}</td>
                </tr>
                @if(getRequest('cost')!=null)
                    <tr>
                        <th colspan="2">{{awtTrans('التكلفة الإجمالية للدورات التدريبية')}}</th>
                        <td colspan="2">{{$item['total_c_cost']}} {{awtTrans('جنيه مصرى')}}</td>
                    </tr>
                    <tr>
                        <th colspan="2">{{awtTrans('التكلفة الإجمالية للمنح والمعونات')}}</th>
                        <td colspan="2">{{$item['total_a_cost']}} {{awtTrans('جنيه مصرى')}}</td>
                    </tr>

                    <tr>
                        <th colspan="2">{{awtTrans('التكلفة الإجمالية للخبراء')}}</th>
                        <td colspan="2">{{$item['total_e_cost']}} {{awtTrans('جنيه مصرى')}}</td>
                    </tr>
                @endif
                </thead>

            </table>

        </div>


    </div>
</article>
@endforeach
</body>

</html>
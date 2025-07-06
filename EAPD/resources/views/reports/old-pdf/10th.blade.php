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
                margin: 0.3cm;
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
                <h3 class="weight500 d-block pr-3 mb-5">1- {{awtTrans('بيانات دورات الوكالة')}}</h3>
            </div>
        </div>
        <div class="data-table">

            <table class="table table-bordered " cellspacing="0" style="text-align: center;">
                <thead class="thead-light">
                <tr>
                    <th colspan="6" style="text-align:center">{{awtTrans("بيان بالدورات بالفترة")}}

                        <?php
                        if (getRequest('date_from') !== null) {
                            $date = getRequest('date_from');
                            $date = explode('-', $date);
                            echo awtTrans("من");

                            echo $date[0];

                        }

                        ?>

                        {{awtTrans("إلى")}}

                        <?php
                        if (getRequest('date_to') !== null) {
                            $date = getRequest('date_to');
                            $date = explode('-', $date);
                            echo $date[0];

                        } else {
                            echo \Carbon\Carbon::now()->format('Y');
                        }


                        ?>
                    </th>
                </tr>
                <tr>
                    <th>{{awtTrans('اسم الدورة')}}</th>
                    <th>{{awtTrans('تاريخ الدورة')}}</th>
                    <th>{{awtTrans('عدد المتدربين')}}</th>
                    <th>{{awtTrans('التكلفة الإجمالية')}}</th>
                </tr>

                </thead>
                <tfoot class="thead-light">
                <tr>
                    <th colspan="2">{{awtTrans('عدد الدورات')}}</th>
                    <td colspan="2">{{$mainDetails['total']}}</td>
                </tr>
                <tr>
                    <th colspan="2">{{awtTrans('عدد المتدربين')}}</th>
                    <td colspan="2">{{$mainDetails['total_apps']}}</td>
                </tr>
                @if(getRequest('cost')!='false')
                    <tr>
                        <th colspan="2">{{awtTrans('التكلفة الإجمالية')}}</th>
                        <td colspan="2">{{ $costs['courses']}}</td>
                    </tr>
                @endif

                </tfoot>
                <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>{{$course->name_ar}}</td>
                        <td>{{$course->start_date->format('d/m/Y')}}
                            - {{$course->end_date->format('d/m/Y')}}</td>
                        <td>{{$course->applications->count()}}</td>
                        <td>{{$course->applications->count()*$course->cost}}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>


    </div>
</article>
@if(getRequest('apps')=='true')
    @foreach($courses as $course)

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
                <h3 class="weight500 d-block pr-3 mb-5">2- {{awtTrans('بيانات المشاركين')}}</h3>
            </div>
        </div>
        <div class="data-table">

            <table class="table table-bordered" cellspacing="0">

                <thead class="thead-light">
                <tr>
                    <th colspan="6" style="text-align:center">{{$course->name_ar}}</th>
                    <th colspan="2"
                        style="text-align:center">{{$course->start_date->format('d/m/Y')}}
                        - {{$course->end_date->format('d/m/Y')}}</th>
                </tr>
                <tr>
                    <th>{{awtTrans('الاسم')}}</th>
                    <th>{{awtTrans('النوع')}}</th>
                    <th>{{awtTrans('الدولة')}}</th>
                    <th>{{awtTrans('الوظيفة')}}</th>
                    <th>{{awtTrans('السن')}}</th>
                    <th>{{awtTrans('البريد الالكتروني')}}</th>
                    <th>{{awtTrans('الهاتف')}}</th>
                    <th>{{awtTrans('رقم جواز السفر')}}</th>
                </tr>
                </thead>
                <tfoot class="thead-light">

                <tr>
                    <th colspan="2">{{awtTrans('عدد المتدربين')}}</th>
                    <td colspan="2">{{$mainDetails['total_apps']}}</td>
                </tr>
                @if(getRequest('cost')!='false')
                    <tr>
                        <th colspan="2">{{awtTrans('التكلفة الإجمالية')}}</th>
                        <td colspan="2">{{ $costs['courses']}}</td>
                    </tr>
                @endif

                </tfoot>
                <tbody>
                @foreach($course->applications as $app)

                    <tr>
                        <td>
                            <a href="{{route('applicants.index',[$app->id])}}">{{$app->name()}}</a>
                        </td>
                        <td>{{awtTrans($app->gender)}}</td>
                        <td>{{getCountry($app->country)}}</td>
                        <td>{{$app->current_employer}}</td>
                        <td>{{\Carbon\Carbon::createFromTimeString($app->birth_date)->diff(\Carbon\Carbon::now())->format('%y')}}</td>
                        <td>{{$app->email_address}}</td>
                        <td>{{serialize($app->phone_number)[0]}}</td>
                        <td>{{$app->passport_id}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


    </div>
</article>

        @endforeach
@endif

</body>

</html>

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
                <h3 class="text-center weight500">{{getCountry($dcountry)}}</h3>

            @if((isset($_GET['date_from']) && $_GET['date_from']!=null) && (isset($_GET['date_to']) && $_GET['date_to']!=null))

                    <h4 class="text-center weight500">{{$_GET['date_from'] }} - {{$_GET['date_to'] }}</h4>

                @endif
                <h3 class="weight500 d-block pr-3 mb-5">1- {{awtTrans('بيانات الخبراء')}}</h3>
            </div>
        </div>
        <div class="data-table">

            <table class="table table-bordered " cellspacing="0">
                <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>{{awtTrans('الدولة')}}</th>
                    <th>{{awtTrans("الاسم")}}</th>
                    <th>{{awtTrans("التخصص")}}</th>
                    <th>{{awtTrans("بداية التعاقد")}}</th>
                    <th>{{awtTrans("نهاية التعاقد")}}</th>
                    <th>{{awtTrans("رقم جواز السفر")}}</th>
                    <th>{{awtTrans("الجهه الموفد اليها")}}</th>
                    @if(getRequest('cost')!='false')

                        <th>{{awtTrans("التكلفة السنوية")}}</th>
                    @endif
                </tr>
                </thead>
                <tfoot class="thead-light">
                <tr>
                    <th colspan="3">{{awtTrans(' العدد الإجمالي')}}</th>
                    <td colspan="6">{{count($experts)}}</td>
                </tr>
                @if(getRequest('cost')!='false')

                    <tr>
                        <th colspan="3">{{awtTrans(' التكلفة الإجمالية')}}</th>
                        <td colspan="6">{{$costs['experts']}}</td>
                    </tr>
                @endif
                </tfoot>
                <tbody>
                @php($ii=1)

                @foreach($experts as $row)
                    <tr>
                        <td>{{$ii}}</td>
                        @php($ii++)
                        <td>{{getCountry($row->country)}}</td>
                        <td><a href="{{route('experts.show',[$row->id])}}">{{$row->name}}</a></td>
                        <td>{{$row->specialist}}</td>
                        <td>{{$row->contract_date->format('d/m/Y')}}</td>
                        <td>{{$row->end_date->format('d/m/Y')}}</td>
                        <td>{{$row->passport_number}}</td>
                        <td>{{$row->delegate_org}}</td>
                        @if(getRequest('cost')!='false')

                            <td>{{$row->cost}}</td>
                        @endif
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>


    </div>
</article>

</body>

</html>
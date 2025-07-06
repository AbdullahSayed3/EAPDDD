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
            width: calc((100% / 2) - 40px);
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

@foreach($data as $model)


    <article size="A4" class="section">
        <div class="PDFcontent">
            <div class="header">
                <div>
                    <img src="{{asset('pdf/logo-'.$lang.'.png')}}" class="left">
                    <img src="{{asset('pdf/m-logo-'.$lang.'.png')}}" class="right">
                </div>


            </div>

            <div class="data-table">

                <table class="table table-bordered " cellspacing="0" style="text-align: center;">

                    <tbody>
                    <tr>
                        <td>{{awtTrans('الاطار التعاقدي')}}</td>
                        <td>
                            <p>{{$model->name}}</p>

                        </td>
                    </tr>
                    <tr>
                        <td>{{awtTrans('مجالات التعاون')}}</td>
                        <td>
                            @foreach(unserialize($model->contract_field) as $row)
                                {{getTrialField($row)}}<br>
                            @endforeach
                        </td>
                    </tr>

                    <tr>
                        <td>{{awtTrans('التكلفة الكلية')}}</td>
                        <td> {{$model->cost}} $</td>
                    </tr>


                    <tr>
                        <td>{{awtTrans('تكلفة مساهمة الوكالة')}}</td>
                        <td> {{$model->agency_cost}} $</td>
                    </tr>

                    <tr>
                        <td>{{awtTrans('التفاصيل')}}</td>
                        <td> {{$model->details}}</td>
                    </tr>


                    <tr>
                        <td>
                            {{awtTrans('تاريخ بدء الاتفاق')}}
                        </td>

                        <td>
                            <p>{{$model->start_date}}</p>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{awtTrans('الحالة')}}
                        </td>

                        <td>
                            <p>{{$model->status}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{awtTrans('رقم موافقة الوزير أو مجلس الإدارة')}}
                        </td>

                        <td>
                            <p> {{$model->acceptation_number}}</p>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            {{awtTrans('ملاحظات أخرى')}}
                        </td>

                        <td>
                            <p>{{$model->notes}}</p>
                        </td>
                    </tr>

                    </tbody>
                </table>
                <h4>{{awtTrans('الدولة المستفيدة')}}</h4>

                <table class="table table-bordered">

                    <tbody>
                    <?php
                    $rowArray=unserialize($model->beneficiary_countries);

                    ?>
                    @foreach( $rowArray as $row)
                        <tr>
                            <td>
                                @if($row['id']=='0')
                                    {{$row['org']}}

                                @else
                                    {{getCountry($row['id'])}}

                                    @if(isset($row['org']))
                                        / {{$row['org']}}
                                    @endif

                                @endif


                            </td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>
            </div>


        </div>
    </article>

@endforeach


</body>

</html>
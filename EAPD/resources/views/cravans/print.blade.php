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
            width: 297mm;
            height: 210mm;
        }

        body {
            background: white;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            direction: rtl;
        }

        @page {
            size:  29.7cm 21cm;
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

        /* article[size="A4"][layout="portrait"] {
            width: 29.7cm;
            height: 21cm;
        } */

        article[size="A4"][layout="landscape"] {
            height: 29.7cm;
            width: 21cm;
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
        ul {list-style: none;
            padding:0;}
    </style>
</head>

<body onload="window.print()">



        <div class="PDFcontent">
            <div class="header">
                <div>
                    <img src="{{asset('pdf/logo-'.$lang.'.png')}}" class="left">
                    <img src="{{asset('pdf/m-logo-'.$lang.'.png')}}" class="right">
                </div>


            </div>

            <div class="data-table">

                <table class="table table-bordered " cellspacing="0" style="text-align: center;">
                    <thead>
                        <th>#</th>
                        <th>{{ awtTrans('name') }}</th>
                        <th>{{awtTrans('نوع المنحة')}}</th>
                        <th>{{awtTrans('الدولة المستفيدة')}}</th>
                        <th>{{awtTrans('الجهة المتلقية بالدولة')}}</th>
                        <th>{{awtTrans('رقم موافقة الوزير أو مجلس الإدارة')}}</th>
                        <th>{{awtTrans('تاريخ الشحن')}}</th>
                        <th> {{awtTrans('تاريخ الوصول')}}</th>
                        <th>{{awtTrans('القيمة (شاملة الشحن)')}}</th>
                        <th>{{awtTrans('بيانات المورد')}}</th>
                    </thead>
                    <tbody>
                        @php($t=1)
                @foreach($data as $model)


                        <tr>
                            <td>{{ $t }}</td>
                @php($t++)
                            <td>
                                <p>{{$model['title_'.App::getLocale()]}}</p>
                            </td>

                        <td>
                            <p>{{$model->type->name_ar??'-'}}</p>
                        </td>
                        <td><p>{{getCountry($model->country_id)}}</p>
                        </td>
                        <td>{{$model->country_org}}</td>
                        <td>{{$model->minister_name}}</td>
                        <td>  {{$model->ship_date->format('Y-m-d')}}</td>
                        <td>
                            {{$model->arrive_date->format('Y-m-d')}}
                        </td>
                        <td>
                            {{number_format($model->cost,2,".",",")}}
                          </td>
                        <td>
                        @foreach(unserialize($model->suppliers) as $row)

                            <ul class="list-group">
                                @if (!empty(getSupplier($row['id'])))
                                <li class="list-group-item"><span>{{awtTrans('اسم المورد')}} </span> {{getSupplier($row['id'])}}</li>
                                @endif

                                @if (!empty($row['cost']))

                                <li class="list-group-item"><span>{{awtTrans('القيمة')}} </span> {{  number_format($row['cost'],2,".",",")}}
                                  </li>
                                @endif

                                @if (!empty($row['end_date']))

                                <li class="list-group-item"><span>{{awtTrans('التفاصيل')}}</span> {{isset($row['details'])?$row['details']  : 'N\A' }}</li>
                                @endif

                                @if (!empty($row['end_date']))
                                <li class="list-group-item"><span>{{awtTrans('تاريخ الإنتهاء / الصلاحية')}}</span> {{$row['end_date']}}</li>
                                @endif
                            </ul>
                            @endforeach

                        </td>
                    </tr>




                    </tbody>
                @endforeach

                </table>



            </div>


        </div>



</body>

</html>

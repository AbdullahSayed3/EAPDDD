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

    @foreach ($data as $model)
        <div class="PDFcontent">
            <div class="header">
                <div>
                    <img src="{{ asset('pdf/logo-' . $lang . '.png') }}" class="left">
                    <img src="{{ asset('pdf/m-logo-' . $lang . '.png') }}" class="right">
                </div>


            </div>

            <div class="data-table">

                <table class="table table-bordered " cellspacing="0" style="text-align: center;">

                    <tbody>
                        <tr>
                            <td>@lang('main.course_name')</td>
                            <td>
                                @if (empty($model->course))
                                    <p>N\A</p>
                                @else
                                    <p>{{ $model->course->name() }}</p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>@lang('main.applicant_date')</td>
                            <td>{{ $model->created_at?$model->created_at->format('d-m-Y'):'-' }}</td>
                        </tr>

                        <tr>
                            <td>@lang('main.name')</td>
                            <td>{{ $model->name() }}</td>
                        </tr>


                        <tr>
                            <td>@lang('main.nationality')</td>
                            <td>{{ getCountry($model->nationality) }}</td>
                        </tr>

                        <tr>
                            <td>@lang('main.gender')</td>
                            <td>@lang('main.' . $model->gender)</td>
                        </tr>




                        <tr>
                            <td>
                                @lang('main.phone_number')
                            </td>

                            <td>
                                {{ $model->phone_number }}
                            </td>
                        </tr>


                        <tr>
                            <td>
                                @lang('main.email_address')
                            </td>

                            <td>
                                {{ $model->email_address }}
                            </td>
                        </tr>

                        <tr>
                            <td>
                                @lang('main.birth_date')
                            </td>

                            @if (!empty($model->birth_date))
                                <td>{{ $model->birth_date->format('d-m-Y') }}</td>
                                @else
                        <td></td>
                            @endif
                        </tr>

                        <tr>
                            <td>
                                @lang('main.current_employer')
                            </td>

                            <td>
                                {{ $model->current_employer }}
                            </td>
                        </tr>





                    </tbody>
                </table>
                @if (empty($model->course))
                @else
                    <h3>{{ awtTrans('بيانات الدورات') }}</h3>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ awtTrans('اسم الدورة') }}</th>
                                <th>{{ awtTrans('تاريخ الدورة') }}</th>
                                <th>{{ awtTrans('ترشيح المتدرب') }}</th>
                                <th>{{ awtTrans('حالة المتدرب') }}</th>
                                <th>{{ awtTrans('تكلفة الدورة') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <a
                                        href="{{ route('courses.show', [$model->course->id]) }}">{{ $model->course->name_ar }}</a>
                                </td>
                                <td>{{ $model->course->start_date->format('Y-m-d') }}</td>
                                <td>{{ $model->trainee_status == 'primary' ? awtTrans('اساسي') : awtTrans('غير اساسي') }}</td>
                                <td>{{ $model->wait_list == 'false' ? awtTrans('نشط') : awtTrans('غير نشط') }}</td>
                                <td>{{ $model->course->cost }}</td>
                            </tr>
                        </tbody>
                    </table>
                @endif
            </div>


        </div>
    @endforeach


</body>

</html>

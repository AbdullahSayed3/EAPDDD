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
            /* padding: 10px; */
            width: 50%;
            text-align: center;
            border: 1px solid #2d2d2d;
        }

        .PDFcontent .table-content table tr th {
            /* padding: 10px; */
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
            /* padding: 10px; */
            text-align: center;
            border: 1px solid #2d2d2d;
        }

        .PDFcontent .data-table table tr td {
            /* padding: 5px; */
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
                        @if(in_array('name', $print_choices))
                        <th>{{awtTrans('الاسم')}}</th>
                        @endif
                        @if(in_array('country', $print_choices))
                        <th>{{awtTrans('الدولة')}}</th>
                        @endif
                        @if(in_array('specialist', $print_choices))
                        <th>{{awtTrans('التخصص')}}</th>
                        @endif
                        @if(in_array('sub_specialist', $print_choices))
                        <th>{{awtTrans('التخصص الفرعي')}}</th>
                        @endif
                        @if(in_array('qualification', $print_choices))
                        <th>{{awtTrans('المؤهل الدراسي')}}</th>
                        @endif
                        @if(in_array('gender', $print_choices))
                      <th>  {{awtTrans('النوع')}} </th>
                      @endif
                        @if(in_array('languages', $print_choices))
                      <th>      {{awtTrans('اللغات التي يجيدها')}} </th>
                      @endif
                        @if(in_array('current_employer', $print_choices))
                      <th>      @lang('main.current_employer') </th>
                      @endif
                        @if(in_array('employer_address', $print_choices))
                      <th>      @lang('main.employer_address') </th>
                      @endif
                        @if(in_array('employer_phone', $print_choices))
                      <th>      @lang('main.employer_phone') </th>
                      @endif
                        @if(in_array('employer_email', $print_choices))
                      <th>      @lang('main.employer_email') </th>
                      @endif
                        @if(in_array('old_contracts', $print_choices))
                      <th>      {{awtTrans('سوابق التعاقدات مع الوكالة إن وجدت')}} </th>
                      @endif
                        @if(in_array('phone', $print_choices))
                      <th>      {{awtTrans('رقم الهاتف')}} </th>
                      @endif
                        @if(in_array('email', $print_choices))
                      <th>      {{awtTrans('البريد الإلكتروني')}} </th>
                      @endif
                        @if(in_array('status', $print_choices))
                      <th>      {{awtTrans('حالة الخبير')}} </th>
                      @endif
                        @if(in_array('delegate_country', $print_choices))
                      <th>      {{awtTrans('الدولة الموفد إليها حالياً')}} </th>
                      @endif
                        @if(in_array('delegate_org', $print_choices))
                      <th>      {{awtTrans('الجهة الموفد إليها حالياً')}} </th>
                      @endif
                        @if(in_array('contract_date', $print_choices))
                      <th>      {{awtTrans('بداية التعاقد')}} </th>
                      @endif
                        @if(in_array('end_date', $print_choices))
                      <th>      {{awtTrans('نهاية التعاقد')}} </th>
                      @endif
                        @if(in_array('cost', $print_choices))
                      <th>      {{awtTrans('التكلفة السنوية')}} </th>
                      @endif
                        @if(in_array('notes', $print_choices))
                      <th>     {{ awtTrans('ملاحظات')}}  </th>
                      @endif

                    </thead>
                    <tbody>
                        @php($t=1)
                    @foreach($data as $model)

                    <tr>
                        <td>{{$t}}</td>
                        @php($t++)
                        @if(in_array('name', $print_choices))

                        <td>{{$model->name}}</td>
                        @endif
                        @if(in_array('country', $print_choices))
                        <td>{{getCountry($model->country)}}</td>
                        @endif
                        @if(in_array('specialist', $print_choices))
                        <td>{{$model->specialist}}</td>
                        @endif
                        @if(in_array('sub_specialist', $print_choices))
                        <td>{{$model->sub_specialist}}</td>
                        @endif
                        @if(in_array('qualification', $print_choices))
                        <td>{{$model->qualification}}</td>
                        @endif
                        @if(in_array('gender', $print_choices))
                      <td>  {{awtTrans($model->gender)}}</td>
                      @endif
                        @if(in_array('languages', $print_choices))
                      <td>
                        @foreach(unserialize($model->languages) as $row)
                            {{$row}}<br>
                        @endforeach
                        </td>
                        @endif
                        @if(in_array('current_employer', $print_choices))
                         <td>  {{$model->current_employer}}</td>
                         @endif
                        @if(in_array('employer_address', $print_choices))
                        <td>{{$model->employer_address}}</td>
                        @endif
                        @if(in_array('employer_phone', $print_choices))
                        <td>
                            @foreach(unserialize($model->employer_phone) as $row)
                                {{$row}}<br>
                            @endforeach
                        </td>
                        @endif
                        @if(in_array('employer_email', $print_choices))
                        <td>{{$model->employer_email}}</td>
                        @endif
                        @if(in_array('old_contracts', $print_choices))
                        <td>{{$model->old_contracts}}</td>
                        @endif
                        @if(in_array('phone', $print_choices))
                        <td>
                            @foreach(unserialize($model->phone) as $row)
                                {{$row}}<br/>
                            @endforeach
                        </td>
                        @endif
                        @if(in_array('email', $print_choices))
                        <td>{{$model->email}}</td>
                        @endif
                        @if(in_array('status', $print_choices))
                        <td>
                            @if($model->status=='current')
                                <p>{{awtTrans("خبير حالي")}}</p>
                            @elseif($model->status=='old')
                                <p>{{awtTrans("خبير سابق")}}</p>
                            @else
                                <p>{{ awtTrans("مرشح للعمل")}}</p>
                            @endif
                        </td>
                        @endif
                        @if(in_array('delegate_country', $print_choices))
                        <td>{{getCountry($model->delegate_country)}}</td>
                        @endif
                        @if(in_array('delegate_org', $print_choices))
                        <td>{{$model->delegate_org}}</td>
                        @endif
                        @if(in_array('contract_date', $print_choices))
                        <td>{{$model->contract_date->format('Y-m-d')}}</td>
                        @endif
                        @if(in_array('end_date', $print_choices))
                       <td> {{$model->end_date->format('Y-m-d')}}</td>
                       @endif
                       @if(in_array('cost', $print_choices))
                        <td>{{$model->cost}} $</td>
                        @endif
                        @if(in_array('notes', $print_choices))
                        <td>{{$model->notes}} </td>
                        @endif
                    </tr>






                    @endforeach

                    </tbody>

                </table>


            </div>


        </div>



</body>

</html>

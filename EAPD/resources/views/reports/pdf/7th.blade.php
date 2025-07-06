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
            @if(!empty($model))

                <div class="page" style="text-align: center">
                    <div class="main-title">
                        <h2>{{$title}}</h2>
                    </div>
                    <div class="table-content">
                        <div class="page-title">
                            <h3 class="weight500 d-block pr-3 mb-5"> {{awtTrans('بيانات الدورة')}}</h3>
                        </div>
                    </div>
                    <table class="mytable">


                        <tbody>
                        <tr>
                            @if (in_array('course_name', $print_choices))
                            <th>{{awtTrans('اسم الدورة التدريبية')}}</th>
                            <td>{{$model->name_ar}}</td>


                            @endif
                            @if (in_array('course_type', $print_choices))
                            <th>{{awtTrans('نوع الدورة')}}</th>
                            <td>{{awtTrans($model->type_id)}}</td>


                            @endif
                        </tr>
                        <tr>
                            @if (in_array('course_natural', $print_choices))
                            <th>{{awtTrans('طبيعة الدورة')}}</th>
                            <td>{{$model->natural->name_ar??'-'}}</td>


                            @endif
                            @if (in_array('course_field', $print_choices))
                            <th>{{awtTrans('مجال التعاون')}}</th>
                            <td>{{$model->field->name_ar}}</td>


                            @endif
                        </tr>
                        <tr>
                            @if (in_array('course_trainees', $print_choices))
                            <th>{{awtTrans('اسم منسق الدورة')}}</th>
                            <td>@foreach(unserialize($model->trainees) as $item)

                                <?php $t = \App\Models\CourseTrianee::where('id', $item)->first(); ?>
                                @if(!empty($t))
                                    <p><a href="">{{$t->name_ar}}</a></p>
                                @endif
                            @endforeach</td>

                            @endif
                            @if (in_array('course_content', $print_choices))

                            <th>{{awtTrans('المحتوى')}}</th>
                            <td> {{$model->content}}</td>
                            @endif
                        </tr>
                         <tr>

                            @if (in_array('course_docs', $print_choices))
                            <th>{{awtTrans('وثائق ذات صلة')}}</th>
                            <td>@foreach(unserialize($model->documents) as $file)
                                <a href="{{asset('uploads/course/'.$file)}}" target="_blank" class="d-block"><i
                                            class="fa fa-file-pdf-o"></i> {{awtTrans('تحميل الملف')}}</a>
                            @endforeach</td>

                            @endif

                            @if (in_array('course_start', $print_choices))

                            <th>{{awtTrans('تاريخ البدء')}}</th>
                            <td> {{$model->start_date->format('Y-m-d')}}</td>
                            @endif
                        </tr>
                            <tr>
                            @if (in_array('course_end', $print_choices))
                            <th>{{awtTrans('تاريخ الإنتهاء')}}</th>
                            <td>{{$model->end_date->format('Y-m-d')}}</td>
                            @endif

                            @if (in_array('course_location', $print_choices))
                            <th>{{awtTrans('مكان الإنعقاد')}}</th>
                            <td>{{$model->location}}</td>
                            @endif
                        </tr>
                            <tr>
                            @if (in_array('course_org', $print_choices))
                            <th>{{awtTrans('الجهة المنظمة')}}</th>
                            <td>{{$model->organization->name_ar}}</td>
                            @endif

                            @if (in_array('course_apps', $print_choices))
                            <th>{{awtTrans('إجمالي عدد المتدربين')}}</th>

                            <td>  {{$model->applications->count()}}</td>
                            @endif
                        </tr>
                               <tr>
                            @if (in_array('course_female', $print_choices))
                            <th>{{awtTrans('عدد المتدربات')}}</th>
                            <td>  {{$model->applications()->where('gender','female')->count()}}</td>
                            @endif
                            @if (in_array('course_cost', $print_choices))
                            <th>{{awtTrans('التكلفة الإجمالية')}}</th>
                            <td>     {{($model->cost*$model->applications->count())}}</td>
                            @endif
                            @if (in_array('course_notes', $print_choices))
                            <th>{{awtTrans('ملاحظات أخرى')}}</th>
                            <td>{{$model->notes}}</td>
                            @endif
                        </tr>

                        </tbody>
                    </table>
                </div>
            @endif
            @if (in_array('course_countries', $print_choices))

                <div class="page" style="text-align: center">


                    <div class="table-content">
                        <div class="page-title">
                            <h3 class="weight500 d-block pr-3 mb-5"> {{awtTrans('الدول المشاركة')}}</h3>
                        </div>
                    </div>
                    <table class="mytable">

                        <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>{{awtTrans('الاسم')}}</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php($ic=1)

                        @foreach(unserialize($model->countries) as $item)
                            <tr>
                                <td>{{$ic}} </td>
                                @php($ic++)
                                <td>{{getCountry($item)}}</td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                </div>
                @endif
                @if (in_array('course_app', $print_choices))
                <div class="page" style="text-align: center">

                    <div class="table-content">
                        <div class="page-title">
                            <h3 class="weight500 d-block pr-3 mb-5">{{awtTrans('بيانات المشاركين في الدورة')}}</h3>
                        </div>
                    </div>
                    <table class="mytable">

                        <thead class="thead-light">
                        <tr>
                            <th>#</th>
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

                        <tbody>
                        @php($ii=1)

                        @foreach($model->applications as $app)
                            <tr>
                                <td>{{$ii}}</td>
                                @php($ii++)
                                <td><a href="{{route('applicants.index',[$app->id])}}">{{$app->name()}}</a></td>
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
                @endif


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

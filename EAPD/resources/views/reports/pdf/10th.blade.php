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

        .mytable   td, th {
            border: 1px solid #444444;
            text-align: center;
            padding: 2px;
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
                        <h3 class="text-center weight500">{{getCountry($country)}}</h3>
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
                            {{--<h3 class="weight500 d-block pr-3 mb-5">1- {{awtTrans('بيانات دورات الوكالة')}}</h3>--}}
                        </div>
                    </div>
                    <table class="mytable">

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
                            <th>#</th>
                            <th>{{awtTrans('اسم الدورة')}}</th>
                            <th>{{awtTrans('تاريخ الدورة')}}</th>
                            <th>{{awtTrans('عدد المتدربين')}}</th>
                            @if(getRequest('cost')!='false')
                            <th>{{awtTrans('التكلفة الإجمالية')}}</th>
                            @endif
                        </tr>

                        </thead>
                        {{--<tfoot class="thead-light">--}}
                        {{----}}

                        {{--</tfoot>--}}
                        <tbody>
                        @php($m=0)
                        @foreach($courses as $course)
                            @php($m++)
                            <tr>
                                <td>{{$m}}</td>
                                <td>{{$course->name_ar}}</td>
                                <td>{{$course->start_date->format('d/m/Y')}}
                                    - {{$course->end_date->format('d/m/Y')}}</td>
                            @if ($country=='all')
                            <td>{{$course->applications()->count()}}</td>
                            @else

                                <td>{{$course->applications()->where('nationality','LIKE','%'.$country.'%')->count()}}</td>
                            @endif

								 @if(getRequest('cost')!='false')

                                 @if ($country=='all')
                                 <td>{{$course->applications()->count()*$course->cost}}</td>
                                 @else

                                 <td>{{$course->applications()->where('nationality','LIKE','%'.$country.'%')->count()*$course->cost}}</td>
                                 @endif
									{{-- <td>{{$course->applications()->where('nationality','LIKE','%'.$country.'%')->count()*$course->cost}}</td> --}}
								@endif
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="3">{{awtTrans('عدد الدورات')}}</th>
                            <td colspan="3">{{$mainDetails['total']}}</td>
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

                        </tbody>
                    </table>
                </div>

        </td>
    </tr>
    <tr>
        @if(getRequest('apps')=='true')
        <tr>
            <td>

                    <div class="page" style="text-align: center">

                        <table class="mytable">

                            <thead class="thead-light">
                            <tr>
                                <th colspan="8" style="text-align:center">{{awtTrans('بيانات المشاركين')}} </th>
                            </tr>
                        @foreach($courses as $course)
                        <tr>
                            <td colspan="6">{{$course->name_ar}}</td>
                            <td colspan="2">{{$course->start_date->format('d/m/Y')}}
                                - {{$course->end_date->format('d/m/Y')}}</td>
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

                            <tbody>
                                @if ($country ='all')
                                @php($coursesApp=$course->applications()->get())
                                    @else
                                    @php($coursesApp= $course->applications()->where('nationality', $country)->get())
                                @endif
                            @foreach($coursesApp as $app)

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

                            @endforeach

                            </tbody>
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
                        </table>
                    </div>

            </td>
        </tr>
        @endif
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

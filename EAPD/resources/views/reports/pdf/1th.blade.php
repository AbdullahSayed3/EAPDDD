<!DOCTYPE html>
<html>

<head>
    <style>
        /* Styles go here */

        .page-header,
        .page-header-space {
            height: 150px;
        }

        .page-footer,
        .page-footer-space {
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
            border-top: 1px solid #6c345e;
            /* for demo */
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

        .mytable td,
        th {
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

<body onload="  window.print()" dir="rtl" class="PDFcontent">

    <div class="page-header header" style="text-align: right;">
        <div style="padding-right: 30px; padding-top: 10px; ">
            <img src="{{ asset('pdf/logo-' . $lang . '.png') }}" class="left">
            <img src="{{ asset('pdf/m-logo-' . $lang . '.png') }}" class="right">
        </div>


    </div>


    <table>

        <thead>
            <tr>
                <td>
                    <!--place holder for the fixed-position header-->
                    <div class="page-header-space"></div>
                    {{-- <div class="page-header-space"></div> --}}
                </td>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>

                    <div class="page" style="text-align: center">
                        <div class="main-title">
                            <h2>{{ $title }}</h2>
                            <h3 class="text-center weight500">{{ getCountry($country) }}</h3>
                            @if (isset($_GET['date_from']) &&
                                $_GET['date_from'] != null &&
                                (isset($_GET['date_to']) && $_GET['date_to'] != null))
                                <h4 class="text-center weight500">
                                    {{ awtTrans('(في الفترة الزمنية') }}


                                    {{ awtTrans('من') }}
                                    {{ $_GET['date_from'] }}

                                    {{ awtTrans('إلى ') }}
                                    {{ $_GET['date_to'] }}
                                    )
                                </h4>
                            @endif
                        </div>
                        @if (in_array('aids', $print_choices))
                            <div class="table-content">
                                <div class="page-title">
                                    <h3 class="weight500 d-block pr-3 mb-5"> {{ awtTrans('المنح والمعونات المقدمة ') }}</h3>
                                </div>
                            </div>
                            <table class="mytable">

                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ awtTrans('الدولة') }}</th>
                                        <th>{{ awtTrans('النوع') }}</th>
                                        <th>{{ awtTrans('تاريخ الشحن') }}</th>
                                        <th>{{ awtTrans('قيمة المعونة') }}</th>
                                    </tr>

                                </thead>
                                {{-- <tfoot class="thead-light"> --}}
                                {{--  --}}

                                {{-- </tfoot> --}}
                                <tbody>
                                    @php($m = 0)
                                    @foreach ($aids as $aid)
                                        @php($m++)
                                        <tr>
                                            <td>{{ $m }}</td>
                                            <td>{{ getCountry(getRequest('country')) }}</td>
                                            <td><a
                                                    href="{{ route('aids.show', [$aid->id]) }}">{{ $aid->type->name_ar }}</a>
                                            </td>
                                            <td>{{ $aid->ship_date->format('Y/m/d') }}</td>
                                            <td>{{ $aid->cost }} {{ awtTrans('جنيه') }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th colspan="2">{{ awtTrans('الإجمالى') }}</th>
                                        <td colspan="3">{{ $costs['aids'] }} {{ awtTrans('جنيه مصرى') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                    @endif

                    @if (in_array('participants_data', $print_choices))
                        <div class="page" style="text-align: center">
                            <div class="table-content">
                                <div class="page-title">
                                    <h3 class="weight500 d-block pr-3 mb-5">
                                        {{ awtTrans('بيانات المشاركة بدورات الوكالة') }}
                                    </h3>
                                </div>
                            </div>
                            <table class="mytable">

                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ awtTrans('اجمالى عدد الدورات') }}</th>
                                        <td>{{ count($courses) }}</td>
                                        <th>{{ awtTrans('إجمالى عدد المتدربين') }}</th>
                                        <td colspan="2">{{ $mainDetails['total_apps'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ awtTrans('عدد الدورات النوعية') }}</th>
                                        <td>{{ $mainDetails['total_city'] }}</td>
                                        <th>{{ awtTrans('عدد دورات الجيش والشرطة') }}</th>
                                        <td colspan="2">
                                            {{ $mainDetails['total_army'] + $mainDetails['total_police'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>{{ awtTrans('رقم الدورة') }}</th>
                                        <th>{{ awtTrans('الدورة التدريبية') }}</th>
                                        @if (in_array('course_start', $print_choices))
                                            <th>{{ awtTrans('تاريخ البدء') }}</th>
                                        @endif
                                        @if (in_array('course_end', $print_choices))
                                            <th>{{ awtTrans('تاريخ الإنتهاء') }}</th>
                                        @endif

                                        <th>{{ awtTrans('جهة التدريب') }}</th>
                                        <th>{{ awtTrans('عدد المتدربين') }}</th>
                                        <th>{{ awtTrans('المتدربات النساء') }}</th>
                                    </tr>

                                </thead>
                                {{-- <tfoot class="thead-light"> --}}
                                {{--  --}}

                                {{-- </tfoot> --}}
                                <tbody>
                                    @php($ii = 1)

                                    @foreach ($courses as $course)
                                        <tr>
                                            <td>{{ $ii }}</td>
                                            @php($ii++)
                                            <td><a
                                                    href="{{ route('courses.show', [$course->id]) }}">{{ $course->name_ar }}</a>
                                            </td>
                                            @if (in_array('course_start', $print_choices))
                                                <td>{{ $course->start_date->format('Y-m-d') }}</td>
                                            @endif
                                            @if (in_array('course_end', $print_choices))
                                                <td>{{ $course->end_date->format('Y-m-d') }}</td>
                                            @endif

                                            <td>{{ $course->organization->name }}</td>
                                            <td>{{ $course->applications()->where('country', 'LIKE', '%' . $country . '%')->count() }}
                                            </td>
                                            <td>{{ $course->applications()->where('country', 'LIKE', '%' . $country . '%')->where('gender', 'female')->count() }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    @endif

                    @if (in_array('expert', $print_choices))
                        <div class="page" style="text-align: center">
                            <div class="table-content">
                                <div class="page-title">
                                    <h3 class="weight500 d-block pr-3"> {{ awtTrans('الخبراء') }} </h3>
                                </div>
                            </div>
                            <table class="mytable">

                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ awtTrans('الاسم') }}</th>
                                        <th>{{ awtTrans('التخصص') }}</th>
                                        <th>{{ awtTrans('الجهه الموفد اليها') }}</th>
                                    </tr>

                                </thead>
                                {{-- <tfoot class="thead-light"> --}}
                                {{--  --}}

                                {{-- </tfoot> --}}
                                <tbody>
                                    @php($ii = 1)

                                    @foreach ($experts as $row)
                                        <tr>
                                            <td>{{ $ii }}</td>
                                            @php($ii++)
                                            <td><a
                                                    href="{{ route('experts.show', [$row->id]) }}">{{ $row->name }}</a>
                                            </td>
                                            <td>{{ $row->specialist }}</td>
                                            <td>{{ $row->delegate_org }}</td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <th colspan="2">{{ awtTrans('العدد') }}</th>
                                        <td colspan="2">{{ count($experts) }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">{{ awtTrans('التكلفة الإجمالية') }}</th>
                                        <td colspan="2">{{ $costs['experts'] }} {{ awtTrans('جنيه مصري') }}</td>
                                    </tr>
                            </table>
                        </div>
                    @endif

                    @if (in_array('scholarships', $print_choices))
                        <div class="page" style="text-align: center">
                            <div class="table-content">
                                <div class="page-title">
                                    <h3 class="weight500 d-block pr-3"> {{ awtTrans('المنح الدراسية') }}</h3>
                                </div>
                            </div>
                            <table class="mytable">

                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ awtTrans('البرنامج / المنحة') }}</th>
                                        <th>{{ awtTrans('الجهة') }}</th>
                                        <th>{{ awtTrans('الدول المشاركة') }}</th>
                                        <th>{{ awtTrans('مجال الدراسة') }}</th>
                                        <th>{{ awtTrans('عدد الدراسين') }}</th>
                                    </tr>

                                </thead>
                                {{-- <tfoot class="thead-light"> --}}
                                {{--  --}}

                                {{-- </tfoot> --}}
                                <tbody>
                                    @php($s=1)
                                    @foreach ($scholarships as $scholarship)
                                        <tr>
                                            <td>{{ $s}}</td>
                                    @php($s++)

                                            <td><a
                                                    href="{{ route('scholarships.show', [$scholarship->id]) }}">{{ $scholarship->program }}</a>
                                            </td>
                                            <td>{{ $scholarship->owner }}</td>
                                            <td>  @foreach (unserialize($scholarship->participants) as $row)
                                                {{ getCountry($row) }}<br/>
                                            @endforeach
                                        </td>

                                            <td>{{ $scholarship->field->name_ar  }}</td>
                                            <td>{{ $scholarship->learners->count()  }}</td>
                                        </tr>
                                    @endforeach


                                </tbody>


                            </table>
                        </div>
                    @endif

                    @if (in_array('cost', $print_choices))
                        <div class="page" style="text-align: center">
                            <div class="table-content">
                                <div class="page-title">
                                    <h3 class="weight500 d-block pr-3">
                                        {{ awtTrans('التكلفة التقديرية لقيمة الدعم المقدم') }} </h3>
                                </div>
                            </div>
                            <table class="mytable">

                                <thead class="thead-light">
                                    <tr>
                                        <th colspan="2">{{ awtTrans('المنح والمعونات') }}</th>
                                        <td colspan="2">{{ $costs['aids'] }} {{ awtTrans('جنيه مصري ') }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">{{ awtTrans('الدورات التدريبية') }}</th>
                                        <td colspan="2">{{ $costs['courses'] }} {{ awtTrans('جنيه مصري ') }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">{{ awtTrans('الخبراء') }}</th>
                                        <td colspan="2">{{ $costs['experts'] }} {{ awtTrans('جنيه مصري ') }}</td>
                                    </tr>

                                    <tr>
                                        <th colspan="2">{{ awtTrans('التكلفة الإجمالية') }}</th>
                                        <td colspan="2">{{ $costs['total'] }} {{ awtTrans('جنيه مصري ') }}</td>
                                    </tr>
                                </thead>
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

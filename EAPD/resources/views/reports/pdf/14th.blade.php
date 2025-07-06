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

<body onload="window.print()" dir="rtl" class="PDFcontent">

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
                            </div>

                            <div class="table-content">
                                <div class="page-title">
                                    {{-- <h3 class="weight500 d-block pr-3 mb-5">1- {{awtTrans('أعمال الوكالة سنويا')}}</h3> --}}
                                </div>
                            </div>
                        @endif
                        <table class="mytable">
                            <thead class="thead-light">

                                <tr>

                                    <th>{{ awtTrans('عدد الدورات التدريبية') }}</th>
                                    <td>{{ isset($mainData['total_courses']) ? $mainData['total_courses'] : 0 }}
                                    <th>{{ awtTrans('عدد الدورات المدنية') }}</th>
                                    <td>{{ isset($mainData['total_citizen']) ? $mainData['total_citizen'] : 0 }}
                                </tr>

                                <tr>
                                    <th>{{ awtTrans('عدد دورات الجيش') }}</th>
                                    <td>{{ isset($mainData['total_army']) ? $mainData['total_army'] : 0 }}
                                    <th>{{ awtTrans('عدد دورات الشرطة') }}</th>
                                    <td>{{ isset($mainData['total_police']) ? $mainData['total_police'] : 0 }}
                                </tr>
                                <tr>
                                    <th>{{ awtTrans('عدد المتدربين') }}</th>
                                    <td>{{ isset($mainData['total_apps']) ? $mainData['total_apps'] : 0 }}
                                    <th>{{ awtTrans('عدد المتدربات') }}</th>
                                    <td>{{ isset($mainData['total_female']) ? $mainData['total_female'] : 0 }}
                                </tr>
                                <tr>
                                    <th>{{ awtTrans('عدد المنح والمعونات') }}</th>
                                    <td>{{ isset($mainData['total_aids']) ? $mainData['total_aids'] : 0 }}
                                    <th>{{ awtTrans('عدد الخبراء') }}</th>
                                    <td>{{ isset($mainData['total_experts']) ? $mainData['total_experts'] : 0 }}
                                </tr>
                                <tr>
                                    <th>{{awtTrans('عدد المنح الدراسية')}}</th>
                                    <td>{{ $mainData['total_scholarships']}}</td>
                                    <th>{{ awtTrans('عدد الدول المستفيدة') }}</th>

                                    <td>{{ count(array_unique($countries)) }}</td>
                                </tr>

                                @if (getRequest('cost') != null)
                                    <tr style="height: 50px; border: none">
                                        <th style="border: unset" colspan="2"></th>
                                        <th style="border: unset" colspan="2"></th>
                                    </tr>
                                    <tr>
                                        <th colspan="2">{{ awtTrans('التكلفة الإجمالية للدورات التدريبية') }}
                                        </th>

                                        <td colspan="2">
                                            {{ isset($mainData['total_cost_courses_year']) ? $mainData['total_cost_courses_year'] : 0 }}
                                            {{ awtTrans('جنيه مصرى') }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">{{ awtTrans('التكلفة الإجمالية للمنح والمعونات') }}</th>

                                        <td colspan="2">
                                            {{ isset($mainData['total_cost_aids_year']) ? $mainData['total_cost_aids_year'] : 0 }}
                                            {{ awtTrans('جنيه مصرى') }}</td>

                                    </tr>

                                    <tr>
                                        <th colspan="2">{{ awtTrans('التكلفة الإجمالية للخبراء') }}</th>
                                        <td colspan="2">
                                            {{ isset($mainData['total_cost_experts_year']) ? $mainData['total_cost_experts_year'] : 0 }}
                                            {{ awtTrans('جنيه مصرى') }}</td>

                                    </tr>
                                    <tr>
                                        <th colspan="2">{{awtTrans('التكلفة الإجمالية للمنح الدراسية')}}</th>
                                        <td colspan="2">{{  isset($mainData['total_sc_cost']) ? $mainData['total_sc_cost'] : 0}}

                                            {{awtTrans('جنيه مصرى')}}</td>
                                    </tr>
                                @endif
                            </thead>

                        </table>
                    </div>






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

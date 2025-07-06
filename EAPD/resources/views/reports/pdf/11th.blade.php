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
                            <h3 class="text-center weight500">{{ getCountry($dcountry) }}</h3>
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
                        <div class="table-content">
                            <div class="page-title">
                                {{-- <h3 class="weight500 d-block pr-3 mb-5">1- {{awtTrans('بيانات الخبراء')}}</h3> --}}
                            </div>
                        </div>
                        <table class="mytable">

                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    @if (in_array('delegate_country', $print_choices))
                                        <th>{{ awtTrans('الدولة') }}</th>
                                    @endif

                                    @if (in_array('name', $print_choices))
                                        <th>{{ awtTrans('الاسم') }}</th>
                                    @endif

                                    @if (in_array('specialist', $print_choices))
                                        <th>{{ awtTrans('التخصص') }}</th>
                                    @endif
                                    @if (in_array('status', $print_choices))
                                        <th>{{ awtTrans('حالة الخبير') }}</th>
                                    @endif

                                    @if (in_array('contract_date', $print_choices))
                                        <th>{{ awtTrans('بداية التعاقد') }}</th>
                                    @endif

                                    @if (in_array('end_date', $print_choices))
                                        <th>{{ awtTrans('نهاية التعاقد') }}</th>
                                    @endif

                                    @if (in_array('passport_number', $print_choices))
                                        <th>{{ awtTrans('رقم جواز السفر') }}</th>
                                    @endif

                                    @if (in_array('delegate_org', $print_choices))
                                        <th>{{ awtTrans('الجهه الموفد اليها') }}</th>
                                    @endif

                                    @if (in_array('cost', $print_choices))
                                        @if (getRequest('cost') != 'false')
                                            <th>{{ awtTrans('التكلفة السنوية') }}</th>
                                        @endif
                                    @endif



                                </tr>
                            </thead>
                            <tbody>
                                @php($ii = 1)

                                @foreach ($experts as $row)
                                    <tr>
                                        <td>{{ $ii }}</td>
                                        @php($ii++)
                                        @if (in_array('delegate_country', $print_choices))
                                            <td>{{ getCountry($row->delegate_country) }}</td>
                                        @endif
                                        @if (in_array('name', $print_choices))
                                            <td><a
                                                    href="{{ route('experts.show', [$row->id]) }}">{{ $row->name }}</a>
                                            </td>
                                        @endif
                                        @if (in_array('specialist', $print_choices))
                                            <td>{{ $row->specialist }}</td>
                                        @endif
                                        @if (in_array('status', $print_choices))
                                            @if ($row->status == 'current')
                                                <td>{{ awtTrans('خبير حالي') }}</td>
                                            @elseif($row->status == 'old')
                                                <td>{{ awtTrans('خبير سابق') }}</td>
                                            @else
                                                <td>{{ awtTrans('مرشح للعمل') }}</td>
                                            @endif
                                        @endif
                                        @if (in_array('contract_date', $print_choices))
                                            <td>{{ is_null($row->contract_date) ? '#' : $row->contract_date->format('d/m/Y') }}
                                            </td>
                                        @endif
                                        @if (in_array('end_date', $print_choices))
                                            <td>{{ is_null($row->end_date) ? '#' : $row->end_date->format('d/m/Y') }}</td>
                                        @endif

                                        @if (in_array('passport_number', $print_choices))
                                            <td>{{ $row->passport_number }}</td>
                                        @endif
                                        @if (in_array('delegate_org', $print_choices))
                                            <td>{{ $row->delegate_org }}</td>
                                        @endif
                                        @if (in_array('cost', $print_choices))
                                            @if (getRequest('cost') != 'false')
                                                <td>{{ $row->cost }} {{awtTrans('جنيه مصرى')}}</td>
                                            @endif
                                        @endif
                                    </tr>
                                @endforeach
                                <tr>
                                    @if (in_array('count', $print_choices))
                                        <th colspan="3">{{ awtTrans(' العدد الإجمالي') }}</th>
                                        <td colspan="6">{{ count($experts) }}</td>
                                </tr>
                                @endif

                                @if (in_array('total_cost', $print_choices))

                                    @if (getRequest('cost') != 'false')
                                        <tr>
                                            <th colspan="3">{{ awtTrans(' التكلفة الإجمالية') }}</th>
                                            <td colspan="6">{{ $costs['experts']  }} {{awtTrans('جنيه مصرى')}}</td>
                                        </tr>
                                    @endif
                                @endif

                            </tbody>
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

<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" dir="{{ App::getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="الوكالة المصرية للشراكة من أجل التنمية">
    <meta name="author" content="EAPD">

    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">

    <title>الوكالة المصرية للشراكة من أجل التنمية</title>

    <style>
        @page {
            size: A4 portrait;
            margin: 1cm;
        }

        html,
        body {
            font-family: 'Cairo', Arial, sans-serif;
            margin: 0;
            padding: 0;
            direction: {{ App::getLocale() == 'ar' ? 'rtl' : 'ltr' }};
            font-size: 12px;
            line-height: 1.5;
            background: white;
        }

        .print-container {
            max-width: 100%;
            margin: 0 auto;
            padding: 10px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #0B0B21;
        }

        .header img {
            max-height: 60px;
        }

        .main-title {
            text-align: center;
            margin: 20px 0;
        }

        .main-title h2 {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
            color: #0B0B21;
            padding: 5px 15px;
            border-bottom: 2px solid #0B0B21;
            display: inline-block;
        }

        .report-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            font-size: 11px;
        }

        .data-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .data-table table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }

        .data-table table th {
            background-color: #f3f3f3;
            color: #0B0B21;
            font-weight: bold;
            padding: 8px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 11px;
        }

        .data-table table td {
            padding: 6px 8px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 10px;
            vertical-align: middle;
        }

        .data-table table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        @media print {
            .header img {
                max-height: 50px;
            }

            .print-header {
                display: block !important;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="print-container">
        <div class="header">
            <img src="{{ asset('assets/img/top-logo.png') }}" alt="EAPD Logo" class="right-logo">
            <img src="{{ asset('pdf/m-logo-' . $lang . '.png') }}" alt="Ministry Logo" class="left-logo">
        </div>

        <div class="main-title">
            <h2>{{ $title }}</h2>
        </div>

        <div class="report-info">
            <div class="date">{{ __('تاريخ التقرير') }}: {{ date('Y-m-d') }}</div>
            <div class="time">{{ __('وقت الإنشاء') }}: {{ date('H:i') }}</div>
        </div>

        <div class="data-table">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        {{-- @foreach ($print_choices as $key => $value)
                            <th>{{ $key }}</th>
                        @endforeach --}}
                        <th>{{awtTrans('course_name')}}</th>
                        <th>{{awtTrans('Training Course Nature')}}</th>
                        <th>{{awtTrans('الجهات المنظمه الدورات التدريبيه')}}</th>
                        <th>{{awtTrans('تاريخ البدء')}}</th>
                        <th>{{awtTrans('تاريخ الانتهاء')}}</th>
                        <th>{{awtTrans('عدد الدورات المدنية')}}</th>
                        <th>{{awtTrans('المدن')}}</th>
                        <th>{{awtTrans('المجموع')}}</th>
                        <th>{{awtTrans('المجموع')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $model)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            @foreach ($print_choices as $key => $value)
                                <td>
                                    @if ($value == 'trainees')
                                        @if (is_string($model->trainees))
                                            @foreach (unserialize($model->trainees) as $row)
                                                @php($m = \App\Models\CourseTrianee::find($row))
                                                {{ $m->name_ar ?? '-' }}<br />
                                            @endforeach
                                        @else
                                            -
                                        @endif
                                    @elseif($value == 'name_ar')
                                        {{ $model->name_ar ?? '-' }}
                                    @elseif($value == 'type_id')
                                        {{ $model->natural->name_ar ?? '-' }}
                                    @elseif($value == 'organization_id')
                                        {{ $model->organization->name ?? '-' }}
                                    @elseif($value == 'start_date')
                                        {{ $model->start_date ? $model->start_date->format('Y-m-d') : '-' }}
                                    @elseif($value == 'end_date')
                                        {{ $model->end_date ? $model->end_date->format('Y-m-d') : '-' }}
                                    @elseif($value == 'inv_countries')
                                        {{ count($model->applications->groupBy('country')) }}
                                    @elseif($value == 'countries')
                                        @if (is_string($model->countries))
                                            {{ count(unserialize($model->countries)) }}
                                        @else
                                            {{ is_array($model->countries) ? count($model->countries) : '-' }}
                                        @endif
                                    @elseif($value == 'total_app')
                                        {{ $model->applications()->where('wait_list', 'false')->count() }}
                                    @elseif($value == 'total_app_fem')
                                        {{ $model->applications()->where('wait_list', 'false')->where('gender', 'female')->count() }}
                                    @else
                                        {{ $model->$value ?? '-' }}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ __('الوكالة المصرية للشراكة من أجل التنمية') }}</p>
        </div>
    </div>
</body>

</html>

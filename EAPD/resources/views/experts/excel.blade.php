<table>
    <thead>
        <tr>
            <th>#</th>
            <th>{{ awtTrans('الدولة') }}</th>
            <th>{{ awtTrans('الاسم') }}</th>
            <th>{{ awtTrans('المؤهل الدراسي') }}</th>
            <th>{{ awtTrans('التخصص') }}</th>
            <th>{{ awtTrans('التخصص الفرعي') }}</th>
            <th>{{ awtTrans('النوع') }}</th>
            <th>{{ awtTrans('اللغات التي يجيدها') }}</th>
            <th>@lang('main.current_employer')</th>
            <th>@lang('main.employer_address')</th>
            <th>@lang('main.employer_phone')</th>
            <th>@lang('main.employer_email')</th>
            <th>{{ awtTrans('رقم الهاتف') }}</th>
            <th>{{ awtTrans('البريد الإلكتروني') }}</th>
            <th>{{ awtTrans('بداية التعاقد') }}</th>
            <th>{{ awtTrans('نهاية التعاقد') }}</th>
            <th>{{ awtTrans('رقم جواز السفر') }}</th>
            <th>{{ awtTrans('الدولة الموفد إليها حالياً') }}</th>
            <th>{{ awtTrans('الجهة الموفد إليها حالياً') }}</th>
            <th>{{ awtTrans('التكلفة السنوية') }}</th>
            <th>{{ awtTrans('حالة الخبير') }}</th>
        </tr>
    </thead>
    <tbody>
        @php($t = 1)
        @foreach ($data as $row)
            <tr>
                <td>{{ $t }}</td>
                @php($t++)
                <td>{{ getCountry($row->country) }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->qualification }}</td>
                <td>{{ $row->specialist }}</td>
                <td>{{ $row->sub_specialist }}</td>

                @if ($row->gender == 'male')
                    <td>{{ awtTrans('ذكر') }}</td>
                @elseif ($row->gender == 'female')
                    <td>{{ awtTrans('انثي') }}</td>
                @else
                    <td>{{ 'N/A' }}</td>
                @endif

                <td>
                    @foreach (unserialize($row->languages) as $m)
                        {{ $m }}-
                    @endforeach
                </td>
                <td>{{ $row->current_employer }}</td>
                <td>{{ $row->employer_address }}</td>
                <td>
                    @foreach (unserialize($row->employer_phone) as $m)
                        {{ $m }}-
                    @endforeach
                </td>
                <td>{{ $row->employer_email }}</td>
                <td>
                    @foreach (unserialize($row->phone) as $m)
                        {{ $m }}-
                    @endforeach
                </td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->contract_date->format('Y-m-d') }}</td>
                <td>{{ $row->end_date->format('Y-m-d') }}</td>
                <td>{{ $row->passport_number }}</td>
                <td>{{ getCountry($row->delegate_country) }}</td>
                <td>{{ $row->delegate_org }}</td>
                <td>{{ $row->cost }}</td>
                @if ($row->status == 'current')
                    <td>{{ awtTrans('خبير حالي') }}</td>
                @elseif($row->status == 'old')
                    <td>{{ awtTrans('خبير سابق') }}</td>
                @else
                    <td>{{ awtTrans('مرشح للعمل') }}</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>

@if (isset($print))
    <script>
        window.print();
    </script>
@endif

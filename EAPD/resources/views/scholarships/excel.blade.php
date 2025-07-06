<table>
    <thead>
        <tr>
            <th>#</th>
            <th>{{ awtTrans('البرنامج / المنحة') }}</th>
            <th>{{ awtTrans('الجهة') }}</th>
            <th>{{ awtTrans('مجال الدراسة') }}</th>
            <th> {{ awtTrans('عدد الدراسين') }}</th>
            <th>{{ awtTrans('الدول المشاركة') }}</th>
            <th>{{ awtTrans('تاريخ البدء') }}</th>
            <th>{{ awtTrans('تاريخ الإنتهاء') }}</th>
        </tr>
    </thead>
    <tbody>
        @php($t = 1)
        @foreach ($data as $row)
            <tr>
                <td>{{ $t }}</td>
                @php($t++)

                <td>{{ $row->program }}</td>
                <td>{{ $row->owner }}</td>
                <td>{{ $row->field->name_ar }}</td>
                <td>{{ $row->learners->count() }}</td>

                <td>
                    @foreach (unserialize($row->participants) as $country)
                        {{ getCountry($country) }}<br />
                    @endforeach
                </td>
                <td>{{ $row->start_date->format('Y-m-d') }}</td>
                <td>{{ $row->end_date->format('Y-m-d') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@if (isset($print))
    <script>
        window.print();
    </script>
@endif

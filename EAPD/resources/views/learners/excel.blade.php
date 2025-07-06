<table>
    <thead>
        <tr>
            <th>#</th>
            <th>{{ awtTrans('الاسم') }}</th>
            <th>{{ awtTrans('النوع') }}</th>
            <th>{{ awtTrans('الجنسيه') }}</th>
            <th>{{ awtTrans("البريد الالكتروني") }}</th>
            <th>{{ awtTrans('المنحة الحالية') }}</th>
            <th>{{ awtTrans('السن') }}</th>
        </tr>
    </thead>
    <tbody>
        @php($t = 1)
        @foreach ($data as $row)
            <tr>
                <td>{{ $t }}</td>
                @php($t++)

                <td>{{ $row->name() }}</td>
                <td>{{ $row->gender =='male' ? awtTrans('ذكر') : awtTrans('انثي')  }}</td>
                <td>{{ getCountry($row->nationality) }}</td>
                <td>{{ $row->email_address }}</td>
                <td>{{ $row->scholarship->program }}</td>
                @if(isset($row->birth_date))
                <td>
                        {{  $row->age() }}<br />
                </td>
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

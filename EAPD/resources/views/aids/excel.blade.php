<table>
    <thead>
        <tr>
            <th>#</th>
            <th>{{ awtTrans('name') }}</th>
            <th>{{ awtTrans('الدولة المستفيدة') }}</th>
            <th>{{ awtTrans('نوع المنحة') }}</th>
            <th>{{ awtTrans('تاريخ الشحن') }}</th>
            <th>{{ awtTrans('تاريخ الوصول') }}</th>
            <th>{{ awtTrans('القيمة (شاملة الشحن)') }}</th>
            <th>{{ awtTrans('رقم موافقة الوزير أو مجلس الإدارة') }}</th>
            <th>{{ awtTrans('الجهة المتلقية بالدولة') }}</th>
            <th>{{ awtTrans('بيانات المورد') }}</th>
            <th>{{ trans('main.content') }}</th>
            <th>{{ awtTrans('ملاحظات أخرى') }}</th>
        </tr>
    </thead>
    <tbody>
        @php($t = 1)
        @foreach ($data as $row)
            <tr>
                <td>{{ $t }}</td>
                @php($t++)

                <td>{{ $row['title_'.App::getLocale()]}}</td>
                <td>{{ getCountry($row->country_id) }}</td>
                <td>{{ $row->type->name_ar ??'-'}}</td>
                <td>{{ $row->ship_date ->format('Y-m-d') }}</td>
                <td>{{ $row->arrive_date ->format('Y-m-d') }}</td>
                <td> {{ number_format($row->cost, 2, '.', ',') }}</td>
                <td>{{ $row->minister_name }}</td>
                <td>{{ $row->country_org }}</td>
                <td>{{ $row->getSupp() }}</td>
                <td>{{$row['description_'.App::getLocale()]}}</td>
                <td>{{ $row->notes }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@if (isset($print))
    <script>
        window.print();
    </script>
@endif

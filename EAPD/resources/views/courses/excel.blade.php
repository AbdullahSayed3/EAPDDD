<table>
    <thead>
        <tr>
            <th>#</th>
            <th>{{ awtTrans('اسم الدورة التدريبية') }}</th>
            <th>{{ awtTrans('اسم منسق الدورة') }}</th>
            <th>{{ awtTrans('نوع الدورة') }}</th>
            <th>{{ awtTrans('مجال التعاون') }}</th>
            <th>{{ awtTrans('طبيعة الدورة') }}</th>
            <th>{{ awtTrans('الجهة المنظمة') }}</th>
            <th>{{ awtTrans('تاريخ البدء') }}</th>
            <th>{{ awtTrans('تاريخ الإنتهاء') }}</th>
            <th>{{ awtTrans('مكان الإنعقاد') }}</th>
            <th>{{ awtTrans('تكلفة الفرد') }}</th>
            <th>{{ awtTrans('الدول') }}</th>
            <th>{{ awtTrans('إجمالي عدد المتدربين') }}</th>
            <th>{{ awtTrans('عدد المتدربات') }}</th>
            <th>{{ awtTrans('التكلفة الإجمالية') }}</th>
            <th>{{ awtTrans('ملاحظات أخرى') }}</th>
        </tr>
    </thead>
    <tbody>
        @php($m = 1)
        @foreach ($data as $row)
            <tr>
                <td>{{ $m }}</td>
                @php($m++)
                <td>{{ $row->name_ar ?? '-' }}</td>

                {{-- Trainee Coordinator - now processed in the export class --}}
                <td>{{ $row->trainee_coordinator ?? '-' }}</td>

                {{-- Type name - from JOIN --}}
                <td>{{ $row->type_name ?? '-' }}</td>

                {{-- Field name - from JOIN --}}
                <td>{{ $row->field_name ?? '-' }}</td>

                {{-- Natural name - from JOIN --}}
                <td>{{ $row->natural_name ?? '-' }}</td>

                {{-- Organization name - from JOIN --}}
                <td>{{ $row->organization_name ?? '-' }}</td>

                {{-- Dates - handle as strings since they come from Query Builder --}}
                <td>{{ $row->start_date ? date('Y-m-d', strtotime($row->start_date)) : '-' }}</td>
                <td>{{ $row->end_date ? date('Y-m-d', strtotime($row->end_date)) : '-' }}</td>

                <td>{{ $row->location ?? '-' }}</td>
                <td>{{ $row->cost ?? 0 }}</td>

                {{-- Countries - now processed in the export class --}}
                <td>{{ $row->countries_list ?? '-' }}</td>

                {{-- Applications count - now processed in the export class --}}
                <td>{{ $row->total_applications ?? 0 }}</td>
                <td>{{ $row->female_applications ?? 0 }}</td>
                <td>{{ $row->total_cost ?? 0 }}</td>

                <td>{{ $row->notes ?? '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@if (isset($print))
    <script>
        window.print();
    </script>
@endif

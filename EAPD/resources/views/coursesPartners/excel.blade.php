<table>
    <thead>
        <tr>
            <th>id</th>
            <th>{{ awtTrans('اسم المركز / الشريك') }}</th>
            <th>{{ awtTrans('مجال العمل') }}</th>
            <th>{{ awtTrans('طبيعة الجهة') }}</th>
            <th>{{ awtTrans('العنوان') }}</th>
            <th>{{ awtTrans('اسم نقطة الاتصال') }}</th>
            <th>{{ awtTrans('التليفون') }}</th>
            <th>{{ awtTrans('البريد الالكتروني') }}</th>
            <th>{{ awtTrans('إجمالي عدد المتدربين') }}</th>
            <th> {{ awtTrans('عدد المتدربات') }}</th>
            <th> {{ awtTrans('عدد الدورات') }}</th>
            <th>{{ awtTrans('اسم اخر دورة	') }}</th>
            <th>{{ awtTrans('تاريخ اخر دورة	') }}</th>
            <th> {{ awtTrans('ملاحظات أخرى') }}</th>
        </tr>
    </thead>
    <tbody>
        @php($t = 1)
        @foreach ($data as $row)
            <tr>
                <td>{{ $t }}</td>
                @php($t++)
                <td>{{ $row->name }}</td>
                <td>{{ $row->field->name_ar }}</td>
                <td>{{ $row->natural->name_ar }}</td>
                <td>{{ $row->address }}</td>
                <td>{{ $row->contact_name }}</td>
                <td>{{ $row->contact_phone }}</td>
                <td>{{ $row->contact_email }}</td>

                <?php
                    $lastCourse = [
                        'name'=> '-',
                        'data'=> '-',

                    ];
                    $temp='';
                    $totalApp=0;
                    $totalfem=0;
                    foreach ($row->courses as $course) {
                        if ($course->start_date > $temp) {
                            $temp = $course->start_date;
                            $lastCourse['name'] = $course->name_ar;
                            $lastCourse['data'] = $course->start_date->format('Y-m-d');
                        }
                        $totalApp += $course
                            ->applications()
                            ->where('wait_list', 'false')
                            ->count();
                        $totalfem += $course
                            ->applications()
                            ->where('wait_list', 'false')
                            ->where('gender', 'female')
                            ->count();
                    }
                ?>
                <td> {{ $totalApp }}</td>
                <td> {{ $totalfem }}</td>
                <td>{{ $row->courses->count() }}</td>
                <td>{{ $lastCourse['name'] }}</td>
                <td>{{ $lastCourse['data'] }}</td>
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

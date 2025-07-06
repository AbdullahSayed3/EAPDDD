<table>
    <thead>
        <tr>
            <th>#</th>
            <th>{{ awtTrans('name_en') }}</th>
            <th>{{ awtTrans('name_ar') }}</th>
            <th>{{ awtTrans('name_fr') }}</th>
            <th>{{ awtTrans('اجمالي الدورات') }}</th>
            <th>{{ awtTrans('إجمالي عدد المتدربين') }}</th>
            <th>{{ awtTrans('عدد المتدربين الذكور') }}</th>
            <th>{{ awtTrans('عدد المتدربين الاناث') }}</th>
        </tr>
    </thead>
    <tbody>
        @php($t = 1)

        @foreach ($data as $row)
            <tr>

                <td>{{ $t }}</td>
                @php($t++)
                <td>{{ $row['name_en'] }}</td>
                <td>{{ $row['name_ar'] }}</td>
                <td>{{ $row['name_fr'] }}</td>
                <td>{{ getCountofCoursePerCountry($row['code']) }}</td>
                <td>{{ $row['application_count'] }}</td>
                <td>{{ $row['male_applications_count'] }}</td>
                <td>{{ $row['female_applications_count'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@if (isset($print))
    <script>
        window.print();
    </script>
@endif

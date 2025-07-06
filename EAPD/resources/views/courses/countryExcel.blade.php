<table>
    <thead>
        <tr>
            <th>#</th>

            @if(isset($inv))
            <th>{{awtTrans('الدولة المشاركة')}}</th>

           @else
           <th>{{awtTrans('الدولة المدعوه')}}</th>
           @endif
            @if ($inv != true)
                <th>{{ awtTrans('عدد الدورات') }}</th>
                <th>{{ awtTrans('إجمالي عدد المتدربين') }}</th>
                <th>{{ awtTrans('عدد المتدربات') }}</th>
                @if ($cost == 'false')
                @else
                    <th>{{ awtTrans('التكلفة الإجمالية') }}</th>
                @endif
            @endif


        </tr>
    </thead>
    <tbody>
        @php($t = 1)

        @foreach ($data as $row)
            <tr>

                <td>{{ $t }}</td>
                @php($t++)
                <td>{{ $row['name'] }}</td>
                @if ($inv != true)
                    <td>{{ $row['total_courses'] }}</td>
                    <td>{{ $row['total_apps'] }}</td>
                    <td>{{ $row['total_apps_fem'] }}</td>
                    @if ($cost == 'false')
                    @else
                        <td>{{ $row['cost'] }}</td>
                    @endif
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

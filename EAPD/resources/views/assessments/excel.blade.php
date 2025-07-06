<table>
    <thead>
    <tr>
        <th>id</th>
        <th>Name</th>
        <th>country</th>
        <th>course name</th>
        <th>course date</th>
        <th>Job</th>
        <th>Date</th>

    </tr>
    </thead>
    <tbody>
    @foreach($data as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->name}}</td>
            <td>{{getCountry($row->country) }}</td>
            @if(empty($row->course))
                <td>N\A</td>

            @else

                <td>{{$row->course->name()}}</td>
            @endif

            @if(empty($row->course))
                <td>N\A</td>

            @else

                <td>{{$row->course->start_date}}</td>
            @endif
            <td>{{$row->job}}</td>
            <td>{{\Carbon\Carbon::createFromTimeString($row->created_at)}}</td>



        </tr>
    @endforeach
    </tbody>
</table>

@if(isset($print))
<script>

    window.print();

</script>



@endif

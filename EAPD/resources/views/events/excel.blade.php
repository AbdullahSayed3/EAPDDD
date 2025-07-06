<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>SUBJECT</th>
        <th>participants</th>
        <th>start date</th>
        <th>end date</th>
        <th>event type</th>
        <th>location</th>
        <th>notes</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->subject }}</td>
            <td>{{implode ("-",unserialize($row->participants))}}</td>
            <td>{{ $row->start_date->format('Y-m-d') }}</td>
            <td>{{ $row->end_date->format('Y-m-d')  }}</td>
            <td>{{ $row->type->name_ar??'-' }}</td>
            <td>{{ $row->location }}</td>
            <td>{{ $row->notes }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

@if(isset($print))
<script>

    window.print();

</script>



@endif

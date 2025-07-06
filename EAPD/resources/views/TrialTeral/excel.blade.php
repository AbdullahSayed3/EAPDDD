<table>
    <thead>
    <tr>
        <th>#</th>
        <th>{{awtTrans('الاطار التعاقدي')}}</th>
        <th>{{awtTrans('الدولة المستفيدة')}}</th>
        <th>{{awtTrans('مجالات التعاون')}}</th>
        <th>{{awtTrans('تاريخ بدء الاتفاق')}}</th>
        <th>{{awtTrans('التفاصيل')}}</th>
        <th>{{awtTrans('التكلفة الكلية')}}</th>
        <th>{{awtTrans('تكلفة مساهمة الوكالة')}}</th>
        <th>{{awtTrans('رقم موافقة الوزير أو مجلس الإدارة')}}</th>
        {{--<th>notes</th>--}}
    </tr>
    </thead>
    <tbody>
    @foreach($data as $row)
        <?php

        $array=unserialize($row->beneficiary_countries);
        $dataR='';
        foreach ($array as $item) {
            if(isset($item['org']))
            {
                if($item['id']=='0')
                    {
                        $dataR.=$item['org'].'-';

                    }else
                        {
                            $dataR.=getCountry($item['id']).'('.$item['org'].')-';

                        }

            }else
            {

                $dataR.=getCountry($item['id']).'-';
            }
        }
$dataF='';
        $array=unserialize($row->contract_field);
        foreach ($array as $item) {
            $dataF.=getTrialField($item).'-';

        }
        ?>
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->name }}</td>
            <td>{{$dataR}}</td>
            <td>{{$dataF}}</td>
            <td>{{ $row->start_date }}</td>
            <td>{{ $row->details }}</td>
            <td>{{ $row->cost}}</td>
            <td>{{ $row->agency_cost}}</td>
            <td>{{ $row->acceptation_number }}</td>
{{--            <td>{{ $row->notes }}</td>--}}
        </tr>
    @endforeach
    </tbody>
</table>

@if(isset($print))
<script>

    window.print();

</script>



@endif
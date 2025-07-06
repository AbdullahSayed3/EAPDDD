<table>
    <thead>
    <tr>
        <th>#</th>
        <th>@lang('main.applicant_date')</th>
        <th>@lang('main.first_name')</th>
        <th>@lang('main.middle_name')</th>
        <th>@lang('main.last_name')</th>
        <th>@lang('main.nationality')</th>
        <th>@lang('main.gender')</th>
        <th>@lang('main.address')</th>
        <th>@lang('main.phone_number')</th>
        <th>@lang('main.email_address')</th>
        <th>@lang('main.birth_date')</th>
        <th>@lang('main.passport_id')</th>
        <th>@lang('main.qualification')</th>
        <th>@lang('main.languages')</th>
        <th>@lang('main.country')</th>
        <th>@lang('main.current_employer')</th>
        <th>@lang('main.employer_address')</th>
        <th>@lang('main.employer_phone')</th>
        <th>@lang('main.employer_email')</th>
        <th>{{awtTrans('اسم الدورة')}}</th>
        <th>{{awtTrans('تاريخ البدء')}}</th>
        <th>{{ awtTrans('تاريخ الإنتهاء') }}</th>


    </tr>
    </thead>
    <tbody>
        @php($t=1)

    @foreach($data as $model)

        <tr>
            <td>{{ $t}}</td>
            @php($t++)
            {{-- <td>{{$model->created_at->format('d-m-Y')}}</td> --}}
            <td>{{ optional($model->created_at)->format('d-m-Y') }}</td>
            <td>{{ $model->first_name }}</td>
            <td>{{ $model->middle_name }}</td>
            <td>{{ $model->last_name}}</td>
            <td>{{getCountry($model->nationality) }}</td>
            <td>@lang('main.'.$model->gender)</td>
            <td>{{$model->address}}</td>
            <?php

         //   $array=unserialize($model->phone_number??'a:0:{}');

            $train='';
           /*  foreach($array as $item)
            {
                $train.=$item."\n";
            }
			*/

			$train= ($model->phone_number)

            ?>
            <td>{{$train}}</td>


            <td>{{$model->email_address}}</td>
            @if (!empty($model->birth_date) )
            <td>{{$model->birth_date->format('d-m-Y')}}</td>
			@else
			<td></td>
            @endif
            <td>{{$model->passport_id}}</td>
            <td>{{$model->qualification}}</td>
            <td>
                @foreach(unserialize($model->languages??'a:0:{}') as $lang)
                    {{$lang}}-
                @endforeach
            </td>
            <td>{{getCountry($model->country)}}</td>
            <td>{{$model->current_employer}}</td>
            <td>{{$model->employer_address}}</td>
            <td>  @foreach(unserialize($model->employer_phone??'a:0:{}') as $phone)
                    {{$phone}}-
                @endforeach
            </td>
            <td>{{$model->employer_email}}</td>
            @if(empty($model->course))
                <td>N\A</td>

            @else

                <td>{{$model->course->name()}}</td>
            @endif
            @if(empty($model->course))
                <td>N\A</td>

            @else

                <td>{{$model->course->start_date->format('d-m-Y') }}</td>
            @endif
            @if(empty($model->course))
            <td>N\A</td>

        @else

            <td>{{$model->course->end_date->format('d-m-Y')}}</td>
        @endif





        </tr>
    @endforeach
    </tbody>
</table>

@if(isset($print))
<script>

    window.print();

</script>



@endif

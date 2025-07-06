@extends('layouts.master')
@section('content')
 <x-base.breadcrumb title="{!! $model->name !!}" :translate="false"  :breadcrumbs="[
    ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
    ['label' => 'قائمة التقييمات', 'url' => route('assessments.index')],
    ['label' => $model->name],
]" />

    <!-- Conten of the page -->
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="mb-4">
                <div class="card-body">
                    <form>
                        <div class="form-group row">

                            <label for="inpu16" class="col-sm-2 col-form-label">@lang('main.course_name'):</label>
                            <div class="col-sm-4">
                                <p>{{  optional($course)->name() ?? ''  }} </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <form method="post" action="{{ route('assessments.update', [$model->id]) }}">
        <input disabled type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
        <div class="row">

            <div class="col-xl-12 col-md-12">
                <div class="mb-4">
                    <div class="card-header">
                        <h4>@lang('main.personal_information')</h4>
                    </div>
                    <div class="card-body">
                        @include('flash::message')


                        <div class="form-group row">
                            <label for="inpu1" class="col-sm-2 col-form-label">@lang('main.name')</label>
                            <div class="col-sm-6">
                                <input disabled type="text" name="name" value="{{ $model->name }}"
                                    class="form-control" id="inpu1" placeholder="@lang('main.name')">
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">@lang('main.nationality')</label>
                            <div class="col-sm-6">
                                {{-- <select class="form-control selc_country" name="country" disabled>
                                    <option></option>
                                    @foreach (getCountries() as $country => $value)
                                        @if ($model->country != $country) @continue @endif
                                        <option value="{{$country}}" {{$model->country == $country ? 'selected' : ''}}>
                                            {{$value}}
                                        </option>
                                    @endforeach
                                </select> --}}
                                {{ $model->country }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-2 col-form-label">@lang('main.job') </label>
                            <div class="col-sm-6">
                                <input disabled type="text" class="form-control " value="{{ $model->job }}"
                                    name="job" id="inpu17" placeholder="@lang('man.job') ">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="mb-4">
                    <div class="card-header">
                        <h4>1- @lang('main.a_program')</h4>
                    </div>
                    {{-- <div class="card-body">
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">1.@lang('main.a_1') </label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_1]"
                                            {{$model->assessment['a_program']['a_1']==1?'checked':''}} class="iCheck-square"
                                        value="1" id="form[a_program][a_1]r1">
                                        <label class=" control-label"
                                            for="form[a_program][a_1]r1">@lang('main.Excellent')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_1]"
                                            {{$model->assessment['a_program']['a_1'] == 2 ? 'checked' : ''}} class="iCheck-square"
                                            value="2" id="form[a_program][a_1]r2">
                                        <label class="  control-label"
                                            for="form[a_program][a_1]r2">@lang('main.Very good')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_1]"
                                            {{$model->assessment['a_program']['a_1'] == 3 ? 'checked' : ''}} class="iCheck-square"
                                            value="3" id="form[a_program][a_1]r3">
                                        <label class="  control-label"
                                            for="form[a_program][a_1]r3">@lang('main.Fair')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_1]"
                                            {{$model->assessment['a_program']['a_1'] == 4 ? 'checked' : ''}} class="iCheck-square"
                                            value="4" id="form[a_program][a_1]r4">
                                        <label class="  control-label"
                                            for="form[a_program][a_1]r4">@lang('main.Poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_1]"
                                            {{$model->assessment['a_program']['a_1'] == 5 ? 'checked' : ''}} class="iCheck-square"
                                            value="5" id="form[a_program][a_1]r5">
                                        <label class="  control-label"
                                            for="form[a_program][a_1]r5">@lang('main.Very poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_1]"
                                            {{$model->assessment['a_program']['a_1'] == 6 ? 'checked' : ''}} class="iCheck-square"
                                            value="6" id="form[a_program][a_1]r6">
                                        <label class="  control-label"
                                            for="form[a_program][a_1]r6">@lang('main.Not applicable')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">2.@lang('main.a_2') </label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_2]"
                                            {{$model->assessment['a_program']['a_2'] == 1 ? 'checked' : ''}} class="iCheck-square"
                                            value="1" id="form[a_program][a_2]r1">
                                        <label class=" control-label"
                                            for="form[a_program][a_2]r1">@lang('main.Excellent')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_2]"
                                            {{$model->assessment['a_program']['a_2'] == 2 ? 'checked' : ''}} class="iCheck-square"
                                            value="2" id="form[a_program][a_2]r2">
                                        <label class="  control-label"
                                            for="form[a_program][a_2]r2">@lang('main.Very good')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_2]"
                                            {{$model->assessment['a_program']['a_2'] == 3 ? 'checked' : ''}} class="iCheck-square"
                                            value="3" id="form[a_program][a_2]r3">
                                        <label class="  control-label"
                                            for="form[a_program][a_2]r3">@lang('main.Fair')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_2]"
                                            {{$model->assessment['a_program']['a_2'] == 4 ? 'checked' : ''}} class="iCheck-square"
                                            value="4" id="form[a_program][a_2]r4">
                                        <label class="  control-label"
                                            for="form[a_program][a_2]r4">@lang('main.Poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_2]"
                                            {{$model->assessment['a_program']['a_2'] == 5 ? 'checked' : ''}} class="iCheck-square"
                                            value="5" id="form[a_program][a_2]r5">
                                        <label class="  control-label"
                                            for="form[a_program][a_2]r5">@lang('main.Very poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_2]"
                                            {{$model->assessment['a_program']['a_2'] == 6 ? 'checked' : ''}} class="iCheck-square"
                                            value="6" id="form[a_program][a_2]r6">
                                        <label class="  control-label"
                                            for="form[a_program][a_2]r6">@lang('main.Not applicable')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">3.@lang('main.a_3') </label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_3]"
                                            {{$model->assessment['a_program']['a_3'] == 1 ? 'checked' : ''}} class="iCheck-square"
                                            value="1" id="form[a_program][a_3]r1">
                                        <label class=" control-label"
                                            for="form[a_program][a_3]r1">@lang('main.Excellent')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_3]"
                                            {{$model->assessment['a_program']['a_3'] == 2 ? 'checked' : ''}} class="iCheck-square"
                                            value="2" id="form[a_program][a_3]r2">
                                        <label class="  control-label"
                                            for="form[a_program][a_3]r2">@lang('main.Very good')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_3]"
                                            {{$model->assessment['a_program']['a_3'] == 3 ? 'checked' : ''}} class="iCheck-square"
                                            value="3" id="form[a_program][a_3]r3">
                                        <label class="  control-label"
                                            for="form[a_program][a_3]r3">@lang('main.Fair')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_3]"
                                            {{$model->assessment['a_program']['a_3'] == 4 ? 'checked' : ''}} class="iCheck-square"
                                            value="4" id="form[a_program][a_3]r4">
                                        <label class="  control-label"
                                            for="form[a_program][a_3]r4">@lang('main.Poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_3]"
                                            {{$model->assessment['a_program']['a_3'] == 5 ? 'checked' : ''}} class="iCheck-square"
                                            value="5" id="form[a_program][a_3]r5">
                                        <label class="  control-label"
                                            for="form[a_program][a_3]r5">@lang('main.Very poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_3]"
                                            {{$model->assessment['a_program']['a_3'] == 6 ? 'checked' : ''}} class="iCheck-square"
                                            value="6" id="form[a_program][a_3]r6">
                                        <label class="  control-label"
                                            for="form[a_program][a_3]r6">@lang('main.Not applicable')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">4. @lang('main.a_4')</label>
                            <label for="inpu17" class="col-sm-12 col-form-label">4. @lang('main.a_4')</label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_4]"
                                            {{$model->assessment['a_program']['a_4'] == 1 ? 'checked' : ''}} class="iCheck-square"
                                            value="1" id="form[a_program][a_4]r1">
                                        <label class=" control-label"
                                            for="form[a_program][a_4]r1">@lang('main.Excellent')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_4]"
                                            {{$model->assessment['a_program']['a_4'] == 2 ? 'checked' : ''}} class="iCheck-square"
                                            value="2" id="form[a_program][a_4]r2">
                                        <label class="  control-label"
                                            for="form[a_program][a_4]r2">@lang('main.Very good')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_4]"
                                            {{$model->assessment['a_program']['a_4'] == 3 ? 'checked' : ''}} class="iCheck-square"
                                            value="3" id="form[a_program][a_4]r3">
                                        <label class="  control-label"
                                            for="form[a_program][a_4]r3">@lang('main.Fair')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_4]"
                                            {{$model->assessment['a_program']['a_4'] == 4 ? 'checked' : ''}} class="iCheck-square"
                                            value="4" id="form[a_program][a_4]r4">
                                        <label class="  control-label"
                                            for="form[a_program][a_4]r4">@lang('main.Poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_4]"
                                            {{$model->assessment['a_program']['a_4'] == 5 ? 'checked' : ''}} class="iCheck-square"
                                            value="5" id="form[a_program][a_4]r5">
                                        <label class="  control-label"
                                            for="form[a_program][a_4]r5">@lang('main.Very poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_4]"
                                            {{$model->assessment['a_program']['a_4'] == 6 ? 'checked' : ''}} class="iCheck-square"
                                            value="6" id="form[a_program][a_4]r6">
                                        <label class="  control-label"
                                            for="form[a_program][a_4]r6">@lang('main.Not applicable')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">5.@lang('main.a_5') </label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_5]"
                                            {{$model->assessment['a_program']['a_5'] == 1 ? 'checked' : ''}} class="iCheck-square"
                                            value="1" id="form[a_program][a_5]r1">
                                        <label class=" control-label"
                                            for="form[a_program][a_5]r1">@lang('main.Excellent')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_5]"
                                            {{$model->assessment['a_program']['a_5'] == 2 ? 'checked' : ''}} class="iCheck-square"
                                            value="2" id="form[a_program][a_5]r2">
                                        <label class="  control-label"
                                            for="form[a_program][a_5]r2">@lang('main.Very good')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_5]"
                                            {{$model->assessment['a_program']['a_5'] == 3 ? 'checked' : ''}} class="iCheck-square"
                                            value="3" id="form[a_program][a_5]r3">
                                        <label class="  control-label"
                                            for="form[a_program][a_5]r3">@lang('main.Fair')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_5]"
                                            {{$model->assessment['a_program']['a_5'] == 4 ? 'checked' : ''}} class="iCheck-square"
                                            value="4" id="form[a_program][a_5]r4">
                                        <label class="  control-label"
                                            for="form[a_program][a_5]r4">@lang('main.Poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_5]"
                                            {{$model->assessment['a_program']['a_5'] == 5 ? 'checked' : ''}} class="iCheck-square"
                                            value="5" id="form[a_program][a_5]r5">
                                        <label class="  control-label"
                                            for="form[a_program][a_5]r5">@lang('main.Very poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_5]"
                                            {{$model->assessment['a_program']['a_5'] == 6 ? 'checked' : ''}} class="iCheck-square"
                                            value="6" id="form[a_program][a_5]r6">
                                        <label class="  control-label"
                                            for="form[a_program][a_5]r6">@lang('main.Not applicable')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">6. @lang('main.a_6') </label>
                            <label for="inpu17" class="col-sm-12 col-form-label">6. @lang('main.a_6') </label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_6]"
                                            {{$model->assessment['a_program']['a_6'] == 1 ? 'checked' : ''}} class="iCheck-square"
                                            value="1" id="form[a_program][a_6]r1">
                                        <label class=" control-label"
                                            for="form[a_program][a_6]r1">@lang('main.Excellent')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_6]"
                                            {{$model->assessment['a_program']['a_6'] == 2 ? 'checked' : ''}} class="iCheck-square"
                                            value="2" id="form[a_program][a_6]r2">
                                        <label class="  control-label"
                                            for="form[a_program][a_6]r2">@lang('main.Very good')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_6]"
                                            {{$model->assessment['a_program']['a_6'] == 3 ? 'checked' : ''}} class="iCheck-square"
                                            value="3" id="form[a_program][a_6]r3">
                                        <label class="  control-label"
                                            for="form[a_program][a_6]r3">@lang('main.Fair')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_6]"
                                            {{$model->assessment['a_program']['a_6'] == 4 ? 'checked' : ''}} class="iCheck-square"
                                            value="4" id="form[a_program][a_6]r4">
                                        <label class="  control-label"
                                            for="form[a_program][a_6]r4">@lang('main.Poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_6]"
                                            {{$model->assessment['a_program']['a_6'] == 5 ? 'checked' : ''}} class="iCheck-square"
                                            value="5" id="form[a_program][a_6]r5">
                                        <label class="  control-label"
                                            for="form[a_program][a_6]r5">@lang('main.Very poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_6]"
                                            {{$model->assessment['a_program']['a_6'] == 6 ? 'checked' : ''}} class="iCheck-square"
                                            value="6" id="form[a_program][a_6]r6">
                                        <label class="  control-label"
                                            for="form[a_program][a_6]r6">@lang('main.Not applicable')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">7.@lang('main.a_7') </label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_7]"
                                            {{$model->assessment['a_program']['a_7'] == 1 ? 'checked' : ''}} class="iCheck-square"
                                            value="1" id="form[a_program][a_7]r1">
                                        <label class=" control-label"
                                            for="form[a_program][a_7]r1">@lang('main.Excellent')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_7]"
                                            {{$model->assessment['a_program']['a_7'] == 2 ? 'checked' : ''}} class="iCheck-square"
                                            value="2" id="form[a_program][a_7]r2">
                                        <label class="  control-label"
                                            for="form[a_program][a_7]r2">@lang('main.Very good')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_7]"
                                            {{$model->assessment['a_program']['a_7'] == 3 ? 'checked' : ''}} class="iCheck-square"
                                            value="3" id="form[a_program][a_7]r3">
                                        <label class="  control-label"
                                            for="form[a_program][a_7]r3">@lang('main.Fair')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_7]"
                                            {{$model->assessment['a_program']['a_7'] == 4 ? 'checked' : ''}} class="iCheck-square"
                                            value="4" id="form[a_program][a_7]r4">
                                        <label class="  control-label"
                                            for="form[a_program][a_7]r4">@lang('main.Poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_7]"
                                            {{$model->assessment['a_program']['a_7'] == 5 ? 'checked' : ''}} class="iCheck-square"
                                            value="5" id="form[a_program][a_7]r5">
                                        <label class="  control-label"
                                            for="form[a_program][a_7]r5">@lang('main.Very poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_7]"
                                            {{$model->assessment['a_program']['a_7'] == 6 ? 'checked' : ''}} class="iCheck-square"
                                            value="6" id="form[a_program][a_7]r6">
                                        <label class="  control-label"
                                            for="form[a_program][a_7]r6">@lang('main.Not applicable')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">8.@lang('main.a_8') </label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_8]"
                                            {{$model->assessment['a_program']['a_8'] == 1 ? 'checked' : ''}} class="iCheck-square"
                                            value="1" id="form[a_program][a_8]r1">
                                        <label class=" control-label"
                                            for="form[a_program][a_8]r1">@lang('main.Excellent')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_8]"
                                            {{$model->assessment['a_program']['a_8'] == 2 ? 'checked' : ''}} class="iCheck-square"
                                            value="2" id="form[a_program][a_8]r2">
                                        <label class="  control-label"
                                            for="form[a_program][a_8]r2">@lang('main.Very good')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_8]"
                                            {{$model->assessment['a_program']['a_8'] == 3 ? 'checked' : ''}} class="iCheck-square"
                                            value="3" id="form[a_program][a_8]r3">
                                        <label class="  control-label"
                                            for="form[a_program][a_8]r3">@lang('main.Fair')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_8]"
                                            {{$model->assessment['a_program']['a_8'] == 4 ? 'checked' : ''}} class="iCheck-square"
                                            value="4" id="form[a_program][a_8]r4">
                                        <label class="  control-label"
                                            for="form[a_program][a_8]r4">@lang('main.Poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_8]"
                                            {{$model->assessment['a_program']['a_8'] == 5 ? 'checked' : ''}} class="iCheck-square"
                                            value="5" id="form[a_program][a_8]r5">
                                        <label class="  control-label"
                                            for="form[a_program][a_8]r5">@lang('main.Very poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_8]"
                                            {{$model->assessment['a_program']['a_8'] == 6 ? 'checked' : ''}} class="iCheck-square"
                                            value="6" id="form[a_program][a_8]r6">
                                        <label class="  control-label"
                                            for="form[a_program][a_8]r6">@lang('main.Not applicable')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">1.@lang('main.a_1')</label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_1]"
                                            {{ isset($model->assessment['a_program']['a_1']) && $model->assessment['a_program']['a_1'] == 1 ? 'checked' : '' }}
                                            class="iCheck-square" value="1" id="form[a_program][a_1]r1">
                                        <label class=" control-label" for="form[a_program][a_1]r1">@lang('main.Excellent')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_1]"
                                            {{ isset($model->assessment['a_program']['a_1']) && $model->assessment['a_program']['a_1'] == 2 ? 'checked' : '' }}
                                            class="iCheck-square" value="2" id="form[a_program][a_1]r2">
                                        <label class="  control-label"
                                            for="form[a_program][a_1]r2">@lang('main.Very good')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_1]"
                                            {{ isset($model->assessment['a_program']['a_1']) && $model->assessment['a_program']['a_1'] == 3 ? 'checked' : '' }}
                                            class="iCheck-square" value="3" id="form[a_program][a_1]r3">
                                        <label class="  control-label"
                                            for="form[a_program][a_1]r3">@lang('main.Fair')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_1]"
                                            {{ isset($model->assessment['a_program']['a_1']) && $model->assessment['a_program']['a_1'] == 4 ? 'checked' : '' }}
                                            class="iCheck-square" value="4" id="form[a_program][a_1]r4">
                                        <label class="  control-label"
                                            for="form[a_program][a_1]r4">@lang('main.Poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_1]"
                                            {{ isset($model->assessment['a_program']['a_1']) && $model->assessment['a_program']['a_1'] == 5 ? 'checked' : '' }}
                                            class="iCheck-square" value="5" id="form[a_program][a_1]r5">
                                        <label class="  control-label"
                                            for="form[a_program][a_1]r5">@lang('main.Very poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[a_program][a_1]"
                                            {{ isset($model->assessment['a_program']['a_1']) && $model->assessment['a_program']['a_1'] == 6 ? 'checked' : '' }}
                                            class="iCheck-square" value="6" id="form[a_program][a_1]r6">
                                        <label class="  control-label"
                                            for="form[a_program][a_1]r6">@lang('main.Not applicable')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="mb-4">
                    <div class="card-header">
                        <h4>2- @lang('main.b_lecturers')</h4>
                    </div>
                    {{-- <div class="card-body">
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">1. @lang('main.b_1') </label>
                            <label for="inpu17" class="col-sm-12 col-form-label">1. @lang('main.b_1') </label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_1]"
                                            {{$model->assessment['b_lecturers']['b_1'] == 1 ? 'checked' : ''}}
                                            class="iCheck-square" value="1" id="form[b_lecturers][b_1]r1">
                                        <label class=" control-label"
                                            for="form[b_lecturers][b_1]r1">@lang('main.Excellent')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_1]"
                                            {{$model->assessment['b_lecturers']['b_1'] == 2 ? 'checked' : ''}}
                                            class="iCheck-square" value="2" id="form[b_lecturers][b_1]r2">
                                        <label class="  control-label"
                                            for="form[b_lecturers][b_1]r2">@lang('main.Very good')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_1]"
                                            {{$model->assessment['b_lecturers']['b_1'] == 3 ? 'checked' : ''}}
                                            class="iCheck-square" value="3" id="form[b_lecturers][b_1]r3">
                                        <label class="  control-label"
                                            for="form[b_lecturers][b_1]r3">@lang('main.Fair')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_1]"
                                            {{$model->assessment['b_lecturers']['b_1'] == 4 ? 'checked' : ''}}
                                            class="iCheck-square" value="4" id="form[b_lecturers][b_1]r4">
                                        <label class="  control-label"
                                            for="form[b_lecturers][b_1]r4">@lang('main.Poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_1]"
                                            {{$model->assessment['b_lecturers']['b_1'] == 5 ? 'checked' : ''}}
                                            class="iCheck-square" value="5" id="form[b_lecturers][b_1]r5">
                                        <label class="  control-label"
                                            for="form[b_lecturers][b_1]r5">@lang('main.Very poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_1]"
                                            {{$model->assessment['b_lecturers']['b_1'] == 6 ? 'checked' : ''}}
                                            class="iCheck-square" value="6" id="form[b_lecturers][b_1]r6">
                                        <label class="  control-label"
                                            for="form[b_lecturers][b_1]r6">@lang('main.Not applicable')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">2. @lang('main.b_2') </label>
                            <label for="inpu17" class="col-sm-12 col-form-label">2. @lang('main.b_2') </label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_2]"
                                            {{$model->assessment['b_lecturers']['b_2'] == 1 ? 'checked' : ''}}
                                            class="iCheck-square" value="1" id="form[b_lecturers][b_2]r1">
                                        <label class=" control-label"
                                            for="form[b_lecturers][b_2]r1">@lang('main.Excellent')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_2]"
                                            {{$model->assessment['b_lecturers']['b_2'] == 2 ? 'checked' : ''}}
                                            class="iCheck-square" value="2" id="form[b_lecturers][b_2]r2">
                                        <label class="  control-label"
                                            for="form[b_lecturers][b_2]r2">@lang('main.Very good')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_2]"
                                            {{$model->assessment['b_lecturers']['b_2'] == 3 ? 'checked' : ''}}
                                            class="iCheck-square" value="3" id="form[b_lecturers][b_2]r3">
                                        <label class="  control-label"
                                            for="form[b_lecturers][b_2]r3">@lang('main.Fair')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_2]"
                                            {{$model->assessment['b_lecturers']['b_2'] == 4 ? 'checked' : ''}}
                                            class="iCheck-square" value="4" id="form[b_lecturers][b_2]r4">
                                        <label class="  control-label"
                                            for="form[b_lecturers][b_2]r4">@lang('main.Poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_2]"
                                            {{$model->assessment['b_lecturers']['b_2'] == 5 ? 'checked' : ''}}
                                            class="iCheck-square" value="5" id="form[b_lecturers][b_2]r5">
                                        <label class="  control-label"
                                            for="form[b_lecturers][b_2]r5">@lang('main.Very poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_2]"
                                            {{$model->assessment['b_lecturers']['b_2'] == 6 ? 'checked' : ''}}
                                            class="iCheck-square" value="6" id="form[b_lecturers][b_2]r6">
                                        <label class="  control-label"
                                            for="form[b_lecturers][b_2]r6">@lang('main.Not applicable')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">3.@lang('main.b_3')</label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_3]"
                                            {{$model->assessment['b_lecturers']['b_3'] == 1 ? 'checked' : ''}}
                                            class="iCheck-square" value="1" id="form[b_lecturers][b_3]r1">
                                        <label class=" control-label"
                                            for="form[b_lecturers][b_3]r1">@lang('main.Excellent')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_3]"
                                            {{$model->assessment['b_lecturers']['b_3'] == 2 ? 'checked' : ''}}
                                            class="iCheck-square" value="2" id="form[b_lecturers][b_3]r2">
                                        <label class="  control-label"
                                            for="form[b_lecturers][b_3]r2">@lang('main.Very good')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_3]"
                                            {{$model->assessment['b_lecturers']['b_3'] == 3 ? 'checked' : ''}}
                                            class="iCheck-square" value="3" id="form[b_lecturers][b_3]r3">
                                        <label class="  control-label"
                                            for="form[b_lecturers][b_3]r3">@lang('main.Fair')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_3]"
                                            {{$model->assessment['b_lecturers']['b_3'] == 4 ? 'checked' : ''}}
                                            class="iCheck-square" value="4" id="form[b_lecturers][b_3]r4">
                                        <label class="  control-label"
                                            for="form[b_lecturers][b_3]r4">@lang('main.Poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_3]"
                                            {{$model->assessment['b_lecturers']['b_3'] == 5 ? 'checked' : ''}}
                                            class="iCheck-square" value="5" id="form[b_lecturers][b_3]r5">
                                        <label class="  control-label"
                                            for="form[b_lecturers][b_3]r5">@lang('main.Very poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_3]"
                                            {{$model->assessment['b_lecturers']['b_3'] == 6 ? 'checked' : ''}}
                                            class="iCheck-square" value="6" id="form[b_lecturers][b_3]r6">
                                        <label class="  control-label"
                                            for="form[b_lecturers][b_3]r6">@lang('main.Not applicable')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">4. @lang('main.b_4') </label>
                            <label for="inpu17" class="col-sm-12 col-form-label">4. @lang('main.b_4') </label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_4]"
                                            {{$model->assessment['b_lecturers']['b_4'] == 1 ? 'checked' : ''}}
                                            class="iCheck-square" value="1" id="form[b_lecturers][b_4]r1">
                                        <label class=" control-label"
                                            for="form[b_lecturers][b_4]r1">@lang('main.Excellent')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_4]"
                                            {{$model->assessment['b_lecturers']['b_4'] == 2 ? 'checked' : ''}}
                                            class="iCheck-square" value="2" id="form[b_lecturers][b_4]r2">
                                        <label class="  control-label"
                                            for="form[b_lecturers][b_4]r2">@lang('main.Very good')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_4]"
                                            {{$model->assessment['b_lecturers']['b_4'] == 3 ? 'checked' : ''}}
                                            class="iCheck-square" value="3" id="form[b_lecturers][b_4]r3">
                                        <label class="  control-label"
                                            for="form[b_lecturers][b_4]r3">@lang('main.Fair')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_4]"
                                            {{$model->assessment['b_lecturers']['b_4'] == 4 ? 'checked' : ''}}
                                            class="iCheck-square" value="4" id="form[b_lecturers][b_4]r4">
                                        <label class="  control-label"
                                            for="form[b_lecturers][b_4]r4">@lang('main.Poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_4]"
                                            {{$model->assessment['b_lecturers']['b_4'] == 5 ? 'checked' : ''}}
                                            class="iCheck-square" value="5" id="form[b_lecturers][b_4]r5">
                                        <label class="  control-label"
                                            for="form[b_lecturers][b_4]r5">@lang('main.Very poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_4]"
                                            {{$model->assessment['b_lecturers']['b_4'] == 6 ? 'checked' : ''}}
                                            class="iCheck-square" value="6" id="form[b_lecturers][b_4]r6">
                                        <label class="  control-label"
                                            for="form[b_lecturers][b_4]r6">@lang('main.Not applicable')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">5. @lang('main.b_5') </label>
                            <label for="inpu17" class="col-sm-12 col-form-label">5. @lang('main.b_5') </label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_5]"
                                            {{$model->assessment['b_lecturers']['b_5'] == 1 ? 'checked' : ''}}
                                            class="iCheck-square" value="1" id="form[b_lecturers][b_5]r1">
                                        <label class=" control-label"
                                            for="form[b_lecturers][b_5]r1">@lang('main.Excellent')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_5]"
                                            {{$model->assessment['b_lecturers']['b_5'] == 2 ? 'checked' : ''}}
                                            class="iCheck-square" value="2" id="form[b_lecturers][b_5]r2">
                                        <label class="  control-label"
                                            for="form[b_lecturers][b_5]r2">@lang('main.Very good')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_5]"
                                            {{$model->assessment['b_lecturers']['b_5'] == 3 ? 'checked' : ''}}
                                            class="iCheck-square" value="3" id="form[b_lecturers][b_5]r3">
                                        <label class="  control-label"
                                            for="form[b_lecturers][b_5]r3">@lang('main.Fair')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_5]"
                                            {{$model->assessment['b_lecturers']['b_5'] == 4 ? 'checked' : ''}}
                                            class="iCheck-square" value="4" id="form[b_lecturers][b_5]r4">
                                        <label class="  control-label"
                                            for="form[b_lecturers][b_5]r4">@lang('main.Poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_5]"
                                            {{$model->assessment['b_lecturers']['b_5'] == 5 ? 'checked' : ''}}
                                            class="iCheck-square" value="5" id="form[b_lecturers][b_5]r5">
                                        <label class="  control-label"
                                            for="form[b_lecturers][b_5]r5">@lang('main.Very poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_5]"
                                            {{$model->assessment['b_lecturers']['b_5'] == 6 ? 'checked' : ''}}
                                            class="iCheck-square" value="6" id="form[b_lecturers][b_5]r6">
                                        <label class="  control-label"
                                            for="form[b_lecturers][b_5]r6">@lang('main.Not applicable')</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> --}}
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">1. @lang('main.b_1') </label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_1]"
                                            {{ isset($model->assessment['b_lecturers']['b_1']) && $model->assessment['b_lecturers']['b_1'] == 1 ? 'checked' : '' }}
                                            class="iCheck-square" value="1" id="form[b_lecturers][b_1]r1">
                                        <label class="control-label"
                                            for="form[b_lecturers][b_1]r1">@lang('main.Excellent')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_1]"
                                            {{ isset($model->assessment['b_lecturers']['b_1']) && $model->assessment['b_lecturers']['b_1'] == 2 ? 'checked' : '' }}
                                            class="iCheck-square" value="2" id="form[b_lecturers][b_1]r2">
                                        <label class="control-label"
                                            for="form[b_lecturers][b_1]r2">@lang('main.Very good')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_1]"
                                            {{ isset($model->assessment['b_lecturers']['b_1']) && $model->assessment['b_lecturers']['b_1'] == 3 ? 'checked' : '' }}
                                            class="iCheck-square" value="3" id="form[b_lecturers][b_1]r3">
                                        <label class="control-label"
                                            for="form[b_lecturers][b_1]r3">@lang('main.Fair')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_1]"
                                            {{ isset($model->assessment['b_lecturers']['b_1']) && $model->assessment['b_lecturers']['b_1'] == 4 ? 'checked' : '' }}
                                            class="iCheck-square" value="4" id="form[b_lecturers][b_1]r4">
                                        <label class="control-label"
                                            for="form[b_lecturers][b_1]r4">@lang('main.Poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_1]"
                                            {{ isset($model->assessment['b_lecturers']['b_1']) && $model->assessment['b_lecturers']['b_1'] == 5 ? 'checked' : '' }}
                                            class="iCheck-square" value="5" id="form[b_lecturers][b_1]r5">
                                        <label class="control-label"
                                            for="form[b_lecturers][b_1]r5">@lang('main.Very poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[b_lecturers][b_1]"
                                            {{ isset($model->assessment['b_lecturers']['b_1']) && $model->assessment['b_lecturers']['b_1'] == 6 ? 'checked' : '' }}
                                            class="iCheck-square" value="6" id="form[b_lecturers][b_1]r6">
                                        <label class="control-label"
                                            for="form[b_lecturers][b_1]r6">@lang('main.Not applicable')</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Repeat the same pattern for b_2, b_3, b_4, and b_5 -->
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="mb-4">
                    <div class="card-header">
                        <h4>3- {{App::getLocale() == 'ar' ? 'الجوانب اللوجستية' : 'Logictic Aspects'}}</h4>

                    </div>
                    {{-- <div class="card-body">
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">1. @lang('main.c_1') </label>
                            <label for="inpu17" class="col-sm-12 col-form-label">1. @lang('main.c_1') </label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_1]"
                                            {{$model->assessment['c_logistical']['c_1'] == 1 ? 'checked' : ''}}
                                            class="iCheck-square" value="1" id="form[c_logistical][c_1]r1">
                                        <label class=" control-label"
                                            for="form[c_logistical][c_1]r1">@lang('main.Excellent')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_1]"
                                            {{$model->assessment['c_logistical']['c_1'] == 2 ? 'checked' : ''}}
                                            class="iCheck-square" value="2" id="form[c_logistical][c_1]r2">
                                        <label class="  control-label"
                                            for="form[c_logistical][c_1]r2">@lang('main.Very good')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_1]"
                                            {{$model->assessment['c_logistical']['c_1'] == 3 ? 'checked' : ''}}
                                            class="iCheck-square" value="3" id="form[c_logistical][c_1]r3">
                                        <label class="  control-label"
                                            for="form[c_logistical][c_1]r3">@lang('main.Fair')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_1]"
                                            {{$model->assessment['c_logistical']['c_1'] == 4 ? 'checked' : ''}}
                                            class="iCheck-square" value="4" id="form[c_logistical][c_1]r4">
                                        <label class="  control-label"
                                            for="form[c_logistical][c_1]r4">@lang('main.Poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_1]"
                                            {{$model->assessment['c_logistical']['c_1'] == 5 ? 'checked' : ''}}
                                            class="iCheck-square" value="5" id="form[c_logistical][c_1]r5">
                                        <label class="  control-label"
                                            for="form[c_logistical][c_1]r5">@lang('main.Very poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_1]"
                                            {{$model->assessment['c_logistical']['c_1'] == 6 ? 'checked' : ''}}
                                            class="iCheck-square" value="6" id="form[c_logistical][c_1]r6">
                                        <label class="  control-label"
                                            for="form[c_logistical][c_1]r6">@lang('main.Not applicable')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">2. @lang('main.c_2') </label>
                            <label for="inpu17" class="col-sm-12 col-form-label">2. @lang('main.c_2') </label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_2]"
                                            {{$model->assessment['c_logistical']['c_2'] == 1 ? 'checked' : ''}}
                                            class="iCheck-square" value="1" id="form[c_logistical][c_2]r1">
                                        <label class=" control-label"
                                            for="form[c_logistical][c_2]r1">@lang('main.Excellent')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_2]"
                                            {{$model->assessment['c_logistical']['c_2'] == 2 ? 'checked' : ''}}
                                            class="iCheck-square" value="2" id="form[c_logistical][c_2]r2">
                                        <label class="  control-label"
                                            for="form[c_logistical][c_2]r2">@lang('main.Very good')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_2]"
                                            {{$model->assessment['c_logistical']['c_2'] == 3 ? 'checked' : ''}}
                                            class="iCheck-square" value="3" id="form[c_logistical][c_2]r3">
                                        <label class="  control-label"
                                            for="form[c_logistical][c_2]r3">@lang('main.Fair')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_2]"
                                            {{$model->assessment['c_logistical']['c_2'] == 4 ? 'checked' : ''}}
                                            class="iCheck-square" value="4" id="form[c_logistical][c_2]r4">
                                        <label class="  control-label"
                                            for="form[c_logistical][c_2]r4">@lang('main.Poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_2]"
                                            {{$model->assessment['c_logistical']['c_2'] == 5 ? 'checked' : ''}}
                                            class="iCheck-square" value="5" id="form[c_logistical][c_2]r5">
                                        <label class="  control-label"
                                            for="form[c_logistical][c_2]r5">@lang('main.Very poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_2]"
                                            {{$model->assessment['c_logistical']['c_2'] == 6 ? 'checked' : ''}}
                                            class="iCheck-square" value="6" id="form[c_logistical][c_2]r6">
                                        <label class="  control-label"
                                            for="form[c_logistical][c_2]r6">@lang('main.Not applicable')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">3. @lang('main.c_3')</label>
                            <label for="inpu17" class="col-sm-12 col-form-label">3. @lang('main.c_3')</label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_3]"
                                            {{$model->assessment['c_logistical']['c_3'] == 1 ? 'checked' : ''}}
                                            class="iCheck-square" value="1" id="form[c_logistical][c_3]r1">
                                        <label class=" control-label"
                                            for="form[c_logistical][c_3]r1">@lang('main.Excellent')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_3]"
                                            {{$model->assessment['c_logistical']['c_3'] == 2 ? 'checked' : ''}}
                                            class="iCheck-square" value="2" id="form[c_logistical][c_3]r2">
                                        <label class="  control-label"
                                            for="form[c_logistical][c_3]r2">@lang('main.Very good')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_3]"
                                            {{$model->assessment['c_logistical']['c_3'] == 3 ? 'checked' : ''}}
                                            class="iCheck-square" value="3" id="form[c_logistical][c_3]r3">
                                        <label class="  control-label"
                                            for="form[c_logistical][c_3]r3">@lang('main.Fair')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_3]"
                                            {{$model->assessment['c_logistical']['c_3'] == 4 ? 'checked' : ''}}
                                            class="iCheck-square" value="4" id="form[c_logistical][c_3]r4">
                                        <label class="  control-label"
                                            for="form[c_logistical][c_3]r4">@lang('main.Poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_3]"
                                            {{$model->assessment['c_logistical']['c_3'] == 5 ? 'checked' : ''}}
                                            class="iCheck-square" value="5" id="form[c_logistical][c_3]r5">
                                        <label class="  control-label"
                                            for="form[c_logistical][c_3]r5">@lang('main.Very poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_3]"
                                            {{$model->assessment['c_logistical']['c_3'] == 6 ? 'checked' : ''}}
                                            class="iCheck-square" value="6" id="form[c_logistical][c_3]r6">
                                        <label class="  control-label"
                                            for="form[c_logistical][c_3]r6">@lang('main.Not applicable')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">4. @lang('main.c_4') </label>
                            <label for="inpu17" class="col-sm-12 col-form-label">4. @lang('main.c_4') </label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_4]"
                                            {{$model->assessment['c_logistical']['c_4'] == 1 ? 'checked' : ''}}
                                            class="iCheck-square" value="1" id="form[c_logistical][c_4]r1">
                                        <label class=" control-label"
                                            for="form[c_logistical][c_4]r1">@lang('main.Excellent')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_4]"
                                            {{$model->assessment['c_logistical']['c_4'] == 2 ? 'checked' : ''}}
                                            class="iCheck-square" value="2" id="form[c_logistical][c_4]r2">
                                        <label class="  control-label"
                                            for="form[c_logistical][c_4]r2">@lang('main.Very good')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_4]"
                                            {{$model->assessment['c_logistical']['c_4'] == 3 ? 'checked' : ''}}
                                            class="iCheck-square" value="3" id="form[c_logistical][c_4]r3">
                                        <label class="  control-label"
                                            for="form[c_logistical][c_4]r3">@lang('main.Fair')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_4]"
                                            {{$model->assessment['c_logistical']['c_4'] == 4 ? 'checked' : ''}}
                                            class="iCheck-square" value="4" id="form[c_logistical][c_4]r4">
                                        <label class="  control-label"
                                            for="form[c_logistical][c_4]r4">@lang('main.Poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_4]"
                                            {{$model->assessment['c_logistical']['c_4'] == 5 ? 'checked' : ''}}
                                            class="iCheck-square" value="5" id="form[c_logistical][c_4]r5">
                                        <label class="  control-label"
                                            for="form[c_logistical][c_4]r5">@lang('main.Very poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_4]"
                                            {{$model->assessment['c_logistical']['c_4'] == 6 ? 'checked' : ''}}
                                            class="iCheck-square" value="6" id="form[c_logistical][c_4]r6">
                                        <label class="  control-label"
                                            for="form[c_logistical][c_4]r6">@lang('main.Not applicable')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">1. @lang('main.c_1') </label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_1]"
                                            {{ ($model->assessment['c_logistical']['c_1'] ?? null) == 1 ? 'checked' : '' }}
                                            class="iCheck-square" value="1" id="form[c_logistical][c_1]r1">
                                        <label class="control-label"
                                            for="form[c_logistical][c_1]r1">@lang('main.Excellent')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_1]"
                                            {{ ($model->assessment['c_logistical']['c_1'] ?? null) == 2 ? 'checked' : '' }}
                                            class="iCheck-square" value="2" id="form[c_logistical][c_1]r2">
                                        <label class="control-label"
                                            for="form[c_logistical][c_1]r2">@lang('main.Very good')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_1]"
                                            {{ ($model->assessment['c_logistical']['c_1'] ?? null) == 3 ? 'checked' : '' }}
                                            class="iCheck-square" value="3" id="form[c_logistical][c_1]r3">
                                        <label class="control-label"
                                            for="form[c_logistical][c_1]r3">@lang('main.Fair')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_1]"
                                            {{ ($model->assessment['c_logistical']['c_1'] ?? null) == 4 ? 'checked' : '' }}
                                            class="iCheck-square" value="4" id="form[c_logistical][c_1]r4">
                                        <label class="control-label"
                                            for="form[c_logistical][c_1]r4">@lang('main.Poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_1]"
                                            {{ ($model->assessment['c_logistical']['c_1'] ?? null) == 5 ? 'checked' : '' }}
                                            class="iCheck-square" value="5" id="form[c_logistical][c_1]r5">
                                        <label class="control-label"
                                            for="form[c_logistical][c_1]r5">@lang('main.Very poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_1]"
                                            {{ ($model->assessment['c_logistical']['c_1'] ?? null) == 6 ? 'checked' : '' }}
                                            class="iCheck-square" value="6" id="form[c_logistical][c_1]r6">
                                        <label class="control-label"
                                            for="form[c_logistical][c_1]r6">@lang('main.Not applicable')</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">2. @lang('main.c_2') </label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_2]"
                                            {{ ($model->assessment['c_logistical']['c_2'] ?? null) == 1 ? 'checked' : '' }}
                                            class="iCheck-square" value="1" id="form[c_logistical][c_2]r1">
                                        <label class="control-label"
                                            for="form[c_logistical][c_2]r1">@lang('main.Excellent')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_2]"
                                            {{ ($model->assessment['c_logistical']['c_2'] ?? null) == 2 ? 'checked' : '' }}
                                            class="iCheck-square" value="2" id="form[c_logistical][c_2]r2">
                                        <label class="control-label"
                                            for="form[c_logistical][c_2]r2">@lang('main.Very good')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_2]"
                                            {{ ($model->assessment['c_logistical']['c_2'] ?? null) == 3 ? 'checked' : '' }}
                                            class="iCheck-square" value="3" id="form[c_logistical][c_2]r3">
                                        <label class="control-label"
                                            for="form[c_logistical][c_2]r3">@lang('main.Fair')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_2]"
                                            {{ ($model->assessment['c_logistical']['c_2'] ?? null) == 4 ? 'checked' : '' }}
                                            class="iCheck-square" value="4" id="form[c_logistical][c_2]r4">
                                        <label class="control-label"
                                            for="form[c_logistical][c_2]r4">@lang('main.Poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_2]"
                                            {{ ($model->assessment['c_logistical']['c_2'] ?? null) == 5 ? 'checked' : '' }}
                                            class="iCheck-square" value="5" id="form[c_logistical][c_2]r5">
                                        <label class="control-label"
                                            for="form[c_logistical][c_2]r5">@lang('main.Very poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[c_logistical][c_2]"
                                            {{ ($model->assessment['c_logistical']['c_2'] ?? null) == 6 ? 'checked' : '' }}
                                            class="iCheck-square" value="6" id="form[c_logistical][c_2]r6">
                                        <label class="control-label"
                                            for="form[c_logistical][c_2]r6">@lang('main.Not applicable')</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Repeat for c_3 and c_4 -->
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="mb-4">
                    <div class="card-header">
                        <h4>4- {{__('awt.d_geva')}}</h4>

                    </div>
                    {{-- <div class="card-body">
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">1. @lang('main.d_1') </label>
                            <div class="col-sm-12">
                                <textarea disabled class="form-control"
                                    name="form[d_geva][d_1]">{{$model->assessment['d_geva']['d_1']}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">2. @lang('main.d_2') </label>
                            <div class="col-sm-12">
                                <textarea disabled class="form-control"
                                    name="form[d_geva][d_2]">{{$model->assessment['d_geva']['d_2']}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">3. @lang('main.d_3')</label>
                            <div class="col-sm-12">
                                <textarea disabled class="form-control"
                                    name="form[d_geva][d_3]">{{$model->assessment['d_geva']['d_3']}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">4. @lang('main.d_4') </label>
                            <div class="col-sm-12">
                                <textarea disabled class="form-control"
                                    name="form[d_geva][d_4]">{{$model->assessment['d_geva']['d_4']}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">5. @lang('main.d_5') </label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[d_geva][d_5]" class="iCheck-square"
                                            {{$model->assessment['d_geva']['d_5'] == 1 ? 'checked' : ''}} value="1" id="r1">
                                        <label class=" control-label" for="r1">@lang('main.Excellent')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[d_geva][d_5]" class="iCheck-square"
                                            {{$model->assessment['d_geva']['d_5'] == 2 ? 'checked' : ''}} value="2" id="r2">
                                        <label class="  control-label" for="r2">@lang('main.Very good')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[d_geva][d_5]" class="iCheck-square"
                                            {{$model->assessment['d_geva']['d_5'] == 3 ? 'checked' : ''}} value="3" id="r3">
                                        <label class="  control-label" for="r3">@lang('main.Fair')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[d_geva][d_5]" class="iCheck-square"
                                            {{$model->assessment['d_geva']['d_5'] == 4 ? 'checked' : ''}} value="4" id="r4">
                                        <label class="  control-label" for="r4">@lang('main.Poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[d_geva][d_5]" class="iCheck-square"
                                            {{$model->assessment['d_geva']['d_5'] == 5 ? 'checked' : ''}} value="5" id="r5">
                                        <label class="  control-label" for="r5">@lang('main.Very poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[d_geva][d_5]" class="iCheck-square"
                                            {{$model->assessment['d_geva']['d_5'] == 6 ? 'checked' : ''}} value="6" id="r6">
                                        <label class="  control-label" for="r6">@lang('main.Not applicable')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">1. @lang('main.d_1') </label>
                            {{-- <label for="inpu17" class="col-sm-12 col-form-label">1. @lang('main.d_1') </label> --}}
                            <div class="col-sm-12">
                                <textarea disabled class="form-control" name="form[d_geva][d_1]">
                                    {{ $model->assessment['d_geva']['d_1'] ?? '' }}
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">2. @lang('main.d_2') </label>
                            {{-- <label for="inpu17" class="col-sm-12 col-form-label">2. @lang('main.d_2') </label> --}}
                            <div class="col-sm-12">
                                <textarea disabled class="form-control" name="form[d_geva][d_2]">
                                    {{ $model->assessment['d_geva']['d_2'] ?? '' }}
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">3. @lang('main.d_3')</label>
                            {{-- <label for="inpu17" class="col-sm-12 col-form-label">3. @lang('main.d_3')</label> --}}
                            <div class="col-sm-12">
                                <textarea disabled class="form-control" name="form[d_geva][d_3]">
                                    {{ $model->assessment['d_geva']['d_3'] ?? '' }}
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">4. @lang('main.d_4') </label>
                            {{-- <label for="inpu17" class="col-sm-12 col-form-label">4. @lang('main.d_4') </label> --}}
                            <div class="col-sm-12">
                                <textarea disabled class="form-control" name="form[d_geva][d_4]">
                                    {{ $model->assessment['d_geva']['d_4'] ?? '' }}
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">5. @lang('main.d_5') </label>
                            {{-- <label for="inpu17" class="col-sm-12 col-form-label">5. @lang('main.d_5') </label> --}}
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[d_geva][d_5]" class="iCheck-square"
                                            {{ isset($model->assessment['d_geva']['d_5']) && $model->assessment['d_geva']['d_5'] == 1 ? 'checked' : '' }}
                                            value="1" id="r1">
                                        <label class="control-label" for="r1">@lang('main.Excellent')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[d_geva][d_5]" class="iCheck-square"
                                            {{ isset($model->assessment['d_geva']['d_5']) && $model->assessment['d_geva']['d_5'] == 2 ? 'checked' : '' }}
                                            value="2" id="r2">
                                        <label class="control-label" for="r2">@lang('main.Very good')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[d_geva][d_5]" class="iCheck-square"
                                            {{ isset($model->assessment['d_geva']['d_5']) && $model->assessment['d_geva']['d_5'] == 3 ? 'checked' : '' }}
                                            value="3" id="r3">
                                        <label class="control-label" for="r3">@lang('main.Fair')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[d_geva][d_5]" class="iCheck-square"
                                            {{ isset($model->assessment['d_geva']['d_5']) && $model->assessment['d_geva']['d_5'] == 4 ? 'checked' : '' }}
                                            value="4" id="r4">
                                        <label class="control-label" for="r4">@lang('main.Poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[d_geva][d_5]" class="iCheck-square"
                                            {{ isset($model->assessment['d_geva']['d_5']) && $model->assessment['d_geva']['d_5'] == 5 ? 'checked' : '' }}
                                            value="5" id="r5">
                                        <label class="control-label" for="r5">@lang('main.Very poor')</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input disabled type="radio" name="form[d_geva][d_5]" class="iCheck-square"
                                            {{ isset($model->assessment['d_geva']['d_5']) && $model->assessment['d_geva']['d_5'] == 6 ? 'checked' : '' }}
                                            value="6" id="r6">
                                        <label class="control-label" for="r6">@lang('main.Not applicable')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="mb-4">
                    <div class="card-header">
                        <h4>5- {{__('awt.e_other')}}</h4>

                    </div>
                    {{-- <div class="card-body">
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">1. @lang('main.e_1') </label>
                            <div class="col-sm-12">
                                <textarea disabled class="form-control"
                                    name="form[e_other][e_1]"> {{$model->assessment['e_other']['e_1']}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">2. @lang('main.e_2') </label>
                            <div class="col-sm-12">
                                <textarea disabled class="form-control"
                                    name="form[e_other][e_2]">{{$model->assessment['e_other']['e_2']}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">3. @lang('main.e_3')</label>
                            <div class="col-sm-12">
                                <textarea disabled class="form-control"
                                    name="form[e_other][e_3]">{{$model->assessment['e_other']['e_3']}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">4. @lang('main.e_4') </label>
                            <div class="col-sm-12">
                                <textarea disabled class="form-control"
                                    name="form[e_other][e_4]">{{$model->assessment['e_other']['e_4']}}</textarea>
                            </div>
                        </div> --}}
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">1. @lang('main.e_1') </label>
                            <div class="col-sm-12">
                                <textarea disabled class="form-control" name="form[e_other][e_1]">
                                        {{ $model->assessment['e_other']['e_1'] ?? '' }}
                                    </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">2. @lang('main.e_2') </label>
                            <div class="col-sm-12">
                                <textarea disabled class="form-control" name="form[e_other][e_2]">
                                        {{ $model->assessment['e_other']['e_2'] ?? '' }}
                                    </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">3. @lang('main.e_3')</label>
                            <div class="col-sm-12">
                                <textarea disabled class="form-control" name="form[e_other][e_3]">
                                        {{ $model->assessment['e_other']['e_3'] ?? '' }}
                                    </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu17" class="col-sm-12 col-form-label">4. @lang('main.e_4') </label>
                            <div class="col-sm-12">
                                <textarea disabled class="form-control" name="form[e_other][e_4]">
                                        {{ $model->assessment['e_other']['e_4'] ?? '' }}
                                    </textarea>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="mb-4">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12 text-right">
                                {{-- <button type="submit" class="btn btn-primary">@lang('main.save')</button> --}}
                                <a href="{{ route('assessments.index') }}" class="btn btn-danger">@lang('main.back')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection
@section('custom_scripts')
@endsection

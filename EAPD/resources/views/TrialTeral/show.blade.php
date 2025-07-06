@extends('layouts.master')

@section('content')
    <!--/page title-->

    <!--page title-->
    <div class="row">
        <div class="col-md-12">
            <div class="mb-4">
                <div class="page-title d-flex align-items-center p-3">
                    <div>
                        <h4 class="weight500 d-inline-block pr-3 mr-3 mb-0 border-right">{{ $model->name }}</h4>
                        <nav aria-label="breadcrumb" class="d-inline-block ">
                            <ol class="breadcrumb p-0">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('home') }}">{{ awtTrans('الصفحة الرئيسية') }}</a></li>
                                <li class="breadcrumb-item " aria-current="page"><a
                                        href="{{ route($route . '.index') }}">{{ awtTrans('التعاون الثلاثي') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $model->name }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Conten of the page -->

    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="mb-4">

                <div class="card-body">

                    <form method="post" action="{{ route($route . '.delete') }}">

                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="inputPassword3"
                                class="col-sm-2 col-form-label">{{ awtTrans('الدولة المستفيدة') }}</label>
                            <div class="col-sm-6">
                                <table class="table table-bordered">

                                    <tbody>
                                        <?php
                                        $rowArray = unserialize($model->beneficiary_countries);
                                        
                                        ?>
                                        @foreach ($rowArray as $row)
                                            <tr>
                                                <td>
                                                    @if ($row['id'] == '0')
                                                        {{ $row['org'] }}
                                                    @else
                                                        {{ getCountry($row['id']) }}

                                                        @if (isset($row['org']))
                                                            / {{ $row['org'] }}
                                                        @endif
                                                    @endif


                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                        </div>


                        <div class="form-group row">
                            <label for="inpu11" class="col-sm-2 col-form-label">{{ awtTrans('الاطار التعاقدي') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->name }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu10" class="col-sm-2 col-form-label">{{ awtTrans('ملفات الاتفاق') }}</label>
                            <div class="col-sm-6">
                                @foreach (unserialize($model->contract_files) as $file)
                                    <a href="{{ asset('uploads/trial_teral/' . $file) }}" target="_blank"
                                        class="d-block"><i class="fa fa-file-pdf-o"></i> {{ awtTrans('تحميل الملف') }}</a>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu91" class="col-sm-2 col-form-label">{{ awtTrans('مجالات التعاون') }}</label>
                            <div class="col-sm-6">
                                @foreach (unserialize($model->contract_field) as $row)
                                    <tr>
                                        <td>
                                            {{ getTrialField($row) }}<br>


                                        </td>
                                    </tr>
                                @endforeach

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu901" class="col-sm-2 col-form-label">{{ awtTrans('التكلفة الكلية') }}</label>
                            <div class="col-sm-6">
                                {{ $model->cost }} $
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu921"
                                class="col-sm-2 col-form-label">{{ awtTrans('تكلفة مساهمة الوكالة') }}</label>
                            <div class="col-sm-6">
                                {{ $model->agency_cost }} $
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu9" class="col-sm-2 col-form-label">{{ awtTrans('التفاصيل') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->details }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu10"
                                class="col-sm-2 col-form-label">{{ awtTrans('تاريخ بدء الاتفاق') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->start_date }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu13" class="col-sm-2 col-form-label">{{ awtTrans('الحالة') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->status }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu11"
                                class="col-sm-2 col-form-label">{{ awtTrans('رقم موافقة الوزير أو مجلس الإدارة') }}</label>
                            <div class="col-sm-6">
                                <p> {{ $model->acceptation_number }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu9" class="col-sm-2 col-form-label">{{ awtTrans('ملاحظات أخرى') }}</label>
                            <div class="col-sm-6">
                                <p>{{ $model->notes }}</p>
                            </div>
                        </div>


                        <div class="form-group row d-print-none">
                            <div class="col-sm-12 text-right">
                                <a href="{{ route($route . '.edit', ['id' => $model->id]) }}" class="btn btn-primary"><i
                                        class="fa fa-file-text-o"></i> {{ awtTrans('تعديل') }}</a>
                                <button type="submit" name="submit" value="print" class="btn btn-primary"><i
                                        class="fa fa-print"></i>{{ awtTrans('طباعة') }} </button>
                                <input name="courses[]" type="hidden" value="{{ $model->id }}">

                                <button type="submit" name="submit" value="export" class="btn btn-primary"><i
                                        class="fa fa-file-excel-o"></i> {{ awtTrans('تحميل ملف اكسل') }} </button>

                                <a href="{{ route($route . '.index') }}" class="btn btn-danger"><i
                                        class="fa fa-sign-out"></i> {{ awtTrans('عوده') }} </a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
    <!-- end search -->
@endsection
@push('scripts')
@endpush

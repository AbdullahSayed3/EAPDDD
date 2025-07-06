@extends('layouts.master')

@section('content')
    <x-base.breadcrumb title="{{ $model->name() }}" :translate="false" :breadcrumbs="[
        ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
        ['label' => 'قائمة المتدربين', 'url' => route($route . '.index')],
        ['label' => $model->name()],
    ]" />

    <!-- Content of the page -->

    <div class="row">
        <div class="col-xl-3 col-md-3 d-print-none">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    @if (!empty($model->personal_picture))
                        <img class="rounded-circle" src="{{ asset('/uploads/applications/' . $model->personal_picture) }}"
                            width="100%" :alt="{{ $model->name() }}" />
                    @endif
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-md-9">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form method="post" action="{{ route($route . '.delete') }}">
                        {{ csrf_field() }}
                        <div class="mb-3 row">
                            <label for="inpu1110" class="col-sm-2 col-form-label">@lang('main.course_name')</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">
                                    {{ empty($model->course) ? 'N/A' : $model->course->name() }}
                                </p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu5" class="col-sm-2 col-form-label">@lang('main.applicant_date')</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">
                                    {{ $model->created_at ? $model->created_at->format('d-m-Y') : '-' }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu1" class="col-sm-2 col-form-label">@lang('main.name')</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->name() ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">@lang('main.nationality')</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">
                                    {{ !empty($model->nationality) ? getCountry($model->nationality) : '-' }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu8" class="col-sm-2 col-form-label">@lang('main.gender')</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">
                                    {{ !empty($model->gender) ? __('main.' . $model->gender) : '-' }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu8" class="col-sm-2 col-form-label">@lang('main.address')</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->address ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu11" class="col-sm-2 col-form-label">@lang('main.phone_number')</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->phone_number ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu12" class="col-sm-2 col-form-label">@lang('main.email_address')</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->email_address ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu5" class="col-sm-2 col-form-label">@lang('main.birth_date')</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">
                                    {{ !empty($model->birth_date) ? $model->birth_date->format('d-m-Y') : '-' }}
                                </p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu5" class="col-sm-2 col-form-label">@lang('main.passport_id')</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->passport_id ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu15" class="col-sm-2 col-form-label">@lang('main.passport_photos')</label>
                            <div class="col-sm-4">
                                @if (@unserialize($model->passport_photos) && count(unserialize($model->passport_photos)) > 0)
                                    @foreach (unserialize($model->passport_photos) as $row)
                                        <a target="_blank" href="{{ asset('/uploads/applications/' . $row) }}"
                                            class="d-block mb-1"><i class="fa fa-file-pdf-o me-1"></i>
                                            @lang('main.passport_photos')</a>
                                    @endforeach
                                @else
                                    <p class="form-control-plaintext">-</p>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu7" class="col-sm-2 col-form-label">@lang('main.qualification')</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->qualification ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu15" class="col-sm-2 col-form-label">@lang('main.qualification_certificates')</label>
                            <div class="col-sm-4">
                                @if (@unserialize($model->qualification_certificates) && count(unserialize($model->qualification_certificates)) > 0)
                                    @foreach (unserialize($model->qualification_certificates) as $row)
                                        <a target="_blank" href="{{ asset('/uploads/applications/' . $row) }}"
                                            class="d-block mb-1"><i class="fa fa-file-pdf-o me-1"></i> @lang('main.qualification_certificates')
                                        </a>
                                    @endforeach
                                @else
                                    <p class="form-control-plaintext">-</p>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu9" class="col-sm-2 col-form-label">@lang('main.languages')</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">
                                    @if (@unserialize($model->languages) && count(unserialize($model->languages)) > 0)
                                        @foreach (unserialize($model->languages) as $row)
                                            {{ $row }}<br>
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu17" class="col-sm-2 col-form-label">@lang('main.cv_file')</label>
                            <div class="col-sm-4">
                                @if (!empty($model->cv_file))
                                    <a href="{{ asset('/uploads/applications' . $model->cv_file) }}" class="d-block mb-1">
                                        <i class="fa fa-file-pdf-o me-1"></i>@lang('main.cv_file')
                                    </a>
                                @else
                                    <p class="form-control-plaintext">-</p>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu10" class="col-sm-2 col-form-label">@lang('main.country')</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">
                                    {{ !empty($model->country) ? getCountry($model->country) : '-' }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu10" class="col-sm-2 col-form-label">@lang('main.current_employer')</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->current_employer ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu10" class="col-sm-2 col-form-label">@lang('main.employer_address')</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->employer_address ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu10" class="col-sm-2 col-form-label">@lang('main.employer_phone')</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">
                                    @if (@unserialize($model->employer_phone) && count(unserialize($model->employer_phone)) > 0)
                                        @foreach (unserialize($model->employer_phone) as $row)
                                            {{ $row }}<br />
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu10" class="col-sm-2 col-form-label">@lang('main.employer_email')</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">{{ $model->employer_email ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu17" class="col-sm-2 col-form-label">@lang('main.health_certificates')</label>
                            <div class="col-sm-4">
                                @if (@unserialize($model->health_certificates) && count(unserialize($model->health_certificates)) > 0)
                                    @foreach (unserialize($model->health_certificates) as $row)
                                        <a target="_blank" href="{{ asset('/uploads/applications/' . $row) }}"
                                            class="d-block mb-1"><i class="fa fa-file-pdf-o me-1"></i>
                                            @lang('main.health_certificates')</a>
                                    @endforeach
                                @else
                                    <p class="form-control-plaintext">-</p>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inpu17" class="col-sm-2 col-form-label">@lang('main.other_certificates')</label>
                            <div class="col-sm-4">
                                @if (@unserialize($model->other_certificates) && count(unserialize($model->other_certificates)) > 0)
                                    @foreach (unserialize($model->other_certificates) as $row)
                                        <a target="_blank" href="{{ asset('/uploads/applications/' . $row) }}"
                                            class="d-block mb-1"><i class="fa fa-file-pdf-o me-1"></i>
                                            @lang('main.other_certificates')</a>
                                    @endforeach
                                @else
                                    <p class="form-control-plaintext">-</p>
                                @endif
                            </div>
                        </div>

                        <hr>
                        @if (!empty($model->course))
                            <h3>{{ awtTrans('بيانات الدورات') }}</h3>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ awtTrans('اسم الدورة') }}</th>
                                        <th>{{ awtTrans('تاريخ الدورة') }}</th>
                                        <th>{{ awtTrans('ترشيح المتدرب') }}</th>
                                        <th>{{ awtTrans('حالة المتدرب') }}</th>
                                        <th>{{ awtTrans('تكلفة الدورة') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <a
                                                href="{{ route('courses.show', [$model->course->id]) }}">{{ $model->course->name_ar }}</a>
                                        </td>
                                        <td>{{ $model->course->start_date->format('Y-m-d') }}</td>
                                        <td>{{ $model->trainee_status == 'primary' ? awtTrans('اساسي') : awtTrans('غير اساسي') }}
                                        </td>
                                        <td>{{ $model->wait_list == 'false' ? awtTrans('نشط') : awtTrans('غير نشط') }}</td>
                                        <td>{{ $model->course->cost }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif

                        <hr>

                        <div class="mb-3 row d-print-none">
                            @if ($model->wait_list == 'true')
                                <div class="col-sm-4 text-start">
                                    <x-base.fillBtn type="submit" name="submit" value="move_wait_list"
                                        icon="fa-arrow-circle-left" label="{{ awtTrans('نقل الي قائمه المتدربين') }}" />
                                </div>
                            @endif
                            <div class="col-sm-8 text-end">
                                @can('edit_applicants')                                    
                                <x-base.fillBtn href="{{ route($route . '.edit', [$model->id]) }}" icon="fa-file-text-o"
                                    label="{{ awtTrans('تعديل') }}" />
                                @endcan

                                <x-base.notfillBtn type="submit" name="submit" value="print" icon="fa-print"
                                    label="{{ awtTrans('طباعة') }}" />
                                <input name="courses[]" type="hidden" value="{{ $model->id }}">
                                <x-base.notfillBtn type="submit" name="submit" value="export" icon="fa-file-excel-o"
                                    label="{{ awtTrans('تحميل ملف اكسل') }}" />
                                <x-base.notfillBtn href="{{ route($route . '.index') }}"
                                    class="btn-outline-danger border border-danger" icon="fa-sign-out"
                                    label="{{ awtTrans('عوده') }}" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end search -->
@endsection

@section('custom_scripts')
@endsection

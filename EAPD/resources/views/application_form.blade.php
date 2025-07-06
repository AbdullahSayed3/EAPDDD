@extends('layouts.form_master')

@section('content')
    <!--page title-->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="d-flex align-items-center p-3 text-center justify-content-center">
                    <h4 class="fw-500 d-inline-block pe-3 me-3 mb-0">@lang('main.application_status')</h4>
                </div>
            </div>
        </div>
    </div>

    <!--/page title-->

    <!-- Content of the page -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form>
                        <div class="mb-3 row">
                            <label for="course-name" class="col-sm-2 col-form-label">@lang('main.course_name'):</label>
                            <div class="col-sm-10 col-md-4">
                                <p class="form-control-plaintext">{{  optional($course)->name() ?? ''  }}</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">@lang('main.personal_information')</h5>
                </div>
                <div class="card-body">
                    @include('flash::message')
                    {!! form($form) !!}
                </div>
            </div>
        </div>
    </div>
    <!-- end content -->
@endsection

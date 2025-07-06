@extends('layouts.master')

@section('content')
    <!--page title-->
    <div class="row">
        <div class="col-md-12">
            <div class="mb-4">
                <div class="page-title d-flex align-items-center p-3">
                    <div>
                        <h4 class="weight500 d-inline-block pr-3 mr-3 mb-0 border-right">{{ awtTrans('مشاهده') }}
                            {{ $active }} </h4>
                        <nav aria-label="breadcrumb" class="d-inline-block ">
                            <ol class="breadcrumb p-0">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('home') }}">{{ awtTrans('الصفحة الرئيسية') }}</a>
                                <li class="breadcrumb-item"><a href="{{ route($route . '.index') }}">{{ $active }}</a>
                                <li class="breadcrumb-item active" aria-current="page">{{ awtTrans('مشاهده') }}
                                    {{ $active }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="mb-4">

                <div class="card-body">

                    @include('flash::message')

                    {!! form($form) !!}
                </div>
            </div>

        </div>
    </div>
@endsection
@section('custom_scripts')
@endsection

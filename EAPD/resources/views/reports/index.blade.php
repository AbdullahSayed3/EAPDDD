@extends('layouts.master')

@section('content')
    <!--page title-->
    <x-base.breadcrumb title="التقارير" :breadcrumbs="[['label' => 'الصفحة الرئيسية', 'url' => route('home')], ['label' => 'التقارير']]" />

    <!--/page title-->
    <div class="row reports">
        <div class="col-md-12">
            <div class="mb-4">
                <div class="row g-4">
                    <!-- تقارير شاملة -->
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <a href="{{ route('reports.comprehensive') }}" title="{{ awtTrans('تقارير شاملة') }}">
                                <img src="{{ asset('assets/img/report-card-img.png') }}" class="card-img-top"
                                    alt="تقارير شاملة">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">{{ awtTrans('تقارير شاملة') }}</h5>
                            </div>
                        </div>
                    </div>

                    <!-- الدورات -->
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <a href="{{ route('reports.render', [7]) }}" title="{{ awtTrans('الدورات') }}">
                                <img src="{{ asset('assets/img/report-card-img.png') }}" class="card-img-top"
                                    alt="الدورات">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">{{ awtTrans('الدورات') }}</h5>
                            </div>
                        </div>
                    </div>

                    <!-- الخبراء -->
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <a href="{{ route('reports.render', [11]) }}" title="{{ awtTrans('الخبراء') }}">
                                <img src="{{ asset('assets/img/report-card-img.png') }}" class="card-img-top"
                                    alt="الخبراء">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">{{ awtTrans('الخبراء') }}</h5>

                            </div>
                        </div>
                    </div>

                    <!-- الدعوات -->
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <a href="{{ route('reports.render', [5, 'inv' => true]) }}" title="{{ awtTrans('الدعوات') }}">
                                <img src="{{ asset('assets/img/report-card-img.png') }}" class="card-img-top"
                                    alt="الدعوات">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">{{ awtTrans('الدعوات') }}</h5>
                            </div>
                        </div>
                    </div>

                    <!-- المعونات -->
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <a href="{{ route('reports.render', [14, 'details' => 'details']) }}"
                                title="{{ awtTrans('المعونات') }}">
                                <img src="{{ asset('assets/img/report-card-img.png') }}" class="card-img-top"
                                    alt="المعونات">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">{{ awtTrans('المعونات') }}</h5>
                            </div>
                        </div>
                    </div>

                    <!-- المنح الدراسية -->
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <a href="{{ route('reports.render', [19]) }}" title="{{ awtTrans('المنح الدراسية') }}">
                                <img src="{{ asset('assets/img/report-card-img.png') }}" class="card-img-top"
                                    alt="المنح الدراسية">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">{{ awtTrans('المنح الدراسية') }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--/page title-->
    {{-- <div class="row reports">
        <div class="col-md-12">
            <div class="mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5>التقارير الرئيسية</h5>
                            <ul>
                                <li>
                                    <a href="{{ route('reports.render', [1]) }}">{{ awtTrans('تقرير شامل لاستفادة دولة معينة من أنشطة الوكالة') }}
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('reports.render', [2]) }}">{{ awtTrans('تقرير عن مشاركة دولة في الدورات خلال فترة محددة') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('reports.render', [3]) }}">{{ awtTrans('تقرير عن مشاركة دولة في الدورات خلال فترة محددة شامل التكلفة التقديرية') }}
                                    </a>
                                </li>



                                <li>
                                    <a href="{{ route('reports.render', [7]) }}">{{ awtTrans('تقرير عن تفاصيل دورة محددة') }}
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('reports.render', [8, 'type' => 'army']) }}">{{ awtTrans('تقرير مجمع عن دورات الجيش') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('reports.render', [9, 'type' => 'police']) }}">{{ awtTrans('تقرير مجمع عن دورات الشرطة') }}
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('reports.render', [10]) }}">{{ awtTrans('تقرير عن الدورات المنعقدة في مجال محدد خلال فترة زمنية') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('reports.render', [11]) }}">{{ awtTrans('تقرير مجمع عن خبراء الوكالة خلال فترة معينة') }}
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('reports.render', [14, 'details' => 'details']) }}">{{ awtTrans('تقرير مجمع عن المعونات المقدمة من الوكالة خلال فترة معينة') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('reports.render', [21, 'details' => 'details']) }}">تقرير عن القوافل
                                        المقدمة من قبل الوكالة</a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('reports.render', [15, 'details' => 'details']) }}">{{ awtTrans('تقرير عن المعونات المقدمة إلى دولة خلال فترة معينة') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('reports.render', [16, 'details' => 'details']) }}">{{ awtTrans('تقرير عن المعونات المقدمة من نوعية محددة') }}
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('reports.render', [17]) }}">{{ awtTrans('تقرير مجمع عن أعمال الوكالة خلال فترة معينة') }}
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('reports.render', [17, 'cost' => true]) }}">{{ awtTrans('تقرير مجمع عن أعمال الوكالة خلال فترة معينة شامل التكلفة الإجمالية') }}
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5>التقارير الإضافية</h5>
                            <ul>
                                <li>
                                    <a
                                        href="{{ route('reports.render', [4]) }}">{{ awtTrans('تقرير مختصر عن مشاركة دولة بالدورات خلال فترة معينة') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('reports.render', [5]) }}">{{ awtTrans('تقرير مجمع عن مشاركة مجموعة من الدول بالدورات خلال فترة زمنية') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('reports.render', [6]) }}">{{ awtTrans('تقرير مجمع عن مشاركة مجموعة من الدول بالدورات خلال فترة زمنية شامل التكلفة التقديرية') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('reports.render', [5, 'inv' => true]) }}">{{ awtTrans('تقرير مجمع عن دعوة/مشاركة مجموعة من الدول بالدورات خلال فترة معينة') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('reports.render', [6, 'inv' => true]) }}">{{ awtTrans('تقرير مجمع عن دعوة/مشاركة مجموعة من الدول بالدورات خلال فترة معينة شامل التكلفة التقديرية') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('reports.render', [18]) }}">{{ awtTrans('تقرير مجمع عن أعمال الوكالة مرتبة بالعام المالي') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('reports.render', [18, 'cost' => true]) }}">{{ awtTrans('تقرير مجمع عن أعمال الوكالة مرتبة بالعام المالي شامل التكلفة الإجمالية') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('reports.render', [19]) }}">{{ awtTrans('تقرير عن المنح الدراسية') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('reports.render', [20]) }}">{{ awtTrans('تقرير عن الفعاليات التي شاركت بها الوكالة') }}
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div> --}}

    <!-- Content of the page -->
@endsection

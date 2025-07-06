@extends('layouts.master')

@section('content')

    <x-base.breadcrumb title="{{ $model->name }}" :translate="false" :breadcrumbs="[
        ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
        ['label' => 'المنح و الوظائف', 'url' => route($route . '.index')],
        ['label' => $model->name],
    ]" />
    <!--/page title-->

    <!-- Content of the page -->
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form method="post" action="{{ route($route . '.delete',$model->id) }}">
                        {{ csrf_field() }}
                        
                        <!-- Job Name -->
                        <div class="mb-3 row">
                            <label for="input1" class="col-sm-2 col-form-label">{{ awtTrans('name') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext fw-bold">{{ $model->name }}</p>
                            </div>
                        </div>
{{-- 
                        <!-- Job Code -->
                        @if($model->code)
                        <div class="mb-3 row">
                            <label for="input_code" class="col-sm-2 col-form-label">{{ awtTrans('كود الوظيفة') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">
                                    <span class="badge bg-primary">{{ $model->code }}</span>
                                </p>
                            </div>
                        </div>
                        @endif
 --}}

                        <!-- Job Type -->
                        @if($model->type)
                        <div class="mb-3 row">
                            <label for="input_code" class="col-sm-2 col-form-label">{{ awtTrans('كود الوظيفة') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">
                                     <span class="badge bg-primary">{{ $model->type == 1 ? trans('awt.Expert') : trans('awt.internship') }}</span>
                                </p>
                            </div>
                        </div>
                        @endif

                        <!-- Job Image -->
                        @if($model->image)
                        <div class="mb-3 row">
                            <label for="input_image" class="col-sm-2 col-form-label">{{ awtTrans('صورة الوظيفة') }}</label>
                            <div class="col-sm-6">
                                <img src="{{ asset('uploads/jobs_file/' . $model->image) }}" alt="{{ $model->name }}" 
                                     class="img-thumbnail" style="max-width: 200px; max-height: 150px;">
                            </div>
                        </div>
                        @endif

                        <!-- Countries -->
                        <div class="mb-3 row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">{{ awtTrans('country') }}</label>
                            <div class="col-sm-10">
                                @if(is_array($model->country_id) && count($model->country_id) > 0)
                                    @foreach ($model->country_id as $c)
                                        <span class="badge bg-success me-2 mb-1">{{ getCountry($c) }}</span>
                                    @endforeach
                                @else
                                    <p class="form-control-plaintext text-muted">{{ awtTrans('غير محدد') }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="mb-3 row">
                            <label for="input11" class="col-sm-2 col-form-label">{{ awtTrans('المحتوي') }}</label>
                            <div class="col-sm-10">
                                <div class="border rounded p-3 bg-light">
                                    {!! nl2br(e($model->content)) !!}
                                </div>
                            </div>
                        </div>

                        <!-- Tags -->
                        @if($model->tags)
                        <div class="mb-3 row">
                            <label for="input_tags" class="col-sm-2 col-form-label">{{ awtTrans('العلامات') }}</label>
                            <div class="col-sm-10">
                                @php
                                    $tags = is_string($model->tags) ? explode(',', $model->tags) : (is_array($model->tags) ? $model->tags : []);
                                @endphp
                                @if(count($tags) > 0)
                                    @foreach($tags as $tag)
                                        @if(trim($tag))
                                            <span class="badge bg-info me-2 mb-1">{{ trim($tag) }}</span>
                                        @endif
                                    @endforeach
                                @else
                                    <p class="form-control-plaintext text-muted">{{ awtTrans('لا توجد علامات') }}</p>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Date Range -->
                        <div class="mb-3 row">
                            <label for="input5" class="col-sm-2 col-form-label">{{ awtTrans('تاريخ البدء') }}</label>
                            <div class="col-sm-4">
                                <p class="form-control-plaintext">
                                    <i class="fa fa-calendar me-2"></i>
                                    {{ $model->start_date ? $model->start_date->format('Y-m-d') : awtTrans('غير محدد') }}
                                </p>
                            </div>
                            <label for="input6" class="col-sm-2 col-form-label">{{ awtTrans('تاريخ الانتهاء') }}</label>
                            <div class="col-sm-4">
                                <p class="form-control-plaintext">
                                    <i class="fa fa-calendar me-2"></i>
                                    {{ $model->end_date ? $model->end_date->format('Y-m-d') : awtTrans('غير محدد') }}
                                </p>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-3 row">
                            <label for="input_status" class="col-sm-2 col-form-label">{{ awtTrans('الحالة') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">
                                    @if($model->is_active)
                                        <span class="badge bg-success">
                                            <i class="fa fa-check me-1"></i>{{ awtTrans('نشط') }}
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="fa fa-times me-1"></i>{{ awtTrans('غير نشط') }}
                                        </span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Requirements Section -->
                        <div class="mb-4">
                            <h4 class="text-primary mb-3">
                                <i class="fa fa-list-ul me-2"></i>{{ awtTrans('requirements') }}
                            </h4>
                            @if($model->requirements)
                                <div class="border rounded p-3 bg-light">
                                       @php
                                    $requirements = is_string($model->requirements) ? explode(',', $model->requirements) : (is_array($model->requirements) ? $model->requirements : []);
                                    @endphp
                             
                                    @foreach ($requirements as $index => $requirement)
                                    
                                        <div class="mb-2">
                                            <strong>{{ $index + 1 }}. </strong>
                                            {!! nl2br(e($requirement)) !!}
                                        </div>
                                    @endforeach
                                    {{-- {!! nl2br(e($model->requirements)) !!} --}}
                                </div>
                            @else
                                <p class="text-muted">{{ awtTrans('لا توجد متطلبات محددة') }}</p>
                            @endif
                        </div>

                        <!-- Benefits Section -->
                        @if($model->benefit)
                        <div class="mb-4">
                            <h4 class="text-success mb-3">
                                <i class="fa fa-gift me-2"></i>{{ awtTrans('benefits') }}
                            </h4>
                            <div class="border rounded p-3 bg-light">
                                       @php
                                    $benefit = is_string($model->benefit) ? explode(',', $model->benefit) : (is_array($model->benefit) ? $model->benefit : []);
                                    @endphp
                             
                                    @foreach ($benefit as $index => $requirement)
                                    
                                        <div class="mb-2">
                                            <strong>{{ $index + 1 }}. </strong>
                                            {!! nl2br(e($requirement)) !!}
                                        </div>
                                    @endforeach
                                    {{-- {!! nl2br(e($model->benfit)) !!} --}}
                                </div>
                            {{-- <div class="border rounded p-3 bg-light">
                                {!! nl2br(e($model->benefit)) !!}
                            </div> --}}
                        </div>
                        @endif

                        <!-- Additional Images Section -->
                        @if($model->images && $model->images->count() > 0)
                        <div class="mb-4">
                            <h4 class="text-info mb-3">
                                <i class="fa fa-images me-2"></i>{{ awtTrans('صور إضافية') }}
                            </h4>
                            <div class="row">
                                @foreach($model->images as $image)
                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <div class="card">
                                            <img src="{{ asset('uploads/jobs_file/' . $image->image) }}" 
                                                 class="card-img-top" 
                                                 alt="Job Image"
                                                 style="height: 200px; object-fit: cover;">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Action Buttons -->
                        <hr class="my-4">
                        <div class="mb-3 row d-print-none">
                            <div class="col-sm-12 text-end">
                                @can('edit_aids')
                                    <x-base.fillBtn href="{{ route($route . '.edit', [$model->id]) }}" 
                                                    icon="fa-edit" 
                                                    label="تعديل" 
                                                    class="btn-primary me-2" />
                                @endcan

                                @can('delete_aids')
                                    <button type="submit" class="btn btn-outline-danger border border-danger me-2"
                                            onclick="return confirm('هل أنت متأكد من حذف هذه الوظيفة؟')">
                                        <i class="fa fa-trash me-1"></i>{{ awtTrans('حذف') }}
                                    </button>
                                @endcan

                                <x-base.notfillBtn href="{{ route($route . '.index') }}" 
                                                   icon="fa-arrow-left" 
                                                   label="عودة"
                                                   class="btn-outline-secondary border border-secondary" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end content -->
@endsection

@push('styles')
<style>
    .form-control-plaintext {
        font-size: 0.95rem;
    }
    
    .badge {
        font-size: 0.85rem;
    }
    
    .card-img-top {
        cursor: pointer;
        transition: transform 0.2s;
    }
    
    .card-img-top:hover {
        transform: scale(1.05);
    }
    
    .bg-light {
        background-color: #f8f9fa !important;
    }
    
    h4 {
        border-bottom: 2px solid #dee2e6;
        padding-bottom: 0.5rem;
    }
</style>
@endpush

@push('scripts')
<script>
    // Add click event to images for modal view (optional)
    document.querySelectorAll('.card-img-top').forEach(img => {
        img.addEventListener('click', function() {
            // You can implement a modal here to show full-size image
            window.open(this.src, '_blank');
        });
    });
</script>
@endpush

@extends('layouts.master')

@section('content')

    <x-base.breadcrumb title="{{ App::getLocale() == 'en' ? $model->name_en : $model->name_ar }}" :translate="false" :breadcrumbs="[
        ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
        ['label' => 'الانجازات', 'url' => route($route . '.index')],
        ['label' => App::getLocale() == 'en' ? $model->name_en : $model->name_ar],
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
                            <label for="input1" class="col-sm-2 col-form-label">{{ awtTrans('name_en') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext fw-bold">{{ $model->name_ar }}</p>
                            </div>
                        </div>

                        
                        <div class="mb-3 row">
                            <label for="input1" class="col-sm-2 col-form-label">{{ awtTrans('name_ar') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext fw-bold">{{ $model->name_ar }}</p>
                            </div>
                        </div>

                        
                        <div class="mb-3 row">
                            <label for="input1" class="col-sm-2 col-form-label">{{ awtTrans('name_fr') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext fw-bold">{{ $model->name_fr }}</p>
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
                        @if($model->achievement_type_id)
                        <div class="mb-3 row">
                            <label for="input_code" class="col-sm-2 col-form-label">{{ awtTrans('النوع') }}</label>
                            <div class="col-sm-6">
                                <p class="form-control-plaintext">
                                     <span class="badge bg-primary">{{  App::getLocale() == 'en' ? $model->achievementType->name_en : $model->achievementType->name_ar  }}</span>
                                </p>
                            </div>
                        </div>
                        @endif

                        <!-- Job Image -->
                        @if($model->image)
                        <div class="mb-3 row">
                            <label for="input_image" class="col-sm-2 col-form-label">{{ awtTrans('صورة الوظيفة') }}</label>
                            <div class="col-sm-6">
                                <img src="{{ asset('uploads/achievements/' . $model->image) }}" alt="{{ $model->name }}" 
                                     class="img-thumbnail" style="max-width: 200px; max-height: 150px;">
                            </div>
                        </div>
                        @endif

                   
                        <!-- Content -->
                            <label for="input11" class="col-sm-2 col-form-label">{{ trans('awt.المحتوى') }}</label>

                        <div class="mb-3 row">
                            
                            <div class="col-sm-10">
                                <div class="border rounded p-3 bg-light">
                                    {!! nl2br(e($model->description_en)) !!}
                                </div>
                            </div>
                            <br>
                            <div class="col-sm-10">
                                <div class="border rounded p-3 bg-light">
                                    {!! nl2br(e($model->description_ar)) !!}
                                </div>
                            </div>
                            <br>
                            <div class="col-sm-10">
                                <div class="border rounded p-3 bg-light">
                                    {!! nl2br(e($model->description_fr)) !!}
                                </div>
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
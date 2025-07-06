@extends('layouts.master')

@section('content')
    <!--page title-->
    <x-base.breadcrumb title="تعديل منحة / معونة" :breadcrumbs="[
        ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
        ['label' => 'المنح والمعونات', 'url' => route($route . '.index')],
        ['label' => 'تعديل منحة / معونة'],
    ]" />

    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card shadow-sm mb-4">

                <div class="card-body">

                    @include('flash::message')
                    <form action="{{ route($route . '.update', [$model->id]) }}" method="post" enctype="multipart/form-data">


                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}

                        
                        <div class="form-group row">
                            <label for="inpu11"
                                class="col-sm-2 col-form-label">{{ awtTrans('نشط؟') }}</label>
                            <div class="col-sm-6">
                               <input type="checkbox" name="is_active" class="form-check-input" value="1" {{$model->is_active == 1 ? 'checked' : ''}} id="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inpu11"
                                class="col-sm-2 col-form-label">{{ awtTrans('name_en') }}</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" value="{{ old('title_en',$model->title_en) }}" required
                                    id="inpu11" name="title_en"
                                    placeholder="{{ awtTrans('name_en') }}">
                            </div>
                        </div>


                        
                        <div class="form-group row">
                            <label for="inpu11"
                                class="col-sm-2 col-form-label">{{ awtTrans('name_ar') }}</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" value="{{ old('title_ar',$model->title_ar) }}" required
                                    id="inpu11" name="title_ar"
                                    placeholder="{{ awtTrans('name_ar') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu11"
                                class="col-sm-2 col-form-label">{{ awtTrans('name_fr') }}</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" value="{{ old('title_fr',$model->title_fr) }}" required
                                    id="inpu11" name="title_fr"
                                    placeholder="{{ awtTrans('name_fr') }}">
                            </div>
                        </div>


                        
                        <div class="form-group row">
                            <label for="inpu11"
                                class="col-sm-2 col-form-label">{{ awtTrans('contact') }}</label>
                            <div class="col-sm-6">
                                <input type="tel" class="form-control" value="{{ old('contact',$model->contact) }}" required
                                    id="inpu11" name="contact"
                                    placeholder="{{ awtTrans('contact') }}">
                            </div>
                        </div>


                        
                        <div class="form-group row">
                            <label for="inpu11"
                                class="col-sm-2 col-form-label">{{ awtTrans('link') }}</label>
                            <div class="col-sm-6">
                                <input type="url" class="form-control" value="{{ old('url',$model->url) }}" required
                                    id="inpu11" name="url"
                                    placeholder="{{ awtTrans('link') }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inpu1" class="col-sm-2 col-form-label">{{ awtTrans('نوع المنحة') }}</label>
                            <div class="col-sm-6">
                                <select class="form-select selec_aids" required name="type_id">
                                    <option></option>
                                    @foreach (\App\Models\AidType::all() as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('type_id') == $item->id || $model->type_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->name_ar }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword3"
                                class="col-sm-2 col-form-label">{{ awtTrans('الدولة المستفيدة') }}</label>
                            <div class="col-sm-6">
                                <select class="form-select selc_country" required name="country_id">
                                    <option></option>
                                    @foreach (getCountries() as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ old('country_id') == $key || $model->country_id == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inpu11"
                                class="col-sm-2 col-form-label">{{ awtTrans('الجهة المتلقية بالدولة') }}</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" value="{{ $model->country_org }}" required
                                    id="inpu11" name="country_org"
                                    placeholder="{{ awtTrans('الجهة المتلقية بالدولة') }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inpu111"
                                class="col-sm-2 col-form-label">{{ awtTrans('موافقة السيد الوزير') }}</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" required value="{{ $model->minister_name }}"
                                    id="inpu111" name="minister_name"
                                    placeholder="{{ awtTrans('موافقة السيد الوزير') }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inpu5" class="col-sm-2 col-form-label">{{ awtTrans('تاريخ الشحن') }}</label>
                            <div class="col-sm-6">
                                <input type="text" name="ship_date" required
                                    value="{{ $model->ship_date->format('Y-m-d') }}" class="form-control date-picker-input"
                                    id="inpu5" placeholder="{{ awtTrans('تاريخ الشحن') }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inpu115" class="col-sm-2 col-form-label">{{ awtTrans('تاريخ الوصول') }}</label>
                            <div class="col-sm-6">
                                <input type="text" name="arrive_date" value="{{ $model->arrive_date->format('Y-m-d') }}"
                                    required class="form-control date-picker-input" id="inpu115"
                                    placeholder="{{ awtTrans('تاريخ الوصول') }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inpu10"
                                class="col-sm-2 col-form-label">{{ awtTrans('القيمة (شاملة الشحن)') }}</label>
                            <div class="col-sm-6">
                                <input type="number" min="0" name="cost" value="{{ $model->cost }}" required
                                    class="form-control" id="inpu10"
                                    placeholder="{{ awtTrans('القيمة (شاملة الشحن)') }}">
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="inpu10"
                                class="col-sm-12 col-form-label">{{ awtTrans('صورة') }}</label>
                                <input type="file" name="image" value="{{ old('image') }}" required
                                    class="form-control" id=""
                                    placeholder="{{ awtTrans('صورة') }}">
                        </div>


                        
                        <div class="form-group row">
                            <label for="inpu10"
                                class="col-sm-12 col-form-label">{{ trans('file') }}</label>
                                <input type="file" name="file" value="{{ old('file') }}" required
                                    class="form-control" id=""
                                    placeholder="{{ awtTrans('file') }}">
                        </div>

                         <div class="form-group row">
                            <div class="col-md-4">
                                <label for="inpu10"
                                    class="col-sm-12 col-form-label">{{ awtTrans('description_en') }}</label>
                                <textarea name="description_en" class="form-control" id="">{{old('description_en',$model->description_en)}}</textarea>
                            </div>

                            <div class="col-md-4">
                                 <label for="inpu10"
                                    class="col-sm-12 col-form-label">{{ awtTrans('description_ar') }}</label>
                                <textarea name="description_ar" class="form-control" id="">{{old('description_ar',$model->description_ar)}}</textarea>
                            </div>

                            
                            <div class="col-md-4">
                                   <label for="inpu10"
                                    class="col-sm-12 col-form-label">{{ awtTrans('description_fr') }}</label>
                                <textarea name="description_fr" class="form-control" id="">{{old('description_fr',$model->description_fr)}}</textarea>
                            </div>          
                        </div>
                        <hr>
                        <h4>{{ awtTrans('بيانات المورد') }}</h4>
                        @php($divn = 0)

                        @foreach ($model->suppliers as $sup)
                            @if ($errors->has('country'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('country') }}
                                </div>
                            @endif


                            @php($divn++)
                            <div class="country-item">
                                <span class="country-item-num" data-number="{{ $divn }}"></span>
                                <div class="mb-3 row">
                                    <label for="inpu10"
                                        class="col-sm-2 col-form-label">{{ awtTrans('اسم المورد') }}</label>
                                    <div class="col-sm-6">
                                        <select class="form-select selec_supp" required
                                            name="country[{{ $divn - 1 }}][id]">
                                            <option></option>
                                            @foreach (\App\Models\AidSupplier::all() as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $sup['id'] == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inpu10" class="col-sm-2 col-form-label">{{ awtTrans('القيمة') }}</label>
                                    <div class="col-sm-6">
                                        <input type="number" min="0" value="{{ $sup['cost'] }}"
                                            class="form-control" required name="country[{{ $divn - 1 }}][cost]"
                                            id="inpu10" placeholder="{{ awtTrans('القيمة') }}">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inpu9"
                                        class="col-sm-2 col-form-label">{{ awtTrans('التفاصيل') }}</label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" id="inpu9" required name="country[{{ $divn - 1 }}][details]" rows="6"
                                            placeholder="{{ awtTrans('التفاصيل') }}">{{ $sup['details'] }}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inpu10"
                                        class="col-sm-2 col-form-label">{{ awtTrans('تاريخ الإنتهاء / الصلاحية') }}</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control date-picker-input"
                                            name="country[{{ $divn - 1 }}][end_date]" value="{{ $sup['end_date'] }}"
                                            id="inpu10" placeholder="{{ awtTrans('تاريخ الإنتهاء / الصلاحية') }}">
                                    </div>
                                </div>
                                <hr />

                            </div>
                        @endforeach

                        <div id="new-div-country-item"></div>

                        <div class="mb-3 row">
                            <div class="col-sm-12 text-center">
                                <button type="button" class="btn btn-primary item-add" data-item-class="country-item"
                                    data-input-name="country">{{ awtTrans('اضافة') }}
                                </button>
                                <button type="button" class="btn btn-danger item-remove remove-supplier-btn"
                                    data-item-class="country-item">
                                    {{ awtTrans('حذف') }}
                                </button>
                            </div>
                        </div>
                        <hr />


                        <div class="mb-3 row">
                            <label for="inpu9" class="col-sm-2 col-form-label">{{ awtTrans('ملاحظات أخرى') }}</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="notes" id="inpu9" rows="6"
                                    placeholder="{{ awtTrans('ملاحظات أخرى') }}">{{ $model->notes }}</textarea>
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <div class="col-sm-12 text-end">
                                <button type="submit" class="btn btn-primary"> {{ awtTrans('تعديل') }}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <!--init select2-->
    <script>
     $(document).ready(function() {
    let supplierIndex = {{ count($model->suppliers) }}; // Start from existing suppliers count

    // Initialize Select2
    function initializeSelect2() {
        if ($.fn.select2) {
            $('[data-bs-toggle="select2"]').select2({
                width: '100%'
            });

            // Initialize by class for backward compatibility
            $(".selec_aids").select2({
                placeholder: "اختر نوع المنحة",
                width: '100%'
            });
            
            $(".selec_supp").select2({
                placeholder: "اختر اسم المورد",
                width: '100%'
            });
            
            // select country
            $(".selc_country").select2({
                placeholder: "اختر دولة",
                width: '100%'
            });
            
            $(".selc_stats").select2({
                placeholder: "اختر حالة الاتفاق",
                width: '100%'
            });
            
            $(".selec_coop").select2({
                placeholder: "اختر مجالات التعاون",
                width: '100%'
            });
        }
    }

    // Initialize date pickers
    function initializeDatePickers() {
        if ($.fn.datepicker) {
            $('.date-picker-input').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true
            });
        }
    }

    // Get supplier options from existing select
    function getSupplierOptions() {
        const existingSelect = $('.selec_supp').first();
        if (existingSelect.length) {
            return existingSelect.html();
        }
        
        // Fallback: generate options from server data if available
        let options = '<option></option>';
        @foreach (\App\Models\AidSupplier::all() as $item)
            options += '<option value="{{ $item->id }}">{{ $item->name }}</option>';
        @endforeach
        return options;
    }

    // Initial setup
    initializeSelect2();
    initializeDatePickers();
    updateSupplierNumbers();

    // Add Supplier Function - using the correct button class
    $(document).on('click', '.item-add[data-input-name="country"]', function() {
        const supplierOptions = getSupplierOptions();
        
        const newSupplierHtml = `
            <div class="country-item">
                <span class="country-item-num" data-number="${supplierIndex + 1}"></span>
                
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">{{ awtTrans('اسم المورد') }}</label>
                    <div class="col-sm-6">
                        <select class="form-select selec_supp" required name="country[${supplierIndex}][id]">
                            ${supplierOptions}
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">{{ awtTrans('القيمة') }}</label>
                    <div class="col-sm-6">
                        <input type="number" min="0" class="form-control" required
                            name="country[${supplierIndex}][cost]" placeholder="{{ awtTrans('القيمة') }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">{{ awtTrans('التفاصيل') }}</label>
                    <div class="col-sm-6">
                        <textarea class="form-control" required name="country[${supplierIndex}][details]" rows="6"
                            placeholder="{{ awtTrans('التفاصيل') }}"></textarea>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">{{ awtTrans('تاريخ الإنتهاء / الصلاحية') }}</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control date-picker-input"
                            name="country[${supplierIndex}][end_date]"
                            placeholder="{{ awtTrans('تاريخ الإنتهاء / الصلاحية') }}">
                    </div>
                </div>
                <hr />
            </div>
        `;

        $('#new-div-country-item').append(newSupplierHtml);
        supplierIndex++;

        // Re-initialize Select2 and date pickers for new elements
        initializeSelect2();
        initializeDatePickers();
        updateSupplierNumbers();
    });

    // Remove Supplier Function - using the correct button class
    $(document).on('click', '.item-remove[data-item-class="country-item"]', function() {
        const suppliers = $('.country-item');
        if (suppliers.length > 1) {
            suppliers.last().remove();
            updateSupplierNumbers();
        } else {
            alert('{{ awtTrans("يجب أن يكون هناك مورد واحد على الأقل") }}');
        }
    });

    // Update supplier numbers and input names
    function updateSupplierNumbers() {
        $('.country-item').each(function(index) {
            $(this).find('.country-item-num').text('').attr('data-number', index + 1);
            
            // Update input names to maintain proper indexing for existing items
            const namePrefix = `country[${index}]`;
            $(this).find('select[name*="[id]"]').attr('name', `${namePrefix}[id]`);
            $(this).find('input[name*="[cost]"]').attr('name', `${namePrefix}[cost]`);
            $(this).find('textarea[name*="[details]"]').attr('name', `${namePrefix}[details]`);
            $(this).find('input[name*="[end_date]"]').attr('name', `${namePrefix}[end_date]`);
        });
        
        // Update the supplierIndex to be the next available index
        supplierIndex = $('.country-item').length;
    }

    // Enhanced form validation
    $('form').submit(function(e) {
        let isValid = true;
        const requiredFields = $(this).find('[required]');
        
        requiredFields.each(function() {
            const value = $(this).val();
            if (value === '' || value === null || ($(this).is('select') && value === '')) {
                $(this).addClass('is-invalid');
                $(this).removeClass('is-valid');
                isValid = false;
            } else {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
            }
        });

        // Validate that at least one supplier exists
        if ($('.country-item').length === 0) {
            alert('{{ awtTrans("يجب إضافة مورد واحد على الأقل") }}');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
            alert('{{ awtTrans("يرجى ملء جميع الحقول المطلوبة") }}');
            
            // Scroll to first invalid field
            const firstInvalid = $('.is-invalid').first();
            if (firstInvalid.length) {
                $('html, body').animate({
                    scrollTop: firstInvalid.offset().top - 100
                }, 500);
                firstInvalid.focus();
            }
            
            return false;
        }
    });

    // Real-time validation feedback
    $(document).on('blur', '[required]', function() {
        const value = $(this).val();
        if (value === '' || value === null || ($(this).is('select') && value === '')) {
            $(this).addClass('is-invalid');
            $(this).removeClass('is-valid');
        } else {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        }
    });

    // Clear validation on focus
    $(document).on('focus', '.is-invalid', function() {
        $(this).removeClass('is-invalid');
    });
}); 
    </script>
@endpush

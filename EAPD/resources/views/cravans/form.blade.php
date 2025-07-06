@extends('layouts.master')

@section('content')
    <!--page title-->
    <x-base.breadcrumb :title="request()->routeIs('caravans.create') ? 'إضافة منحة / معونة' : 'تعديل منحة / معونة'" :breadcrumbs="[
        ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
        ['label' => 'فعاليات', 'url' => route($route . '.index')],
        ['label' => request()->routeIs('caravans.create') ? 'إضافة منحة / معونة' : 'تعديل منحة / معونة'],
    ]" />

    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="mb-4">
                <div class="card-body">

                    @include('flash::message')
                    <form action="{{ route($route . '.store') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="inpu11" class="col-sm-2 col-form-label">{{ awtTrans('نشط؟') }}</label>
                            <div class="col-sm-6">
                                <input type="checkbox" class="form-check-input" name="is_active" value="1" checked
                                    id="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu11" class="col-sm-2 col-form-label">{{ awtTrans('name_en') }}</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" value="{{ old('title_en') }}" required
                                    id="inpu11" name="title_en" placeholder="{{ awtTrans('name_en') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu11" class="col-sm-2 col-form-label">{{ awtTrans('name_ar') }}</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" value="{{ old('title_ar') }}" required
                                    id="inpu11" name="title_ar" placeholder="{{ awtTrans('name_ar') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu11" class="col-sm-2 col-form-label">{{ awtTrans('name_fr') }}</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" value="{{ old('title_fr') }}" required
                                    id="inpu11" name="title_fr" placeholder="{{ awtTrans('name_fr') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu1" class="col-sm-2 col-form-label">{{ awtTrans('نوع القافلة') }}</label>
                            <div class="col-sm-6">
                                <select class="form-select " required name="type_id">
                                    {{-- <option selected >{{trans('awt.اختر نوع القافلة')}}</option> --}}
                                    @foreach (\App\Models\AidType::all() as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('type_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name_ar }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword3"
                                class="col-sm-2 col-form-label">{{ awtTrans('الدولة المستفيدة') }}</label>
                            <div class="col-sm-6">
                                <select class="form-control selc_country" required name="country_id">
                                    <option selected disabled>{{ trans('awt.الدولة') }}</option>
                                    @foreach (getCountries() as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ old('country_id') == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu11"
                                class="col-sm-2 col-form-label">{{ awtTrans('الجهة المتلقية بالدولة') }}</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" value="{{ old('country_org') }}" required
                                    id="inpu11" name="country_org"
                                    placeholder="{{ awtTrans('الجهة المتلقية بالدولة') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu11" class="col-sm-2 col-form-label">{{ awtTrans('contact') }}</label>
                            <div class="col-sm-6">
                                <input type="tel" class="form-control" value="{{ old('contact') }}" required
                                    id="inpu11" name="contact" placeholder="{{ awtTrans('contact') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu11" class="col-sm-2 col-form-label">{{ awtTrans('link') }}</label>
                            <div class="col-sm-6">
                                <input type="url" class="form-control" value="{{ old('url') }}" required
                                    id="inpu11" name="url" placeholder="{{ awtTrans('link') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu111"
                                class="col-sm-2 col-form-label">{{ awtTrans('موافقة السيد الوزير') }}</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" required value="{{ old('minister_name') }}"
                                    id="inpu111" name="minister_name"
                                    placeholder="{{ awtTrans('موافقة السيد الوزير') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu5" class="col-sm-2 col-form-label">{{ awtTrans('تاريخ الشحن') }}</label>
                            <div class="col-sm-6">
                                <input type="text" name="ship_date" required value="{{ old('ship_date') }}"
                                    class="form-control date-picker-input" id="inpu5"
                                    placeholder="{{ awtTrans('تاريخ الشحن') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu115" class="col-sm-2 col-form-label">{{ awtTrans('تاريخ الوصول') }}</label>
                            <div class="col-sm-6">
                                <input type="text" name="arrive_date" value="{{ old('arrive_date') }}" required
                                    class="form-control date-picker-input" id="inpu115"
                                    placeholder="{{ awtTrans('تاريخ الوصول') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu10"
                                class="col-sm-2 col-form-label">{{ awtTrans('القيمة (شاملة الشحن)') }}</label>
                            <div class="col-sm-6">
                                <input type="number" min="0" name="cost" value="{{ old('cost') }}"
                                    required class="form-control" id="inpu10"
                                    placeholder="{{ awtTrans('القيمة (شاملة الشحن)') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inpu10" class="col-sm-12 col-form-label">{{ awtTrans('صورة') }}</label>
                            <input type="file" name="image" value="{{ old('image') }}" required
                                class="form-control" id="" placeholder="{{ awtTrans('صورة') }}">
                        </div>

                        <div class="form-group row">
                            <label for="inpu10" class="col-sm-12 col-form-label">{{ trans('file') }}</label>
                            <input type="file" name="file" value="{{ old('file') }}" required
                                class="form-control" id="" placeholder="{{ awtTrans('file') }}">
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="inpu10"
                                    class="col-sm-12 col-form-label">{{ awtTrans('description_en') }}</label>
                                <textarea name="description_en" class="form-control" id="">{{ old('description_en') }}</textarea>
                            </div>

                            <div class="col-md-4">
                                <label for="inpu10"
                                    class="col-sm-12 col-form-label">{{ awtTrans('description_ar') }}</label>
                                <textarea name="description_ar" class="form-control" id="">{{ old('description_ar') }}</textarea>
                            </div>

                            <div class="col-md-4">
                                <label for="inpu10"
                                    class="col-sm-12 col-form-label">{{ awtTrans('description_fr') }}</label>
                                <textarea name="description_fr" class="form-control" id="">{{ old('description_fr') }}</textarea>
                            </div>
                        </div>

                        <hr>
                        <h4>{{ awtTrans('بيانات المورد') }}</h4>

                        <div id="suppliers-container">
                            <div class="country-item" data-index="0">
                                <span class="country-item-num" data-number="1"></span>

                                <div class="form-group row">
                                    <label for="inpu10"
                                        class="col-sm-2 col-form-label">{{ awtTrans('اسم المورد') }}</label>
                                    <div class="col-sm-6">
                                        <select class="form-control selec_supp" required name="suppliers[0][id]">
                                            <option value="">{{ awtTrans('اختر المورد') }}</option>
                                            @foreach (\App\Models\AidSupplier::all() as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inpu10"
                                        class="col-sm-2 col-form-label">{{ awtTrans('القيمة') }}</label>
                                    <div class="col-sm-6">
                                        <input type="number" min="0" class="form-control" required
                                            name="suppliers[0][cost]" id="inpu10"
                                            placeholder="{{ awtTrans('القيمة') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inpu9"
                                        class="col-sm-2 col-form-label">{{ awtTrans('التفاصيل') }}</label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" id="inpu9" required name="suppliers[0][details]" rows="6"
                                            placeholder="{{ awtTrans('التفاصيل') }}"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inpu10"
                                        class="col-sm-2 col-form-label">{{ awtTrans('تاريخ الإنتهاء / الصلاحية') }}</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control date-picker-input"
                                            name="suppliers[0][end_date]" id="inpu10"
                                            placeholder="{{ awtTrans('تاريخ الإنتهاء / الصلاحية') }}">
                                    </div>
                                </div>
                                <hr />
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12 text-center">
                                <button type="button" class="btn btn-primary" id="add-supplier">
                                    {{ awtTrans('إضافة') }}
                                </button>
                                <button type="button" class="btn btn-danger" id="remove-supplier">
                                    {{ awtTrans('حذف') }}
                                </button>
                            </div>
                        </div>
                        <hr />

                        <div class="form-group row">
                            <label for="inpu9" class="col-sm-2 col-form-label">{{ awtTrans('ملاحظات أخرى') }}</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="notes" id="inpu9" rows="6"
                                    placeholder="{{ awtTrans('ملاحظات أخرى') }}">{{ old('notes') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn btn-primary"> {{ awtTrans('إضافة') }}</button>
                                <button type="reset" class="btn btn-danger">{{ awtTrans('إلغاء') }}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .country-item {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f8f9fa;
            position: relative;
        }

        .country-item-num {
            position: absolute;
            top: -10px;
            right: 20px;
            background-color: #007bff;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
        }

        .country-item-num:before {
            content: "مورد رقم ";
        }
    </style>
@endpush

@push('scripts')
    <!--init select2-->
    <script>
        $(document).ready(function() {
            let supplierIndex = 1;

            // Initialize Select2
            function initializeSelect2() {
                if ($.fn.select2) {
                    $('[data-bs-toggle="select2"]').select2({
                        width: '100%'
                    });

                    // Also initialize by class for backward compatibility
                    $(".selec_aids").select2({
                        placeholder: "اختر نوع القافلة",
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

            // Initial setup
            initializeSelect2();
            initializeDatePickers();
            updateSupplierNumbers();

            // Add Supplier Function
            $('#add-supplier').click(function() {
                const supplierOptions = $('.selec_supp').first().html();

                const newSupplierHtml = `
                    <div class="country-item" data-index="${supplierIndex}">
                        <span class="country-item-num" data-number="${supplierIndex + 1}"></span>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">{{ awtTrans('اسم المورد') }}</label>
                            <div class="col-sm-6">
                                <select class="form-control selec_supp" required name="suppliers[${supplierIndex}][id]">
                                    ${supplierOptions}
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">{{ awtTrans('القيمة') }}</label>
                            <div class="col-sm-6">
                                <input type="number" min="0" class="form-control" required
                                    name="suppliers[${supplierIndex}][cost]" placeholder="{{ awtTrans('القيمة') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">{{ awtTrans('التفاصيل') }}</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" required name="suppliers[${supplierIndex}][details]" rows="6"
                                    placeholder="{{ awtTrans('التفاصيل') }}"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">{{ awtTrans('تاريخ الإنتهاء / الصلاحية') }}</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control date-picker-input"
                                    name="suppliers[${supplierIndex}][end_date]"
                                    placeholder="{{ awtTrans('تاريخ الإنتهاء / الصلاحية') }}">
                            </div>
                        </div>
                        <hr />
                    </div>
                `;

                $('#suppliers-container').append(newSupplierHtml);
                supplierIndex++;

                // Re-initialize Select2 and date pickers for new elements
                initializeSelect2();
                initializeDatePickers();
                updateSupplierNumbers();
            });

            // Remove Supplier Function
            $('#remove-supplier').click(function() {
                const suppliers = $('.country-item');
                if (suppliers.length > 1) {
                    suppliers.last().remove();
                    supplierIndex = Math.max(1, supplierIndex - 1);
                    updateSupplierNumbers();
                } else {
                    alert('{{ awtTrans('يجب أن يكون هناك مورد واحد على الأقل') }}');
                }
            });

            // Update supplier numbers
            function updateSupplierNumbers() {
                $('.country-item').each(function(index) {
                    $(this).find('.country-item-num').text('').attr('data-number', index + 1);
                    $(this).attr('data-index', index);

                    // Update input names to maintain proper indexing
                    $(this).find('select[name*="suppliers"]').attr('name', `suppliers[${index}][id]`);
                    $(this).find('input[name*="[cost]"]').attr('name', `suppliers[${index}][cost]`);
                    $(this).find('textarea[name*="[details]"]').attr('name',
                        `suppliers[${index}][details]`);
                    $(this).find('input[name*="[end_date]"]').attr('name', `suppliers[${index}][end_date]`);
                });
            }

            // Form validation
            $('form').submit(function(e) {
                let isValid = true;
                const requiredFields = $(this).find('[required]');

                requiredFields.each(function() {
                    if ($(this).val() === '' || $(this).val() === null) {
                        $(this).addClass('is-invalid');
                        isValid = false;
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    alert('{{ awtTrans('يرجى ملء جميع الحقول المطلوبة') }}');
                    return false;
                }
            });
        });
    </script>
@endpush

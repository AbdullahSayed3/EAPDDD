<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="mb-4">
            <!-- Quick Search Form -->
            <form id="quick-search-form">
                <div class="row w-100 align-items-center mb-3">
                    <div class="col-sm-2"></div>
                    <x-base.input placeholder="{{ awtTrans('تفاصيل المنحة') }}" name="details" type="text"
                        value="{{ getRequest('details') }}" id="quick_details" containerClass="col-sm-7"
                        inputClass="shadow py-3" showSearchIcon />
                    <div class="col-sm-1">
                        <button type="button" class="w-auto btn w-100" data-bs-toggle="modal"
                            data-bs-target="#advancedSearchModal">
                            <x-icon name="filter" />
                        </button>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
                <div class="row justify-content-center mb-3">
                    <x-base.dropdown label="{{trans('awt.نوع المنحة')}}" name="type_id" :options="\App\Models\AidType::all()
                        ->mapWithKeys(fn($item) => [$item->id => $item->name_ar])
                        ->toArray()" class="form-select selec_aids"
                        containerClass="col-sm-3" id="quick_type" />
                    <x-base.dropdown label="{{ awtTrans('الدولة') }}" name="country" :options="getCountries()"
                        class="form-select selc_country" containerClass="col-sm-3" id="quick_country" />
                    <x-base.input label="{{ awtTrans('تاريخ الشحن من') }}" name="ship_date" type="text"
                        value="{{ getRequest('ship_date') }}" class="form-control date-picker-input col-sm-3"
                        id="quick_ship_date" />
                    <div class="d-flex flex-column col-sm-2 text-end">
                        <x-base.fillBtn type="submit" name="submit" value="search" class="btn btn-primary"
                            icon="fa-search" label="{{ awtTrans('بحث') }}" />
                        <x-base.notfillBtn type="button" id="reset-search"
                            class="btn-outline-warning border-warning text-primary" icon="fa-refresh"
                            label="{{ awtTrans('إعادة تعيين') }}" />
                    </div>
                </div>
            </form>

            <!-- Advanced Search Modal -->
            <div class="modal fade" id="advancedSearchModal" tabindex="-1" aria-labelledby="advancedSearchModalLabel">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="advancedSearchModalLabel">{{ awtTrans('بحث متقدم') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="advanced-search-form">
                                <div class="row mb-3 justify-content-center">
                                    <x-base.inputModal label="{{ awtTrans('تفاصيل المنحة') }}" name="details"
                                        type="text" prefix="adv" id="adv_details" class="col-sm-8" showSearchIcon
                                        labelClass="col-sm-3" />
                                </div>

                                <div class="row mb-3">
                                    <x-base.dropdownModal label="{{ awtTrans('نوع المنحة') }}" name="type_id"
                                        :options="\App\Models\AidType::all()
                                            ->mapWithKeys(fn($item) => [$item->id => $item->name_ar])
                                            ->toArray()" class="form-select selec_aids" prefix="adv"
                                        id="adv_type" />
                                    <x-base.dropdownModal label="{{ awtTrans('الدولة') }}" name="country"
                                        :options="getCountries()" class="form-select selc_country" prefix="adv"
                                        id="adv_country" />
                                </div>

                                <div class="row mb-3">
                                    <x-base.inputModal label="{{ awtTrans('تاريخ الشحن من') }}" name="ship_date_from"
                                        type="text" inputClass="form-control date-picker-input" prefix="adv"
                                        id="adv_ship_date_from" />
                                    <x-base.inputModal label="{{ awtTrans('تاريخ الشحن الي') }}" name="ship_date_to"
                                        type="text" inputClass="form-control date-picker-input" prefix="adv"
                                        id="adv_ship_date_to" />
                                </div>

                                <div class="row mb-3">
                                    <x-base.inputModal label="{{ awtTrans('تاريخ الوصول من') }}"
                                        name="arrive_date_from" type="text"
                                        inputClass="form-control date-picker-input" prefix="adv"
                                        id="adv_arrive_date_from" />
                                    <x-base.inputModal label="{{ awtTrans('تاريخ الوصول الي') }}"
                                        name="arrive_date_to" type="text"
                                        inputClass="form-control date-picker-input" prefix="adv"
                                        id="adv_arrive_date_to" />
                                </div>

                                <div class="row mb-3">
                                    <x-base.inputModal label="{{ awtTrans('اسم المورد') }}" name="supplier"
                                        type="text" prefix="adv" id="adv_supplier" />
                                    <x-base.inputModal label="{{ awtTrans('تاريخ الإنتهاء / الصلاحية') }}"
                                        name="supplier_end_date" type="text"
                                        inputClass="form-control date-picker-input" prefix="adv"
                                        id="adv_supplier_end_date" />
                                </div>

                                <div class="row mb-3">
                                    <x-base.inputModal label="{{ awtTrans('القيمة الحد الأدني') }}" name="cost_min"
                                        type="number" prefix="adv" id="adv_cost_min" />
                                    <x-base.inputModal label="{{ awtTrans('القيمة الحد الأقصى') }}" name="cost_max"
                                        type="number" prefix="adv" id="adv_cost_max" />
                                </div>

                                <div class="row mb-3">
                                    <x-base.inputModal label="{{ awtTrans('رقم موافقة الوزير أو مجلس الإدارة') }}"
                                        name="minister_name" type="text" prefix="adv" id="adv_minister_name" />
                                    <x-base.inputModal label="{{ awtTrans('الجهة المستفيدة') }}" name="country_org"
                                        type="text" prefix="adv" id="adv_country_org" />
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <x-base.notfillBtn type="button" id="clear-advanced-search"
                                class="btn-outline-warning border-warning text-primary" icon="fa-refresh"
                                label="{{ awtTrans('إعادة تعيين') }}" />
                            <x-base.fillBtn type="button" class="btn-danger" modalDismiss="modal"
                                label="{{ awtTrans('إغلاق') }}" />
                            <x-base.fillBtn type="submit" form="advanced-search-form" class="btn btn-primary"
                                icon="fa-search" label="{{ awtTrans('بحث') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize select2
            $(".selc_country").select2({
                placeholder: "{{ awtTrans('اختر دولة') }}"
            });
            $(".selec_aids").select2({
                placeholder: "{{ awtTrans('اختر نوع المنحة') }}"
            });

            // Handle advanced search form submit
            document.getElementById('advanced-search-form').addEventListener('submit', function() {
                var modal = bootstrap.Modal.getInstance(document.getElementById('advancedSearchModal'));
                modal.hide();
            });

            // Function to clear URL parameters
            function clearUrlParameters() {
                const url = new URL(window.location.href);
                url.search = '';
                window.history.replaceState({}, '', url);
            }

            // Reset quick search form
            document.getElementById('reset-search').addEventListener('click', function(e) {
                e.preventDefault();
                var quickForm = document.getElementById('quick-search-form');
                if (quickForm && typeof quickForm.reset === 'function') {
                    quickForm.reset();
                }

                $('#quick_details').val('');
                // Reset select2 dropdowns
                $('#quick_type').val(null).trigger('change');
                $('#quick_country').val(null).trigger('change');

                // Reset date pickers
                $('#quick_ship_date').val('');

                // Clear URL parameters and reload the page
                clearUrlParameters();
                window.location.reload();
            });

            // Reset advanced search form
            document.getElementById('clear-advanced-search').addEventListener('click', function() {
                var advancedForm = document.getElementById('advanced-search-form');
                if (advancedForm && typeof advancedForm.reset === 'function') {
                    advancedForm.reset();
                }

                // Reset select2 dropdowns
                $('#adv_type').val(null).trigger('change');
                $('#adv_country').val(null).trigger('change');

                // Reset date pickers
                $('#adv_ship_date_from').val('');
                $('#adv_ship_date_to').val('');
                $('#adv_arrive_date_from').val('');
                $('#adv_arrive_date_to').val('');
                $('#adv_supplier_end_date').val('');

                // Reset number inputs
                $('#adv_cost_min').val('');
                $('#adv_cost_max').val('');

                // Reset text inputs
                $('#adv_details').val('');
                $('#adv_supplier').val('');
                $('#adv_minister_name').val('');
                $('#adv_country_org').val('');
            });
        });
    </script>
@endpush

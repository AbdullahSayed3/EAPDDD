<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="mb-4">
            <!-- Quick Search Form -->
            <form id="quick-search-form" method="GET" action="{{ route($route . '.index') }}">
                <div class="row w-100 align-items-center mb-3">
                    <div class="col-sm-2"></div>
                    <x-base.input id="quick-search-name" name="name" placeholder="{{ awtTrans('بحث باﻷسم') }}"
                        :value="getRequest('name')" containerClass="col-sm-7" inputClass="shadow py-3" showSearchIcon="true" />
                    <div class="col-sm-1">
                        <button type="button" class="w-auto btn w-100" data-bs-toggle="modal"
                            data-bs-target="#advancedSearchModal" id="advanced-search-btn">
                            <x-icon name="filter" />
                        </button>
                    </div>
                    <div class="col-sm-2"></div>
                </div>

                <div class="row justify-content-center mb-3 align-items-end">
                    <x-base.dropdown id="quick-delegate-country" label="{{ awtTrans('الدولة الموفد إليها حالياً') }}"
                        name="delegate_country" :options="getCountries()" :value="getRequest('delegate_country')" class="form-select selc_country"
                        containerClass="col-12 col-sm-3" multiple="true" />

                    <x-base.dropdown id="quick-status" label="{{ awtTrans('حالة الخبير') }}" name="status"
                        :options="[
                            'current' => awtTrans('خبير حالي'),
                            'old' => awtTrans('خبير سابق'),
                            'candidate' => awtTrans('مرشح للعمل'),
                        ]" :value="getRequest('status')" class="form-select selec_stat_exp" multiple="true"
                        containerClass="col-12 col-sm-2" />

                    {{-- <x-base.dropdown id="quick-delegate-org" label="{{ awtTrans('الجهة الموفد إليها حالياً') }}"
                        name="delegate_org" :options="getDelegateOrgs()" :value="getRequest('delegate_org')" class="form-select selec_org"
                        containerClass="col-12 col-sm-3" multiple="true" /> --}}

                    {{-- <x-base.dropdown id="quick-delegate-org" label="{{ awtTrans('الجهة الموفد إليها حالياً') }}"
                        name="delegate_org" :options="getDelegateOrgs()" :value="getRequest('delegate_org')" class="form-select selec_org"
                        containerClass="col-12 col-sm-3" multiple="true" /> --}}
                    <x-base.input id="quick-specialist" label="{{ awtTrans('التخصص') }}" name="specialist"
                        :value="getRequest('specialist')" class="col-sm-3" />
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
                            <form id="advanced-search-form" method="GET" action="{{ route($route . '.index') }}">
                                <input type="hidden" name="advanced" value="true">
                                <div class="row mb-3">
                                    <x-base.inputModal label="{{ awtTrans('بحث باﻷسم') }}" name="name"
                                        :value="getRequest('name')" prefix="adv" id="adv-name" showSearchIcon />
                                    <x-base.dropdownModal label="{{ awtTrans('حالة الخبير') }}" name="status"
                                        :options="[
                                            'current' => awtTrans('خبير حالي'),
                                            'old' => awtTrans('خبير سابق'),
                                            'candidate' => awtTrans('مرشح للعمل'),
                                        ]" :value="getRequest('status')" class="form-select selec_stat_exp"
                                        multiple="true" prefix="adv" id="adv-status" />
                                </div>

                                <div class="row mb-3">
                                    <x-base.inputModal label="{{ awtTrans('التخصص') }}" name="specialist"
                                        :value="getRequest('specialist')" prefix="adv" id="adv-specialist" />
                                    <x-base.inputModal label="{{ awtTrans('التخصص الفرعي') }}" name="sub_specialist"
                                        :value="getRequest('sub_specialist')" prefix="adv" id="adv-sub-specialist" />
                                </div>

                                <div class="row mb-3">
                                    <x-base.inputModal label="{{ awtTrans('بداية التعاقد من') }}" name="contract_from"
                                        type="date" :value="getRequest('contract_from')" prefix="adv" id="adv-contract-from" />
                                    <x-base.inputModal label="{{ awtTrans('بداية التعاقد إلى') }}" name="contract_to"
                                        type="date" :value="getRequest('contract_to')" prefix="adv" id="adv-contract-to" />
                                </div>

                                <div class="row mb-3">
                                    <x-base.inputModal label="{{ awtTrans('نهاية التعاقد من') }}"
                                        name="contract_end_from" type="date" :value="getRequest('contract_end_from')" prefix="adv"
                                        id="adv-contract-end-from" />
                                    <x-base.inputModal label="{{ awtTrans('نهاية التعاقد إلى') }}"
                                        name="contract_end_to" type="date" :value="getRequest('contract_end_to')" prefix="adv"
                                        id="adv-contract-end-to" />
                                </div>

                                <div class="row mb-3">
                                    <x-base.inputModal label="{{ awtTrans('المؤهل الدراسي') }}" name="qualification"
                                        :value="getRequest('qualification')" prefix="adv" id="adv-qualification" />
                                    <x-base.dropdownModal label="{{ awtTrans('النوع') }}" name="gender"
                                        :options="[
                                            'male' => awtTrans('ذكر'),
                                            'female' => awtTrans('أنثى'),
                                        ]" :value="getRequest('gender')" prefix="adv" id="adv-gender" />
                                </div>

                                <div class="row mb-3">
                                    <x-base.inputModal label="{{ awtTrans('اللغات التي يجيدها') }}" name="languages"
                                        :value="getRequest('languages')" prefix="adv" id="adv-languages" />
                                    <x-base.inputModal label="{{ awtTrans('جهة العمل الحالية') }}"
                                        name="current_employer" :value="getRequest('current_employer')" prefix="adv"
                                        id="adv-current-employer" />
                                </div>

                                <div class="row mb-3">
                                    <x-base.inputModal label="{{ awtTrans('رقم الهاتف') }}" name="phone"
                                        :value="getRequest('phone')" prefix="adv" id="adv-phone" />
                                    <x-base.inputModal label="{{ awtTrans('البريد الإلكتروني') }}" name="email"
                                        :value="getRequest('email')" prefix="adv" id="adv-email" />
                                </div>

                                <div class="row mb-3">
                                    <x-base.dropdownModal label="{{ awtTrans('الدولة الموفد إليها حالياً') }}"
                                        name="delegate_country" :options="getCountries()" :value="getRequest('delegate_country')"
                                        class="form-select selc_country" prefix="adv" multiple="true"
                                        id="adv-delegate-country" />
                                    <x-base.inputModal label="{{ awtTrans('الجهة الموفد إليها حالياً') }}"
                                        name="delegate_org" :value="getRequest('delegate_org')" prefix="adv"
                                        id="adv-delegate-org" />
                                </div>

                                <div class="row mb-3">
                                    <x-base.inputModal label="{{ awtTrans('التكلفة السنوية من') }}" name="cost_from"
                                        :value="getRequest('cost_from')" placeholder="{{ awtTrans('التكلفة السنوية الحد الأدنى') }}"
                                        prefix="adv" id="adv-cost-from" />
                                    <x-base.inputModal label="{{ awtTrans('التكلفة السنوية إلى') }}" name="cost_to"
                                        :value="getRequest('cost_to')" placeholder="{{ awtTrans('التكلفة السنوية الحد الأقصى') }}"
                                        prefix="adv" id="adv-cost-to" />
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Select2 dropdowns
        $(".selc_country").select2({
            placeholder: "{{ awtTrans('اختر دولة') }}"
        });

        $(".selec_stat_exp").select2({
            placeholder: "{{ awtTrans('اختر حالة الخبير') }}"
        });

        // Override default form submission behavior for BOTH forms
        $('#quick-search-form, #advanced-search-form').on('submit', function(e) {
            e.preventDefault();

            // Manually create the form values collection 
            var formData = new FormData(this);
            var queryString = new URLSearchParams();

            // Add all form fields to query string
            for (const [key, value] of formData.entries()) {
                if (value) {
                    queryString.append(key, value);
                }
            }

            // Handle multi-select fields specially - convert to single parameter with comma-separated values
            var formID = this.id;
            var countrySelector = formID === 'quick-search-form' ? '#quick-delegate-country' :
                '#adv-delegate-country';
            var statusSelector = formID === 'quick-search-form' ? '#quick-status' : '#adv-status';

            var countryValues = $(countrySelector).val();
            if (countryValues && countryValues.length) {
                // Remove the individual entries added above
                queryString.delete('delegate_country');
                // Add as a single entry with comma-separated values
                queryString.append('delegate_country', countryValues.join(','));
            }

            var statusValues = $(statusSelector).val();
            if (statusValues && statusValues.length) {
                // Remove the individual entries added above
                queryString.delete('status');
                // Add as a single entry with comma-separated values
                queryString.append('status', statusValues.join(','));
            }

            // Add advanced=true parameter for advanced search form
            if (formID === 'advanced-search-form') {
                queryString.append('advanced', 'true');
            }

            // Redirect to the page with the query parameters
            window.location.href = '{{ route($route . '.index') }}?' + queryString.toString();
        });

        // Reset quick search form
        document.getElementById('reset-search').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('quick-search-form').reset();
            if (typeof $ !== 'undefined') {
                $('.selc_country, .selec_stat_exp').val(null).trigger('change');
            }
            window.location.href = '{{ route($route . '.index') }}';
        });

        // Reset advanced search form
        document.getElementById('clear-advanced-search').addEventListener('click', function() {
            document.getElementById('advanced-search-form').reset();
            if (typeof $ !== 'undefined') {
                $('.selc_country').val(null).trigger('change');
                $('#adv-status').val(null).trigger('change');
            }
        });
    });
</script>

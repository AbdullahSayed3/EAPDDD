<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="mb-4">
            {{-- <div class="card-body"> --}}
            <!-- Quick Search Form -->
            <form id="quick-search-form">
                <div class="row w-100 justify-content-center align-items-center mb-3">
                    <div class="col-sm-2"></div>
                    <x-base.input placeholder="{{ awtTrans('الاسم') }}" name="first_name" type="text"
                        value="{{ getRequest('first_name') }}" id="quick_first_name" containerClass="col-sm-7"
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
                    <x-base.dropdown label="{{ awtTrans('الدولة') }}" name="country" :options="getCountries()"
                        class="form-select selc_country" containerClass="col-sm-3" id="quick_country" />

                    <x-base.dropdown label="{{ awtTrans('اسم الدورة') }}" id="quick_course" name="course"
                        :options="\App\Models\Course::all()
                            ->mapWithKeys(fn($item) => [$item->id => $item->name_ar])
                            ->toArray()" class="form-select selc_course" containerClass="col-sm-3" />

                    <x-base.dropdown label="{{ awtTrans('النوع') }}" id="quick_gender" name="gender" :options="[
                        ['value' => '', 'text' => ''],
                        ['value' => 'male', 'text' => awtTrans('ذكر')],
                        ['value' => 'female', 'text' => awtTrans('أنثى')],
                    ]"
                        class="form-select selc_gender" containerClass="col-sm-3" />

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
                            <h5 class="modal-title" id="advancedSearchModalLabel">{{ __('بحث متقدم') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="advanced-search-form">
                                <div class="row mb-3">
                                    <x-base.inputModal label="{{ awtTrans('الاسم الاول') }}" name="first_name"
                                        type="text" prefix="adv" id="adv_first_name" showSearchIcon />
                                    <x-base.inputModal label="{{ awtTrans('الاسم الثاني') }}" name="second_name"
                                        type="text" prefix="adv" id="adv_second_name" showSearchIcon />
                                </div>

                                <div class="row mb-3">
                                    <x-base.inputModal label="{{ awtTrans('اللقب') }}" name="third_name" type="text"
                                        prefix="adv" id="adv_third_name" />
                                    <x-base.dropdownModal label="{{ awtTrans('الدولة') }}" name="country"
                                        :options="getCountries()" class="form-select selc_country" prefix="adv"
                                        id="adv_country" />
                                </div>

                                <div class="row mb-3">
                                    <x-base.dropdownModal label="{{ awtTrans('اسم الدورة') }}" name="course"
                                        :options="\App\Models\Course::all()
                                            ->mapWithKeys(fn($item) => [$item->id => $item->name_ar])
                                            ->toArray()" class="form-select selc_course" prefix="adv"
                                        id="adv_course" />
                                    <x-base.dropdownModal label="{{ awtTrans('النوع') }}" name="gender"
                                        :options="[
                                            ['value' => '', 'text' => ''],
                                            ['value' => 'male', 'text' => awtTrans('ذكر')],
                                            ['value' => 'female', 'text' => awtTrans('أنثى')],
                                        ]" class="form-select selc_gender" prefix="adv"
                                        id="adv_gender" />
                                </div>

                                <div class="row mb-3">
                                    <x-base.inputModal label="{{ awtTrans('التاريخ من') }}" name="date_from"
                                        type="text" inputClass="form-control date-picker-input" prefix="adv"
                                        id="adv_date_from" />
                                    <x-base.inputModal label="{{ awtTrans('التاريخ إلى') }}" name="date_to"
                                        type="text" inputClass="form-control date-picker-input" prefix="adv"
                                        id="adv_date_to" />
                                </div>

                                @if (getRequest('advanced') == 'true')
                                    <div class="row mb-3">
                                        <x-base.inputModal label="{{ awtTrans('إجمالي عدد المتدربين من') }}"
                                            name="app_from" type="number" prefix="adv" id="adv_app_from" />
                                        <x-base.inputModal label="{{ awtTrans('إجمالي عدد المتدربين إلى') }}"
                                            name="app_to" type="number" prefix="adv" id="adv_app_to" />
                                    </div>

                                    <div class="row mb-3">
                                        <x-base.inputModal label="{{ awtTrans('عدد المتدربات النساء من') }}"
                                            name="appfem_from" type="number" prefix="adv" id="adv_appfem_from" />
                                        <x-base.inputModal label="{{ awtTrans('عدد المتدربات النساء إلى') }}"
                                            name="appfem_to" type="number" prefix="adv" id="adv_appfem_to" />
                                    </div>
                                @endif
                            </form>
                        </div>
                        <div class="modal-footer">
                            <x-base.notfillBtn type="button" id="clear-advanced-search"
                                class="btn-outline-warning border-warning text-primary" icon="fa-refresh"
                                label="{{ awtTrans('إعادة تعيين') }}" />
                            <x-base.fillBtn type="button" class="btn-danger" modalDismiss="modal" label="إغلاق" />
                            <x-base.fillBtn type="submit" form="advanced-search-form" class="btn btn-primary"
                                icon="fa-search" label="{{ awtTrans('بحث') }}" />
                        </div>
                    </div>
                </div>
            </div>
            {{-- </div> --}}
        </div>
    </div>
</div>
<script>
    document.getElementById('advanced-search-form').addEventListener('submit', function() {
        var modal = bootstrap.Modal.getInstance(document.getElementById('advancedSearchModal'));
        modal.hide();
    });

    // Initialize search functionality when document is ready
    document.addEventListener('DOMContentLoaded', function() {

        // Handle Reset Search
        document.getElementById('reset-search').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('quick-search-form').reset();
            if (typeof $ !== 'undefined') {
                $('.selc_country, .selc_course, .selc_gender').val(null).trigger('change');
            }
            window.location.reload();
        });

        // Handle Clear Advanced Search Form
        document.getElementById('clear-advanced-search').addEventListener('click', function() {
            document.getElementById('advanced-search-form').reset();
            if (typeof $ !== 'undefined') {
                $('.selc_country, .selc_course, .selc_gender').val(null).trigger('change');
            }
            window.location.reload();
        });
    });
</script>

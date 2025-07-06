<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="mb-4">
            {{-- <div class="card-body"> --}}
            <!-- Quick Search Form -->
            <form id="quick-search-form">
                <div class="row w-100 align-items-center mb-3">
                    <div class="col-sm-2"></div>
                    <x-base.input placeholder="{{ awtTrans('اسم الدورة') }}" name="name" type="text"
                        value="{{ getRequest('name') }}" id="quick_name" containerClass="col-sm-7" inputClass="shadow py-3"
                        showSearchIcon />
                    <div class="col-sm-1">
                        <button type="button" class="w-auto btn w-100" data-bs-toggle="modal"
                            data-bs-target="#advancedSearchModal">
                            <x-icon name="filter" />
                        </button>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
                <div class="row justify-content-center mb-3">
                    <x-base.dropdown label="{{ awtTrans('الدول المشاركة') }}" name="country" :options="getCountries()"
                        class="form-select selc_cour_typ" containerClass="col-sm-3" id="quick_country" />
                    <x-base.dropdown label=" {{ awtTrans('نوع الدورة') }}" id="quick_type" name="type"
                        :options="[
                            ['value' => '0', 'text' => ''],
                            ['value' => 'citizan', 'text' => 'مدني'],
                            ['value' => 'army', 'text' => 'الجيش'],
                            ['value' => 'police', 'text' => 'الشرطه'],
                        ]" multiple class="form-select selc_cour_typ" containerClass="col-sm-3"
                        :showArrow="true" />
                    <x-base.dropdown label="{{ awtTrans('جهة التدريب') }}" id="quick_organization" name="organization"
                        :options="\App\Models\CoursePartner::all()
                            ->mapWithKeys(fn($item) => [$item->id => $item->name])
                            ->toArray()" multiple class="form-select selc_cour_train" containerClass="col-sm-3" />
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
                                    <x-base.inputModal label="{{ awtTrans('اسم الدورة التدريبية') }}" name="name"
                                        type="text" prefix="adv" id="adv_name" class="col-sm-8" showSearchIcon
                                        labelClass="col-sm-3" />
                                </div>

                                <div class="row mb-3">
                                    <x-base.dropdownModal label="{{ awtTrans('نوع الدورة') }}" id="adv_type"
                                        name="type" :options="[
                                            ['value' => '0', 'text' => ''],
                                            ['value' => 'citizan', 'text' => 'مدني'],
                                            ['value' => 'army', 'text' => 'الجيش'],
                                            ['value' => 'police', 'text' => 'الشرطه'],
                                        ]" multiple class="form-select selc_cour_typ"
                                        prefix="adv" />
                                    <x-base.dropdownModal label="{{ awtTrans('مجال التعاون') }}" name="field"
                                        :options="\App\Models\CourseField::all()
                                            ->mapWithKeys(fn($item) => [$item->id => $item->name_ar])
                                            ->toArray()" multiple class="form-select selec_cours_typ3" prefix="adv"
                                        id="adv_field" :showArrow=true />
                                </div>

                                <div class="row mb-3">
                                    <x-base.inputModal label="{{ awtTrans('تاريخ البدء من') }}" name="start_date_from"
                                        type="text" inputClass="form-control date-picker-input" prefix="adv"
                                        id="adv_start_date_from" />
                                    <x-base.inputModal label="{{ awtTrans('تاريخ البدء الي') }}" name="start_date_to"
                                        type="text" inputClass="form-control date-picker-input" prefix="adv"
                                        id="adv_start_date_to" />
                                </div>

                                <div class="row mb-3">
                                    <x-base.inputModal label="{{ awtTrans('تاريخ الإنتهاء من') }}" name="end_date_from"
                                        type="text" inputClass="form-control date-picker-input" prefix="adv"
                                        id="adv_end_date_from" />
                                    <x-base.inputModal label="{{ awtTrans('تاريخ الإنتهاء الي') }}"
                                        name="end_date_to" type="text" inputClass="form-control date-picker-input"
                                        prefix="adv" id="adv_end_date_to" />
                                </div>

                                <div class="row mb-3">
                                    <x-base.inputModal label="{{ awtTrans('مكان الإنعقاد') }}" name="location"
                                        type="text" prefix="adv" id="adv_location" />
                                    <x-base.dropdownModal label="{{ awtTrans('الجهة المنظمة') }}" name="organization"
                                        :options="\App\Models\CoursePartner::all()
                                            ->mapWithKeys(fn($item) => [$item->id => $item->name])
                                            ->toArray()" multiple class="form-select selc_cour_train" prefix="adv"
                                        id="adv_organization" />
                                </div>

                                <div class="row mb-3">
                                    <x-base.dropdownModal label="{{ awtTrans('الدول المشاركة') }}" name="country"
                                        :options="getCountries()" class="form-select selc_country" prefix="adv"
                                        id="adv_country" />
                                    <x-base.dropdownModal label="{{ awtTrans('اسم منسق الدورة') }}" name="trainee"
                                        :options="\App\Models\CourseTrianee::all()
                                            ->mapWithKeys(fn($item) => [$item->id => $item->name_ar])
                                            ->toArray()" class="form-select selc_cours_cord" prefix="adv"
                                        id="adv_trainee" />
                                </div>

                                <div class="row mb-3">
                                    <x-base.inputModal label="{{ awtTrans('إجمالي عدد المتدربين من') }}"
                                        name="app_from" type="number" prefix="adv"
                                        placeholder="{{ awtTrans('إجمالي عدد المتدربين الحد الأدنى') }}"
                                        id="adv_app_from" />
                                    <x-base.inputModal label="{{ awtTrans('إجمالي عدد المتدربين إلى') }}"
                                        name="app_to" type="number" prefix="adv"
                                        placeholder="{{ awtTrans('إجمالي عدد المتدربين الحد الأقصى') }}"
                                        id="adv_app_to" />
                                </div>

                                <div class="row mb-3">
                                    <x-base.inputModal label="{{ awtTrans('عدد المتدربات النساء من"') }}"
                                        name="appfem_from" type="number" prefix="adv"
                                        placeholder="{{ awtTrans('عدد المتدربات النساء الحد الأدنى') }}"
                                        id="adv_appfem_from" />
                                    <x-base.inputModal label="{{ awtTrans('عدد المتدربات النساء الحد الأدنى') }}"
                                        name="appfem_to" type="number" prefix="adv"
                                        placeholder="{{ awtTrans('عدد المتدربات النساء الحد الأقصى') }}"
                                        id="adv_appfem_to" />
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-danger"
                                data-bs-dismiss="modal">{{ __('إغلاق') }}</button>
                            <button type="button" class="btn btn-warning" id="clear-advanced-search"><i
                                    class="fa fa-refresh"></i> {{ __('إعادة تعيين') }}</button>
                            <button type="submit" form="advanced-search-form" class="btn btn-primary"><i
                                    class="fa fa-search"></i> {{ __('بحث') }}</button> --}}
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
            {{-- </div> --}}
        </div>
    </div>
</div>

<script>
    document.getElementById('advanced-search-form').addEventListener('submit', function() {
        var modal = bootstrap.Modal.getInstance(document.getElementById('advancedSearchModal'));
        modal.hide();
    });
</script>

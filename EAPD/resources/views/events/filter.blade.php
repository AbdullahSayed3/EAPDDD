<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="mb-4">
            <!-- Quick Search Form -->
            <form id="quick-search-form">
                <div class="row w-100 align-items-center mb-3">
                    <div class="col-sm-2"></div>
                    <x-base.input placeholder="{{ awtTrans('الموضوع الرئيسي') }}" name="subject" type="text"
                        value="{{ getRequest('subject') }}" id="quick_subject" containerClass="col-sm-7" inputClass="shadow py-3"
                        showSearchIcon />
                    <div class="col-sm-1">
                        <button type="button" class="w-auto btn w-100" data-bs-toggle="modal"
                            data-bs-target="#advancedSearchModal">
                            <x-icon name="filter" />
                        </button>
                    </div>
                    <div class="col-sm-2"></div>
                </div>

                <div class="row mb-3">
                    <x-base.dropdown label="{{ awtTrans('نوع الفعالية') }}" name="event" :options="\App\Models\EventType::all()
                        ->mapWithKeys(fn($item) => [$item->id => $item->name_ar])
                        ->toArray()"
                        class="form-select selec_event" containerClass="col-sm-3" id="quick_event" />
                    
                    <x-base.input label="{{ awtTrans('الجهات المشاركة') }}" name="comps" type="text"
                        value="{{ getRequest('comps') }}" class="col-sm-3" id="quick_comps" />

                    <div class="d-flex flex-column col-sm-2 text-end">
                        <x-base.fillBtn type="submit" name="submit" value="search" class="btn btn-primary"
                            icon="fa-search" label="{{awtTrans('بحث')}}" />
                        <x-base.notfillBtn type="button" id="reset-search"
                            class="btn-outline-warning border-warning text-primary" icon="fa-refresh"
                            label="{{awtTrans('إعادة تعيين')}}" />
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
                                    <x-base.inputModal label="{{ awtTrans('الموضوع الرئيسي') }}" name="subject"
                                        type="text" prefix="adv" id="adv_subject" showSearchIcon />
                                    <x-base.dropdownModal label="{{ awtTrans('نوع الفعالية') }}" name="event"
                                        :options="\App\Models\EventType::all()
                                            ->mapWithKeys(fn($item) => [$item->id => $item->name_ar])
                                            ->toArray()" class="form-select selec_event" prefix="adv"
                                        id="adv_event" />
                                </div>

                                <div class="row mb-3">
                                    <x-base.inputModal label="{{ awtTrans('الجهات المشاركة') }}" name="comps"
                                        type="text" prefix="adv" id="adv_comps" />
                                </div>

                                <div class="row mb-3">
                                    <x-base.inputModal label="{{ awtTrans('تاريخ من') }}" name="date_from"
                                        type="text" inputClass="form-control date-picker-input" prefix="adv"
                                        id="adv_date_from" />
                                    <x-base.inputModal label="{{ awtTrans('إلى تاريخ') }}" name="date_to"
                                        type="text" inputClass="form-control date-picker-input" prefix="adv"
                                        id="adv_date_to" />
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <x-base.notfillBtn type="button" id="clear-advanced-search"
                                class="btn-outline-warning border-warning text-primary" icon="fa-refresh"
                                label="إعادة تعيين" />
                            <x-base.fillBtn type="button" class="btn-danger" modalDismiss="modal" label="إغلاق" />
                            <x-base.fillBtn type="submit" form="advanced-search-form" class="btn btn-primary"
                                icon="fa-search" label="بحث" />
                        </div>
                    </div>
                </div>
            </div>
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
                $('.selec_event').val(null).trigger('change');
            }
        });

        // Handle Clear Advanced Search Form
        document.getElementById('clear-advanced-search').addEventListener('click', function() {
            document.getElementById('advanced-search-form').reset();
            if (typeof $ !== 'undefined') {
                $('.selec_event').val(null).trigger('change');
            }
        });
    });
</script>

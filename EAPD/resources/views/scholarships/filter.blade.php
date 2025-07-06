<div class="row">
    <div class="col-12">
        <div class="mb-4">
            <!-- Quick Search Form -->
            <form id="quick-search-form" method="get" action="{{ route('scholarships.index') }}">
                <div class="row align-items-center mb-3">
                    <div class="col-sm-2"></div>

                    <x-base.input placeholder="{{ awtTrans('البرنامج / المنحة') }}" name="program" type="text"
                        value="{{ request('program') }}" id="program" containerClass="col-sm-7"
                        inputClass="shadow py-3" showSearchIcon />

                    <div class="col-sm-1">
                        <button type="button" class="btn w-100" data-bs-toggle="modal"
                            data-bs-target="#advancedSearchModal">
                            <x-icon name="filter" />
                        </button>
                    </div>

                    <div class="col-sm-2"></div>
                </div>

                <div class="row justify-content-center mb-3">
                    @php
                        // Cache these two queries so we don’t hit DB twice
                        $programs = \App\Models\Scholarships::all()
                            ->mapWithKeys(fn($item) => [$item->id => $item->program])
                            ->toArray();
                        $owners = \App\Models\Scholarships::all()
                            ->mapWithKeys(fn($item) => [$item->id => $item->owner])
                            ->toArray();
                    @endphp

                    <x-base.dropdown label="{{ awtTrans('البرنامج / المنحة') }}" name="program_select" :options="$programs"
                        class="form-select selec_scholarship" containerClass="col-sm-3" id="program_select"
                        value="{{ request('program') }}" />

                    <x-base.dropdown label="{{ awtTrans('الدول المشاركه') }}" name="participants" :options="getCountries()"
                        class="form-select selc_country" containerClass="col-sm-3" id="quick_participants"
                        value="{{ request('participants') }}" />

                    <x-base.dropdown label="{{ awtTrans('الجهة') }}" name="owner" :options="$owners"
                        class="form-select selc_owner" containerClass="col-sm-3" id="quick_owner"
                        value="{{ request('owner') }}" />

                    <div class="col-sm-2 text-end d-flex flex-column">
                        <x-base.fillBtn type="submit" name="submit" value="search" class="btn btn-primary"
                            icon="fa-search" label="{{ awtTrans('بحث') }}" />

                        <x-base.notfillBtn type="button" id="reset-search"
                            class="btn-outline-warning border-warning text-primary" icon="fa-refresh"
                            label="{{ awtTrans('إعادة تعيين') }}" />
                    </div>
                </div>
            </form>

            <!-- Advanced Search Modal -->
            <x-base.modal id="advancedSearchModal" title="{{ awtTrans('بحث متقدم') }}" size="lg" centered="true"
                scrollable="true">
                <form id="advanced-search-form" method="get" action="{{ route('scholarships.index') }}">
                    {{-- Program (text input) --}}
                    <div class="row mb-3 justify-content-center">
                        <x-base.inputModal label="{{ awtTrans('البرنامج / المنحة') }}" name="program" type="text"
                            prefix="adv" id="adv_program" class="col-sm-8" showSearchIcon
                            value="{{ request('program') }}" />
                    </div>

                    {{-- Participants & Owner (dropdowns) --}}
                    <div class="row mb-3">
                        <x-base.dropdownModal label="{{ awtTrans('الدول المشاركه') }}" name="participants"
                            :options="getCountries()" class="form-select selc_country" prefix="adv" id="adv_participants"
                            value="{{ request('participants') }}" />

                        <x-base.dropdownModal label="{{ awtTrans('الجهة') }}" name="owner" :options="$owners"
                            class="form-select selc_owner" prefix="adv" id="adv_owner"
                            value="{{ request('owner') }}" />
                    </div>

                    {{-- Date Range --}}
                    <div class="row mb-3">
                        <x-base.inputModal label="{{ awtTrans('تاريخ من') }}" name="start_date_from" type="text"
                            inputClass="form-control date-picker-input" prefix="adv" id="adv_date_from"
                            value="{{ request('start_date_from') }}" />

                        <x-base.inputModal label="{{ awtTrans('إلى تاريخ') }}" name="end_date_from" type="text"
                            inputClass="form-control date-picker-input" prefix="adv" id="adv_date_to"
                            value="{{ request('end_date_from') }}" />
                    </div>
                </form>

                <x-slot name="footer">
                    <x-base.notfillBtn type="button" id="clear-advanced-search"
                        class="btn-outline-warning border-warning text-primary" icon="fa-refresh"
                        label="{{ awtTrans('إعادة تعيين') }}" />

                    <x-base.fillBtn type="button" class="btn-danger" modalDismiss="modal"
                        label="{{ awtTrans('إغلاق') }}" />

                    <x-base.fillBtn type="submit" form="advanced-search-form" class="btn btn-primary"
                        icon="fa-search" label="{{ awtTrans('بحث') }}" />
                </x-slot>
            </x-base.modal>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const formIds = ['quick-search-form', 'advanced-search-form'];
        const selectClasses = ['selc_country', 'selec_scholarship', 'selc_owner'];

        // Initialize Select2 on all dropdowns (both quick & advanced)
        selectClasses.forEach(cls => {
            $(`.${cls}`).select2({
                placeholder: "{{ awtTrans('اختر') }}",
                allowClear: true
            });
        });

        // Utility: Clear URL parameters completely
        const clearUrlParameters = () => {
            const url = new URL(window.location.href);
            url.search = '';
            window.history.replaceState({}, '', url);
        };

        // Utility: Reset all inputs/selects in a form (including flatpickr date inputs)
        const resetFormElements = (formId) => {
            const form = document.getElementById(formId);
            if (!form) return;

            form.reset();

            // Reset any Select2 dropdown inside this form
            form.querySelectorAll('select').forEach(select => {
                $(select).val(null).trigger('change');
            });

            // Clear any flatpickr date pickers
            form.querySelectorAll('.date-picker-input').forEach(input => {
                if (input._flatpickr) {
                    input._flatpickr.clear();
                }
            });
        };

        // Handle form submission (both quick & advanced) via AJAX → reload DataTable
        formIds.forEach(formId => {
            document.getElementById(formId)?.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const url = new URL(window.location.href);

                // Add or remove each parameter in the URL
                formData.forEach((value, key) => {
                    if (value) {
                        url.searchParams.set(key, value);
                    } else {
                        url.searchParams.delete(key);
                    }
                });

                // Push the new URL (so browser history + Bookmarks work)
                window.history.pushState({}, '', url);

                // Reload DataTable with new filters
                $('#datatable')
                    .DataTable()
                    .ajax
                    .url('{{ route($route . '.datatable') }}?' + new URLSearchParams(formData))
                    .load();

                // If it was the advanced‐search form, close the modal
                if (formId === 'advanced-search-form') {
                    bootstrap.Modal
                        .getInstance(document.getElementById('advancedSearchModal'))
                        ?.hide();
                }
            });
        });

        // “Reset” button on Quick Search
        document.getElementById('reset-search')?.addEventListener('click', function(e) {
            e.preventDefault();
            resetFormElements('quick-search-form');
            clearUrlParameters();
            location.reload(); // or: $('#datatable').DataTable().ajax.reload();
        });

        // “Clear” button on Advanced Search
        document.getElementById('clear-advanced-search')?.addEventListener('click', function() {
            resetFormElements('advanced-search-form');
            location.reload(); // or: $('#datatable').DataTable().ajax.reload();
        });

        // Also reset advanced‐form if user closes the modal via the “X”
        document.getElementById('advancedSearchModal')?.addEventListener('hidden.bs.modal', function() {
            resetFormElements('advanced-search-form');
        });
    });
</script>

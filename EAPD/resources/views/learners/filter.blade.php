@php
    // Collect request inputs into a local array
    $dataT = [
        'first_name' => getRequest('first_name'),
        'country' => getRequest('country'),
    ];
@endphp

<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="mb-4">
            <!-- Quick Search Form -->
            <form id="quick-search-form" method="GET" action="{{ url()->current() }}">
                <div class="row w-100 align-items-center mb-3">
                    <div class="col-sm-2"></div>

                    {{-- Search Input --}}
                    <x-base.input placeholder="{{ awtTrans('الاسم الاول') }}" name="first_name" type="text"
                        value="{{ $dataT['first_name'] }}" id="quick_first_name" containerClass="col-sm-7"
                        inputClass="shadow py-3" showSearchIcon />

                    <div class="col-sm-1">
                        <button type="button" class="w-auto btn w-100" data-bs-toggle="modal"
                            data-bs-target="#advancedSearchModal">
                            <x-icon name="filter" />
                        </button>
                    </div>
                    <div class="col-sm-2"></div>
                </div>

                {{-- Dropdown Under Search Bar --}}
                <div class="row mb-3">
                    <x-base.dropdown label="{{ awtTrans('الدولة') }}" name="country" :options="getCountries()"
                        containerClass="col-sm-3" id="quick_country" />
                    <x-base.dropdown label="{{ awtTrans('اسم المنحة') }}" name="scholarships_id" :options="\App\Models\Scholarships::pluck('program', 'id')->toArray()"
                        containerClass="col-sm-3" prefix="quick" id="quick_scholarships_id" />
                    <x-base.dropdown label="{{ awtTrans('النوع') }}" name="gender" :options="['male' => awtTrans('ذكر'), 'female' => awtTrans('أنثى')]"
                        containerClass="col-sm-3" prefix="quick" id="quick_gender" />
                    <div class="d-flex flex-column col-sm-2 text-end">
                        <x-base.fillBtn type="submit" name="submit" value="search" class="btn btn-primary mx-2"
                            icon="fa-search" label="{{ awtTrans('بحث') }}" />
                        <x-base.notfillBtn type="button" id="reset-search"
                            class="btn-outline-warning border-warning text-primary mx-2" icon="fa-refresh"
                            label="{{ awtTrans('إعادة تعيين') }}" />
                    </div>
                </div>

            </form>

            <!-- Advanced Search Modal (unchanged) -->
            <div class="modal fade" id="advancedSearchModal" tabindex="-1" aria-labelledby="advancedSearchModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="advancedSearchModalLabel">{{ awtTrans('بحث متقدم') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="advanced-search-form">
                                <div class="row mb-3">
                                    <x-base.inputModal label="{{ awtTrans('الاسم الثاني') }}" name="second_name"
                                        type="text" prefix="adv" id="adv_second_name"
                                        value="{{ getRequest('second_name') }}" />
                                    <x-base.inputModal label="{{ awtTrans('اللقب') }}" name="third_name" type="text"
                                        prefix="adv" id="adv_third_name" value="{{ getRequest('third_name') }}" />
                                </div>
                                <div class="row mb-3">
                                    <x-base.dropdownModal label="{{ awtTrans('اسم المنحة') }}" name="scholarships_id"
                                        :options="\App\Models\Scholarships::pluck('program', 'id')->toArray()" prefix="adv" id="adv_scholarships_id" />
                                    <x-base.dropdownModal label="{{ awtTrans('النوع') }}" name="gender"
                                        :options="['male' => awtTrans('ذكر'), 'female' => awtTrans('أنثى')]" prefix="adv" id="adv_gender" />
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

            <script>
                document.getElementById('advanced-search-form').addEventListener('submit', function() {
                    var modal = bootstrap.Modal.getInstance(document.getElementById('advancedSearchModal'));
                    modal.hide();
                });

                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('reset-search').addEventListener('click', function(e) {
                        e.preventDefault();
                        document.getElementById('quick-search-form').reset();
                    });
                    document.getElementById('clear-advanced-search').addEventListener('click', function() {
                        document.getElementById('advanced-search-form').reset();
                    });
                });
            </script>
        </div>
    </div>
</div>

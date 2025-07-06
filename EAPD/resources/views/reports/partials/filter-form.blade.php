<!-- Global Filter Section -->
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="mb-4">
            <!-- Quick Search Form -->
            <form id="global-search-form" method="GET" action="{{ route('reports.comprehensive') }}">
                {{-- <div class="row w-100 align-items-center mb-3">
                    <div class="col-sm-2"></div>
                    <x-base.input placeholder="{{ awtTrans('بحث عام') }}" name="query" type="text" :value="getRequest('query')"
                        id="global-search-query" class="col-sm-7" inputClass="shadow py-3" showSearchIcon />
                    <div class="col-sm-1">
                        <button type="button" class="w-auto btn w-100" data-bs-toggle="modal"
                            data-bs-target="#advancedSearchModal">
                            <x-icon name="filter" />
                        </button>
                    </div>
                    <div class="col-sm-2"></div>
                </div> --}}

                <div class="row w-100 justify-content-center mb-3">
                    <x-base.dropdown id="global-country" label="{{ awtTrans('الدولة') }}" name="country"
                        defaultOptionText="{{ awtTrans('اختر') }}" :options="getCountries()" :value="getRequest('country')"
                        class="form-select selc_country" containerClass="col-sm-3" multiple="true" />
                    <x-base.dropdown id="global-report-type" label="{{ awtTrans('نوع التقرير') }}" name="report_type"
                        :options="[
                            'all' => awtTrans('جميع التقارير'),
                            'courses' => awtTrans('الدورات'),
                            'experts' => awtTrans('الخبراء'),
                            'aids' => awtTrans('المعونات'),
                            'events' => awtTrans('الفعاليات'),
                            'scholarships' => awtTrans('المنح الدراسية'),
                        ]" :value="getRequest('report_type')" class="form-select selc_report_type"
                        containerClass="col-sm-2" />
                    <x-base.input id="date_from" label="{{ awtTrans('من تاريخ') }}" name="date_from" type="date"
                        :value="getRequest('date_from')" containerClass="col-sm-2" style="width: fit-content" />
                    <x-base.input id="date_to" label="{{ awtTrans('إلى تاريخ') }}" name="date_to" type="date"
                        :value="getRequest('date_to')" containerClass="col-sm-2" style="width: fit-content" />
                    <div class="d-flex flex-column col-sm-2 text-end">
                        <x-base.fillBtn type="submit" name="submit" value="search" class="btn btn-primary"
                            icon="fa-search" label="{{ awtTrans('بحث') }}" />
                        <x-base.notfillBtn type="button" id="reset-search"
                            class="btn-outline-warning border-warning text-primary" icon="fa-refresh"
                            label="{{ awtTrans('إعادة تعيين') }}" />
                    </div>
                </div>
            </form>

            @include('reports.partials.advanced-search-modal')
        </div>
    </div>
</div>

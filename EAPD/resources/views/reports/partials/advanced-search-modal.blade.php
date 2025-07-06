<!-- Advanced Search Modal -->
<div class="modal fade" id="advancedSearchModal" tabindex="-1" aria-labelledby="advancedSearchModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="advancedSearchModalLabel">{{ __('بحث متقدم') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="advanced-search-form" method="GET" action="{{ route('reports.comprehensive') }}">
                    <input type="hidden" name="advanced" value="true">

                    <div class="row mb-3">
                        <x-base.inputModal label="{{ awtTrans('بحث عام') }}" name="query" :value="getRequest('query')"
                            prefix="adv" id="adv-query" showSearchIcon />
                        <x-base.dropdownModal label="{{ awtTrans('نوع التقرير') }}" name="report_type" :options="[
                            'all' => awtTrans('جميع التقارير'),
                            'courses' => awtTrans('الدورات'),
                            'experts' => awtTrans('الخبراء'),
                            'aids' => awtTrans('المعونات'),
                            'events' => awtTrans('الفعاليات'),
                            'scholarships' => awtTrans('المنح الدراسية'),
                        ]"
                            :value="getRequest('report_type')" class="form-select selc_report_type" prefix="adv"
                            id="adv-report-type" />
                    </div>

                    <div class="row mb-3">
                        <x-base.dropdownModal label="{{ awtTrans('الدولة') }}" name="country" :options="getCountries()"
                            :value="getRequest('country')" class="form-select selc_country" prefix="adv" multiple="true"
                            id="adv-country" />
                        <x-base.inputModal label="{{ awtTrans('الموضوع') }}" name="subject" :value="getRequest('subject')"
                            prefix="adv" id="adv-subject" />
                    </div>

                    <div class="row mb-3">
                        <x-base.inputModal label="{{ awtTrans('من تاريخ') }}" name="date_from" type="date"
                            :value="getRequest('date_from')" prefix="adv" id="adv-date-from" />
                        <x-base.inputModal label="{{ awtTrans('إلى تاريخ') }}" name="date_to" type="date"
                            :value="getRequest('date_to')" prefix="adv" id="adv-date-to" />
                    </div>


                    <div class="row mb-3">
                        <div class="col-md-6">
                         <div class="form-group">
                         <label for="">{{awtTrans('الجهة المنظمة')}}</label>
                         <select name="entit_id" class="form-select" id="">
                            <option value="citzen">{{awtTrans('مدني')}}</option>
                            <option value="police">{{awtTrans('شرطة')}}</option>
                            <option value="army">{{awtTrans('جيش')}}</option>

                         </select>
                         </div>
                  
                        </div>
                    </div>

                    <div class="row mb-3">
                        <x-base.inputModal label="{{ awtTrans('التكلفة من') }}" name="cost_from" type="number"
                            :value="getRequest('cost_from')" prefix="adv" id="adv-cost-from" />
                        <x-base.inputModal label="{{ awtTrans('التكلفة إلى') }}" name="cost_to" type="number"
                            :value="getRequest('cost_to')" prefix="adv" id="adv-cost-to" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <x-base.notfillBtn type="button" id="clear-advanced-search"
                    class="btn-outline-warning border-warning text-primary" icon="fa-refresh" label="إعادة تعيين" />
                <x-base.fillBtn type="button" class="btn-danger" modalDismiss="modal" label="إغلاق" />
                <x-base.fillBtn type="submit" form="advanced-search-form" class="btn btn-primary" icon="fa-search"
                    label="بحث" />
            </div>
        </div>
    </div>
</div>

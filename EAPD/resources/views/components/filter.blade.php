@props([
    'quickSearchFields' => [], // Array of fields for quick search
    'advancedSearchFields' => [], // Array of fields for advanced search
    'formId' => 'filter-form', // Unique ID for the form
    'modalId' => 'advancedSearchModal', // Unique ID for the modal
    'translations' => [], // Custom translations if needed
    'countries' => [], // List of countries for dropdown
    'submitLabel' => 'Search',
    'resetLabel' => 'Reset',
    'closeLabel' => 'Close',
    'advancedSearchLabel' => 'Advanced Search',
])

<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="mb-4">
            <!-- Quick Search Form -->
            <form id="{{ $formId }}-quick">
                <div class="row w-100 align-items-center mb-3">
                    <div class="col-sm-2"></div>
                    @foreach ($quickSearchFields as $field)
                        @if ($field['type'] === 'text')
                            <x-base.input :placeholder="awtTrans($field['label'])" :name="$field['name']" type="text" :value="getRequest($field['name'])"
                                :id="$formId . '-' . $field['name']" class="col-sm-7" inputClass="shadow py-3" :showSearchIcon="$field['showSearchIcon'] ?? false" />
                        @endif
                    @endforeach
                    <div class="col-sm-1">
                        <button type="button" class="w-auto btn w-100" data-bs-toggle="modal"
                            data-bs-target="#{{ $modalId }}">
                            <x-icon name="filter" />
                        </button>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
                <div class="row justify-content-center mb-3">
                    @foreach ($quickSearchFields as $field)
                        @if ($field['type'] === 'dropdown')
                            <x-base.dropdown :label="awtTrans($field['label'])" :name="$field['name']" :options="$field['options']" :class="'form-select selc_' . $field['name']"
                                :containerClass="'col-sm-3'" :id="$formId . '-' . $field['name']" :multiple="$field['multiple'] ?? false" />
                        @endif
                    @endforeach
                    <div class="d-flex flex-column col-sm-2 text-end">
                        <x-base.fillBtn type="submit" name="submit" value="search" class="btn btn-primary"
                            icon="fa-search" :label="awtTrans($submitLabel)" />
                        <x-base.notfillBtn type="button" :id="$formId . '-reset'"
                            class="btn-outline-warning border-warning text-primary" icon="fa-refresh"
                            :label="awtTrans($resetLabel)" />
                    </div>
                </div>
            </form>

            <!-- Advanced Search Modal -->
            <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="{{ $modalId }}Label">{{ awtTrans($advancedSearchLabel) }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="{{ $formId }}-advanced">
                                @foreach ($advancedSearchFields as $group)
                                    <div class="row mb-3 {{ $group['justify'] ?? '' }}">
                                        @foreach ($group['fields'] as $field)
                                            @if ($field['type'] === 'text' || $field['type'] === 'number')
                                                <x-base.inputModal :label="awtTrans($field['label'])" :name="$field['name']"
                                                    :type="$field['type']" :prefix="'adv'" :id="'adv-' . $field['name']"
                                                    :inputClass="$field['inputClass'] ?? 'form-control'" :placeholder="awtTrans($field['placeholder'] ?? $field['label'])" :showSearchIcon="$field['showSearchIcon'] ?? false"
                                                    :labelClass="$field['labelClass'] ?? ''" :class="$field['class'] ?? ''" />
                                            @elseif ($field['type'] === 'dropdown')
                                                <x-base.dropdownModal :label="awtTrans($field['label'])" :name="$field['name']"
                                                    :options="$field['options']" :class="'form-select selc_' . $field['name']" :prefix="'adv'"
                                                    :id="'adv-' . $field['name']" :multiple="$field['multiple'] ?? false" :showArrow="$field['showArrow'] ?? true" />
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            </form>
                        </div>
                        <div class="modal-footer">
                            <x-base.notfillBtn type="button" :id="$formId . '-clear-advanced'"
                                class="btn-outline-warning border-warning text-primary" icon="fa-refresh"
                                :label="awtTrans($resetLabel)" />
                            <x-base.fillBtn type="button" class="btn-danger" modalDismiss="modal" :label="awtTrans($closeLabel)" />
                            <x-base.fillBtn type="submit" form="{{ $formId }}-advanced" class="btn btn-primary"
                                icon="fa-search" :label="awtTrans($submitLabel)" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('{{ $formId }}-advanced').addEventListener('submit', function() {
        var modal = bootstrap.Modal.getInstance(document.getElementById('{{ $modalId }}'));
        modal.hide();
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Handle Reset Quick Search
        document.getElementById('{{ $formId }}-reset').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('{{ $formId }}-quick').reset();
            if (typeof $ !== 'undefined') {
                @foreach ($quickSearchFields as $field)
                    @if ($field['type'] === 'dropdown')
                        document.querySelector('.selc_{{ $field['name'] }}').value = '';
                    @endif
                @endforeach
            }
        });

        // Handle Clear Advanced Search
        document.getElementById('{{ $formId }}-clear-advanced').addEventListener('click', function() {
            document.getElementById('{{ $formId }}-advanced').reset();
            if (typeof $ !== 'undefined') {
                @foreach ($advancedSearchFields as $group)
                    @foreach ($group['fields'] as $field)
                        @if ($field['type'] === 'dropdown')
                            document.querySelector('.selc_{{ $field['name'] }}').value = '';
                        @endif
                    @endforeach
                @endforeach
            }
        });
    });
</script>

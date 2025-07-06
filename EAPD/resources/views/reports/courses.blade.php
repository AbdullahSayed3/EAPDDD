@extends('layouts.master')

@section('styles')
    <!-- Include Styles -->
    {{-- @include('reports.partials.styles') --}}
@endsection

@section('content')
    @php($dataT = [])

    <!-- Page Title -->
    <x-base.breadcrumb title="تقارير شاملة" :breadcrumbs="[
        ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
        ['label' => 'التقارير', 'url' => route('reports.index')],
        ['label' => 'تقارير شاملة'],
    ]" />

    <!-- Include Filter Form -->
    @include('reports.partials.filter-form')

    <!-- Results Section -->
    <div class="row">
        <div class="col-xl-12">
            <div class="mb-4">
                @include('reports.partials.results-tabs')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('reports.js.common-config')
    @include('reports.js.datatable-courses')
    @include('reports.js.datatable-aids')
    @include('reports.js.datatable-events')
    @include('reports.js.datatable-experts')
    @include('reports.js.datatable-scholarships')

    {{-- Include Event Handlers --}}
    @include('reports.js.event-handlers')

    {{-- Initialize Tabs --}}
    @include('reports.js.tabs-init')

    {{-- Initialize Select2 --}}
    @include('reports.js.select2-init')
    {{-- <script>
        // Define routes for JavaScript
        window.translations = {
            datatable: {
                processing: "{{ __('datatable.processing') }}",
                search: "{{ __('datatable.search') }}",
                lengthMenu: "{{ __('datatable.lengthMenu') }}",
                info: "{{ __('datatable.info') }}",
                infoEmpty: "{{ __('datatable.infoEmpty') }}",
                infoFiltered: "{{ __('datatable.infoFiltered') }}",
                loadingRecords: "{{ __('datatable.loadingRecords') }}",
                zeroRecords: "{{ __('datatable.zeroRecords') }}",
                emptyTable: "{{ __('datatable.emptyTable') }}",
                first: "{{ __('datatable.first') }}",
                previous: "{{ __('datatable.previous') }}",
                next: "{{ __('datatable.next') }}",
                last: "{{ __('datatable.last') }}"
            },
            country_placeholder: "{{ awtTrans('اختر دولة') }}",
            report_type_placeholder: "{{ awtTrans('اختر نوع التقرير') }}"
        };

        window.routes = {
            comprehensiveData: {
                courses: '{{ route('reports.comprehensive.data', ['type' => 'courses']) }}',
                experts: '{{ route('reports.comprehensive.data', ['type' => 'experts']) }}',
                aids: '{{ route('reports.comprehensive.data', ['type' => 'aids']) }}',
                events: '{{ route('reports.comprehensive.data', ['type' => 'events']) }}',
                scholarships: '{{ route('reports.comprehensive.data', ['type' => 'scholarships']) }}'
            }
        };

        document.addEventListener('DOMContentLoaded', function() {
            // Final check to ensure active tab is visible
            setTimeout(function() {
                // Check URL for active_tab parameter
                var urlParams = new URLSearchParams(window.location.search);
                var activeTabId = urlParams.get('active_tab');

                if (activeTabId) {
                    // Make sure the tab is visible
                    var tabContent = document.getElementById(activeTabId);
                    if (tabContent) {
                        console.log('Ensuring tab visibility for:', activeTabId);
                        // Force-show this tab content
                        tabContent.classList.add('show', 'active');
                        tabContent.style.display = 'block';

                        // Force-activate the tab button
                        var tabButton = document.querySelector('button[data-bs-target="#' + activeTabId +
                            '"]');
                        if (tabButton) {
                            tabButton.classList.add('active');
                            tabButton.setAttribute('aria-selected', 'true');
                        }

                        // Force redraw the DataTable
                        var tableId = activeTabId + '-datatable';
                        if ($.fn.DataTable.isDataTable('#' + tableId)) {
                            setTimeout(function() {
                                $('#' + tableId).DataTable().columns.adjust().draw();
                            }, 50);
                        }
                    }
                }
            }, 200);
        });
    </script> --}}

    <!-- Include Styles -->
    @include('reports.partials.styles')
@endpush

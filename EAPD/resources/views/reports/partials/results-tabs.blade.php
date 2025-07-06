@if (request('report_type') && isset($results) && !empty(array_filter($results)))
    <ul class="nav nav-tabs mb-3" id="resultsTabs" role="tablist">
        @if (
            (request('report_type') === 'all' || request('report_type') === 'courses') &&
                isset($results['courses']) &&
                $results['courses']->count())
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="courses-tab" data-bs-toggle="tab" data-bs-target="#corses" type="button"
                    role="tab" aria-selected="true">
                    {{ awtTrans('الدورات') }} <span class="badge bg-primary courses-count">0</span>
                </button>
            </li>
        @endif
        @if (
            (request('report_type') === 'all' || request('report_type') === 'experts') &&
                isset($results['experts']) &&
                $results['experts']->count())
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="experts-tab" data-bs-toggle="tab" data-bs-target="#experts" type="button"
                    aria-selected="false">
                    {{ awtTrans('الخبراء') }} <span class="badge bg-primary experts-count">0</span>
                </button>
            </li>
        @endif
        @if (
            (request('report_type') === 'all' || request('report_type') === 'aids') &&
                isset($results['aids']) &&
                $results['aids']->count())
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="aids-tab" data-bs-toggle="tab" data-bs-target="#aids" type="button"
                    aria-selected="false">
                    {{ awtTrans('المعونات') }} <span class="badge bg-primary aids-count">0</span>
                </button>
            </li>
        @endif
        @if (
            (request('report_type') === 'all' || request('report_type') === 'events') &&
                isset($results['events']) &&
                $results['events']->count())
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="events-tab" data-bs-toggle="tab" data-bs-target="#events" type="button"
                    aria-selected="false">
                    {{ awtTrans('الفعاليات') }} <span class="badge bg-primary events-count">0</span>
                </button>
            </li>
        @endif
        @if (
            (request('report_type') === 'all' || request('report_type') === 'scholarships') &&
                isset($results['scholarships']) &&
                $results['scholarships']->count())
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="scholarships-tab" data-bs-toggle="tab" data-bs-target="#scholarships"
                    type="button" role="tab" aria-controls="scholarships" aria-selected="false">
                    {{ awtTrans('المنح الدراسية') }} <span class="badge bg-primary scholarships-count">0</span>
                </button>
            </li>
        @endif
    </ul>

    <div class="tab-content" id="resultsTabContent">
        @if (
            (request('report_type') === 'all' || request('report_type') === 'courses') &&
                isset($results['courses']) &&
                $results['courses']->count())
            @include('reports.partials.tabs.courses')
        @endif

        @if (
            (request('report_type') === 'all' || request('report_type') === 'experts') &&
                isset($results['experts']) &&
                $results['experts']->count())
            @include('reports.partials.tabs.experts')
        @endif

        @if (
            (request('report_type') === 'all' || request('report_type') === 'aids') &&
                isset($results['aids']) &&
                $results['aids']->count())
            @include('reports.partials.tabs.aids')
        @endif

        @if (
            (request('report_type') === 'all' || request('report_type') === 'events') &&
                isset($results['events']) &&
                $results['events']->count())
            @include('reports.partials.tabs.events')
        @endif

        @if (
            (request('report_type') === 'all' || request('report_type') === 'scholarships') &&
                isset($results['scholarships']) &&
                $results['scholarships']->count())
            @include('reports.partials.tabs.scholarships')
        @endif
    </div>
@else
    <div class="alert alert-info">
        {{ awtTrans('استخدم خيارات البحث أعلاه للبحث في جميع التقارير') }}
    </div>
@endif

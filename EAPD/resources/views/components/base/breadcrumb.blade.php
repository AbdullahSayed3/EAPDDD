<?php
$direction = App::getLocale() == 'ar' ? 'rtl' : 'ltr';
?>
@props(['title', 'breadcrumbs' => [], 'translate' => true])

<div class="row">
    <div class="col-12">
        <div class="mb-4">
            <div
                class="page-title d-flex flex-row-reverse {{ $direction == 'rtl' ? 'ps-3' : 'pe-3' }} justify-content-between align-items-center py-3 ps-2">
                {{-- <h4 class="fw-500 d-inline-block pe-3 mb-0 border-end">
                    {{ $translate ? awtTrans($title) : $title }}
                </h4> --}}
                <nav aria-label="breadcrumb" class="d-inline-block">
                    <ol class="breadcrumb p-0 mb-0">
                        @foreach ($breadcrumbs as $breadcrumb)
                            @if (isset($breadcrumb['url']))
                                <li class="breadcrumb-item">
                                    <a class="text-decoration-none breadcrumb-link"
                                        href="{{ $breadcrumb['url'] }}">{{ $translate ? awtTrans($breadcrumb['label']) : awtTrans($breadcrumb['label']) }}</a>
                                </li>
                            @else
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $translate ? awtTrans($breadcrumb['label']) : $breadcrumb['label'] }}
                                </li>
                            @endif
                        @endforeach
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<style scoped>
    .breadcrumb-link {
        color: #000000; /* Default breadcrumb color */
        transition: color 0.2s ease;
    }

    .breadcrumb-link:hover {
        color: #0d6efd; /* Change to your preferred hover color */
        text-decoration: underline !important;
    }
</style>
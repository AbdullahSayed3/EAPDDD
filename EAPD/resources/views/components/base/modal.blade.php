@props([
    'id',
    'title',
    'size' => 'lg',
    'centered' => true,
    'scrollable' => false,
    'staticBackdrop' => false,
    'closeButton' => true,
])

@php
    $modalClasses = ['modal-dialog'];
    if ($size) {
        $modalClasses[] = "modal-{$size}";
    }
    if ($centered) {
        $modalClasses[] = 'modal-dialog-centered';
    }
    if ($scrollable) {
        $modalClasses[] = 'modal-dialog-scrollable';
    }
@endphp

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true"
    @if ($staticBackdrop) data-bs-backdrop="static" data-bs-keyboard="false" @endif>

    <div class="{{ implode(' ', $modalClasses) }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $id }}Label">{{ $title }}</h5>
                @if ($closeButton)
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                @endif
            </div>

            <div class="modal-body">
                {{ $slot }}
            </div>

            @if (isset($footer))
                <div class="modal-footer">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>

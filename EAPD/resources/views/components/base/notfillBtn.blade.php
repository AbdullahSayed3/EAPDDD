@props([
    'type' => 'button',
    'icon' => '',
    'label' => '',
    'form' => '',
    'class' => 'btn-outline-primary border-primary',
    'modalTarget' => '',
    'modalToggle' => false,
    'modelDismiss' => '',
    'float' => '',
    'margin' => 'ms-1',
    'id' => '',
    'style' => '',
    'name' => '',
    'value' => '',
    'badge' => false,
    'badgeId' => '',
    'badgeClass' => 'bg-light text-danger ms-1',
    'href' => null
])

@if($href)
<a
    href="{{ $href }}"
    @if($modalTarget) data-bs-target="#{{ $modalTarget }}" @endif
    @if($modalToggle) data-bs-toggle="modal" @endif
    {{-- @if($modalDismiss) data-bs-dismiss="{{ $modalDismiss }}" @endif --}}
    @if($id) id="{{ $id }}" @endif
    @if($style) style="{{ $style }}" @endif
    @if($name) name="{{ $name }}" @endif
    @if($value) value="{{ $value }}" @endif
    class="btn border {{ $class }} @if($float) float-{{ $float }} @endif {{ $margin }}"
>
    @if($icon)
        <i class="fa {{ $icon }} me-2"></i>
    @endif
    {{ __($label) }}
    @if($badge)
        <span id="{{ $badgeId }}" class="badge {{ $badgeClass }}">0</span>
    @endif
</a>
@else
<button 
    type="{{ $type }}"
    @if($modalTarget) data-bs-target="#{{ $modalTarget }}" @endif
    @if($modalToggle) data-bs-toggle="modal" @endif
    {{-- @if($modalDismiss) data-bs-dismiss="{{ $modalDismiss }}" @endif --}}
    @if($id) id="{{ $id }}" @endif
    @if($style) style="{{ $style }}" @endif
    @if($name) name="{{ $name }}" @endif
    @if($value) value="{{ $value }}" @endif
    @if($form) form="{{ $form }}" @endif
    class="btn border {{ $class }} @if($float) float-{{ $float }} @endif {{ $margin }}"
>
    @if($icon)
        <i class="fa {{ $icon }} me-2"></i>
    @endif
    {{ __($label) }}
    @if($badge)
        <span id="{{ $badgeId }}" class="badge {{ $badgeClass }}">0</span>
    @endif
</button>
@endif

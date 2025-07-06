@props([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'value' => null,
    'class' => '',
    'containerClass' => 'col-sm-4',
    'inputClass' => '',
    'labelClass' => '',
    'id' => null,
    'placeholder' => null,
    'attributes' => [],
    'prefix' => 'quick',
    'showSearchIcon' => false,
])

@php
    $id = $id ?? $prefix . '_' . $name;
    $dataT[$name] = $value ?? getRequest($name);
    $placeholder = $placeholder ?? __($label);
@endphp

<div class="{{ $containerClass }}">
    @if ($label)
        <label for="{{ $id }}" class="{{ $labelClass }} col-form-label">{{ __($label) }}</label>
    @endif
    <div class="position-relative">
        <input type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $dataT[$name]) }}"
            class="{{ $inputClass }} form-control {{ $type == 'date' ? 'date-picker-input' : '' }} {{ $showSearchIcon ? 'ps-4' : '' }}"
            id="{{ $id }}" placeholder="{{ $placeholder }}" @if ($type == 'number') min="0" @endif
            @foreach ($attributes as $key => $val)
                {{ $key }}="{{ $val }}" @endforeach>
        @if ($showSearchIcon)
            <span class="position-absolute top-50 start-0 translate-middle-y ps-2">
                <x-icon name="search" size="16" />
            </span>
        @endif
    </div>
</div>

@props([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'value' => null,
    'class' => 'col-sm-4',
    'inputClass' => '',
    'labelClass' => 'col-sm-2',
    'id' => null,
    'placeholder' => null,
    'attributes' => [],
    'prefix' => 'adv-',
    'showSearchIcon' => false,
])

@php
    $id = $id ?? $prefix . '_' . $name;
    $dataT[$name] = $value ?? getRequest($name);
    $placeholder = $placeholder ?? __($label);
@endphp
@if ($label)
    <label for="{{ $id }}" class="{{ $labelClass }} col-form-label">{{ __($label) }}</label>
@endif

<div class="{{ $class }}">
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

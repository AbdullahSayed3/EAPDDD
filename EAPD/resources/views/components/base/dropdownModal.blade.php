@props([
    'label' => '',
    'name' => '',
    'options' => [],
    'multiple' => false,
    'value' => null,
    'class' => '',
    'id' => null,
    'defaultOption' => true,
    'defaultOptionValue' => '',
    'defaultOptionText' => '',
    'placeholder' => null,
    'prefix' => 'adv',
    'showArrow' => false,
])

@php
    $id = $id ?? $prefix . '_' . $name;
    $dataT[$name] = $value ?? getRequest($name);
    $selectedValues = is_array($dataT[$name]) ? $dataT[$name] : [$dataT[$name]];
    $placeholder = $placeholder ?? __($label);
@endphp

<label for="{{ $id }}" class="col-sm-2 col-form-label">{{ __($label) }}</label>
<div class="col-sm-4">
    <div class="dropdown-container">
        <select class="{{ $class }} form-select adv-select border border-primary"
            name="{{ $name . ($multiple ? '[]' : '') }}" id="{{ $id }}" {{ $multiple ? 'multiple' : '' }}
            placeholder="{{ $placeholder }}">
            @if ($defaultOption)
                <option value="{{ $defaultOptionValue }}">{{ $defaultOptionText }}</option>
            @endif

            @foreach ($options as $key => $option)
                @php
                    $optionValue = is_array($option) ? $option['value'] : $key;
                    $optionText = is_array($option) ? $option['text'] : $option;
                @endphp
                <option value="{{ $optionValue }}" {{ in_array($optionValue, $selectedValues) ? 'selected' : '' }}>
                    {{ __($optionText) }}
                </option>
            @endforeach
        </select>
        @if ($showArrow)
            <div class="dropdown-arrow">
                <x-icon name="arrow" />
            </div>
        @endif
    </div>
</div>

<style>
    .dropdown-container {
        position: relative;
        width: 100%;
    }

    .dropdown-container select {
        width: 100%;
        padding: 8px 32px 8px 12px !important;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background: white;
        border: 1px solid #ccc;
        border-radius: 4px;
        cursor: pointer;
    }

    .dropdown-arrow {
        position: absolute;
        left: 8px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        color: #666;
    }
</style>

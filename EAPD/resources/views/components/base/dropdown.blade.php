@props([
    'label' => '',
    'name' => '',
    'options' => [],
    'multiple' => false,
    'value' => null,
    'containerClass' => 'col-sm-3',
    'class' => '',
    'id' => null,
    'defaultOption' => true,
    'defaultOptionValue' => '',
    'defaultOptionText' => '',
    'placeholder' => null,
    'searchable' => false,
    'sortable' => true,
    'borderOption' => true,
    'showArrow' => false,
])

@php
    $id = $id ?? ($multiple ? 'adv_' : 'quick_') . $name;
    $dataT[$name] = $value ?? getRequest($name);
    $selectedValues = is_array($dataT[$name]) ? $dataT[$name] : [$dataT[$name]];
    $placeholder = $placeholder ?? __($label);
    $borderClass = $borderOption ? (app()->getLocale() === 'ar' ? 'border-start' : 'border-end') : '';

    if ($sortable) {
        $options = collect($options)
            ->sortBy(function ($option, $key) {
                return is_array($option) ? $option['text'] : $option;
            })
            ->all();
    }
@endphp

<div class="{{ $containerClass }} {{ $borderClass }}">
    <label for="{{ $id }}" class="col-form-label w-auto">{{ __($label) }}</label>
    <select class="{{ $class }} form-select" name="{{ $name . ($multiple ? '[]' : '') }}" id="{{ $id }}"
        {{ $multiple ? 'multiple' : '' }} placeholder="{{ $placeholder }}" data-allow-clear="true"
        data-searchable="{{ $searchable ? 'true' : 'false' }}">
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

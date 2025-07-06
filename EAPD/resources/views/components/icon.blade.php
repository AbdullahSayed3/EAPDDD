@props([
    'name' => null,
    'size' => '24',
    'class' => '',
])

@php
    $iconPath = resource_path("views/icons/{$name}.svg");
    $svgContent = file_exists($iconPath) ? file_get_contents($iconPath) : null;
@endphp

@if ($svgContent)
    <span {{ $attributes->merge(['class' => "inline-block {$class}"]) }}>
        {!! str_replace(['width="32"', 'height="32"'], ["width=\"{$size}\"", "height=\"{$size}\""], $svgContent) !!}
    </span>
@else
    <span class="text-red-500">Icon "{{ $name }}" not found</span>
@endif

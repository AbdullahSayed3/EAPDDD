@props([
    'route' => '',
    'value' => 0,
    'label' => '',
    'border' => '',
    'icon' => 'fa-solid fa-chart-bar',
    'bgColor' => 'bg-primary',
    'textColor' => 'text-dark',
    'colClasses' => 'col-md-3 col-sm-6',
    'decimals' => 0,
])

{{-- Inline 3D Flip Counter Card --}}
<a href="{{ $route }}" class="{{ $colClasses }} text-decoration-none mb-3" style="max-height: fit-content;">
    <div class="card {{ $bgColor }} shadow-sm border-0 rounded-5" style="aspect-ratio: 1/1;">
        <div class="card-body text-end d-flex flex-column justify-content-center">
            {{-- <div class="d-flex align-items-center justify-content-center mb-3">
                <div class="icon-circle icon-link-hover {{ $bgColor }} text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                    <i class="{{ $icon }} fa-lg"></i>
                </div>
            </div> --}}
            <h6 class="card-text fw-bold {{ $textColor }} mb-3">{{ $label }}</h6>
            <div class="counter-container {{ $textColor }} mb-1" data-target="{{ $value }}"
                data-decimals="{{ $decimals }}"
                style="display:inline-flex; perspective:1000px; direction: rtl; max-width: 100%; overflow: hidden;">
                {{-- digits injected by script --}}
            </div>
        </div>
    </div>
</a>

{{-- Inline Styles --}}
<style>
    .counter-container {
        gap: 2px;
        flex-direction: row-reverse;
        flex-wrap: wrap;
        justify-content: start;
    }

    .counter-digit {
        position: relative;
        width: 0.7em;
        height: 1.1em;
        transform-style: preserve-3d;
        transition: transform 0.6s ease;
    }

    .counter-digit .face {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        font-weight: 700;
    }

    .counter-digit .front {
        transform: rotateX(0deg) translateZ(0.6em);
        padding: 2px;
    }

    .counter-digit .back {
        padding: 2px;
        transform: rotateX(90deg) translateZ(0.6em);
    }

    @media (max-width: 768px) {
        .counter-digit {
            width: 0.5em;
        }

        .counter-digit .face {
            font-size: 1rem;
        }
    }
</style>

{{-- Inline Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.counter-container').forEach(function(container) {
            var target = container.dataset.target;
            var decimals = parseInt(container.dataset.decimals) || 0;
            var formatted = parseFloat(target).toFixed(decimals).toString();
            container.innerHTML = '';
            // In RTL, append digits normally but reverse flex-display
            var chars = formatted.split('');
            chars.forEach(function(char, i) {
                var digitEl = document.createElement('div');
                digitEl.className = 'counter-digit';
                digitEl.innerHTML = '<div class="face front">0</div><div class="face back">' +
                    char + '</div>';
                container.appendChild(digitEl);
                // staggered flip from rightmost
                setTimeout(function() {
                    digitEl.style.transform = 'rotateX(-90deg)';
                }, 300 * i);
            });
        });
    });
</script>

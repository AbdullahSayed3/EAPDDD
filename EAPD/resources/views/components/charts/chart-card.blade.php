@props([
    'title',
    'headerBg',
    'canvasId',
    'class' => 'col-lg-6',
    'headerBg' => 'bg-white',
    'height' => '300',
    'titleAlign' => 'text-start',
])
<div class="{{ $class }} mb-4">
    <div class="card shadow-sm border-0 rounded-5">
        {{-- <div class="card-header {{ $headerBg }} border-0 rounded-top-5 text-black">
            <h5 class="card-title mb-0">{{ $title }}</h5>
        </div> --}}
        <div class="card-body">
            <canvas id="{{ $canvasId }}" height="{{ $height }}" class="{{ $titleAlign }}"></canvas>
        </div>
    </div>
</div>

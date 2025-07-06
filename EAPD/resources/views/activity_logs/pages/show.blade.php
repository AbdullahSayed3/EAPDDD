@extends('layouts.master')
@section('content')
<x-base.breadcrumb title="{{ awtTrans($changes->action).' '. awtTrans(last(explode('\\', $changes->model_type))) }}" :translate="false" :breadcrumbs="[
        ['label' => 'الصفحة الرئيسية', 'url' => route('home')],
        ['label' => 'سجلات الانشطة', 'url' => route('activity_logs.index')],
        ['label' => awtTrans(basename(str_replace('\\', '/', $changes->model_type)))],
    ]" />
<div class="container py-4">
    <h4 class="mb-4">{{awtTrans('Activity log details')}}</h4>

    @php
         $json = json_decode($changes->changes, true); 
        $before = $json['before'] ?? [];
        $after = $json['after'] ?? [];
        // $allKeys = collect(array_merge(array_keys($before), array_keys($after)))->unique();
          $allKeys = collect(array_merge(array_keys($before), array_keys($after)))
        ->unique()
        ->reject(fn($key) => in_array($key, ['id', 'remember_token', 'password',str_ends_with($key, '_id')]));
    @endphp

    @foreach ($allKeys as $key)
        @php
            $beforeVal = is_array($before[$key] ?? null) ? json_encode($before[$key], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) : ($before[$key] ?? '');
            $afterVal = is_array($after[$key] ?? null) ? json_encode($after[$key], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) : ($after[$key] ?? '');
            $hasChanged = $beforeVal !== $afterVal;
        @endphp

        <div class="card mb-3 border @if($hasChanged) border-warning @else border-light @endif">
            <div class="card-header bg-light">
                <strong>{{ ucfirst(str_replace('_', ' ', $key)) }}</strong>
            </div>
            <div class="card-body d-flex justify-content-between gap-3 flex-wrap">
                <div class="flex-fill">
                    <h6 class="text-muted">Before</h6>
                    <div class="bg-light p-2 rounded border">{{ $beforeVal ?: '-' }}</div>
                </div>
                <div class="flex-fill">
                    <h6 class="text-muted">After</h6>
                    <div class="bg-light p-2 rounded border">{{ $afterVal ?: '-' }}</div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
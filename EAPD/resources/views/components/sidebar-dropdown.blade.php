@props(['active', 'section', 'icon', 'title', 'items'])

<li class="nav-item mb-2">
    @php
        $isActive = $active == $section;

        // Check if any route in items is currently active
        $hasActiveRoute = collect($items)->some(function ($item) {
            $route = $item['route'];
            $params = $item['params'] ?? [];

            // For routes with same name but different parameters (like applicants with waitList)
            if (request()->routeIs($route)) {
                // If there are params, check if they match the current request
                if (!empty($params)) {
                    foreach ($params as $key => $value) {
                        if (request()->query($key) != $value) {
                            return false;
                        }
                    }
                }
                return true;
            }
            return false;
        });

        // Set active if section matches or any route is active
        $isActive = $isActive || $hasActiveRoute;
    @endphp
    <a class="nav-link text-primary d-flex justify-content-between align-items-center py-2 {{ $isActive ? 'bg-secondary rounded' : '' }}"
        data-bs-toggle="collapse" href="#{{ $section }}" role="button"
        aria-expanded="{{ $isActive ? 'true' : 'false' }}" aria-controls="{{ $section }}"
        style="transition: all 0.3s ease;">
        <span class="d-flex align-items-center gap-2">
            <i class="{{ $icon }}" data-bs-toggle="tooltip" data-bs-placement="right"
                title="{{ $title }}"></i><span class="nav-text">{{ $title }}</span>
        </span>
        <i class="fa fa-chevron-down small {{ $isActive ? 'rotate-180' : '' }}"></i>
    </a>
    <style>
        /* Dropdown header hover effect */
        .nav-item .nav-link:not(.bg-secondary):hover {
            background-color: rgba(108, 117, 125, 0.3);
            border-radius: 0.25rem;
        }

        /* Active dropdown header */
        .nav-item .nav-link.bg-secondary {
            font-weight: 500;
        }

        /* Dropdown items hover effect */
        .nav-item .collapse .nav-link:not(.bg-secondary):hover {
            background-color: rgba(108, 117, 125, 0.2);
            border-radius: 0.25rem;
        }

        /* Active dropdown item */
        .nav-item .collapse .nav-link.bg-secondary {
            font-weight: 500;
        }
    </style>
    <div class="collapse {{ $isActive ? 'show' : '' }}" id="{{ $section }}">
        <ul class="list-unstyled ps-3 mt-2">
            @foreach ($items as $item)
                @php
                    $isItemActive = request()->routeIs($item['route']);

                    // For routes with parameters like waitList
                    if ($isItemActive && isset($item['params'])) {
                        foreach ($item['params'] as $key => $value) {
                            if (request()->query($key) != $value) {
                                $isItemActive = false;
                                break;
                            }
                        }
                    } elseif ($isItemActive && !isset($item['params'])) {
                        // For routes without params, ensure query params are empty
                        // This ensures applicants and applicants?waitList=true don't both highlight
                        foreach (request()->query() as $key => $value) {
                            $isItemActive = false;
                            break;
                        }
                    }
                @endphp
                <li class="mb-1">
                    <a href="{{ route($item['route'], $item['params'] ?? []) }}"
                        class="nav-link text-primary py-1 {{ $isItemActive ? 'bg-secondary rounded' : '' }}"
                        style="transition: all 0.3s ease;" data-bs-toggle="tooltip" data-bs-placement="right"
                        title="{{ $item['text'] }}">
                        {{ $item['text'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</li>

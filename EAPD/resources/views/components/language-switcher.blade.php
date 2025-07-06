<li class="nav-item list-unstyled dropdown mb-2">
    <!-- Dropdown Toggle -->
    <a class="nav-link text-white d-flex align-items-center gap-2 py-2" href="#" role="button"
        data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-globe"></i>
        <span>{{ strtoupper(app()->getLocale()) }}</span>
    </a>

    <!-- Dropdown Menu -->
    <ul class="dropdown-menu dropdown-menu-dark">
        @php
            $languages = [
                'en' => 'English',
                'ar' => 'العربية',
                'fr' => 'Français',
            ];
        @endphp

        @foreach ($languages as $code => $name)
            <li>
                <a class="dropdown-item {{ app()->getLocale() === $code ? 'active' : '' }}"
                    href="{{ route('change_lang', $code) }}">
                    {{ $name }}
                </a>
            </li>
        @endforeach
    </ul>
</li>

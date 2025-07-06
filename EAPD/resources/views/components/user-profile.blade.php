<div class="dropdown w-100">
    <!-- Dropdown Toggle -->
    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="userDropdown"
        data-bs-toggle="dropdown" aria-expanded="false">
        <img src="{{ asset('assets/img/avatar/avatar1.jpg') }}" alt="{{ auth()->user()->name }}" width="32"
            height="32" class="rounded-circle me-2">
        <span class="text-truncate">{{ auth()->user()->name }}</span>
    </a>

    <!-- Dropdown Menu -->
    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="userDropdown">
        <li>
            <a class="dropdown-item" href="{{ route('settings') }}">
                {{ awtTrans('الاعدادات الشخصية') }}
            </a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ awtTrans('تسجيل الخروج') }}
            </a>
        </li>
    </ul>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>

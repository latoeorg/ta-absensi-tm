<aside class="main-sidebar sidebar-light-navy border-right">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ url('/logo.svg') }}" alt="Logo" class="brand-image" />
        <span class="brand-text text-poppins fw-medium">
            IT INVENTORY
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="/" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                {{-- @if (request()->session()->get('user')['role'] === 'SUPERADMIN') --}}
                <li class="nav-header font-weight-bold">Setup</li>
                <li class="nav-item">
                    <a href="/attendence" class="nav-link {{ Request::is('user') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>Attendence</p>
                    </a>
                </li>
                {{-- @endif --}}
                {{-- {{ request()->session()->get('user')['name'] }} --}}
                @if (request()->session()->get('user')['role'] === 'SUPERADMIN')
                    <li class="nav-header font-weight-bold">Setup</li>
                    <li class="nav-item">
                        <a href="/user" class="nav-link {{ Request::is('user') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Users</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>

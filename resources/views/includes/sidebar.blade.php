<aside class="main-sidebar sidebar-light-navy border-right">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ url('/logo.svg') }}" alt="Logo" class="brand-image" />
        <span class="brand-text text-poppins fw-medium">
            Sistem Absensi
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/attendance" class="nav-link {{ Request::is('attendance') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>Attendance</p>
                    </a>
                </li>
                @if (request()->session()->get('user')['role'] === 'SUPERADMIN')
                    <li class="nav-item">
                        <a href="/generate-qr" class="nav-link {{ Request::is('generate-qr') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-qrcode"></i>
                            <p>Generate QR</p>
                        </a>
                    </li>
                @endif
                <li class="nav-header font-weight-bold">Setting</li>
                <li class="nav-item">
                    <a href="/update-profile" class="nav-link {{ Request::is('update-profile') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Update Profile</p>
                    </a>
                </li>
                @if (request()->session()->get('user')['role'] === 'SUPERADMIN')
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

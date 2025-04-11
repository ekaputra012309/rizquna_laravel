<div class="sidebar-menu">
    <ul class="menu">
        {{--
        <li class="sidebar-title">Menu</li>
        --}}

        <li class="sidebar-item active">
            <a href="{{ route('p.dash') }}" class="sidebar-link">
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="sidebar-item has-sub">
            <a href="#" class="sidebar-link">
                <i class="bi bi-stack"></i>
                <span>Master Data</span>
            </a>

            <ul class="submenu">
                <li class="submenu-item">
                    <a href="{{ route('p.agent') }}" class="submenu-link">Agent</a>
                </li>
                <li class="submenu-item">
                    <a href="{{ route('p.hotel') }}" class="submenu-link">Hotel</a>
                </li>
                <li class="submenu-item">
                    <a href="{{ route('p.room') }}" class="submenu-link">Room</a>
                </li>
                <li class="submenu-item">
                    <a href="{{ route('p.rekening') }}" class="submenu-link">Rekening</a>
                </li>
            </ul>
        </li>

        <li class="sidebar-title">Transaction</li>

        <li class="sidebar-item">
            <a href="{{ route('p.booking') }}" class="sidebar-link">
                <i class="bi bi-building-fill-check"></i>
                <span>Booking Hotels</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="{{ route('p.payment') }}" class="sidebar-link">
                <i class="bi bi-credit-card-fill"></i>
                <span>Payment Hotels</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="{{ route('p.visa') }}" class="sidebar-link">
                <i class="bi bi-credit-card-2-front-fill"></i>
                <span>Payment Visa</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="{{ route('p.bcabang') }}" class="sidebar-link">
                <i class="bi bi-diagram-3-fill"></i>
                <span>Data B2C</span>
            </a>
        </li>

        <li class="sidebar-title">Report</li>

        <li class="sidebar-item">
            <a href="{{ route('p.report.agent') }}" class="sidebar-link">
                <i class="bi bi-people-fill"></i>
                <span>Report Agent</span>
            </a>
        </li>

        <li class="sidebar-title">Settings</li>

        <li class="sidebar-item has-sub">
            <a href="#" class="sidebar-link">
                <i class="bi bi-gear-fill"></i>
                <span>Konfigurasi</span>
            </a>

            <ul class="submenu">
                <li class="submenu-item">
                    <a href="{{ route('p.cabang') }}" class="submenu-link">Cabang</a>
                </li>
                <li class="submenu-item">
                    <a href="{{ route('p.privilage') }}" class="submenu-link">Privilage</a>
                </li>
                <li class="submenu-item">
                    <a href="{{ route('p.user.management') }}" class="submenu-link">User Management</a>
                </li>
            </ul>
        </li>
    </ul>
</div>

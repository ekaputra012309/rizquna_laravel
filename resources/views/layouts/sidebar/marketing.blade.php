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

        <li class="sidebar-title">Transaction</li>

        <li class="sidebar-item">
            <a href="{{ route('p.booking') }}" class="sidebar-link">
                <i class="bi bi-building-fill-check"></i>
                <span>Booking Hotels</span>
            </a>
        </li>

        <li class="sidebar-title">Report</li>

        <li class="sidebar-item">
            <a href="{{ route('p.report.agent') }}" class="sidebar-link">
                <i class="bi bi-people-fill"></i>
                <span>Report Agent</span>
            </a>
        </li>
    </ul>
</div>

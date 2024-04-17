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
            <a href="{{ route('p.visa') }}" class="sidebar-link">
                <i class="bi bi-credit-card-2-front-fill"></i>
                <span>Payment Visa</span>
            </a>
        </li>
    </ul>
</div>

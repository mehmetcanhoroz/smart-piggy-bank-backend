<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard.index') }}" class="brand-link">
        <img src="{{ asset('img/piggy-bank-icon.png') }}"
             alt="Smart Piggy Bank"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Piggy Bank</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img
                    src="{{ \Illuminate\Support\Facades\Auth::user()->is_parent ? asset('img/user.png') : asset('img/child.png') }}"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <span class="d-block text-white">{{ \Illuminate\Support\Facades\Auth::user()->name }}</span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.leaderboard.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>Leaderboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.statistics.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>Statistics</p>
                        <span class="badge badge-info right">{{ $totalSaving }} &#8378;</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                        <span class="badge badge-primary right">{{ $userCount }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.transactions.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-money-bill-alt"></i>
                        <p>Transactions</p>
                        <span class="badge badge-success right">{{ $transactionCount }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.transactions.fake') }}" class="nav-link">
                        <i class="nav-icon fas fa-image"></i>
                        <p>Transaction Proofs</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.transactions.fake') }}" class="nav-link">
                        <i class="nav-icon fas fa-plus"></i>
                        <p>Add Fake Transaction</p>
                    </a>
                </li>
                {{--<li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>Calendar</p>
                        <span class="badge badge-danger right">{{ $calendarCount }}</span>
                    </a>
                </li>--}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>

                    <form id="logout-form" action="{{ route('dashboard.logout') }}" method="POST"
                          style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

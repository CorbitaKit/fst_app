<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- <a href="index3.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a> -->

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">

            </div>
            @if(Auth::user()->role->id != 1)
            <div class="info">
                <a href="{{ route('features.create') }}" class="d-block">Feature Wishlist</a>
            </div>
            @endif
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if(Auth::check() && Auth::user()->role_id != '1' )
                <li class="nav-item">
                    <a href="{{ route('citizens.index') }}" class="nav-link {{ request()->routeIs('citizens.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Citizens
                        </p>
                    </a>
                </li>
                <li class="nav-item active">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Calendar
                        </p>
                    </a>
                </li>
                @if(Auth::user()->employee->company->settings->duty_schedule == 0)
                <li class="nav-item">
                    <a href="{{ route('schedules.index') }}" class="nav-link {{ request()->routeIs('schedules.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Duty Schedule
                        </p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('employees.index') }}" class="nav-link {{ request()->routeIs('employees.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>
                            Employees
                        </p>
                    </a>
                </li>
                @if(Auth::user()->employee->company->settings->protocol == 0)
                <li class="nav-item">
                    <a href="{{ route('protocols.index') }}" class="nav-link {{ request()->routeIs('protocols.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Protocols
                        </p>
                    </a>
                </li>
                @endif
                @if(Auth::user()->role->name == 'admin')
                <li class="nav-item">
                    <a href="{{ route('procedures.index') }}" class="nav-link {{ request()->routeIs('procedures.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Procedures
                        </p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('apps.index') }}" class="nav-link {{ request()->routeIs('apps.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Apps
                        </p>
                    </a>
                </li>

                @endif
                @if(Auth::check() && Auth::user()->role_id == '1')
                <li class="nav-item">
                    <a href="{{ route('companies.index') }}" class=" nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Companies
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('features.index') }}" class=" nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Features
                        </p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    <footer style="background-color:white; padding: 10px;">
        Storage Space: 5GB

    </footer>
</aside>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
        <a href="{{ route('admin-dashboard') }}" class="brand-link">
            <img src="{{ url('backend/login/TM.png') }}" alt="Tunas Mitra" class="brand-image elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light ml-4">Tunas Mitra</span>
        </a>
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ url('backend/dist/img/avatar5.png')}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{{ route('admin-dashboard') }}" class="d-block">{{ ucfirst(Auth::user()->name) }}</a>
                </div>
            </div>
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fa fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item"><hr></li>
                    <li class="nav-item @yield('dashboard-open')">
                        <a href="{{ route('admin-dashboard') }}" class="nav-link @yield('dashboard-a')">
                            <i class="nav-icon fa fa-tachometer"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item"><hr></li>
                    <li class="nav-item @yield('user-open')">
                        <a href="{{ route('admin-user.index') }}" class="nav-link @yield('user-a')">
                            <i class="nav-icon fa fa-users"></i>
                            <p>User</p>
                        </a>
                    </li>
                    
                    <li class="nav-item"><hr></li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal-logout">
                            <i class="fa fa-lg fa-sign-out"></i> Logout
                        </button>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    
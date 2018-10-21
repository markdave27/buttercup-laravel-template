<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('/bower_components/AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-link"></i> <span>Users</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-link"></i> <span>User Types</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('user-types.index') }}" class="active">View User Types</a></li>
                            <li><a href="{{ route('user-types.create') }}">Add User Type</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('users.index') }}">View Users</a></li>
                    <li><a href="{{ route('users.create') }}">Add User</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-link"></i> <span>Customers</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-link"></i> <span>Customer Categories</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('customer-categories.index') }}" class="active">View Customer Categories</a></li>
                            <li><a href="{{ route('customer-categories.create') }}">Add Customer Category</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('users.index') }}">View Customers</a></li>
                    <li><a href="{{ route('users.create') }}">Add Customer</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-link"></i> <span>Logs</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-link"></i> <span>Log Types</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('log-types.index') }}">View Log Types</a></li>
                            <li><a href="{{ route('log-types.create') }}">Add Log Type</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('logs.index') }}">View Logs</a></li>
                </ul>
            </li>

        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
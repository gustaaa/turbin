<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="index.html">PG Glenmore</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">PG</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header"></li>
        <li class="nav-item dropdown">
            <a href="#" data-id="dropDownUserManagement" class="nav-link has-dropdown"><i class="fas fa-home"></i>
                <span>Dashboard</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" data-id="linkUserList" href="/home">Dashboard</a></li>
            </ul>
        </li>
        @if(Auth::user()->role == 'Administrator')
        <li class="nav-item dropdown" data-id="dropDownUserManagement2">
            <a href="#" data-id="dropDownUserManagement" class="nav-link has-dropdown"><i class="fas fa-users"></i>
                <span>User Management</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" data-id="linkUserList" href="{{ route('user.index') }}">Users List</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-list"></i>
                <span>Report Management</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link " href="{{ route('report1.index') }}">Report 1</a></li>
                <li><a class="nav-link " href="{{ route('report2.index') }}">Report 2</a></li>
                <li><a class="nav-link " href="{{ route('report3.index') }}">Report 3</a></li>
                <li><a class="nav-link " href="{{ route('report.index') }}">All Report</a></li>
            </ul>
        </li>
        @endif
        @if(Auth::user()->role == 'Operator')
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-list"></i>
                <span>Menu Management</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link " href="{{ route('input1.index') }}">Menu Input 1</a></li>
                <li><a class="nav-link " href="{{ route('input2.index') }}">Menu Input 2</a></li>
                <li><a class="nav-link " href="{{ route('input3.index') }}">Menu Input 3</a></li>
            </ul>
        </li>
        @endif
    </ul>
</aside>
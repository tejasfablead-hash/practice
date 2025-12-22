<!-- The sidebar -->

<div class="sidebar">
    <!-- User Dropdown Menu -->
    <a href="#userSubmenu" 
       data-bs-toggle="collapse" 
       aria-expanded="{{ request()->routeIs('user.*') ? 'true' : 'false' }}" 
       class="dropdown-toggle {{ request()->routeIs('user.*') ? '' : 'collapsed' }}">
        <i class="bi bi-people"></i> User Management
    </a>
    
    <div class="collapse {{ request()->routeIs('user.*') ? 'show' : '' }}" id="userSubmenu">
        <ul class="nav flex-column ms-3">
            <li class="nav-item">
                <a href="{{route('form')}}" 
                   class="nav-link {{ request()->routeIs('user.add') ? 'active' : '' }}">
                    <i class="bi bi-person-plus"></i> Add User
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('view')}}" 
                   class="nav-link {{ request()->routeIs('user.view') ? 'active' : '' }}">
                    <i class="bi bi-list-columns-reverse"></i> All Users
                </a>
            </li>
        </ul>
    </div>
</div>
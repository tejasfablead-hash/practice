<div class="sidebar ">

    <!-- User Management -->
    <a class="sidebar-link collapsed " 
       data-bs-toggle="collapse" 
       href="#userMenu" 
       role="button">
        <i class="bi bi-people"></i>
        <span>User Management</span>
    </a>

    <div class="collapse" id="userMenu">
        <ul class="nav flex-column submenu">
            <li class="nav-item">
                <a href="{{ route('form') }}" class="nav-link">
                    <i class="bi bi-person-plus"></i> Add User
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('view') }}" class="nav-link">
                    <i class="bi bi-list-ul"></i> All Users
                </a>
            </li>
        </ul>
    </div>

    <!-- Task 2 -->
    <a class="sidebar-link collapsed" 
       data-bs-toggle="collapse" 
       href="#taskMenu" 
       role="button">
        <i class="bi bi-list-task"></i>
        <span>Task 2</span>
    </a>

    <div class="collapse" id="taskMenu">
        <ul class="nav flex-column submenu">
            <li class="nav-item">
                <a href="{{ route('multifield') }}" class="nav-link">
                    <i class="bi bi-plus-circle"></i> View Tasks
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('inputmultifield') }}" class="nav-link">
                    <i class="bi bi-eye"></i>Add Multiple 
                </a>
            </li>
        </ul>
    </div>

</div>

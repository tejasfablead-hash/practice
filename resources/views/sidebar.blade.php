<div class="sidebar">
    <!-- User Management Section -->
    <a href="#userSubmenu" 
       data-bs-toggle="collapse" 
       aria-expanded="false" 
       class="dropdown-toggle collapsed">
        <i class="bi bi-people"></i> <span>User Management</span>
    </a>
    <div class="collapse" id="userSubmenu">
        <ul class="nav flex-column ms-3">
            <li class="nav-item">
                <a href="{{route('form')}}" class="nav-link"><i class="bi bi-person-plus"></i> Add User</a>
            </li>
            <li class="nav-item">
                <a href="{{route('view')}}" class="nav-link"><i class="bi bi-list-columns-reverse"></i> All Users</a>
            </li>
        </ul>
    </div>

    <!-- Task 2 Section (Now with unique ID 'task2Submenu') -->
    <a href="#task2Submenu" 
       data-bs-toggle="collapse" 
       aria-expanded="false" 
       class="dropdown-toggle collapsed">
        <i class="bi bi-list-task"></i> <span>Task 2</span>
    </a>
    <div class="collapse" id="task2Submenu">
        <ul class="nav flex-column ms-3">
            <li class="nav-item">
                <a href="{{route('multifield')}}" class="nav-link"><i class="bi bi-plus-circle"></i> Add multiple</a>
            </li>
            <li class="nav-item">
                <a href="{{route('inputmultifield')}}" class="nav-link"><i class="bi bi-list-check"></i> View Tasks</a>
            </li>
        </ul>
    </div>
</div>
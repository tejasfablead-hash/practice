<!-- The sidebar -->
<link rel="stylesheet" href="cdn.jsdelivr.net">

<div class="sidebar">
  
    
    <!-- Link 1: Profile -->
    <a href="{{route('Profile')}}" class="{{ request()->routeIs('Profile') ? 'active' : '' }}">
        <i class="bi bi-person-circle"></i> Profile View
    </a>
    
    <!-- Link 2: Add User -->
    <a href="{{route('form')}}" class="{{ request()->routeIs('form') ? 'active' : '' }}">
        <i class="bi bi-person-plus"></i> Add User
    </a>
    
    <!-- Link 3: View Details -->
    <a href="{{route('view')}}" class="{{ request()->routeIs('view') ? 'active' : '' }}">
        <i class="bi bi-list-columns-reverse"></i> View Details
    </a>
</div>

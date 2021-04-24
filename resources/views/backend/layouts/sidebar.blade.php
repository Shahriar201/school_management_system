@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
@endphp

<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        @if(Auth::user()->user_type=='Admin')

            <li class="nav-item has-treeview {{ ($prefix=='/users')?'menu-open':'' }}">
                <a href="" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Manage User
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('users.view') }}" class="nav-link {{ ($route=='users.view')?'active':'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View User</p>
                        </a>
                    </li>
                    
                </ul>
            </li>

        @endif

        <li class="nav-item has-treeview {{ ($prefix=='/profiles')?'menu-open':'' }}">
            <a href="" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    Manage Profile
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('profiles.view') }}" class="nav-link {{ ($route=='profiles.view')?'active':'' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Your Profile</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('profiles.password.view') }}" class="nav-link {{ ($route=='profiles.password.view')?'active':'' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Change Password</p>
                    </a>
                </li>
                
            </ul>
        </li>

        <li class="nav-item has-treeview {{ ($prefix=='/setups')?'menu-open':'' }}">
            <a href="" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    Manage Setup
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('setups.student.class.view') }}" class="nav-link 
                    {{ ($route=='setups.student.class.view')?'active':'' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Student Class</p>
                    </a>
                </li>
            </ul>

            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('setups.student.year.view') }}" class="nav-link 
                    {{ ($route=='setups.student.year.view')?'active':'' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View Year</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('setups.student.group.view') }}" class="nav-link 
                    {{ ($route=='setups.student.group.view')?'active':'' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Student Group</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('setups.student.shift.view') }}" class="nav-link 
                    {{ ($route=='setups.student.shift.view')?'active':'' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Student Shift</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('setups.fee.category.view') }}" class="nav-link 
                    {{ ($route=='setups.fee.category.view')?'active':'' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Fee Category</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('setups.fee.amount.view') }}" class="nav-link 
                    {{ ($route=='setups.fee.amount.view')?'active':'' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Fee Category Amount</p>
                    </a>
                </li>
            </ul>

        </li>

    </ul>
</nav>
<!-- /.sidebar-menu -->
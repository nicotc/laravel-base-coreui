
@hasrole('root')
<li class="nav-item ">
    <a class="nav-link" href="/telescope">
        <i class="nav-icon fa fa-bug "></i>
        Telescope
    </a>
</li>
<li class="nav-item nav-dropdown">

    <a class="nav-link  nav-dropdown-toggle " href="#">
        <i class="nav-icon icon-user"></i>
        Users
    </a>
    <ul class="nav-dropdown-items">
        <li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('users.index') }}">
                Users
            </a>
        </li>

        <li class="nav-item {{ Request::is('roles*') ? 'active' : '' }}"">
        <a class="nav-link"href="{{ route('roles.index') }}">
            Roles
        </a>
        
        </li>
        <li class="nav-item {{ Request::is('permissions*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('permissions.index') }}">
                Permissions
            </a>
        </li>
    </ul>
</li>
@endhasrole

@role('admin')
<li class="nav-item nav-dropdown">

    <a class="nav-link  nav-dropdown-toggle " href="#">
        <i class="nav-icon icon-user"></i>
        Users
    </a>
    <ul class="nav-dropdown-items">
        <li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('users.index') }}">
                Users
            </a>
        </li>
    </ul>
</li>
@endrole








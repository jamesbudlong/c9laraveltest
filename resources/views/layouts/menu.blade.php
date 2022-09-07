<!-- need to remove -->
@can('view-homepage')
    <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>Home</p>
        </a>
    </li>
@endcan

@can('view-all-user')
    <li class="nav-item">
        <a href="{{ route('users.index') }}" class="nav-link {{ (request()->segment(1) == 'users') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user"></i>
            <p>Users</p>
        </a>
    </li>
@endcan

@can('view-all-role')
    <li class="nav-item">
        <a href="{{ route('roles.index') }}" class="nav-link {{ (request()->segment(1) == 'roles') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>Roles</p>
        </a>
    </li>
@endcan

@if(in_array("member", Auth::user()->roles->toArray()))
    {{-- <li class="nav-item">
        <a href="{{ route('roles.index') }}" class="nav-link {{ (request()->segment(1) == 'roles') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>Roles</p>
        </a>
    </li> --}}
@endif

{{-- @can('view-all-file-upload')
    <li class="nav-item">
        <a href="{{ route('file_uploads.index') }}" class="nav-link {{ (request()->segment(1) == 'roles') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>Roles</p>
        </a>
    </li>
@endcan --}}



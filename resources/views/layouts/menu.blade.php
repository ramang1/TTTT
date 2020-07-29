<li class="{{ Request::is('dashboard*') ? 'active' : '' }}">
    <a href="/dashboard"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
</li>

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-user"></i><span>Users</span></a>
</li>
<li class="{{ Request::is('contacts*') ? 'active' : '' }}">
    <a href="{{ route('contacts.index') }}"><i class="fa fa-address-card"></i><span>Contacts</span></a>
</li>

<li class="{{ Request::is('channels*') ? 'active' : '' }}">
    <a href="{{ route('channels.index') }}"><i class="fa fa-users"></i><span>Channels</span></a>
</li>


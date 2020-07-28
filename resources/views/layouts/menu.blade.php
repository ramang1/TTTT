
<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-user"></i><span>Users</span></a>
</li>
<li class="{{ Request::is('contacts*') ? 'active' : '' }}">
    <a href="{{ route('contacts.index') }}"><i class="fa fa-edit"></i><span>Contacts</span></a>
</li>

<li class="{{ Request::is('channels*') ? 'active' : '' }}">
    <a href="{{ route('channels.index') }}"><i class="fa fa-edit"></i><span>Channels</span></a>
</li>


<li class="{{ Request::is('dashboard*') ? 'active' : '' }}">
    <a href="/dashboard"><i class="fa fa-dashboard"></i><span>Bảng điều khiển</span></a>
</li>

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-user"></i><span>Người dùng</span></a>
</li>
<li class="{{ Request::is('contacts*') ? 'active' : '' }}">
    <a href="{{ route('contacts.index') }}"><i class="fa fa-address-card"></i><span>Liên hệ</span></a>
</li>

<li class="{{ Request::is('channels*') ? 'active' : '' }}">
    <a href="{{ route('channels.index') }}"><i class="fa fa-users"></i><span>Tuyến</span></a>
</li>
<li class="{{ Request::is('inboxes*') ? 'active' : '' }}">
    <a href="{{ route('inboxes.index') }}"><i class="fa fa-inbox"></i><span>Thư đến</span></a>
</li>
<li class="{{ Request::is('processInboxes*') ? 'active' : '' }}">
    <a href="{{ route('processInboxes.index') }}"><i class="fa fa-edit"></i><span>Quá trình xử lý thư đến</span></a>
</li>

<li class="{{ Request::is('outboxes*') ? 'active' : '' }}">
    <a href="{{ route('outboxes.index') }}"><i class="fa fa-inbox"></i><span>Thư đi</span></a>
</li>
<li class="{{ Request::is('outboxProcesses*') ? 'active' : '' }}">
    <a href="{{ route('outboxProcesses.index') }}"><i class="fa fa-edit"></i><span>Quá trình xử lý thư đi</span></a>
</li>
<li class="{{ Request::is('services*') ? 'active' : '' }}">
    <a href="{{ route('services.index') }}"><i class="fa fa-server"></i><span>Services</span></a>
</li>
<li class="{{ Request::is('logs*') ? 'active' : '' }}">
    <a href="{{ route('logs.index') }}"><i class="fa fa-history"></i><span>Nhật ký</span></a>
</li>
<li class="{{ Request::is('outboxProcesses*') ? 'active' : '' }}">
    <a href="{{ route('backups.index') }}"><i class="fa fa-window-restore"></i><span>Sao lưu và phục hồi CSDL</span></a>
</li>
<li class="{{ Request::is('settings*') ? 'active' : '' }}">
    <a href="{{ route('settings.index') }}"><i class="fa fa-cog"></i><span>Settings</span></a>
</li>






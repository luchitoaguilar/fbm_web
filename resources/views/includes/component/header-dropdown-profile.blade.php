<div class="dropdown-menu dropdown-menu-end me-1">
<!--	<a href="javascript:;" class="dropdown-item">Edit Profile</a>-->
	<a href="javascript:;" class="dropdown-item d-flex align-items-center">
		Inbox
		<span class="badge bg-danger rounded-pill ms-auto pb-4px">2</span>
	</a>
<!--	<a href="javascript:;" class="dropdown-item">Calendar</a>-->
<!--	<a href="javascript:;" class="dropdown-item">Setting</a>-->
	<div class="dropdown-divider"></div>
    {!! Form::open(['url'=> route('logout'), 'method' => 'post']) !!}
    <button type="submit" class="dropdown-item"> Cerrar Sesión</button>
    {!! Form::close() !!}
</div>

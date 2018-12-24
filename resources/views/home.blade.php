@extends ('layout.main')

@section('content')
	<div class="container">
		<ul class="list-group">

			<li class="list-group-item">You are logged in with the username: <b>{{$user->username}}</b></li>
			<li class="list-group-item">This is your email address: <b>{{$user->email}}</b></li>
		</ul>
	</div>
@stop

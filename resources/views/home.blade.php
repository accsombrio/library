@extends ('layout.main')

@section('content')
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
	<div class="container">
			<li class="list-group-item">You are logged in with username: <b>{{$user->username}}</b></li>
			<li class="list-group-item">Email address: <b>{{$user->email}}</b></li>
	</div>
	<br><br>
	<div class="container">
		<h2>List of Books</h2>
		<table>
			@foreach ($books as $book)
				<tr class="row">
					<td >
						<div><b>{{$book->title}}</b> written by: <i>{{$book->writer}}</i>
						</div>
					</td>
					<td style="text-align: center;">
					@if ($book->user_id==0)
								{{Form::open(array('url'=>'/borrow/'.$book->id.'/true','method'=>'post'))}}		
								{{Form::submit('Borrow Book', array('class'=>'btn btn-primary'))}}
								{{Form::close()}}
						@elseif($book->user_id == $user->id)
								{{Form::open(array('url'=>'/borrow/'.$book->id.'/false','method'=>'post'))}}		
								{{Form::submit('Return Book', array('class'=>'btn btn-danger'))}}
								{{Form::close()}}
						@else
							Not Available. Borrowed by: <b>{{$book->user->username}}</b>
						@endif
					</td> 
				</tr>
			@endforeach
		</table>
	</div>
@stop



